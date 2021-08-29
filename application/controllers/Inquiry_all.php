<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry_all extends CI_Controller {

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
							(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to')
							ORDER BY $sort_by $sort_metode")->result_array();

			}elseif(isset($_POST['cari_data2'])){
				$sub_biaya = $this->input->post('sub_biaya');
				$sort_by = $this->input->post('sort_by2');
				$sort_metode = $this->input->post('sort_metode2');

				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							sub_biaya='$sub_biaya'
							ORDER BY $sort_by $sort_metode")->result_array();

			}elseif(isset($_POST['cari_data3'])){
				$status_approval = $this->input->post('status_approval');
				$sort_by = $this->input->post('sort_by3');
				$sort_metode = $this->input->post('sort_metode3');

				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							status_approve='$status_approval'
							ORDER BY $sort_by $sort_metode")->result_array();

			}elseif(isset($_POST['cari_data4'])){
				$status_dokumen = $this->input->post('status_dokumen');
				$sort_by = $this->input->post('sort_by4');
				$sort_metode = $this->input->post('sort_metode4');

				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							status_dokumen='$status_dokumen'
							ORDER BY $sort_by $sort_metode")->result_array();

			}elseif(isset($_POST['cari_data5'])){
				$cabang = $this->input->post('cabang');
				$sort_by = $this->input->post('sort_by5');
				$sort_metode = $this->input->post('sort_metode5');

				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							cabang='$cabang'
							ORDER BY $sort_by $sort_metode")->result_array();

			}elseif(isset($_POST['cari_data6'])){
				$departemen = $this->input->post('departemen');
				$sort_by = $this->input->post('sort_by6');
				$sort_metode = $this->input->post('sort_metode6');

				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							bagian='$departemen'
							ORDER BY id_pengajuan DESC")->result_array();

			}elseif(isset($_POST['reset_filter'])){
				$sekarang = date('Y-m-d');
				$kurang_30 = mktime(0,0,0,date("n"),date("j")-30, date("Y"));
				$bulan_lalu = date("Y-m-d", $kurang_30);

				// $data_inquiry = $this->M_master->inquiryAll($hari_ini)->result_array();
				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							(tanggal BETWEEN '$bulan_lalu' AND '$sekarang')
							ORDER BY id_pengajuan DESC")->result_array();

			}elseif(isset($_POST['sort'])){
				$sekarang = date('Y-m-d');
				$kurang_30 = mktime(0,0,0,date("n"),date("j")-30, date("Y"));
				$bulan_lalu = date("Y-m-d", $kurang_30);

				$sort_metode = $this->input->post('sort_metode');

				if($sort_metode == 'tanggal_asc'){
					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							(tanggal BETWEEN '$bulan_lalu' AND '$sekarang') ORDER BY tanggal ASC")->result_array();
				}elseif($sort_metode == 'tanggal_desc'){
					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							(tanggal BETWEEN '$bulan_lalu' AND '$sekarang') ORDER BY tanggal DESC")->result_array();
				}elseif($sort_metode == 'jumlah_asc'){
					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							(tanggal BETWEEN '$bulan_lalu' AND '$sekarang') ORDER BY total ASC")->result_array();
				}elseif($sort_metode == 'jumlah_desc'){
					$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							(tanggal BETWEEN '$bulan_lalu' AND '$sekarang') ORDER BY total DESC")->result_array();
				}

				

			}else{
				$sekarang = date('Y-m-d');
				$kurang_30 = mktime(0,0,0,date("n"),date("j")-30, date("Y"));
				$bulan_lalu = date("Y-m-d", $kurang_30);

				// $data_inquiry = $this->M_master->inquiryAll($hari_ini)->result_array();
				$data_inquiry = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
							(tanggal BETWEEN '$bulan_lalu' AND '$sekarang')
							ORDER BY id_pengajuan DESC")->result_array();
			}

			$identitas = $departemen;

		}else{ // Jika Cabang
			$data_inquiry = $this->M_master->inquiry($cabang, $level)->result_array();
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_cabang = $this->db->query("SELECT * FROM tbl_cabang WHERE kode_cabang < 100")->result_array();
		$data_departemen = $this->db->query("SELECT * FROM tbl_departemen WHERE nama_departemen != 'BRANCH' AND nama_departemen != 'INFANDMATION & TEHCNOLOGY' AND nama_departemen != 'ADCO' AND nama_departemen != 'ADCOLL' AND nama_departemen != 'CMC' ORDER BY nama_departemen")->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_inquiry_all', array(
			'data_inquiry' => $data_inquiry,
			'data_cabang' => $data_cabang,
			'data_departemen' => $data_departemen
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
		$this->load->view('v_inquiry_all_detail', array(
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
	public function ambil_data_all(){
		// // Untuk Pencarian Sub Biaya
		// $cabang = $this->libraryku->tampil_user()->cabang;
		// $departemen = $this->libraryku->tampil_user()->departemen;
		// $level = $this->libraryku->tampil_user()->level;
		// if($cabang == 'HEAD OFFICE'){
		// 	$identitas = $departemen;
		// }else{
		// 	$identitas = $level;
		// }

		$modul=$this->input->post('modul');
		$id=$this->input->post('id');

		if($modul=="sub_biaya"){
			echo $this->M_master->sub_biaya_all($id);
		}
	}


	public function hapus(){
		$id = $this->input->post('id');
		$nopeng = $this->input->post('nomor_pengajuan');
		// $result = $this->M_master->hapus_pengajuan('tbl_pengajuan', array('id_pengajuan' => $id));
		$alasan_cancel = $this->input->post('alasan_cancel');
		$status_bayar = $this->input->post('status_bayar');

		if($status_bayar == 'Proses Bayar'){ //jika status bayar proses bayar, hapus juga dari proyeksi cashflow

			// Cari Data Biaya Lengkap
			$data_bayar = $this->M_master->tampil_bayar_final_filter2(array('tbl_pengajuan.nomor_pengajuan'=>$nopeng))->row_array();

			// Update Ke Proyeksi Cashflow
			$kode_cashflow = $data_bayar['kode_cashflow'];
			$biaya = $data_bayar['sub_biaya'];
			$tanggal_lama0 = $data_bayar['tanggal_rencana_bayar'];
			$tanggal_lama = date('d-m-Y', strtotime($tanggal_lama0));
			// $total = $this->input->post('total_bayar');

			// $tanggal_0 = $this->input->post('tanggal_rencana_bayar');
			// $tanggal_baru = date('d-m-Y', strtotime($tanggal_0));

			$con_cashflow = mysqli_connect('localhost','root','','db_cashflow');

			// ACTION PADA TANGGAL LAMA (KURANGI/HAPUS)
			$data_cashflow = "SELECT * FROM tbl_cashoutproj WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal_lama'";
			$r_data_cashflow = mysqli_query($con_cashflow, $data_cashflow) or die ('error cek2');
			$dt_cashflow = mysqli_fetch_array($r_data_cashflow);
			// $proj_awal = $data['projection'];
			// $proj_update = $proj_awal - $total;
			$quer_cash_kurang = "UPDATE tbl_cashoutproj SET projection='0' WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal_lama'";
			mysqli_query($con_cashflow, $quer_cash_kurang);

		}

		$result = $this->db->query("UPDATE tbl_pengajuan SET 
			status_approve='cancel by request', 
			alasan_cancel='$alasan_cancel',
			status_check='',
			alasan_pending='',
			status_bayar='',
			tanggal_proses_bayar='0000-00-00',
			wa_blast='off',
			revisi_finance='',
			revisi_rekening=''
			WHERE id_pengajuan='$id'");

		if($result>0){
			// update juga tbl_bayar (kalau2 sdh sampai finance)
			$this->db->query("UPDATE tbl_bayar SET status_bayar='', tanggal_minta_bayar='0000-00-00' WHERE nomor_pengajuan='$nopeng'");

			$this->session->set_flashdata('pesan','Pengajuan Berhasil Di-Cancel/Dibatalkan');
			redirect('Inquiry_all');
		}
	}


	public function cetak_memo($id_pengajuan){
		date_default_timezone_set("Asia/Jakarta");
		
		// Cari nomor_pengajuan
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id_pengajuan)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];

		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();

		// Tampilkan Data Memo
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		$this->load->view('v_memo_pdf', array(
			'data_approve_history' => $data_approve_history,
			'data_memo' => $data_memo
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("memo_pengajuan.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}


}
