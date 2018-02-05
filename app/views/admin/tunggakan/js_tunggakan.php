<script src="<?php echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script>
<!-- <script src="<?php //echo base_url('assets/inspinia271/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script> -->
<!-- <script src="<?php //echo base_url('assets/inspinia271/js/plugins/bootstrapTour/bootstrap-tour.min.js') ?>"></script> -->
<!-- <script src="<?php //echo base_url('assets/inspinia271/js/plugins/select2/select2.full.min.js') ?>"></script> -->
<!-- <script type="text/javascript" src="<?php //echo base_url('assets/instascan/app.js')?>"></script> -->

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
// dataTables
// $("#table").DataTable({});
});

// InstaScan QRCode
  // let scanner = new Instascan.Scanner({
  //   video: document.getElementById('preview'),
  //   scanPeriod: 10
  // });
  // scanner.addListener('scan', function (content) {
  //   getDetail(content,'hash');
  // });
  // Instascan.Camera.getCameras().then(function (cameras) {
  //   if (cameras.length > 0) {
  //     scanner.start(cameras[0]);
  //     $("#listCamera").html("<h4 class='font-bold text-success'>"+cameras[0].name+"</h4>");
  //   } else {
  //     $("#listCamera").html("<h4 class='font-bold text-danger'>No cameras found</h4>");
  //     // console.error('No cameras found.');
  //   }
  // }).catch(function (e) {
  //   console.error(e);
  // });

  // var scannedQR = [];

  function getData()
  {
    $(".tampil").hide();
    str = $("[name='kode_invoice']").val();
    $.ajax({
      url : "<?php echo site_url('Api_search/cek_tunggakan') ?>",
      type : "POST",
      data : {"cek" : str},
      dataType : "JSON",
      success : function(data)
      {
        if (data.detail_pelanggan != null) {
          $("#tableTunggakan").html(data.tunggakan);
          $("#tableLastPembayaran").html(data.pembayaran_terakhir);
          $("#total").text(data.total_tunggakan);
          // Menampilkan Detail Pelanggan
          $(".v1").text(data.detail_pelanggan.kode_pelanggan);
          $(".v2").text("Rp. "+data.total_tunggakan+",-");
          $(".v3").text(data.detail_pelanggan.nama_lengkap);
          $(".v4").text(data.detail_pelanggan.alamat+" | ");
          $(".v5").text(data.detail_pelanggan.wilayah);
          $(".v6").text(data.detail_pelanggan.status);
          $(".tampil").show();
        } else {
          notif("Tidak Ada!","Transaksi/Kode Pelanggan tidak terdaftar pada sistem! atau tunggakan bulan ini LUNAS","warning");
        }
      },
      error : function(jqXHR,errorThrown,textStatus)
      {
        alert('error getting data from server!'+textStatus);
      }
    });
  }

  // function save()
  // {
  //   if(confirm('Apakah semua setoran hari ini sudah diinput pada tabel? \nSetoran Anda akan dibukukan.'))
  //   {
  //     $.ajax({
  //       url : "<?php echo site_url('kwitansi/setor') ?>",
  //       type : "POST",
  //       data : $("#formScanned").serialize(),
  //       dataType : "JSON",
  //       success : function(data)
  //       {
  //         if (data.status)
  //         {
  //           notif('Berhasil menyimpan setoran!','Sukses','success');
  //           delAlltr();
  //         } else
  //         {
  //           notif('Gagal menyimpan setoran!','Gagal','error');
  //         }
  //       },
  //       error : function(jqXHR,errorThrown,textStatus) {
  //         alert('error sending data to server!'+textStatus);
  //       }
  //     });
  //   }
  // }

  function setUpper()
  {
    var kode = $("[name='kode_invoice']").val().toUpperCase();
    $("[name='kode_invoice']").val(kode);
  }


</script>
</body>

</html>
