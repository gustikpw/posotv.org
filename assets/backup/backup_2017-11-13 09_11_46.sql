#
# TABLE STRUCTURE FOR: profil_perusahaan
#

DROP TABLE IF EXISTS `profil_perusahaan`;

CREATE TABLE `profil_perusahaan` (
  `id_profil` int(1) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `slogan` tinytext NOT NULL,
  `alamat` tinytext NOT NULL,
  `email` varchar(50) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `kodepos` varchar(50) NOT NULL,
  `logo` tinytext NOT NULL COMMENT 'link logo perusahaan',
  `facebook` tinytext NOT NULL,
  `youtube` tinytext NOT NULL,
  `sosmed` tinytext NOT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `profil_perusahaan` (`id_profil`, `nama_perusahaan`, `alias`, `slogan`, `alamat`, `email`, `telp`, `kodepos`, `logo`, `facebook`, `youtube`, `sosmed`) VALUES ('1', 'PT. POSO MEDIA VISION', 'POSO TV', 'Lembaga Penyiaran Berlangganan', 'Jl. Morarena, Kawua - Kabupaten Poso', 'poso.tv@gmail.com', '0811458084', '94111', '', 'https://www.facebook.com/POSO-TV-1364079900279340/', 'https://www.youtube.com/channel/UCYbB5lqd_m07oAA-O51uyLw', '');


#
# TABLE STRUCTURE FOR: settings
#

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `option_id` int(3) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(50) DEFAULT NULL,
  `option_value` text,
  `autoload` enum('yes','no') DEFAULT 'no',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='semua pengaturan aplikasi letaknya disini';

INSERT INTO `settings` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES ('1', 'invoice_key', '@sandiinvoice#', 'yes');
INSERT INTO `settings` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES ('2', 'customer_service', '081354338084', 'yes');
INSERT INTO `settings` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES ('3', 'invoice_terms', 'a:7:{s:5:\"batas\";s:20:\"    02 s/d 15 | 2017\";s:5:\"info1\";s:55:\"Pembayaran akan mulai tanggal 2 s/d 15 setiap bulannya.\";s:5:\"info2\";s:60:\"* Bawa kwitansi lama untuk pembayaran tunggakan selanjutnya.\";s:5:\"info3\";s:60:\"* Menunggak 2 (dua) bulan akan dilakukan pemutusan sementara\";s:5:\"info4\";s:51:\"  dan disambung kembali setelah menunasi tunggakan.\";s:5:\"info5\";s:31:\"* Syarat dan ketentuan berlaku.\";s:5:\"info6\";s:44:\"* Terima kasih telah membayar pada waktunya.\";}', 'yes');
INSERT INTO `settings` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES ('4', 'login_info', 'Informasi pada halaman login', 'yes');
INSERT INTO `settings` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES ('5', '-', '-', 'no');


#
# TABLE STRUCTURE FOR: bagian
#

DROP TABLE IF EXISTS `bagian`;

CREATE TABLE `bagian` (
  `id_bagian` int(2) NOT NULL AUTO_INCREMENT,
  `bagian` varchar(50) DEFAULT NULL,
  `keterangan` tinytext,
  PRIMARY KEY (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COMMENT='Bagian/Bidang Kerja dalam suatu perusahaan';

INSERT INTO `bagian` (`id_bagian`, `bagian`, `keterangan`) VALUES ('1', 'CEO', 'Founder');
INSERT INTO `bagian` (`id_bagian`, `bagian`, `keterangan`) VALUES ('2', 'Keuangan', 'Manajemen Keuangan');
INSERT INTO `bagian` (`id_bagian`, `bagian`, `keterangan`) VALUES ('5', 'Pelayanan', 'Bagian Pelayanan');
INSERT INTO `bagian` (`id_bagian`, `bagian`, `keterangan`) VALUES ('6', 'Penagihan', 'Penagihan');
INSERT INTO `bagian` (`id_bagian`, `bagian`, `keterangan`) VALUES ('8', 'ksdjhfsdj', 'jhsdlfhsdl');
INSERT INTO `bagian` (`id_bagian`, `bagian`, `keterangan`) VALUES ('9', 'sdvsdv', 'vsdjvsljvv');
INSERT INTO `bagian` (`id_bagian`, `bagian`, `keterangan`) VALUES ('10', 'sdhvlsdv', 'kfvsdvsdv');
INSERT INTO `bagian` (`id_bagian`, `bagian`, `keterangan`) VALUES ('11', 'sdvsl', 'lhdlsvhdslv');
INSERT INTO `bagian` (`id_bagian`, `bagian`, `keterangan`) VALUES ('20', 'khgh', 'mn');


#
# TABLE STRUCTURE FOR: jabatan
#

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(2) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(50) DEFAULT NULL,
  `keterangan` tinytext,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Jabatan yang dipegang oleh Karyawan';

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `keterangan`) VALUES ('1', 'Direktur Utama', 'Dirut');
INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `keterangan`) VALUES ('2', 'Bendahara', 'Bendahara');
INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `keterangan`) VALUES ('3', 'Kepala Teknisi', NULL);
INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `keterangan`) VALUES ('4', 'Staf Teknisi', NULL);
INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `keterangan`) VALUES ('5', 'Kolektor', NULL);


#
# TABLE STRUCTURE FOR: jenis_gangguan
#

DROP TABLE IF EXISTS `jenis_gangguan`;

