<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawaioutsite extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->web = $this->db->get('web')->row();
		if ($this->session->userdata('level') != 'pegawaioutsite') {
			$this->session->set_flashdata('message', 'swal("Ops!", "Anda haru login sebagai pegawai", "error");');
			redirect('auth');
		}
		date_default_timezone_set ( 'asia/jakarta' ); 
	}
	
	public function index()
	{
		$tahun 			= date('Y');
		$bulan 			= date('m');
		$hari 			= date('d');
		$absen			= $this->M_data->absendaily($this->session->userdata('nim'),$tahun,$bulan,$hari); 
		if ($absen->num_rows() == 0) { $data['waktu'] = 'masuk'; }
		elseif ($absen->num_rows() == 1) { $data['waktu'] = 'pulang'; }
		else { $data['waktu'] = 'dilarang'; }
		$data['web']	= $this->web;
		$data['title']	= 'Dashboard';
		$data['body']	= 'pegawaioutsite/home';
		$this->load->view('template',$data);
	}
	//proses absen
	public function proses_absen()
	{
		$id = $this->session->userdata('nim');
		$p = $this->input->post();
		$data = [
			'nim'	=> $id,
			'keterangan' => $p['ket']
		];
		if($p['lok'] == '1'){
			$this->db->insert('absen',$data);
			$this->session->set_flashdata('message', 'swal("Berhasil!", "Melakukan absen", "success");');
		} else {
			$this->session->set_flashdata('message', 'swal("Gagal!", "Melakukan absen", "error");');
		}
		redirect('pegawaioutsite');
	}
	//data absen
	public function absensi()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->absensi_pegawaioutsite($this->session->userdata('nim'))->result();
		$data['title']	= 'Data Absen';
		$data['body']	= 'pegawaioutsite/absen';
		$this->load->view('template',$data);
	}
	//CURD data cuti
	public function cuti()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->cuti_pegawaioutsite($this->session->userdata('nim'))->result();
		$pegawaioutsite = $this->M_data->pegawaiidoutsite($this->session->userdata('nim'))->row();
		$dt1 = new DateTime($pegawaioutsite->waktu_masuk);
		$dt2 = new DateTime(date('Y-m-d'));
		$d = $dt2->diff($dt1)->days + 1;
		$data['bakti']	= $d;
		$data['title']	= 'Data Permohonan Ketidakhadiran';
		$data['body']	= 'pegawaioutsite/cuti';
		$this->load->view('template',$data);
	}
	public function cuti_add()
	{
		$data['web']	= $this->web;
		$pegawaioutsite = $this->M_data->pegawaiidoutsite($this->session->userdata('nim'))->row();
		$dt1 = new DateTime($pegawaioutsite->waktu_masuk);
		$dt2 = new DateTime(date('Y-m-d'));
		$d = $dt2->diff($dt1)->days + 1;
		$data['bakti']	= $d;
		$data['title']	= 'Tambah Data Ketidakhadiran';
		$data['body']	= 'pegawaioutsite/cuti_add';
		$this->load->view('template',$data);
	}
	public function cuti_simpan()
	{
		$this->db->trans_start();
		$data = array(
			'nim'			=> $this->session->userdata('nim'),
			'jenis_cuti'	=> $this->input->post('jenis'),
			'alasan'		=> $this->input->post('alasan'),
			'status'		=> 'diajukan'
		);

		if (isset($_FILES['bukti']['name'])) {
			$config['upload_path'] 		= './bukti/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['overwrite']  		= true;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('bukti')){
				$this->session->set_flashdata('message', 'swal("Ops!", "Bukti gagal diupload", "erro");');
				redirect('pegawaioutsite/cuti_add');
			}
			else{
				$img = $this->upload->data();
				$data['bukti'] = $img['file_name'];
			}
		}
		
		$this->db->insert('cuti',$data);
		$cek = $this->db->query(" select * from cuti order by id_cuti desc limit 1 ")->row();
		$dt1 = new DateTime($this->input->post('mulai'));
		$dt2 = new DateTime($this->input->post('akhir'));
		$jml = $dt2->diff($dt1)->days + 1;
		$tgl1= $this->input->post('mulai');
		$no  = 1;
		for ($i=0; $i < $jml ; $i++) { 
			$insert = array(
				'id_cuti' => $cek->id_cuti,
				'tanggal' => date('Y-m-d', strtotime('+'.$i.' days', strtotime($tgl1))),
			);
			$this->db->insert('detailcuti',$insert);
		}

		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Pengajuan cuti", "success");');
		redirect('pegawaioutsite/cuti');
	}
	public function cuti_update($id)
	{
		$data = array(
			'nim'	=> $this->session->userdata('nim'),
			'mulai'	=> $this->input->post('mulai'),
			'akhir'	=> $this->input->post('akhir'),
			'alasan'=> $this->input->post('alasan')
		);
		$this->db->update('cuti',$data,['id_cuti'=>$id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Update pengajuan cuti", "success");');
		redirect('pegawaioutsite/cuti');
	}
	//update profile
	public function profile()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->pegawaiid($this->session->userdata('nim'))->row();
		$data['title']	= 'Profile Pengguna';
		$data['body']	= 'pegawai/profile';
		$this->load->view('template',$data);
	}
	public function profile_update($id)
	{
		$usr = [
			'nama'	=> $this->input->post('nama'),
			'email'	=> $this->input->post('email'),
		];
		$this->db->trans_start();
		$this->db->update('user',$usr,['nim'=>$id]);
		$this->db->update('pegawai',['jenis_kelamin'=>$this->input->post('jenis_kelamin')],['nim'=>$id]);
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Update profile", "success");');
		redirect('pegawaioutsite/profile');
	}
	public function ganti_password()
	{
		$data['web']	= $this->web;
		$data['title']	= 'Ganti Password';
		$data['body']	= 'pegawai/ganti password';
		$this->load->view('template',$data);
	}
	public function password_update($id)
	{
		$p = $this->input->post();
		$cek = $this->db->get_where('user',['nim'=>$id]);
		if ($cek->num_rows() > 0) {
			$a = $cek->row();
			if (md5($p['pw_lama']) == $a->password) {
				$this->db->update('user',['password'=>md5($p['pw_baru'])],['nim'=>$id]);
				$this->session->set_flashdata('message', 'swal("Berhasil!", "Update password", "success");');
				redirect('pegawaioutsite/ganti_password');
			}
			else
			{
				$this->session->set_flashdata('message', 'swal("Ops!", "Password lama yang anda masukan salah", "error");');
				redirect('pegawaioutsite/ganti_password');
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'swal("Ops!", "Anda harus login", "error");');
				redirect('auth');
		}
	}
	public function slip()
	{
		$tahun 			= date('Y');
		$bulan 			= date('m');
		$data['data']	= $this->M_data->pegawaiid($this->session->userdata('nim'))->row();
		$data['absen']  = $this->M_data->absenbulan($this->session->userdata('nim'),$tahun,$bulan)->num_rows(); 
        $data['cuti']  	= $this->M_data->cutibulan($this->session->userdata('nim'),$tahun,$bulan)->num_rows(); 
        $data['sakit']  = $this->M_data->sakitbulan($this->session->userdata('nim'),$tahun,$bulan)->num_rows(); 
        $data['izin']  	= $this->M_data->izinbulan($this->session->userdata('nim'),$tahun,$bulan)->num_rows();
		$data['web']	= $this->web;
		$data['title']	= 'Slip Gaji';
		$data['body']	= 'pegawaioutsite/slip';
		$this->load->view('template',$data);
	}
	public function print_slip()
	{
		$tahun 			= date('Y');
		$bulan 			= date('m');
		$data['data']	= $this->M_data->pegawaiid($this->session->userdata('nim'))->row();
		$data['absen']  = $this->M_data->absenbulan($this->session->userdata('nim'),$tahun,$bulan)->num_rows(); 
        $data['cuti']  	= $this->M_data->cutibulan($this->session->userdata('nim'),$tahun,$bulan)->num_rows(); 
        $data['sakit']  = $this->M_data->sakitbulan($this->session->userdata('nim'),$tahun,$bulan)->num_rows(); 
        $data['izin']  	= $this->M_data->izinbulan($this->session->userdata('nim'),$tahun,$bulan)->num_rows();
		$data['web']	= $this->web;
		$data['title']	= 'Slip Gaji '.$this->session->userdata('nama');
		$this->load->view('pegawaioutsite/slip_print',$data);
	}
}