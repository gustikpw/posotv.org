<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengaduan_model extends CI_Model {

  var $table = 'pengaduan';
  var $vtable = 'v_pengaduan';
  var $column = array('id_pengaduan',' kode_pelanggan','nama_lengkap','wilayah','alamat','status','tgl_lapor','tgl_gangguan','prioritas','jenis_gangguan','keterangan','tgl_perbaikan','teknisi','sebab','tindakan','status_aduan');
  var $order = array(
    'id_pengaduan'=>'DESC',
    'tgl_lapor'=>'DESC',
    'status_aduan'=>'DESC',
    'prioritas'=>'DESC'
  );

  var $vtable2 = 'v_pengaduan';
  var $column2 = array('id_pengaduan',' kode_pelanggan','nama_lengkap','wilayah','alamat','status','tgl_lapor','tgl_gangguan','prioritas','jenis_gangguan','keterangan','tgl_perbaikan','teknisi','sebab','tindakan','status_aduan');
  var $order2 = array(
    // 'prioritas'=>'High',
    'prioritas'=>'DESC',
    // 'status_aduan'=>'Selesai',
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

  // untuk display
  private function _get_datatables_query2()
  {
    $this->db->from($this->vtable2);
    $i = 0;
    foreach ($this->column2 as $item) // loop column
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

        if(count($this->column2) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $column2[$i] = $item; // set column array variable to order processing
      $i++;
    }

    if(isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($column2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    else if(isset($this->order2))
    {
      $order2 = $this->order2;
      $this->db->order_by(key($order2), $order2[key($order2)]);
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

  function get_datatables2()
  {
    $this->_get_datatables_query2();
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
  //CRUD pengaduan
  public function v_get_by_id($id_pengaduan)
  {
    $this->db->from($this->vtable);
    $this->db->where('id_pengaduan',$id_pengaduan);
    $query = $this->db->get();

    return $query->row();
  }

  public function get_by_id($id_pengaduan)
  {
    $this->db->from($this->table);
    $this->db->where('id_pengaduan',$id_pengaduan);
    $query = $this->db->get();

    return $query->row();
  }

  public function save($data)
  {
    $this->db->insert('pengaduan', $data);
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update('pengaduan', $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id_pengaduan)
  {
    $this->db->where('id_pengaduan', $id_pengaduan);
    $this->db->delete('pengaduan');
  }

  // untuk select


}
