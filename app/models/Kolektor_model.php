<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kolektor_model extends CI_Model {

  var $table = 'kolektor';
  var $vtable = 'v_kolektor';
  var $column = array('id_kolektor','kode_karyawan','nama_lengkap','wilayah','keterangan');
  var $order = array(
    'id_kolektor'=>'DESC',
  );

  function __construct()
  {
      parent::__construct();
      $this->load->database();
  }
  // serverside datatable
  private function _get_datatables_query()
  {

    $this->db->from($this->vtable);

    $i = 0;

    foreach ($this->column as $item) // loop column
    {
      if($_POST['search']['value']) // if datatable send POST for search
      {

        if($i===0) // first loop
        {
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        }
        else
        {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if(count($this->column) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $column[$i] = $item; // set column array variable to order processing
      $i++;
    }

    if(isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    else if(isset($this->order))
    {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }


  function get_datatables()
  {
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->vtable);
    return $this->db->count_all_results();
  }
// batas serverside datatable
  //CRUD kolektor
  public function v_get_by_id($id_kolektor)
  {
    $this->db->from($this->vtable);
    $this->db->where('id_kolektor',$id_kolektor);
    $query = $this->db->get();

    return $query->row();
  }

  public function get_by_id($id_kolektor)
  {
    $this->db->from($this->table);
    $this->db->where('id_kolektor',$id_kolektor);
    $query = $this->db->get();

    return $query->row();
  }

  public function save($data)
  {
    $this->db->insert('kolektor', $data);
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update('kolektor', $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id_kolektor)
  {
    $this->db->where('id_kolektor', $id_kolektor);
    $this->db->delete('kolektor');
  }

  public function getWilayah($id_wilayah)
  {
    return $this->db->query("SELECT * FROM wilayah WHERE id_wilayah='$id_wilayah'")->row();
  }

  // untuk select


}
