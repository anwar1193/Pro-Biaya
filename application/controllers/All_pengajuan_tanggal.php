<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_pengajuan_tanggal extends CI_Controller {

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

		if(isset($_POST['cari_data'])){ //jika tombol cari di klik
			$cab = $this->input->post('cabang');
			$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from')));
			$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to')));
			$sort_by = $this->input->post('sort_by1');
			$sort_metode = $this->input->post('sort_metode1');

			if($cab=='all'){ //jika semua cabang
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar' OR (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar' ORDER BY $sort_by $sort_metode")->result_array();
			}else{
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cab' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar' OR cabang='$cab' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar' ORDER BY $sort_by $sort_metode")->result_array();
			}
			
		}elseif(isset($_POST['cari_data2'])){ //jika tombol cari2 di klik
			$cab = $this->input->post('cabang2');
			$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from2')));
			$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to2')));

			if($cab=='all'){ //jika semua cabang
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE (tanggal_approved BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar' OR (tanggal_approved BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar'")->result_array();
			}else{
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cab' AND (tanggal_approved BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar' OR cabang='$cab' AND (tanggal_approved BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar'")->result_array();
			}
			
		}elseif(isset($_POST['cari_data3'])){ //jika tombol cari3 di klik
			$cab = $this->input->post('cabang3');
			$status_dokumen = $this->input->post('status_dokumen');
			$sort_by = $this->input->post('sort_by3');
			$sort_metode = $this->input->post('sort_metode3');

			if($cab=='all'){ //jika semua cabang
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_dokumen='$status_dokumen' AND status_bayar='Proses Bayar' OR status_dokumen='$status_dokumen' AND status_bayar='Telah Dibayar' ORDER BY $sort_by $sort_metode")->result_array();
			}else{
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cab' AND status_dokumen='$status_dokumen' AND status_bayar='Proses Bayar' OR cabang='$cab' AND status_dokumen='$status_dokumen' AND status_bayar='Telah Dibayar' ORDER BY $sort_by $sort_metode")->result_array();
			}
			
		}elseif(isset($_POST['cari_data4'])){ //jika tombol cari4 di klik
			$cab = $this->input->post('cabang4');
			$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from4')));
			$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to4')));

			if($cab=='all'){ //jika semua cabang
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE (tanggal_proses_bayar BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar' OR (tanggal_proses_bayar BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar'")->result_array();
			}else{
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cab' AND (tanggal_proses_bayar BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar' OR cabang='$cab' AND (tanggal_proses_bayar BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar'")->result_array();
			}
			
		}elseif(isset($_POST['cari_data5'])){ //jika tombol cari5 di klik
			$cab = $this->input->post('cabang5');
			$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from5')));
			$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to5')));

			if($cab=='all'){ //jika semua cabang
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE (tanggal_bayar BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar'")->result_array();
			}else{
				$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cab' AND (tanggal_bayar BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar'")->result_array();
			}
			
		}elseif(isset($_POST['sort'])){
				$sort_metode = $this->input->post('sort_metode');

				if($sort_metode == 'tanggal_asc'){
					$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar' ORDER BY tanggal ASC")->result_array();
				}elseif($sort_metode == 'tanggal_desc'){
					$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar' ORDER BY tanggal DESC")->result_array();
				}elseif($sort_metode == 'jumlah_asc'){
					$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar' ORDER BY jumlah ASC")->result_array();
				}elseif($sort_metode == 'jumlah_desc'){
					$data_all_tanggal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' OR status_bayar='Telah Dibayar' ORDER BY jumlah DESC")->result_array();
				}

		}else{ //jika tombol cari tidak di klik
			$data_all_tanggal = $this->M_master->tampil_all()->result_array();
		}
		
		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$data_cabang = $this->M_master->tampil_cabang()->result_array();
		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_all_tanggal', array(
			'data_all_tanggal' => $data_all_tanggal,
			'data_cabang' => $data_cabang
		));
		$this->load->view('footer');
	}

	public function detail($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
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

		// Data Pembayaran Pertama untuk menampilkan tanggal bayar
		$data_byr1 = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id ASC LIMIT 0,1")->row_array();

		// Tampilkan Data Memo
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		$this->load->view('header');
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_all_tanggal_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr1' => $data_byr1,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}

	public function pdf_pengajuan($id){
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

		$this->load->view('v_pdf_pengajuan', array(
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
		$this->dompdf->stream("pengajuan.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}

	
	public function jurnal_pic($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
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

		// Ambil COA (Nomor Perkiraan)
		$sub_biaya = $data_pengajuan['sub_biaya'];
		$dept = $data_pengajuan['bagian'];
		$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
		$coa = $ambil_coa['coa'];
		$nama_coa = $ambil_coa['nama_coa'];


		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_jurnal_pic', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'coa' => $coa,
			'nama_coa' => $nama_coa
		));
		$this->load->view('footer');
	}

	public function detail_jpic($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
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


		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_all_jpic_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr2' => $data_byr2

		));
		$this->load->view('footer');
	}

	public function pdf_jpic($id){
		date_default_timezone_set("Asia/Jakarta");
		
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();

		// Ambil COA (Nomor Perkiraan)
		$sub_biaya = $data_pengajuan['sub_biaya'];
		$dept = $data_pengajuan['bagian'];
		$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
		$coa = $ambil_coa['coa'];
		$nama_coa = $ambil_coa['nama_coa'];

		$this->load->view('v_pdf_jpic', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'coa' => $coa,
			'nama_coa' => $nama_coa
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("jurnal_pic.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}

	public function jurnal_finance($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
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

		// Ambil COA (Nomor Perkiraan)
		$sub_biaya = $data_pengajuan['sub_biaya'];
		$dept = $data_pengajuan['bagian'];
		$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
		$coa = $ambil_coa['coa'];
		$nama_coa = $ambil_coa['nama_coa'];

		// Ambil Data Split Pembayaran Jika Lebih Dari 1x bayar
		$q_bayar = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan'");
		$cek_bayar = $q_bayar->num_rows();

		// Ambil Data yang telah dibayar (untuk jurnal payment)
		$q_telah_bayar = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' AND status_bayar='Telah Dibayar'");
		$data_bayar = $q_telah_bayar->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));

		//jika pembayaran lebih dari sekali
		if($cek_bayar > 1){
			$this->load->view('v_jurnal_finance_cicil', array(
				'data_pengajuan' => $data_pengajuan,
				'data_bayar' => $data_bayar,
				'data_approve_history' => $data_approve_history,
				'data_file' => $data_file,
				'data_check' => $data_check,
				'data_check_file' => $data_check_file,
				'data_perdin' => $data_perdin,
				'coa' => $coa,
				'nama_coa' => $nama_coa
			));
		}else{
			$this->load->view('v_jurnal_finance', array(
				'data_pengajuan' => $data_pengajuan,
				'data_approve_history' => $data_approve_history,
				'data_file' => $data_file,
				'data_check' => $data_check,
				'data_check_file' => $data_check_file,
				'data_perdin' => $data_perdin,
				'coa' => $coa,
				'nama_coa' => $nama_coa
			));
		}

		$this->load->view('footer');
	}

	public function pdf_jfin($id){
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
		
		// Ambil Data Split Pembayaran Jika Lebih Dari 1x bayar
		$q_bayar = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan'");
		$cek_bayar = $q_bayar->num_rows();

		// Ambil Data yang telah dibayar (untuk jurnal payment)
		$q_telah_bayar = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' AND status_bayar='Telah Dibayar'");
		$data_bayar = $q_telah_bayar->result_array();

		if($cek_bayar > 1){
			$this->load->view('v_pdf_jfin_cicil', array(
				'data_pengajuan' => $data_pengajuan,
				'data_bayar' => $data_bayar,
				'data_approve_history' => $data_approve_history,
				'data_file' => $data_file,
				'data_check' => $data_check,
				'data_check_file' => $data_check_file,
				'data_perdin' => $data_perdin
			));
		}else{
			$this->load->view('v_pdf_jfin', array(
				'data_pengajuan' => $data_pengajuan,
				'data_approve_history' => $data_approve_history,
				'data_file' => $data_file,
				'data_check' => $data_check,
				'data_check_file' => $data_check_file,
				'data_perdin' => $data_perdin
			));
		}

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("jurnal_fin.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}

	public function detail_jfin($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
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


		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_all_jfin_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr2' => $data_byr2
		));
		$this->load->view('footer');
	}

	public function verifikasi_dokumen($id_pengajuan){
		// Update Status Dokumen di tbl_pengajuan
		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'status_dokumen' => 'done acc'
		), array('id_pengajuan' => $id_pengajuan));

		if($result>0){
			// Update status Dokumen di tbl_pengajuan_file

			// 1.Ambil nomor pengajuan
			$quer = $this->db->query("SELECT * FROM tbl_pengajuan WHERE id_pengajuan=$id_pengajuan")->row_array();
			$nopeng = $quer['nomor_pengajuan'];

			// 2.Eksekusi Update
			$this->db->query("UPDATE tbl_pengajuan_file SET status='Done ACC' WHERE nomor_pengajuan='$nopeng'");

			$this->session->set_flashdata('pesan','Verifikasi Dokumen Berhasil');
			redirect('all_pengajuan_tanggal');
		}
	}

	public function check_dokumen(){
		$id_file = $this->input->post('id_file');
		$id_pengajuan = $this->input->post('id_pengajuan');
		$no_pengajuan = $this->input->post('nomor_pengajuan');

		$result = $this->db->query("UPDATE tbl_pengajuan_file SET status='Done' WHERE id='$id_file'");
		
		if($result>0){
			// Cek Apakah Dokumen sudah lengkap semua
			$qcek_dok = $this->db->query("SELECT * FROM tbl_pengajuan_file WHERE nomor_pengajuan='$no_pengajuan' AND status='' ");
			$cek_dok = $qcek_dok->num_rows();

			if($cek_dok<1){ //jika semua dokumen udah done, update status pengajuan (utama jadi done)
				$this->db->query("UPDATE tbl_pengajuan SET status_dokumen='done' WHERE nomor_pengajuan='$no_pengajuan'");
			}

			$this->session->set_flashdata('pesan','Verifikasi Dokumen Berhasil');
			redirect('all_pengajuan_tanggal/detail/'.$id_pengajuan);
		}
	}

	public function request_dokumen(){
		$id_pengajuan = $this->input->post('id');

		$result = $this->M_master->update_pengajuan('tbl_pengajuan',array(
			'tambah_dokumen' => 'ya',
			'tambah_dokumen_pic' => $this->input->post('tambah_dokumen_pic'),
			'ket_tambah_dokumen' => $this->input->post('ket_tambah_dokumen'),
			'status_dokumen' => ''
		), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));

		if($result>0){
			$this->session->set_flashdata('pesan','Request Tambah Dokumen Terkirim');
			redirect('all_pengajuan_tanggal/detail/'.$id_pengajuan);
		}
	}


	public function jurnal_reverse($id){
		$data_pengajuan = $this->M_master->tampil_jurnal_reverse($id)->row_array();
		$data_pengajuan2 = $this->M_master->tampil_jurnal_reverse($id)->result_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
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

		// Ambil COA (Nomor Perkiraan)
		$sub_biaya = $data_pengajuan['sub_biaya'];
		$dept = $data_pengajuan['bagian'];
		$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
		$coa = $ambil_coa['coa'];

		// Jurnal PIC update
		$data_jurnal_update = $this->M_master->tampil_pengajuan_detail($id)->row_array();


		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_jurnal_reverse', array(
			'data_pengajuan' => $data_pengajuan2,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'coa' => $coa,
			'data_jurnal_update' => $data_jurnal_update
		));
		$this->load->view('footer');
	}


	public function header_leggen($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$this->load->view('v_header_leggen',array('row'=>$data_pengajuan));
	}

	public function detail_leggen($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();

		// Ambil COA (Nomor Perkiraan)
		$sub_biaya = $data_pengajuan['sub_biaya'];
		$dept = $data_pengajuan['bagian'];
		$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
		$coa = $ambil_coa['coa'];

		$this->load->view('v_detail_leggen',array(
			'row'=>$data_pengajuan,
			'coa'=>$coa
		));
	}

	public function header_leggen_pic(){
		$tanggal = $this->input->post('tanggal');
		$data_pengajuan = $this->M_master->tampil_pengajuan_tanggal($tanggal)->result_array();
		$this->load->view('v_header_leggen_pic',array('row'=>$data_pengajuan));
	}

	public function detail_leggen_pic(){
		$tanggal = $this->input->post('tanggal');
		$data_pengajuan = $this->M_master->tampil_pengajuan_tanggal($tanggal)->result_array();

		$this->load->view('v_detail_leggen_pic',array('row'=>$data_pengajuan));
	}

	public function header_leggen_fin(){
		$tanggal = $this->input->post('tanggal');
		$data_pengajuan = $this->M_master->tampil_pengajuan_tanggal_jfin($tanggal)->result_array();
		$this->load->view('v_header_leggen_fin',array('row'=>$data_pengajuan));
	}

	public function detail_leggen_fin(){
		$tanggal = $this->input->post('tanggal');
		$data_pengajuan = $this->M_master->tampil_pengajuan_tanggal_jfin($tanggal)->result_array();

		$this->load->view('v_detail_leggen_fin',array('row'=>$data_pengajuan));
	}

	public function report_1(){
		$tanggal_from = $this->input->post('tanggal_from');
		$tanggal_to = $this->input->post('tanggal_to');

		$data_opex = $this->db->query("SELECT * FROM tbl_jenis_biaya WHERE opex_capex='opex' ORDER BY no_opex")->result_array();

		$data_capex = $this->db->query("SELECT * FROM tbl_jenis_biaya WHERE opex_capex='capex' ORDER BY no_capex")->result_array();

		$this->load->view('v_report_acc1',array(
			'tanggal_from' => $tanggal_from,
			'tanggal_to' => $tanggal_to,
			'data_opex' => $data_opex,
			'data_capex' => $data_capex
		));
	}

	public function report_2(){
		$cabang = $this->input->post('cabang');
		$departemen = $this->input->post('departemen');

		$data_wilayah = $this->db->query("SELECT * FROM tbl_cabang WHERE nama_cabang='$cabang'")->row_array();

		$data_opex = $this->db->query("SELECT * FROM tbl_jenis_biaya WHERE opex_capex='opex' ORDER BY no_opex")->result_array();

		$data_capex = $this->db->query("SELECT * FROM tbl_jenis_biaya WHERE opex_capex='capex' ORDER BY no_capex")->result_array();

		$this->load->view('v_report_acc2',array(
			'cabang' => $cabang,
			'departemen' => $departemen,
			'data_opex' => $data_opex,
			'data_capex' => $data_capex,
			'data_wilayah' => $data_wilayah
		));
	}


	public function report_3(){
		$tanggal_from = $this->input->post('tanggal_from');
		$tanggal_to = $this->input->post('tanggal_to');
		$coa = $this->input->post('coa');


		if($coa == 'all'){ // jika pilih semua coa
			$this->load->view('v_report_acc32',array(
				'tanggal_from' => $tanggal_from,
				'tanggal_to' => $tanggal_to
			));
		}else{ // jika pilih salah satu coa
			$data_coa = $this->db->query("SELECT DISTINCT coa, nama_coa FROM tbl_relasi_sub WHERE coa='$coa'")->result_array();
			$data_coa_satu = $this->db->query("SELECT DISTINCT coa, nama_coa FROM tbl_relasi_sub WHERE coa='$coa'")->row_array();

			$this->load->view('v_report_acc3',array(
				'tanggal_from' => $tanggal_from,
				'tanggal_to' => $tanggal_to,
				'data_coa' => $data_coa,
				'data_coa_satu' => $data_coa_satu
			));
		}

		
	}


	public function report_4(){
		$tanggal_from = $this->input->post('tanggal_from');
		$tanggal_to = $this->input->post('tanggal_to');

		$data_opex = $this->db->query("SELECT * FROM tbl_jenis_biaya WHERE opex_capex='opex' ORDER BY no_opex")->result_array();

		$data_capex = $this->db->query("SELECT * FROM tbl_jenis_biaya WHERE opex_capex='capex' ORDER BY no_capex")->result_array();

		$this->load->view('v_report_acc4',array(
			'tanggal_from' => $tanggal_from,
			'tanggal_to' => $tanggal_to,
			'data_opex' => $data_opex,
			'data_capex' => $data_capex
		));
	}


	public function report_5(){
		$tanggal = $this->input->post('tanggal');
		$coa = $this->input->post('coa');

		$data_opex = $this->db->query("SELECT * FROM tbl_jenis_biaya WHERE opex_capex='opex' ORDER BY no_opex")->result_array();

		$data_capex = $this->db->query("SELECT * FROM tbl_jenis_biaya WHERE opex_capex='capex' ORDER BY no_capex")->result_array();

		$data_coa = $this->db->query("SELECT DISTINCT coa, nama_coa FROM tbl_relasi_sub WHERE coa='$coa'")->result_array();
		$data_coa_satu = $this->db->query("SELECT DISTINCT coa, nama_coa FROM tbl_relasi_sub WHERE coa='$coa'")->row_array();

		$this->load->view('v_report_acc5',array(
			'tanggal' => $tanggal,
			'data_capex' => $data_capex,
			'data_coa' => $data_coa,
			'data_coa_satu' => $data_coa_satu
		));
	}


	public function cetak_jurnal_bmhd(){
		date_default_timezone_set("Asia/Jakarta");
		
		$tanggal = $this->input->post('tanggal');
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' AND tanggal_proses_bayar='$tanggal' OR status_bayar='Telah Dibayar' AND tanggal_proses_bayar='$tanggal'")->result_array();

		$this->load->view('v_cetak_jurnal_bmhd', array(
			'data_pengajuan' => $data_pengajuan
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("jurnal_bmhd.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}


	public function cetak_jurnal_payment(){
		date_default_timezone_set("Asia/Jakarta");
		
		$tanggal = $this->input->post('tanggal');
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Telah Dibayar' AND tanggal_bayar='$tanggal'")->result_array();

		$this->load->view('v_cetak_jurnal_payment', array(
			'data_pengajuan' => $data_pengajuan
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("jurnal_payment.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}


	public function cetak_detail_bmhd(){
		date_default_timezone_set("Asia/Jakarta");
		
		$tanggal = $this->input->post('tanggal');
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Proses Bayar' AND tanggal_proses_bayar='$tanggal' OR status_bayar='Telah Dibayar' AND tanggal_proses_bayar='$tanggal'")->result_array();

		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();

		$this->load->view('v_cetak_detail_bmhd', array(
			'data_pengajuan' => $data_pengajuan
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("pengajuan.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}


	public function cetak_detail_payment(){
		date_default_timezone_set("Asia/Jakarta");
		
		$tanggal = $this->input->post('tanggal');
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Telah Dibayar' AND tanggal_bayar='$tanggal'")->result_array();

		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();

		$this->load->view('v_cetak_detail_payment', array(
			'data_pengajuan' => $data_pengajuan
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("pengajuan.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}


	public function cetak_dok_terlambat(){
		date_default_timezone_set("Asia/Jakarta");

		// bandingkan antara tanggal sekarang (current_date) & tanggal_bayar apakah lebih dari 14 hari?
		$cabang = $this->input->post("cabang");

		if($cabang == 'all'){
			$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Telah Dibayar' AND status_dokumen='' AND datediff(tanggal_bayar, current_date()) < -14 ")->result_array();
		}else{
			$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Telah Dibayar' AND status_dokumen='' AND cabang='$cabang' AND datediff(tanggal_bayar, current_date()) < -14 ")->result_array();
		}
		

		$this->load->view('v_cetak_dokterlambat', array(
			'data_pengajuan' => $data_pengajuan
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("report_dok_terlambat.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}


}
