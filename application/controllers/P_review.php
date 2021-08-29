<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class P_review extends CI_Controller {

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

		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$data_filter_biaya = $this->db->query("SELECT * FROM tbl_sub_biaya WHERE departemen_tujuan='$departemen'")->result_array();

		if($level=='Department Head'){ //yang head sementara di hidden via sidebar
			$data_review = $this->M_master->tampil_review_head($departemen)->result_array();
		}elseif($level=='Departement PIC'){

			if(isset($_POST['cari_data'])){ //Jika tombol cari data diklik

				$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from')));
				$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to')));

				$data_review = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
					status_approve = 'final approved' AND dept_tujuan='$departemen' AND status_check=''
					AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to')
					ORDER BY id_pengajuan DESC")->result_array();

			}elseif(isset($_POST['cari_data2'])){ //Jika tombol cari data2 diklik

				$sub_biaya = $this->input->post('sub_biaya');

				$data_review = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
					status_approve = 'final approved' AND dept_tujuan='$departemen' AND status_check=''
					AND sub_biaya='$sub_biaya'
					ORDER BY id_pengajuan DESC")->result_array();

			}else{ //posisi default

				$data_review = $this->M_master->tampil_review($departemen)->result_array();

			}
			
		}
		
		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_review', array(
			'data_review' => $data_review,
			'data_filter_biaya' => $data_filter_biaya
		));
		$this->load->view('footer');
	}

	public function hapus($id){
		$result = $this->M_master->hapus_pengajuan('tbl_pengajuan', array('id_pengajuan' => $id));
		if($result>0){
			redirect('P_on_proccess');
		}
	}

	public function detail($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_pending_history = $this->M_master->tampil_pending_history('tbl_pending_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();

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
		$data_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->result_array();
		$frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->num_rows();

		$data_byr2 = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->result_array();

		// Jumlah bayar dari penambahan SPLIT
		$jml_split = $this->db->query("SELECT SUM(jumlah_bayar) AS jml_split FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		// untuk head saat verifikasi (berkaitan dengan masukan data ke cashflow)
		$data_check_pic = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan'=>$no_pengajuan))->row_array();

		// Nomor Jurnal otomatis
		$nojur_otomatis = $this->M_master->nojur_otomatis();

		// Tampilkan Data Memo
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_detail_review', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_perdin' => $data_perdin,
			'data_check_pic' => $data_check_pic,
			'data_pending_history' => $data_pending_history,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'jml_split' => $jml_split,
			'no_jurnal' => $nojur_otomatis,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}


	public function lanjut(){
		date_default_timezone_set("Asia/Jakarta");
		$departemen = $this->libraryku->tampil_user()->departemen;

		// Menentukan tipe transaksi
		$nmr_pengajuan = $this->input->post('nomor_pengajuan');
		$q_tp = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$nmr_pengajuan'");
		$tp_trans = $q_tp->num_rows();

		// buat simpan ke tbl_check dan update status_check di tbl_pengajuan (tambah field status_check dulu)
		$result = $this->M_master->simpan_pengajuan('tbl_check', array(
			'id_pengajuan' => $this->input->post('id'),
			'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
			'tipe_transaksi' => $tp_trans
		));

		if($result>0){

			// simpan file pendukung nya
			$data = [];
			$count = count($_FILES['files']['name']);
			for($i=0; $i<$count; $i++){
				if(!empty($_FILES['files']['name'][$i])){
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = './file_check';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|xlsx';
					$config['max_size'] = 2048;
					// $config['file_name'] = $_FILES['files']['name'][$i];
					$config['file_name'] = 'check-'.date('ymd').'-'.substr(md5(rand()),0,10).'-'.$i;
					// $config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						$image[$i] = $filename;
						$content = [
							'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
							'file' => $image[$i]
						];
						$this->M_master->simpan_pengajuan('tbl_check_file', $content);
					}
				}
			}

			// Update status_check di tbl_pengajuan
			$id = $this->input->post('id');
			// $data_awal = $this->M_master->tampil_pengajuan_detail($id)->row_array();
			$data_awal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nmr_pengajuan'")->row_array();
			$jumlah_awal = $data_awal['harga_sebelumnya'];
			$sub_biaya = $data_awal['sub_biaya'];
			$jumlah_baru = $this->input->post('jumlah');

			// untuk mengecek/debugging jumlah baru & jumlah lama
			// var_dump($jumlah_awal);
			// var_dump($jumlah_baru);
			// exit;

			if($jumlah_baru>$jumlah_awal && $jumlah_awal != 0){ //jika lebih mahal
				
				// Potong Pajak Split Pembayaran Terakhir
				$idsplit_terakhir = $this->input->post('ids_terakhir');
				$ppn = $this->input->post('ppn');
				$pph23 = $this->input->post('pph23');
				$pph42 = $this->input->post('pph42');
				$pph21 = $this->input->post('pph21');

				// Cek Apakah PPN sudah diisi sebelumnya
				$nopeng = $this->input->post('nomor_pengajuan');
				$cek_ppn0 = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nopeng'")->row_array();
				$cek_ppn = $cek_ppn0['ppn'];

				if($cek_ppn == 0){
					// Exekusi Potong Pajak
					$this->db->query("UPDATE tbl_bayar SET jumlah_bayar = jumlah_bayar + $ppn - ($pph23 + $pph42 + $pph21) WHERE id=$idsplit_terakhir");
				}

				$this->M_master->update_pengajuan('tbl_pengajuan',array(
					'jumlah' => $this->input->post('jumlah'),
					'ppn' => $this->input->post('ppn'),
					'pph23' => $this->input->post('pph23'),
					'pph42' => $this->input->post('pph42'),
					'pph21' => $this->input->post('pph21'),
					'total' => $this->input->post('total'),
					'status_check' => 'Checked',
					'checked_by' => $departemen,
					'checked_level' => 'PIC',
					'checked_on' => date('Y-m-d'),
					'balik_lagi' => 'Ya',
					'ket_balik' => $this->input->post('ket_balik'),
					'nomor_jurnal' => $this->input->post('nomor_jurnal')
				), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));


				$this->session->set_flashdata('pesan','Karena Ada Kenaikan Harga, Pengajuan Akan Di Periksa Kembali Oleh Approval Terakhir');
				redirect('p_review/index');

			}else{

				// Potong Pajak Split Pembayaran Terakhir
				$idsplit_terakhir = $this->input->post('ids_terakhir');
				$ppn = $this->input->post('ppn');
				$pph23 = $this->input->post('pph23');
				$pph42 = $this->input->post('pph42');
				$pph21 = $this->input->post('pph21');

				// Cek Apakah PPN sudah diisi sebelumnya
				$nopeng = $this->input->post('nomor_pengajuan');
				$cek_ppn0 = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nopeng'")->row_array();
				$cek_ppn = $cek_ppn0['ppn'];

				if($cek_ppn == 0){
					// Exekusi Potong Pajak
					$this->db->query("UPDATE tbl_bayar SET jumlah_bayar = jumlah_bayar + $ppn - ($pph23 + $pph42 + $pph21) WHERE id=$idsplit_terakhir");
				}

				$this->M_master->update_pengajuan('tbl_pengajuan',array(
					'jumlah' => $this->input->post('jumlah'),
					'ppn' => $this->input->post('ppn'),
					'pph23' => $this->input->post('pph23'),
					'pph42' => $this->input->post('pph42'),
					'pph21' => $this->input->post('pph21'),
					'total' => $this->input->post('total'),
					'status_check' => 'Checked',
					'checked_by' => $departemen,
					'checked_level' => 'PIC',
					'checked_on' => date('Y-m-d'),
					'nomor_jurnal' => $this->input->post('nomor_jurnal')
				), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));

				$this->session->set_flashdata('pesan','Pengajuan Berhasil Di Verifikasi');
				redirect('p_review/index');

			}


		}
	}


	public function lanjut_perdin(){
		date_default_timezone_set("Asia/Jakarta");
		$departemen = $this->libraryku->tampil_user()->departemen;

		// Menentukan tipe transaksi
		$nmr_pengajuan = $this->input->post('nomor_pengajuan');
		$q_tp = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$nmr_pengajuan'");
		$tp_trans = $q_tp->num_rows();

		// buat simpan ke tbl_check dan update status_check di tbl_pengajuan (tambah field status_check dulu)
		$result = $this->M_master->simpan_pengajuan('tbl_check', array(
			'id_pengajuan' => $this->input->post('id'),
			'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
			'tipe_transaksi' => $tp_trans
		));

		if($result>0){

			// Update tbl_pengajuan_perdin
			$this->M_master->update_pengajuan('tbl_pengajuan_perdin',array(
				'transportasi' => $this->input->post('biaya_transportasi'),
				'penginapan' => $this->input->post('biaya_penginapan'),
				'lain_lain' => $this->input->post('lain_lain')
			), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));
			// Penutup Update tbl_pengajuan_perdin

			// Update tbl_bayar
			$this->M_master->update_pengajuan('tbl_bayar',array(
				'jumlah_bayar' => $this->input->post('total')
			), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));
			// Penutup Update tbl_bayar

			// simpan file pendukung nya
			$data = [];
			$count = count($_FILES['files']['name']);
			for($i=0; $i<$count; $i++){
				if(!empty($_FILES['files']['name'][$i])){
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = './file_check';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|xlsx';
					$config['max_size'] = 2048;
					// $config['file_name'] = $_FILES['files']['name'][$i];
					$config['file_name'] = 'check-'.date('ymd').'-'.substr(md5(rand()),0,10).'-'.$i;
					// $config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						$image[$i] = $filename;
						$content = [
							'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
							'file' => $image[$i]
						];
						$this->M_master->simpan_pengajuan('tbl_check_file', $content);
					}
				}
			}

			// Update status_check di tbl_pengajuan
			$id = $this->input->post('id');
			$data_awal = $this->M_master->tampil_pengajuan_detail($id)->row_array();
			$jumlah_awal = $data_awal['jumlah'];
			$jumlah_baru = $this->input->post('jumlah');

			if($jumlah_baru>$jumlah_awal){ //jika lebih mahal
				$this->M_master->update_pengajuan('tbl_pengajuan',array(
					'jumlah' => $this->input->post('jumlah'),
					'total' => $this->input->post('total'),
					'status_check' => 'Checked',
					'checked_by' => $departemen,
					'checked_level' => 'PIC',
					'checked_on' => date('Y-m-d'),
					'balik_lagi' => 'Ya',
					'ket_balik' => $this->input->post('ket_balik'),
					'nomor_jurnal' => $this->input->post('nomor_jurnal')
				), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));
			}else{
				$this->M_master->update_pengajuan('tbl_pengajuan',array(
					'jumlah' => $this->input->post('jumlah'),
					'total' => $this->input->post('total'),
					'status_check' => 'Checked',
					'checked_by' => $departemen,
					'checked_level' => 'PIC',
					'checked_on' => date('Y-m-d'),
					'nomor_jurnal' => $this->input->post('nomor_jurnal')
				), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));
			}

			

			$this->session->set_flashdata('pesan','Pengajuan Berhasil Di Verifikasi');
			redirect('p_review/index');
		}
	}


	public function verifikasi_final(){
		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'checked_level' => 'HEAD'
		), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));
		
		if($result>0){

			$this->session->set_flashdata('pesan','Pengajuan Berhasil Di Verifikasi');
			redirect('p_review/index');
		}
	}


	public function pending(){
		$departemen = $this->libraryku->tampil_user()->departemen;
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
		
		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'status_check' => 'Pending',
			'checked_by' => $departemen,
			'checked_on' => date('Y-m-d'),
			'alasan_pending' => $this->input->post('note')
		), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));

		if($result>0){
			// Simpan Ke History Pending
			$this->M_master->simpan_pengajuan('tbl_pending_history', array(
				'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
				'pending_by' => $departemen,
				'nama_pic' => $nama_lengkap,
				'tanggal' => date('Y-m-d'),
				'note' => $this->input->post('note')
			));
			
			$this->session->set_flashdata('pesan','Pengajuan Berhasil Di Pending');
			redirect('p_review/index');
		}
	}

	public function ubah_split(){
		$no_pengajuan = $this->input->post('nomor_pengajuan');

		// Masukan Dulu Harga Sebelumnya sebelum diubah, di tbl_pengajuan
		$jml_sebelumnya = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$harga_sebelumnya = $jml_sebelumnya['jumlah'];
		$ppn = $jml_sebelumnya['ppn'];
		$jumlah_baru = $this->input->post('jumlah_bayar');
		$total = $jumlah_baru + $ppn;

		$this->M_master->update_pengajuan('tbl_pengajuan', array(
			'jumlah' => $this->input->post('jumlah_bayar'),
			'ppn' => $this->input->post('ppn_bayar'),
			'harga_sebelumnya' => $harga_sebelumnya,
			'total' => $total
		), array('nomor_pengajuan' => $no_pengajuan));

		// cari id pengajuan untuk redirect halaman
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$id_pengajuan = $data_pengajuan['id_pengajuan'];

		$result = $this->M_master->update_pengajuan('tbl_bayar', array(
			'tanggal_minta_bayar' => $this->input->post('tanggal_minta_bayar'),
			'jumlah_bayar' => $this->input->post('jumlah_bayar'),
			'ppn_bayar' => $this->input->post('ppn_bayar')
		), array('id' => $this->input->post('id')));

		if($result>0){
			$this->session->set_flashdata('pesan','Update Berhasil');
			redirect('p_review/detail/'.$id_pengajuan);
		}
	}


	public function ubah_split_multi(){
		$no_pengajuan = $this->input->post('nomor_pengajuan');

		// Masukan Dulu Harga Sebelumnya sebelum diubah, di tbl_pengajuan
		$jml_sebelumnya = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$harga_sebelumnya = $jml_sebelumnya['jumlah'];
		// $ppn = $jml_sebelumnya['ppn'];
		// $jumlah_baru = $this->input->post('jumlah_bayar');
		// $total = $jumlah_baru + $ppn;

		// cari id pengajuan untuk redirect halaman
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$id_pengajuan = $data_pengajuan['id_pengajuan'];

		// Ubah Di tbl_bayar
		$this->M_master->update_pengajuan('tbl_bayar', array(
			'tanggal_minta_bayar' => $this->input->post('tanggal_minta_bayar'),
			'jumlah_bayar' => $this->input->post('jumlah_bayar'),
			'ppn_bayar' => $this->input->post('ppn_bayar')
		), array('id' => $this->input->post('id')));

		// Ambil Total Jumlah & Total PPN dari tbl_bayar, untuk update di tbl_pengajuan
		$data_total = $this->db->query("SELECT SUM(jumlah_bayar) AS total_jumlah, SUM(ppn_bayar) AS total_ppn FROM tbl_bayar WHERE nomor_pengajuan = '$no_pengajuan'")->row_array();

		$total_jumlah = $data_total['total_jumlah'];
		$total_ppn = $data_total['total_ppn'];

		// Ubah Di tbl_pengajuan
		$this->M_master->update_pengajuan('tbl_pengajuan', array(
			'jumlah' => $total_jumlah,
			'ppn' => $total_ppn,
			'harga_sebelumnya' => $harga_sebelumnya,
			'total' => $total_jumlah + $total_ppn
		), array('nomor_pengajuan' => $no_pengajuan));

		$this->session->set_flashdata('pesan','Update Berhasil');
		redirect('p_review/detail/'.$id_pengajuan);

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

		// Untuk Data Split Pembayaran
		$data_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->result_array();
		$frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->num_rows();

		$this->load->view('v_pdf_review', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("pengajuan.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
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
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$id_pengajuan = $data_pengajuan['id_pengajuan'];

		$this->session->set_flashdata('pesan','Dokumen Baru Berhasil Diupdate');
		redirect('p_review/detail/'.$id_pengajuan);
	}

}