CREATE TABLE `jenis_gangguan` (
  `id_jenis_gangguan` int(2) NOT NULL AUTO_INCREMENT,
  `jenis_gangguan` varchar(50) DEFAULT NULL,
  `keterangan` tinytext,
  PRIMARY KEY (`id_jenis_gangguan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Jenis Gangguan menginduk ke Pengaduan';

INSERT INTO `jenis_gangguan` (`id_jenis_gangguan`, `jenis_gangguan`, `keterangan`) VALUES ('1', 'Kabel Putus', NULL);
INSERT INTO `jenis_gangguan` (`id_jenis_gangguan`, `jenis_gangguan`, `keterangan`) VALUES ('2', 'Gambar Kabur', NULL);
INSERT INTO `jenis_gangguan` (`id_jenis_gangguan`, `jenis_gangguan`, `keterangan`) VALUES ('3', 'Gambar Bergaris', NULL);
INSERT INTO `jenis_gangguan` (`id_jenis_gangguan`, `jenis_gangguan`, `keterangan`) VALUES ('4', 'Pindah TV', NULL);


#
# TABLE STRUCTURE FOR: tarif
#

DROP TABLE IF EXISTS `tarif`;

CREATE TABLE `tarif` (
  `id_tarif` int(2) NOT NULL AUTO_INCREMENT,
  `kode_tarif` varchar(50) DEFAULT NULL,
  `jml_tv` int(11) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Menginduk Ke tabel Pelanggan';

INSERT INTO `tarif` (`id_tarif`, `kode_tarif`, `jml_tv`, `tarif`, `keterangan`) VALUES ('1', 'REG', '1', '30000', 'Reguler');
INSERT INTO `tarif` (`id_tarif`, `kode_tarif`, `jml_tv`, `tarif`, `keterangan`) VALUES ('2', 'PAR1', '2', '35000', 'Max 2 TV/Pelanggan');
INSERT INTO `tarif` (`id_tarif`, `kode_tarif`, `jml_tv`, `tarif`, `keterangan`) VALUES ('3', 'PAR2', '3', '40000', 'Max 3 TV/Pelanggan');


#
# TABLE STRUCTURE FOR: status
#

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id_status` int(2) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT NULL,
  `keterangan` tinytext,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Status Pelanggan {''aktif'',''putus_sementara'',''putus''}\r\nMenginduk ke tabel Pelanggan';

INSERT INTO `status` (`id_status`, `status`, `keterangan`) VALUES ('1', 'Aktif', 'Pelanggan Aktif');
INSERT INTO `status` (`id_status`, `status`, `keterangan`) VALUES ('2', 'Putus Sementara', 'Pelanggan Menunggak <3 Bulan');
INSERT INTO `status` (`id_status`, `status`, `keterangan`) VALUES ('3', 'Putus Permanen', 'Menunggak >3 Bulan');


#
# TABLE STRUCTURE FOR: wilayah
#

DROP TABLE IF EXISTS `wilayah`;

CREATE TABLE `wilayah` (
  `id_wilayah` int(3) NOT NULL AUTO_INCREMENT,
  `kode_wilayah` varchar(3) NOT NULL,
  `wilayah` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_wilayah`),
  UNIQUE KEY `kode_wilayah` (`kode_wilayah`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1 COMMENT='Wilayah Domisili Pelanggan';

INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('40', 'KAP', 'Kapling', 'Bagian Kapling');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('41', 'KM9', 'KM9', 'Bagian Kel. Tagolu');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('42', 'KOM', 'Kompi', 'Bagian Kompi Kawua');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('43', 'KWA', 'Kawua A', 'Bagian Kawua');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('44', 'KWB', 'Kawua B', 'Bagian Kawua');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('45', 'KWC', 'Kawua C', 'Bagian Kawua');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('46', 'KWD', 'Kawua D', 'Bagian Kawua');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('47', 'KWE', 'Kawua E', 'Bagian Kawua');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('48', 'KWF', 'Kawua F', 'Bagian Kawua');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('49', 'KWG', 'Kawua G', 'Bagian Kawua');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('50', 'KWH', 'Kawua H', 'Bagian Kawua');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('51', 'LEM', 'Lembomawo', 'Kel. Lembomawo');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('52', 'MAL', 'Maliwuko', 'Bagian Kel. Maliwuko');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('53', 'MOR', 'Morarena', 'Bagian Kawua Jl. Morarena');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('54', 'RAN', 'Ranononcu', 'Bagian Kel. Ranononcu');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('55', 'SAY', 'Sayo', 'Bagian Kel. Sayo');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('56', 'TAG', 'Tagolu', 'Bagian Kel. Tagolu');
INSERT INTO `wilayah` (`id_wilayah`, `kode_wilayah`, `wilayah`, `keterangan`) VALUES ('57', 'TAM', 'Tambaro', 'Bagian Desa Tambaro');


#
# TABLE STRUCTURE FOR: karyawan
#

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` int(2) NOT NULL AUTO_INCREMENT,
  `kode_karyawan` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `bagian` int(2) DEFAULT NULL,
  `jabatan` int(2) DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `tgl_masuk` date DEFAULT NULL,
  `tgl_berakhir` date DEFAULT NULL,
  `no_ktp` varchar(50) DEFAULT NULL,
  `alamat` tinytext,
  `telp` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`),
  KEY `FK_karyawan_jabatan` (`jabatan`),
  KEY `FK_karyawan_bagian` (`bagian`),
  CONSTRAINT `FK_karyawan_bagian` FOREIGN KEY (`bagian`) REFERENCES `bagian` (`id_bagian`),
  CONSTRAINT `FK_karyawan_jabatan` FOREIGN KEY (`jabatan`) REFERENCES `jabatan` (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Data karyawan';

INSERT INTO `karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`) VALUES ('1', 'PTV001', 'I Gusti Ngurah ABS', '1', '1', 'Aktif', '2017-10-19', '2050-10-19', '72710312345670001', 'Jl. Morarena Kel Kawua - Poso', '0811458084');
INSERT INTO `karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`) VALUES ('2', 'PTV002', 'Novy Ratosigi', '2', '2', 'Aktif', '2017-10-09', '2017-10-02', '727103', 'Jl. jhfksjdfk', '09384238');
INSERT INTO `karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`) VALUES ('3', 'PTV003', 'Adris Koa\'a', '5', '3', 'Aktif', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`) VALUES ('4', 'PTV004', 'Elroy', '5', '4', 'Aktif', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`) VALUES ('5', 'PTV005', 'M Tasya', '2', '5', 'Aktif', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`) VALUES ('6', 'PTV006', 'M Mendi', '2', '5', 'Aktif', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`) VALUES ('7', 'PTV007', 'Koperasi KOMPI 714', '2', '5', 'Aktif', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`) VALUES ('8', 'PTV008', 'Papa Adhy', '2', '5', 'Aktif', '2017-10-29', NULL, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: kolektor
#

DROP TABLE IF EXISTS `kolektor`;

CREATE TABLE `kolektor` (
  `id_kolektor` int(4) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(2) DEFAULT NULL,
  `wilayah` text COMMENT 'multiselect',
  `keterangan` text,
  PRIMARY KEY (`id_kolektor`),
  KEY `FK_kolektor_karyawan` (`id_karyawan`),
  CONSTRAINT `FK_kolektor_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Setiap kolektor mempunyai wilayah penagihan masing masing';

INSERT INTO `kolektor` (`id_kolektor`, `id_karyawan`, `wilayah`, `keterangan`) VALUES ('1', '5', '[\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"54\"]', 'Kawua');
INSERT INTO `kolektor` (`id_kolektor`, `id_karyawan`, `wilayah`, `keterangan`) VALUES ('2', '6', '[\"51\",\"52\",\"53\"]', 'Ranononcu, Lembomawo');
INSERT INTO `kolektor` (`id_kolektor`, `id_karyawan`, `wilayah`, `keterangan`) VALUES ('3', '7', '[\"42\"]', 'Kompi 714');
INSERT INTO `kolektor` (`id_kolektor`, `id_karyawan`, `wilayah`, `keterangan`) VALUES ('4', '8', '[\"57\"]', 'Tambaro');


#
# TABLE STRUCTURE FOR: pelanggan
#

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(6) NOT NULL AUTO_INCREMENT,
  `kode_pelanggan` varchar(6) DEFAULT NULL,
  `no_ktp` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `wilayah` int(3) DEFAULT NULL,
  `alamat` tinytext,
  `tgl_pasang` date DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `tarif` int(2) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `foto` tinytext COMMENT 'dalam bentuk link',
  PRIMARY KEY (`id_pelanggan`),
  KEY `FK_pelanggan_tarif` (`tarif`),
  KEY `FK_pelanggan_status` (`status`),
  KEY `FK_pelanggan_wilayah` (`wilayah`),
  CONSTRAINT `FK_pelanggan_status` FOREIGN KEY (`status`) REFERENCES `status` (`id_status`),
  CONSTRAINT `FK_pelanggan_tarif` FOREIGN KEY (`tarif`) REFERENCES `tarif` (`id_tarif`),
  CONSTRAINT `FK_pelanggan_wilayah` FOREIGN KEY (`wilayah`) REFERENCES `wilayah` (`id_wilayah`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('1', 'KWA001', '72717', 'Gusti Ketut P. Wijaya', '43', 'Jl. Pengkol', '2017-10-23', '087636', '1', '1', NULL);
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('2', 'KWA002', '72717', 'Fardiansyah', '43', 'Jl. Pengkol', '2017-10-23', '087636', '3', '1', NULL);
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('3', 'KWA003', '72717', 'Khairil Anwar', '43', 'Jl. Pengkol', '2017-10-23', '087636', '2', '1', NULL);
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('4', 'MOR001', '17238120', 'Praras', '53', 'Jl. Morarena', '2017-10-10', '087373', '2', '1', '');
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('5', 'KWA004', '72717', 'Bayu Prasetyo', '43', 'Jl. Pengkol', '2017-10-23', '087636', '1', '1', NULL);
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('6', 'KWA005', '72717', 'Aswan', '43', 'Jl. Pengkol', '2017-10-23', '087636', '1', '1', NULL);
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('7', 'KWA006', '72717', 'Ghina Suryani', '43', 'Jl. Pengkol', '2017-10-23', '087636', '1', '1', NULL);
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('8', 'KWA007', '72717', 'Christiana Indrayani', '43', 'Jl. Pengkol', '2017-10-23', '087636', '1', '1', NULL);
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('9', 'KWA008', '72717', 'Kiki Ferginita', '43', 'Jl. Pengkol', '2017-10-23', '087636', '1', '1', NULL);
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('10', 'KWA009', '72717', 'Lily Septiani', '43', 'Jl. Pengkol', '2017-10-23', '087636', '1', '1', NULL);
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('14', 'KWB002', '72710372', 'Fatmala Rahman', '44', 'Jl. xxxxxx xx xxxx', '2017-10-12', '082394824684', '1', '1', '');
INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `tarif`, `status`, `foto`) VALUES ('15', 'RAN001', '727103127462376487', 'Chintya Kurniawati', '54', 'Jl. Kancil', '2017-10-30', '081343955120', '1', '1', '');


#
# TABLE STRUCTURE FOR: pengaduan
#

DROP TABLE IF EXISTS `pengaduan`;

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(6) NOT NULL AUTO_INCREMENT,
  `kode_pelanggan` int(6) DEFAULT NULL,
  `tgl_lapor` date DEFAULT NULL,
  `tgl_gangguan` date DEFAULT NULL,
  `prioritas` enum('Low','Medium','High','Danger') DEFAULT NULL,
  `jenis_gangguan` int(2) DEFAULT NULL,
  `keterangan` tinytext,
  `tgl_perbaikan` date DEFAULT NULL COMMENT 'diisi oleh teknisi',
  `teknisi` varchar(50) DEFAULT NULL COMMENT 'diisi oleh teknisi',
  `sebab` tinytext COMMENT 'diisi oleh teknisi',
  `tindakan` tinytext COMMENT 'diisi oleh teknisi',
  `status_aduan` enum('Menunggu','Selesai','Tunda','Gagal') DEFAULT 'Menunggu' COMMENT 'diisi oleh teknisi',
  PRIMARY KEY (`id_pengaduan`),
  KEY `FK_pengaduan_jenis_gangguan` (`jenis_gangguan`),
  KEY `FK_pengaduan_pelanggan` (`kode_pelanggan`),
  CONSTRAINT `FK_pengaduan_jenis_gangguan` FOREIGN KEY (`jenis_gangguan`) REFERENCES `jenis_gangguan` (`id_jenis_gangguan`),
  CONSTRAINT `FK_pengaduan_pelanggan` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COMMENT='Pengaduan pelanggan\r\n-ketika kode pelanggan dipilih akan muncul tabel 3 history pembayaran terakhir pelanggan tersebut\r\n-tingkat penanganan aduan berdasarkan prioritas gangguan';

INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('8', '3', '2017-10-25', '2017-10-25', 'Medium', '3', 'sgsd sdhglsd glds gsdgsdgdglsdglsd', '2017-10-11', '[\"1\",\"2\"]', 'asfafas', 'fsdgsdds', 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('9', '1', '2017-10-26', '2017-10-26', 'High', '1', 'Tersambar Truk', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('10', '2', '2017-11-12', '2017-11-12', 'Medium', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('11', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('12', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('13', '3', '2017-10-25', '2017-10-25', 'Medium', '3', 'sgsd sdhglsd glds gsdgsdgdglsdglsd', '2017-10-11', '[\"1\",\"2\"]', 'asfafas', 'fsdgsdds', 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('14', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('15', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('16', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('17', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('18', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('19', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('20', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('21', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('22', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('23', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('24', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('25', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('26', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('27', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `pengaduan` (`id_pengaduan`, `kode_pelanggan`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('28', '4', '2017-11-12', '2017-11-12', 'High', '2', '-', NULL, NULL, NULL, NULL, 'Menunggu');


#
# TABLE STRUCTURE FOR: tagihan
#

DROP TABLE IF EXISTS `tagihan`;

CREATE TABLE `tagihan` (
  `id_trx` int(11) NOT NULL AUTO_INCREMENT,
  `kode_invoice` varchar(15) DEFAULT NULL,
  `kode_pelanggan` varchar(10) DEFAULT NULL,
  `bulan_penagihan` date DEFAULT NULL,
  `status` enum('Lunas','Belum Bayar') DEFAULT 'Belum Bayar',
  `hash` varchar(50) DEFAULT NULL COMMENT 'hasil md5 dari kode_invoice+kunci',
  `tgl_bayar` date DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL COMMENT 'user session yang melakukan pekerjaan ini',
  PRIMARY KEY (`id_trx`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='- Kwitansi -\r\nSetelah invoice dicetak, data dati temp_invoice akan dipindahkan ke tabel tagihan';

INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('19', 'KWA1710147980', 'KWA001', '2017-10-02', 'Belum Bayar', 'f219942e4da45a90ed9bdf8ad3205d4d', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('20', 'KWA1710365906', 'KWA002', '2017-10-02', 'Belum Bayar', '2c1218c1047227aef9c4f1d6365a6fa2', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('21', 'KWA1710666717', 'KWA003', '2017-10-02', 'Belum Bayar', '50a52c9a61e3345530bbfb44aeb37dfe', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('22', 'KWA1710064576', 'KWA004', '2017-10-02', 'Belum Bayar', '40d8647501536c7b4a0f5ae036a8e4d4', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('23', 'KWA1710852935', 'KWA005', '2017-10-02', 'Belum Bayar', 'b8e37c379cdb88c9eb6e0f70b365fb9f', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('24', 'KWA1710768615', 'KWA006', '2017-10-02', 'Belum Bayar', '52681673cb3104f06723620bccdfd054', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('25', 'KWA1710874603', 'KWA007', '2017-10-02', 'Belum Bayar', '7d4a033e4f62cf58288c397553f44e6d', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('26', 'KWA1710786621', 'KWA008', '2017-10-02', 'Belum Bayar', '34a3eef2bf46fcaf9e8dc4240c496a4d', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('27', 'KWA1710368439', 'KWA009', '2017-10-02', 'Belum Bayar', 'ef83c746866544ee2f9ce4b8d9bf1c3e', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('46', 'KWA1711221222', 'KWA001', '2017-11-02', 'Belum Bayar', 'fc1c656acbdf2cada502f5a1fe09da1d', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('47', 'KWA1711849304', 'KWA002', '2017-11-02', 'Belum Bayar', 'b4dcd8cfe3661425ff30f44e0401f78c', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('48', 'KWA1711857147', 'KWA003', '2017-11-02', 'Belum Bayar', 'c46fb09bb423b175fa6017b808f00452', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('49', 'KWA1711321411', 'KWA004', '2017-11-02', 'Belum Bayar', '12f282eb1c843b1d007cadceeab39f9b', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('50', 'KWA1711348053', 'KWA005', '2017-11-02', 'Belum Bayar', '09d9faadc6313c7c40c910f1611fe0ee', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('51', 'KWA1711236389', 'KWA006', '2017-11-02', 'Belum Bayar', '272df78cbc2a317a96310487d1e753e3', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('52', 'KWA1711361908', 'KWA007', '2017-11-02', 'Belum Bayar', '24ad241ff860dc5e6d8485e55f7c156a', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('53', 'KWA1711402832', 'KWA008', '2017-11-02', 'Belum Bayar', '9572fe1914d50473f6ce0fdda252082c', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('54', 'KWA1711035431', 'KWA009', '2017-11-02', 'Belum Bayar', 'ed75510cb4b672b9a7216b7cd78dcfbc', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('55', 'KWA1712723388', 'KWA001', '2017-12-02', 'Belum Bayar', '7859b205c9f26c9385542c4e74edb234', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('56', 'KWA1712851104', 'KWA002', '2017-12-02', 'Belum Bayar', '788ac860b1d9188330b764ce2aabc445', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('57', 'KWA1712006531', 'KWA003', '2017-12-02', 'Belum Bayar', '052510a73ddc3c17d2629148713bb5c2', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('58', 'KWA1712494843', 'KWA004', '2017-12-02', 'Belum Bayar', '13f02ab243fbbb0c5ad70972a72b0824', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('59', 'KWA1712330200', 'KWA005', '2017-12-02', 'Belum Bayar', 'fae94c2a4d6622150ad8e49b537fa457', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('60', 'KWA1712806060', 'KWA006', '2017-12-02', 'Belum Bayar', 'f08b304407056cb7b1ace803f836b135', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('61', 'KWA1712659241', 'KWA007', '2017-12-02', 'Belum Bayar', '34307865c6295d5cbad3b94386a5052c', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('62', 'KWA1712952728', 'KWA008', '2017-12-02', 'Belum Bayar', 'd6f8e56c3bc04bb219f8188b5df11283', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('63', 'KWA1712302246', 'KWA009', '2017-12-02', 'Belum Bayar', '29cc480ad43a6bbc16ad2897f34e8d56', NULL, 'superadmin');
INSERT INTO `tagihan` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`) VALUES ('64', 'KWA1711571564', 'KWB002', '2017-11-02', 'Belum Bayar', '43e31403fa64067f43b816ffab1b9857', NULL, 'superadmin');


#
# TABLE STRUCTURE FOR: temp_invoice
#

DROP TABLE IF EXISTS `temp_invoice`;

CREATE TABLE `temp_invoice` (
  `id_trx` int(11) NOT NULL AUTO_INCREMENT,
  `kode_invoice` varchar(15) DEFAULT NULL,
  `kode_pelanggan` varchar(10) DEFAULT NULL,
  `bulan_penagihan` date DEFAULT NULL,
  `status` enum('Lunas','Belum Bayar') DEFAULT 'Belum Bayar',
  `hash` varchar(50) DEFAULT NULL COMMENT 'hasil md5 dari kode_invoice+kunci',
  `tgl_bayar` date DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL COMMENT 'user session yang melakukan pekerjaan ini',
  `keterangan` tinytext,
  PRIMARY KEY (`id_trx`),
  UNIQUE KEY `kode_invoice` (`kode_invoice`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=latin1 COMMENT='- Kwitansi -\r\nData sementara untuk membuat kwitansi pdf';

INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('192', 'KWA1709792144', 'KWA001', '2017-09-02', 'Lunas', 'ef1ff0f7d11a9cc4d2e2dd4a4f7b781b', '2017-11-07', 'superadmin', '');
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('193', 'KWA1709267395', 'KWA002', '2017-09-02', 'Lunas', '8488974c105b839036aa991caaaf24cd', '2017-11-07', 'superadmin', '');
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('194', 'KWA1709866546', 'KWA003', '2017-09-02', 'Lunas', '0a9d88b964bfee29b37ca5fea6d83d33', '2017-11-07', 'superadmin', 'TV Lama : Max 12 Siaran');
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('195', 'KWA1709033448', 'KWA004', '2017-09-02', 'Belum Bayar', 'b54a1be20882404e0f2aee7520c58db8', '2017-11-06', 'superadmin', '');
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('196', 'KWA1709897491', 'KWA005', '2017-09-02', 'Belum Bayar', '4379548dedbdf39c0bdee291ed7f094d', '2017-11-06', 'superadmin', '');
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('197', 'KWA1709312683', 'KWA006', '2017-09-02', 'Belum Bayar', '91a4719e113ef4172d2dfc134a4ebed5', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('198', 'KWA1709115448', 'KWA007', '2017-09-02', 'Belum Bayar', '0a1a610c06a15a3919de9c436948ae55', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('199', 'KWA1709226197', 'KWA008', '2017-09-02', 'Belum Bayar', '6dd1c051afd56c6c1ecd1717a87ba86a', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('200', 'KWA1709719635', 'KWA009', '2017-09-02', 'Belum Bayar', '6d8659a4b4a1b0ca22b9e0aa668b2e5f', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('201', 'KWA1710990875', 'KWA001', '2017-10-02', 'Belum Bayar', 'a167b8f10d183150abffa6f723796037', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('202', 'KWA1710179016', 'KWA002', '2017-10-02', 'Belum Bayar', 'be3fff2a27aeb6b878efb516bf770833', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('203', 'KWA1710483246', 'KWA003', '2017-10-02', 'Belum Bayar', '66ee4dd3714e3a5a65031ee08e39b502', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('204', 'KWA1710503662', 'KWA004', '2017-10-02', 'Belum Bayar', '97a30973a77cd44da888483df1d8a306', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('205', 'KWA1710400910', 'KWA005', '2017-10-02', 'Belum Bayar', '441fb706d92ebc861938a24e3ef3c656', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('206', 'KWA1710435242', 'KWA006', '2017-10-02', 'Belum Bayar', '6cfab25b0b69f62a33fb3f4a686d33e1', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('207', 'KWA1710724334', 'KWA007', '2017-10-02', 'Belum Bayar', '6c442fb6d8e7893ac6c7fcd692a2d1e0', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('208', 'KWA1710844848', 'KWA008', '2017-10-02', 'Belum Bayar', '75d40ba2c4567d035cabac76d7df4dc0', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('209', 'KWA1710402741', 'KWA009', '2017-10-02', 'Belum Bayar', 'b802766de23bb3aa18146d8e6da09be7', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('210', 'KWA1711197327', 'KWA001', '2017-11-02', 'Belum Bayar', '1c5e156dba1250767347f3c62ee0eaf0', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('211', 'KWA1711104096', 'KWA002', '2017-11-02', 'Belum Bayar', '0db27a9745c144c88eaafd2298806b80', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('212', 'KWA1711301270', 'KWA003', '2017-11-02', 'Belum Bayar', 'e7d7750fb27224882bf3c691b0a09e09', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('213', 'KWA1711965118', 'KWA004', '2017-11-02', 'Belum Bayar', 'ea622317e25be1c596d02f82ade7d3f7', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('214', 'KWA1711059021', 'KWA005', '2017-11-02', 'Belum Bayar', '7d5489f0dbe7dba346dc8ba1a99d80e7', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('215', 'KWA1711341278', 'KWA006', '2017-11-02', 'Belum Bayar', '55b028fe9bc7501367f293c54f2ac505', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('216', 'KWA1711216675', 'KWA007', '2017-11-02', 'Belum Bayar', '8ee2e11cbc485656fd7d9fd76759e79a', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('217', 'KWA1711556793', 'KWA008', '2017-11-02', 'Belum Bayar', '485d2ba1fe5fee91cc57c12df6e4e7ea', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('218', 'KWA1711114075', 'KWA009', '2017-11-02', 'Belum Bayar', 'c1805be75469410766c00af065f79181', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('219', 'KWA1712654632', 'KWA001', '2017-12-02', 'Belum Bayar', '3147625fd2f66b42edda65ddf91d5731', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('220', 'KWA1712434815', 'KWA002', '2017-12-02', 'Belum Bayar', '7133ea4d0ab739e07adf782c930f6477', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('221', 'KWA1712146515', 'KWA003', '2017-12-02', 'Belum Bayar', 'a12e4513a06987bf4af22b4adb159fe0', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('222', 'KWA1712956237', 'KWA004', '2017-12-02', 'Belum Bayar', '072280a079dcb969d439010d99fdc3ca', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('223', 'KWA1712762909', 'KWA005', '2017-12-02', 'Belum Bayar', '774163490c57217b8a20fbbfeeaaf534', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('224', 'KWA1712299439', 'KWA006', '2017-12-02', 'Belum Bayar', '70f845081ddc5b497af9bf89f00c853c', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('225', 'KWA1712203034', 'KWA007', '2017-12-02', 'Belum Bayar', 'd8e7357c875b9fd058786bf872d3d119', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('226', 'KWA1712679260', 'KWA008', '2017-12-02', 'Belum Bayar', 'f5c8d71ad17624c8e57ffa92743f27d7', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('227', 'KWA1712884857', 'KWA009', '2017-12-02', 'Belum Bayar', '6e4abc43a4e9ebc46597a6a9e525531b', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('228', 'KWA1801495422', 'KWA001', '2018-01-02', 'Belum Bayar', '8956c17db1d6980b19e2843bb4261258', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('229', 'KWA1801971527', 'KWA002', '2018-01-02', 'Belum Bayar', 'df9b862b2cbf24589d11941475a839ec', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('230', 'KWA1801726318', 'KWA003', '2018-01-02', 'Belum Bayar', '2bb7c60da3e21049e0db1e7a6bc81edc', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('231', 'KWA1801670441', 'KWA004', '2018-01-02', 'Belum Bayar', '6d9ff500b6d933cb3f9f31891af9e118', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('232', 'KWA1801814148', 'KWA005', '2018-01-02', 'Belum Bayar', 'ed5edc4552168b73ab51c7a9b4589aac', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('233', 'KWA1801025116', 'KWA006', '2018-01-02', 'Belum Bayar', '99e32d1da24648039227d4552d39d6de', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('234', 'KWA1801630005', 'KWA007', '2018-01-02', 'Belum Bayar', '2e03a2aaa6089e6930b9dcc27e08d9c5', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('235', 'KWA1801984771', 'KWA008', '2018-01-02', 'Belum Bayar', 'b563f1ed423d2cea09d389c09d37c787', NULL, 'superadmin', NULL);
INSERT INTO `temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `bulan_penagihan`, `status`, `hash`, `tgl_bayar`, `user`, `keterangan`) VALUES ('236', 'KWA1801638733', 'KWA009', '2018-01-02', 'Belum Bayar', '2500c32165ea11f00685c79286c38256', NULL, 'superadmin', NULL);


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_users` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `id_karyawan` int(2) DEFAULT NULL,
  `level` enum('administrator','kolektor','teknisi') DEFAULT NULL,
  `aktif` enum('nonaktif','aktif') DEFAULT NULL,
  PRIMARY KEY (`id_users`),
  KEY `FK_users_karyawan` (`id_karyawan`),
  CONSTRAINT `FK_users_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id_users`, `username`, `password`, `id_karyawan`, `level`, `aktif`) VALUES ('1', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '1', 'administrator', 'aktif');


#
# TABLE STRUCTURE FOR: v_karyawan
#

DROP TABLE IF EXISTS `v_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_karyawan` AS select `k`.`id_karyawan` AS `id_karyawan`,`k`.`kode_karyawan` AS `kode_karyawan`,`k`.`nama_lengkap` AS `nama_lengkap`,`b`.`bagian` AS `bagian`,`j`.`jabatan` AS `jabatan`,`k`.`status` AS `status`,`k`.`tgl_masuk` AS `tgl_masuk`,`k`.`tgl_berakhir` AS `tgl_berakhir`,`k`.`no_ktp` AS `no_ktp`,`k`.`alamat` AS `alamat`,`k`.`telp` AS `telp`,`k`.`bagian` AS `id_bagian`,`k`.`jabatan` AS `id_jabatan` from ((`karyawan` `k` join `bagian` `b`) join `jabatan` `j`) where ((`k`.`bagian` = `b`.`id_bagian`) and (`k`.`jabatan` = `j`.`id_jabatan`));

utf8mb4_general_ci;

INSERT INTO `v_karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`, `id_bagian`, `id_jabatan`) VALUES ('1', 'PTV001', 'I Gusti Ngurah ABS', 'CEO', 'Direktur Utama', 'Aktif', '2017-10-19', '2050-10-19', '72710312345670001', 'Jl. Morarena Kel Kawua - Poso', '0811458084', '1', '1');
INSERT INTO `v_karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`, `id_bagian`, `id_jabatan`) VALUES ('2', 'PTV002', 'Novy Ratosigi', 'Keuangan', 'Bendahara', 'Aktif', '2017-10-09', '2017-10-02', '727103', 'Jl. jhfksjdfk', '09384238', '2', '2');
INSERT INTO `v_karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`, `id_bagian`, `id_jabatan`) VALUES ('3', 'PTV003', 'Adris Koa\'a', 'Pelayanan', 'Kepala Teknisi', 'Aktif', NULL, NULL, NULL, NULL, NULL, '5', '3');
INSERT INTO `v_karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`, `id_bagian`, `id_jabatan`) VALUES ('4', 'PTV004', 'Elroy', 'Pelayanan', 'Staf Teknisi', 'Aktif', NULL, NULL, NULL, NULL, NULL, '5', '4');
INSERT INTO `v_karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`, `id_bagian`, `id_jabatan`) VALUES ('5', 'PTV005', 'M Tasya', 'Keuangan', 'Kolektor', 'Aktif', NULL, NULL, NULL, NULL, NULL, '2', '5');
INSERT INTO `v_karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`, `id_bagian`, `id_jabatan`) VALUES ('6', 'PTV006', 'M Mendi', 'Keuangan', 'Kolektor', 'Aktif', NULL, NULL, NULL, NULL, NULL, '2', '5');
INSERT INTO `v_karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`, `id_bagian`, `id_jabatan`) VALUES ('7', 'PTV007', 'Koperasi KOMPI 714', 'Keuangan', 'Kolektor', 'Aktif', NULL, NULL, NULL, NULL, NULL, '2', '5');
INSERT INTO `v_karyawan` (`id_karyawan`, `kode_karyawan`, `nama_lengkap`, `bagian`, `jabatan`, `status`, `tgl_masuk`, `tgl_berakhir`, `no_ktp`, `alamat`, `telp`, `id_bagian`, `id_jabatan`) VALUES ('8', 'PTV008', 'Papa Adhy', 'Keuangan', 'Kolektor', 'Aktif', '2017-10-29', NULL, NULL, NULL, NULL, '2', '5');


#
# TABLE STRUCTURE FOR: v_kolektor
#

DROP TABLE IF EXISTS `v_kolektor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_kolektor` AS select `k`.`id_kolektor` AS `id_kolektor`,`kr`.`kode_karyawan` AS `kode_karyawan`,`kr`.`nama_lengkap` AS `nama_lengkap`,`k`.`wilayah` AS `wilayah`,`k`.`keterangan` AS `keterangan`,`kr`.`telp` AS `telp`,`k`.`id_karyawan` AS `id_karyawan` from (`kolektor` `k` join `karyawan` `kr`) where (`k`.`id_karyawan` = `kr`.`id_karyawan`);

utf8mb4_general_ci;

INSERT INTO `v_kolektor` (`id_kolektor`, `kode_karyawan`, `nama_lengkap`, `wilayah`, `keterangan`, `telp`, `id_karyawan`) VALUES ('1', 'PTV005', 'M Tasya', '[\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"54\"]', 'Kawua', NULL, '5');
INSERT INTO `v_kolektor` (`id_kolektor`, `kode_karyawan`, `nama_lengkap`, `wilayah`, `keterangan`, `telp`, `id_karyawan`) VALUES ('2', 'PTV006', 'M Mendi', '[\"51\",\"52\",\"53\"]', 'Ranononcu, Lembomawo', NULL, '6');
INSERT INTO `v_kolektor` (`id_kolektor`, `kode_karyawan`, `nama_lengkap`, `wilayah`, `keterangan`, `telp`, `id_karyawan`) VALUES ('3', 'PTV007', 'Koperasi KOMPI 714', '[\"42\"]', 'Kompi 714', NULL, '7');
INSERT INTO `v_kolektor` (`id_kolektor`, `kode_karyawan`, `nama_lengkap`, `wilayah`, `keterangan`, `telp`, `id_karyawan`) VALUES ('4', 'PTV008', 'Papa Adhy', '[\"57\"]', 'Tambaro', NULL, '8');


#
# TABLE STRUCTURE FOR: v_pelanggan
#

DROP TABLE IF EXISTS `v_pelanggan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_pelanggan` AS select `p`.`id_pelanggan` AS `id_pelanggan`,`p`.`kode_pelanggan` AS `kode_pelanggan`,`p`.`no_ktp` AS `no_ktp`,`p`.`nama_lengkap` AS `nama_lengkap`,`w`.`wilayah` AS `wilayah`,`p`.`alamat` AS `alamat`,`p`.`tgl_pasang` AS `tgl_pasang`,`p`.`telp` AS `telp`,`t`.`jml_tv` AS `jml_tv`,`t`.`tarif` AS `tarif`,`s`.`status` AS `status`,`p`.`foto` AS `foto`,`p`.`wilayah` AS `id_wilayah`,`p`.`tarif` AS `id_tarif`,`p`.`status` AS `id_status` from (((`pelanggan` `p` join `wilayah` `w`) join `tarif` `t`) join `status` `s`) where ((`p`.`wilayah` = `w`.`id_wilayah`) and (`p`.`tarif` = `t`.`id_tarif`) and (`p`.`status` = `s`.`id_status`));

utf8mb4_general_ci;

INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('1', 'KWA001', '72717', 'Gusti Ketut P. Wijaya', 'Kawua A', 'Jl. Pengkol', '2017-10-23', '087636', '1', '30000', 'Aktif', NULL, '43', '1', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('5', 'KWA004', '72717', 'Bayu Prasetyo', 'Kawua A', 'Jl. Pengkol', '2017-10-23', '087636', '1', '30000', 'Aktif', NULL, '43', '1', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('6', 'KWA005', '72717', 'Aswan', 'Kawua A', 'Jl. Pengkol', '2017-10-23', '087636', '1', '30000', 'Aktif', NULL, '43', '1', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('7', 'KWA006', '72717', 'Ghina Suryani', 'Kawua A', 'Jl. Pengkol', '2017-10-23', '087636', '1', '30000', 'Aktif', NULL, '43', '1', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('8', 'KWA007', '72717', 'Christiana Indrayani', 'Kawua A', 'Jl. Pengkol', '2017-10-23', '087636', '1', '30000', 'Aktif', NULL, '43', '1', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('9', 'KWA008', '72717', 'Kiki Ferginita', 'Kawua A', 'Jl. Pengkol', '2017-10-23', '087636', '1', '30000', 'Aktif', NULL, '43', '1', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('10', 'KWA009', '72717', 'Lily Septiani', 'Kawua A', 'Jl. Pengkol', '2017-10-23', '087636', '1', '30000', 'Aktif', NULL, '43', '1', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('14', 'KWB002', '72710372', 'Fatmala Rahman', 'Kawua B', 'Jl. xxxxxx xx xxxx', '2017-10-12', '082394824684', '1', '30000', 'Aktif', '', '44', '1', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('15', 'RAN001', '727103127462376487', 'Chintya Kurniawati', 'Ranononcu', 'Jl. Kancil', '2017-10-30', '081343955120', '1', '30000', 'Aktif', '', '54', '1', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('3', 'KWA003', '72717', 'Khairil Anwar', 'Kawua A', 'Jl. Pengkol', '2017-10-23', '087636', '2', '35000', 'Aktif', NULL, '43', '2', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('4', 'MOR001', '17238120', 'Praras', 'Morarena', 'Jl. Morarena', '2017-10-10', '087373', '2', '35000', 'Aktif', '', '53', '2', '1');
INSERT INTO `v_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `no_ktp`, `nama_lengkap`, `wilayah`, `alamat`, `tgl_pasang`, `telp`, `jml_tv`, `tarif`, `status`, `foto`, `id_wilayah`, `id_tarif`, `id_status`) VALUES ('2', 'KWA002', '72717', 'Fardiansyah', 'Kawua A', 'Jl. Pengkol', '2017-10-23', '087636', '3', '40000', 'Aktif', NULL, '43', '3', '1');


#
# TABLE STRUCTURE FOR: v_pengaduan
#

DROP TABLE IF EXISTS `v_pengaduan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_pengaduan` AS select `p`.`id_pengaduan` AS `id_pengaduan`,`pl`.`kode_pelanggan` AS `kode_pelanggan`,`pl`.`nama_lengkap` AS `nama_lengkap`,`pl`.`wilayah` AS `wilayah`,`pl`.`alamat` AS `alamat`,`pl`.`status` AS `status`,`p`.`tgl_lapor` AS `tgl_lapor`,`p`.`tgl_gangguan` AS `tgl_gangguan`,`p`.`prioritas` AS `prioritas`,`j`.`jenis_gangguan` AS `jenis_gangguan`,`p`.`keterangan` AS `keterangan`,`p`.`tgl_perbaikan` AS `tgl_perbaikan`,`p`.`teknisi` AS `teknisi`,`p`.`sebab` AS `sebab`,`p`.`tindakan` AS `tindakan`,`p`.`status_aduan` AS `status_aduan` from ((`pengaduan` `p` join `v_pelanggan` `pl`) join `jenis_gangguan` `j`) where ((`p`.`kode_pelanggan` = `pl`.`id_pelanggan`) and (`p`.`jenis_gangguan` = `j`.`id_jenis_gangguan`));

utf8mb4_general_ci;

INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('9', 'KWA001', 'Gusti Ketut P. Wijaya', 'Kawua A', 'Jl. Pengkol', 'Aktif', '2017-10-26', '2017-10-26', 'High', 'Kabel Putus', 'Tersambar Truk', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('11', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('12', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('14', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('15', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('16', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('17', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('18', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('19', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('20', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('21', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('22', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('23', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('24', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('25', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('26', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('27', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('28', 'MOR001', 'Praras', 'Morarena', 'Jl. Morarena', 'Aktif', '2017-11-12', '2017-11-12', 'High', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('10', 'KWA002', 'Fardiansyah', 'Kawua A', 'Jl. Pengkol', 'Aktif', '2017-11-12', '2017-11-12', 'Medium', 'Gambar Kabur', '-', NULL, NULL, NULL, NULL, 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('8', 'KWA003', 'Khairil Anwar', 'Kawua A', 'Jl. Pengkol', 'Aktif', '2017-10-25', '2017-10-25', 'Medium', 'Gambar Bergaris', 'sgsd sdhglsd glds gsdgsdgdglsdglsd', '2017-10-11', '[\"1\",\"2\"]', 'asfafas', 'fsdgsdds', 'Menunggu');
INSERT INTO `v_pengaduan` (`id_pengaduan`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `status`, `tgl_lapor`, `tgl_gangguan`, `prioritas`, `jenis_gangguan`, `keterangan`, `tgl_perbaikan`, `teknisi`, `sebab`, `tindakan`, `status_aduan`) VALUES ('13', 'KWA003', 'Khairil Anwar', 'Kawua A', 'Jl. Pengkol', 'Aktif', '2017-10-25', '2017-10-25', 'Medium', 'Gambar Bergaris', 'sgsd sdhglsd glds gsdgsdgdglsdglsd', '2017-10-11', '[\"1\",\"2\"]', 'asfafas', 'fsdgsdds', 'Menunggu');


#
# TABLE STRUCTURE FOR: v_temp_invoice
#

DROP TABLE IF EXISTS `v_temp_invoice`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_temp_invoice` AS select `t`.`id_trx` AS `id_trx`,`t`.`kode_invoice` AS `kode_invoice`,`t`.`kode_pelanggan` AS `kode_pelanggan`,`p`.`nama_lengkap` AS `nama_lengkap`,`p`.`wilayah` AS `wilayah`,`p`.`alamat` AS `alamat`,`p`.`jml_tv` AS `jml_tv`,`p`.`tarif` AS `tarif`,`t`.`bulan_penagihan` AS `bulan_penagihan`,`t`.`status` AS `status`,`t`.`hash` AS `hash`,`t`.`keterangan` AS `keterangan`,`w`.`kode_wilayah` AS `kode_wilayah` from ((`temp_invoice` `t` join `v_pelanggan` `p`) join `wilayah` `w`) where ((`t`.`kode_pelanggan` = `p`.`kode_pelanggan`) and (`p`.`id_wilayah` = `w`.`id_wilayah`));

utf8mb4_general_ci;

INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('192', 'KWA1709792144', 'KWA001', 'Gusti Ketut P. Wijaya', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-09-02', 'Lunas', 'ef1ff0f7d11a9cc4d2e2dd4a4f7b781b', '', 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('193', 'KWA1709267395', 'KWA002', 'Fardiansyah', 'Kawua A', 'Jl. Pengkol', '3', '40000', '2017-09-02', 'Lunas', '8488974c105b839036aa991caaaf24cd', '', 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('194', 'KWA1709866546', 'KWA003', 'Khairil Anwar', 'Kawua A', 'Jl. Pengkol', '2', '35000', '2017-09-02', 'Lunas', '0a9d88b964bfee29b37ca5fea6d83d33', 'TV Lama : Max 12 Siaran', 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('195', 'KWA1709033448', 'KWA004', 'Bayu Prasetyo', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-09-02', 'Belum Bayar', 'b54a1be20882404e0f2aee7520c58db8', '', 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('196', 'KWA1709897491', 'KWA005', 'Aswan', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-09-02', 'Belum Bayar', '4379548dedbdf39c0bdee291ed7f094d', '', 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('197', 'KWA1709312683', 'KWA006', 'Ghina Suryani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-09-02', 'Belum Bayar', '91a4719e113ef4172d2dfc134a4ebed5', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('198', 'KWA1709115448', 'KWA007', 'Christiana Indrayani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-09-02', 'Belum Bayar', '0a1a610c06a15a3919de9c436948ae55', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('199', 'KWA1709226197', 'KWA008', 'Kiki Ferginita', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-09-02', 'Belum Bayar', '6dd1c051afd56c6c1ecd1717a87ba86a', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('200', 'KWA1709719635', 'KWA009', 'Lily Septiani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-09-02', 'Belum Bayar', '6d8659a4b4a1b0ca22b9e0aa668b2e5f', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('201', 'KWA1710990875', 'KWA001', 'Gusti Ketut P. Wijaya', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-10-02', 'Belum Bayar', 'a167b8f10d183150abffa6f723796037', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('202', 'KWA1710179016', 'KWA002', 'Fardiansyah', 'Kawua A', 'Jl. Pengkol', '3', '40000', '2017-10-02', 'Belum Bayar', 'be3fff2a27aeb6b878efb516bf770833', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('203', 'KWA1710483246', 'KWA003', 'Khairil Anwar', 'Kawua A', 'Jl. Pengkol', '2', '35000', '2017-10-02', 'Belum Bayar', '66ee4dd3714e3a5a65031ee08e39b502', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('204', 'KWA1710503662', 'KWA004', 'Bayu Prasetyo', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-10-02', 'Belum Bayar', '97a30973a77cd44da888483df1d8a306', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('205', 'KWA1710400910', 'KWA005', 'Aswan', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-10-02', 'Belum Bayar', '441fb706d92ebc861938a24e3ef3c656', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('206', 'KWA1710435242', 'KWA006', 'Ghina Suryani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-10-02', 'Belum Bayar', '6cfab25b0b69f62a33fb3f4a686d33e1', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('207', 'KWA1710724334', 'KWA007', 'Christiana Indrayani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-10-02', 'Belum Bayar', '6c442fb6d8e7893ac6c7fcd692a2d1e0', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('208', 'KWA1710844848', 'KWA008', 'Kiki Ferginita', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-10-02', 'Belum Bayar', '75d40ba2c4567d035cabac76d7df4dc0', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('209', 'KWA1710402741', 'KWA009', 'Lily Septiani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-10-02', 'Belum Bayar', 'b802766de23bb3aa18146d8e6da09be7', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('210', 'KWA1711197327', 'KWA001', 'Gusti Ketut P. Wijaya', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-11-02', 'Belum Bayar', '1c5e156dba1250767347f3c62ee0eaf0', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('211', 'KWA1711104096', 'KWA002', 'Fardiansyah', 'Kawua A', 'Jl. Pengkol', '3', '40000', '2017-11-02', 'Belum Bayar', '0db27a9745c144c88eaafd2298806b80', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('212', 'KWA1711301270', 'KWA003', 'Khairil Anwar', 'Kawua A', 'Jl. Pengkol', '2', '35000', '2017-11-02', 'Belum Bayar', 'e7d7750fb27224882bf3c691b0a09e09', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('213', 'KWA1711965118', 'KWA004', 'Bayu Prasetyo', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-11-02', 'Belum Bayar', 'ea622317e25be1c596d02f82ade7d3f7', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('214', 'KWA1711059021', 'KWA005', 'Aswan', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-11-02', 'Belum Bayar', '7d5489f0dbe7dba346dc8ba1a99d80e7', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('215', 'KWA1711341278', 'KWA006', 'Ghina Suryani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-11-02', 'Belum Bayar', '55b028fe9bc7501367f293c54f2ac505', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('216', 'KWA1711216675', 'KWA007', 'Christiana Indrayani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-11-02', 'Belum Bayar', '8ee2e11cbc485656fd7d9fd76759e79a', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('217', 'KWA1711556793', 'KWA008', 'Kiki Ferginita', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-11-02', 'Belum Bayar', '485d2ba1fe5fee91cc57c12df6e4e7ea', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('218', 'KWA1711114075', 'KWA009', 'Lily Septiani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-11-02', 'Belum Bayar', 'c1805be75469410766c00af065f79181', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('219', 'KWA1712654632', 'KWA001', 'Gusti Ketut P. Wijaya', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-12-02', 'Belum Bayar', '3147625fd2f66b42edda65ddf91d5731', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('220', 'KWA1712434815', 'KWA002', 'Fardiansyah', 'Kawua A', 'Jl. Pengkol', '3', '40000', '2017-12-02', 'Belum Bayar', '7133ea4d0ab739e07adf782c930f6477', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('221', 'KWA1712146515', 'KWA003', 'Khairil Anwar', 'Kawua A', 'Jl. Pengkol', '2', '35000', '2017-12-02', 'Belum Bayar', 'a12e4513a06987bf4af22b4adb159fe0', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('222', 'KWA1712956237', 'KWA004', 'Bayu Prasetyo', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-12-02', 'Belum Bayar', '072280a079dcb969d439010d99fdc3ca', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('223', 'KWA1712762909', 'KWA005', 'Aswan', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-12-02', 'Belum Bayar', '774163490c57217b8a20fbbfeeaaf534', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('224', 'KWA1712299439', 'KWA006', 'Ghina Suryani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-12-02', 'Belum Bayar', '70f845081ddc5b497af9bf89f00c853c', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('225', 'KWA1712203034', 'KWA007', 'Christiana Indrayani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-12-02', 'Belum Bayar', 'd8e7357c875b9fd058786bf872d3d119', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('226', 'KWA1712679260', 'KWA008', 'Kiki Ferginita', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-12-02', 'Belum Bayar', 'f5c8d71ad17624c8e57ffa92743f27d7', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('227', 'KWA1712884857', 'KWA009', 'Lily Septiani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2017-12-02', 'Belum Bayar', '6e4abc43a4e9ebc46597a6a9e525531b', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('228', 'KWA1801495422', 'KWA001', 'Gusti Ketut P. Wijaya', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2018-01-02', 'Belum Bayar', '8956c17db1d6980b19e2843bb4261258', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('229', 'KWA1801971527', 'KWA002', 'Fardiansyah', 'Kawua A', 'Jl. Pengkol', '3', '40000', '2018-01-02', 'Belum Bayar', 'df9b862b2cbf24589d11941475a839ec', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('230', 'KWA1801726318', 'KWA003', 'Khairil Anwar', 'Kawua A', 'Jl. Pengkol', '2', '35000', '2018-01-02', 'Belum Bayar', '2bb7c60da3e21049e0db1e7a6bc81edc', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('231', 'KWA1801670441', 'KWA004', 'Bayu Prasetyo', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2018-01-02', 'Belum Bayar', '6d9ff500b6d933cb3f9f31891af9e118', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('232', 'KWA1801814148', 'KWA005', 'Aswan', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2018-01-02', 'Belum Bayar', 'ed5edc4552168b73ab51c7a9b4589aac', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('233', 'KWA1801025116', 'KWA006', 'Ghina Suryani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2018-01-02', 'Belum Bayar', '99e32d1da24648039227d4552d39d6de', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('234', 'KWA1801630005', 'KWA007', 'Christiana Indrayani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2018-01-02', 'Belum Bayar', '2e03a2aaa6089e6930b9dcc27e08d9c5', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('235', 'KWA1801984771', 'KWA008', 'Kiki Ferginita', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2018-01-02', 'Belum Bayar', 'b563f1ed423d2cea09d389c09d37c787', NULL, 'KWA');
INSERT INTO `v_temp_invoice` (`id_trx`, `kode_invoice`, `kode_pelanggan`, `nama_lengkap`, `wilayah`, `alamat`, `jml_tv`, `tarif`, `bulan_penagihan`, `status`, `hash`, `keterangan`, `kode_wilayah`) VALUES ('236', 'KWA1801638733', 'KWA009', 'Lily Septiani', 'Kawua A', 'Jl. Pengkol', '1', '30000', '2018-01-02', 'Belum Bayar', '2500c32165ea11f00685c79286c38256', NULL, 'KWA');


#
# TABLE STRUCTURE FOR: v_users
#

DROP TABLE IF EXISTS `v_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_users` AS select `u`.`id_users` AS `id_users`,`u`.`username` AS `username`,`u`.`password` AS `password`,`k`.`nama_lengkap` AS `nama_lengkap`,`u`.`level` AS `level`,`u`.`aktif` AS `aktif`,`u`.`id_karyawan` AS `id_karyawan` from (`users` `u` join `karyawan` `k`) where (`u`.`id_karyawan` = `k`.`id_karyawan`);

utf8mb4_general_ci;

INSERT INTO `v_users` (`id_users`, `username`, `password`, `nama_lengkap`, `level`, `aktif`, `id_karyawan`) VALUES ('1', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'I Gusti Ngurah ABS', 'administrator', 'aktif', '1');


