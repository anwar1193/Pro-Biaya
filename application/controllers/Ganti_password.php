<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ganti_password extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library('libraryku');
		$this->load->model('M_master');
	}

	public function index()
	{
		cek_belum_login();
		$id_user = $this->libraryku->tampil_user()->id;
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		
		$data_user = $this->db->query("SELECT * FROM tbl_user WHERE id=$id_user")->row_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_ganti_password', array('data_user' => $data_user));
		$this->load->view('footer');
	}

	public function ke_logout(){
		redirect('login/logout');
	}

	public function update_password(){
		$username = $this->input->post('username');
		$password_lama = sha1($this->input->post('password_lama'));
		$password_baru = sha1($this->input->post('password'));

		// Cek Apakah Password Lama Benar
		$cek = $this->db->query("SELECT * FROM tbl_user WHERE username='$username' AND password='$password_lama'")->num_rows();

		if($cek>0){ // Jika Password Lama Benar

			if($password_lama == $password_baru){ //jika password lama & password baru sama
				echo '<script>alert("Password Baru Tidak Boleh Sama Dengan Password Lama");window.location="index"</script>';

			}else{
				$result = $this->M_master->update_user('tbl_user', array(
					'password' => sha1($this->input->post('password'))
				), array('id' => $this->input->post('id_user')));

				if($result>0){
					echo '<script>alert("Password Berhasil Diubah, Sistem Akan Logout Otomatis !");window.location="ke_logout"</script>';
				}
			}


		}else{ // Jika Password Lama Salah
			echo '<script>alert("Password Lama yang Anda Masukkan Salah");window.location="index"</script>';
		}

		
	}

}
