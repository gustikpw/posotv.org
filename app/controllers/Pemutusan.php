<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pemutusan extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
      // $this->load->model('App_settings_model','settings');
      $this->load->model('Pemutusan_model','pemutusan');
      $this->load->model('Api_model','api');
      $this->load->model('Profil_perusahaan_model','profil');
      $this->load->helper(array('MY_bulan','MY_ribuan'));
  }

  public function index()
  {
      echo "This not a Page!";
  }

  /* PELANGGAN YANG MENUNGGAK >= 2 BULAN
  * Akan dibuatkan surat pemutusan
  * khusus mencari penunggak
  * @ memberikan list pelanggan yang menunggak
  */

 public function pemutusan_list()
 {
   $list = $this->api->cek_pemutusan();
   $data = array();
   $no = 0;
   foreach ($list as $br) {
     $no++;
     $row = array();
     $row[] = $no;
     $row[] = "<span class='font-bold'>$br->kode_pelanggan</span>";
     $row[] = $br->nama_lengkap;
     $row[] = $br->wilayah;
     // $row[] = $br->alamat;
     $row[] = $br->status;
     $row[] = ribuan($br->tarif);
     $row[] = "<span class='font-bold' title=\"Total yang harus dibayar\">".ribuan($br->total)."</span>";
     $row[] = $br->kolektor;
     $url = site_url('api_search/surat');
     $row[] = "<span class='font-bold'>$br->banyak_tunggakan Bulan</span>";
     $row[] = "<a class=\"btn btn-xs btn-warning\" href=\"javascript:void(0)\" onclick=\"showModal('$br->kode_pelanggan')\" title=\"Cetak surat Peringatan\"><i class=\"fa fa-envelope\"></i></a>
           <a class=\"btn btn-xs btn-danger\" href=\"javascript:void(0)\" target=\"_blank\" title=\"Cetak surat Pemutusan\"><i class=\"fa fa-envelope-o\"></i></a>
           <a class=\"btn btn-xs btn-info\" href=\"javascript:void(0)\" onclick=\"view($br->kode_pelanggan)\" title=\"Lihat detail tunggakan\"><i class=\"fa fa-eye\"></i></a>";
     $data[] = $row;
     }
     $output = array(
       "data" => $data,
     );

     echo json_encode($output);
 }

  public function surat()
  {
    // Menangkap _GET['']
    $kode = html_escape($this->input->get('kode'));
    $jenis = html_escape($this->input->get('jenis'));
    $tgl_pemutusan = html_escape($this->input->get('tgl_pemutusan'));
    $tgl_putus = substr($tgl_pemutusan,8,2).' '.bulan((int) substr($tgl_pemutusan,5,2)).' '.substr($tgl_pemutusan,0,4);
    $bln = (int) date('m');
    $nmbln = bulan($bln);
    $tgl_surat = date('d')." Desember ".date('Y');

    $profil = $this->pemutusan->get_pelanggan($kode);
    $posotv = $this->profil->get_by_id(1);

    $data['data'] = array(
        'nomor' => $this->_new_nomor_surat(),
        // 'perihal' => "Penyampaian Pemutusan Sementara",
        'tgl_surat' => "Kawua, ".$tgl_surat,
        'tgl_pemutusan' => $tgl_putus,
        'data' => $this->_get_tunggakan($kode),
        'posotv' => $posotv,
        'profil' => $profil,
        'terms' => $this->_invoiceTerms('surat_pemutusan')
    );

    // echo json_encode($data);

    $this->load->view('admin/pemutusan/pemutusan_pdf',$data);
  }

  private function _new_nomor_surat()
  {
    $qmax = $this->db->query("SELECT MAX(id_surat) AS last FROM surat")->row()->last;
    $hasil = $this->db->query("SELECT nomor FROM surat WHERE id_surat = $qmax")->row()->nomor;
    $nomor = (int) substr($hasil,0,4);
    $nomor++;
    $nomor_urut = strtoupper(sprintf("%04s", $nomor));
    // Buat nomor surat
    $bln = (int) date('m');
    $thn = date('Y');
    $bln_romawi = bulan_romawi($bln);

    return "$nomor_urut/SP-PEL/POSOTV/$bln_romawi/$thn";
  }

  private function _get_tunggakan($kode_pelanggan='')
  {
    $q = $this->pemutusan->get_tunggakan($kode_pelanggan);
    $profil = $this->pemutusan->get_pelanggan($kode_pelanggan);
    foreach ($q as $dt) {
      $row['kode_invoice'] = $dt->kode_invoice;
      $row['kode_pelanggan'] = $dt->kode_pelanggan;
      $row['tarif'] = $dt->tarif;
      $row['bulan_penagihan'] = bulan($dt->bulan).' '.$dt->tahun;
      $row['kolektor'] = $dt->kolektor;
      $tagihan[] = $row;
    }
    // echo json_encode($data);
    return $tagihan;
  }

   // mengambil paragraf surat pemutusan
  public function get_surat()
  {
    $data = $this->_invoiceTerms('surat_pemutusan');
    echo json_encode($data);
  }

	private function _invoiceTerms($val)
	{
		$qterms = $this->api->getSettings_serial($val)->row();
		return unserialize($qterms->option_value);
	}




}
