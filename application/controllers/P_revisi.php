<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_revisi extends CI_Controller {

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

		if($cabang=='HEAD OFFICE'){
			$data_revisi = $this->M_master->tampil_revisiHO($departemen)->result_array();
			$identitas = $departemen;
		}else{
			$data_revisi = $this->M_master->tampil_revisi($cabang, $level)->result_array();
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_revisi', array('data_revisi' => $data_revisi));
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
		$this->load->view('v_p_detail_revisi', array(
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

	public function edit($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();

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

		$data_bank_pengaju = $this->db->query("SELECT * FROM tbl_bank_pengaju ORDER BY nama_bank")->result_array();

		$data_berkas = $this->db->query("SELECT * FROM tbl_pengajuan_file WHERE nomor_pengajuan='$no_pengajuan'")->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_edit_pengajuan', array(
			'data_pengajuan' => $data_pengajuan,
			'data_file' => $data_file,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_bank_pengaju' => $data_bank_pengaju,
			'data_berkas' => $data_berkas
		));
		$this->load->view('footer');
	}


	public function edit_memo($id){
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan = '$no_pengajuan'")->row_array();

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
		$this->load->view('v_edit_memo', array(
			'data_pengajuan' => $data_pengajuan,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}


	public function update(){
		date_default_timezone_set("Asia/Jakarta");
		$level = $this->libraryku->tampil_user()->level;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$cabang = $this->libraryku->tampil_user()->cabang;
		$sub_biaya = $this->input->post('sub_biaya');

		// Update Budget Jika Ada Perubahan Harga
		$tgl_pengajuan = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$bulan_pengajuan = substr($tgl_pengajuan, 5,2);
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
		$pengajuan_sebelumnya = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nomor_pengajuan'")->row_array();
		$total_pengajuan_sebelumnya = $pengajuan_sebelumnya['total'];
		$total_pengajuan_baru = $this->input->post('total');

		if($total_pengajuan_sebelumnya != $total_pengajuan_baru){ //jika ada perubahan harga

			if($total_pengajuan_baru > $total_pengajuan_sebelumnya){ //jika lebih mahal
				$selisih_pengajuan = $total_pengajuan_baru - $total_pengajuan_sebelumnya;
				if($bulan_pengajuan=='11'){
					$this->db->query("UPDATE tbl_budget 
						SET 
							nov20_akhir=(nov20_akhir-$selisih_pengajuan), nov20_realisasi=(nov20_realisasi+$selisih_pengajuan) 
						WHERE 
							cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
				}elseif($bulan_pengajuan=='12'){
					$this->db->query("UPDATE tbl_budget 
						SET 
							des20_akhir=(des20_akhir-$selisih_pengajuan), des20_realisasi=(des20_realisasi+$selisih_pengajuan) 
						WHERE 
							cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
				}

			}elseif($total_pengajuan_baru < $total_pengajuan_sebelumnya){ //Jika Lebih Murah
				$selisih_pengajuan = $total_pengajuan_sebelumnya - $total_pengajuan_baru;
				if($bulan_pengajuan=='11'){
					$this->db->query("UPDATE tbl_budget 
						SET 
							nov20_akhir=(nov20_akhir+$selisih_pengajuan), nov20_realisasi=(nov20_realisasi-$selisih_pengajuan) 
						WHERE 
							cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
				}elseif($bulan_pengajuan=='12'){
					$this->db->query("UPDATE tbl_budget 
						SET 
							des20_akhir=(des20_akhir+$selisih_pengajuan), des20_realisasi=(des20_realisasi-$selisih_pengajuan) 
						WHERE 
							cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
				}
			}

		}
		// Penutup Update Budget Jika Ada Perubahan Harga

		// Beda Hitungan Perdin & General
		$jenis_pengajuan = $pengajuan_sebelumnya['form'];
		if($jenis_pengajuan == 'Perdin'){
			$biaya_transportasi = $this->input->post('transportasi');
			$biaya_hotel = $this->input->post('penginapan');
			$biaya_lain = $this->input->post('lain_lain');
			$jml =  $biaya_transportasi + $biaya_hotel + $biaya_lain;
			$tot = $biaya_transportasi + $biaya_hotel + $biaya_lain;
		}else{
			$jml = $this->input->post('jumlah');
			$tot = $this->input->post('total');
		}


		// Mencari Next Approve.....................................................
		if($cabang == 'HEAD OFFICE'){ //jika pusat

			$q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$departemen' AND level='Department Head'")->row_array();
			$next_approve_nama = $q_next['nama_lengkap'];
			$next_approve_level = $q_next['level'];
			$next_approve_email = $q_next['email'];
			
		}else{ //jika cabang

			$q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$cabang' AND level='Branch Manager'")->row_array();
			$next_approve_nama = $q_next['nama_lengkap'];
			$next_approve_level = $q_next['level'];
			$next_approve_email = $q_next['email'];

		}
		// END Mencari Next Approve....................................................
		

		// Update tbl_pengajuan
		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
			'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
			'level_pengaju' => $level,
			'dept_tujuan' => $this->input->post('dept_tujuan'),
			'cabang' => $this->input->post('cabang'),
			'wilayah' => $this->input->post('wilayah'),
			'bagian' => $this->input->post('bagian'),
			'jenis_biaya' => $this->input->post('jenis_biaya'),
			'sub_biaya' => $this->input->post('sub_biaya'),
			'nomor_invoice' => $this->input->post('nomor_invoice'),
			'keterangan' => $this->input->post('keterangan'),
			'jumlah' => $jml,
			'ppn' => $this->input->post('ppn'),
			'pph23' => $this->input->post('pph23'),
			'total' => $tot,
			'bank_penerima' => $this->input->post('bank_penerima'),
			'norek_penerima' => $this->input->post('norek_penerima'),
			'atas_nama' => $this->input->post('atas_nama'),
			'status_approve' => 'on proccess',
			'approved_by' => '',
			'nama_pengapprove' => ''
		), array('id_pengajuan' => $this->input->post('id')));

		if($result>0){

			// Simpan Next Approve ke tbl_next_approve...................................
			$this->M_master->simpan_pengajuan('tbl_next_approve', array(
				'nomor_pengajuan' => $nomor_pengajuan,
				'next_approve_nama' => $next_approve_nama,
				'next_approve_level' => $next_approve_level,
				'next_approve_email' => $next_approve_email
			));
			// END Simpan Next Approve ke tbl_next_approve...............................

			if($jenis_pengajuan == 'Perdin'){
				// Update tbl_pengajuan
				$result = $this->M_master->update_pengajuan('tbl_pengajuan_perdin', array(
					'nama_pic' => $this->input->post('nama_pic'),
					'lokasi_tujuan' => $this->input->post('lokasi_tujuan'),
					'tujuan_perdin' => $this->input->post('tujuan_perdin'),
					'dari_tanggal' => date('Y-m-d',strtotime($this->input->post('dari_tanggal'))),
					'ke_tanggal' => date('Y-m-d',strtotime($this->input->post('ke_tanggal'))),
					'lama_kunjungan' => $this->input->post('lama_kunjungan'),
					'transportasi_ket' => $this->input->post('transportasi_ket'),
					'transportasi' => $this->input->post('transportasi'),
					'penginapan_ket' => $this->input->post('penginapan_ket'),
					'penginapan' => $this->input->post('penginapan'),
					'makan' => $this->input->post('makan'),
					'lain_lain' => $this->input->post('lain_lain')
				), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));
			}

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
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|xlsx';
					$config['max_size'] = 2048;
					// $config['file_name'] = $_FILES['files']['name'][$i];
					$config['file_name'] = date('Y-m-d').'-'.$refno.'-'.substr(md5(rand()),0,5).'-'.$i;
					// $config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						$image[$i] = $filename;
						$content = [
							'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
							'file' => $image[$i],
							'nama_file' => $this->input->post('nama_file')[$i]
						];
						$this->M_master->simpan_pengajuan('tbl_pengajuan_file', $content);
					}
				}
			}

			// Simpan Pengajuan History
			$this->M_master->simpan_approve_history('tbl_approved_history', array(
				'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
				'status_approve' => 'on proccess',
				'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal')))
			));

			// Ubah Juga tbl_bayar jika ada perubahan
			$tipe_transaksi = $this->input->post('tipe_transaksi');

			if($tipe_transaksi!=0){ //jika ada perubahan
				$nopeng = $this->input->post('nomor_pengajuan');

				// hapus data split bayar sebelumnya
				$hapus_bayar = $this->db->query("DELETE FROM tbl_bayar WHERE nomor_pengajuan='$nopeng'");

				if($hapus_bayar>0){
					// Buat split bayar baru
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
				}
			}
			// Penutup Ubah Juga tbl_bayar jika ada perubahan


			// Cek Apakah Di pengajuan Yang Di Revisi Ada Memo

			$cek_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan = '$nomor_pengajuan'")->num_rows();

			if($cek_memo > 0){ //jika ada memo di pengajuan, arahkan ke halaman edit memo

				$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan = '$nomor_pengajuan'")->row_array();

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
				$this->load->view('v_edit_memo', array(
					'data_memo' => $data_memo
				));
				$this->load->view('footer');

			}else{ // jika tidak ada memo di pengajuan

				// Cek apakah ingin tambahkan memo
				$tambahkan_memo = $this->input->post('tambahkan_memo');

				if($tambahkan_memo == 'ya'){ // jika ingin tambahkan memo, arahkan ke halaman tambahkan memo

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
					$this->load->view('v_tambah_memo', array('nopeng' => $nomor_pengajuan));
					$this->load->view('footer');

				}else{ // jika tidak ingin tambahkan memo, update pengajuan berhasil
					$this->session->set_flashdata('pesan','Pengajuan Biaya Telah Diperbaiki & Akan Diproses Kembali');
					redirect('p_revisi/index');
				}

				
			}

			
		}
	}

	public function update_memo(){
		date_default_timezone_set("Asia/Jakarta");

		$result = $this->M_master->update_pengajuan('tbl_memo', array(
			'nomor_memo' => $this->input->post('nomor_memo'),
			'kepada' => $this->input->post('kepada'),
			'cc' => $this->input->post('cc'),
			'dari' => $this->input->post('dari'),
			'perihal' => $this->input->post('perihal'),
			'tanggal_memo' => date('Y-m-d',strtotime($this->input->post('tanggal_memo'))),
			'isi_memo' => $this->input->post('isi_memo')
		), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));

		if($result > 0){
			// Update tbl_pengajuan
			$this->M_master->update_pengajuan('tbl_pengajuan', array(
				'status_approve' => 'on proccess',
				'approved_by' => '',
				'nama_pengapprove' => ''
			), array('nomor_pengajuan' => $this->input->post('nomor_pengajuan')));

			$this->session->set_flashdata('pesan','Memo Berhasil Diupdate');
			redirect('p_revisi');
		}
	}

	public function hapus_file($id, $id_pengajuan){
		// Ambil Data Untuk Hapus Gambar
		// $data = $this->M_crudGambar->ambil_data('tbl_barang',array('id'=>$id));

		$data = $this->db->query("SELECT * FROM tbl_pengajuan_file WHERE id=$id")->result_array();
		$result = $this->db->query("DELETE FROM tbl_pengajuan_file WHERE id=$id");

		// $result = $this->M_crudGambar->hapus('tbl_barang',array('id'=>$id));

		if($result>0){
			// jika hapus data, gambar di folder juga dihapus
			foreach($data as $row){
				$gambar_lama = $row['file'];

				if(file_exists('file_upload/'.$gambar_lama)){
					$target_file = './file_upload/'.$gambar_lama;
				}else{
					$nama_folder = substr($gambar_lama, 0, 10);
					$target_file = './file_upload/'.$nama_folder.'/'.$gambar_lama;
				}
    			
    			unlink($target_file);
			}
		}

		redirect('p_revisi/edit/'.$id_pengajuan);

	}


}
