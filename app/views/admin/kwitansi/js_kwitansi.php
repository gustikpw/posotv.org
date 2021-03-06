<script src="<?php echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/bootstrapTour/bootstrap-tour.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/select2/select2.full.min.js') ?>"></script>

<script>
$('.date').datepicker({
    minViewMode: 1,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
    format: "yyyy-mm"
});
var wilayah = $('[name="wilayah"]').select2({
  placeholder : "Pilih Wilayah",
  width : "100%"
});

var table;
$(document).ready(function(){
  $('.btnFokus').focus(); // fokus ke field ketika tombol tambah di klik
  // Instance the tour
        var tour = new Tour({
            steps: [{
                    element: "#step0",
                    title: "Pengenalan",
                    content: "Panel ini digunakan untuk registrasi/mendaftarkan tagihan pelanggan ke sistem dan di-generate dalam bentuk kwitansi pdf.<br>"+
                    "<span class='font-bold'>Tips :</span><dd>Registrasi sebaiknya dilakukan setiap awal bulan sebelum penagihan berjalan.</dd>",
                    placement: "right",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#step1",
                    title: "Bulan Penagihan",
                    content: "Silahkan pilih <span class='font-bold'>Bulan dan Tahun penagihan</span>",
                    placement: "top",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#step2",
                    title: "Wilayah Pelanggan",
                    content: "Silahkan pilih <span class='font-bold'>Wilayah penagihan</span> sesuai pelanggan berdomisili",
                    placement: "top"
                },
                {
                    element: "#step3",
                    title: "Sandi Keamanan",
                    content: "Untuk menjaga keaman, kami melakukan limit akses terhadap fitur ini. Silahkan masukan <span class='font-bold'>Sandi/Password</span> untuk generate kwitansi",
                    placement: "bottom",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#step4",
                    title: "Registrasi Invoice",
                    content: "Jika semua field terisi, <span class='font-bold'>Klik</span> tombol <span class='font-bold'>Registrasi Invoice</span> dibawah",
                    placement: "top",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: ".step5",
                    title: "Pengenalan",
                    content: "Panel ini digunakan untuk menampilkan kwitansi yang telah diregistrasi/didaftarkan pada tagihan pelanggan kedalam bentuk kwitansi pdf.<br>"+
                    "<span class='font-bold'>Klik</span><dd> View | Download | Delete.</dd>",
                    placement: "left",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
            ]});

        // Initialize the tour
        tour.init();

        $('.startTour').click(function(){
            tour.restart();

            // Start the tour
            // tour.start();
        })
});

</script>

<script>
var tabel, start_time;
$(document).ready(function(){
   tabel = $('#table').DataTable({
      ajax : {
         url : "<?php echo site_url('kwitansi/files2')?>"
      },
      order: [ 1, "desc" ],
      columnDefs:[
         {
            targets: [ -1 ],
            orderable: false
         }
      ]
   });
});

$(function(){
  getSelect();
  // files();
});

function getSelect() {
  $('[name="wilayah"]').load("<?php echo site_url('getselect/pilih_mul/wilayah/kode_wilayah/wilayah')?>");
}

function regInvoice()
{
  if(confirm('Data Invoice "'+wilayah.val()+'" Bulan Penagihan : "'+$('[name="bulan_penagihan"]').val()+'" akan didaftarkan ke sistem. Yakin?'))
  {
    $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
    $.ajax({
        url : "<?php echo site_url('kwitansi/createInvCode')?>",
        data : $('#formKwitansi').serialize(),
        type: "POST",
        dataType: "JSON",
        beforeSend : function(){
          // Menampilkan waktu loading
          start_time = new Date().getTime();
        },
        success: function(data) {
          // Time load ajax
          request_time = new Date().getTime() - start_time;
          time_msg = data.pesan + ' Waktu : '+ waktu(request_time) +' detik';
          notif(time_msg,data.title,data.msgtype);
          // $('[name="bulan_penagihan"]').val('');
          wilayah.val('').trigger('change');
          reload_table();
          $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
      },
      error: function (jqXHR, textStatus, errorThrown) {
         $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
        notif('Gagal mengambil data! <br>'+textStatus,'Error','error');
      }
    });
  }
}

function hapusFile(id)
{
  if (confirm('Yakin menghapus kwitansi '+id+'? \nTagihan ini telah terdaftar di database dan akan terhapus!')) {
    $.ajax({
      url : "<?php echo site_url('kwitansi/hapusFile/')?>"+id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        if (data.status) {
          notif('Berhasil menghapus kwitansi!','Sukses','warning');
          reload_table()
        } else {
          notif('Gagal menghapus data!','Error','error');
          reload_table()
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        notif('Gagal menghapus data!','Error','error');
      }
    });
  }
}

function deleteChache() {
     $.ajax({
       url : "<?php echo site_url('kwitansi/hapusTempAll')?>",
       type: "POST",
       dataType: "JSON",
       success: function(data) {
         if (data.status) {
           notif('Berhasil menghapus cache kwitansi!','Sukses','warning');
           reload_table();
         }
       },
       error: function (jqXHR, textStatus, errorThrown) {
         notif('Gagal menghapus cache!','Error','error');
       }
     });
}

function waktu(mili) {
  var menit = Math.floor(mili / 60000);
  var detik = ((mili % 60000) / 1000).toFixed(0);
  res = menit + ":" + (detik < 10 ? '0' : '') + detik;
  return res;
}

function reload_table() {
   tabel.ajax.reload(null,false);
}
</script>
</body>

</html>
