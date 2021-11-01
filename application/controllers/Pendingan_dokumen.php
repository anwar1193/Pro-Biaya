<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendingan_dokumen extends CI_Controller {

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

		$data_pendok = $this->M_master->pendingan_dokumen($departemen)->result_array();
		
		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_pendingan_dokumen', array('data_pendok' => $data_pendok));
		$this->load->view('footer');
	}

	public function detail($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
		$data_bayar_file = $this->M_master->tampil_bayar_no('tbl_bayar_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
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
		$this->load->view('v_pendingan_dokumen_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_bayar_file' => $data_bayar_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}

	public function verifikasi_dokumen(){
		$id_pengajuan = $this->input->post('id');
		$note = $this->input->post('note_penyelesaian');

		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'status_dokumen' => 'done',
			'note_penyelesaian' => $note
		), array('id_pengajuan' => $id_pengajuan));

		if($result>0){
			$this->session->set_flashdata('pesan','Verifikasi Dokumen Berhasil');
			redirect('pendingan_dokumen');
		}
	}


	public function request_penyelesaian(){
		$id_pengajuan = $this->input->post('id');
		$note = $this->input->post('note_penyelesaian');
		$jenis_penyelesaian = $this->input->post('jenis_penyelesaian');

		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'jenis_penyelesaian' => $jenis_penyelesaian,
			'note_penyelesaian' => $note
		), array('id_pengajuan' => $id_pengajuan));

		if($result>0){
			$this->session->set_flashdata('pesan','Request Penyelesaian Terkirim');
			redirect('pendingan_dokumen/detail/'.$id_pengajuan);
		}
	}


	public function check_dokumen(){
		$id_file = $this->input->post('id_file');
		$id_pengajuan = $this->input->post('id_pengajuan');
		$no_pengajuan = $this->input->post('nomor_pengajuan');

		if(isset($_POST['submit'])){
			$result = $this->db->query("UPDATE tbl_pengajuan_file SET status='Done' WHERE id='$id_file'");
		}elseif(isset($_POST['reject'])){
			$result = $this->db->query("UPDATE tbl_pengajuan_file SET status='Reject' WHERE id='$id_file'");
		}

		
		
		if($result>0){
			// // Cek Apakah Dokumen sudah lengkap semua
			// $qcek_dok = $this->db->query("SELECT * FROM tbl_pengajuan_file WHERE nomor_pengajuan='$no_pengajuan' AND status='' ");
			// $cek_dok = $qcek_dok->num_rows();

			// if($cek_dok<1){ //jika semua dokumen udah done, update status pengajuan (utama jadi done)
			// 	$this->db->query("UPDATE tbl_pengajuan SET status_dokumen='done' WHERE nomor_pengajuan='$no_pengajuan'");
			// }

			$this->session->set_flashdata('pesan','Verifikasi Dokumen Berhasil');
			redirect('pendingan_dokumen/detail/'.$id_pengajuan);
		}
	}

	public function request_dokumen(){
		$id_pengajuan = $this->input->post('id');

		$result = $this->M_master->update_pengajuan('tbl_pengajuan',array(
			'tambah_dokumen' => 'ya',
			'tambah_dokumen_pic' => $this->input->post('tambah_dokumen_pic'),
			'ket_tambah_dokumen' => $this->input->post('ket_tambah_dokumen')
		), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));

		if($result>0){
			$this->session->set_flashdata('pesan','Request Tambah Dokumen Terkirim');
			redirect('pendingan_dokumen/detail/'.$id_pengajuan);
		}
	}

	public function tambah_dokumen(){
		date_default_timezone_set("Asia/Jakarta");
		$no_pengajuan = $this->input->post('nomor_pengajuan');
		
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
					$this->M_master->simpan_pengajuan('tbl_pengajuan_file', $content);
				}
			}
		}

		// cari id pengajuan untuk redirect halaman
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$id_pengajuan = $data_pengajuan['id_pengajuan'];

		$this->session->set_flashdata('pesan','Dokumen Baru Berhasil Diupdate');
		redirect('pendingan_dokumen/detail/'.$id_pengajuan);
	}

}
