<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_kelebihan_biaya extends CI_Controller {

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

		if(isset($_POST['cari_data1'])){

			$cabang_dipilih = $this->input->post('cabang');
			$data_review = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.dept_tujuan='$departemen' AND tbl_penyelesaian_kelebihan.status_verifikasi_penyelesaian='On Proccess' AND tbl_pengajuan.cabang='$cabang_dipilih' ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC")->result_array();

		}elseif(isset($_POST['cari_data2'])){

			$sub_biaya = $this->input->post('sub_biaya');
			$data_review = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.dept_tujuan='$departemen' AND tbl_penyelesaian_kelebihan.status_verifikasi_penyelesaian='On Proccess' AND tbl_penyelesaian_kelebihan.sub_biaya='$sub_biaya' ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC")->result_array();

		}else{
			$data_review = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.dept_tujuan='$departemen' AND tbl_penyelesaian_kelebihan.status_verifikasi_penyelesaian='On Proccess' ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC")->result_array();
		}

		$identitas = $departemen;
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$data_cabang = $this->db->query("SELECT * FROM tbl_cabang WHERE kode_cabang < 100")->result_array();
		$data_filter_biaya = $this->db->query("SELECT * FROM tbl_sub_biaya WHERE departemen_tujuan='$departemen'")->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_review_kelebihan', array(
			'data_review' => $data_review,
			'data_cabang' => $data_cabang,
			'data_filter_biaya' => $data_filter_biaya
		));
		$this->load->view('footer');
	}

	public function detail($id){
        $data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan WHERE id_penyelesaian=$id")->row_array();
		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];
        $data_file = $this->db->query("SELECT * FROM tbl_kelebihan_file WHERE nomor_pengajuan = '$no_pengajuan'")->result_array();
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
		$this->load->view('v_review_kelebihan_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_file' => $data_file,
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
        $update_status = $this->M_master->update_pengajuan('tbl_penyelesaian_kelebihan', array(
            'status_verifikasi_penyelesaian' => 'Verified By PIC',
            'note_verifikasi_penyelesaian' => $note_verifikasi
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($update_status > 0){
			// Update status_penyelesaian di tbl_pengajuan
            $this->M_master->update_pengajuan('tbl_pengajuan', array(
                'status_penyelesaian' => 'Verified By PIC'
            ), array('id_pengajuan' => $id_pengajuan));

            $this->session->set_flashdata('pesan','Verifikasi Penyelesaian Kelebihan Biaya Berhasil');
            redirect('review_kelebihan_biaya');
        }
    }

	public function pending(){
        // Cari nomor_pengajuan
        $id_penyelesaian = $this->input->post('id');
        $id_pengajuan = $this->input->post('id_pengajuan');
        $note_pending = $this->input->post('note_pending');

        
        // Update status_penyelesaian di tbl_penyelesaian_kelebihan
        $update_status = $this->M_master->update_pengajuan('tbl_penyelesaian_kelebihan', array(
            'status_verifikasi_penyelesaian' => 'Pending',
            'note_verifikasi_penyelesaian' => $note_pending
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($update_status > 0){
			// Update status_penyelesaian di tbl_pengajuan
            $this->M_master->update_pengajuan('tbl_pengajuan', array(
                'status_penyelesaian' => 'Pending'
            ), array('id_pengajuan' => $id_pengajuan));

            $this->session->set_flashdata('pesan','Penyelesaian Kelebihan Biaya Berhasil Di Pending');
            redirect('review_kelebihan_biaya');
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
