<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wa_blast extends CI_Controller {

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
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_wa = $this->M_master->tampil_wa_blast()->result_array();
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_wa_blast', array('data_wa' => $data_wa));
		$this->load->view('footer');
	}

	public function kirim_wa(){
		$data_wa = $this->M_master->tampil_wa_blast()->result_array();

		foreach($data_wa as $row_wa){

			$nomor_pengajuan = $row_wa['nomor_pengajuan'];
			$bagian = $row_wa['bagian'];
			$level_pengaju = $row_wa['level_pengaju'];
	        $status_approve = $row_wa['status_approve'];
	        $approved_by = $row_wa['approved_by'];
	        $wilayah = $row_wa['wilayah'];
	        $dept_tujuan = $row_wa['dept_tujuan'];
	        $direktur_tujuan = $row_wa['direktur_tujuan'];
	        $cab = $row_wa['cabang'];
	        $wil = $row_wa['wilayah'];
	        $deptm = $row_wa['bagian'];

	          if($level_pengaju == 'ADCO' AND $status_approve=='on proccess' OR $level_pengaju == 'ADCOLL' AND $status_approve=='on proccess'){
	            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$cab' AND level='Branch Manager'")->row_array();
	            $nama_next = $q_next['nama_lengkap'];
	            $level_next = 'Kacab';
	            $nomor_wa = $q_next['nomor_wa'];

	          }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kacab'){
	            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$wil' AND level='Area Manager'")->row_array();
	            $nama_next = $q_next['nama_lengkap'];
	            $level_next = 'Kawil';
	            $nomor_wa = $q_next['nomor_wa'];

	          }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kawil' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kawil'){
	            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                $nama_next = $q_next['nama_lengkap'];
                $level_next = 'PIC Dept Head';
	            $nomor_wa = $q_next['nomor_wa'];


	          }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic'){
                $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                $nama_next = $q_next['nama_lengkap'];
                $level_next = 'Director';
                $nomor_wa = $q_next['nomor_wa'];
                

	          }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director'){
	            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='President Director'")->row_array();
	            $nama_next = $q_next['nama_lengkap'];
	            $level_next = 'President Director';
	            $nomor_wa = $q_next['nomor_wa'];
	          }

	          elseif($level_pengaju == 'Departement PIC' AND $status_approve=='on proccess'){
	            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$deptm' AND level='Department Head'")->row_array();
	            $nama_next = $q_next['nama_lengkap'];
	            $level_next = 'Dept. Head';
	            $nomor_wa = $q_next['nomor_wa'];

	          }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head'){
                $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                $nama_next = $q_next['nama_lengkap'];
                $level_next = 'PIC Dept Head';
                $nomor_wa = $q_next['nomor_wa'];

              }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic'){
                $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                $nama_next = $q_next['nama_lengkap'];
                $level_next = 'Director';
                $nomor_wa = $q_next['nomor_wa'];

	          }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='director'){
	            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='President Director'")->row_array();
	            $nama_next = $q_next['nama_lengkap'];
	            $level_next = 'President Director';
	            $nomor_wa = $q_next['nomor_wa'];

	          }

	          $text_wa = "[Pro-Biaya System] - Anda Telah Menerima Pengajuan Masuk Untuk Dilakukan Proses Approval, Nomor Pengajuan : $nomor_pengajuan , Pengaju : $bagian ($cab) , Silahkan cek di probiaya.procarfinance.com (di menu Inbox) - Terimakasih";


	          // Script Kirim Whatsapp (Via API rapiwha)
				$my_apikey = "SEAQFXPLUXCSH27ZNYVQ";
				$destination = $nomor_wa;
				$message = $text_wa;
				$api_url = "http://panel.rapiwha.com/send_message.php";
				$api_url .= "?apikey=". urlencode ($my_apikey);
				$api_url .= "&number=". urlencode ($destination);
				$api_url .= "&text=". urlencode ($message);
				$my_result_object = json_decode(file_get_contents($api_url, false));
				// echo "<br>Result: ". $my_result_object->success;
				// echo "<br>Description: ". $my_result_object->description;
				// echo "<br>Code: ". $my_result_object->result_code;
				echo '<script>
					alert("Notifikasi Whatsapp Terkirim");window.location="index";
				</script>';

		}
	}


	public function kirim_email(){
		date_default_timezone_set("Asia/Jakarta");

		// Konfigurasi Email
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.procarfinance.com',
			'smtp_crypto' => '', // bisa diisi ssl
			'smtp_port' => 587,
			'smtp_user' => 'noreply@procarfinance.com',
			'smtp_pass' => 'Profi@123',
			'mailtype' => 'html',
			'charset' => 'utf-8'
		);

		// Data Tujuan Kirim Email (Next Approve)
		$data_next_approve = $this->db->query("SELECT next_approve_email, COUNT(*) AS jumlah_data FROM tbl_next_approve GROUP BY next_approve_email")->result_array();

		foreach($data_next_approve as $row){
			$email = $row['next_approve_email'];
			$jumlah_pengajuan = $row['jumlah_data'];
			$dt_pengajuan = "";

			// Ambil Data Pengajuan berdasarkan email
			$data_pengajuan = $this->db->query("SELECT nomor_pengajuan FROM tbl_next_approve WHERE next_approve_email='$email'")->result_array();

			foreach($data_pengajuan as $row){
				$dt_pengajuan .= '* '.$row['nomor_pengajuan'].'<br>';
			}

			$text_email = "Anda Telah Menerima $jumlah_pengajuan Pengajuan Biaya Untuk Proses Approval :";
			$text_email .= "<br>";

			$text_email .= $dt_pengajuan.'<br>';

			$text_email .= "Silahkan cek di aplikasi Pro-Biaya di menu <b>Persetujuan Pengajuan</b>";
			$text_email .= "<br>Terimakasih";

			// Script Kirim Email
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('noreply@procarfinance.com', 'Pro-Biaya (No Reply)');
			$this->email->to($email);
			$this->email->subject('Pengajuan Masuk (Pro-Biaya)');
			$this->email->message($text_email);

			$terkirim = $this->email->send();

			echo '<script>
				alert("Notifikasi Email Terkirim");window.location="index";
			</script>';
		}

	}

}
