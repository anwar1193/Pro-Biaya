<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relasi_biaya extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library('libraryku');
		$this->load->model('M_master');
	}

	public function index()
	{
		cek_belum_login();
		$data_relasi = $this->M_master->tampil_relasi()->result_array();
		$data_jenis_biaya = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_departemen = $this->M_master->tampil_departemen()->result_array();

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_relasi_biaya', array(
			'data_relasi' => $data_relasi,
			'data_jenis_biaya' => $data_jenis_biaya,
			'data_departemen' => $data_departemen
		));
		$this->load->view('footer');
	}

	public function tambah(){
		cek_belum_login();
		$data_jenis_biaya = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_departemen = $this->M_master->tampil_departemen()->result_array();
		
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
		$this->load->view('v_relasi_biaya_tambah', array(
			'data_jenis_biaya' => $data_jenis_biaya,
			'data_departemen' => $data_departemen
		));
		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_relasi('tbl_relasi_biaya', array(
			'departemen' => $this->input->post('departemen'),
			'id_jb' => $this->input->post('id_jb'),
			'kode_jb' => $this->input->post('kode_jb'),
			'jenis_biaya' => $this->input->post('jenis_biaya')
		));

		if($result>0){
			echo '<script>alert("Data Relasi Tersimpan");window.location="index"</script>';
		}
	}

	public function update(){
		$result = $this->M_master->update_sub_biaya('tbl_sub_biaya', array(
			'sub_biaya' => $this->input->post('sub_biaya'),
			'departemen_tujuan' => $this->input->post('departemen_tujuan'),
			'form' => $this->input->post('form')
		), array('id_sb' => $this->input->post('id_sb')));

		if($result>0){
			echo '<script>alert("Data Sub Biaya Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id_sb){
		$result = $this->M_master->hapus_sub_biaya('tbl_sub_biaya', array('id_sb' => $id_sb));
		if($result>0){
			redirect('data_sub_biaya');
		}
	}

}
