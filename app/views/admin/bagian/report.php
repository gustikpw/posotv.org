<?php

class PDF extends FPDF
{

   function Terbilang($satuan) {
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

   function Kop()
   {
      $this->Image('http://localhost/posotv.org/assets/img/logo_report.png',170,6,40,0);
      $this->setFont('Arial','B',14);
      $this->setFillColor(255,255,255);
      $this->cell(80,6,'PT. POSO MEDIA VISION (POSO TV)',0,1,'L',0);
      $this->setFont('Arial','',12);
      $this->cell(80,5,'Jl. Morarena',0,1,'L',0);
      $this->cell(80,5,'Telp: 0811458084, e-mail: poso.tv@gmail.com',0,1,'L',0);
      $this->Ln(3);
      $this->setFont('Arial','B',14);
      $this->setFillColor(1,9,120);
      $this->SetTextColor(255, 255, 255);
      $this->cell(180,10,'LAPORAN - BAGIAN',0,0,'L',1);
      $this->setFont('Arial','I',14);
      $this->cell(26,10,'(Desember 2017)',0,0,'R',1);

      $this->Ln(20);
   }

   // Colored table
   function FancyTable($header, $data)
   {
       // Colors, line width and bold font
       $this->SetFillColor(1,9,120);
       $this->SetTextColor(255);
       $this->SetDrawColor(70,73,111);
       $this->SetLineWidth(.3);
       $this->setFont('Arial','B',12);
       // $this->SetFont('','B');
       // Header
       $w = array(10, 45, 60);
       for($i=0;$i<count($header);$i++)
           $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
       $this->Ln();
       // Color and font restoration
       $this->SetFillColor(224,235,255);
       $this->SetTextColor(0);
       $this->SetFont('');
       // Data
       $fill = false;
       $no = 0;
       foreach($data as $row => $val)
       {
          $no++;
           $this->Cell($w[0],6,$no,'LR',0,'R',$fill);
           $this->Cell($w[1],6,' '.ucfirst($val->bagian),'LR',0,'L',$fill);
           $this->Cell($w[2],6,' '.ucfirst($val->keterangan),'LR',0,'L',$fill);
           // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
           $this->Ln();
           $fill = !$fill;
       }
       $this->Cell(array_sum($w),0,'','T',0);
       $this->Ln();
       $this->Cell($w[0]+$w[1],6,' Total','LR',0,'R',$fill);
       $this->Cell($w[2],6,$no.' Record','LR',1,'R',$fill);
       $this->Cell(array_sum($w),0,'','T',0);
       // Closing line
   }

}

$header = array('NO','BAGIAN','KETERANGAN');

$pageSize = array(340,215.9);
$pdf = new PDF('P','mm',$pageSize);
$pdf->setMargins(5,6);
$pdf->AddPage();
$pdf->Kop();
$pdf->FancyTable($header, $data);
$pdf->Output('kwitansi.pdf','I');
