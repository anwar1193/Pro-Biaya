<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller {

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
		$data_user = $this->M_master->tampil_user()->result_array();
		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_user', array('data_user' => $data_user));
		$this->load->view('footer');
	}

	public function tambah(){
		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_karyawan = $this->M_master->tampil_karyawan()->result_array();
		$data_level = $this->M_master->tampil_level()->result_array();
		$data_user = $this->M_master->tampil_user()->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_tambah_user', array(
			'data_karyawan' => $data_karyawan,
			'data_level' => $data_level,
			'data_user' => $data_user
		));
		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_user('tbl_user', array(
			'level' => $this->input->post('level'),
			'nik' => $this->input->post('nik'),
			'nama_lengkap' => $this->input->post('nama'),
			'cabang' => $this->input->post('cabang'),
			'divisi' => $this->input->post('divisi'),
			'departemen' => $this->input->post('departemen'),
			'nomor_wa' => $this->input->post('nomor_wa'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => sha1($this->input->post('password')),
			'atasan' => $this->input->post('atasan'),
			'level_atasan' => $this->input->post('level_atasan')
		));

		if($result>0){
			echo '<script>alert("Data User Tersimpan");window.location="index"</script>';
		}
	}

	public function edit($id){
		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_karyawan = $this->M_master->tampil_karyawan()->result_array();
		$data_level = $this->M_master->tampil_level()->result_array();
		$data_user = $this->M_master->tampil_user()->result_array();
		$data_user_edit = $this->M_master->tampil_user_id('tbl_user', array('id' => $id))->row_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_edit_user', array(
			'data_karyawan' => $data_karyawan,
			'data_level' => $data_level,
			'data_user' => $data_user,
			'data_user_edit' => $data_user_edit
		));
		$this->load->view('footer');
	}

	public function update(){
		$result = $this->M_master->update_user('tbl_user', array(
			'level' => $this->input->post('level'),
			'nik' => $this->input->post('nik'),
			'nama_lengkap' => $this->input->post('nama'),
			'cabang' => $this->input->post('cabang'),
			'divisi' => $this->input->post('divisi'),
			'departemen' => $this->input->post('departemen'),
			'nomor_wa' => $this->input->post('nomor_wa'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'atasan' => $this->input->post('atasan'),
			'level_atasan' => $this->input->post('level_atasan')
		), array('id' => $this->input->post('id')));

		if($result>0){
			echo '<script>alert("Data User Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id){
		$result = $this->M_master->hapus_user('tbl_user', array('id' => $id));
		if($result>0){
			redirect('data_user');
		}
	}

	public function reset_password($id){
		$result = $this->M_master->update_user('tbl_user', array(
			'password' => sha1('Profi@123')
		), array('id' => $id));

		$this->session->set_flashdata('pesan','Reset Password Berhasil');
		redirect('data_user');
	}

	public function history_clearlog($id){
		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_clearlog = $this->db->query("SELECT * FROM tbl_clearlog WHERE id_user = $id ORDER BY id_clearlog DESC")->result_array();

		$this->load->view('header');
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_clearlog', array(
			'data_clearlog' => $data_clearlog
		));
		$this->load->view('footer');
	}

	public function log_login($id){
		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_log_login = $this->db->query("SELECT * FROM tbl_log_login WHERE id_user = $id ORDER BY id_log DESC")->result_array();
		$data_user = $this->db->query("SELECT * FROM tbl_user WHERE id=$id")->row_array();

		$this->load->view('header');
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_log_login', array(
			'data_log_login' => $data_log_login,
			'data_user' => $data_user
		));
		$this->load->view('footer');
	}

}
