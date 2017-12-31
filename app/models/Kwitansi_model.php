<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class kwitansi_model extends CI_Model {

  var $table = 'kwitansi';
  var $column = array('id_kwitansi','kwitansi','keterangan');
  var $order = array('id_kwitansi'=>'DESC');

  function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  public function update($where, $data)
  {
    $this->db->update('settings', $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by($blnPenagihan)
  {
    $this->db->like('bulan_penagihan', $blnPenagihan, 'after');
    $this->db->delete('temp_invoice');
  }

  public function cekInvoiceCode($cari) {
    $this->db->select_max('invoice','last');  // artinya SELECT max(kode_plgn) as last
    $this->db->from('temp_kwitansi');
    $this->db->like('invoice',$cari,'after'); // artinya WHERE kode_plgn LIKE '$wilayah%'
                                                      // after = $wilayah%    <- lihat posisi persennya(%)
                                                      // before = %$wilayah
                                                      // both = %$wilayah%
    $cek = $this->db->get();
    return $cek->row();
  }

  public function lastPayed($kode_plgn)
  {
    $this->db->select_max('bulan_bayar','lastpayed');
    $this->db->from('pembayaran');
    $this->db->where('kode_pelanggan',$kode_plgn);
    $cek = $this->db->get();
    return $cek->row();

  }

  public function cekIDWil($kode_wilayah)
  {
    $query = $this->db->query("SELECT * FROM wilayah WHERE kode_wilayah='$kode_wilayah'");
    return $query->row();
  }

  public function count_pel($id_wilayah)
  {
    $query = $this->db->query(" SELECT count(p.kode_pelanggan) AS jumlah FROM pelanggan p WHERE p.wilayah = '$id_wilayah'");
    return $query->row();
  }

  public function plgn_ByWilayah($wilayah)
  {
    $query = $this->db->query(" SELECT p.kode_pelanggan, p.wilayah FROM pelanggan p WHERE p.wilayah = '$wilayah'");
    return $query->result();
  }

  public function getSettings_serial($option_name)
  {
    $query = $this->db->query("SELECT option_name,option_value FROM settings WHERE option_name='$option_name' ");
    return $query;
  }

  public function cekBlnPenagihan($kode_wilayah,$bulan_penagihan)
  {
    return $this->db->query("SELECT t.kode_invoice,t.bulan_penagihan
      FROM temp_invoice t
      WHERE t.kode_invoice LIKE '$kode_wilayah%' AND t.bulan_penagihan LIKE '$bulan_penagihan%'");
  }

  public function getSettings($option_name,$option_value)
  {
    $query = $this->db->query("SELECT option_name,option_value FROM settings WHERE option_name='$option_name' AND option_value='$option_value'");
    return $query;
  }

  public function save_inv($data)	{
		$this->db->insert('temp_invoice', $data);
		return $this->db->insert_id();
	}

  public function profil_perusahaan()
  {
    return $query = $this->db->query("SELECT * FROM profil_perusahaan")->row();
  }

  public function findCollector($wilayah)
  {
    return $query = $this->db->query("SELECT * FROM v_kolektor WHERE wilayah LIKE '%$wilayah%'")->row();
  }

  public function cek_temp_invoice($kode_pelanggan,$bulanPenagihan)
  {
    return $query = $this->db->query("SELECT * FROM v_temp_invoice WHERE kode_pelanggan LIKE '%$kode_pelanggan%' AND bulan_penagihan LIKE '%$bulanPenagihan%' ")->row();
  }

  public function getDetailTagihan($scanedQR)
  {
    return $query = $this->db->query("SELECT * FROM v_temp_invoice WHERE hash='$scanedQR' OR kode_invoice='$scanedQR'");
  }

  public function updateSetoran($where, $data)
  {
    $this->db->update('temp_invoice', $data, $where);
    return $this->db->affected_rows();
  }

}
