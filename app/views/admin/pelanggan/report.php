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

   function ribuan($rp) // untuk menambahkan titik pada angka ribuan ex. 30.000
  {
		$CI =& get_instance();
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

   function Kop($info,$other,$orientasi)
   {
      /*
       * Setting Landscape & portrait Canvas
       */
      if ($orientasi == 'P') {
         $x1 = 170; // Logo
         $x2 = 180; // BG Laporan
      } else {
         $x1 = 290; // Logo
         $x2 = 300; // BG Laporan
      }

      /*
       * Company Info
      **/

      $nama_pt = $info->nama_perusahaan."( $info->alias )";
      $slogan = $info->slogan;
      $alamat = "Alamat : $info->alamat, Kode Pos : $info->kodepos";
      $telp = "Telepon : $info->telp, e-mail : $info->email";

      $this->Image('http://localhost/posotv.org/assets/img/logo_report.png',$x1,6,40,0);
      $this->setFont('Arial','B',14);
      $this->setFillColor(255,255,255);
      $this->cell(80,6,$nama_pt,0,1,'L',0);
      $this->setFont('Arial','',12);
      $this->cell(80,5,$alamat,0,1,'L',0);
      $this->cell(80,5,$telp,0,1,'L',0);
      $this->Ln(3);
      $this->setFont('Arial','B',14);
      $this->setFillColor(1,9,120);
      $this->SetTextColor(255, 255, 255);
      $this->cell($x2,10,"LAPORAN - ".$other['title'],0,0,'L',1);
      $this->setFont('Arial','I',14);
      $this->cell(26,10,$other['bulan'].' ',0,0,'R',1);

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
       $this->setFont('Arial','B',10);
       // $this->SetFont('','B');
       // Header
       $w = array(10, 22, 70, 30, 20, 10, 70, 35, 30);
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
       $pageNext = false;
       $no2 = 0;
       foreach($data as $row => $val)
       {
          $no++;
          $no2++;
           $this->Cell($w[0],6,$no,'LR',0,'R',$fill);
           $this->Cell($w[1],6,' '.ucfirst($val->kode_pelanggan),'LR',0,'L',$fill);
           $this->Cell($w[2],6,' '.ucfirst($val->nama_lengkap),'LR',0,'L',$fill);
           $this->Cell($w[3],6,' '.ucfirst($val->wilayah),'LR',0,'L',$fill);
           $this->Cell($w[4],6,' Rp '.$this->ribuan($val->tarif),'LR',0,'R',$fill);
            if ($val->status == 'Aktif'):
               $sts = 'A';
            elseif ($val->status == 'Putus Sementara'):
               $sts = 'PS';
            else:
               $sts = 'X';
            endif;
           $this->Cell($w[5],6,' '.$sts,'LR',0,'L',$fill);
           $this->Cell($w[6],6,' '.ucfirst($val->alamat),'LR',0,'L',$fill);
           $this->Cell($w[7],6,' '.ucfirst($val->telp),'LR',0,'L',$fill);
           $this->Cell($w[8],6,' '.ucfirst($val->tgl_pasang),'LR',0,'L',$fill);
           // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
           $this->Ln();
           $fill = !$fill;
           /*
            * $no = banyak data per halaman sebelum pindah ke halaman berikutnya
            *
            */
            if ($no2 == 23 || ($no2 > 30 && ($no2 % 30 == 0))) {
               $pageNext = true;
               $no2 = 30;
            }

            if ($pageNext == true)
            {
              $this->Cell(array_sum($w),0,'','T',0);
              $this->AddPage();
              /*
               * Add Header & Set Style
               */
              $this->SetFillColor(1,9,120);
              $this->SetTextColor(255);
              $this->SetDrawColor(70,73,111);
              $this->SetLineWidth(.3);
              $this->setFont('Arial','B',10);
              for($i=0;$i<count($header);$i++){
                 $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
              }
              /*
               * Set Style to Normal
               */
              $this->SetFillColor(224,235,255);
              $this->SetTextColor(0);
              $this->SetFont('');
              $this->Ln(7);
              $pageNext = false;
           }

       }
       $this->Cell(array_sum($w),0,'','T',0);
       $this->Ln();
       $this->Cell((array_sum($w)-$w[8]),6,' Total ','LR',0,'R',$fill);
       $this->Cell($w[8],6,$no.' Record ','LR',1,'R',$fill);
       $this->Cell(array_sum($w),0,'','T',0);
       // Closing line
   }

}

$header = array('NO','KODE','NAMA LENGKAP','WILAYAH','TARIF','STS','ALAMAT','TELEPON','TGL PASANG');

$pageSize = array(340,215.9);
$pdf = new PDF('L','mm',$pageSize);
$pdf->setMargins(6,6);
$pdf->AddPage();
$pdf->Kop($info,$other,$orientasi='L');
$pdf->FancyTable($header, $data);
$pdf->Output('kwitansi.pdf','I');
