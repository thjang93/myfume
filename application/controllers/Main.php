<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('members_model');
    $this->load->model('perfume_model');
  }

  //메인 페이지
	public function index() {
    $notes = $this->perfume_model->getNotes();
    $data = Array(
      "notes" => $notes
    );
		$this->load->view("common/header.php");
		$this->load->view("pages/main.php", $data);
		$this->load->view("common/footer.php");
	}

  //향수 상세정보
  public function view($p_seq = "") {
    $data = $this->perfume_model->getPerfume($p_seq);
    $this->load->view("common/header.php");
		$this->load->view("pages/view.php", $data);
		$this->load->view("common/footer.php");
  }

  //향수 목록 가져오기
  public function getList() {
    $list = $this->perfume_model->getList();
    $html = "";

    if(!$list) {
      $html = "<div class='list-none'>찾으시는 향수가 없습니다.</div>";
    }else {
      foreach($list as $val) {
        //별 그리기 계산
        $stars = "";
        $whole = floor($val["avg"]);
        $fraction = $val["avg"] - $whole;
        $halfStar = false;
        for($i = 0; $i < 5; $i++) {
          if($i >= $whole) {
            if(!$halfStar && $fraction > 0) {
              $stars .= "<i class='fas fa-star-half-alt star'></i>";
              $halfStar = true;
            }else {
              $stars .= "<i class='far fa-star star'></i>";
            }
          }else {
            $stars .= "<i class='fas fa-star star'></i>";
          }
        }
        $html .= "<a href='?/main/view/".$val["p_seq"]."'>";
        $html .=   "<div class='item'>";
        $html .=     "<div class='desc'>";
        $html .=       "<div class='thumbnamil'>";
        $html .=         "<img src='".$val["p_image"]."'/>";
        $html .=       "</div>";
        $html .=       "<div class='tit'>[".$val["p_brand"]."] ".$val["p_name"]."</div>";
        $html .=       "<div class='score'>";
        $html .=         "<span>".number_format($val["avg"],1)."</span>";
        $html .=         $stars;
        $html .=       "</div>";
        $html .=     "</div>";
        $html .=   "</div>";
        $html .= "</a>";
      }
    }

    $data = Array(
      "html" => $html
    );

    echo json_encode($data);
  }

  //향수 리뷰 작성
  public function writeReview() {
    $data = Array();
    if(!$this->perfume_model->writeReview()) {
      $data["result"] = false;
    }else {
      $data["result"] = true;
    }
    echo json_encode($data);
  }

  //향수 리뷰 가져오기
  public function getReviews($p_seq) {
    $reviews = $this->perfume_model->getReviews($p_seq);
    $html = "";
    if(!$reviews) {
      $html = "<div class='review-none'>리뷰가 없습니다.</div>";
    }else {
      $score = $this->perfume_model->getAvg($p_seq);
      $longevity = $this->perfume_model->getAvg($p_seq, "r_longevity");

      //별 그리기 계산
      $totalStars = "";
      $whole = floor($score);
      $fraction = $score - $whole;
      $halfStar = false;
      for($i = 0; $i < 5; $i++) {
        if($i >= $whole) {
          if(!$halfStar && $fraction > 0) {
            $totalStars .= "<i class='fas fa-star-half-alt star'></i>";
            $halfStar = true;
          }else {
            $totalStars .= "<i class='far fa-star star'></i>";
          }
        }else {
          $totalStars .= "<i class='fas fa-star star'></i>";
        }
      }

      //나빠요 30분-1시간 | 약해요 1시간-2시간 | 보통이에요 3시간-6시간 | 오래가요 7시간-12시간 | 강해요 12시간+
      $longTxt = "";
      if($longevity <= 1.0) {
        $longTxt .= "나빠요 (30m-1h)";
      }else if($longevity <= 2){
        $longTxt .= "약해요 (1h-2h)";
      }else if($longevity <= 3){
        $longTxt .= "보통이에요 (3h-6h)";
      }else if($longevity <= 4){
        $longTxt .= "오래가요 (7h-12h)";
      }else if($longevity <= 5){
        $longTxt .= "강해요 (12h+)";
      }

      $html .= "<div class='curr'>";
      $html .=   "<div class='total'>TOTAL (".sizeof($reviews).")</div>";
      $html .=   "<div class='score'><span class='sub'><i class='far fa-clipboard'></i></span> ".number_format($score,1)." ".$totalStars."</div>";
      $html .=   "<div class='long'><span class='sub'><i class='far fa-clock'></i></span> ".$longTxt."</div>";
      $html .= "</div>";

      foreach($reviews as $val) {
        $stars = "";
        $longevity = "";
        for($i = 0; $i < 5; $i++) {
          if($i >= $val["r_score"]) {
            $stars .= "<i class='far fa-star star font-12'></i>";
          }else {
            $stars .= "<i class='fas fa-star star font-12'></i>";
          }
        }

        if($val["r_longevity"] == 1) {
          $longevity = "나빠요 (30m-1h)";
        }else if($val["r_longevity"] == 2){
          $longevity = "약해요 (1h-2h)";
        }else if($val["r_longevity"] == 3){
          $longevity = "보통이에요 (3h-6h)";
        }else if($val["r_longevity"] == 4){
          $longevity = "오래가요 (7h-12h)";
        }else if($val["r_longevity"] == 5){
          $longevity = "강해요 (12h+)";
        }

        $html .= "<div class='item'>";
        $html .=   "<div class='reviewer'>";
        $html .=     "<i class='fas fa-user'></i> ".$val["m_id"]." ";
        $html .=     $stars;
        $html .=     " <i class='far fa-clock font-12'></i> <span class='font-12'>".$longevity."</span>";
        $html .=   "</div>";
        $html .=   "<div class='contents'><pre>".$val["r_review"]."</pre></div>";
        $html .= "</div>";
      }
    }

    $data = Array(
      "html" => $html
    );
    echo json_encode($data);
  }
}
