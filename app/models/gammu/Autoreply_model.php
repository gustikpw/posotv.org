<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Hong_Kong");

class Autoreply_model extends CI_Model {

  function __construct()
  {
      parent::__construct();
      $this->db2 = $this->load->database('sms',TRUE);
  }

// CONTOH MULTY DATABASE
  public function getUnreadMessages()
  {
    return $this->db2->query("SELECT * FROM inbox WHERE processed = 'false'")->result();
  }

  public function sendAutoReply($data)
  {
    $this->db2->insert('outbox', $data);
    return $this->db2->insert_id();
  }

  public function update($where, $data)
  {
    $this->db2->update('inbox', $data, $where);
    return $this->db2->affected_rows();
  }

  public function count_limit_by($no_tujuan)
  {
      $now = date('Y-m-d');
      $query = $this->db2->query("SELECT count(i.SenderNumber) AS limits
         FROM inbox i
         WHERE i.SenderNumber = '$no_tujuan'
         AND i.ReceivingDateTime LIKE '$now%'");
      return $query->row();
  }

}
