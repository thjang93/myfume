<?php
  class Perfume_model extends CI_Model {
    public function __construct() {
      $this->load->database();
    }

    public function getNotes() {
      $this->db->select("n_seq, n_name");
      $query = $this->db->get("notes");
      return $query->result_array();
    }

    public function getPerfume($p_seq) {
      $this->db->where("p_seq = '".$p_seq."'");
      $query = $this->db->get("perfumes");
      return $query->row();
    }

    public function getList() {
      $params = $this->input->post();

      $where = Array();
      if($params["p_name"]) {
        $where[] = "(p_name LIKE '%".$params["p_name"]."%' || p_brand LIKE '%".$params["p_name"]."%')";
      }

      if($params["notes"]) {
        $note = explode(",", $params["notes"]);
      }else {
        return false;
      }

      foreach($note as $val) {
        $notes[] = "p_n_seq LIKE '%".$val."%'";
      }
      $where_notes = implode(" || ", $notes);
      $where[] = "(".$where_notes.")";

      $wheres = implode(" AND ", $where);

      $this->db->where($wheres);
      $query = $this->db->get("perfumes");
      $data = $query->result_array();

      foreach($data as $key => $val) {
        $data[$key]["avg"] = $this->getAvg($val["p_seq"]);
      }

      return $data;
    }

    public function getAvg($p_seq, $column = "r_score") {
      $this->db->select_avg($column);
      $this->db->where("r_p_seq = '".$p_seq."'");
      $query = $this->db->get("reviews");
      $data = $query->row();
      return $data->$column;
    }

    public function writeReview() {
      $params = $this->input->post();
      $params["r_m_seq"] = $_SESSION["m_seq"];
      if(!$this->db->insert("reviews", $params)) {
        return false;
      }else {
        return true;
      }
    }

    public function getReviews($p_seq) {
      $this->db->where("r_p_seq = '".$p_seq."'");
      $this->db->join("members", "r_m_seq = m_seq", "LEFT");
      $this->db->order_by("r_date", "DESC");
      $query = $this->db->get("reviews");
      return $query->result_array();
    }

    public function getMemberReviews() {
      $m_seq = $_SESSION["m_seq"];
      $this->db->where("r_m_seq = '".$m_seq."'");
      $this->db->join("members", "r_m_seq = m_seq", "LEFT");
      $this->db->join("perfumes", "r_p_seq = p_seq", "LEFT");
      $this->db->order_by("r_date", "DESC");
      $query = $this->db->get("reviews");
      return $query->result_array();
    }

    public function deleteReview($r_seq) {
      return $this->db->delete("reviews", array("r_seq" => $r_seq));
    }
  }
?>
