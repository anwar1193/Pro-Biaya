<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry_pengajuan extends CI_Controller {

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

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			if(isset($_POST['cari_data'])){
				$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from')));
				$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to')));
				$sort_by = $this->input->post('sort_by1');
				$sort_metode = $this->input->post('sort_metode1');

				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							bagian='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to')
							ORDER BY $sort_by $sort_metode")->result_array();

			}elseif(isset($_POST['cari_data2'])){
				$sub_biaya = $this->input->post('sub_biaya');
				$sort_by = $this->input->post('sort_by2');
				$sort_metode = $this->input->post('sort_metode2');

				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							bagian='$departemen' AND sub_biaya='$sub_biaya'
							ORDER BY $sort_by $sort_metode")->result_array();

			}elseif(isset($_POST['cari_data3'])){
				$status_approval = $this->input->post('status_approval');
				$sort_by = $this->input->post('sort_by3');
				$sort_metode = $this->input->post('sort_metode3');

				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							bagian='$departemen' AND status_approve='$status_approval'
							ORDER BY $sort_by $sort_metode")->result_array();

			}elseif(isset($_POST['cari_data4'])){
				$status_dokumen = $this->input->post('status_dokumen');
				$sort_by = $this->input->post('sort_by4');
				$sort_metode = $this->input->post('sort_metode4');

				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							bagian='$departemen' AND status_dokumen='$status_dokumen'
							ORDER BY $sort_by $sort_metode")->result_array();

			}elseif(isset($_POST['sort'])){
				$sort_metode = $this->input->post('sort_metode');

				if($sort_metode == 'tanggal_asc'){
					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE bagian='$departemen' ORDER BY tanggal ASC")->result_array();
				}elseif($sort_metode == 'tanggal_desc'){
					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE bagian='$departemen' ORDER BY tanggal DESC")->result_array();
				}elseif($sort_metode == 'jumlah_asc'){
					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE bagian='$departemen' ORDER BY jumlah ASC")->result_array();
				}elseif($sort_metode == 'jumlah_desc'){
					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE bagian='$departemen' ORDER BY jumlah DESC")->result_array();
				}	

			}else{
				$data_inquiry = $this->M_master->inquiryHO($departemen)->result_array();
			}

			$identitas = $departemen;

		}else{ // Jika Cabang
			if($level == 'Branch Manager'){ // Jika Kacab
				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
				cabang='$cabang'
				ORDER BY id_pengajuan DESC")->result_array();
				$identitas = $level;

			}elseif($level == 'Area Manager'){ // Jika Kacab
				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
				wilayah='$cabang'
				ORDER BY id_pengajuan DESC")->result_array();
				$identitas = $level;

			}else{ // Jika Adco, Adcoll, CMC, ADD

				if(isset($_POST['cari_data'])){
					$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from')));
					$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to')));
					$sort_by = $this->input->post('sort_by1');
					$sort_metode = $this->input->post('sort_metode1');

					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
								cabang='$cabang' AND bagian='$level' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to')
								ORDER BY $sort_by $sort_metode")->result_array();

				}elseif(isset($_POST['cari_data2'])){
					$sub_biaya = $this->input->post('sub_biaya');
					$sort_by = $this->input->post('sort_by2');
					$sort_metode = $this->input->post('sort_metode2');

					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
								cabang='$cabang' AND bagian='$level' AND sub_biaya='$sub_biaya'
								ORDER BY $sort_by $sort_metode")->result_array();

				}elseif(isset($_POST['cari_data3'])){
					$status_approval = $this->input->post('status_approval');
					$sort_by = $this->input->post('sort_by3');
					$sort_metode = $this->input->post('sort_metode3');

					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
								cabang='$cabang' AND bagian='$level' AND status_approve='$status_approval'
								ORDER BY $sort_by $sort_metode")->result_array();

				}elseif(isset($_POST['cari_data4'])){
					$status_dokumen = $this->input->post('status_dokumen');
					$sort_by = $this->input->post('sort_by4');
					$sort_metode = $this->input->post('sort_metode4');

					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
								cabang='$cabang' AND bagian='$level' AND status_dokumen='$status_dokumen'
								ORDER BY $sort_by $sort_metode")->result_array();

				}elseif(isset($_POST['sort'])){
					$sort_metode = $this->input->post('sort_metode');

					if($sort_metode == 'tanggal_asc'){
						$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$level' ORDER BY tanggal ASC")->result_array();
					}elseif($sort_metode == 'tanggal_desc'){
						$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$level' ORDER BY tanggal DESC")->result_array();
					}elseif($sort_metode == 'jumlah_asc'){
						$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$level' ORDER BY jumlah ASC")->result_array();
					}elseif($sort_metode == 'jumlah_desc'){
						$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$level' ORDER BY jumlah DESC")->result_array();
					}	

				}else{
					$data_inquiry = $this->M_master->inquiry($cabang, $level)->result_array();
				}


				
				$identitas = $level;
			}
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_inquiry', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function detail($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		// Untuk Data Split Pembayaran
		$data_byr = $this->db->query("SELECT * FROM tbl_bayar INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->num_rows();

		$data_byr2 = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->result_array();

		// Tampilkan Data Memo
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_detail_inquiry', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
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


	public function tambah_dokumen(){
		date_default_timezone_set("Asia/Jakarta");
		$no_pengajuan = $this->input->post('nomor_pengajuan');
		// Simpan File Pengajuan

		$hari_ini = date("Y-m-d");

		$folderUpload = "./file_upload/".$hari_ini;

		# periksa apakah folder tersedia
		if (!is_dir($folderUpload)) {
		  # jika tidak maka folder harus dibuat terlebih dahulu
		  mkdir($folderUpload, 0777, $rekursif = true);
		}

		// ref_no diambil untuk nama file nya (pembeda antar pengajuan)
		$refno = $this->input->post('ref_no');

		$data = [];
		$count = count($_FILES['files']['name']);
		for($i=0; $i<$count; $i++){
			if(!empty($_FILES['files']['name'][$i])){
				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];

				$config['upload_path'] = $folderUpload;
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$config['max_size'] = 0;
				// $config['file_name'] = $_FILES['files']['name'][$i];
				$config['file_name'] = date('Y-m-d').'-'.$refno.'-'.substr(md5(rand()),0,5).'-'.$i;
				// $config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);

				if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$image[$i] = $filename;
					$content = [
						'nomor_pengajuan' => $no_pengajuan,
						'file' => $image[$i],
						'nama_file' => $this->input->post('nama_file')[$i]
					];
					$this->M_master->simpan_pengajuan('tbl_pengajuan_file', $content);
				}
			}
		}

		// cari id pengajuan untuk redirect halaman
		// $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		// $id_pengajuan = $data_pengajuan['id_pengajuan'];

		$this->session->set_flashdata('pesan','Dokumen Baru Berhasil Ditambahkan');
		redirect('inquiry_pengajuan');
	}


}
