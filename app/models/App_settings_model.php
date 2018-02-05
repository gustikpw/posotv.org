<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_settings_model extends CI_Model {

  public function get_by_id($id_bagian)
  {
    $this->db->from('bagian');
    $this->db->where('id_bagian',$id_bagian);
    $query = $this->db->get();

    return $query->row();
  }

  public function update($where, $data)
  {
    $this->db->update('settings', $data, $where);
    return $this->db->affected_rows();
  }

  // Not Serializable Value
  public function getSettings($option_name)
  {
    $this->db->query("SELECT * FROM settings WHERE option_name = '$option_name'")->row();
  }

  // Serializable Value
  public function getSettings_serial($option_name)
  {
    return $this->db->query("SELECT option_name,option_value FROM settings WHERE option_name='$option_name' ")->row();
  }

}
