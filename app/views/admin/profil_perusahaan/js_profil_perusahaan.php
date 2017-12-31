<script type="text/javascript">
var save_method;
$(document).ready(function(){
  notif(isiPesan='Silahkan menggunakan fitur ini!',jdlPesan='Selamat datang di POSO TV App',msgType='success');
});

function viewProfil(id) {
  $.ajax({
    url : "<?php echo site_url('profil_perusahaan/get')?>/"+id,
    type: "POST",
    dataType: "JSON",
    success: function(data) {
      $('.p1').html('<b>'+data.nama_perusahaan+'</b>');
      $('.p2').html(data.alias);
      $('.p3').html(data.slogan);
      $('.p4').html(data.alamat);
      $('.p5').html(data.email);
      $('.p6').html(data.telp);
      $('.p7').html(data.kodepos);
      $('.p8').attr("href",data.facebook);
      $('.p9').attr("href",data.youtube);
      $('.p11').html(data.logo);
      // $('.p11').html(data.sosmed);
      $('.p12').html(data.id_profil);
      $('#modal_detail').modal('show');
    },
    error: function (jqXHR, textStatus, errorThrown) {
      notif(isiPesan='Gagal mengambil data Profil Perusahaan!',jdlPesan='Error',msgType='error');
    }
  });
}

function save()
{
  $('#btnSave').text('Saving...'); //change button text
  $('#btnSave').attr('disabled',true); //set button disable
  var url;
  url = "<?php echo site_url('profil_perusahaan/update_profil_perusahaan')?>";

  // ajax adding data to database
  $.ajax({
    url : url,
    type: "POST",
    data: $('#form').serialize(),
    dataType: "JSON",
    success: function(data)
    {
      if(data.status) //if success close modal and reload ajax table
      {
          $('#modal_form').modal('hide');
          viewProfil(1);
          notif(isiPesan='Berhasil mengUpdate data!',jdlPesan='Sukses',msgType='success');
      }
      $('#btnSave').text('save'); //change button text
      $('#btnSave').attr('disabled',false); //set button enable
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      notif(isiPesan='Gagal mengUpdate data!',jdlPesan='Error',msgType='error');
      $('#btnSave').text('Save'); //change button text
      $('#btnSave').attr('disabled',false); //set button enable
    }
  });
}

function editProfil(id)
{
  save_method = 'update';
  $('#form')[0].reset(); // reset form on modals
  $.ajax({
      url : "<?php echo site_url('profil_perusahaan/get/')?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_profil"]').val(data.id_profil);
        $('[name="nama_perusahaan"]').val(data.nama_perusahaan);
        $('[name="alias"]').val(data.alias);
        $('[name="slogan"]').val(data.slogan);
        $('[name="alamat"]').val(data.alamat);
        $('[name="telp"]').val(data.telp);
        $('[name="email"]').val(data.email);
        $('[name="kodepos"]').val(data.kodepos);
        $('[name="facebook"]').val(data.facebook);
        $('[name="youtube"]').val(data.youtube);
        $('[name="sosmed"]').val(data.sosmed);
        $('#modal_form').modal('show');
        $('.modal-title').text('Edit Profil Perusahaan');
    },
    error: function (jqXHR, textStatus, errorThrown) {
      notif(isiPesan='Gagal mengambil data Profil Perusahaan!',jdlPesan='Error',msgType='error');
    }
  });
}


</script>
</body>

</html>
