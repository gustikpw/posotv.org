# DOKUMENTASI POSO TV APP

## KEBUTUHAN INSTALASI MINIMUM (Untuk Programmer)

  1. XAMPP v3.2.2
    - PHP 5.6.15
    - MySQL 10.1.9-MariaDB
  2. HeidiSQL 9.4.0.5125 (rekomendasi) atau gunakan PHPMyAdmin
  3. Atom (Text Editor)
  4. Google Chrome 62.0.3202.94


### INSTRUKSI INSTALASI (Pastikan aplikasi diatas sudah berjalan, terutama XAMPP)

  1. Import `db_posotv_xxx.sql` pada HeidiSQL
  2. Extract direkori `posotv.org` pada folder `htdocs` server Apache

#### PERUBAHAN / PENAMBAHAN FILE PADA APLIKASI

  1. Perubahan dasar yang ada pada Aplikasi ini `htdocs`
    `posotv.org\app\config\autoload.php`

      - $autoload['libraries'] = array('database','session','fpdf','ci_qr_code');
      - $autoload['helper'] = array('url','file','form');

    `posotv.org\app\config\config.php`
    *******************************_X
      - $config['base_url'] = "http://".$_SERVER['SERVER_NAME']."/posotv.org";
      - $config['index_page'] = '';
      - $config['encryption_key'] = 'jdfhs9fe7bc7cw7r020bc20jjx0d0z239';
    __*******************************

    `posotv.org\app\config\database.php`
    *******************************_X
      'hostname' => 'localhost',
    	'username' => 'root',
    	'password' => '',
    	'database' => 'posotv',
    __*******************************

    2.  Penambahan Helpers `posotv.org\app\helpers`
      - `MY_ribuan_helper.php`
      - `MY_terbilang_helper.php`

      `MY_ribuan_helper` digunakan untuk menambahkan titik pada nominal angka.
        Contoh : `20000` menjadi `20.000`
        # Cara penggunaan
          a. Load helper pada controllers
          *******************************_X
            $this->load->helper('MY_ribuan');
          __*******************************
          b. Panggil helpers didalam fungsi controllers
          *******************************_X
            function konversi_ribuan() {
              echo $this->ribuan(20000);
            }
            // Hasil : `20.000`
          __*******************************

        `MY_terbilang_helper` digunakan untuk merubah Angka menjadi Text Terbilang
          Contoh : `20000` menjadi `Dua Puluh Ribu Rupiah`
          # Cara penggunaan
            a. Load helper pada controllers
            *******************************_X
              $this->load->helper('MY_terbilang');
            __*******************************    

            b. Panggil helpers didalam fungsi controllers
            *******************************_X
              function konversi_terbilang() {
                echo $this->terbilang(20000);
              }
              // Hasil : `Dua Puluh Ribu Rupiah`
            __*******************************

    3.  Penambahan Libraries `posotv.org\app\libraries`
      Library `fpdf` untuk membuat laporan dalam bentuk .pdf
      - `fpdf`
      Library `qrcode` untuk membuat gambar dalam kode matrix QRCode
      - `Ci_qr_code.php`

    4. Penambahan Third_party `posotv.org\app\third_party`
      - `qrcode`

##### DOKUMENTASI

  <!-- 1.  Struktur Project
      - Dashboard
       -->

  2. QRCode `Ci_qr_code` untuk membuat No. Invoice Kwitansi `posotv.org\app\controllers\Kwitansi.php`
    - Pada dasarnya penomoran No. Invoice ini meliputi
      Contoh :  Asumsikan kita memiliki Kode Invoice `KWA1712XXXXXX`, Jika dipisahkan menjadi `KWA-17-12-XXXXXX`. Kode ini dibentuk berdasarkan
      `KWA`     = Kode Wilayah Pelanggan berdomisili
      `17`      = Tahun dibuatnya Invoice
      `12`      = Bulan dibuatnya Invoice
      `XXXXXX`  = Angka random `0 - 999999`

    - Penjelasan Fungsi
      a. _invoiceCode($wilayah,$bulanPenagihan)
        __ Bertugas untuk membuat No. Invoice berdasarkan `wilayah` dan `tahun-bulan` penagihan. Contoh : `KWA1712XXXXXX`
      b. _generateQr($invoice)
        __ Bertugas meng-Generate No. Invoice yang dibuat `_invoiceCode()` menjadi QRCode dan menyimpannya pada direktori server `posotv.org\assets\tempQr\img\...`
        Tips : Selalu bersihkan file .png pada folder `posotv.org\assets\tempQr\img\` agar tidak membebani server.
