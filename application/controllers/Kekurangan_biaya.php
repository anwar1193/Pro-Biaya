<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kekurangan_biaya extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library('libraryku');
		$this->load->model('M_master');
	}


	public function index(){
        cek_belum_login();

        $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
        $cabang = $this->libraryku->tampil_user()->cabang;
        $departemen = $this->libraryku->tampil_user()->departemen;
        $level = $this->libraryku->tampil_user()->level;
        $jabatan_khusus = $this->libraryku->tampil_user()->jabatan_khusus;

        if($cabang=='HEAD OFFICE'){
            $identitas = $departemen;
        }else{
            $identitas = $level;
        }

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
        $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$identitas' AND status_bayar='Telah Dibayar' AND nomor_invoice='ESTIMASI' AND jenis_penyelesaian='kekurangan' AND note_penyelesaian!='' AND status_penyelesaian='' ")->result_array();

        $data_bank = $this->db->query("SELECT * FROM tbl_bank_pengaju ORDER BY nama_bank")->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_kekurangan_biaya', array(
            'data_pengajuan' => $data_pengajuan,
            'data_bank' => $data_bank
        ));
		$this->load->view('footer');
	}

	
	public function simpan(){
        date_default_timezone_set("Asia/Jakarta");
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
        $nomor_penyelesaian = $nomor_pengajuan.'/PY';
		$nomor_invoice = $this->input->post('nomor_invoice');
        $jenis_biaya = $this->input->post('jenis_biaya');
        $sub_biaya = $this->input->post('sub_biaya');
        $departemen_tujuan = $this->input->post('departemen_tujuan');
        $total_pengajuan = $this->input->post('jumlah');
        $realisasi = $this->input->post('realisasi');
        $kurang_bayar = $this->input->post('kurang_bayar');
        $bank = $this->input->post('bank_penerima');
        $nomor_rekening = $this->input->post('norek_penerima');
        $atas_nama_bank = $this->input->post('atas_nama');
        $alasan_beda_realisasi = $this->input->post('alasan_beda_realisasi');

        $tgl_request_transfer = $this->input->post('tanggal_request_transfer');
        $tanggal_request_transfer = date('Y-m-d', strtotime($tgl_request_transfer));

		$kronologis = $this->input->post('kronologis');

        if($kronologis == ''){
            echo '<script>alert("Kronologi Wajib Diisi")</script>';
            
            // Ke Halaman Input yang ada isinya, setelah validasi

            $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
            $cabang = $this->libraryku->tampil_user()->cabang;
            $departemen = $this->libraryku->tampil_user()->departemen;
            $level = $this->libraryku->tampil_user()->level;
            $jabatan_khusus = $this->libraryku->tampil_user()->jabatan_khusus;

            if($cabang=='HEAD OFFICE'){
                $identitas = $departemen;
            }else{
                $identitas = $level;
            }

            $data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
            $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$identitas' AND status_bayar='Telah Dibayar' AND status_penyelesaian='' ")->result_array();

            $data_bank = $this->db->query("SELECT * FROM tbl_bank_pengaju ORDER BY nama_bank")->result_array();

            $this->load->view('header');
            $this->load->view('sidebar', array('data_jb'=>$data_jb));
            $this->load->view('v_kekurangan_biaya_validasi', array(
                'data_pengajuan' => $data_pengajuan,
                'data_bank' => $data_bank,

                'nomor_pengajuan' => $nomor_pengajuan,
                'nomor_invoice' => $nomor_invoice,
                'jenis_biaya' => $jenis_biaya,
                'sub_biaya' => $sub_biaya,
                'departemen_tujuan' => $departemen_tujuan,
                'total_pengajuan' => $total_pengajuan,
                'realisasi' => $realisasi,
                'kurang_bayar' => $kurang_bayar,
                'bank' => $bank,
                'nomor_rekening' => $nomor_rekening,
                'atas_nama_bank' => $atas_nama_bank,
                'tgl_request_transfer' => $tgl_request_transfer,
                'kronologis' => $kronologis
            ));
            $this->load->view('footer');
            // Penutup Ke Halaman Input yang ada isinya, setelah validasi
        }else{

            $result = $this->M_master->simpan_pengajuan('tbl_penyelesaian_kekurangan', array(
                'nomor_pengajuan' => $nomor_pengajuan,
                'nomor_penyelesaian' => $nomor_penyelesaian,
                'nomor_invoice' => $nomor_invoice,
                'jenis_biaya' => $jenis_biaya,
                'sub_biaya' => $sub_biaya,
                'total_pengajuan' => $total_pengajuan,
                'realisasi' => $realisasi,
                'kurang_bayar' => $kurang_bayar,
                'alasan_beda_realisasi' => $alasan_beda_realisasi,
                'bank' => $bank,
                'nomor_rekening' => $nomor_rekening,
                'atas_nama_bank' => $atas_nama_bank,
                'tanggal_request_transfer' => $tanggal_request_transfer,
                'kronologis' => $kronologis,
                'departemen_tujuan' => $departemen_tujuan,
                'status_approve_penyelesaian' => 'On Proccess'
            ));

            if($result > 0){

                // Update status penyelesaian di tbl_pengajuan
                $this->M_master->update_pengajuan('tbl_pengajuan', array(
                    'status_penyelesaian' => 'On Proccess'
                ), array('nomor_pengajuan' => $nomor_pengajuan));


                $this->session->set_flashdata('pesan','Penyelesaian Kekurangan Biaya Berhasil Terkirim');
                redirect('kekurangan_biaya');
            }
        }
	}


    public function update(){
        date_default_timezone_set("Asia/Jakarta");
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
		$id_penyelesaian = $this->input->post('id_penyelesaian');
        $nomor_penyelesaian = $nomor_pengajuan.'/PY';
		$nomor_invoice = $this->input->post('nomor_invoice');
        $jenis_biaya = $this->input->post('jenis_biaya');
        $sub_biaya = $this->input->post('sub_biaya');
        $departemen_tujuan = $this->input->post('departemen_tujuan');
        $total_pengajuan = $this->input->post('jumlah');
        $realisasi = $this->input->post('realisasi');
        $kurang_bayar = $this->input->post('kurang_bayar');
        $bank = $this->input->post('bank_penerima');
        $nomor_rekening = $this->input->post('norek_penerima');
        $atas_nama_bank = $this->input->post('atas_nama');
        $alasan_beda_realisasi = $this->input->post('alasan_beda_realisasi');

        $tgl_request_transfer = $this->input->post('tanggal_request_transfer');
        $tanggal_request_transfer = date('Y-m-d', strtotime($tgl_request_transfer));

		$kronologis = $this->input->post('kronologis');

        $result = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
            'nomor_pengajuan' => $nomor_pengajuan,
            'nomor_penyelesaian' => $nomor_penyelesaian,
            'nomor_invoice' => $nomor_invoice,
            'jenis_biaya' => $jenis_biaya,
            'sub_biaya' => $sub_biaya,
            'total_pengajuan' => $total_pengajuan,
            'realisasi' => $realisasi,
            'kurang_bayar' => $kurang_bayar,
            'alasan_beda_realisasi' => $alasan_beda_realisasi,
            'bank' => $bank,
            'nomor_rekening' => $nomor_rekening,
            'atas_nama_bank' => $atas_nama_bank,
            'tanggal_request_transfer' => $tanggal_request_transfer,
            'kronologis' => $kronologis,
            'departemen_tujuan' => $departemen_tujuan,
            'status_approve_penyelesaian' => 'On Proccess',
            'approved_by_penyelesaian' => '',
            'nama_pengapprove_penyelesaian' => ''
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($result > 0){

            // Update status penyelesaian di tbl_pengajuan
            $this->M_master->update_pengajuan('tbl_pengajuan', array(
                'status_penyelesaian' => 'On Proccess'
            ), array('nomor_pengajuan' => $nomor_pengajuan));


            $this->session->set_flashdata('pesan','Penyelesaian Kekurangan Biaya Berhasil Di Revisi');
            redirect('inquiry_kekurangan_biaya/on_proccess');
        }

	}


    public function update_pending(){
        date_default_timezone_set("Asia/Jakarta");
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
		$id_penyelesaian = $this->input->post('id_penyelesaian');
        $nomor_penyelesaian = $nomor_pengajuan.'/PY';
		$nomor_invoice = $this->input->post('nomor_invoice');
        $jenis_biaya = $this->input->post('jenis_biaya');
        $sub_biaya = $this->input->post('sub_biaya');
        $departemen_tujuan = $this->input->post('departemen_tujuan');
        $total_pengajuan = $this->input->post('jumlah');
        $realisasi = $this->input->post('realisasi');
        $kurang_bayar = $this->input->post('kurang_bayar');
        $bank = $this->input->post('bank_penerima');
        $nomor_rekening = $this->input->post('norek_penerima');
        $atas_nama_bank = $this->input->post('atas_nama');

        $tgl_request_transfer = $this->input->post('tanggal_request_transfer');
        $tanggal_request_transfer = date('Y-m-d', strtotime($tgl_request_transfer));

		$kronologis = $this->input->post('kronologis');

        $result = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
            'nomor_pengajuan' => $nomor_pengajuan,
            'nomor_penyelesaian' => $nomor_penyelesaian,
            'nomor_invoice' => $nomor_invoice,
            'jenis_biaya' => $jenis_biaya,
            'sub_biaya' => $sub_biaya,
            'total_pengajuan' => $total_pengajuan,
            'realisasi' => $realisasi,
            'kurang_bayar' => $kurang_bayar,
            'bank' => $bank,
            'nomor_rekening' => $nomor_rekening,
            'atas_nama_bank' => $atas_nama_bank,
            'tanggal_request_transfer' => $tanggal_request_transfer,
            'kronologis' => $kronologis,
            'departemen_tujuan' => $departemen_tujuan,
            'status_verifikasi_penyelesaian' => '',
            'note_verifikasi_penyelesaian' => ''
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($result > 0){
            $this->session->set_flashdata('pesan','Penyelesaian Kekurangan Biaya Berhasil Di Revisi');
            redirect('inquiry_kekurangan_biaya/pending');
        }

	}

    
    public function kirim_memo(){
        echo '<script>alert("Penyelesaian Terkirim");window.location="index"</script>';
        exit;
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
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_detail_kekurangan', array(
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


}
