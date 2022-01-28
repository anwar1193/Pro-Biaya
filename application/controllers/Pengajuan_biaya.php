<?php
error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_biaya extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library('libraryku');
		$this->load->model('M_master');
	}

	public function index()
	{
		cek_belum_login();

		$sub_biaya = $this->input->post('sub_biaya');
		$data_sub_biaya = $this->M_master->tampil_sub_biaya_where('tbl_sub_biaya', array(
			'id_sb' => $sub_biaya
		))->row_array();
		$form = $data_sub_biaya['form'];

		// Nyari Kode Cabang & Kode Dept Untuk Nomor Pengajuan Otomatis
		$cabang = $this->libraryku->tampil_user()->cabang;
		$tampil_cabang = $this->M_master->tampil_cabang_where('tbl_cabang', array('nama_cabang'=>$cabang));
		$kode_cabang = $tampil_cabang['kode_cabang'];

		$departemen = $this->libraryku->tampil_user()->departemen; //untuk pusat
		$level = $this->libraryku->tampil_user()->level; //untuk cabang

		if($cabang == 'HEAD OFFICE'){ //jika pusat
			$tampil_dept = $this->db->query("SELECT * FROM tbl_departemen WHERE nama_departemen='$departemen'")->row_array();
		}else{ //jika cabang
			$tampil_dept = $this->db->query("SELECT * FROM tbl_departemen WHERE nama_departemen='$level'")->row_array();
		}
	
		$kode_dept = $tampil_dept['kode_departemen'];

		$nopeng_otomatis = $this->M_master->nopeng_otomatis($kode_cabang, $kode_dept);
		$ref_no = $this->M_master->ref_no($kode_cabang, $kode_dept);
		// Penutup Nyari Kode Cabang & Kode Dept Untuk Nomor Pengajuan Otomatis

		// Untuk Pencarian Biaya di sidebar
		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$data_kendaraan = $this->db->query("SELECT * FROM tbl_kendaraan WHERE cabang = '$cabang'")->result_array();

		$data_bank_pengaju = $this->db->query("SELECT * FROM tbl_bank_pengaju ORDER BY nama_bank")->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb' => $data_jb));
		if($form == 'General'){
			$this->load->view('v_pengajuan_general', array(
				'data_sub_biaya' => $data_sub_biaya,
				'nopeng_otomatis' => $nopeng_otomatis,
				'ref_no' => $ref_no,
				'data_cabang' => $tampil_cabang,
				'data_bank_pengaju' => $data_bank_pengaju
			));
		}elseif($form == 'Perdin'){
			$this->load->view('v_perdin_hrd', array(
				'data_sub_biaya' => $data_sub_biaya,
				'nopeng_otomatis' => $nopeng_otomatis,
				'ref_no' => $ref_no,
				'data_cabang' => $tampil_cabang,
				'data_bank_pengaju' => $data_bank_pengaju
			));
		}elseif($form == 'BBM'){
			$this->load->view('v_pengajuan_bbm', array(
				'data_sub_biaya' => $data_sub_biaya,
				'nopeng_otomatis' => $nopeng_otomatis,
				'ref_no' => $ref_no,
				'data_cabang' => $tampil_cabang,
				'data_kendaraan' => $data_kendaraan,
				'data_bank_pengaju' => $data_bank_pengaju
			));
		}elseif($form == 'Kendaraan'){
			$data_sparepart = $this->M_master->tampil_data('tbl_sparepart')->result_array();

			$this->load->view('v_pengajuan_kendaraan', array(
				'data_sub_biaya' => $data_sub_biaya,
				'nopeng_otomatis' => $nopeng_otomatis,
				'ref_no' => $ref_no,
				'data_cabang' => $tampil_cabang,
				'data_kendaraan' => $data_kendaraan,
				'data_bank_pengaju' => $data_bank_pengaju,
				'data_sparepart' => $data_sparepart
			));
		}

		$this->load->view('footer');
	}

	public function ke_index(){
		redirect('home');
	}

	// function untuk relasi pilihan biaya
	public function ambil_data(){
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
			echo $this->M_master->sub_biaya($id, $identitas);
		}
	}

	public function simpan(){
		date_default_timezone_set("Asia/Jakarta");
		$departemen = $this->libraryku->tampil_user()->departemen; //untuk pusat
		$level = $this->libraryku->tampil_user()->level; //untuk cabang
		$form = $this->input->post('form');

		// Nyari Kode Cabang & Kode Dept Untuk Nomor Pengajuan Otomatis
		$cabang = $this->libraryku->tampil_user()->cabang;
		$tampil_cabang = $this->M_master->tampil_cabang_where('tbl_cabang', array('nama_cabang'=>$cabang));
		$kode_cabang = $tampil_cabang['kode_cabang'];

		if($cabang == 'HEAD OFFICE'){ //jika pusat
			$tampil_dept = $this->db->query("SELECT * FROM tbl_departemen WHERE nama_departemen='$departemen'")->row_array();
		}else{ //jika cabang
			$tampil_dept = $this->db->query("SELECT * FROM tbl_departemen WHERE nama_departemen='$level'")->row_array();
		}

		$kode_dept = $tampil_dept['kode_departemen'];

		$nopeng_otomatis = $this->M_master->nopeng_otomatis($kode_cabang, $kode_dept);

		$ref_no = $this->M_master->ref_no($kode_cabang, $kode_dept);
		// Penutup Nyari Kode Cabang & Kode Dept Untuk Nomor Pengajuan Otomatis

		$cabang = $this->input->post('cabang');
		$departemen = $this->input->post('bagian');
		$sub_biaya = $this->input->post('sub_biaya');
		$tgl_pengajuan = date('Y-m-d');
		$bulan_pengajuan = substr($tgl_pengajuan, 5,2);
		$total = $this->input->post('total');

		// Cek Apakah Budget Tersedia
		$q_budget = $this->db->query("SELECT * FROM tbl_budget WHERE cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		$r_budget = $q_budget->row_array();

		if($bulan_pengajuan=='08'){
			$sisa_saldo = $r_budget['agu20_akhir'];
		}elseif($bulan_pengajuan=='09'){
			$sisa_saldo = $r_budget['sep20_akhir'];
		}elseif($bulan_pengajuan=='10'){
			$sisa_saldo = $r_budget['okt20_akhir'];
		}elseif($bulan_pengajuan=='11'){
			$sisa_saldo = $r_budget['nov20_akhir'];
		}elseif($bulan_pengajuan=='12'){
			$sisa_saldo = $r_budget['des20_akhir'];
		}

			 // jika saldo masih cukup

			// Cari Direktur Tujuan
			$dept_tujuan = $this->input->post('dept_tujuan');
			$q_dir = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
			$direktur_tujuan = $q_dir['atasan'];

			// Cari Direktur Asal
			if($cabang != 'HEAD OFFICE'){
				if($sub_biaya == 'Biaya Sewa Tanah dan Bangunan >= 1 Tahun' || $sub_biaya == 'Biaya Sewa Tanah dan Bangunan >= 1 Tahun ADD'){
					$direktur_asal = 'HENDRI WIRJAKUSUMA';
				}else{
					$direktur_asal = '';
				}
				
				$kadiv_asal = '';
			}else{
				$dept_asal = $this->input->post('bagian');
				$q_dir_asal = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_asal' AND level='Department Head'")->row_array();
				$kadiv_asal = $q_dir_asal['nama_kadiv'];
				
				if($sub_biaya == 'Biaya Pajak Kendaraan Inventaris' AND $dept_asal=='ASSET RECOVERY'){
					$direktur_asal = '';
				}else{
					$direktur_asal = $q_dir_asal['atasan'];
				}
			}

			// Ambil Data COA Untuk dimasukan ke tbl_pengajuan
			$q_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya = '$sub_biaya'")->row_array();
			$coa = $q_coa['coa'];

			// Mencari Jalur Khusus : Cek Apakah Pengajuan 91 Up Dan Diajukan Oleh (bagian) Collection Pusat
				$bagian = $this->input->post('bagian');

				// Cari parameter_tambahan di tbl_sub_biaya (apakah 91 Up)
				$q_cek91Up = $this->db->query("SELECT * FROM tbl_sub_biaya WHERE sub_biaya='$sub_biaya'")->row_array();
				$parameter_tambahan = $q_cek91Up['parameter_tambahan'];

				if($parameter_tambahan == '91Up' AND $bagian == 'COLLECTION SUPPORT'){
					if($sub_biaya == 'Biaya BBM - 91 Up Sumatera'){
						$jalur_khusus = 'collwil_1';
					}elseif($sub_biaya == 'Biaya BBM - 91 Up Jawa - Bali'){
						$jalur_khusus = 'collwil_2';
					}elseif($sub_biaya == 'Biaya BBM - 91 Up Sulawesi - Kalimantan'){
						$jalur_khusus = 'collwil_3';
					}
				}else{
					$jalur_khusus = '';
				}
			// Penutup Mencari Jalur Khusus

			$result = $this->M_master->simpan_pengajuan('tbl_pengajuan', array(
				'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'nomor_pengajuan' => $nopeng_otomatis,
				'ref_no' => $ref_no,
				'nomor_invoice' => $this->input->post('nomor_invoice'),
				'form' => $this->input->post('form'),
				'cek_fisik' => $this->input->post('cek_fisik'),
				'kode_cashflow' => $this->input->post('kode_cashflow'),
				'level_pengaju' => $level,
				'dept_tujuan' => $this->input->post('dept_tujuan'),
				'jalur_khusus' => $jalur_khusus,
				'cabang' => $this->input->post('cabang'),
				'wilayah' => $this->input->post('wilayah'),
				'bagian' => $this->input->post('bagian'),
				'jenis_biaya' => $this->input->post('jenis_biaya'),
				'sub_biaya' => $this->input->post('sub_biaya'),
				'keterangan' => $this->input->post('keterangan'),
				'jumlah' => $this->input->post('jumlah'),
				'ppn' => $this->input->post('ppn'),
				'pph23' => $this->input->post('pph23'),
				'total' => $this->input->post('total'),
				'bank_penerima' => $this->input->post('bank_penerima'),
				'norek_penerima' => $this->input->post('norek_penerima'),
				'atas_nama' => $this->input->post('atas_nama'),
				'status_approve' => 'on proccess',
				'kadiv_asal' => $kadiv_asal,
				'direktur_asal' => $direktur_asal,
				'direktur_tujuan' => $direktur_tujuan,
				'wa_blast' => 'on',
				'coa' => $coa
			));

			if($result>0){

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
								'nomor_pengajuan' => $nopeng_otomatis,
								'file' => $image[$i],
								'nama_file' => $this->input->post('nama_file')[$i]
							];
							$this->M_master->simpan_pengajuan('tbl_pengajuan_file', $content);
						}
					}
				}


				// Update Budget Di Cabang & Dept Ybs
				if($bulan_pengajuan=='08'){
					$this->db->query("UPDATE tbl_budget 
						SET 
							agu20_akhir=(agu20_akhir-$total), agu20_realisasi=(agu20_realisasi+$total) 
						WHERE 
							cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
				}elseif($bulan_pengajuan=='09'){
					$this->db->query("UPDATE tbl_budget 
						SET 
							sep20_akhir=(sep20_akhir-$total), sep20_realisasi=(sep20_realisasi+$total) 
						WHERE 
							cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
				}elseif($bulan_pengajuan=='10'){
					$this->db->query("UPDATE tbl_budget 
						SET 
							okt20_akhir=(okt20_akhir-$total), okt20_realisasi=(okt20_realisasi+$total) 
						WHERE 
							cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
				}elseif($bulan_pengajuan=='11'){
					$this->db->query("UPDATE tbl_budget 
						SET 
							nov20_akhir=(nov20_akhir-$total), nov20_realisasi=(nov20_realisasi+$total) 
						WHERE 
							cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
				}elseif($bulan_pengajuan=='12'){
					$this->db->query("UPDATE tbl_budget 
						SET 
							des20_akhir=(des20_akhir-$total), des20_realisasi=(des20_realisasi+$total) 
						WHERE 
							cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
				}


				// Simpan Pengajuan History
				$this->M_master->simpan_approve_history('tbl_approved_history', array(
					'nomor_pengajuan' => $nopeng_otomatis,
					'status_approve' => 'on proccess',
					'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal')))
				));

				// Jika Perdin, Simpan ke tbl_pengajuan_perdin
				$pic_perdin = $this->input->post('nama_pic');
				if($pic_perdin != ''){

					$nopin = $this->input->post('nopin');
					$nama_nasabah = $this->input->post('nama_nasabah');

					for ($i=0; $i < sizeof($nopin) ; $i++) { 
						$this->M_master->simpan_pengajuan('tbl_nopin_perdin', array(
							'nomor_pengajuan' => $nopeng_otomatis,
							'nopin' => $nopin[$i],
							'nama_nasabah' => $nama_nasabah[$i]
						));
					}

					$this->M_master->simpan_pengajuan('tbl_pengajuan_perdin', array(
						'nomor_pengajuan' => $nopeng_otomatis,
						'nama_pic' => $this->input->post('nama_pic'),
						'lokasi_tujuan' => $this->input->post('lokasi_tujuan'),
						'tujuan_perdin' => $this->input->post('tujuan_perdin'),
						'dari_tanggal' => $this->input->post('dari_tanggal'),
						'ke_tanggal' => $this->input->post('ke_tanggal'),
						'lama_kunjungan' => $this->input->post('lama_kunjungan'),
						'jarak' => $this->input->post('jarak'),
						'transportasi_ket' => $this->input->post('transportasi_ket'),
						'transportasi' => $this->input->post('transportasi'),
						'penginapan_ket' => $this->input->post('penginapan_ket'),
						'penginapan' => $this->input->post('penginapan'),
						'makan' => $this->input->post('makan'),
						'lain_lain' => $this->input->post('lain_lain')
					));

				}


				// Jika BBM, Simpan ke tbl_pengajuan_bbm
				$nopol = $this->input->post('nopol');
				$nopol_pribadi = $this->input->post('nopol_pribadi');

				if($nopol != '' AND $nopol_pribadi == ''){

					$this->M_master->simpan_pengajuan('tbl_pengajuan_bbm', array(
						'nomor_pengajuan' => $nopeng_otomatis,
						'nopol' => $this->input->post('nopol'),
						'jenis_kendaraan' => $this->input->post('jenis_kendaraan'),
						'merk_kendaraan' => $this->input->post('merk_kendaraan'),
						'kapasitas_silinder' => $this->input->post('kapasitas_silinder'),
						'kilometer_pengajuan' => $this->input->post('kilometer_pengajuan'),
						'keperluan_pengajuan_bbm' => $this->input->post('keperluan_pengajuan_bbm'),
						'jenis_bbm' => $this->input->post('jenis_bbm')
					));

				}elseif($nopol == '' AND $nopol_pribadi != ''){

					$this->M_master->simpan_pengajuan('tbl_pengajuan_bbm', array(
						'nomor_pengajuan' => $nopeng_otomatis,
						'nopol' => $this->input->post('nopol_pribadi'),
						'jenis_kendaraan' => $this->input->post('jenis_kendaraan_pribadi'),
						'merk_kendaraan' => $this->input->post('merk_kendaraan_pribadi'),
						'kapasitas_silinder' => $this->input->post('kapasitas_silinder_pribadi'),
						'kilometer_pengajuan' => $this->input->post('kilometer_pengajuan'),
						'keperluan_pengajuan_bbm' => $this->input->post('keperluan_pengajuan_bbm'),
						'jenis_bbm' => $this->input->post('jenis_bbm')
					));

				}
				// END Jika BBM, Simpan ke tbl_pengajuan_bbm


				// Jika Biaya Perbaikan Kendaraan simpan ke tabel : tbl_pengajuan_kendaraan, tbl_rincian_sparepart, dan tbl_rincian_jasa_perbaikan
				$nopol_perbaikan = $this->input->post('nopol_perbaikan');
				if($form=='Kendaraan' && $nopol_perbaikan != ''){

					$this->M_master->simpan_pengajuan('tbl_pengajuan_kendaraan', array(
						'nomor_pengajuan' => $nopeng_otomatis,
						'nopol_perbaikan' => $this->input->post('nopol_perbaikan'),
						'merk_kendaraan' => $this->input->post('merk_kendaraan'),
						'kilometer_pengajuan' => $this->input->post('kilometer_pengajuan'),
						'diskon_sparepart' => $this->input->post('diskon_sparepart'),
						'diskon_jasa' => $this->input->post('diskon_jasa')
					));


					$sparepart = $this->input->post('sparepart');
					for($i=0; $i<sizeof($sparepart); $i++){
						$this->M_master->simpan_pengajuan('tbl_rincian_sparepart', array(
							'nomor_pengajuan' => $nopeng_otomatis,
							'sparepart' => $this->input->post('sparepart')[$i],
							'jumlah_sparepart' => $this->input->post('jumlah_sparepart')[$i],
							'keterangan_sparepart' => '-'
						));
					}
					

					$jasa = $this->input->post('jasa');
					for($i=0; $i<sizeof($jasa); $i++){
						$this->M_master->simpan_pengajuan('tbl_rincian_jasa_perbaikan', array(
							'nomor_pengajuan' => $nopeng_otomatis,
							'jasa' => $this->input->post('jasa')[$i],
							'jumlah_jasa' => $this->input->post('jumlah_jasa')[$i],
							'keterangan_jasa' => '-'
						));
					}

				}
				// END Jika Biaya Perbaikan Kendaraan simpan ke tabel : tbl_pengajuan_kendaraan, tbl_rincian_sparepart, dan tbl_rincian_jasa_perbaikan
				

				// Simpan Ke tbl_bayar
				$nomor_pengajuan_fr = $this->input->post('nomor_pengajuan_fr');
				$tanggal_minta_bayar = $this->input->post('tanggal_minta_bayar');
				$jumlah_bayar = $this->input->post('jumlah_bayar');
				$ppn_bayar = $this->input->post('ppn_bayar');

				for ($i=0; $i < sizeof($nomor_pengajuan_fr) ; $i++) { 
					$this->M_master->simpan_pengajuan('tbl_bayar', array(
						'nomor_pengajuan' => $nomor_pengajuan_fr[$i],
						'pembayaran_ke' => $i + 1,
						'tanggal_minta_bayar' => $tanggal_minta_bayar[$i],
						'jumlah_bayar' => $jumlah_bayar[$i],
						'ppn_bayar' => $ppn_bayar[$i],
						'status_bayar' => 'On Proccess'
					));
				}

				// hapus sampah pengajuan hasil looping
				$this->db->delete('tbl_bayar', array('jumlah_bayar' => 0));

				// Jika tambah memo, ke halaman input memo
				$tambahkan_memo = $this->input->post('tambahkan_memo');

				if($tambahkan_memo == 'ya'){

					$departemen = $this->libraryku->tampil_user()->departemen; //untuk pusat
					$level = $this->libraryku->tampil_user()->level; //untuk cabang

					// Untuk Pencarian Biaya di sidebar
					if($cabang == 'HEAD OFFICE'){
						$identitas = $departemen;
					}else{
						$identitas = $level;
					}

					$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

					$this->load->view('header');
					$this->load->view('sidebar', array('data_jb' => $data_jb));
					$this->load->view('v_tambah_memo', array('nopeng' => $nopeng_otomatis));
					$this->load->view('footer');


				}else{
					$this->session->set_flashdata('pesan','Pengajuan Biaya Terkirim');
					redirect('home');
				}
		}

	}


	// public function frekuensi_bayar(){
	// 	$nomor_pengajuan = $nopeng_otomatis;
	// 	$tanggal_minta_bayar = $this->input->post('tanggal_minta_bayar');
	// 	$jumlah_bayar = $this->input->post('jumlah_bayar');

	// 	for ($i=0; $i < sizeof($nomor_pengajuan) ; $i++) { 
	// 		$this->M_master->simpan_pengajuan('tbl_bayar', array(
	// 			'nomor_pengajuan' => $nomor_pengajuan[$i],
	// 			'tanggal_minta_bayar' => $tanggal_minta_bayar[$i],
	// 			'jumlah_bayar' => $jumlah_bayar[$i],
	// 			'status_bayar' => 'On Proccess'
	// 		));
	// 	}

	// 	$this->session->set_flashdata('pesan','Pengajuan Biaya Terkirim');
	// 	redirect('home');
	// }


	public function over_budget(){
		$this->load->view('v_over_budget');
	}

	public function lanjut_over_budget(){
		$alasan_ob_0 = $this->input->post('alasan_over_budget');
		$alasan_ob = addslashes($alasan_ob_0);
		$result = $this->db->query("UPDATE tbl_pengajuan SET 
					status_approve='on proccess', alasan_over_budget='$alasan_ob'
					WHERE status_approve='over budget'
				  ");

		if($result>0){
			$this->session->set_flashdata('pesan','Pengajuan Biaya Terkirim');
			redirect('home');
		}
	}

	public function batal_over_budget(){
		// Kembalikan saldo ke post budget
		$res_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_approve='over budget' ORDER BY id_pengajuan LIMIT 0,1")->row_array();
		$total = $res_pengajuan['total'];
		$cabang = $res_pengajuan['cabang'];
		$departemen = $res_pengajuan['bagian'];
		$sub_biaya = $res_pengajuan['sub_biaya'];
		$tgl_pengajuan = $res_pengajuan['tanggal'];
		$bulan_pengajuan = substr($tgl_pengajuan, 5,2);

		// Update Budget Di Cabang & Dept Ybs
		if($bulan_pengajuan=='08'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					agu20_akhir=(agu20_akhir+$total), agu20_realisasi=(agu20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='09'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					sep20_akhir=(sep20_akhir+$total), sep20_realisasi=(sep20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='10'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					okt20_akhir=(okt20_akhir+$total), okt20_realisasi=(okt20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='11'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					nov20_akhir=(nov20_akhir+$total), nov20_realisasi=(nov20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}elseif($bulan_pengajuan=='12'){
			$this->db->query("UPDATE tbl_budget 
				SET 
					des20_akhir=(des20_akhir+$total), des20_realisasi=(des20_realisasi-$total) 
				WHERE 
					cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
		}

		// Hapus Pengajuan Dibatalkan
		$res_hapus = $this->db->query("DELETE FROM tbl_pengajuan WHERE status_approve='over budget'");

		if($res_hapus>0){
			echo '<script>alert("Pengajuan Dibatalkan");window.location="ke_index";</script>';
		}

	}


	public function kirim_memo(){
		$result = $this->M_master->simpan_pengajuan('tbl_memo', array(
			'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
			'nomor_memo' => $this->input->post('nomor_memo'),
			'kepada' => $this->input->post('kepada'),
			'cc' => $this->input->post('cc'),
			'dari' => $this->input->post('dari'),
			'perihal' => $this->input->post('perihal'),
			'tanggal_memo' => date('Y-m-d',strtotime($this->input->post('tanggal_memo'))),
			'isi_memo' => $this->input->post('isi_memo')
		));

		if($result > 0){
			$this->session->set_flashdata('pesan','Pengajuan Biaya & Memo Berhasil Dikirim');
			redirect('home');
		}

	}

}
