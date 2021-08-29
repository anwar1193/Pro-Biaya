<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_departemen extends CI_Controller {

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
		$data_departemen = $this->M_master->tampil_departemen()->result_array();
		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_departemen', array('data_departemen' => $data_departemen));
		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_departemen('tbl_departemen', array(
			'kode_departemen' => $this->input->post('kode_departemen'),
			'nama_departemen' => $this->input->post('nama_departemen')
		));

		if($result>0){
			echo '<script>alert("Data Departemen Tersimpan");window.location="index"</script>';
		}
	}

	public function update(){
		$result = $this->M_master->update_departemen('tbl_departemen', array(
			'nama_departemen' => $this->input->post('nama_departemen')
		), array('kode_departemen' => $this->input->post('kode_departemen')));

		if($result>0){
			echo '<script>alert("Data Departemen Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id){
		$result = $this->M_master->hapus_departemen('tbl_departemen', array('id' => $id));
		if($result>0){
			redirect('data_departemen');
		}
	}

}
