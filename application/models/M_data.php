<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	function pegawai()
	{
		$this->db->select('*');
	    $this->db->from('user');
	    $this->db->join('pegawai','user.nim = pegawai.nim');
	    $this->db->join('departemen','pegawai.id_departemen = departemen.departemen_id');
       	return $this->db->get();
	}
	function pegawaiid($id)
	{
		$this->db->select('*');
	    $this->db->from('user');
	    $this->db->join('pegawai','user.nim = pegawai.nim');
	    $this->db->join('departemen','pegawai.id_departemen = departemen.departemen_id');
	    $this->db->where('user.nim',$id);
       	return $this->db->get();
	}
	function absendaily($id,$tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('nim',$id);
		$this->db->where('year(waktu)',$tahun);
		$this->db->where('month(waktu)',$bulan);
		$this->db->where('day(waktu)',$hari);
		return $this->db->get();
	}


	public function revisi_simpan()
	{
		$this->db->select('*');
		$this->db->from('revisi_absen');
		$this->db->join('pegawai','revisi_absen.nim = pegawai.nim');
		$this->db->join('user','pegawai.nim = user.nim');
		$this->db->order_by('revisi_absen.id_revisi','keterangan');
		return $this->db->get();
	}

	public function absen()
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai','absen.nim = pegawai.nim');
		$this->db->join('user','pegawai.nim = user.nim');
		$this->db->order_by('absen.waktu','desc','kegiatanhariini','kendala','mengatasi','kegiatanberikut');
		return $this->db->get();
	}
	public function hapus_semua_data() {
        // Lakukan penghapusan semua data dari tabel absen
        $this->db->empty_table('absen'); // Gantilah 'nama_tabel_absen' dengan nama tabel absen Anda
        
        // Atau, jika Anda ingin melakukan penghapusan satu persatu baris data
        // $this->db->truncate('nama_tabel_absen');
    }
	
	public function absensi_pegawai($id)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai','absen.nim = pegawai.nim');
		$this->db->join('user','pegawai.nim = user.nim');
		$this->db->where('pegawai.nim',$id);
		$this->db->order_by('absen.waktu','desc','kegiatanhariini','kendala','mengatasi','kegiatanberikut');
		return $this->db->get();
	}
	
	public function revisi()
	{
		$this->db->select('*');
		$this->db->from('revisi_absen');
		$this->db->join('pegawai','revisi_absen.nim = pegawai.nim');
		$this->db->join('user','pegawai.nim = user.nim');
		$this->db->order_by('revisi_absen.id_revisi','desc');
		return $this->db->get();
	}
	public function revisi_pegawai($id)
	{
		$this->db->select('*');
		$this->db->from('revisi_absen');
		$this->db->join('pegawai','revisi_absen.nim = pegawai.nim');
		$this->db->join('user','pegawai.nim = user.nim');
		$this->db->where('pegawai.nim',$id);
		$this->db->order_by('revisi_absen.id_revisi','desc');
		return $this->db->get();
	}
	public function hapus_semua_revisi() {
        
        $this->db->empty_table('revisi_absen'); 
    }


	public function cuti()
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('pegawai','cuti.nim = pegawai.nim');
		$this->db->join('user','pegawai.nim = user.nim');
		$this->db->order_by('cuti.id_cuti','desc');
		return $this->db->get();
	}
	public function cuti_pegawai($id)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('pegawai','cuti.nim = pegawai.nim');
		$this->db->join('user','pegawai.nim = user.nim');
		$this->db->where('pegawai.nim',$id);
		$this->db->order_by('cuti.id_cuti','desc');
		return $this->db->get();
	}
	public function hapus_semua_cuti() {
        
        $this->db->empty_table('cuti'); 
    }
	public function laporan($bulan)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai','absen.nim = pegawai.nim');
		$this->db->join('user','pegawai.nim = user.nim');
		$this->db->where('month(waktu)',$bulan);
		$this->db->order_by('absen.waktu','desc');
		return $this->db->get();
	}
	function absenbulan($id,$tahun,$bulan)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('nim',$id);
		$this->db->where('keterangan','masuk');
		$this->db->where('year(waktu)',$tahun);
		$this->db->where('month(waktu)',$bulan);
		return $this->db->get();
	}
	function cutibulan($id,$tahun,$bulan)
	{

		$this->db->select('* ');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('nim',$id);
		$this->db->where('jenis_cuti','cuti');
		$this->db->where('status','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		return $this->db->get();
	}
	function sakitbulan($id,$tahun,$bulan)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('nim',$id);
		$this->db->where('jenis_cuti','sakit');
		$this->db->where('status','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		return $this->db->get();
	}
	function izinbulan($id,$tahun,$bulan)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('nim',$id);
		$this->db->where('jenis_cuti','izin');
		$this->db->where('status','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		return $this->db->get();
	}
	function cutitoday($tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('jenis_cuti','cuti');
		$this->db->where('status','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		$this->db->where('day(tanggal)',$hari);
		return $this->db->get();
	}
	function izintoday($tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('jenis_cuti','izin');
		$this->db->where('status','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		$this->db->where('day(tanggal)',$hari);
		return $this->db->get();
	}
	function sakittoday($tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('jenis_cuti','sakit');
		$this->db->where('status','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		$this->db->where('day(tanggal)',$hari);
		return $this->db->get();
	}

	function hari($hari){
 
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return $hari_ini;
 
}
	function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		
		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun
	 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
	function hadirtoday($tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('keterangan','masuk');
		$this->db->where('year(waktu)',$tahun);
		$this->db->where('month(waktu)',$bulan);
		$this->db->where('day(waktu)',$hari);
		return $this->db->get();
	}


}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */