<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypage extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('members_model');
    $this->load->model('perfume_model');
  }

	public function index() {
    $review = $this->perfume_model->getMemberReviews();

    foreach ($review as $key => $val) {
      $stars = "";
      for($i = 0; $i < 5; $i++) {
        if($i >= $val["r_score"]) {
          $stars .= "<i class='far fa-star star'></i>";
        }else {
          $stars .= "<i class='fas fa-star star'></i>";
        }
      }

      if($val["r_longevity"] == 1) {
        $review[$key]["longevity"] = "나빠요 (30m-1h)";
      }else if($val["r_longevity"] == 2){
        $review[$key]["longevity"] = "약해요 (1h-2h)";
      }else if($val["r_longevity"] == 3){
        $review[$key]["longevity"] = "보통이에요 (3h-6h)";
      }else if($val["r_longevity"] == 4){
        $review[$key]["longevity"] = "오래가요 (7h-12h)";
      }else if($val["r_longevity"] == 5){
        $review[$key]["longevity"] = "강해요 (12h+)";
      }

      $review[$key]["stars"] = $stars;
    }
    $data = Array(
      "review" => $review
    );
		$this->load->view("common/header.php");
		$this->load->view("pages/mypage.php", $data);
		$this->load->view("common/footer.php");
	}

  public function deleteReview($r_seq) {
    $data = Array();
    if(!$this->perfume_model->deleteReview($r_seq)) {
      $data["result"] = false;
    }else {
      $data["result"] = true;
    }
    echo json_encode($data);
  }

  public function password() {
    $this->load->view("common/header.php");
		$this->load->view("pages/password.php");
		$this->load->view("common/footer.php");
  }

  public function modifyPassword() {
    echo json_encode($this->members_model->modifyPassword());
  }
}
