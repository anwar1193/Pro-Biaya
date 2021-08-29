<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_bank extends CI_Controller {

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
		$data_bank = $this->M_master->tampil_bank()->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_bank', array('data_bank' => $data_bank));
		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_bank('tbl_bank_pengaju', array(
			'nama_bank' => $this->input->post('nama_bank')
		));

		if($result>0){
			echo '<script>alert("Data Bank Tersimpan");window.location="index"</script>';
		}
	}

	public function update(){
		$result = $this->M_master->update_bank('tbl_bank_pengaju', array(
			'nama_bank' => $this->input->post('nama_bank')
		), array('id_bank' => $this->input->post('id')));

		if($result>0){
			echo '<script>alert("Data Bank Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id){
		$result = $this->M_master->hapus_bank('tbl_bank_pengaju', array('id_bank' => $id));
		if($result>0){
			redirect('data_bank');
		}
	}

}
