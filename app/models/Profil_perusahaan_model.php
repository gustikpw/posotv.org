<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profil_perusahaan_model extends CI_Model {

  var $table = 'profil_perusahaan';
  var $column = array('id_profil','nama_perusahaan','alias','slogan','alamat','email','telp','kodepos','facebook','youtube');
  var $order = array('id_profil'=>'DESC');

  function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  //CRUD info_lembaga
  public function get_by_id($id)
  {
    $this->db->from($this->table);
    $this->db->where('id_profil',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function save($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  // public function delete_by_id($id)
  // {
  //   $this->db->where('id', $id);
  //   $this->db->delete('info_lembaga');
  // }

  // public function v_get_by_id($id)
  // {
  //   $this->db->from('v_info_lembaga');
  //   $this->db->where('id',$id);
  //   $query = $this->db->get();
  //
  //   return $query->row();
  // }

}
