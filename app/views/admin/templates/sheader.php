<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $profilP->nama_perusahaan; ?> | Dashboard</title>

    <link href="<?php echo base_url('assets/inspinia271/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inspinia271/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
    <?php if ($active !='profil_perusahaan'): ?>
      <link href="<?php echo base_url('assets/inspinia271/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
    <?php endif; ?>
    <?php if ($active =='karyawan' || $active =='pengaduan' || $active =='pelanggan' || $active =='perbaikan_gangguan' || $active == 'kwitansi'): ?>
      <link href="<?php echo base_url('assets/inspinia271/css/plugins/datapicker/datepicker3.css') ?>" rel="stylesheet">
    <?php endif; ?>
    <?php if ($active =='pengaduan' || $active =='perbaikan_gangguan' || $active == 'pelanggan' || $active == 'kwitansi' || $active == 'kolektor' ): ?>
      <link href="<?php echo base_url('assets/inspinia271/css/plugins/select2/select2.min.css') ?>" rel="stylesheet">
      <?php if ($active === 'pengaduan'): ?>
        <link href="<?php echo base_url('assets/inspinia271/css/plugins/select2/select2.result.css') ?>" rel="stylesheet">
      <?php endif; ?>

    <?php endif; ?>
    <?php if ($active == 'setoran_kolektor'): ?>
      <style media="screen">
        .vidscan {
          width: 120px !important;
          height: auto !important;
        }
      </style>
      <script type="text/javascript" src="<?php echo base_url('assets/instascan/download/instascan.min.js') ?>"></script>
    <?php endif; ?>
    <?php if ($active =='pengaduan' || $active =='perbaikan_gangguan' || $active == 'pelanggan' || $active == 'kolektor'): ?>
      <style media="screen">
        .select2-close-mask{
          z-index: 2199;
        }
        .select2-dropdown{
          z-index: 2200;
        }
      </style>
    <?php endif; ?>
    <!-- Toastr style -->
    <link href="<?php echo base_url('assets/inspinia271/css/plugins/toastr/toastr.min.css') ?>" rel="stylesheet">
    <!-- Bootstrap Tour -->
    <link href="<?php echo base_url('assets/inspinia271/css/plugins/bootstrapTour/bootstrap-tour.min.css') ?>" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url('assets/inspinia271/js/plugins/gritter/jquery.gritter.css') ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/inspinia271/css/animate.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inspinia271/css/style.css') ?>" rel="stylesheet">

</head>
