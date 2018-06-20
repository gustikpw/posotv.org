<script src="<?php echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
// dataTables
// $("#table").DataTable({});
});

// InstaScan QRCode
  let scanner = new Instascan.Scanner({
    video: document.getElementById('preview'),
    scanPeriod: 10
  });
  scanner.addListener('scan', function (content) {
    getDetail(content,'hash');
  });
  Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
      var selectedCam = cameras[0];
      scanner.start(selectedCam);
      $("#listCamera").html("<h4 class='font-bold text-success'>"+selectedCam.name+"</h4>");
    } else {
      $("#listCamera").html("<h4 class='font-bold text-danger'>No cameras found</h4>");
      // console.error('No cameras found.');
    }
  }).catch(function (e) {
    // console.error(e);
    alert(e);
  });

  // var self = this;
  // self.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
  // Instascan.Camera.getCameras().then(function (cameras) {
  //   self.cameras = cameras;
  //   if (cameras.length > 0) {
  //     alert(cameras);
  //     self.activeCameraId = cameras[0].id;
  //     self.scanner.start(cameras[0]);
  //     $("#listCamera").html("<h4 class='font-bold text-success'>"+cameras[0].name+"</h4>");
  //   } else {
  //     // console.error('No cameras found.');
  //     alert('No cameras found.');
  //   }
  // }).catch(function (stream) {
  //   // console.error(e);
  //   alert(stream);
  // });


  // var app = new Vue({
  //   el: '#app',
  //   data: {
  //     scanner: null,
  //     activeCameraId: null,
  //     cameras: [],
  //     scans: []
  //   },
  //   mounted: function () {
  //     var self = this;
  //     self.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
  //     self.scanner.addListener('scan', function (content, image) {
  //       self.scans.unshift({ date: +(Date.now()), content: content });
  //     });
  //     Instascan.Camera.getCameras().then(function (cameras) {
  //       self.cameras = cameras;
  //       if (cameras.length > 0) {
  //         self.activeCameraId = cameras[0].id;
  //         self.scanner.start(cameras[0]);
  //       } else {
  //         console.error('No cameras found.');
  //       }
  //     }).catch(function (e) {
  //       console.error(e);
  //     });
  //   },
  //   methods: {
  //     formatName: function (name) {
  //       return name || '(unknown)';
  //     },
  //     selectCamera: function (camera) {
  //       this.activeCameraId = camera.id;
  //       this.scanner.start(camera);
  //     }
  //   }
  // });










  var scannedQR = [];
  var hash = "";
  var ada = false;
  var cekMethod;
  var total_setoran = 0;

  function getDetail(id,cekMethod)
  {
    var url;
    if (cekMethod == 'hash') {
      url = "<?php echo site_url('kwitansi/getDetailTagihan/') ?>" +id;
    } else if (cekMethod == 'invoiceCode') {
      id = $("[name='kode_invoice']").val();
      url = "<?php echo site_url('kwitansi/getDetailTagihan/') ?>" +id;
    }

    $.ajax({
      url : url,
      type : "GET",
      dataType : "JSON",
      success : function(data)
      {
        cekHash(id);
        if (data.data != "")
        {
          if (ada == false)
          {
            $("#noData").hide();
            scannedQR.push(data.hash);
            $("#dataScanned").prepend(data.data);
            $("[name='kode_invoice']").val("");
            hitung_total('tambah',data.tarif);
          } else if (ada == true)
          {
            alert('Kwitansi sudah di-input sebelumnya.\nCek tabel!');
          }
        } else
        {
          alert('Kwitansi ini tidak terdaftar!');
        }
      },
      error : function(jqXHR,errorThrown,textStatus)
      {
        alert('error getting data from server!'+textStatus);
      }
    });
  }

  function cekHash(value)
  {
    for (var i = 0; i < scannedQR.length; i++)
    {
      if (scannedQR[i] == value)
      {
        ada = true;
        break;
      } else
      {
        ada = false;
      }
    }
  }

  function save()
  {
    if(confirm('Apakah semua setoran hari ini sudah diinput pada tabel? \nSetoran Anda akan dibukukan.'))
    {
      $.ajax({
        url : "<?php echo site_url('kwitansi/setor') ?>",
        type : "POST",
        data : $("#formScanned").serialize(),
        dataType : "JSON",
        success : function(data)
        {
          if (data.status)
          {
            notif('Berhasil menyimpan setoran!','Sukses','success');
            delAlltr();
          } else
          {
            notif('Gagal menyimpan setoran!','Gagal','error');
          }
        },
        error : function(jqXHR,errorThrown,textStatus) {
          alert('error sending data to server!'+textStatus);
        }
      });
    }
  }

  function setUpper()
  {
    var kode = $("[name='kode_invoice']").val().toUpperCase();
    $("[name='kode_invoice']").val(kode);
  }

  function addKet(value)
  {
    $("."+value).toggle();
  }

  function delAlltr()
  {
    if (confirm('Yakin Hapus semua setoran ini?'))
    {
      scannedQR.splice(0,scannedQR.length+1);
      $("td").parents("tr").remove();
      $("#dataScanned").prepend("<tr id=\"noData\"><td colspan=\"9\" class=\"text-center text-danger\"><h3>Tidak ada data! Silahkan Scan Robekan Kwitansi pada Kamera!</h3></td></tr>");
      // console.log(scannedQR);
      total_setoran = 0;
      $("#t_setoran").text("Rp. "+total_setoran);
    }
  }

  function hapusTr(value)
  {
    hitung_total('kurang', $('#'+value).val() );
    for (var i = 0; i < scannedQR.length; i++)
    {
      if (scannedQR[i] == value)
      {
        delete scannedQR[i];
        $("."+value).remove();
        // console.log(scannedQR);
      }
    }
  }

  function hitung_total(operator,tarif){
    if (operator == 'tambah') {
      total_setoran += tarif*1;
    } else if(operator == 'kurang'){
      total_setoran -= tarif*1;
    }
    $("#t_setoran").text("Rp. "+total_setoran);
  }


</script>
</body>

</html>
