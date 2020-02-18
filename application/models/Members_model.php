<?php
  class Members_model extends CI_Model {
    public function __construct() {
      $this->load->database();
      $this->load->library("session");
    }

    public function join() {
      $data = $this->input->post();
      //아이디 중복 확인
      $this->db->select();
      $this->db->from("members");
      $this->db->where("m_id", $data["m_id"]);
      $query = $this->db->get();
      $result = $query->row();

      if($result) {
        return Array("result" => "duplicate");
      }

      //가입
      if(!$this->db->insert("members", $data)) {
        return Array("result" => "failed");
      }else {
        return Array("result" => "success");
      }
    }

    public function login() {
      $data = $this->input->post();
      $this->db->select();
      $this->db->from("members");
      $this->db->where("m_id", $data["m_id"]);
      $this->db->where("m_password", $data["m_password"]);
      $query = $this->db->get();
      $result = $query->row_array();

      //아이디/비밀번호 확인
      if(!$result) {
        return Array("result" => "false");
      }else {
        //세션처리
        $login = Array(
          "m_seq" => $result["m_seq"],
          "m_id" => $data["m_id"],
          "type" => "member"
        );
        $this->session->set_userdata($login);
        return Array("result" => "success");
      }
    }

    public function modifyPassword() {
      $m_seq = $_SESSION["m_seq"];
      $params = $this->input->post();
      //현재 비밀번호 맞는지 확인
      $this->db->where("m_seq = '".$m_seq."'");
      $this->db->where("m_password = '".$params["m_password"]."'");
      $query = $this->db->get("members");
      $result = $query->row();
      if(!$result) {
        return Array("result" => "false");
      }else {
        //비밀번호 면경
        $this->db->where("m_seq = '".$m_seq."'");
        $this->db->update("members", Array("m_password" => $params["m_new_password"]));
        return Array("result" => "success");
      }
    }
  }
?>
