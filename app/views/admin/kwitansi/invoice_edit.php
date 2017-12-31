<?php

class PDF extends FPDF
{
function Potong()
{
  $this->setY(82.5);
  $this->setFont('Arial','',5);
  $this->setFillColor(255,255,255);
    for ($i=0; $i < 215; $i++) {
      $this->cell(1,5,'-',0,0,'C',0);
    }
}

public function Terbilang($satuan) {
  $huruf = array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas' );
  if ($satuan < 12) {
    return ' '.$huruf[$satuan];
  }
  elseif ($satuan < 20) {
    return ' '.$huruf[$satuan-10].'Belas ';
  }
  elseif ($satuan < 100) {
    return ''.$huruf[$satuan/10].' Puluh '.$huruf[$satuan%10];
  }
  elseif ($satuan < 200) {
    return ' Seratus'. $this->Terbilang($satuan-100);
  }
  elseif ($satuan < 1000) {
    return $this->Terbilang($satuan/100).'Ratus '.$this->Terbilang($satuan % 100).' ';
  }
  elseif ($satuan < 2000) {
    return ' Seribu'. $this->Terbilang($satuan-1000);
  }
  elseif ($satuan < 1000000) {
    return $this->Terbilang($satuan/1000).' Ribu'.$this->Terbilang($satuan%1000);
  }
  elseif ($satuan < 1000000000) {
    return $this->Terbilang($satuan/1000000).'Juta '.$this->Terbilang($satuan % 1000000);
  }
  elseif ($satuan <= 1000000000) {
    echo 'Maaf, tidak dapat diproses karena jumlah uang terlalu besar';
  }
}

function Kop($cust,$company,$terms)
{
  $a=0;
  // Perulangan sebanyak jumlah kwitansi
  foreach ($cust as $plgn) {
    $a++;
    // URL gambar
    $qr = $plgn['url_gambar']; //'assets/images/barcode_www.poso.tv.jpg';
    $pattern = 'assets/img/pattern.png';
    $garisPotong = 'assets/img/garis_potong.png';
    if ($a==1) {
      $yg1 = 32;
    	$yg2 = 8;
      $yp1 = 40;
    	$yp2 = 50;
      $gp = 83;
    }
    if ($a==2) {
      $yg1 = 32+82;
    	$yg2 = 8+82;
      $yp1 = 40+82;
    	$yp2 = 50+82;
      $gp=83+83;
    }
    if ($a==3) {
      $yg1 = 32+164;
    	$yg2 = 8+164;
      $yp1 = 40+164;
    	$yp2 = 50+164;
      $gp=83+83+83;
    }
    if ($a==4) {
      $yg1 = 32+246;
    	$yg2 = 8+246;
      $yp1 = 40+246;
    	$yp2 = 50+246;
      $a=0;
    }

    $this->setX(5);  $this->Image($qr,35,$yg1+4,20,20); // Tengah kiri
    $this->setX(5);  $this->Image($qr,190,$yg2+2,20,20); // Pojok kanan atas
    $this->setX(5);  $this->Image($pattern,75,$yp1,130,8);
    $this->setX(5);  $this->Image($pattern,75,$yp2,50,7);
    // Garis potong
    $this->setX(5);  $this->Image($garisPotong,5,$gp,7,0.1); //gp=garis potong
    $this->setX(5);  $this->Image($garisPotong,204,$gp,7,0.1); //gp=garis potong

  // Pembayaran
  $bts = '    02 s/d 15 | '.date('Y');
  $info1 = 'Pembayaran akan mulai tanggal 2 s/d 15 setiap bulannya.';
  $info2 = '* Bawa kwitansi lama untuk pembayaran tunggakan selanjutnya.';
  $info3 = '* Menunggak 2 (dua) bulan akan dilakukan pemutusan sementara ';
  $info4 = '  dan disambung kembali setelah menunasi tunggakan.';
  $info5 = '* Syarat dan ketentuan berlaku.';
  $info6 = '* Terima kasih telah membayar pada waktunya.';
  $termsxxx = "Pembayaran akan mulai tanggal 2 s/d 15 setiap bulannya.
                * Bawa kwitansi lama untuk pembayaran tunggakan selanjutnya.
                * Menunggak 2 (dua) bulan akan dilakukan pemutusan sementara
                  dan disambung kembali setelah menunasi tunggakan.
                * Syarat dan ketentuan berlaku.";
  $GLOBALS['namafile'] = $plgn['namafile'];

  $xkanan = 65;
  $xkanan1 = 105;
  $xkanan2 = 155;
  $xterbilang = 75;
  $xterbilangtab = 85;
  $xkiri = 55;

  $this->setFont('Arial','B',10);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,3,$company->nama_perusahaan,0,0,'R',0);
  $this->setX($xkanan); $this->cell($xkanan,3,$company->nama_perusahaan,0,0,'L',0); // Robekan Bagian Kanan
                        $this->cell($xkanan,3,'KWITANSI IURAN TV BERLANGGANAN',0,0,'L',0);
  $this->Ln();
  $this->setFont('Arial','',8);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,4,$company->slogan,0,0,'R',0);
  $this->setX($xkanan); $this->cell($xkanan,4,$company->slogan,0,0,'L',0); // Robekan Bagian Kanan
  $this->Ln(7);
  $this->setFont('Arial','',8);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,3,'Kode Pelanggan',0,0,'R',0);
  $this->setX($xkanan);  $this->cell(45,3,'Kode Pelanggan',0,0,'L',0); // Robekan Bagian Kanan
  $this->setX($xkanan1-10);  $this->cell(45,3,'Nama Pelanggan',0,0,'L',0); // Robekan Bagian Kanan1
  $this->setX($xkanan2-10);  $this->cell(45,3,'No. Invoice',0,1,'L',0); // Robekan Bagian Kanan2

  $this->setFont('Arial','B',12);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,5,$plgn['kode_pelanggan'],0,0,'R',0);
  $this->setX($xkanan);  $this->cell(45,5,$plgn['kode_pelanggan'],0,0,'L',0); // Robekan Bagian Kanan
  $this->setX($xkanan1-10);  $this->cell(45,5,$plgn['nama_lengkap'],0,0,'L',0); // Robekan Bagian Kanan1
  $this->setX($xkanan2-10);  $this->cell(45,5,$plgn['kode_invoice'],0,0,'L',0); // Robekan Bagian Kanan2
  $this->Ln(4);
  $this->setFont('Arial','',8);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,3.5,'Nama Pelanggan',0,0,'R',0);
  $this->setX($xkanan);  $this->cell(45,3.5,'Wilayah',0,0,'L',0); // Robekan Bagian Kanan
  $this->setX($xkanan1-10);  $this->cell(45,3.5,'Alamat/Wilayah',0,0,'L',0); // Robekan Bagian Kanan1
  $this->setX($xkanan2-10);  $this->cell(45,3.5,'Bulan Penagihan',0,1,'L',0); // Robekan Bagian Kanan2
  $this->setFont('Arial','B',10);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,3,$plgn['nama_lengkap'],0,0,'R',0);
  $this->setX($xkanan);  $this->cell(45,3,$plgn['wilayah'],0,0,'L',0); // Robekan Bagian Kanan
  $this->setFont('Arial','',8);
  $this->setFillColor(255,255,255);
  $this->setX($xkanan1-10);  $this->cell(45,3,$plgn['alamat'],0,0,'L',0); // Robekan Bagian Kanan1
  $this->setFont('Arial','B',10);
  $this->setFillColor(255,255,255);
  $this->setX($xkanan2-10);  $this->cell(45,3,$plgn['bulan_penagihan'],0,1,'L',0); // Robekan Bagian Kanan
  $this->setFont('Arial','',8);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,4,'Alamat/Wilayah',0,0,'R',0);
  $this->setX($xkanan);  $this->cell(45,4,'',0,0,'L',0); // Robekan Bagian Kanan
  $this->setX($xkanan1-10);  $this->cell(45,4,'',0,0,'L',0); // Robekan Bagian Kanan1
  $this->setX($xkanan2-10);  $this->cell(45,4,'',0,1,'L',0); // Robekan Bagian Kanan
  $this->setFont('Arial','B',8);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,2,$plgn['alamat'].'/'.$plgn['wilayah'],0,0,'R',0);
  $this->setX($xkanan);  $this->cell(45,2,'',0,0,'L',0); // Robekan Bagian Kanan
  $this->setX($xkanan1-10);  $this->cell(45,2,'',0,0,'L',0); // Robekan Bagian Kanan1
  $this->setX($xkanan2-10);  $this->cell(45,2,'',0,1,'L',0); // Robekan Bagian Kanan
  $this->Ln(2);
  $this->setFont('Arial','I',9);
  $this->setFillColor(255,255,255);
  $this->setX($xterbilang);  $this->cell(45,4.2,'Jumlah Terbilang',0,1,'L',0); // Robekan Bagian Kanan Terbilang
  $this->setFont('Courier','BI',12);
  $this->setFillColor(255,255,255);
  $this->setX($xterbilangtab);  $this->cell(45,6,$this->Terbilang($plgn['harga']).'Rupiah',0,1,'L',0); // Robekan Bagian Kanan Terbilang
  $this->setFont('Arial','I',9);
  $this->setFillColor(255,255,255);
  $this->setX($xterbilang);  $this->cell(45,4.1,'Jumlah Rp.',0,1,'L',0); // Robekan Bagian Kanan Terbilang
  $this->setFont('Courier','BI',12);
  $this->setFillColor(255,255,255);
  $this->setX($xterbilangtab);  $this->cell(45,4,$plgn['tarif'],0,0,'L',0); // Robekan Bagian Kanan Terbilang
  $this->setFont('Arial','',9);
  $this->setFillColor(255,255,255);
  $this->setX($xterbilangtab+80);  $this->cell(45,4,'Teknisi / Keluhan Pelanggan',0,1,'R',0); // Robekan Bagian Kanan Kontak Teknisi
  $this->Ln(1);
  $this->setFont('Arial','B',9);
  $this->setFillColor(255,255,255);
  $this->setX(5);
  $this->cell($xkiri,3,'No. Invoice : '.$plgn['kode_invoice'],0,0,'R',0);
  $this->cell(150,3,$plgn['kontak_cs'],0,0,'R',0);
  $this->Ln();
  $this->setFont('Arial','B',9);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,5,'Bulan Penagihan : '.$plgn['bulan_penagihan'],0,0,'R',0);
  $this->setFont('Arial','',7);
  $this->setFillColor(255,255,255);
  // $this->setX($xkanan);  $this->cell(45,4,$terms['info1'],0,1,'L',0); // Robekan Bagian Kanan1
  $this->setX($xkanan);  $this->MultiCell(45,4,$termsxx); // Robekan Bagian Kanan1
  // $this->MultiCell(0,5,$txt)
  $this->setFont('Arial','B',9);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,5,'Tarif Iuran : '.$plgn['tarif'],0,0,'R',0);
  $this->setFont('Arial','',7);
  $this->setFillColor(255,255,255);
  $this->setX($xkanan);  $this->cell(45,4,$terms['info2'],0,0,'L',0); // Robekan Bagian Kanan1

  $this->setFont('Arial','',9);
  $this->setFillColor(255,255,255);
  $this->setX($xterbilangtab+80);  $this->cell(45,4,'Kolektor',0,1,'R',0);

  $this->setFont('Arial','B',9);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,5,'Kolektor : '.$plgn['kolektor'],0,0,'R',0);
  $this->setX($xterbilangtab+80);  $this->cell(45,8,$plgn['kolektor'],0,0,'R',0);
  $this->setFont('Arial','',7);
  $this->setFillColor(255,255,255);
  $this->setX($xkanan);  $this->cell(45,2,$terms['info3'],0,1,'L',0); // Robekan Bagian Kanan1
  $this->setFont('Arial','',8);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,9,'',0,0,'R',0);
  $this->setFont('Arial','',7);
  $this->setFillColor(255,255,255);
  $this->setX($xkanan);  $this->cell(45,4,$terms['info4'],0,1,'L',0); // Robekan Bagian Kanan1
  $this->setFont('Arial','B',10);
  $this->setFillColor(255,255,255);
  $this->setX(5);  $this->cell($xkiri,8,'',0,0,'R',0);
  // $this->setX(5);  $this->cell(190,8,$plgn['kolektor'],0,0,'R',0);
  $this->setFont('Arial','',7);
  $this->setFillColor(255,255,255);
  $this->setX($xkanan);  $this->cell(45,2,$terms['info5'],0,0,'L',0); // Robekan Bagian Kanan1

	$this->Ln(14); // atur jarak kwitansi
	if ($a==0) {
		$this->AddPage();
	}
} // end foreach


}

}
$pageSize = array(340,215.9);
$pdf = new PDF('P','mm',$pageSize);
$pdf->setTopMargin(6);
$pdf->SetAutoPageBreak(true,3);
$pdf->AddPage();
$pdf->Kop($cust,$company,$terms);
//$pdf->Potong();
// $pdf->Output('kwitansi.pdf','I');
$path = $GLOBALS['namafile'];
$pdf->Output('F',$path);
