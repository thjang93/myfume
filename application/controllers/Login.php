<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('members_model');
  }

	public function index() {
		$this->load->view("common/header.php");
		$this->load->view("pages/login.php");
		$this->load->view("common/footer.php");
	}

  public function login() {
    echo json_encode($this->members_model->login());
  }

  public function logout() {
    //세션처리
    $login = Array(
      "m_seq" => "",
      "m_id" => "",
      "type" => ""
    );
    $this->session->set_userdata($login);
    Header("Location:/");
  }
}
