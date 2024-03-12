<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->web = $this->db->get('web')->row();
		$this->load->library('Pdf');
		if ($this->session->userdata('level') != 'superadmin') {
			$this->session->set_flashdata('message', 'swal("Ops!", "Anda harus login sebagai superadmin", "error");');
			redirect('auth');
		}
	}
	 
	public function index()
	{
		$tahun 			= date('Y');
		$bulan 			= date('m');
		$hari 			= date('d');
		$data['web']	= $this->web;
		$data['pegawai']= $this->M_data->pegawai()->num_rows();
		$data['hadir']	= $this->M_data->hadirtoday($tahun,$bulan,$hari)->num_rows();
		$data['cuti']	= $this->M_data->cutitoday($tahun,$bulan,$hari)->num_rows();
		$data['izin']	= $this->M_data->izintoday($tahun,$bulan,$hari)->num_rows() + $this->M_data->sakittoday($tahun,$bulan,$hari)->num_rows();
		$data['absensi']= $this->M_data->absen()->num_rows();
		$data['departemen']= $this->db->get('departemen')->num_rows();
		$data['title']	= 'Dashboard';
		$data['body']	= 'superadmin/home';
		$this->load->view('template',$data);
	}
	//CURD Departemen
	public function departemen()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->db->get('departemen')->result();
		$data['title']	= 'Data Departemen';
		$data['body']	= 'superadmin/departemen';
		$this->load->view('template',$data);
	}
	public function departemen_add()
	{
		$data['web']	= $this->web;
		$data['title']	= 'Tambah Data Departemen';
		$data['body']	= 'superadmin/departemen_add';
		$this->load->view('template',$data);
	}
	public function departemen_simpan()
	{
		$this->db->insert('departemen',['departemen'=>$this->input->post('departemen')]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Tambah departemen", "success");');
		redirect('admin/departemen');

	}
	public function departemen_edit($id)
	{
		$data['web']	= $this->web;
		$data['data']	= $this->db->get_where('departemen',['departemen_id'=>$id])->row();
		$data['title']	= 'Update Data Departemen';
		$data['body']	= 'superadmin/departemen_edit';
		$this->load->view('template',$data);
	}
	public function departemen_update($id)
	{
		$this->db->update('departemen',['departemen'=>$this->input->post('departemen')],['departemen_id'=>$id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Update departemen", "success");');
		redirect('superadmin/departemen');

	}
	public function departemen_delete($id)
	{
		$this->db->delete('departemen',['departemen_id'=>$id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Delete departemen", "success");');
		redirect('superadmin/departemen');

	}
	//EDN CURD Departemen
	//CURD Pegawai
	public function pegawai()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->pegawai()->result();
		$data['title']	= 'Data Pegawai';
		$data['body']	= 'superadmin/pegawai'; 
		$this->load->view('template',$data);
	}
	public function pegawai_add()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->db->get('departemen')->result();
		$data['title']	= 'Tambah Data Pegawai';
		$data['body']	= 'superadmin/pegawai_add';
		$this->load->view('template',$data);
	}
	public function pegawai_simpan()
	{
		$p = $this->input->post();
		$user = [
			'nama'		=> $p['nama'],
			'email'		=> $p['email'],
			'password'	=> md5($p['password']),
			'level'		=> $p['level'],
			'nim'		=> $p['nim']
		];
		$pgw = [
			'nim'			=> $p['nim'],
			'jenis_kelamin'	=> $p['jenis_kelamin'],
			'id_departemen'	=> $p['departemen'],
			'waktu_masuk'	=> $p['masuk'],
			'level'		=> $p['level'],
		];
		$this->db->trans_start();
		$this->db->insert('user',$user);
		$this->db->insert('pegawai',$pgw);
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Tambah Data Pegawai", "success");');
		redirect('superadmin/pegawai');
	}
	public function pegawai_edit($id)
	{
		$data['web']	= $this->web;
		$data['data']	= $this->db->get('departemen')->result();
		$data['detail']	= $this->M_data->pegawaiid($id)->row();
		$data['title']	= 'Update Data Pegawai';
		$data['body']	= 'superadmin/pegawai_edit';
		$this->load->view('template',$data);
	}
	public function pegawai_update($id)
	{
		$p = $this->input->post();
		$user = [
			'nama'		=> $p['nama'],
			'email'		=> $p['email'],
			'password'	=> md5($p['password']),
		];
		$pgw = [
			'jenis_kelamin'	=> $p['jenis_kelamin'],
			'id_departemen'	=> $p['departemen'],
			'waktu_masuk'	=> $p['masuk'],
			
		];
		$this->db->trans_start();
		$this->db->update('user',$user,['nim'=>$id]);
		$this->db->update('pegawai',$pgw,['nim'=>$id]);
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Update Data Pegawai", "success");');
		redirect('superadmin/pegawai');
	}
	public function pegawai_delete($id)
	{
		$this->db->trans_start();
		$this->db->delete('user',['nim'=>$id]);
		$this->db->delete('pegawai',['nim'=>$id]);
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Delete Data Pegawai", "success");');
		redirect('superadmin/pegawai');
	}

	//end CURD pegawai
	//filter data absen
	
	//Data Absensi
	public function absensi()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->absen()->result();
		$data['title']	= 'Data Absen Pegawai';
		$data['body']	= 'superadmin/absen';
		$this->load->view('template',$data);
	}
	public function hapus_semua() {
        // Lakukan penghapusan semua data dari tabel absen
        $this->load->model('M_data'); // Sesuaikan dengan nama model absen Anda
        $this->M_data->hapus_semua_data(); // Panggil method hapus_semua_data dari model
        
        // Setelah penghapusan selesai, redirect ke halaman yang sesuai atau tampilkan pesan sukses
        redirect('superadmin/absensi'); // Sesuaikan dengan halaman yang ingin Anda arahkan setelah penghapusan
    }
	public function absen_delete($id)
	{
   		 $this->db->trans_start();
    //Gunakan klausa Where untuk hanya menghapus rekaman dengan ID yang ditentukan.
    	$this->db->where('nim', $id);
   		$this->db->delete('absen');
    	$this->db->trans_complete();
    	$this->session->set_flashdata('message', 'swal("Berhasil!", "Delete Data absensi", "success");');
    redirect('superadmin/absensi');
	}
	
	//Data pengajuan cuti
	public function cuti()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->cuti()->result();
		$data['title']	= 'Data Cuti Pegawai';
		$data['body']	= 'superadmin/cuti';
		$this->load->view('template',$data);
	}
	public function cuti_terima($id)
	{
		$this->db->update('cuti',['status'=>'diterima'],['id_cuti'=>$id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Menerima pengajuan cuti", "success");');
		redirect('superadmin/cuti');
	}
	public function cuti_tolak($id)
	{
		$this->db->update('cuti',['status'=>'ditolak'],['id_cuti'=>$id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Menolak pengajuan cuti", "success");');
		redirect('superadmin/cuti');
	}
	public function hapus_cuti() {
        // Lakukan penghapusan semua data dari tabel absen
        $this->load->model('M_data'); // Sesuaikan dengan nama model absen Anda
        $this->M_data->hapus_semua_cuti(); // Panggil method hapus_semua_data dari model
        
        // Setelah penghapusan selesai, redirect ke halaman yang sesuai atau tampilkan pesan sukses
        redirect('superadmin/cuti'); // Sesuaikan dengan halaman yang ingin Anda arahkan setelah penghapusan
    }
	//laporan bulanan
	function laporan(){
		 function bulan($bln){
            $bulan = $bln;
            Switch ($bulan){
                case 1 : $bulan="Januari";
                    Break;
                case 2 : $bulan="Februari";
                    Break;
                case 3 : $bulan="Maret";
                    Break;
                case 4 : $bulan="April";
                    Break;
                case 5 : $bulan="Mei";
                    Break;
                case 6 : $bulan="Juni";
                    Break;
                case 7 : $bulan="Juli";
                    Break;
                case 8 : $bulan="Agustus";
                    Break;
                case 9 : $bulan="September";
                    Break;
                case 10 : $bulan="Oktober";
                    Break;
                case 11 : $bulan="November";
                    Break;
                case 12 : $bulan="Desember";
                    Break;
            }
            return $bulan;
        }
        $bulan  = $this->input->post('bulan');
        $web 	= $this->web;
        $data   = $this->M_data->laporan($bulan)->result();
        
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',22);
        // mencetak string 
        $pdf->Image('assets/img/'.$web->logo,10,5,25);
        $pdf->Cell(190,7,$web->nama,0,1,'C');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(190,5,$web->alamat,0,1,'C');
        $pdf->Cell(190,3,'Phone : '.$web->nohp.' - Email : '.$web->email,0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->Cell(190,1,'','B',1,'L');
        $pdf->Cell(190,1,'','B',0,'L');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,5,'',0,1);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(190,7,'Laporan Absensi Pegawai',0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(10,5,'Bulan : '.bulan($bulan),0,1);
        $pdf->Cell(10,1,'',0,1);
        $pdf->Cell(10,7,'No ',1,0,'C');
        $pdf->Cell(80,7,'Nama ',1,0,'C');
        $pdf->Cell(50,7,'Waktu ',1,0,'C');
        $pdf->Cell(50,7,'Keterangan ',1,1,'C');
        $no=1;
            foreach ($data as $a) {
                $pdf->Cell(10,7,$no++,1,0,'C');
                $pdf->Cell(80,7,$a->nama,1,0,'C');
                $pdf->Cell(50,7,$a->waktu,1,0,'C');
                $pdf->Cell(50,7,ucfirst($a->ket),1,1,'C');
            }
        $pdf->Cell(10,5,'',0,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(170,5,ucfirst($web->kabupaten).', '.date('d-m-Y'),0,1,'R');
        $pdf->Cell(190,15,'',0,1,'C');
        $pdf->Cell(160,5,$web->author,0,1,'R');
            
        
        $pdf->Output();
                    
    }
    public function profile()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->db->get_where('user',['user_id'=>$this->session->userdata('user_id')])->row();
		$data['title']	= 'Profile Pengguna';
		$data['body']	= 'superadmin/profile';
		$this->load->view('template',$data);
	}
	public function profile_update($id)
	{
		$usr = [
			'nama'	=> $this->input->post('nama'),
			'email'	=> $this->input->post('email'),
		];
		$this->db->update('user',$usr,['user_id'=>$id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Update profile", "success");');
		redirect('superadmin/profile');
	}
	
	
}




