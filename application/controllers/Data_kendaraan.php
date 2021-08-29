<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kendaraan extends CI_Controller {

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
		$data_kendaraan = $this->M_master->tampil_kendaraan()->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_kendaraan', array('data_kendaraan' => $data_kendaraan));
		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_kendaraan('tbl_kendaraan', array(
			'nopol' => $this->input->post('nopol'),
			'jenis_kendaraan' => $this->input->post('jenis_kendaraan'),
			'merk_kendaraan' => $this->input->post('merk_kendaraan'),
			'kapasitas_silinder' => $this->input->post('kapasitas_silinder'),
			'cabang' => $this->input->post('cabang')
		));

		if($result>0){
			echo '<script>alert("Data Kendaraan Tersimpan");window.location="index"</script>';
		}
	}

	public function update(){
		$result = $this->M_master->update_kendaraan('tbl_kendaraan', array(
			'nopol' => $this->input->post('nopol'),
			'jenis_kendaraan' => $this->input->post('jenis_kendaraan'),
			'merk_kendaraan' => $this->input->post('merk_kendaraan'),
			'kapasitas_silinder' => $this->input->post('kapasitas_silinder'),
			'cabang' => $this->input->post('cabang')
		), array('id' => $this->input->post('id')));

		if($result>0){
			echo '<script>alert("Data Kendaraan Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id){
		$result = $this->M_master->hapus_kendaraan('tbl_kendaraan', array('id' => $id));
		if($result>0){
			redirect('data_kendaraan');
		}
	}

}
