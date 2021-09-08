<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

	// Ranah Data Cabang

	public function tampil_cabang(){
		// $this->db->where('kode_cabang < 100');
		$result = $this->db->get('tbl_cabang');
		return $result;
	}

	public function tampil_cabang_where($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result->row_array();
	}

	public function simpan_cabang($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_cabang($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_cabang($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// ....................................................................

	// Ranah Data Kendaraan

	public function tampil_kendaraan(){
		$this->db->order_by('cabang');
		$result = $this->db->get('tbl_kendaraan');
		return $result;
	}

	// public function tampil_cabang_where($tbl, $where){
	// 	$result = $this->db->get_where($tbl, $where);
	// 	return $result->row_array();
	// }

	public function simpan_kendaraan($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_kendaraan($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_kendaraan($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// ....................................................................

	// Ranah Data Bank

	public function tampil_bank(){
		$result = $this->db->get('tbl_bank_pengaju');
		return $result;
	}

	// public function tampil_cabang_where($tbl, $where){
	// 	$result = $this->db->get_where($tbl, $where);
	// 	return $result->row_array();
	// }

	public function simpan_bank($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_bank($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_bank($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// ....................................................................

	// Ranah Data Departemen

	public function tampil_departemen(){
		$this->db->order_by('kode_departemen', 'ASC');
		$result = $this->db->get('tbl_departemen');
		return $result;
	}

	public function simpan_departemen($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_departemen($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_departemen($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// ....................................................................

	// Ranah Data Jenis Biaya

	public function tampil_jenis_biaya(){
		$result = $this->db->get('tbl_jenis_biaya');
		return $result;
	}

	public function tampil_relasi_biaya($where){
		$result = $this->db->get_where('tbl_relasi_biaya', $where);
		return $result;
	}

	// Format ID : JB-001
	public function id_otomatis(){
		$result = $this->db->query(
			"SELECT MAX(MID(kode_jb,4,3)) AS id_otomatis
			FROM tbl_jenis_biaya"
		);

		if($result->num_rows() > 0){
			$row = $result->row_array();
			$n = ((int)$row['id_otomatis'] + 1);
			$no = sprintf("%'.03d", $n);
		}else{
			$no = "001";
		}

		date_default_timezone_set("Asia/Jakarta");
		$id_otomatis = "JB-".$no;
		return $id_otomatis;
	}

	public function simpan_jenis_biaya($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_jenis_biaya($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_jenis_biaya($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	public function tampil_jenis_biaya_id($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result;
	}

	// ....................................................................

	// Ranah Data Karyawan

	public function tampil_karyawan(){
		$result = $this->db->get('tbl_karyawan');
		return $result;
	}

	public function simpan_karyawan($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_karyawan($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_karyawan($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}


	// ....................................................................

	// Ranah Data Sub Biaya

	public function tampil_sub_biaya(){
		$this->db->select('tbl_sub_biaya.*, tbl_jenis_biaya.*');
		$this->db->from('tbl_sub_biaya');
		$this->db->join('tbl_jenis_biaya', 'tbl_jenis_biaya.id_jb = tbl_sub_biaya.id_jb');

		$result = $this->db->get();
		return $result;
	}

	public function tampil_sub_biaya_where($tbl, $where){
		$this->db->select('tbl_sub_biaya.*, tbl_jenis_biaya.*');
		$this->db->from($tbl);
		$this->db->join('tbl_jenis_biaya', 'tbl_jenis_biaya.id_jb = tbl_sub_biaya.id_jb');
		$this->db->where($where);

		$result = $this->db->get();
		return $result;
	}

	public function simpan_sub_biaya($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_sub_biaya($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_sub_biaya($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// sub biaya relasi
	public function sub_biaya($id_jb, $departemen){

		$sub_biaya="<option value=''>--Pilih Sub Biaya--</pilih>";

		$sub = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE id_jb=$id_jb AND departemen='$departemen'");

		foreach ($sub->result_array() as $data ){
			$sub_biaya.= "<option value='$data[id_sb]'>$data[sub_biaya]</option>";
		}

		return $sub_biaya;

	}


	// sub biaya filter pencarian
	public function sub_biaya_filter($id_jb, $departemen){

		$sub_biaya="<option value=''>--Pilih Sub Biaya--</pilih>";

		$sub = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE id_jb=$id_jb AND departemen='$departemen'");

		foreach ($sub->result_array() as $data ){
			$sub_biaya.= "<option value='$data[sub_biaya]'>$data[sub_biaya]</option>";
		}

		return $sub_biaya;

	}


	// sub biaya inquiry all
	public function sub_biaya_all($id_jb){

		$sub_biaya="<option value=''>--Pilih Sub Biaya--</pilih>";

		$sub = $this->db->query("SELECT * FROM tbl_sub_biaya WHERE id_jb=$id_jb");

		foreach ($sub->result_array() as $data ){
			$sub_biaya.= "<option value='$data[sub_biaya]'>$data[sub_biaya]</option>";
		}

		return $sub_biaya;

	}

	// ....................................................................

	// Ranah Data Level

	public function tampil_level(){
		$result = $this->db->get('tbl_level');
		return $result;
	}

	public function simpan_level($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_level($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_level($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// ....................................................................

	// Ranah Data Relasi Biaya

	public function tampil_relasi(){
		$result = $this->db->get('tbl_relasi_biaya');
		return $result;
	}

	public function simpan_relasi($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_relasi($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_relasi($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// ....................................................................

	// Ranah Data Relasi Sub Biaya

	public function tampil_relasi_sub(){
		$result = $this->db->get('tbl_relasi_sub');
		return $result;
	}

	public function simpan_relasi_sub($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_relasi_sub($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_relasi_sub($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// ....................................................................

	// Ranah Data User

	public function tampil_user(){
		$result = $this->db->query("SELECT * FROM tbl_user WHERE level != 'admin'");
		return $result;
	}

	public function tampil_user_id($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result;
	}

	public function simpan_user($tbl,$data){
		$result = $this->db->insert($tbl,$data);
		return $result;
	}

	public function update_user($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function hapus_user($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// .........................................................................

	// Ranah Pengajuan Biaya

	// Format no_pengajuan : BY-006-00001  -- Baru : BY/000-01/2020/00001
	public function nopeng_otomatis($kode_cabang, $kode_dept){
		$tahun = date('Y');
		$result = $this->db->query(
			"SELECT MAX(MID(nomor_pengajuan,16,5)) AS nopeng_otomatis
			FROM tbl_pengajuan
			WHERE MID(nomor_pengajuan,4,3) = $kode_cabang AND MID(nomor_pengajuan,8,2) = $kode_dept
			AND MID(nomor_pengajuan,11,4) = $tahun "
		);

		if($result->num_rows() > 0){
			$row = $result->row_array();
			$n = ((int)$row['nopeng_otomatis'] + 1);
			$no = sprintf("%'.05d", $n);
		}else{
			$no = "00001";
		}

		date_default_timezone_set("Asia/Jakarta");
		$nopeng = "BY/".$kode_cabang.'-'.$kode_dept.'/'.$tahun.'/'.$no;
		return $nopeng;
	}

	// Format ref_no : 000 01 2020 00001
	public function ref_no($kode_cabang, $kode_dept){
		$tahun = date('Y');
		$result = $this->db->query(
			"SELECT MAX(MID(nomor_pengajuan,16,5)) AS nopeng_otomatis
			FROM tbl_pengajuan
			WHERE MID(nomor_pengajuan,4,3) = $kode_cabang AND MID(nomor_pengajuan,8,2) = $kode_dept
			AND MID(nomor_pengajuan,11,4) = $tahun "
		);

		if($result->num_rows() > 0){
			$row = $result->row_array();
			$n = ((int)$row['nopeng_otomatis'] + 1);
			$no = sprintf("%'.05d", $n);
		}else{
			$no = "00001";
		}

		date_default_timezone_set("Asia/Jakarta");
		$ref_no = $kode_cabang.$kode_dept.$tahun.$no;
		return $ref_no;
	}


	public function simpan_pengajuan($tbl, $data){
		$result = $this->db->insert($tbl, $data);
		return $result;
	}

	public function update_pengajuan($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	public function simpan_approve_history($tbl, $data){
		$result = $this->db->insert($tbl, $data);
		return $result;
	}

	public function hapus_pengajuan($tbl, $where){
		$result = $this->db->delete($tbl, $where);
		return $result;
	}

	// Pengajuan On Proccess Cabang
	public function tampil_onproccess($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'on proccess' AND approved_by='' AND cabang='$cabang' AND bagian='$bagian' OR
			status_approve = 'approved' AND approved_by='kacab' AND cabang='$cabang' AND bagian='$bagian' OR
			status_approve = 'approved' AND approved_by='kawil' AND cabang='$cabang' AND bagian='$bagian' OR
			status_approve = 'approved' AND approved_by='dept head pic' AND cabang='$cabang' AND bagian='$bagian' OR
			status_approve = 'approved' AND approved_by='division head' AND cabang='$cabang' AND bagian='$bagian' OR
			status_approve = 'approved' AND approved_by='director pengaju' AND cabang='$cabang' AND bagian='$bagian' OR
			status_approve = 'approved' AND approved_by='director' AND cabang='$cabang' AND bagian='$bagian' OR
			status_approve = 'approved' AND approved_by='director finance' AND cabang='$cabang' AND bagian='$bagian'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan On Proccess HO
	public function tampil_onproccessHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'on proccess' AND approved_by='' AND bagian='$dept' OR
			status_approve = 'approved' AND approved_by='dept head' AND bagian='$dept' OR
			status_approve = 'approved' AND approved_by='division head' AND bagian='$dept' OR
			status_approve = 'approved' AND approved_by='dept head pic' AND bagian='$dept' OR
			status_approve = 'approved' AND approved_by='director' AND bagian='$dept' OR
			status_approve = 'approved' AND approved_by='director pengaju' AND bagian='$dept' OR
			status_approve = 'approved' AND approved_by='director finance' AND bagian='$dept'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan On Proccess Cabang Penyelesaian
	public function tampil_onproccess2($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'On Proccess' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='kacab' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='kawil' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head pic' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='division head' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director pengaju' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director finance' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian'
			ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan On Proccess HO Penyelesaian
	public function tampil_onproccessHO2($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'on proccess' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='' AND tbl_pengajuan.bagian='$dept' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head' AND tbl_pengajuan.bagian='$dept' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='division head' AND tbl_pengajuan.bagian='$dept' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head pic' AND tbl_pengajuan.bagian='$dept' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director' AND tbl_pengajuan.bagian='$dept' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director pengaju' AND tbl_pengajuan.bagian='$dept' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director finance' AND tbl_pengajuan.bagian='$dept'
			ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Inquiry Cabang
	public function inquiry($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			cabang='$cabang' AND bagian='$bagian'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Inquiry HO
	public function inquiryHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			bagian='$dept'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Inquiry All
	public function inquiryAll($hari_ini){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE tanggal='$hari_ini' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Cancel Cabang
	public function tampil_cancel($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'cancel' AND cabang='$cabang' AND bagian='$bagian'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Cancel HO
	public function tampil_cancelHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'cancel' AND bagian='$dept'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Gagal Cabang
	public function tampil_gagal($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'over budget' AND approved_by='' AND cabang='$cabang' AND bagian='$bagian'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Gagal HO
	public function tampil_gagalHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'over budget' AND approved_by='' AND bagian='$dept'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tambah Dokumen Cabang
	public function tampil_tamdok($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			tambah_dokumen = 'ya' AND cabang='$cabang' AND bagian='$bagian'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tambah Dokumen HO
	public function tampil_tamdokHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			tambah_dokumen = 'ya' AND bagian='$dept'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tambah Revisi Finance Cabang
	public function tampil_refin($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			revisi_finance = 'ya' AND dept_tujuan='$cabang'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tambah Revisi Finance HO
	public function tampil_refinHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			revisi_finance = 'ya' AND dept_tujuan='$dept'
			ORDER BY id_pengajuan DESC");
		return $result;
	}


	// Tambah Revisi Rekening Finance Cabang
	public function tampil_refrek($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			revisi_rekening = 'ya' AND dept_tujuan='$cabang'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tambah Revisi Rekening Finance HO
	public function tampil_refrekHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			revisi_rekening = 'ya' AND dept_tujuan='$dept'
			ORDER BY id_pengajuan DESC");
		return $result;
	}


	// Pengajuan Rejected Cabang
	public function tampil_rejected($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'rejected' AND cabang='$cabang' AND bagian='$bagian' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Rejected HO
	public function tampil_rejectedHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'rejected' AND bagian='$dept' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Rejected Cabang Penyelesaian
	public function tampil_rejected2($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'rejected' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Rejected HO Penyelesaian
	public function tampil_rejectedHO2($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'rejected' AND tbl_pengajuan.bagian='$dept' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Revisi Cabang
	public function tampil_revisi($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'revisi' AND cabang='$cabang' AND bagian='$bagian' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Revisi HO
	public function tampil_revisiHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'revisi' AND bagian='$dept' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Revisi Cabang Penyelesaian
	public function tampil_revisi2($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'revisi' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Revisi HO Penyelesaian
	public function tampil_revisiHO2($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'revisi' AND tbl_pengajuan.bagian='$dept' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Pending Dokumen Cabang
	public function tampil_pendok($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved'  AND status_check='Checked' AND status_dokumen='' AND cabang='$cabang' AND bagian='$bagian' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Pending Dokumen HO
	public function tampil_pendokHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND status_check='Checked' AND status_dokumen='' AND bagian='$dept' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Dokumen Lengkap Cabang
	public function tampil_lendok($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND status_dokumen='done' AND cabang='$cabang' AND bagian='$bagian' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Dokumen Lengkap HO
	public function tampil_lendokHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND status_dokumen='done' AND bagian='$dept' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Dokumen Lengkap Accounting Cabang
	public function tampil_accdok($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND status_dokumen='done acc' AND cabang='$cabang' AND bagian='$bagian' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Dokumen Lengkap Accounting HO
	public function tampil_accdokHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND status_dokumen='done acc' AND bagian='$dept' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Telah Dibayar Cabang
	public function tampil_telbay($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND status_bayar='Telah Dibayar' AND cabang='$cabang' AND bagian='$bagian' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Telah Dibayar HO
	public function tampil_telbayHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND status_bayar='Telah Dibayar' AND bagian='$dept' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Approved Cabang (All)
	public function tampil_approved($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' OR
			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' OR
			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Approved HO (All)
	public function tampil_approvedHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'final approved' AND bagian='$dept' OR
			status_approve = 'final approved' AND bagian='$dept' 
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Approved Cabang Penyelesaian (All)
	public function tampil_approved2($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'final approved' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'final approved' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'final approved' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian'
			ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Approved HO Penyelesaian (All)
	public function tampil_approvedHO2($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'final approved' AND tbl_pengajuan.bagian='$dept' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'final approved' AND tbl_pengajuan.bagian='$dept' 
			ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Approved Cabang (Saat Proses Check Oleh PIC)
	public function tampil_approved_lv1($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_check='' AND checked_by='' OR

			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_check='' AND checked_by='' OR

			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_check='' AND checked_by=''

			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Approved HO ((Saat Proses Check Oleh PIC))
	public function tampil_approvedHO_lv1($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'final approved' AND bagian='$dept' AND status_check='' AND checked_by='' OR

			status_approve = 'final approved' AND bagian='$dept' AND status_check='' AND checked_by=''

			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Approved Cabang (Saat Di Pending Oleh PIC)
	public function tampil_approved_lv2($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_check='Pending' OR

			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_check='Pending' OR

			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_check='Pending' 

			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Approved HO ((Saat Di Pending Oleh PIC))
	public function tampil_approvedHO_lv2($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'final approved' AND bagian='$dept' AND status_check='Pending' OR

			status_approve = 'final approved' AND bagian='$dept' AND status_check='Pending'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Pending Penyelesaian Cabang (Saat Di Pending Oleh PIC)
	public function tampil_pending_penyelesaian($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'final approved' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' AND tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='Pending'
			ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Pending Penyelesaian HO ((Saat Di Pending Oleh PIC))
	public function tampil_pending_penyelesaianHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'final approved' AND tbl_pengajuan.bagian='$dept' AND tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='Pending'
			ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Pending Penyelesaian Kelebihan Biaya Cabang (Saat Di Pending Oleh PIC)
	public function tampil_pending_penyelesaian2($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' AND tbl_penyelesaian_kelebihan.status_verifikasi_penyelesaian='Pending'
			ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Pending Penyelesaian Kelebihan Biaya HO ((Saat Di Pending Oleh PIC))
	public function tampil_pending_penyelesaianHO2($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE
			tbl_pengajuan.bagian='$dept' AND tbl_penyelesaian_kelebihan.status_verifikasi_penyelesaian='Pending'
			ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Verified Penyelesaian Cabang (Saat Di Verifikasi Oleh PIC)
	public function tampil_verified_penyelesaian($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'final approved' AND tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' AND tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='Verified'
			ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Verified Penyelesaian HO ((Saat Di Verifikasi Oleh PIC))
	public function tampil_verified_penyelesaianHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian = 'final approved' AND tbl_pengajuan.bagian='$dept' AND tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='Verified'
			ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Verified Penyelesaian Kelebihan Cabang (Saat Di Verifikasi Oleh PIC)
	public function tampil_verified_penyelesaian2($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' AND tbl_penyelesaian_kelebihan.status_verifikasi_penyelesaian='Verified By PIC'
			ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Verified Penyelesaian Kelebihan HO ((Saat Di Verifikasi Oleh PIC))
	public function tampil_verified_penyelesaianHO2($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE
			tbl_pengajuan.bagian='$dept' AND tbl_penyelesaian_kelebihan.status_verifikasi_penyelesaian='Verified By PIC'
			ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC");
		return $result;
	}

	// Pengajuan Approved Cabang (Saat Di Setujui (Checked) Oleh PIC)
	public function tampil_approved_lv3($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_check='Checked' AND status_bayar='' OR

			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_check='Checked' AND status_bayar='' OR

			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_check='Checked' AND status_bayar=''

			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Approved HO ((Saat Di Setujui (Checked) Oleh PIC))
	public function tampil_approvedHO_lv3($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'final approved' AND bagian='$dept' AND status_check='Checked' AND status_bayar='' OR

			status_approve = 'final approved' AND bagian='$dept' AND status_check='Checked' AND status_bayar=''
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Approved Cabang (Saat Di Setujui (Bayar) Oleh Finance)
	public function tampil_approved_lv4($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_bayar='Proses Bayar' OR

			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_bayar='Proses Bayar' OR

			status_approve = 'final approved' AND cabang='$cabang' AND bagian='$bagian' AND status_bayar='Proses Bayar' 

			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Pengajuan Approved HO (Saat Di Setujui (Bayar) Oleh Finance)
	public function tampil_approvedHO_lv4($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'final approved' AND bagian='$dept' AND status_bayar='Proses Bayar' OR

			status_approve = 'final approved' AND bagian='$dept' AND status_bayar='Proses Bayar'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tampil Pengajuan Di Review (Untuk Dept PIC)
	public function tampil_review($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'final approved' AND dept_tujuan='$dept' AND status_check=''
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tampil Pengajuan Di Review (Untuk Dept HEAD)
	public function tampil_review_head($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'final approved' AND dept_tujuan='$dept' AND status_check='Checked' AND checked_level='PIC'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tampil Pengajuan Setujui Dibayar (Cuma Tampil Di Finance)
	public function tampil_bayar(){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_check='Checked' AND status_bayar='' ");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$this->db->where("tbl_pengajuan.status_check ='Checked'");
		$this->db->where("tbl_pengajuan.balik_lagi != 'Ya'");
		$this->db->where("tbl_pengajuan.revisi_finance != 'Ya'");
		$this->db->where("tbl_bayar.status_bayar = 'On Proccess' ");
		$this->db->order_by('tbl_bayar.tanggal_minta_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	public function tampil_bayar_penyelesaian(){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='Verified' AND tbl_penyelesaian_kekurangan.status_bayar_penyelesaian=''");
		return $result;
	}

	public function tampil_bayar_penyelesaian2(){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.status_bayar_penyelesaian='Proses Bayar'");
		return $result;
	}

	public function tampil_bayar_filter($tanggal_from, $tanggal_to, $nama_bank){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_check='Checked' AND status_bayar='' ");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$this->db->where("tbl_pengajuan.status_check ='Checked'");
		$this->db->where("tbl_pengajuan.balik_lagi != 'Ya'");
		$this->db->where("tbl_pengajuan.revisi_finance != 'Ya'");
		$this->db->where("tbl_bayar.status_bayar = 'On Proccess' ");
		$where_lagi = "(tbl_bayar.tanggal_minta_bayar BETWEEN '$tanggal_from' AND '$tanggal_to')";
		$where_lagi2 = "bank_penerima = '$nama_bank'";
		$this->db->where($where_lagi);
		$this->db->where($where_lagi2);

		$this->db->order_by('tbl_bayar.tanggal_minta_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	// Tampil Pengajuan Harus Dibayar Detail(Cuma Tampil Di Finance)
	public function tampil_bayar_detail($id){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_check='Checked' AND status_bayar='' ");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$this->db->where("tbl_bayar.id = '$id' ");
		$result = $this->db->get();

		return $result;
	}

	// Tampil All Pengajuan (Untuk Accounting)
	public function tampil_all(){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar' ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tampil Detail Pengajuan (Bisa Dipanggil Dimana Aja)
	public function tampil_pengajuan_detail($id){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE id_pengajuan=$id");
		return $result;
	}

	// Tampil Pengajuan By Tanggal (Bisa Dipanggil Dimana Aja)
	public function tampil_pengajuan_tanggal($tanggal){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE tanggal_proses_bayar='$tanggal' AND status_bayar='Proses Bayar' OR tanggal_proses_bayar='$tanggal' AND status_bayar='Telah Dibayar'");
		return $result;
	}

	// Tampil Pengajuan By Tanggal (Bisa Dipanggil Jurnal Finance)
	public function tampil_pengajuan_tanggal_jfin($tanggal){
		$result = $this->db->query("SELECT 
		tbl_pengajuan.ref_no, 
		tbl_pengajuan.cabang, 
		tbl_pengajuan.tanggal_bayar AS tanggal_bayar_utama,
		tbl_bayar.tanggal_bayar AS tanggal_bayar_split,
		tbl_bayar.nomor_pengajuan,
		tbl_pengajuan.jumlah,
		tbl_pengajuan.ppn,
		tbl_pengajuan.pph23,
		tbl_pengajuan.pph42,
		tbl_pengajuan.pph21,
		tbl_bayar.jumlah_bayar,
		tbl_bayar.ppn_bayar,
		tbl_bayar.pph23_bayar,
		tbl_bayar.pph42_bayar,
		tbl_bayar.pph21_bayar,
		tbl_bayar.bank_bayar

		FROM tbl_bayar INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_bayar.tanggal_bayar='$tanggal' AND tbl_bayar.status_bayar='Telah Dibayar'
		");
		return $result;
	}

	// Tampil File/Berkas Pendukung (Bisa Dipanggil Dimana Aja)
	public function tampil_file($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result;
	}

	// Tiap Kali Ada Pengajuan / Approval Bisa Dipanggil
	public function tampil_approve_history($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result;
	}

	// Tampil Data Check Dari PIC Dept
	public function tampil_check_no($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result;
	}

	// Tampil Data Bayar Dari Finance Dept
	public function tampil_bayar_no($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result;
	}

	// Tampil History Pengajuan Masuk (By Departemen)
	public function history_pengajuan_dept($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE dept_tujuan='$dept' 
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tampil History pengajuan cencel (By Departemen)
	public function tampil_review_cancel($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'cancel' AND dept_tujuan='$dept' OR status_approve = 'cancel by request' AND dept_tujuan='$dept'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tampil History pengajuan reject (By Departemen)
	public function tampil_review_reject($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'rejected' AND dept_tujuan='$dept'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tampil Pendingan Dokumen Pengajuan Masuk (By Departemen)
	public function pendingan_dokumen($dept){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'final approved' AND dept_tujuan='$dept' AND status_dokumen=''
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tampil Cek Audit
	public function tampil_cek_audit(){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
			status_approve = 'final approved'
			ORDER BY id_pengajuan DESC");
		return $result;
	}

	// Tampil Data Perjalanan Dinas
	public function tampil_perdin($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result;
	}

	// Ambil Limit Approve By Level Yang Login
	public function ambil_limit($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result;
	}

	// (INBOX KACAB)
	public function tampil_inbox_kacab($cabang){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			level_pengaju='ADCO' AND cabang='$cabang' AND status_approve='on proccess' OR
			level_pengaju='ADCOLL' AND cabang='$cabang' AND status_approve='on proccess' OR
			level_pengaju='CMC' AND cabang='$cabang' AND status_approve='on proccess' OR
			level_pengaju='ADD-CABANG' AND cabang='$cabang' AND status_approve='on proccess'
		");
		return $result;
	}

	// (INBOX KACAB PENYELESAIAN)
	public function tampil_inbox_kacab2($cabang){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			(tbl_pengajuan.level_pengaju='ADCO' OR tbl_pengajuan.level_pengaju='ADCOLL' OR tbl_pengajuan.level_pengaju='CMC' OR tbl_pengajuan.level_pengaju='ADD-CABANG') AND tbl_pengajuan.cabang='$cabang' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='On Proccess'
		");
		return $result;
	}

	// (INBOX KAWIL)
	public function tampil_inbox_kawil($wilayah){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			level_pengaju='ADCO' AND wilayah='$wilayah' AND status_approve='approved' AND approved_by='kacab' OR
			level_pengaju='ADCOLL' AND wilayah='$wilayah' AND status_approve='approved' AND approved_by='kacab' OR
			level_pengaju='CMC' AND wilayah='$wilayah' AND status_approve='approved' AND approved_by='kacab' OR
			level_pengaju='ADD-CABANG' AND wilayah='$wilayah' AND status_approve='approved' AND approved_by='kacab'
		");
		return $result;
	}

	// (INBOX KAWIL PENYELESAIAN)
	public function tampil_inbox_kawil2($wilayah){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			(tbl_pengajuan.level_pengaju='ADCO' OR tbl_pengajuan.level_pengaju='ADCOLL' OR tbl_pengajuan.level_pengaju='CMC' OR tbl_pengajuan.level_pengaju='ADD-CABANG') AND tbl_pengajuan.wilayah='$wilayah' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='kacab'
		");
		return $result;
	}

	// (INBOX DEPT HEAD)
	public function tampil_inbox_kadept($departemen, $nama_lengkap, $jabatan_khusus){
		$departemen = $this->libraryku->tampil_user()->departemen;

		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			-- sebagai departemen tujuan
			level_pengaju='ADCO' AND dept_tujuan='$departemen' AND status_approve='approved' AND approved_by='kawil' OR
			level_pengaju='ADCOLL' AND dept_tujuan='$departemen' AND status_approve='approved' AND approved_by='kawil' AND jalur_khusus='$jabatan_khusus' OR
			level_pengaju='CMC' AND dept_tujuan='$departemen' AND status_approve='approved' AND approved_by='kawil' OR
			level_pengaju='ADD-CABANG' AND dept_tujuan='$departemen' AND status_approve='approved' AND approved_by='kawil' OR

			level_pengaju='Departement PIC' AND status_approve='approved' AND approved_by='dept head' AND kadiv_tujuan='' AND bagian!='$departemen' AND dept_tujuan='$departemen' OR
			level_pengaju='Departement PIC' AND status_approve='approved' AND approved_by='division head' AND kadiv_tujuan!='' AND bagian!='$departemen' AND dept_tujuan='$departemen' OR
			level_pengaju='Departement PIC' AND status_approve='approved' AND approved_by='division head' AND kadiv_asal!='' AND bagian!='$departemen' AND dept_tujuan='$departemen' OR

			-- sebagai departemen asal
			level_pengaju='Departement PIC' AND bagian='$departemen' AND status_approve='on proccess' OR

			-- jika balik lagi
			status_approve='final approved' AND nama_pengapprove='$nama_lengkap' AND balik_lagi='Ya' AND dept_tujuan='$departemen'

		");
		return $result;
	}


	// (INBOX DEPT HEAD Penyelesaian)
	public function tampil_inbox_kadept2($departemen, $nama_lengkap){
		$departemen = $this->libraryku->tampil_user()->departemen;

		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			-- sebagai departemen tujuan
			(tbl_pengajuan.level_pengaju='ADCO' OR tbl_pengajuan.level_pengaju='ADCOLL' OR tbl_pengajuan.level_pengaju='CMC' OR tbl_pengajuan.level_pengaju='ADD-CABANG') AND tbl_pengajuan.dept_tujuan='$departemen' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='kawil' OR

			tbl_pengajuan.level_pengaju='Departement PIC' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head' AND tbl_pengajuan.kadiv_tujuan='' AND tbl_pengajuan.bagian!='$departemen' AND tbl_pengajuan.dept_tujuan='$departemen' OR

			tbl_pengajuan.level_pengaju='Departement PIC' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='division head' AND tbl_pengajuan.kadiv_tujuan!='' AND tbl_pengajuan.bagian!='$departemen' AND tbl_pengajuan.dept_tujuan='$departemen' OR

			tbl_pengajuan.level_pengaju='Departement PIC' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='division head' AND tbl_pengajuan.kadiv_asal!='' AND tbl_pengajuan.bagian!='$departemen' AND tbl_pengajuan.dept_tujuan='$departemen' OR

			-- sebagai departemen asal
			tbl_pengajuan.level_pengaju='Departement PIC' AND tbl_pengajuan.bagian='$departemen' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='On Proccess'

			-- jika balik lagi
			-- tbl_penyelesaian_kekurangan.status_approve_penyelesaian='final approved' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian='$nama_lengkap' AND balik_lagi='Ya' AND dept_tujuan='$departemen'

		");
		return $result;
	}

	// (INBOX KADIV atau DIVISION HEAD)
	public function tampil_inbox_kadiv($kadiv){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve='approved' AND approved_by='dept head' AND kadiv_tujuan='$kadiv' AND nama_pengapprove!='$kadiv' OR
			status_approve='approved' AND approved_by='dept head pic' AND kadiv_tujuan='$kadiv' AND nama_pengapprove!='$kadiv' OR

			status_approve='approved' AND approved_by='dept head' AND kadiv_asal='$kadiv' AND nama_pengapprove!='$kadiv' OR
			status_approve='approved' AND approved_by='dept head pic' AND kadiv_asal='$kadiv' AND nama_pengapprove!='$kadiv' OR

			-- balik lagi
			status_approve='final approved' AND nama_pengapprove='$kadiv' AND balik_lagi='Ya'

			"); // nama_pengapprove != '$director supaya saat sudah approve, memo nya hilang dari inbox'
		return $result;
	}


	// (INBOX KADIV PENYELESAIAN)
	public function tampil_inbox_kadiv2($kadiv){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head' AND tbl_penyelesaian_kekurangan.kadiv_tujuan_penyelesaian='$kadiv' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$kadiv' OR

			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head pic' AND tbl_penyelesaian_kekurangan.kadiv_tujuan_penyelesaian='$kadiv' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$kadiv' OR

			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head' AND tbl_pengajuan.kadiv_asal='$kadiv' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$kadiv' OR

			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head pic' AND tbl_pengajuan.kadiv_asal='$kadiv' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$kadiv'

			-- balik lagi
			-- status_approve='final approved' AND nama_pengapprove='$kadiv' AND balik_lagi='Ya'

			"); // nama_pengapprove != '$director supaya saat sudah approve, memo nya hilang dari inbox'
		return $result;
	}


	// (INBOX DIRECTOR)
	public function tampil_inbox_director($director){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			-- sebagai direktur asal (pengajuan pusat)
			status_approve='approved' AND approved_by='dept head pic' AND direktur_asal='$director' AND nama_pengapprove!='$director' AND kadiv_tujuan='' OR

			status_approve='approved' AND approved_by='division head' AND direktur_asal='$director' AND nama_pengapprove!='$director' AND kadiv_tujuan!='' OR

			-- sebagai direktur tujuan (pengajuan pusat)
			status_approve='approved' AND approved_by='director pengaju' AND direktur_tujuan='$director' AND nama_pengapprove!='$director' OR

			-- sebagai direktur tujuan (pengajuan cabang)
			status_approve='approved' AND approved_by='dept head pic' AND kadiv_tujuan='' AND direktur_asal='' AND direktur_tujuan='$director' AND nama_pengapprove!='$director' OR
			status_approve='approved' AND approved_by='division head' AND kadiv_tujuan!='' AND direktur_asal='' AND direktur_tujuan='$director' AND nama_pengapprove!='$director' OR

			-- khusus audit
			status_approve='approved' AND approved_by='dept head pic' AND direktur_tujuan='$director' AND nama_pengapprove!='$director' AND kadiv_tujuan='' AND bagian='INTERNAL AUDIT' OR
			
			-- balik lagi
			status_approve='final approved' AND approved_by='director' AND nama_pengapprove='$director' AND direktur_tujuan='$director' AND balik_lagi='Ya'
		"); // nama_pengapprove != '$director supaya saat sudah approve, memo nya hilang dari inbox'
		return $result;
	}


	// (INBOX DIRECTOR PENYELESAIAN)
	public function tampil_inbox_director2($director){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			-- sebagai direktur asal (pengajuan pusat)
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head pic' AND tbl_pengajuan.direktur_asal='$director' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$director' AND tbl_penyelesaian_kekurangan.kadiv_tujuan_penyelesaian='' OR

			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='division head' AND tbl_pengajuan.direktur_asal='$director' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$director' AND tbl_penyelesaian_kekurangan.kadiv_tujuan_penyelesaian!='' OR

			-- sebagai direktur tujuan (pengajuan pusat)
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director pengaju' AND tbl_penyelesaian_kekurangan.direktur_tujuan_penyelesaian='$director' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$director' OR

			-- sebagai direktur tujuan (pengajuan cabang)
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head pic' AND tbl_penyelesaian_kekurangan.kadiv_tujuan_penyelesaian='' AND tbl_pengajuan.direktur_asal='' AND tbl_penyelesaian_kekurangan.direktur_tujuan_penyelesaian='$director' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$director' OR

			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='division head' AND tbl_penyelesaian_kekurangan.kadiv_tujuan_penyelesaian!='' AND tbl_pengajuan.direktur_asal='' AND tbl_penyelesaian_kekurangan.direktur_tujuan_penyelesaian='$director' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$director' OR

			-- khusus audit
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='dept head pic' AND tbl_penyelesaian_kekurangan.direktur_tujuan_penyelesaian='$director' AND tbl_penyelesaian_kekurangan.nama_pengapprove_penyelesaian!='$director' AND tbl_penyelesaian_kekurangan.kadiv_tujuan_penyelesaian='' AND tbl_pengajuan.bagian='INTERNAL AUDIT'
			
			-- balik lagi
			-- status_approve='final approved' AND direktur_tujuan='$director' AND balik_lagi='Ya'

		"); // nama_pengapprove != '$director supaya saat sudah approve, memo nya hilang dari inbox'
		return $result;
	}


	// (INBOX DIRECTOR FINANCE)
	public function tampil_inbox_director_finance($director){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve='approved' AND approved_by='director' AND bagian!='INTERNAL AUDIT' OR
			-- balik lagi
			status_approve='final approved' AND approved_by='director finance' AND nama_pengapprove='$director' AND direktur_tujuan='$director' AND balik_lagi='Ya'
		"); // nama_pengapprove != '$director supaya saat sudah approve, memo nya hilang dari inbox'
		return $result;
	}

	// (INBOX DIRECTOR FINANCE PENYELESAIAN)
	public function tampil_inbox_director_finance2($director){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director' AND tbl_pengajuan.bagian!='INTERNAL AUDIT'
		"); // nama_pengapprove != '$director supaya saat sudah approve, memo nya hilang dari inbox'
		return $result;
	}

	// (INBOX PRESIDENT DIRECTOR)
	public function tampil_inbox_presdir(){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			status_approve='approved' AND approved_by='director finance' OR
			status_approve='approved' AND approved_by='director' AND bagian='INTERNAL AUDIT' OR

			-- balik lagi
			status_approve='final approved' AND approved_by='president director' AND balik_lagi='Ya'
		"); // nama_pengapprove != '$director supaya saat sudah approve, memo nya hilang dari inbox'
		return $result;
	}

	// (INBOX PRESIDENT DIRECTOR PENYELESAIAN)
	public function tampil_inbox_presdir2(){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE 
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director finance' OR
			tbl_penyelesaian_kekurangan.status_approve_penyelesaian='approved' AND tbl_penyelesaian_kekurangan.approved_by_penyelesaian='director' AND tbl_pengajuan.bagian='INTERNAL AUDIT'
		"); // nama_pengapprove != '$director supaya saat sudah approve, memo nya hilang dari inbox'
		return $result;
	}

	// Approve Pengajuan
	public function approve_pengajuan($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}

	// Ranah Budget................................................................................

	// Tampil Budget
	public function tampil_budget($cabang,$dept){
		$result = $this->db->query("SELECT * FROM tbl_budget WHERE 
			cabang='$cabang' AND departemen='$dept'");
		return $result;
	}

	// Tampil Budget Admin
	public function tampil_budget_admin(){
		$result = $this->db->query("SELECT DISTINCT cabang, departemen FROM tbl_budget");
		return $result;
	}

	// Update Budget
	public function update_budget($tbl, $data, $where){
		$result = $this->db->update($tbl, $data, $where);
		return $result;
	}



	// Ranah Tampil Pending History ...............................................................

	public function tampil_pending_history($tbl, $where){
		$result = $this->db->get_where($tbl, $where);
		return $result;
	}

	// Ranah Tampil Pengajuan Dipilih..............................................................

	public function pengajuan_dipilih($where){
		// $result = $this->db->get_where($tbl, $where);

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$this->db->where($where);
		$result = $this->db->get();

		return $result;
	}

	// Ranah Tampil Pilih Cetak..............................................................

	public function pilih_cetak($where){
		// $result = $this->db->get_where($tbl, $where);

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$this->db->where("tbl_bayar.status_bayar = 'Proses Bayar'");
		$this->db->where($where);
		$this->db->where("revisi_rekening != 'ya'");
		$result = $this->db->get();

		return $result;
	}

	public function total_cetak($where){
		// $result = $this->db->get_where($tbl, $where);

		$this->db->select('
			SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - (tbl_pengajuan.pph23 + tbl_pengajuan.pph42 + tbl_pengajuan.pph21)) AS tot_bayar,
			SUM(tbl_bayar.jumlah_bayar + tbl_bayar.ppn_bayar - (tbl_bayar.pph23_bayar + tbl_bayar.pph42_bayar + tbl_bayar.pph21_bayar)) AS tot_bayar_displit
			');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$this->db->where("tbl_bayar.status_bayar = 'Proses Bayar'");
		$this->db->where($where);
		$this->db->where("revisi_rekening != 'ya'");
		$result = $this->db->get();

		return $result;
	}

	// Ranah Tampil Whatsapp Blast.................................................................

	public function tampil_wa_blast(){
		$result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE wa_blast='on'");
		return $result;
	}


	// Ranah Tampil History Bayar...................................................................

	public function tampil_history_bayar(){
		date_default_timezone_set("Asia/Jakarta");
		$sekarang = date('Y-m-d');
		$kurang_30 = mktime(0,0,0,date("n"),date("j")-30, date("Y"));
		$bulan_lalu = date("Y-m-d", $kurang_30);
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Proses Bayar' AND (tbl_pengajuan.tanggal_proses_bayar BETWEEN '$bulan_lalu' AND '$sekarang')";
		$this->db->where($where);
		$this->db->order_by('tbl_bayar.tanggal_rencana_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}


	public function tampil_history_bayar_tanggal($tanggal_from, $tanggal_to){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Proses Bayar' AND (tbl_bayar.tanggal_rencana_bayar BETWEEN '$tanggal_from' AND '$tanggal_to')";
		$this->db->where($where);
		$this->db->order_by('tbl_bayar.tanggal_rencana_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	public function tampil_history_bayar_biaya($sub_biaya){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Proses Bayar' AND tbl_pengajuan.sub_biaya='$sub_biaya'";
		$this->db->where($where);
		$this->db->order_by('tbl_bayar.tanggal_rencana_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	public function tampil_history_bayar_cabang($cabang){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Proses Bayar' AND tbl_pengajuan.cabang='$cabang'";
		$this->db->where($where);
		$this->db->order_by('tbl_bayar.tanggal_rencana_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	public function tampil_history_bayar_departemen($departemen){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Proses Bayar' AND tbl_pengajuan.bagian='$departemen'";
		$this->db->where($where);
		$this->db->order_by('tbl_bayar.tanggal_rencana_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	// Ranah Tampil History Telah Bayar...................................................................

	public function tampil_history_telah_bayar(){
		date_default_timezone_set("Asia/Jakarta");
		$sekarang = date('Y-m-d');
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar, tbl_bayar.bank_bayar AS bnk_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Telah Dibayar' AND tbl_pengajuan.tanggal_bayar='$sekarang'";
		$this->db->where($where);
		$this->db->order_by('tbl_pengajuan.tanggal_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}


	public function tampil_history_telah_bayar_tanggal($tanggal_from, $tanggal_to){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar, tbl_bayar.bank_bayar AS bnk_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Telah Dibayar' AND (tbl_pengajuan.tanggal_bayar BETWEEN '$tanggal_from' AND '$tanggal_to')";
		$this->db->where($where);
		$this->db->order_by('tbl_pengajuan.tanggal_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	public function tampil_history_telah_bayar_biaya($sub_biaya){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar, tbl_bayar.bank_bayar AS bnk_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Telah Dibayar' AND tbl_pengajuan.sub_biaya='$sub_biaya'";
		$this->db->where($where);
		$this->db->order_by('tbl_pengajuan.tanggal_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	public function tampil_history_telah_bayar_cabang($cabang){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar, tbl_bayar.bank_bayar AS bnk_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Telah Dibayar' AND tbl_pengajuan.cabang='$cabang'";
		$this->db->where($where);
		$this->db->order_by('tbl_pengajuan.tanggal_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	public function tampil_history_telah_bayar_departemen($departemen){
		// $result = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar'");

		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar, tbl_bayar.bank_bayar AS bnk_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Telah Dibayar' AND tbl_pengajuan.bagian='$departemen'";
		$this->db->where($where);
		$this->db->order_by('tbl_pengajuan.tanggal_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	// Tampil Bayar Pengajuan (Final)....................................................................
	public function tampil_bayar_final(){
		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Proses Bayar'";
		$this->db->where($where);
		$this->db->where("revisi_rekening != 'ya'");
		$this->db->order_by('tbl_bayar.tanggal_rencana_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	public function tampil_bayar_final_filter($tanggal_from, $tanggal_to, $nama_bank){
		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Proses Bayar'";
		$where_lagi = "(tbl_bayar.tanggal_rencana_bayar BETWEEN '$tanggal_from' AND '$tanggal_to')";
		$where_lagi2 = "bank_penerima = '$nama_bank'";
		$this->db->where($where);
		$this->db->where($where_lagi);
		$this->db->where($where_lagi2);
		$this->db->where("revisi_rekening != 'ya'");
		$this->db->order_by('tbl_bayar.tanggal_rencana_bayar', 'ASC');
		$result = $this->db->get();

		return $result;
	}

	public function tampil_bayar_final_filter2($nomor_pengajuan){
		$this->db->select('tbl_bayar.* , tbl_pengajuan.*, tbl_bayar.status_bayar AS sts_bayar');
		$this->db->from('tbl_bayar');
		$this->db->join('tbl_pengajuan', 'tbl_pengajuan.nomor_pengajuan = tbl_bayar.nomor_pengajuan');
		$where = "tbl_bayar.status_bayar='Proses Bayar'";
		$this->db->where($where);
		$this->db->where($nomor_pengajuan);
		$this->db->where("revisi_rekening != 'ya'");
		$result = $this->db->get();

		return $result;
	}

	// Tampil Jurnal Reverse...........................................................................

	// Tampil Jurnal Reverse
	public function tampil_jurnal_reverse($id){
		$result = $this->db->query("SELECT * FROM tbl_jurnal_reverse WHERE id_pengajuan=$id ORDER BY id DESC");
		return $result;
	}


	// Tampil Nomor Jurnal Otomatis....................................................................

	// Format Nomor Jurnal : JK/BY/101720/0001 JK/BY/10.17.20/0001
	public function nojur_otomatis(){
		$result = $this->db->query(
			"SELECT MAX(MID(nomor_jurnal,16,4)) AS nojur_otomatis
			FROM tbl_pengajuan
			WHERE MID(nomor_jurnal,7,6) = DATE_FORMAT(CURDATE(), '%m%d%y')"
		);

		if($result->num_rows() > 0){
			$row = $result->row_array();
			$n = ((int)$row['nojur_otomatis'] + 1);
			$no = sprintf("%'.04d", $n);
		}else{
			$no = "0001";
		}

		date_default_timezone_set("Asia/Jakarta");
		$nomor_jurnal = "JK/BY/".date('mdy')."/".$no;
		return $nomor_jurnal;
	}


	// Format Nomor Jurnal BMHD : JK/BMHD/101720/0001 JK/BMHD/10.17.20/0001
	public function nojur_bmhd(){
		$result = $this->db->query(
			"SELECT MAX(MID(nomor_bmhd,16,4)) AS nojur_otomatis_bmhd
			FROM tbl_pengajuan
			WHERE MID(nomor_bmhd,9,6) = DATE_FORMAT(CURDATE(), '%m%d%y')"
		);

		if($result->num_rows() > 0){
			$row = $result->row_array();
			$n = ((int)$row['nojur_otomatis_bmhd'] + 1);
			$no = sprintf("%'.04d", $n);
		}else{
			$no = "0001";
		}

		date_default_timezone_set("Asia/Jakarta");
		$nomor_jurnal_bmhd = "JK/BMHD/".date('mdy')."/".$no;
		return $nomor_jurnal_bmhd;
	}

	// Format Nomor Jurnal BMHD Penyelesaian : JK/BMHD-PY/101720/0001 JK/BMHD-PY/10.17.20/0001
	public function nojur_bmhd_penyelesaian(){
		$result = $this->db->query(
			"SELECT MAX(MID(nomor_bmhd_penyelesaian,19,4)) AS nojur_otomatis_bmhd
			FROM tbl_penyelesaian_kekurangan
			WHERE MID(nomor_bmhd_penyelesaian,12,6) = DATE_FORMAT(CURDATE(), '%m%d%y')"
		);

		if($result->num_rows() > 0){
			$row = $result->row_array();
			$n = ((int)$row['nojur_otomatis_bmhd'] + 1);
			$no = sprintf("%'.04d", $n);
		}else{
			$no = "0001";
		}

		date_default_timezone_set("Asia/Jakarta");
		$nomor_jurnal_bmhd = "JK/BMHD-PY/".date('mdy')."/".$no;
		return $nomor_jurnal_bmhd;
	}

	// Format Nomor Jurnal PYMT : JK/PYMT/101720/0001 JK/PYMT/10.17.20/0001
	public function nojur_pymt(){
		$result = $this->db->query(
			"SELECT MAX(MID(nomor_pymt,16,4)) AS nojur_otomatis_pymt
			FROM tbl_pengajuan
			WHERE MID(nomor_pymt,9,6) = DATE_FORMAT(CURDATE(), '%m%d%y')"
		);

		if($result->num_rows() > 0){
			$row = $result->row_array();
			$n = ((int)$row['nojur_otomatis_pymt'] + 1);
			$no = sprintf("%'.04d", $n);
		}else{
			$no = "0001";
		}

		date_default_timezone_set("Asia/Jakarta");
		$nomor_jurnal_pymt = "JK/PYMT/".date('mdy')."/".$no;
		return $nomor_jurnal_pymt;
	}

	// Format Nomor Jurnal PYMT Penyelesaian : JK/PYMT-PY/101720/0001 JK/PYMT-PY/10.17.20/0001
	public function nojur_pymt_penyelesaian(){
		$result = $this->db->query(
			"SELECT MAX(MID(nomor_pymt_penyelesaian,19,4)) AS nojur_otomatis_pymt
			FROM tbl_penyelesaian_kekurangan
			WHERE MID(nomor_pymt_penyelesaian,12,6) = DATE_FORMAT(CURDATE(), '%m%d%y')"
		);

		if($result->num_rows() > 0){
			$row = $result->row_array();
			$n = ((int)$row['nojur_otomatis_pymt'] + 1);
			$no = sprintf("%'.04d", $n);
		}else{
			$no = "0001";
		}

		date_default_timezone_set("Asia/Jakarta");
		$nomor_jurnal_pymt = "JK/PYMT-PY/".date('mdy')."/".$no;
		return $nomor_jurnal_pymt;
	}

	//............................................................................

	// public function ambil_final_approved($departemen){

	// 	$final_approved_by="<option value=''>--Final Approved By--</pilih>";

	// 	$datas = $this->db->query("SELECT nama_lengkap FROM tbl_user WHERE level='Director' AND nama_lengkap 
	// 	IN(SELECT atasan FROM tbl_user WHERE level='Department Head' AND departemen=$departemen)");

	// 	foreach ($datas->result_array() as $data ){
	// 		$final_approved_by.= "<option value='$data[nama_lengkap]'>$data[nama_lengkap]</option>";
	// 	}

	// 	return $final_approved_by;

	// }

	// ...............................................................................

	// Tampil Dashboard Proses Bayar Cabang
	public function tampil_proses_bayar_penyelesaian($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan)
			WHERE tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' AND tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='Verified' AND tbl_penyelesaian_kekurangan.status_bayar_penyelesaian='Proses Bayar'");
		return $result;
	}

	// Tampil Dashboard Proses Bayar HO
	public function tampil_proses_bayar_penyelesaianHO($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan)
			WHERE tbl_pengajuan.bagian='$dept' AND tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='Verified' AND tbl_penyelesaian_kekurangan.status_bayar_penyelesaian='Proses Bayar'");
		return $result;
	}

	// Pengajuan Telah Dibayar Cabang
	public function tampil_telbay2($cabang, $bagian){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan)
			WHERE tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$bagian' AND tbl_penyelesaian_kekurangan.status_bayar_penyelesaian='Telah Dibayar'");
		return $result;
	}

	// Pengajuan Telah Dibayar HO
	public function tampil_telbayHO2($dept){
		$result = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan)
			WHERE tbl_pengajuan.bagian='$dept' AND tbl_penyelesaian_kekurangan.status_bayar_penyelesaian='Telah Dibayar'");
		return $result;
	}

}
