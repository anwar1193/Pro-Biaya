<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library('libraryku');
		$this->load->model('M_login');
	}

	public function index()
	{
		cek_sudah_login();
		$this->load->view('v_login');
	}

	public function ke_home(){
		$this->session->set_flashdata('pesan','Selamat Datang di Pro-Biaya');
		redirect('home');
	}

	public function ke_ganti_password(){
		$this->session->set_flashdata('pesan','Untuk Keamanan, Silahkan Ganti Password Standar Anda');
		redirect('ganti_password');
	}

	public function proses(){
		date_default_timezone_set("Asia/Jakarta");
		$username = $this->input->post('username');
		$pwd = $this->input->post('password');
		$password = sha1($pwd);

		// Ambil IP User
		function get_client_ip() {
	        $ipaddress = '';
	        if (isset($_SERVER['HTTP_CLIENT_IP']))
	            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	        else if(isset($_SERVER['HTTP_X_FORWARDED']))
	            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	        else if(isset($_SERVER['HTTP_FORWARDED']))
	            $ipaddress = $_SERVER['HTTP_FORWARDED'];
	        else if(isset($_SERVER['REMOTE_ADDR']))
	            $ipaddress = $_SERVER['REMOTE_ADDR'];
	        else
	            $ipaddress = 'IP tidak dikenali';
	        return $ipaddress;
	    }

	    // Ambil Browser yang Digunakan User
	    function get_client_browser() {
	        $browser = '';
	        if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
	            $browser = 'Netscape';
	        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
	            $browser = 'Firefox';
	        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
	            $browser = 'Google Chrome';
	        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
	            $browser = 'Opera';
	        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
	            $browser = 'Internet Explorer';
	        else
	            $browser = 'Other : '.$_SERVER['HTTP_USER_AGENT'] ;
	        return $browser;
	    }


		$result = $this->M_login->proses('tbl_user',array(
			'username' => $username,
			'password' => $password
		));

		$cek = $result->num_rows();
		$row_login = $result->row_array();

		$sedang_login = $row_login['sedang_login'];

		$login_tanggal = date('Y-m-d');
		$login_jam = date('H:i:s');
		$login_ip = get_client_ip();
		$login_browser = get_client_browser();

		$jenis_user = $row_login['jenis_user'];
		$status_user = $row_login['status_user'];

		if($sedang_login == 'ya'){ //jika user tsb sedang login

			echo '<script>alert("Akun Anda Sedang Login Di Device Lain atau Lupa Logout, Silahkan Klik Tombol Clear Session Di Halaman Login");window.location="index"</script>';

		}else{ // jika tidak sedang login, lanjut ke periksa

			if($cek>0){

				// Validasi jika user yang digunakan adalah user alternate
				if($jenis_user == 'alternate' && $status_user != 'aktif'){
					echo '<script>alert("Anda menggunakan akun alternate yang status nya Nonaktif, Silahkan Hubungi Tim Aplikasi");window.location="index"</script>';
					exit;
				}

				if($pwd == 'Profi@123'){ //jika password standar, arahkan ke ganti password
					$row = $result->row_array();
					$data_login = array(
						'id' => $row['id'],
						'nama_lengkap' => $row['nama_lengkap'],
						'cabang' => $row['cabang'],
						'departemen' => $row['departemen'],
						'level' => $row['level'],
						'jabatan_khusus' => $row['jabatan_khusus'],
						'atasan' => $row['atasan'],
						'nama_kadiv' => $row['nama_kadiv'],
						'password' => $row['password'],
						'jenis_user' => $row['jenis_user']
					);
					$this->session->set_userdata($data_login);

					// Ubah status sedang_login di tbl_user
					$id_user = $row['id'];
					$waktu = date('d-m-Y H:i:s');

					// Ubah status jadi sedang login
					$this->db->query("UPDATE tbl_user SET sedang_login='ya', last_login='$waktu' WHERE id=$id_user");

					// Simpan ke tbl_log_login
					$this->db->query("INSERT INTO tbl_log_login(id_user, login_tanggal, login_jam, login_ip, login_browser) VALUES($id_user, '$login_tanggal', '$login_jam', '$login_ip', '$login_browser')");

					echo '<script>window.location="ke_ganti_password"</script>';

				}else{
					$row = $result->row_array();
					$data_login = array(
						'id' => $row['id'],
						'nama_lengkap' => $row['nama_lengkap'],
						'cabang' => $row['cabang'],
						'departemen' => $row['departemen'],
						'level' => $row['level'],
						'jabatan_khusus' => $row['jabatan_khusus'],
						'atasan' => $row['atasan'],
						'nama_kadiv' => $row['nama_kadiv'],
						'password' => $row['password']
					);
					$this->session->set_userdata($data_login);

					// Ubah status sedang_login di tbl_user
					$id_user = $row['id'];
					$waktu = date('d-m-Y H:i:s');
					$this->db->query("UPDATE tbl_user SET sedang_login='ya', last_login='$waktu' WHERE id=$id_user");

					// Simpan ke tbl_log_login
					$this->db->query("INSERT INTO tbl_log_login(id_user, login_tanggal, login_jam, login_ip, login_browser) VALUES($id_user, '$login_tanggal', '$login_jam', '$login_ip', '$login_browser')");

					echo '<script>window.location="ke_home"</script>';
				}

				

			}else{
				echo '<script>alert("Kombinasi Username & Password yang Anda Masukan Salah");window.location="index"</script>';
				// redirect('login');
			}

		}

	}

	public function logout(){
		$data_login = array('id','nama_lengkap','level');

		// Ubah status sedang_login di tbl_user
		$id_user = $this->libraryku->tampil_user()->id;
		$this->db->query("UPDATE tbl_user SET sedang_login='' WHERE id=$id_user");

		$this->session->unset_userdata($data_login);
		redirect('login');
	}

	public function hapus_session(){
		date_default_timezone_set("Asia/Jakarta");
		$username = $this->input->post('username');
		$pass = $this->input->post('password');
		$password = sha1($pass);

		// Ambil IP User
		function get_client_ip() {
	        $ipaddress = '';
	        if (isset($_SERVER['HTTP_CLIENT_IP']))
	            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	        else if(isset($_SERVER['HTTP_X_FORWARDED']))
	            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	        else if(isset($_SERVER['HTTP_FORWARDED']))
	            $ipaddress = $_SERVER['HTTP_FORWARDED'];
	        else if(isset($_SERVER['REMOTE_ADDR']))
	            $ipaddress = $_SERVER['REMOTE_ADDR'];
	        else
	            $ipaddress = 'IP tidak dikenali';
	        return $ipaddress;
	    }

	    // Ambil Browser yang Digunakan User
	    function get_client_browser() {
	        $browser = '';
	        if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
	            $browser = 'Netscape';
	        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
	            $browser = 'Firefox';
	        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
	            $browser = 'Google Chrome';
	        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
	            $browser = 'Opera';
	        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
	            $browser = 'Internet Explorer';
	        else
	            $browser = 'Other : '.$_SERVER['HTTP_USER_AGENT'] ;
	        return $browser;
	    }

	    
		$waktu_clearlog = date('d-m-Y H:i:s');
		$ip_clearlog = get_client_ip();
		$browser_clearlog = get_client_browser();

		$result = $this->M_login->proses('tbl_user',array(
			'username' => $username,
			'password' => $password
		));

		$cek = $result->num_rows();
		$row_login = $result->row_array();

		$sedang_login = $row_login['sedang_login'];
		$id_user = $row_login['id'];

		if($cek>0){ //jika username & password benar

			if($sedang_login == 'ya'){ //jika user tsb sedang login

				// UPDATE tbl_user
				$this->db->query("UPDATE tbl_user SET sedang_login='', clearlog_waktu='$waktu_clearlog', clearlog_ip='$ip_clearlog', clearlog_browser='$browser_clearlog' WHERE username='$username'");

				// INSERT ke tbl_clearlog
				$this->db->query("INSERT INTO tbl_clearlog(id_user, username, clearlog_waktu, clearlog_ip, clearlog_browser) VALUES($id_user, '$username', '$waktu_clearlog', '$ip_clearlog', '$browser_clearlog')");

				echo '<script>alert("Hapus Session Login Berhasil, Silahkan Login Kembali");window.location="index"</script>';

			}else{ //jika user tsb tidak sedang login
				echo '<script>alert("Akun Anda Tidak Sedang Login, Silahkan Login Kembali");window.location="index"</script>';
			}	


		}else{ //jika username & password salah

			echo '<script>alert("Kombinasi Username & Password Yang Anda Masukan Salah");window.location="index"</script>';
			
		}

	}

}
