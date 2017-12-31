<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_model extends CI_Model {

  var $table = 'bagian';
  var $column = array('id_bagian','bagian','keterangan');
  var $order = array('id_bagian'=>'DESC');

  function __construct()
  {
      parent::__construct();
      $this->load->database();
  }
  
  //CRUD bagian
  public function get_by_id($id_bagian)
  {
    $this->db->from('bagian');
    $this->db->where('id_bagian',$id_bagian);
    $query = $this->db->get();

    return $query->row();
  }

  public function save($data)
  {
    $this->db->insert('bagian', $data);
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update('bagian', $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id_bagian)
  {
    $this->db->where('id_bagian', $id_bagian);
    $this->db->delete('bagian');
  }

  /*  Untuk FPDF
   *
   */
   public function getAll()
   {
      return $this->db->query("SELECT * FROM bagian ORDER BY id_bagian ASC")->result();
   }
}
