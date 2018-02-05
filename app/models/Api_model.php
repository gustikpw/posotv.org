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

  /* UNTUK CHART.JS
   * Line Chart
   *
   */

   public function get_setoran_summary($tahun,$bulan,$user)
   {
      return $this->db->query("SELECT SUBSTRING(t.tgl_bayar,1,7) AS thn_bln, t.kolektor, SUM(t.tarif) AS subtotal
            FROM v_temp_invoice t
            WHERE t.`status` = 'Lunas'
            AND YEAR(t.tgl_bayar) = '$tahun'
            AND MONTH(t.tgl_bayar) = '$bulan'
            AND t.kolektor = '$user'
            GROUP BY t.user")->row();
   }

   public function get_user() // get kolektor
   {
      return $this->db->query("SELECT t.kolektor
            FROM v_temp_invoice t
            GROUP BY t.user")->result();
   }

   public function total_setoran_by($bulan)
   {
      return $this->db->query("SELECT SUBSTR(t.tgl_bayar,1,7) AS bulan, SUM(t.tarif) AS total
         FROM v_temp_invoice t
         WHERE t.tgl_bayar LIKE '$bulan%'")->row();
   }

   public function get_max_setoran()
   {
      return $this->db->query('SELECT b.kolektor,MAX(b.subtotal) AS max_setoran, b.bulan
         FROM v_setoran_bulan_ini b')->row();
   }

   /* PEMUTUSAN
    * Jika menunggak lebih dari 2 bulan
    */

   public function cek_pemutusan()
   {
      return $this->db->query("SELECT * FROM v_tunggakan ORDER BY banyak_tunggakan DESC")->result();
   }


   /* Mengambil pengaturan bernilai serialize
    *
    */

   public function getSettings_serial($option_name)
   {
     $query = $this->db->query("SELECT option_name,option_value FROM settings WHERE option_name='$option_name' ");
     return $query;
   }

   public function updateSettings($where, $data)
   {
      $this->db->update('settings', $data, $where);
      return $this->db->affected_rows();
   }

  // MENCARI PERSENTASE TARGET / PENCAPAIAN SETORAN
  public function get_target()
  {
    $sql_target = "SELECT SUM(i.tarif) AS target, DATE(NOW()) AS bulan
      FROM v_temp_invoice i
      WHERE i.`status` != 'Lunas'";

    $sql_capai = "SELECT SUM(i.tarif) AS capai, DATE(NOW()) AS bulan
      FROM v_temp_invoice i
      WHERE i.`status` = 'Lunas'
      AND YEAR(i.tgl_bayar) = YEAR(NOW())
      AND MONTH(i.tgl_bayar) = MONTH(NOW())";

    $t = $this->db->query($sql_target)->row();
    $c = $this->db->query($sql_capai)->row();

    return array('target' => $t, 'capai' => $c);
  }

  public function cek_statistik($bulan)
  {
    return $this->db->query("SELECT * FROM statistik_bulanan WHERE bulan LIKE '$bulan%'");
  }

  public function save_statistik($data)
  {
    $this->db->insert('statistik_bulanan', $data);
    return $this->db->insert_id();
  }

  public function update_statistik($where, $data)
  {
    $this->db->update('statistik_bulanan', $data, $where);
    return $this->db->affected_rows();
  }

// CONTOH MULTY DATABASE
  public function dbdua()
  {
    $DB2 = $this->load->database('sms',TRUE);
    return $DB2->query("SELECT * FROM inbox")->result();
  }

}
