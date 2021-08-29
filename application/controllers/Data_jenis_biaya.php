<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_jenis_biaya extends CI_Controller {

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
		
		$data_jenis_biaya = $this->M_master->tampil_jenis_biaya()->result_array();
		$id_otomatis = $this->M_master->id_otomatis();
		
		$this->load->view('header');
		$this->load->view('sidebar',array('data_jb'=>$data_jb));
		$this->load->view('v_data_jenis_biaya', array(
			'data_jenis_biaya' => $data_jenis_biaya,
			'id_otomatis' => $id_otomatis
		));
		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_jenis_biaya('tbl_jenis_biaya', array(
			'kode_jb' => $this->input->post('kode_jb'),
			'jenis_biaya' => $this->input->post('jenis_biaya')
		));

		if($result>0){
			echo '<script>alert("Data Jenis Biaya Tersimpan");window.location="index"</script>';
		}
	}

	public function update(){
		$result = $this->M_master->update_jenis_biaya('tbl_jenis_biaya', array(
			'jenis_biaya' => $this->input->post('jenis_biaya')
		), array('kode_jb' => $this->input->post('kode_jb')));

		if($result>0){
			echo '<script>alert("Data Jenis Biaya Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id_jb){
		$result = $this->M_master->hapus_jenis_biaya('tbl_jenis_biaya', array('id_jb' => $id_jb));
		if($result>0){
			redirect('data_jenis_biaya');
		}
	}

}
