<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('members_model');
  }

	public function index()
	{
		$this->load->view("common/header.php");
		$this->load->view("pages/join.php");
		$this->load->view("common/footer.php");
	}

  //회원가입
  public function join() {
    echo json_encode($this->members_model->join());
  }
}
