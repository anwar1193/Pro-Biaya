<?php

Class Libraryku{
	protected $ci;

	function __construct(){
		$this->ci =& get_instance();
	}

	function tampil_user(){
		$this->ci->load->model('m_login');
		$sess_var = $this->ci->session->userdata('login_probiaya');

		// Ambil ID dari session untuk di lempar ke database
		// $data_login = array(
		// 	'sess_id' => $sess_var['id']
		// );

		$id = $sess_var['id'];

		$user_data = $this->ci->m_login->ambil_user($id)->row();
		return $user_data;
	}
}