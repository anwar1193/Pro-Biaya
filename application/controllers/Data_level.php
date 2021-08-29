<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_level extends CI_Controller {

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
		
		$data_level = $this->M_master->tampil_level()->result_array();
		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_level', array('data_level' => $data_level));
		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_level('tbl_level', array(
			'level' => $this->input->post('level'),
			'min_approve' => $this->input->post('min_approve'),
			'max_approve' => $this->input->post('max_approve')
		));

		if($result>0){
			echo '<script>alert("Data Level Tersimpan");window.location="index"</script>';
		}
	}

	public function update(){
		$result = $this->M_master->update_level('tbl_level', array(
			'level' => $this->input->post('level'),
			'min_approve' => $this->input->post('min_approve'),
			'max_approve' => $this->input->post('max_approve')
		), array('id' => $this->input->post('id')));

		if($result>0){
			echo '<script>alert("Data Level Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id){
		$result = $this->M_master->hapus_level('tbl_level', array('id' => $id));
		if($result>0){
			redirect('data_level');
		}
	}

}
