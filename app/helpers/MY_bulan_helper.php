<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('bulan'))
{
   /* NAMA BULAN INDONESIA
	 * Return nama bulan dalam bahasa Indonesia
	 * @var integer
	**/ 
	function bulan($int)
	{
		$CI =& get_instance();
		$bulan = array('',
	  		'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);

		return $bulan[$int];
   }
}
