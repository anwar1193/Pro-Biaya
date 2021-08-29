<?php

Class Libraryku{
	protected $ci;

	function __construct(){
		$this->ci =& get_instance();
	}

	function tampil_user(){
		$this->ci->load->model('m_login');
		$id = $this->ci->session->userdata('id');
		$user_data = $this->ci->m_login->ambil_user($id)->row();
		return $user_data;
	}
}