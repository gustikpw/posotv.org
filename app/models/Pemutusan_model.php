<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pemutusan_model extends CI_Model {

  function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  public function get_tunggakan($kode_pelanggan='')
  {
    return $this->db->query("SELECT t.kode_invoice,t.kode_pelanggan,t.tarif,t.bulan_penagihan,YEAR(t.bulan_penagihan) AS tahun, MONTH(t.bulan_penagihan) AS bulan,t.kolektor
      FROM v_temp_invoice t
      WHERE t.kode_pelanggan = '$kode_pelanggan'
      AND t.`status` = 'Belum Bayar'
      ORDER BY t.bulan_penagihan ASC ")->result();
  }

  public function get_pelanggan($kode_pelanggan)
  {
    return $this->db->query("SELECT p.kode_pelanggan,p.nama_lengkap,p.wilayah,p.alamat
      FROM v_pelanggan p
      WHERE p.kode_pelanggan = '$kode_pelanggan'")->row();
  }
}
