<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_on_proccess extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library('libraryku');
		$this->load->model('M_master');
	}

	public function index()
	{
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$data_onproccess = $this->M_master->tampil_onproccessHO($departemen)->result_array();
			$identitas = $departemen;
		}else{
			$data_onproccess = $this->M_master->tampil_onproccess($cabang, $level)->result_array();
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_onproccess', array('data_onproccess' => $data_onproccess));
		$this->load->view('footer');
	}

	public function hapus(){
		// Kembalikan saldo ke post budget
		$id = $this->input->post('id');
		$res_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE id_pengajuan='$id' ")->row_array();
		$total = $res_pengajuan['total'];
		$cabang = $res_pengajuan['cabang'];
		$departemen = $res_pengajuan['bagian'];
		$sub_biaya = $res_pengajuan['sub_biaya'];
		$tgl_pengajuan = $res_pengajuan['tanggal'];
		$bulan_pengajuan = substr($tgl_pengajuan, 5,2);

		// Update Budget Di Cabang & Dept Ybs
		if($bulan_pengajuan=='08'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					agu20_akhir=(agu20_akhir+$total), agu20_realisasi=(agu20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='09'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					sep20_akhir=(sep20_akhir+$total), sep20_realisasi=(sep20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='10'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					okt20_akhir=(okt20_akhir+$total), okt20_realisasi=(okt20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='11'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					nov20_akhir=(nov20_akhir+$total), nov20_realisasi=(nov20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='12'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					des20_akhir=(des20_akhir+$total), des20_realisasi=(des20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}

		// $result = $this->M_master->hapus_pengajuan('tbl_pengajuan', array('id_pengajuan' => $id));
		$alasan_cancel = $this->input->post('alasan_cancel');
		$result = $this->db->query("UPDATE tbl_pengajuan SET status_approve='cancel', alasan_cancel='$alasan_cancel' WHERE id_pengajuan='$id'");
		if($result>0){
			$this->session->set_flashdata('pesan','Pengajuan Berhasil Di-Cancel/Dibatalkan');
			redirect('P_on_proccess');
		}
	}

	public function hapus_gagal($id){
		// Kembalikan saldo ke post budget
		$res_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE id_pengajuan='$id' ")->row_array();
		$total = $res_pengajuan['total'];
		$cabang = $res_pengajuan['cabang'];
		$departemen = $res_pengajuan['bagian'];
		$sub_biaya = $res_pengajuan['sub_biaya'];
		$tgl_pengajuan = $res_pengajuan['tanggal'];
		$bulan_pengajuan = substr($tgl_pengajuan, 5,2);

		// Update Budget Di Cabang & Dept Ybs
		if($bulan_pengajuan=='08'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					agu20_akhir=(agu20_akhir+$total), agu20_realisasi=(agu20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='09'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					sep20_akhir=(sep20_akhir+$total), sep20_realisasi=(sep20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='10'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					okt20_akhir=(okt20_akhir+$total), okt20_realisasi=(okt20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='11'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					nov20_akhir=(nov20_akhir+$total), nov20_realisasi=(nov20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='12'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					des20_akhir=(des20_akhir+$total), des20_realisasi=(des20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}

		// $result = $this->M_master->hapus_pengajuan('tbl_pengajuan', array('id_pengajuan' => $id));
		$result = $this->db->query("UPDATE tbl_pengajuan SET status_approve='cancel' WHERE id_pengajuan='$id'");
		if($result>0){
			$this->session->set_flashdata('pesan','Pengajuan Berhasil Dibatalkan');
			redirect('home');
		}
	}

	public function detail($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();

		// Untuk Data Split Pembayaran
		$data_byr = $this->db->query("SELECT * FROM tbl_bayar INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->num_rows();

		$data_byr2 = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->result_array();

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		// Tampilkan Data Memo
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}

	public function pengajuan_gagal()
	{
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$data_gagal = $this->M_master->tampil_gagalHO($departemen)->result_array();
			$identitas = $departemen;
		}else{
			$data_gagal = $this->M_master->tampil_gagal($cabang, $level)->result_array();
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_gagal', array('data_gagal' => $data_gagal));
		$this->load->view('footer');
	}

	public function tambah_dokumen()
	{
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$data_tamdok = $this->M_master->tampil_tamdokHO($departemen)->result_array();
			$identitas = $departemen;
		}else{
			$data_tamdok = $this->M_master->tampil_tamdok($cabang, $level)->result_array();
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_tamdok', array('data_tamdok' => $data_tamdok));
		$this->load->view('footer');
	}


	public function tamdok_detail($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_tamdok_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_perdin' => $data_perdin
		));
		$this->load->view('footer');
	}

	public function tambahkan_dokumen(){
		date_default_timezone_set("Asia/Jakarta");
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
		$id_pengajuan = $this->input->post('id');

		// Simpan File Pengajuan
		$hari_ini = date("Y-m-d");

		$folderUpload = "./file_upload/".$hari_ini;

		# periksa apakah folder tersedia
		if (!is_dir($folderUpload)) {
		  # jika tidak maka folder harus dibuat terlebih dahulu
		  mkdir($folderUpload, 0777, $rekursif = true);
		}

		// ref_no diambil untuk nama file nya (pembeda antar pengajuan)
		$refno = $this->input->post('ref_no');
				
		$data = [];
		$count = count($_FILES['files']['name']);
		for($i=0; $i<$count; $i++){
			if(!empty($_FILES['files']['name'][$i])){
				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];

				$config['upload_path'] = $folderUpload;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$config['max_size'] = 0;
				// $config['file_name'] = $_FILES['files']['name'][$i];
				$config['file_name'] = date('Y-m-d').'-'.$refno.'-'.substr(md5(rand()),0,5).'-'.$i;
				// $config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);

				if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$image[$i] = $filename;
					$content = [
						'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
						'file' => $image[$i],
						'nama_file' => $this->input->post('nama_file')[$i]
					];
					$this->M_master->simpan_pengajuan('tbl_pengajuan_file', $content);
				}
			}
		}

		// Update status tambah_dokumen
		$result = $this->M_master->update_pengajuan('tbl_pengajuan',array(
			'tambah_dokumen' => 'dikirim'
		), array('nomor_pengajuan' => $nomor_pengajuan));

		if($result>0){
			$this->session->set_flashdata('pesan','Dokumen Berhasil Diupload');
			redirect('p_on_proccess/tamdok_detail/'.$id_pengajuan);
		}
	}

	public function revisi_finance()
	{
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$data_refin = $this->M_master->tampil_refinHO($departemen)->result_array();
			$identitas = $departemen;
		}else{
			$data_refin = $this->M_master->tampil_refin($cabang, $level)->result_array();
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_refin', array('data_refin' => $data_refin));
		$this->load->view('footer');
	}

	public function refin_detail($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_refin_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_perdin' => $data_perdin
		));
		$this->load->view('footer');
	}

	public function ubah_pajak(){
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
		$id_pengajuan = $this->input->post('id');

		// Update status revisi_finance
		$result = $this->M_master->update_pengajuan('tbl_pengajuan',array(
			'jumlah' => $this->input->post('jumlah'),
			'ppn' => $this->input->post('ppn'),
			'pph23' => $this->input->post('pph23'),
			'pph42' => $this->input->post('pph42'),
			'pph21' => $this->input->post('pph21'),
			'total' => $this->input->post('total'),
			'revisi_finance' => 'telah direvisi'
		), array('nomor_pengajuan' => $nomor_pengajuan));

		if($result>0){
			$this->session->set_flashdata('pesan','Data Pajak Berhasil Direvisi');
			redirect('p_on_proccess/refin_detail/'.$id_pengajuan);
		}
	}


	public function revisi_rekening()
	{
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$data_refrek = $this->M_master->tampil_refrekHO($departemen)->result_array();
			$identitas = $departemen;
		}else{
			$data_refrek = $this->M_master->tampil_refrek($cabang, $level)->result_array();
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_refrek', array('data_refrek' => $data_refrek));
		$this->load->view('footer');
	}

	public function update_rekening(){
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
		$id_pengajuan = $this->input->post('id');

		// Update status revisi_finance
		$result = $this->M_master->update_pengajuan('tbl_pengajuan',array(
			'bank_penerima' => $this->input->post('bank_penerima'),
			'norek_penerima' => $this->input->post('norek_penerima'),
			'atas_nama' => $this->input->post('atas_nama'),
			'revisi_rekening' => '',
			'alasan_revisi_rekening' => ''
		), array('nomor_pengajuan' => $nomor_pengajuan));

		if($result>0){
			$this->session->set_flashdata('pesan','Data Rekening Berhasil Direvisi');
			redirect('p_on_proccess/revisi_rekening');
		}
	}

	public function edit_finance($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		// Untuk Data Split Pembayaran
		$data_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->result_array();
		$frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->num_rows();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_edit_finance', array(
			'data_pengajuan' => $data_pengajuan,
			'data_file' => $data_file,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr
		));
		$this->load->view('footer');
	}


	public function update_finance(){
		date_default_timezone_set("Asia/Jakarta");
		$level = $this->libraryku->tampil_user()->level;

		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
			'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
			'level_pengaju' => $level,
			'dept_tujuan' => $this->input->post('dept_tujuan'),
			'cabang' => $this->input->post('cabang'),
			'wilayah' => $this->input->post('wilayah'),
			'bagian' => $this->input->post('bagian'),
			'jenis_biaya' => $this->input->post('jenis_biaya'),
			'sub_biaya' => $this->input->post('sub_biaya'),
			'nomor_invoice' => $this->input->post('nomor_invoice'),
			'keterangan' => $this->input->post('keterangan'),
			'jumlah' => $this->input->post('jumlah'),
			'ppn' => $this->input->post('ppn'),
			'pph23' => $this->input->post('pph23'),
			'total' => $this->input->post('total'),
			'bank_penerima' => $this->input->post('bank_penerima'),
			'norek_penerima' => $this->input->post('norek_penerima'),
			'atas_nama' => $this->input->post('atas_nama'),
			'revisi_finance' => '',
			'ket_refin' => ''
		), array('id_pengajuan' => $this->input->post('id')));

		if($result>0){

			// Simpan File Pengajuan
			$data = [];
			$count = count($_FILES['files']['name']);
			for($i=0; $i<$count; $i++){
				if(!empty($_FILES['files']['name'][$i])){
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = './file_upload';
					$config['allowed_types'] = 'jpg|png|jpeg|pdf';
					$config['max_size'] = 2048;
					// $config['file_name'] = $_FILES['files']['name'][$i];
					$config['file_name'] = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10).'-'.$i;
					// $config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						$image[$i] = $filename;
						$content = [
							'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
							'file' => $image[$i],
							'nama_file' => $this->input->post('nama_file')[$i]
						];
						$this->M_master->simpan_pengajuan('tbl_pengajuan_file', $content);
					}
				}
			}

			$this->session->set_flashdata('pesan','Pengajuan Biaya Telah Diperbaiki & Akan Diproses Kembali');
			redirect('P_on_proccess');
		}
	}


	public function revisi_invoice()
	{
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$data_revInv = $this->db->query("SELECT * FROM tbl_pengajuan WHERE revisi_noinv = 'ya' AND bagian='$departemen'")->result_array();
			$identitas = $departemen;
		}else{
			$data_revInv = $this->db->query("SELECT * FROM tbl_pengajuan WHERE revisi_noinv = 'ya' AND cabang='$cabang' AND bagian='$level'")->result_array();
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_revinv', array('data_revInv' => $data_revInv));
		$this->load->view('footer');
	}

	public function revisi_invoice_detail($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_revinv_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_perdin' => $data_perdin
		));
		$this->load->view('footer');
	}

	public function revisi_invoice_v($id, $page){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_revisi_invoice', array(
			'data_pengajuan' => $data_pengajuan,
			'page' => $page
		));
		$this->load->view('footer');
	}

	public function update_invoice(){
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
		$id_pengajuan = $this->input->post('id_pengajuan');
		$page = $this->input->post('page');

		// Update status revisi_finance
		$result = $this->M_master->update_pengajuan('tbl_pengajuan',array(
			'nomor_invoice' => $this->input->post('nomor_invoice'),
			'revisi_noinv' => ''
		), array('nomor_pengajuan' => $nomor_pengajuan));

		if($result>0){
			if($page == 'inq_inv'){
				$this->session->set_flashdata('pesan','Nomor Invoice Berhasil Di Revisi & Dikirim Kembali');
				redirect('inquiry_pengajuan');
			}else{
				$this->session->set_flashdata('pesan','Nomor Invoice Berhasil Di Revisi & Dikirim Kembali');
				redirect('p_on_proccess/revisi_invoice');
			}
		}
	}


}
