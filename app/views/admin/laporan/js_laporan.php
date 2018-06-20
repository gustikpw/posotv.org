<!-- <script src="<?php //echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script> -->
<script src="<?php echo base_url('assets/inspinia271/js/plugins/bootstrapTour/bootstrap-tour.min.js') ?>"></script>

<script>
var table;
$(document).ready(function(){
  my_init();
});

function editTerms(val) {
  $("[name='"+val+"']").toggle();
  $("[name='"+val+"']").toggleClass("form-control");
  // $("span").toggle();
  // $("[name='"+val+"']").text();
}

function save_settings(option) {
  if (option == 'invoice_key') {
    url = "<?=site_url('App_settings/save_settings/invoice_key')?>";
    opdata = $('#form_inv_key').serialize();
  } else if (option == 'surat_pemutusan') {
    url = "<?=site_url('App_settings/save_settings/surat_pemutusan')?>";
    opdata = $('#form_surat').serialize();
  } else if (option == 'invoice_terms') {
    url = "<?=site_url('App_settings/save_settings/invoice_terms')?>";
    opdata = $('#form_terms').serialize();
  }

  $.ajax({
    url : url,
    type : "POST",
    data : opdata,
    dataType : "JSON",
    success : function(data){
      notif('Setting saved!','Success','success');
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      notif('Gagal mengUpdate data!','Error','error');
    }
  });
}

function my_init() {
  $.ajax({
      url : "<?=site_url('App_settings/call_settings')?>",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        t = data.surat; s = data.terms;
        // Surat
        $('[name="perihal"]').val(t.perihal);
        $('[name="pembuka"]').val(t.pembuka);
        $('[name="ket1"]').val(t.ket1);
        $('[name="penutup"]').val(t.penutup);
        $('[name="pimpinan"]').val(t.pimpinan);
        $('[name="jabatan"]').val(t.jabatan);
        // invoice terms
        $('[name="batas"]').val(s.batas);
        $('[name="info1"]').val(s.info1);
        $('[name="info2"]').val(s.info2);
        $('[name="info3"]').val(s.info3);
        $('[name="info4"]').val(s.info4);
        $('[name="info5"]').val(s.info5);
        $('[name="info6"]').val(s.info6);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      notif('Gagal mengambil data Surat!','Error','error');
    }
  });
}

// function get_surat() {
//   $.ajax({
//       url : "<//?=site_url('pemutusan/get_surat')?>",
//       type: "GET",
//       dataType: "JSON",
//       success: function(data) {
//         $('[name="perihal"]').val(data.perihal);
//         $('[name="pembuka"]').val(data.pembuka);
//         $('[name="ket1"]').val(data.ket1);
//         $('[name="penutup"]').val(data.penutup);
//         $('[name="pimpinan"]').val(data.pimpinan);
//         $('[name="jabatan"]').val(data.jabatan);
//     },
//     error: function (jqXHR, textStatus, errorThrown) {
//       notif('Gagal mengambil data Surat!','Error','error');
//     }
//   });
// }

function validasi() {
  newpass = $("[name='invoice_key_new']").val();
  repeat = $("[name='repeat']").val();
  if (newpass != repeat) {
    $('[name="repeat"]').parent().addClass('has-error');
    $('[name="repeat"]').next().text('Sandi baru tidak sesuai!');
    $('#saveSandi').attr('disabled',true);
  } else {
    $('[name="repeat"]').parent().removeClass('has-error');
    $('[name="repeat"]').parent().addClass('has-success');
    $('[name="repeat"]').next().text('Sandi baru cocok!');
    $('#saveSandi').attr('disabled',false);
  }

  if (repeat == '') {
    $("[name='invoice_key_new']").attr('disabled',false);
  } else {
    $("[name='invoice_key_new']").attr('disabled',true);
  }
}
</script>
</body>

</html>
