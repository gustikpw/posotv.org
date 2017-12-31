<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Autoreply extends CI_Controller {

	function __construct()
  {
      parent::__construct();
		$this->load->model('gammu/Autoreply_model','areply');
  }

	public function index()
	{
		// echo "Hallo saya Autoreply!";
		$this->autoreply();
	}

/*
*----------------------
* AUTOREPLY
*----------------------
* Format dan Layanan yang tersedia
* Exclude Number = Pengecualian untuk kontak yang tidak ingin direspon secara Autoreply
* $limit_request_per_day = Batas SMS yang dikirim pelanggan per hari
* Layanan :
* 1. TAGIHAN = TAGIHAN <spasi> KODE_PELANGGAN <spasi> PIN
			Contoh : TAGIHAN KWA001 123456
* 2. UBAHNOMOR = UBAHNOMOR <spasi> KODE_PELANGGAN <spasi> NO_BARU <spasi> PIN
			Contoh : UBAHNOMOR KWA001 082394824684 123456
* 3. ADUAN = ADUAN#KODE_PELANGGAN#PIN#KETERANGAN
			Contoh : ADUAN#KWA001#123456#kabel putus di tiang kena truk
*/
	public function autoreply()
	{
		$query = $this->areply->getUnreadMessages();
		foreach ($query as $r) {
			$id = $r->ID;
			$no_tujuan = $r->SenderNumber;
			$pesan = $r->TextDecoded;

      	// jangan kirim otomatis kepada nomor ini
			$exclude_numbers = array('MKIOS','TELKOMSEL','88330','88331','88332','88333','88334','88335','88336');

			if (!in_array($no_tujuan,$exclude_numbers)) {
				// validasi text dari pengirim
				// pecah teks menjadi array berdasarkan <spasi>
				$str = explode(" ",$pesan,5);
				$link = "http://localhost/posotv.org/api_search/";

				/*
				* Format SMS
				* TAGIHAN <spasi> KWA002 <spasi> 123456
				*/

				if (strtoupper($str[0]) == 'TAGIHAN') {
					$param['url'] = $link."cek_tunggakan_sms";
					$param['data'] = array('kode_pelanggan' => strtoupper($str[1]), 'pin' => $str[2]);
					$respon = $this->_curl_request($param)->respon;
				}

				/*
				* Format SMS
				* UBAHNOMOR <spasi> KWA002 <spasi> 082394824684 <spasi> 123456
				*/

				else if (strtoupper($str[0]) == 'UBAHNOMOR') {
					$param['url'] = $link."ubah_nomor_sms";
					$param['data'] = array('kode_pelanggan' => strtoupper($str[1]), 'nomor_baru' => $str[2], 'pin' => $str[3]);
					$respon =  $this->_curl_request($param)->respon;
				}

				/*
				* Format SMS
				* UBAHPIN <spasi> KWA002 <spasi> PIN_LAMA <spasi> PIN_BARU
				*/

				else if (strtoupper($str[0]) == 'UBAHPIN') {
					$param['url'] = $link."ubah_pin_sms";
					$param['data'] = array('kode_pelanggan' => strtoupper($str[1]), 'pin_lama' => $str[2], 'pin_baru' => $str[3]);
					$respon =  $this->_curl_request($param)->respon;
				}

				/*
				* Format SMS
				* ADUAN#KWA002#123456#KETERANGAN ADUAN
				*/

				else {
					// pecah teks menjadi array berdasarkan tanda (#)
					$str = explode("#",$pesan,5);

					if (strtoupper($str[0]) == 'ADUAN') {
						$param['url'] = $link."aduan_sms";
						$param['data'] = array('kode_pelanggan' => strtoupper($str[1]), 'pin' => $str[2], 'aduan' => $str[3]);
						$respon =  $this->_curl_request($param)->respon;
					} else {
						$respon = 'Format sms tidak sesuai! Ketik : TAGIHAN <spasi> KODEPELANGGAN <spasi> PIN Atau UBAHNOMOR <spasi> KODEPELANGGAN <spasi> NOBARU <spasi> PIN kirim ke 082394824684';
					}
				}

				$data = array(
					'DestinationNumber' => $no_tujuan,
					'TextDecoded' => $respon,
					'SenderID' => 'Autoreply',
				);

				// Batasi permintaan pelanggan 5 SMS/hari
				$limit_request_per_day = 6;
				$count_sms = $this->areply->count_limit_by($no_tujuan);

				if ($count_sms->limits >= $limit_request_per_day) {
					// echo "$no_tujuan in Max Limit $count_sms->limits SMS<br>";
					$this->_update_inbox($id);
				} else {
					$insert = $this->areply->sendAutoReply($data);
					if ($insert) {
						$this->_update_inbox($id);
					}
				}

			}

		}
	}

	/*	UPDATE INBOX
		* Setelah balasan diteruskan kepada pelanggan
		* ubah status sms menjadi terbaca
		* 'Processed' => 'true'
		* agar sms yang sudah di proses, tidak diproses lagi.
	*/

	private function _update_inbox($id)
	{
		$data = array(
			'Processed' => 'true',
		);
		$this->areply->update(array('ID' => $id), $data);
	}

	private function _curl_request($param)
	{
		$option = array(
			CURLOPT_URL 			=> $param['url'],
			CURLOPT_HEADER 		=> 0,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_TIMEOUT		=> 5,
			CURLOPT_POST			=> TRUE,            // i am sending post data
			CURLOPT_POSTFIELDS	=> $param['data'],    // this are my post vars
    );

    $ch = curl_init();
    curl_setopt_array($ch, $option);
    if( ! $result = curl_exec($ch))
    {
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    return json_decode($result);
	}


}
