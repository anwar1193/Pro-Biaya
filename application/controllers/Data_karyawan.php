<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_karyawan extends CI_Controller {

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

		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		
		$data_karyawan = $this->M_master->tampil_karyawan()->result_array();
		$data_cabang = $this->M_master->tampil_cabang()->result_array();
		$data_departemen = $this->M_master->tampil_departemen()->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));

		$this->load->view('v_data_karyawan', array(
			'data_karyawan' => $data_karyawan,
			'data_cabang' => $data_cabang,
			'data_departemen' => $data_departemen
		));

		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_karyawan('tbl_karyawan', array(
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'cabang' => $this->input->post('cabang'),
			'divisi' => $this->input->post('divisi'),
			'departemen' => $this->input->post('departemen')
		));

		if($result>0){
			echo '<script>alert("Data Karyawan Tersimpan");window.location="index"</script>';
		}
	}

	public function update(){
		$result = $this->M_master->update_karyawan('tbl_karyawan', array(
			'nama' => $this->input->post('nama'),
			'cabang' => $this->input->post('cabang'),
			'divisi' => $this->input->post('divisi'),
			'departemen' => $this->input->post('departemen')
		), array('nik' => $this->input->post('nik')));

		if($result>0){
			echo '<script>alert("Data Karyawan Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id){
		$result = $this->M_master->hapus_karyawan('tbl_karyawan', array('id' => $id));
		if($result>0){
			redirect('data_karyawan');
		}
	}

}
