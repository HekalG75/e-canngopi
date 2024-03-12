<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->web = $this->db->get('web')->row();
		if ($this->session->userdata('level') != 'pegawai') {
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
		$data['body']	= 'pegawai/home';
		$this->load->view('template',$data);
	}


	public function revisi_absen()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->lupa_absen($this->session->userdata('nim'))->result();
		$pegawai = $this->M_data->pegawaiid($this->session->userdata('nim'))->row();
		$data['title']	= 'Revisi Absen';
		$data['body']	= 'pegawai/revisi_absen';
		$this->load->view('template',$data);
	}

	public function revisi_add()
	{
		$data['web']	= $this->web;
		$pegawai = $this->M_data->pegawaiid($this->session->userdata('nim'))->row();
		$data['title']	= 'Tambah Data Revisi Absen';
		$data['body']	= 'pegawai/revisi_add';
		$this->load->view('template',$data);
	}
	//proses absen
public function proses_absen()
{
    $id = $this->session->userdata('nim');
    $p = $this->input->post();
    $data = [
        'nim'       => $id,
        'keterangan' => $p['ket']
    ];

    // Tambahan catatan 
if (isset($p['kegiatanhariini'])) {
    $data['kegiatanhariini'] = $p['kegiatanhariini'];
}
if (isset($p['kendala'])) {
    $data['kendala'] = $p['kendala'];
}
if (isset($p['mengatasi'])) {
    $data['mengatasi'] = $p['mengatasi'];
}
if (isset($p['kegiatanberikut'])) {
    $data['kegiatanberikut'] = $p['kegiatanberikut'];
}

    if ($p['lok'] == '1') {
        $this->db->insert('absen', $data);
        $this->session->set_flashdata('message', 'swal("Berhasil!", "Melakukan absen", "success");');
    } else {
        $this->session->set_flashdata('message', 'swal("Gagal!", "Melakukan absen", "error");');
    }
    redirect('pegawai');
}
	//data absen
	public function absensi()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->absensi_pegawai($this->session->userdata('nim'))->result();
		$data['title']	= 'Data Absen';
		$data['body']	= 'pegawai/absen';
		$this->load->view('template',$data);
	}
	//CURD data cuti
	public function cuti()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->cuti_pegawai($this->session->userdata('nim'))->result();
		$pegawai = $this->M_data->pegawaiid($this->session->userdata('nim'))->row();
		$dt1 = new DateTime($pegawai->waktu_masuk);
		$dt2 = new DateTime(date('Y-m-d'));
		$d = $dt2->diff($dt1)->days + 1;
		$data['bakti']	= $d;
		$data['title']	= 'Data Permohonan Ketidakhadiran';
		$data['body']	= 'pegawai/cuti';
		$this->load->view('template',$data);
	}
	public function cuti_add()
	{
		$data['web']	= $this->web;
		$pegawai = $this->M_data->pegawaiid($this->session->userdata('nim'))->row();
		$dt1 = new DateTime($pegawai->waktu_masuk);
		$dt2 = new DateTime(date('Y-m-d'));
		$d = $dt2->diff($dt1)->days + 1;
		$data['bakti']	= $d;
		$data['title']	= 'Tambah Data Ketidakhadiran';
		$data['body']	= 'pegawai/cuti_add';
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
				redirect('pegawai/cuti_add');
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
		redirect('pegawai/cuti');
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
		redirect('pegawai/cuti');
	}
	public function cuti_edit($id)
	{
		$data['web']	= $this->web;
		$data['title']	= 'Update Data Cuti';
		$data['data']	= $this->db->get_where('cuti',['id_cuti'=>$id])->row();
		$data['body']	= 'pegawai/cuti_edit';
		$this->load->view('template',$data);
	}
	public function cuti_delete($id)
	{
		$this->db->delete('cuti',['id_cuti'=>$id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Delete pengajuan cuti", "success");');
		redirect('pegawai/cuti');
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
		redirect('pegawai/profile');
	}
	
}