<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daftar Pengaduan</title>
    <link href="<?php echo base_url('assets/inspinia271/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inspinia271/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inspinia271/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inspinia271/css/animate.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inspinia271/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inspinia271/js/plugins/ticker/ticker.css') ?>" rel="stylesheet">
  </head>
  <body>
    <div class="row">
        <div class="col-lg-12">
          <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-title bg-primary">
              <h2 class="text-center"><strong>DAFTAR PENGADUAN PELANGGAN</strong></h2>

            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="ibox float-e-margins">
                  <div class="ibox-content">
                    <div class="table-responsivexx">
                      <table class="table table-hover" id="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Kode Pelanggan</th>
                            <th>Nama Lengkap</th>
                            <th>Wilayah</th>
                            <th>Tgl Lapor</th>
                            <th>Jenis Gangguan</th>
                            <th>Prioritas</th>
                            <th>Status Aduan</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="footer">
              <div class="ticker-container">
                <div class="ticker-caption">
                  <p><strong> Informasi</strong></p>
                </div>
                <ul>
                  <div>
                    <li><span class="font-bold">Pengaduan ber-Prioritas <a href="#" class="btn btn-xs btn-warning">High</a> adalah yang utama dilakukan Penanganan</span></li>
                  </div>
                  <div>
                    <li><span class="font-bold">Ketika penanganan gangguan telah <a href="#" class="btn btn-xs btn-success">Selesai</a>, Secara otomatis data hilang dari tabel</span></span></li>
                  </div>
                  <div>
                    <li><span class="font-bold">Lakukan penanganan secepat mungkin, agar tidak ada antrian pengaduan</span></li>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="<?php echo base_url('assets/inspinia271/js/jquery-3.1.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/inspinia271/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/inspinia271/js/plugins/metisMenu/jquery.metisMenu.js') ?>"></script>
    <script src="<?php echo base_url('assets/inspinia271/js/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>

    <script src="<?php echo base_url('assets/inspinia271/js/inspinia.js') ?>"></script>
    <script src="<?php echo base_url('assets/inspinia271/js/plugins/pace/pace.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/inspinia271/js/plugins/ticker/ticker.js') ?>"></script>
    <script type="text/javascript">

    $(document).ready(function(){
      table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
          url: "<?php echo site_url('pengaduan/view_list')?>",
          type: "POST"
        },
        columnDefs: [
        {
          targets: [ -1 ],
          orderable: false,
        },
        ],
        pageLength: 7,
      });
    });

    $(function(){
      startRefresh();
    });

    function startRefresh() {
      setTimeout(startRefresh,60000);
      table.ajax.reload(null,false);
    }
    </script>

  </body>
</html>
