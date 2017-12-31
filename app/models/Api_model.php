<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

  function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  public function get_data($q)
  {
    $this->db->select('id_pelanggan, kode_pelanggan, nama_lengkap, wilayah, alamat, status');
    $this->db->from('v_pelanggan');
    $this->db->like('kode_pelanggan',$q,'both'); // artinya WHERE kode_plgn LIKE '$q%'
    $this->db->or_like('nama_lengkap',$q,'both'); // artinya WHERE kode_plgn LIKE '$q%'
                                                      // after = $wilayah%    <- lihat posisi persennya
                                                      // before = %$wilayah
                                                      // both = %$wilayah%
    $this->db->limit(10);
    $query = $this->db->get();
    return $query->result();
  }

  public function cek_tunggakan_by($kode_pelanggan)
  {
    $query = $this->db->query("SELECT *
      FROM v_temp_invoice t
      WHERE t.kode_pelanggan = '$kode_pelanggan'
      AND t.`status` = 'Belum Bayar'
      ORDER BY t.bulan_penagihan ASC
    ");

    return $query;
  }

  public function auth_pin_sms($kode_pelanggan,$pin)
  {
    $query = $this->db->query("SELECT p.kode_pelanggan,p.nama_lengkap,p.pin_sms,p.id_pelanggan
      FROM v_pelanggan p
      WHERE p.kode_pelanggan = '$kode_pelanggan'
      AND p.pin_sms = '$pin'
    ");

    return $query;
  }

  public function insert_aduan_sms($data)
  {
    $this->db->insert('pengaduan', $data);
    return $this->db->insert_id();
  }

// Digunakan untuk tabel pelanggan, kolom telp atau pin_sms
  public function update_plgn_sms($where, $data)
  {
    $this->db->update('pelanggan', $data, $where);
    return $this->db->affected_rows();
  }

  public function cek_pembayaran_terakhir($kode_pelanggan,$limit)
  {
    $query = $this->db->query("SELECT *
      FROM v_temp_invoice t
      WHERE t.kode_pelanggan = '$kode_pelanggan'
      AND t.`status` = 'Lunas'
      ORDER BY t.bulan_penagihan DESC
      LIMIT $limit
    ");

    return $query->result();
  }

  /*
    UNTUK FUNGSI DASHBOARD
    * PELANGGAN
  */
  public function count_pelanggan($status='',$wilayah='')
  {
    $where = '';

    if (($status == 'null' || $status == '') && ($wilayah == 'null' || $wilayah == ''))
    $where = '';

    else if ($status != 'null' && $wilayah == 'null')
    $where = "WHERE p.id_status = $status";

    else if (($status == 'null' || $status == '') && $wilayah != 'null')
    $where = "WHERE p.id_wilayah = $wilayah";

    else if (($status != 'null' || $status != '') && ($wilayah != 'null' || $wilayah != ''))
    $where = "WHERE p.id_status = $status AND p.id_wilayah = $wilayah";


    // return $q = array('total_pelanggan' => "SELECT COUNT(p.kode_pelanggan) AS total_pelanggan
    //                       FROM v_pelanggan p
    //                       $where");
    return $this->db->query(" SELECT COUNT(p.kode_pelanggan) AS total_pelanggan
                              FROM v_pelanggan p
                              $where")->row();
  }

  public function count_wilayah()
  {
    return $this->db->query("SELECT COUNT(w.kode_wilayah) AS total_wilayah FROM wilayah w")->row();
  }

  public function count_bywilayah()
  {
    return $this->db->query("SELECT v.wilayah,count(v.id_wilayah) AS jumlah
                            FROM v_pelanggan v
                            GROUP BY v.id_wilayah
                            ")->result();
  }

// CONTOH MULTY DATABASE
  public function dbdua()
  {
    $DB2 = $this->load->database('sms',TRUE);
    return $DB2->query("SELECT * FROM inbox")->result();
  }

}
