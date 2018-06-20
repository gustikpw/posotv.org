<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Kwitansi extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      $this->load->model('kwitansi_model','kwitansi');
		$this->load->helper(array('MY_ribuan'));
			// $this->load->library('fpdf','ci_qr_code');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	private function _invoiceCode($wilayah,$bulanPenagihan) { // 'KWA'
		$tgl_skrg = substr(str_replace('-','',$bulanPenagihan),2,4); // 1710
    $kode = $wilayah.$tgl_skrg; // KWA1710
		$angkaRandom = rand(1,999999);
		return $nextInvoiceNum = $kode.sprintf('%06s',$angkaRandom); // Jadinya 'KWA1710999999' 9999999 = invoice random
  }

	private function _generateQr($invoice)
  {
		$pathFile = base_url('assets/tempQr/img/'.$invoice.'.png');
		if (!file_exists($pathFile)) {
	    $params['data'] = $invoice;
	    $params['level'] = 'H';
	    $params['size'] = 10;
	    $params['savename'] = FCPATH.'assets/tempQr/img/'.$invoice.'.png';
	    $this->ci_qr_code->generate($params);
		}
  }

	public function tes()
	{
		$data = $this->kwitansi->getSettings_serial('invoice_terms')->row();
		$mm = unserialize($data->option_value);
		// $ms = serialize($this->_terms());
		// $us = unserialize($ms);

		echo json_encode($mm);

		// $data = array(
		// 'option_value' => serialize($this->_terms()),
		// );
		// $this->kwitansi->update(array('option_name' => 'invoice_terms'), $data);
		// echo json_encode(array("status" => TRUE));
	}

	public function createInvCode()
  //memasukan kode invoice, kode_plgn, dan hash di database temp_kwitansi
  {
		date_default_timezone_set("Asia/Hong_Kong");
		$kode_wilayah = html_escape($this->input->post('wilayah'));
		$invoiceKey = html_escape($this->input->post('sandi'));
		$bulanPenagihan = html_escape($this->input->post('bulan_penagihan').'-02');

		$cekKey = $this->kwitansi->getSettings('invoice_key',$invoiceKey); // option_name , option value // Validasi InvoiceKey pada database. jika sama, buat kwitansi

		if ($invoiceKey !='' && $cekKey->num_rows()===1) {
			if ($this->_cekBulanPenagihan($kode_wilayah,$bulanPenagihan)!==0) {
				$pesan = array( 'pesan' => 'Maaf, Wilayah "'.$kode_wilayah.'" dibulan "'.$bulanPenagihan.'" sudah ter-Registrasi! <br>Silahkan Pilih pada Panel <strong>Generated Kwitansi</strong>',
												'title' => 'Already exist!',
												'msgtype' => 'error');
			} else {
					$idWil = $this->kwitansi->cekIDWil($kode_wilayah);
			    $q = $this->kwitansi->count_pel($idWil->id_wilayah); // Hitung jumlah pelanggan berdasarkan wilayah
					if ($q->jumlah != 0) {
						$takeKode = $this->kwitansi->plgn_ByWilayah($idWil->id_wilayah); // ambil semua kode pelanggan berdasarkan wilayah
						foreach ($takeKode as $kode) {
							$cekinv = $this->_invoiceCode($kode_wilayah,$bulanPenagihan);
							$data = array('kode_invoice' => $cekinv,
							'kode_pelanggan' => $kode->kode_pelanggan,
							'bulan_penagihan' => $bulanPenagihan,
							'hash' => md5($cekinv),
							'user' => base64_decode(urldecode($this->session->sesikode)),
							);
							$insert = $this->kwitansi->save_inv($data);
						}
						// setelah data invoice dimasukan pada database, generateInvoice membuat file PDF dan menyimpannya pada server
						$this->generateInvoice($idWil->id_wilayah,substr($bulanPenagihan,0,7));
						$pesan = array( 'pesan' => 'Sukses, <strong>'.$q->jumlah.'</strong> data telah dimasukan!',
														'title' => 'Berhasil!',
														'msgtype' => 'success');
					} else {
						$pesan = array( 'pesan' => 'Maaf, Pelanggan yang diWilayah "'.$kode_wilayah.'" tidak ada dalam database!',
														'title' => 'Not Founds!',
														'msgtype' => 'error');
					}
				}
		} else {
			$pesan = array( 'pesan' => 'Maaf, Anda tidak memiliki akses untuk mencetak Kwitansi! <br> Sandi Kwitansi Salah!',
											'title' => 'Not Authorized!',
											'msgtype' => 'error');
		}
    echo json_encode($pesan);
  }

	private function _cekBulanPenagihan($kode_wilayah,$bulan_penagihan) //2017-10
	{
		// melakukan validasi data ke temp_invoice jika ada $bulan_penagihan yang sama registrasi Invoice dibatalkan
		return $this->kwitansi->cekBlnPenagihan($kode_wilayah,$bulan_penagihan)->num_rows();
	}

	public function generateInvoice($wilayah,$bulanPenagihan)
	{
		ini_set('max_execution_time', 300); // terjadi error ketika generate kwitansi > 30 detik. ini untuk mengaturnya

		$bulan = array('','Januari','Februari','Maret','April','Mei', 'Juni','Juli','Agustus','September', 'Oktober','November','Desember');
		$pelanggan = $this->kwitansi->plgn_ByWilayah($wilayah); // ambil semua kode pelanggan berdasarkan wilayah
		$profil = $this->kwitansi->profil_perusahaan();
    $kolektor = $this->kwitansi->findCollector($wilayah);
		$terms = $this->_invoiceTerms();
		// echo json_encode($pelanggan);
		$data = [];
		foreach ($pelanggan as $dt) {
			$row = [];
			$kdplgn = $dt->kode_pelanggan;
			$dataInvoice = $this->kwitansi->cek_temp_invoice($kdplgn,$bulanPenagihan);
			$row['kode_invoice'] = $dataInvoice->kode_invoice;
      $row['kode_pelanggan'] = $dataInvoice->kode_pelanggan;
			$namaLengkap = (strlen($dataInvoice->nama_lengkap)>18) ? substr($dataInvoice->nama_lengkap,0,18).'.' : $dataInvoice->nama_lengkap ;
      $row['nama_lengkap'] = $namaLengkap;
			$row['alamat'] = $dataInvoice->alamat;
      $row['wilayah'] = $dataInvoice->wilayah;
      $row['tv'] = $dataInvoice->jml_tv;
      $row['harga'] = $dataInvoice->tarif;
			$blnPenagihan = (int) substr($dataInvoice->bulan_penagihan,5,2);
			$blnPenagihan = $bulan[$blnPenagihan].' '.date('Y');
			$row['bulan_penagihan'] = $blnPenagihan;
			$row['kontak_cs'] = '081354338084';
			$row['kolektor'] = $kolektor->nama_lengkap;
      // membuat QRCode
      $this->_generateQr($dataInvoice->hash);
      $row['url_gambar'] = base_url().'/assets/tempQr/img/'.$dataInvoice->hash.'.png';
      //pemisah angka ribuan
			$row['tarif'] = "Rp. ".ribuan($dataInvoice->tarif).",-";
			// Pengaturan nama file, dll
			$row['namafile'] = FCPATH.'assets/invoice/'.$bulanPenagihan.'_'.$dataInvoice->kode_wilayah.'_'.str_replace(' ','_',$dataInvoice->wilayah).'.pdf';

      $data[] = $row;
    }

    $kirim = array(
			'company' => $profil,
			'cust' => $data,
      'terms' => $terms
    );

    $this->load->view('admin/kwitansi/invoice_edit',$kirim);
		// echo json_encode($data)."<br><br>";
		// echo json_encode($pelanggan);
		// echo json_encode($kirim);
	}

	// public function files()
	// {
	// 	$asd = scandir(FCPATH.'assets/invoice/');
	// 	$length = count($asd);
	// 	$row = '';
	// 	$status = FALSE;
	// 	for ($i=2; $i < $length; $i++) {
	// 		$fileurl = base_url('assets/invoice/').$asd[$i];
	// 		$imageFileType = pathinfo($fileurl,PATHINFO_EXTENSION);
	// 		if ($imageFileType == 'pdf') {
	// 			$status = TRUE;
	// 			$wilayah = substr($asd[$i],12,strlen($asd[$i]));
	// 			$wilayah = str_replace('.pdf','',$wilayah);
	// 			$row .= "<tr>";
	// 			$row .= "<td>".str_replace('_',' ',$wilayah)."</td>";
	// 			$row .= "<td>".substr($asd[$i],0,7)."</td>";
	// 			$row .= "<td>
	// 									<a class=\"btn btn-xs btn-info\" href=\"$fileurl\" target=\"_blank\"><i class=\"fa fa-eye\"></i> View</a>
	// 									<a class=\"btn btn-xs btn-primary\" href=\"$fileurl\"><i class=\"fa fa-download\"></i> Download</a>
	// 									<a class=\"btn btn-xs btn-danger\"  href=\"javascript:void(0)\" title=\"Hapus Kwitansi\" onclick=\"hapusFile('".$asd[$i]."')\"><i class=\"fa fa-trash\"></i> Delete</a>
	// 								</td>";
	// 			$row .= "</tr>";
	// 		}
	// 	}
	// 	if ($status==TRUE) {
	// 		$data['files'] = $row;
	// 	} else {
	// 		$data['files'] = "<tr><td colspan='3' class='text-center' style='font-style: italic'>Kwitansi masih kosong!</td></tr>";
	// 	}
	// 	echo json_encode($data);
	// }

	public function files2()
	{
		$asd = scandir(FCPATH.'assets/invoice/');
		$length = count($asd);
		$data = array();
		$status = FALSE;
		for ($i=2; $i < $length; $i++) {
			$row = array();
			$fileurl = base_url('assets/invoice/').$asd[$i];
			$imageFileType = pathinfo($fileurl,PATHINFO_EXTENSION);
			if ($imageFileType == 'pdf') {
				$status = TRUE;
				$wilayah = substr($asd[$i],12,strlen($asd[$i]));
				$wilayah = str_replace('.pdf','',$wilayah);
				$row[]= str_replace('_',' ',$wilayah);
				$row[]= substr($asd[$i],0,7);
				$row[]= "	<a class=\"btn btn-xs btn-info\" href=\"$fileurl\" target=\"_blank\"><i class=\"fa fa-eye\"></i> View</a>
									<a class=\"btn btn-xs btn-primary\" href=\"$fileurl\"><i class=\"fa fa-download\"></i> Download</a>
									<a class=\"btn btn-xs btn-danger\"  href=\"javascript:void(0)\" title=\"Hapus Kwitansi\" onclick=\"hapusFile('".$asd[$i]."')\"><i class=\"fa fa-trash\"></i> Delete</a>";
			} else {$status = FALSE;}

			if ($status==TRUE) {
				$data[] = $row;
			}
		}

		$output = array('data' => $data,);
		echo json_encode($output);
	}

	public function hapusFile($namaFile)
	{
		$pathh = FCPATH.'assets/invoice/'.$namaFile;
		if (file_exists($pathh)) {
			// menghapus data pada database berdasarkan bulan Penagihan
			$blnPenagihan = substr($namaFile,0,4);
			$this->kwitansi->delete_by($blnPenagihan);
			// menghapus file pada server sesuai isi database
			unlink($pathh);
		}
		echo json_encode(array("status" => TRUE));
	}

	public function hapusTempAll()
	{
		$dir = FCPATH.'assets/tempQr/img/*.png';
		$files = glob($dir); // get all file names
		foreach($files as $file){ // iterate files
		  if(is_file($file))
		    unlink($file); // delete file
		}
		echo json_encode(array("status" => TRUE));
	}

	public function openFile($link='')
	{
		if (file_exists($link)) {
			readfile($link, "r");
		} else {
			echo "Unable to open file! | Not Founds!";
		}
	}

	private function _invoiceTerms()
	{
		$qterms = $this->kwitansi->getSettings_serial('invoice_terms')->row();
		return unserialize($qterms->option_value);
	}

	public function getDetailTagihan($scanedQR="")
	{
		if ($scanedQR !="") {
			$query = $this->kwitansi->getDetailTagihan($scanedQR);
			if ($query->num_rows() !== 0) {
				$q = $query->row();
				$status = ($q->status == 'Lunas') ? "<i class='fa fa-check fa-2x text-success' data-toggle='tooltip' title='$q->status'></i>" : "<i class='fa fa-clock-o fa-2x' data-toggle='tooltip' title='$q->status'></i>" ;
				$row = "<tr class='$q->hash'>
				<td><input name='kode_invoice[]' value='$q->kode_invoice' hidden>$q->kode_invoice</td>
				<td>$q->kode_pelanggan</td>
				<td>$q->nama_lengkap</td>
				<td>$q->wilayah</td>
				<td>".str_replace('-02','',$q->bulan_penagihan)."</td>
				<td>$status <input name='status[]' value='$q->status' hidden></td>
				<td>$q->tarif <input type='number' id='$q->hash' value='$q->tarif' hidden></td>
				<td><input type='number' name='jmlSetoran[]' class='form-control input-sm' value='$q->tarif'></td>
				<td class='text-center'>
					<a href='javascript:void(0)' class='btn btn-xs btn-info' onclick=\"addKet('$q->kode_invoice')\"><i class='fa fa-info'></i> Add Info</a>
					<a href='javascript:void(0)' class='btn btn-xs btn-danger' onclick=\"hapusTr('$q->hash')\"><i class='fa fa-trash'></i> Hapus</a>
					<textarea name='keterangan[]' class='form-control input-sm $q->kode_invoice' placeholder='Tambahkan keterangan kwitansi ini' style='display:none'>$q->keterangan</textarea>
					<input name='hash[]' value='$q->hash' hidden>
				</td>
				</tr>";
				$hash = $q->hash;
			} else {
				$row = $hash = "";
			}
		} else {
			$row = $hash = "";
		}

		$data = array('data' => $row,
							'hash' => $hash,
							'tarif' =>(int) ($q->tarif) ? $q->tarif : 0,
		);
		echo json_encode($data);
	}

	public function setor()
	{
		$ceksession = base64_decode(urldecode($this->session->sesikode));

		$nama_kolektor = $this->input->post('nama_kolektor');
		$kode_invoice = $this->input->post('kode_invoice[]');
		$jmlSetoran = $this->input->post('jmlSetoran[]');
		$hash = $this->input->post('hash[]');
		$status = $this->input->post('status[]');
		$ket = $this->input->post('keterangan[]');

		for ($i=0; $i < count($hash); $i++) {
			// Get user berdasarkan wilayah kolektor
			$inv = $kode_invoice[$i];
			$cek_wil = $this->db->query("SELECT * FROM v_temp_invoice WHERE kode_invoice LIKE '$inv'")->row();
			$cek_kolektor = $this->db->query("SELECT * FROM v_kolektor WHERE wilayah LIKE '%$cek_wil->id_wilayah%'")->row();
			$sesi = ($ceksession == '1') ? $cek_kolektor->id_kolektor : $cek_kolektor->id_kolektor ;

			$data = array(
				'user' => $sesi,
				'status' => 'Lunas',
				'tgl_bayar' => date('Y-m-d'),
				'keterangan' => $ket[$i],
			);
			if ($status[$i] != 'Lunas') { // lakukan input data hanya jika invoice berstatus belum lunas
				$this->kwitansi->updateSetoran(array('kode_invoice' => $kode_invoice[$i], 'hash' => $hash[$i], ), $data);
			}
		}

		echo json_encode(array('status' => TRUE, ));
	}

	public function tes2()
	{
		$this->load->view('admin/kwitansi/qrscan');
	}


	// public function data_invoice() // kebutuhan data untuk invoice
	// {
	// 	$infoPerusahaan = $this->kwitansi->get_info_perusahaan();
	// 	$terms = $this->kwitansi->get_terms();
	// 	$terms = $this->kwitansi->get_terms();
	// }

	// public function cekLastPembayaran($kode_pelanggan)
	// {
	// 	date_default_timezone_set("Asia/Hong_Kong");
	// 	$ymd = $this->kwitansi->getLastBayar($kode_pelanggan); // return blnbayar = '2017-10-02'
	// 	$tgl_skrg = date('Y-m-d'); // 2017-10-27
	//
	// }


}
