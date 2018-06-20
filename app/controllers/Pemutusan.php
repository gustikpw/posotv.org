<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';
use PhpOffice\PhpWord\TemplateProcessor;
// use \PhpOffice\PhpWord\PhpWord as PhpWord;

class Pemutusan extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
      if (!$this->session->userdata('ses_admin')) {
  			redirect('login');
  		}
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
           <a class=\"btn btn-xs btn-info\" href=\"javascript:void(0)\" onclick=\"view($br->kode_pelanggan)\" title=\"Lihat detail tunggakan\"><i class=\"fa fa-eye\"></i></a>";
           // <a class=\"btn btn-xs btn-danger\" href=\"javascript:void(0)\" target=\"_blank\" title=\"Cetak surat Pemutusan\"><i class=\"fa fa-envelope-o\"></i></a>
     $data[] = $row;
     }
     $output = array(
       "data" => $data,
     );

     echo json_encode($output);
 }

  public function surat_pemutusan()
  {
    $kode = html_escape($this->input->get('kode'));
    $jenis = html_escape($this->input->get('jenis'));
    $tgl_pemutusan = html_escape($this->input->get('tgl_pemutusan'));
    $tgl_putus = substr($tgl_pemutusan,8,2).' '.bulan((int) substr($tgl_pemutusan,5,2)).' '.substr($tgl_pemutusan,0,4);
    $bln = (int) date('m');
    $nmbln = bulan($bln);
    $tgl_surat = date('d')." ".bulan_tahun(date('Y-m'));

    $profil = $this->pemutusan->get_pelanggan($kode);
    $posotv = $this->profil->get_by_id(1);

    // Data untuk template
    $nomor = $this->_new_nomor_surat();
    $data = $this->_get_tunggakan($kode);
    $jml_data = $data['jml_data'];

    /*
    * Creating Surat Pemutusan using template word
    */
    $templateProcessor = new TemplateProcessor(BASEPATH.'../assets/report/template/word/surat_pemutusan.docx');

    $templateProcessor->setValue("no_surat", $nomor['no_surat']);
    $templateProcessor->setValue("bulan_romawi", $nomor['bulan_romawi']);
    $templateProcessor->setValue("tahun", $nomor['tahun']);

    $templateProcessor->setValue("nama_lengkap", $profil->nama_lengkap);
    $templateProcessor->setValue("kode_pelanggan", $profil->kode_pelanggan);
    $templateProcessor->setValue("alamat", $profil->wilayah);

    $templateProcessor->setValue("tgl_pemutusan", $tgl_putus);
    $templateProcessor->setValue("tgl_surat", $tgl_surat);
    // -- mengisi tabel
    $templateProcessor->cloneRow('kode_invoice', $jml_data);
    $total_tagihan = 0;
    $no = 1;
    foreach ($data['data_tagihan'] as $val) {
      $templateProcessor->setValue("no#$no", $no);
      $templateProcessor->setValue("kode_invoice#$no", $val['kode_invoice']);
      $templateProcessor->setValue("bulan_penagihan#$no", $val['bulan_penagihan']);
      $templateProcessor->setValue("sub_total#$no", ribuan($val['tarif']));
      $total_tagihan += $val['tarif'];
      $kolektor = $val['kolektor'];
      $no++;
    }
    // -- selesai mengisi tabel
    $templateProcessor->setValue("total_tagihan", ribuan($total_tagihan));
    $templateProcessor->setValue("nama_kolektor", $kolektor);
    // Seva As to new file
    $save_path = "assets/report/export/word/";
    $file_name = "SP-$kode-$tgl_putus.docx";
    $templateProcessor->saveAs($save_path.$file_name);

    echo "<div style='text-align:center'><h3>Klik link untuk download!</h3><br>
    <a href=\"".base_url($save_path.$file_name)."\">$file_name</a></div>";
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

    $data['no_surat'] = $nomor_urut;
    $data['bulan_romawi'] = $bln_romawi;
    $data['tahun'] = $thn;
    return $data;
  }

  private function _get_tunggakan($kode_pelanggan='')
  {
    $q = $this->pemutusan->get_tunggakan($kode_pelanggan);
    $no = 0;
    foreach ($q as $dt) {
      $row[] = array(
        'kode_invoice' => $dt->kode_invoice,
        'kode_pelanggan' => $dt->kode_pelanggan,
        'tarif' => $dt->tarif,
        'bulan_penagihan' => bulan($dt->bulan).' '.$dt->tahun,
        'kolektor' => $dt->kolektor,
      );
      $no++;
    }
    $data['jml_data'] = $no;
    $data['data_tagihan'] = $row;
    return $data;
    // echo json_encode($data);
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

  /*
  * Unused
  */

  // public function surat()
  // {
  //   // Menangkap _GET['']
  //   $kode = html_escape($this->input->get('kode'));
  //   $jenis = html_escape($this->input->get('jenis'));
  //   $tgl_pemutusan = html_escape($this->input->get('tgl_pemutusan'));
  //   $tgl_putus = substr($tgl_pemutusan,8,2).' '.bulan((int) substr($tgl_pemutusan,5,2)).' '.substr($tgl_pemutusan,0,4);
  //   $bln = (int) date('m');
  //   $nmbln = bulan($bln);
  //   $tgl_surat = date('d')." Desember ".date('Y');
  //
  //   $profil = $this->pemutusan->get_pelanggan($kode);
  //   $posotv = $this->profil->get_by_id(1);
  //
  //   $data['data'] = array(
  //       'nomor' => $this->_new_nomor_surat(),
  //       // 'perihal' => "Penyampaian Pemutusan Sementara",
  //       'tgl_surat' => "Kawua, ".$tgl_surat,
  //       'tgl_pemutusan' => $tgl_putus,
  //       'data' => $this->_get_tunggakan($kode),
  //       'posotv' => $posotv,
  //       'profil' => $profil,
  //       'terms' => $this->_invoiceTerms('surat_pemutusan')
  //   );
  //
  //   // echo json_encode($data);
  //
  //   $this->load->view('admin/pemutusan/pemutusan_pdf',$data);
  // }


    // private function _new_nomor_surat()
    // {
    //   $qmax = $this->db->query("SELECT MAX(id_surat) AS last FROM surat")->row()->last;
    //   $hasil = $this->db->query("SELECT nomor FROM surat WHERE id_surat = $qmax")->row()->nomor;
    //   $nomor = (int) substr($hasil,0,4);
    //   $nomor++;
    //   $nomor_urut = strtoupper(sprintf("%04s", $nomor));
    //   // Buat nomor surat
    //   $bln = (int) date('m');
    //   $thn = date('Y');
    //   $bln_romawi = bulan_romawi($bln);
    //
    //   return "$nomor_urut/SP-PEL/POSOTV/$bln_romawi/$thn";
    // }


    // private function _get_tunggakan($kode_pelanggan='')
    // {
    //   $q = $this->pemutusan->get_tunggakan($kode_pelanggan);
    //   $profil = $this->pemutusan->get_pelanggan($kode_pelanggan);
    //   foreach ($q as $dt) {
    //     $row['kode_invoice'] = $dt->kode_invoice;
    //     $row['kode_pelanggan'] = $dt->kode_pelanggan;
    //     $row['tarif'] = $dt->tarif;
    //     $row['bulan_penagihan'] = bulan($dt->bulan).' '.$dt->tahun;
    //     $row['kolektor'] = $dt->kolektor;
    //     $tagihan[] = $row;
    //   }
    //   // echo json_encode($data);
    //   return $tagihan;
    // }


}
