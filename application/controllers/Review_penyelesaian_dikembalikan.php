<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_penyelesaian_dikembalikan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library(array('libraryku','dompdf_gen'));
		$this->load->model('M_master');
	}

	public function index()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		$data_review = $this->db->query("SELECT * FROM tbl_penyelesaian_dikembalikan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE (tbl_penyelesaian_dikembalikan.status_verifikasi_penyelesaian='Verified By PIC' OR tbl_penyelesaian_dikembalikan.status_verifikasi_penyelesaian='Verified By Accounting') ORDER BY tbl_penyelesaian_dikembalikan.id_penyelesaian DESC")->result_array();

		$identitas = $departemen;
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_review_penyelesaian_dikembalikan', array('data_review' => $data_review));
		$this->load->view('footer');
	}

	public function detail($id){
        $data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_dikembalikan WHERE id_penyelesaian=$id")->row_array();
		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];
        // $data_file = $this->db->query("SELECT * FROM tbl_kelebihan_file WHERE nomor_pengajuan = '$no_pengajuan'")->result_array();
        $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan = '$no_pengajuan'")->row_array();

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
		$this->load->view('v_review_penyelesaian_dikembalikan_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			// 'data_file' => $data_file,
			'data_pengajuan' => $data_pengajuan
		));
		$this->load->view('footer');
	}

	public function verifikasi(){
        // Cari nomor_pengajuan
        $id_penyelesaian = $this->input->post('id');
        $id_pengajuan = $this->input->post('id_pengajuan');
        $note_verifikasi = $this->input->post('note_verifikasi');

        
        // Update status_penyelesaian di tbl_penyelesaian_kelebihan
        $update_status = $this->M_master->update_pengajuan('tbl_penyelesaian_dikembalikan', array(
            'status_verifikasi_penyelesaian' => 'Verified By Accounting'
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($update_status > 0){
			// Update status_penyelesaian di tbl_pengajuan
            $this->M_master->update_pengajuan('tbl_pengajuan', array(
                'status_penyelesaian' => 'Verified By Accounting'
            ), array('id_pengajuan' => $id_pengajuan));

            $this->session->set_flashdata('pesan','Verifikasi Penyelesaian Biaya dikembalikan Berhasil');
            redirect('review_penyelesaian_dikembalikan');
        }
    }

	public function jurnal_balik($id){
		// $data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_dikembalikan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_dikembalikan.id_penyelesaian = $id")->row_array();
		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		// Ambil COA (Nomor Perkiraan)
		$sub_biaya = $data_penyelesaian['sub_biaya'];
		$dept = $data_penyelesaian['bagian'];
		$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
		$coa = $ambil_coa['coa'];
		$nama_coa = $ambil_coa['nama_coa'];


		$this->load->view('header');
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_jurnal_balik_penyelesaian2', array(
			'data_penyelesaian' => $data_penyelesaian,
			'coa' => $coa,
			'nama_coa' => $nama_coa
		));
		$this->load->view('footer');
	}


	public function header_leggen_pic(){
		$tanggal = $this->input->post('tanggal');

		$data_pengajuan = $this->db->query("SELECT * FROM tbl_penyelesaian_dikembalikan WHERE tanggal_penyelesaian='$tanggal' AND status_verifikasi_penyelesaian='Verified By Accounting'")->result_array();

		$this->load->view('v_header_leggen_penyelesaian_dikembalikan',array('row'=>$data_pengajuan));
	}

	public function detail_leggen_pic(){
		$tanggal = $this->input->post('tanggal');
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_penyelesaian_dikembalikan WHERE tanggal_penyelesaian='$tanggal' AND status_verifikasi_penyelesaian='Verified By Accounting'")->result_array();

		$this->load->view('v_detail_leggen_penyelesaian_dikembalikan',array('row'=>$data_pengajuan));
	}


}
