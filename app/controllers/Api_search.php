<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Api_search extends CI_Controller {

	function __construct()
  {
      parent::__construct();
			$this->load->model('api_model','api');
			$this->load->helper(array('MY_ribuan','MY_bulan'));
  }

	public function index()
	{
		// $data['title'] = 'Not Founds';
		// $this->load->view('errors/html/error_404',$data);
	}

	public function cari_plgn()
	{
		if (!empty($_GET['q']))
		{
			$q = $_GET['q'];
			$list = $this->api->get_data($q);
			$data = array();
			$data2 = array();

			foreach ($list as $br)
			{
				$row = array();

				$row["id"] = $br->id_pelanggan;
				$row["text"] = "$br->kode_pelanggan | $br->nama_lengkap";
				$row["items_detail"] = array(
					'id' => $br->id_pelanggan,
					'kode' => $br->kode_pelanggan,
					'nama' => $br->nama_lengkap,
					'wilayah' => $br->wilayah,
					'alamat' => $br->alamat,
					'status' => $br->status,
				);
				$data[] = $row;
			}

			$output = array(
				'items' => $data,
			);

			echo json_encode($output);
		}
	}

	public function cek_tunggakan()
	{
		$kode_pelanggan = $this->input->post('cek');
    // Cek Tunggakan
		$query = $this->api->cek_tunggakan_by($kode_pelanggan);
		$banyak_tunggakan = $query->num_rows();
		$detail_pelanggan = $query->first_row('array');
		$tunggakan_akhir = $query->last_row('array');
		$total = 0;
		$row = $row2 = "";
		foreach ($query->result() as $dt)
		{
			// total tunggakan
			$total += $dt->tarif;

			$row .= "<tr>
			<td><a href=\"javascript:void(0)\" onclick=\"bayar($dt->id_trx)\" title=\"Tagihan belum lunas!\" class=\"btn btn-xs btn-primary\">$dt->kode_invoice</a></td>
			<td>$dt->bulan_penagihan</td>
			<td>$dt->status</td>
			<td>$dt->tarif</td>
			</tr>
			";
		}
		$row .= "<tr>
			<td colspan=\"3\" class=\"font-bold text-right\">Total </td>
			<td colspan=\"2\" class=\"font-bold text-left\">Rp. ".ribuan($total).",-</td>
		</tr>";

    // Cek 5 Pembayaran Terakhir
		$limit = 5;
		$query2 = $this->api->cek_pembayaran_terakhir($kode_pelanggan,$limit);

		foreach ($query2 as $dt2)
		{
			$row2 .= "<tr>
			<td>$dt2->kode_invoice</td>
			<td>$dt2->bulan_penagihan</td>
			<td>$dt2->status</td>
			<td>$dt2->tarif</td>
			<td><a href=\"javascript:void(0)\" onclick=\"invoice($dt2->hash)\" title=\"Lihat Kwitansi?\" class=\"btn btn-xs btn-primary\">Invoice</a></td>
			</tr>";
		}
		// Output
		$output = array(
			'tunggakan' =>  $row,
			'banyak_tunggakan' =>  $banyak_tunggakan,
			'detail_pelanggan' =>  $detail_pelanggan,
			// 'tunggakan_akhir' =>  $tunggakan_akhir->bulan_penagihan,
			'total_tunggakan' =>  ribuan($total),
			'pembayaran_terakhir' =>  $row2,
		);

		echo json_encode($output);
	}

   /*
	*------------------------------------
	*	AUTO REPLY
	*------------------------------------
	* Yang akses fungsi ini adalah Autoreply.php { function autoreply() }
	*
	*/

	public function cek_tunggakan_sms()
	{
		$kode_pelanggan = $this->input->post('kode_pelanggan');
		$pin = $this->input->post('pin');

		$row = "";
		$auth = $this->api->auth_pin_sms(strtoupper($kode_pelanggan),$pin);
		if ($auth->num_rows() == 0) {
			$row .= "KODEPELANGGAN atau PIN salah. Ketik : TAGIHAN <spasi> KODEPELANGGAN <spasi> PIN. Kirim ke 082394824684";
			$status = 401;
		}
		else {
			// Cek Tunggakan
			$query = $this->api->cek_tunggakan_by($kode_pelanggan);
			$banyak_tunggakan = $query->num_rows();
			$detail_pelanggan = $query->first_row('array');
			$total = 0;

			if ($banyak_tunggakan != 0) {
				$status = 200;
				$row .= "Tagihan an. ".substr($detail_pelanggan['nama_lengkap'],0,16)."(".$detail_pelanggan['kode_pelanggan'].") bulan : ";
				foreach ($query->result() as $dt)
				{
					// total tunggakan
					$total += $dt->tarif;
					$row .= str_replace('-02','',$dt->bulan_penagihan).";";
				}
				$row .= "Total Rp.".ribuan($total).". Lakukan pembayaran u/ menghindari pemutusan. Terima kasih";
			} else {
				$row .= "Tidak ada tunggakan!";
				$status = 404;
			}

		}

		$output = array(
			'respon' =>  $row,
			'status' => $status,
		);

		echo json_encode($output);
	}

	public function ubah_nomor_sms()
	{
		$kode_pelanggan = $this->input->post('kode_pelanggan');
		$nomor_baru 	= $this->input->post('nomor_baru');
		$pin 				= $this->input->post('pin');
		$respon 	= $data = '';
		// Validasi KODE_PELANGGAN dan PIN
		$query = $this->api->auth_pin_sms(strtoupper($kode_pelanggan),$pin);
		if ($query->num_rows() == 0) {
			$respon = "KODE_PELANGGAN atau PIN salah. Ketik : UBAHNOMOR<spasi>KODE_PELANGGAN<spasi>NOMOR_BARU<spasi>PIN Kirim ke 082394824684";
			$status = 401;
		} else {
			$cust = $query->row();
			$data = array(
				'telp' => $nomor_baru
			);

			$insert = $this->api->update_plgn_sms(array('id_pelanggan' => $cust->id_pelanggan),$data);
			if ($insert) {
				$respon = "Terima kasih Sdr/i. $cust->nama_lengkap($kode_pelanggan), nomor $nomor_baru akan menerima informasi dari kami selanjutnya.";
				$status = 200;
			} else {
				$respon = "Maaf, sistem sedang sibuk. Silahkan coba beberapa saat lagi.";
				$status = 500;
			}

		}

		$output = array(
			'respon' =>  $respon,
			'status' => $status,
			'data' => $query->num_rows(),
		);

		echo json_encode($output);
	}

	public function ubah_pin_sms()
	{
		$kode_pelanggan = $this->input->post('kode_pelanggan');
		$pin_lama		= $this->input->post('pin_lama');
		$pin_baru		= $this->input->post('pin_baru');
		$respon 	= $data = '';
		// Validasi KODE_PELANGGAN dan PIN
		$query = $this->api->auth_pin_sms(strtoupper($kode_pelanggan),$pin);
		if ($query->num_rows() == 0) {
			$respon = "KODE_PELANGGAN atau PIN salah. Ketik : UBAHPIN<spasi>KODE_PELANGGAN<spasi>PIN_LAMA<spasi>PIN_BARU Kirim ke 082394824684";
			$status = 401;
		} else {
			$cust = $query->row();
			$data = array(
				'pin_sms' => $pin_baru
			);

			$insert = $this->api->update_plgn_sms(array('id_pelanggan' => $cust->id_pelanggan),$data);
			if ($insert) {
				$respon = "Terima kasih Sdr/i. $cust->nama_lengkap($kode_pelanggan), gunakan $pin_baru untuk PIN selanjutnya.";
				$status = 200;
			} else {
				$respon = "Maaf, sistem sedang sibuk. Silahkan coba beberapa saat lagi.";
				$status = 500;
			}

		}

		$output = array(
			'respon' =>  $respon,
			'status' => $status,
			'data' => $query->num_rows(),
		);

		echo json_encode($output);
	}

	public function aduan_sms()
	{
		$kode_pelanggan = $this->input->post('kode_pelanggan');
		$pin 		= $this->input->post('pin');
		$aduan 	= $this->input->post('aduan');
		$respon 	= $data = '';
		// Validasi KODE_PELANGGAN dan PIN
		$query = $this->api->auth_pin_sms(strtoupper($kode_pelanggan),$pin);
		if ($query->num_rows() == 0) {
			$respon = "KODE_PELANGGAN atau PIN salah. Ketik : ADUAN#KODE_PELANGGAN#PIN#ADUAN_ANDA Kirim ke 082394824684";
			$status = 401;
		} else {
			$cust = $query->row();
			$data = array(
				'kode_pelanggan' => $cust->id_pelanggan,
				'tgl_lapor' => date('Y-m-d'),
				'tgl_gangguan' => date('Y-m-d'),
				'prioritas' => 'Medium',
				'jenis_gangguan' => 5, // Aduan SMS pada databse
				'keterangan' => $aduan,
				'status_aduan' => 'Menunggu',
			);

			$insert = $this->api->insert_aduan_sms($data);
			if ($insert) {
				$respon = "Terima kasih Sdr. $cust->nama_lengkap, aduan Anda sedang kami proses.";
				$status = 200;
			} else {
				$respon = "Maaf, sistem sedang sibuk. Silahkan coba beberapa saat lagi.";
				$status = 500;
			}

		}

		$output = array(
			'respon' =>  $respon,
			'status' => $status,
			'data' => $query->num_rows(),
		);

		echo json_encode($output);
	}

	// private function _validasi()
	// {
   //
	// }

  /*
	--------------------------------
	UNTUK FUNGSI PADA DASHBOARD
	--------------------------------
	1) TOTAL PELANGGAN
		$status =
			1 = aktif,
			2 = putus_sementara,
			3 = putus,
			null(semua status)

		$wilayah = (number) id_wilayah
			null = (semua wilayah)

		*** Cara Penggunaan ***
		a) total_pelanggan(1/44) 	-> menghasilkan jumlah pelanggan 'Aktif' berdasarkan 'Wilayah'
		b) total_pelanggan(1) 		-> menghasilkan jumlah pelanggan 'Aktif' secara keseluruhan
		c) total_pelanggan(null) 	-> menghasilkan jumlah pelanggan secara keseluruhan (entah aktif maupun non-aktif)
		c) total_pelanggan(null/44) 	-> menghasilkan jumlah pelanggan dengan 'Status' secara keseluruhan berdasarkan 'Wilayah'
  */

	private function _total_pelanggan($status='',$wilayah='')
	{
		if ($status =='')
		$status = 'null';
		if ($wilayah =='')
		$wilayah = 'null';

		$query = $this->api->count_pelanggan($status,$wilayah);
		return $query;
	}

	private function _total_wilayah()
	{
		$query = $this->api->count_wilayah();
		return $query;
	}


	public function dashboard_data()
	{
		$row = $data = $pelanggan = array();
		$wilayah = "";

		$row["total_pelanggan"] = $this->_total_pelanggan()->total_pelanggan;
		$row["pelanggan_aktif"] = $this->_total_pelanggan(1)->total_pelanggan;
		$row["pelanggan_putus_sementara"] = $this->_total_pelanggan(2)->total_pelanggan;
		$row["pelanggan_non_aktif"] = $this->_total_pelanggan(3)->total_pelanggan;
		$bywilayah = $this->api->count_bywilayah();
		$pelanggan = $row;

		foreach ($bywilayah as $wil) {
			$wilayah .= "<li><a role=\"menuitem\" href=\"#\"> $wil->wilayah <span class=\"text-success font-bold pull-right\">$wil->jumlah</span></a></li>";
		}

		// Untuk myDoughnutChart
		// @chart.js
		$bgcolor 	= array(
			'#FF6384','#36A2EB','#FFCE56','#7B241C','#D84315','#633974','#1A5276','#117864','#9A7D0A','#5F6A6A',
			'#9C640C','#1C2833','#21618C','#F4511E','#00897B','#039BE5','#33691E','#212121','#1A237E','#B71C1C',
			'#001f4d','#003d4d','#006600','#663300','#336600','#ff6600','#e6e600','#660033','#550080','#24248f'
		);
		$hovercolor = array(
			'#FF6384','#36A2EB','#FFCE56','#CD6155','#FF5722','#9B59B6','#2980B9','#16A085','#F1C40F','#BDC3C7',
			'#D35400','#566573','#3498DB','#FF5722','#26A69A','#29B6F6','#4CAF50','#9E9E9E','#3F51B5','#F44336',
			'#0052cc','#00a3cc','#009900','#b35900','#59b300','#ff8533','#ffff00','#cc0066','#9900e6','#4747d1'
		);

		$i = 0;
		$pie = $labels = $bgColor = $hovColor = array();
		foreach ($bywilayah as $p) {
			if ($i == count($bgcolor)) {
				$i = 0;
			}
			$labels[] 	= strtoupper($p->wilayah);
			$pie[] 		= $p->jumlah;
			$bgColor[] 	= $bgcolor[$i];
			$hovColor[] = $hovercolor[$i];
			$i++;
		}

		$output = array(
			'pelanggan' => $pelanggan,
			'total_wilayah' => $this->_total_wilayah()->total_wilayah,
			'wilayah' => $wilayah,
			'pencapaian' => $this->_pencapaian(),
			// Untuk DoughnutChart
			'doughnutchart_data' => array(
				'labels' => $labels,
				'datasets' => array(array(
					'data' => $pie,
					'backgroundColor' => $bgColor,
					'hoverBackgroundColor' => $hovColor,
				))
			),
			'line_chart_data' => $this->_setoran_summary(),
			'chart_des' => array(
				'total_setoran' => $this->_total_setoran_perbulan(),
				'max_setoran' => $this->_max_setoran(),
				'update_on' => date('d.m.Y'),
				'last_month_summary' => $this->_last_month_summary(),
			),
		);

		echo json_encode($output);
	}

	private function _setoran_summary()
	{
		$tahun = date('Y');
		// $bulan = 4;
		$bulan = (int) date('m');
		$res_user = $this->api->get_user();
		foreach ($res_user as $u) {
			$user = ($u->kolektor != null) ? $u->kolektor : 'Unknown';
			for ($bln=1; $bln <= $bulan; $bln++) {
				$ro = $this->api->get_setoran_summary($tahun,$bln,$user);
				ini_set('display_errors', 0); // jika setoran ganjil maka terjadi error. fungsi ini utk mematikannya
				$data[$bln-1] = ($ro->subtotal != NULL) ? $ro->subtotal : 0 ;
			}

			$r = rand(67,190);
			$g = rand(110,190);
			$b = rand(100,190);
			$datasets[] = array(
					'label' => $user,
					'backgroundColor' => "rgba($r,$g,$b,0.5)",
					'borderColor' => "rgba($r,$g,$b,0.7)",
					'pointBackgroundColor' => "rgba($r,$g,$b,1)",
					'pointBorderColor' => '#fff',
					'data' => $data,
			);
		}
		ini_set('display_errors', 0); // jika setoran ganjil maka terjadi error. fungsi ini utk mematikannya

		for ($x=1; $x <= $bulan ; $x++) {
			$labels[] = bulan($x);
		}

		$output = array(
			'labels' => $labels,
			'datasets' => $datasets,
		);

		return $output;
	}

	private function _total_setoran_perbulan()
	{
		$bulan = date('Y-m');
		$bln = (int) date('m');
		$q = $this->api->total_setoran_by($bulan);
		return array('bulan' => bulan($bln), 'total' => 'IDR '.ribuan($q->total));
	}

	private function _max_setoran()
	{
		$q = $this->api->get_max_setoran();
		return array('kolektor' => ucwords($q->kolektor), 'bulan' => bulan((int)substr($q->bulan,5,2)), 'total' => 'IDR '.ribuan($q->max_setoran));
	}

	private function _last_month_summary()
	{
		$d=strtotime("-1 Months"); // Last month
		$bulan = date('Y-m',$d);
		$thn = (int) substr($bulan,0,4);
		$bln = (int) substr($bulan,5,2);
		$q = $this->api->total_setoran_by($bulan);
		$total = ($q->total == null) ? 0 : $q->total ;
		$data = array(
			'bulan' => bulan($bln).' '.$thn,
			'total' => 'IDR '.ribuan($total)
		);
		return $data;
	}

	private function _pencapaian()
	{
		$q = $this->api->get_target();
		$target = $q['target']->target;
		$capai = $q['capai']->capai;

		$rate_success	= ($q['target']->target != null) ? 100 - ((($target - $capai) / $target) * 100 ) : 0;
		$rate_margin	= ($q['target']->target != null) ? ((($target - $capai) / $target ) * 100) : 0;

		$msg = '';
		if ($rate_success >= 90) {
			$msg = "<div class=\"stat-percent font-bold text-navy\">".round($rate_success,2)."% <i class=\"fa fa-bolt\"></i></div>";
		} elseif ($rate_success >= 80 && $rate_success < 90) {
			$msg = "<div class=\"stat-percent font-bold text-success\">".round($rate_success,2)."% <i class=\"fa fa-bolt\"></i></div>";
		} elseif ($rate_success >= 70 && $rate_success < 80) {
			$msg = "<div class=\"stat-percent font-bold text-warning\">".round($rate_success,2)."% <i class=\"fa fa-bolt\"></i></div>";
		} elseif ($rate_success < 70) {
			$msg = "<div class=\"stat-percent font-bold text-danger\">".round($rate_success,2)."% <i class=\"fa fa-bolt\"></i></div>";
		}

		$msg1 = '';
		if ($rate_margin <= 10) {
			$msg1 = "<div class=\"stat-percent font-bold text-navy\">".round($rate_margin,2)."% <i class=\"fa fa-bolt\"></i></div>";
		} elseif ($rate_margin > 10 && $rate_margin <= 20) {
			$msg1 = "<div class=\"stat-percent font-bold text-success\">".round($rate_margin,2)."% <i class=\"fa fa-bolt\"></i></div>";
		} elseif ($rate_margin > 20 && $rate_margin <= 80) {
			$msg1 = "<div class=\"stat-percent font-bold text-warning\">".round($rate_margin,2)."% <i class=\"fa fa-bolt\"></i></div>";
		} elseif ($rate_margin > 80) {
			$msg1 = "<div class=\"stat-percent font-bold text-danger\">".round($rate_margin,2)."% <i class=\"fa fa-bolt\"></i></div>";
		}

    // Update statistik ke database
		$bulan = date('Y-m');
		$cek_stat = $this->api->cek_statistik($bulan);
		$data = array(
			'bulan' => date('Y-m-d'),
			'target' => $target,
			'capaian' => $capai,
			'rate_success' => round($rate_success,2),
			'rate_margin' => round($rate_margin,2)
		);

		$jml = $cek_stat->num_rows();
		if ($jml == 0) {
			$save = $this->api->save_statistik($data);
		} elseif ($jml > 0) {
			$id = $cek_stat->row();
			$update = $this->api->update_statistik(array('id_statistik' => $id->id_statistik), $data);
		}

    // Return ke dashboard
		$ret = array(
			'target' => ribuan($target),
			'tercapai' => ribuan($capai),
			'tercapai_percent' => $msg,
			'margin' => $msg1
		);

		return $ret;
	}


	/*
	|
	|
	|	SCRIPT PERCOBAAN
	|
	|
	*/

	public function dbdua()
	{
		$q = $this->api->dbdua();
		echo json_encode($q);
	}

	public function tesss()
	{
		$gammu_bin 				= FCPATH.'app/third_party/gammu/bin/gammu.exe';
		$gammu_config 			= FCPATH.'app/third_party/gammu/bin/gammurc';
		$gammu_config_section	= '1'; // for default section please set "blank" value --> $gammu_config_section = '';

		$sms = new Gammu($gammu_bin,$gammu_config,$gammu_config_section);

		// /* Identify Device information * /
		// $sms->Identify($response);
		// echo '<pre>';
		// print_r($response);
		// echo '</pre>';
		echo $gammu_bin.'<br>'.$gammu_config;

		// /* Get SMS from Device* /
		$response = $sms->Get();
		echo '<pre>';print_r($response); echo '</pre>';
    //
		// // /* Sending SMS * /
		// $sms->Send('082394824684','Test!',$response);
		// echo '<pre>';
		// print_r($response); echo '</pre>';
    //
		// /* Get Phone -> ME = Phone Memory; SM = Sim Card;  options list => DC|MC|RC|ON|VM|SM|ME|MT|FD|SL * /
		// $response = $sms->phoneBook('SM');
		// echo '<pre>';print_r($response); echo '</pre>';
		// /**/
	}

	public function buat_service_gammu()
	{
		// $path1 = 'C:\xampp\htdocs\posotv.org\app\third_party\bin\gammu-smsd.exe" -S -c "C:\xampp\htdocs\posotv.org\app\third_party\bin\smsdrc" -n "huawei-153" -f 0';
		// $path = "C:\xampp\htdocs\posotv.org\app\third_party\bin\";

		exec(FCPATH.'app/third_party/gammu/bin/gammu-smsd -c smsdrc –s',$return);
	}

	// public function sendsms($api='')
	// {
	// 	$api = ($api != '') ? $api : base64_encode("rahtutaza") ;
	// 	$api_server = "http://localhost/kalkun/scripts/smsAPI";
  //
  //
	// }

	public function arraytes()
	{
		$exclude_numbers = array('MKIOS','TELKOMSEL','88330','88331','88332','88333','88334','88335','88336');
		if (in_array("TELKOMSEL",$exclude_numbers)) {
			echo "OK";
		} else {
			echo "FAILED";
		}
	}

	public function curl_test()
	{
		$defaults = array(
        CURLOPT_URL => "http://localhost/posotv.org/API_SEARCH/cek_tunggakan_sms/kwa001",
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 4
    );

    $ch = curl_init();
    curl_setopt_array($ch, $defaults);
    if( ! $result = curl_exec($ch))
    {
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    print_r($result);
	}






	public function explode()
	{
		$pesan = "<pre>ADUAN#KWA002#123456#KETERANGAN, rusak, dan; lain sebagainya</pre>";
		$str = explode("#",$pesan,7);
		print_r($str);
	}

	public function GUID()
	{
	    if (function_exists('com_create_guid') === true)
	    {
	        return trim(com_create_guid(), '{}');
	    }

	    echo sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	public function apikey()
	{
			$tgl = date('dmYHms');
			$username = 'rahtutaza';
			$email = 'gusti.kpw92@gmail.com';
			$salt = $email.$tgl.$username;
			$hasil = base64_encode(md5($salt));
			echo $hasil."<br>".strlen($hasil);
			echo "<br>";
	}

	public function encrypt()
	{
		$this->load->library('encrypt');
		$msg = 'pesanenkripsiqw271012120412';
		$key = '123enkripsi';
		$en = $this->encrypt->encode($msg,$key);
		$de = $this->encrypt->decode($en,$key);

		echo "<pre>".$en."<br>".$de."</pre>";
	}

	public function generate_key()
	{
		$salt = hash('sha256', time() . mt_rand());
		$new_key = base64_encode(substr($salt, 0, 24));

		echo $new_key."<br>".strlen($new_key)."<br>".base64_decode('MWY2NTllNGYxZjA2Zjg3NzQ0NGYxZTMz');
   }

	public function tes1()
	{
		$data = array('invoice_num' => 'KWA17120298022', 'cust_code' => 'KWA001');
		$hash = base64_encode(json_encode($data));
		echo $hash."<br>";
		echo base64_decode($hash)."<br>";

	}

	public function inarray()
	{
		$input = preg_quote('883','~');
		$data = array('88330','082394824684','88331','88332','88333','88334','88335','88336','88336');
		$exclude = array('8833*','082394824684');

		// for ($i=0; $i < count($data); $i++) {

			// if (in_array(preg_grep('~'$exclude.'~',$data),$exclude)) {
			// 	echo "Founds";
			// }

		// }
		for ($i=0; $i < count($data); $i++) {
			if ($val =preg_grep('~*'.$exclude[$i].'~',$data)) {
				echo "TRUE<br>";
			} else {
				echo "False<br>";
			}
		}

	}

	private function _setoran_summary2()
	{
		// $labels	= array("","Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		$weekly	= $this->api->get_setoran_summary('yearweek');
		$monthly	= $this->api->get_setoran_summary('yearmonth');

		foreach ($weekly as $w) {
			$labels[] = "Week $w->minggu";
			$dataw[]	= (int) $w->subtotal;
		}

		foreach ($monthly as $m) {
			$datam[] = (int) $m->subtotal;;
		}

		$output = array(
			'labels' => $labels,
			'datasets' => array(
				array(
					'label' => 'Weekly',
					'backgroundColor' => 'rgba(26,179,148,0.5)',
					'borderColor' => 'rgba(26,179,148,0.7)',
					'pointBackgroundColor' => 'rgba(26,179,148,1)',
					'pointBorderColor' => '#fff',
					'data' => $dataw,
					// 'data' => [30000,40000,50000,60000,20000],
				),
				// array(
				// 	'label' => 'Monthly',
				// 	'backgroundColor' => 'rgba(220,220,220,0.5)',
				// 	'borderColor' => 'rgba(220,220,220,1)',
				// 	'pointBackgroundColor' => 'rgba(220,220,220,1)',
				// 	'pointBorderColor' => '#fff',
				// 	'data' => $datam,
				// 	// 'data' => [60000,60000,60000,60000,60000],
				// ),
			),
		);

		return $output;
		// print_r($weekly);
	}

}
