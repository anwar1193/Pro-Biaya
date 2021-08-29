<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_pengajuan extends CI_Controller {

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

		$data_history = $this->M_master->history_pengajuan_dept($departemen)->result_array();
		
		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_history_pengajuan', array('data_history' => $data_history));
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
		
		// Data Pembayaran Pertama untuk menampilkan tanggal bayar
		$data_byr1 = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id ASC LIMIT 0,1")->row_array();

		$data_byr2 = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->result_array();

		// Tampilkan Data Memo
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_history_pengajuan_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_bayar_file' => $data_bayar_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr1' => $data_byr1,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}

	public function verifikasi_dokumen($id_pengajuan){
		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'status_dokumen' => 'done'
		), array('id_pengajuan' => $id_pengajuan));

		if($result>0){
			$this->session->set_flashdata('pesan','Verifikasi Dokumen Berhasil');
			redirect('history_pengajuan');
		}
	}


	public function check_dokumen(){
		$id_file = $this->input->post('id_file');
		$id_pengajuan = $this->input->post('id_pengajuan');
		$no_pengajuan = $this->input->post('nomor_pengajuan');

		$result = $this->db->query("UPDATE tbl_pengajuan_file SET status='Done' WHERE id='$id_file'");
		
		if($result>0){
			// Cek Apakah Dokumen sudah lengkap semua
			$qcek_dok = $this->db->query("SELECT * FROM tbl_pengajuan_file WHERE nomor_pengajuan='$no_pengajuan' AND status='' ");
			$cek_dok = $qcek_dok->num_rows();

			if($cek_dok<1){ //jika semua dokumen udah done, update status pengajuan (utama jadi done)
				$this->db->query("UPDATE tbl_pengajuan SET status_dokumen='done' WHERE nomor_pengajuan='$no_pengajuan'");
			}

			$this->session->set_flashdata('pesan','Verifikasi Dokumen Berhasil');
			redirect('history_pengajuan/detail/'.$id_pengajuan);
		}
	}

}
