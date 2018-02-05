<?php

class PDF extends FPDF
{

function ribuan($rp) // untuk menambahkan titik pada angka ribuan ex. 30.000
{
  $lenght = strlen($rp);
  $ribu =  substr($rp,-3);
  if ($lenght==4) {
    $puluh =  substr($rp,0,1);
    return $puluh.'.'.$ribu;
  } elseif ($lenght==5) {
    $puluh =  substr($rp,0,2);
    return $puluh.'.'.$ribu;
  } elseif ($lenght==6) {
    $puluh =  substr($rp,0,3);
    return $puluh.'.'.$ribu;
  } elseif ($lenght==7) {
    $satuan =  substr($rp,0,1);
    $puluh =  substr($rp,1,3);
    return $satuan.'.'.$puluh.'.'.$ribu;
  } elseif ($lenght==8) {
    $satuan =  substr($rp,0,2);
    $puluh =  substr($rp,2,3);
    return $satuan.'.'.$puluh.'.'.$ribu;
  } elseif ($lenght==9) {
    $satuan =  substr($rp,0,3);
    $puluh =  substr($rp,3,3);
    return $satuan.'.'.$puluh.'.'.$ribu;
  } else {
    return $rp;
  }
}

function tab($mm = false)
{
  $val = ($mm == false) ? 8 : $mm;
  $this->Cell($val);
}

function bold($val = false)
{
  $val = ($val == false) ? '' : $val;
  $this->SetFont('Times',$val,12);
}

function FancyTable($data)
{
  $res = $data['data'];
    // Colors, line width and bold font
    $this->SetFillColor(1,9,120);
    $this->SetTextColor(255);
    $this->SetDrawColor(70,73,111);
    $this->SetLineWidth(.3);
    $this->setFont('Arial','B',10);
    // $this->SetFont('','B');
    // Header
    $header = array('No','Kode Invoice','Bulan Penagihan','         Subtotal');
    $w = array(8, 45, 60, 45);
    $this->Cell(array_sum($w),6,'DETAIL TUNGGAKAN',0,1,'C',true);
    $this->SetTextColor(0);
    for($i=0;$i<count($header);$i++)
      $this->Cell($w[$i],6,$header[$i],0,0,'L',false);
    $this->Ln();
    $this->Cell(array_sum($w),0,'','T',1);
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    $no = $total = 0;
    foreach($res as $row)
    {
      $no++;
      $this->Cell($w[0],6,$no,'',0,'R',$fill);
      $this->Cell($w[1],6,' '.ucfirst($row['kode_invoice']),'',0,'L',$fill);
      $this->Cell($w[2],6,' '.ucfirst($row['bulan_penagihan']),'',0,'L',$fill);
      $this->Cell($w[3],6,' Rp '.$this->ribuan($row['tarif']),'',0,'R',$fill);
      $this->Ln();
      // $fill = !$fill;
      $total += $row['tarif'];
    }
    $this->Cell(array_sum($w),0,'','T',0);
    $this->Ln();
    $this->Cell(($w[0]+$w[1]),6,' Kolektor : M Tasya','',0,'L',true);
    $this->SetFont('Arial','B',11);
    $this->Cell(($w[2]),6,' Total ','',0,'R',true);
    $this->Cell($w[3],6,'Rp '.$this->ribuan($total),'',1,'R',true);
    $this->Cell(array_sum($w),0,'','T',0);
    $this->Ln();
    $this->Cell(array_sum($w),6,' Pemutusan dilakukan pada tanggal : '.$data['tgl_pemutusan'],0,0,'L',true);
    // Closing line
}

function Header()
{
  $posotv = $GLOBALS['posotv'];
  $this->Image('http://localhost/posotv.org/assets/img/logo_report.png',25.4,18,40,0);
  $this->SetFont('Arial','B',18);
  $this->tab(40); $this->Cell(100,7,$posotv->nama_perusahaan,0,1,'C');
  $this->SetFont('Arial','BI',12);
  $this->tab(40); $this->Cell(100,6,$posotv->slogan,0,1,'C');
  $this->SetFont('Arial','',9);
  $this->tab(40); $this->MultiCell(100,4,'Alamat : '.$posotv->alamat.', Email : '.$posotv->email.', Telepon : '.$posotv->telp.', Kode Pos : '.$posotv->kodepos,0,'C',0);
  $this->Line(10,38,200,38);
  $this->Ln(10);
}

function body($data)
{
  $nomor_srt = $data['nomor'];
  $tgl_srt = $data['tgl_surat'];
  $tgl_putus = $data['tgl_pemutusan'];
  // $perihal = $data['perihal'];
  $profil = $data['profil'];
  $terms = $data['terms'];

  $this->Cell(30,6,'Nomor ',0,0,'L');   $this->bold('B');  $this->Cell(80,6,': '.$nomor_srt,0,1,'L');
  $this->bold();
  $this->Cell(30,6,'Lampiran',0,0,'L'); $this->bold('B');  $this->Cell(80,6,': --',0,1,'L');
  $this->bold();
  $this->Cell(30,6,'Perihal',0,0);      $this->bold('B');  $this->Cell(80,6,': '.$terms['perihal'],0,1,'L');
  $this->Ln(5);

  $this->bold();
  $this->Cell(30,6,'Kepada Yth,',0,1,'L');
  $this->tab();  $this->Cell(30,5,'Kode Pelanggan',0,0,'L');  $this->bold('B'); $this->Cell(80,5,': '.$profil->kode_pelanggan,0,1,'L');
  $this->bold();
  $this->tab();  $this->Cell(30,5,'Nama Lengkap',0,0,'L');    $this->bold('B'); $this->Cell(80,5,': '.$profil->nama_lengkap,0,1,'L');
  $this->bold();
  $this->tab();  $this->Cell(30,5,'Alamat',0,0,'L');          $this->bold(); $this->Cell(80,5,': '.$profil->wilayah.' '.$profil->alamat,0,1,'L');
  $this->Ln(5);

  $this->bold();
  $this->MultiCell(160,5,'   '.$terms['pembuka'],0,'J',0);
  $this->Ln(3);

  $this->FancyTable($data);
  $this->Ln(8);

  $this->bold();
  // $this->tab();
  $this->Cell(30,5,'Keterangan :',0,1,'L');
  // $this->MultiCell(160,4,$terms['ket1'].' '.$tgl_putus"\n".$terms['ket2']."\n".$terms['ket3']."\n".$terms['ket4']."\n",0,'J',0);
  $this->MultiCell(160,5,$terms['ket1']."\n",0,'J',0);

  $this->Ln(5);
  $this->MultiCell(160,5,'   '.$terms['penutup'],0,'J',0);

  $this->Ln(10);
  $this->tab(100); $this->Cell(30,5,$tgl_srt,0,1,'C');
  $this->Ln(15);
  $this->SetFont('Times','BU',12);
  $this->tab(100); $this->Cell(30,5,$terms['pimpinan'],0,1,'C');
  $this->bold();
  $this->tab(100); $this->Cell(30,5,$terms['jabatan'],0,1,'C');

  // $this->MultiCell(80,4,"Kawua, 19 Desember  2017\n\n\n\n\nI Gusti Ngurah Abs,SH\nDirektur Utama",0,'C',0);



}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$GLOBALS['posotv'] = $data['posotv'];

// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->setMargins(25.4,15,25.4);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetDisplayMode('fullwidth','default');
$pdf->SetFont('Times','',12);
$pdf->body($data);
$pdf->Output();
?>
