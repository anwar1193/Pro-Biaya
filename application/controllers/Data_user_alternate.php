<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user_alternate extends CI_Controller {

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
		$data_user = $this->M_master->tampil_data_where('tbl_user', array('jenis_user' => 'alternate'))->result_array();
		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_user_alternate', array('data_user' => $data_user));
		$this->load->view('footer');
	}

	public function tambah(){
		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_karyawan = $this->M_master->tampil_karyawan()->result_array();
		$data_level = $this->M_master->tampil_level()->result_array();
		$data_user = $this->M_master->tampil_user()->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_tambah_user_alternate', array(
			'data_karyawan' => $data_karyawan,
			'data_level' => $data_level,
			'data_user' => $data_user
		));
		$this->load->view('footer');
	}

	public function simpan(){
		$alternate_untuk_username = $this->input->post('alternate_untuk_username');
		$user_alternate_nik = $this->input->post('user_alternate_nik');
		$user_alternate_nama = $this->input->post('user_alternate_nama');

		// Copy data user asli untuk data user alternate
		$data_user_asli = $this->db->query("SELECT * FROM tbl_user WHERE username='$alternate_untuk_username'")->row_array();
		$level_asli = $data_user_asli['level'];
		$cabang_asli = $data_user_asli['cabang'];
		$divisi_asli = $data_user_asli['divisi'];
		$departemen_asli = $data_user_asli['departemen'];
		$nomor_wa_asli = $data_user_asli['nomor_wa'];
		$email_asli = $data_user_asli['email'];
		$atasan_asli = $data_user_asli['atasan'];
		$level_atasan_asli = $data_user_asli['level_atasan'];

		$result = $this->M_master->simpan_user('tbl_user', array(
			'level' => $level_asli,
			'nik' => $user_alternate_nik,
			'nama_lengkap' => $user_alternate_nama,
			'cabang' => $cabang_asli,
			'divisi' => $divisi_asli,
			'departemen' => $departemen_asli,
			'nomor_wa' => $nomor_wa_asli,
			'email' => $email_asli,
			'username' => $this->input->post('username'),
			'password' => sha1($this->input->post('password')),
			'atasan' => $atasan_asli,
			'level_atasan' => $level_atasan_asli,
			'jenis_user' => 'alternate',
			'alternate_untuk' => $alternate_untuk_username,
			'status_user' => 'aktif'
		));

		if($result>0){
			echo '<script>alert("Data User Alternate Tersimpan");window.location="index"</script>';
		}
	}

	public function edit($id){
		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_karyawan = $this->M_master->tampil_karyawan()->result_array();
		$data_user = $this->M_master->tampil_user()->result_array();
		$data_user_edit = $this->M_master->tampil_user_id('tbl_user', array('id' => $id))->row_array();

		// cari nama lengkap alternate untuk
		$alternate_untuk = $data_user_edit['alternate_untuk'];
		$cari_nama = $this->db->query("SELECT * FROM tbl_user WHERE username='$alternate_untuk'")->row_array();
		$alternate_untuk_nama = $cari_nama['nama_lengkap'];

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_edit_user_alternate', array(
			'data_karyawan' => $data_karyawan,
			'data_user' => $data_user,
			'data_user_edit' => $data_user_edit,
			'alternate_untuk_nama' => $alternate_untuk_nama
		));
		$this->load->view('footer');
	}

	public function update(){
		$user_alternate_nik = $this->input->post('user_alternate_nik');
		$user_alternate_nama = $this->input->post('user_alternate_nama');

		$result = $this->M_master->update_user('tbl_user', array(
			'nik' => $user_alternate_nik,
			'nama_lengkap' => $user_alternate_nama,
			'username' => $this->input->post('username')
		), array('id' => $this->input->post('id')));

		if($result>0){
			echo '<script>alert("Data User Alternate Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id){
		$result = $this->M_master->hapus_user('tbl_user', array('id' => $id));
		if($result>0){
			$this->session->set_flashdata('pesan','User Alternate Berhasil Dihapus');
			redirect('data_user_alternate');
		}
	}

	public function reset_password($id){
		$result = $this->M_master->update_user('tbl_user', array(
			'password' => sha1('Profi@123')
		), array('id' => $id));

		$this->session->set_flashdata('pesan','Reset Password Berhasil');
		redirect('data_user_alternate');
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


    public function nonaktifkan_user($id){
        $result = $this->M_master->update_data('tbl_user', array(
            'status_user' => 'nonaktif'
        ), array('id' => $id));

        $this->session->set_flashdata('pesan','User Berhasil Di Nonaktifkan');
		redirect('data_user_alternate');
    }

    public function aktifkan_user($id){
        $result = $this->M_master->update_data('tbl_user', array(
            'status_user' => 'aktif'
        ), array('id' => $id));

        $this->session->set_flashdata('pesan','User Berhasil Di Aktifkan');
		redirect('data_user_alternate');
    }

}
