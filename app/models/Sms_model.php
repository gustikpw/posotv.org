<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sms_model extends CI_Model {

  var $tb_inbox = 'inbox';
  var $cl_inbox= array('ID','SenderNumber','Text','ReceivingDateTime');
  var $order_inbox = array('ReceivingDateTime'=>'DESC');

  var $tb_outbox = 'outbox';
  var $cl_outbox= array('ID','Text','DestinationNumber','SendingDateTime','Status');
  var $order_outbox = array('SendingDateTime'=>'DESC');

  private $db2;

  function __construct()
  {
      parent::__construct();
      $this->db2 = $this->load->database('sms',TRUE);
  }

  private function _get_datatables_query_inbox()
  {

    $this->db2->from($this->tb_inbox);

    $i = 0;

    foreach ($this->cl_inbox as $item) // loop column
    {
      if($_POST['search']['value']) // if datatable send POST for search
      {

        if($i===0) // first loop
        {
          $this->db2->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db2->like($item, $_POST['search']['value']);
        }
        else
        {
          $this->db2->or_like($item, $_POST['search']['value']);
        }

        if(count($this->cl_inbox) - 1 == $i) //last loop
          $this->db2->group_end(); //close bracket
      }
      $cl_inbox[$i] = $item; // set column array variable to order processing
      $i++;
    }

    if(isset($_POST['order'])) // here order processing
    {
      $this->db2->order_by($cl_inbox[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    else if(isset($this->order_inbox))
    {
      $order = $this->order_inbox;
      $this->db2->order_by(key($order), $order[key($order)]);
    }
  }


  function get_datatables_inbox()
  {
    $this->_get_datatables_query_inbox();
    if($_POST['length'] != -1)
    $this->db2->limit($_POST['length'], $_POST['start']);
    $query = $this->db2->get();
    return $query->result();
  }

  function count_filtered_inbox()
  {
    $this->_get_datatables_query_inbox();
    $query = $this->db2->get();
    return $query->num_rows();
  }

  public function count_all_inbox()
  {
    $this->db2->from($this->tb_inbox);
    return $this->db2->count_all_results();
  }

  // Digunakan untuk tabel Inbox dan Outbox


  public function get_by_id($table,$id)
  {
    $this->db2->from($table);
    $this->db2->where('ID',$id);
    $query = $this->db2->get();

    return $query->row();
  }

  public function save($table,$data)
  {
    $this->db2->insert($table, $data);
    return $this->db2->insert_id();
  }

  public function update($table, $where, $data)
  {
    $this->db2->update($table, $data, $where);
    return $this->db2->affected_rows();
  }

  public function delete_by_id($table,$id)
  {
    $this->db2->where('ID', $id_status);
    $this->db2->delete($table);
  }

  public function get_customers_by($telp)
  {
    return $this->db->query("SELECT kode_pelanggan,nama_lengkap,wilayah,alamat,telp,tarif,status
                            FROM v_pelanggan
                            WHERE telp LIKE '%$telp%'
                            ");
  }

}
