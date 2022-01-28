<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_telah_bayar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library(array('libraryku','dompdf_gen'));
		$this->load->model('M_master');
	}

	public function index()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if(isset($_POST['cari_data'])){
			$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from')));
			$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to')));

			$data_bayar = $this->M_master->tampil_history_telah_bayar_tanggal($tanggal_from, $tanggal_to)->result_array();

		}elseif(isset($_POST['cari_data2'])){
			$sub_biaya = $this->input->post('sub_biaya');
			$data_bayar = $this->M_master->tampil_history_telah_bayar_biaya($sub_biaya)->result_array();

		}elseif(isset($_POST['cari_data3'])){
			$cabang = $this->input->post('cabang');
			$data_bayar = $this->M_master->tampil_history_telah_bayar_cabang($cabang)->result_array();

		}elseif(isset($_POST['cari_data4'])){
			$departemen = $this->input->post('departemen');
			$data_bayar = $this->M_master->tampil_history_telah_bayar_departemen($departemen)->result_array();

		}elseif(isset($_POST['reset_filter'])){
			$data_bayar = $this->M_master->tampil_history_telah_bayar()->result_array();

		}else{
			$data_bayar = $this->M_master->tampil_history_telah_bayar()->result_array();
		}
		
		
		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$data_jb_bayar = $this->M_master->tampil_jenis_biaya()->result_array();

		$data_cabang = $this->db->query("SELECT * FROM tbl_cabang WHERE kode_cabang < 100")->result_array();
		$data_departemen = $this->db->query("SELECT * FROM tbl_departemen WHERE nama_departemen != 'BRANCH' AND nama_departemen != 'INFANDMATION & TEHCNOLOGY' AND nama_departemen != 'ADCO' AND nama_departemen != 'ADCOLL' AND nama_departemen != 'CMC' ORDER BY nama_departemen")->result_array();

		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_history_telah_bayar', array(
			'data_bayar' => $data_bayar,
			'data_jb_bayar' => $data_jb_bayar,
			'data_cabang' => $data_cabang,
			'data_departemen' => $data_departemen
		));
		$this->load->view('footer');
	}

	public function detail($id){
		$data_pengajuan = $this->M_master->tampil_bayar_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_file_bayar = $this->M_master->tampil_file('tbl_bayar_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
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

		// Untuk Data Split Pembayaran
		$data_byr = $this->db->query("SELECT * FROM tbl_bayar INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->num_rows();

		$data_byr2 = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->result_array();

		// Tampilkan Data Memo
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_detail_history_telah_bayar', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_file_bayar' => $data_file_bayar,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}


	public function cetak(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = $this->input->post('tanggal');

		// Ambil Data Pengajuan Dipilih Untuk Proses2 di bawah
		$data_pengajuan = $this->M_master->pengajuan_dipilih(array(
			'tbl_bayar.tanggal_rencana_bayar' => $tanggal
		))->result_array();

		$q_tgl = $this->M_master->pengajuan_dipilih(array(
			'tbl_bayar.tanggal_rencana_bayar' => $tanggal
		))->row_array();

		$tanggal = $q_tgl['tanggal_rencana_bayar'];

		// Ke Report
		$this->load->view('v_pdf_bayar', array(
			'data_pengajuan' => $data_pengajuan,
			'tanggal' => $tanggal
		));
		// Penutup Ke Report
	}

	public function tambah_dokumen(){
		date_default_timezone_set("Asia/Jakarta");
		$no_pengajuan = $this->input->post('nomor_pengajuan');
		// Simpan File Pengajuan

		$hari_ini = date("Y-m-d");

		$folderUpload = "./file_bayar/".$hari_ini;

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
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
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
						'nomor_pengajuan' => $no_pengajuan,
						'file' => $image[$i],
						'nama_file' => $this->input->post('nama_file')[$i]
					];
					$this->M_master->simpan_pengajuan('tbl_bayar_file', $content);
				}
			}
		}

		// cari id pengajuan untuk redirect halaman
		// $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		// $id_pengajuan = $data_pengajuan['id_pengajuan'];

		$this->session->set_flashdata('pesan','Bukti Transfer Berhasil Diupload');
		redirect('history_telah_bayar');
	}


	// public function cetak(){
	// 	date_default_timezone_set("Asia/Jakarta");
	// 	$id_pengajuan = $this->input->post('id_pengajuan');

	// 	if($id_pengajuan == ''){
	// 		echo '<script>alert("Tidak Ada Pengajuan yang Dipilih");window.location="index"</script>';
	// 	}else{
	// 		for ($i=0; $i<sizeof($id_pengajuan); $i++) {

	// 			// Ambil Data Pengajuan Dipilih Untuk Proses2 di bawah
	// 			$data_pengajuan = $this->M_master->pengajuan_dipilih(array(
	// 				'id' => $id_pengajuan[$i]
	// 			))->row_array();

	// 			// Ke Report
	// 			$this->load->view('v_pdf_bayar', array(
	// 				'data_pengajuan' => $data_pengajuan
	// 			));
	// 			// Penutup Ke Report

	// 		}
	// 	}
	// }

}
