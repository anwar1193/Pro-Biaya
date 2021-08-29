<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_kekurangan_biaya extends CI_Controller {

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

		$data_review = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.departemen_tujuan='$departemen' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='final approved' AND tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC")->result_array();

		$identitas = $departemen;
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_review_kekurangan', array('data_review' => $data_review));
		$this->load->view('footer');
	}

	public function detail($id){
        $data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan WHERE id_penyelesaian=$id")->row_array();
		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];

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

		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history_penyelesaian', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_review_kekurangan_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history
		));
		$this->load->view('footer');
	}

    public function verifikasi(){
        // Cari nomor_pengajuan
        $id_penyelesaian = $this->input->post('id');
        $id_pengajuan = $this->input->post('id_pengajuan');
        $note_verifikasi = $this->input->post('note_verifikasi');

        
        // Update status_penyelesaian di tbl_penyelesaian_kelebihan
        $update_status = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
            'status_verifikasi_penyelesaian' => 'Verified',
            'note_verifikasi_penyelesaian' => $note_verifikasi
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($update_status > 0){

            $this->session->set_flashdata('pesan','Verifikasi Penyelesaian Kekurangan Biaya Berhasil');
            redirect('review_kekurangan_biaya');
        }
    }

    public function pending(){
        // Cari nomor_pengajuan
        $id_penyelesaian = $this->input->post('id');
        $id_pengajuan = $this->input->post('id_pengajuan');
        $note_pending = $this->input->post('note_pending');

        
        // Update status_penyelesaian di tbl_penyelesaian_kelebihan
        $update_status = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
            'status_verifikasi_penyelesaian' => 'Pending',
            'note_verifikasi_penyelesaian' => $note_pending
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($update_status > 0){

            $this->session->set_flashdata('pesan','Penyelesaian Kekurangan Biaya Berhasil Di Pending');
            redirect('review_kekurangan_biaya');
        }
    }


	// function untuk relasi pilihan biaya
	public function ambil_data_filter(){
		// Untuk Pencarian Sub Biaya
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;
		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$modul=$this->input->post('modul');
		$id=$this->input->post('id');

		if($modul=="sub_biaya"){
			echo $this->M_master->sub_biaya_filter($id, $identitas);
		}
	}


	public function cetak_pengajuan($id){
		date_default_timezone_set("Asia/Jakarta");
		
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();

		$this->load->view('v_pengajuan_pdf', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("struk_pengajuan.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}


}
