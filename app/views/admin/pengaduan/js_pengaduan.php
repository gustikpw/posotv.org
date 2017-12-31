<script src="<?php echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/bootstrapTour/bootstrap-tour.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/select2/select2.full.min.js') ?>"></script>
<!-- <script src="<?php //echo base_url('assets/inspinia271/js/plugins/chosen/chosen.jquery.js') ?>"></script> -->

<script>
// $('.itemName').select2({
//   placeholder: '--- Select Item ---',
//   width : "100%",
//   dropdownParent : $('#myModal'),
//   ajax: {
//     url: "<?php //echo site_url('Api_search/cari_plgn')?>",
//     dataType: 'json',
//     delay: 350,
//     processResults: function (data) {
//       return {
//         results: data
//       };
//     },
//     cache: true
//   }
// });

$(function(){
  getSelect();
});

function getSelect() {
  $('[name="kode_pelanggan"]').load("<?php echo site_url('getselect/pilih_mul_dua/pelanggan/id_pelanggan/kode_pelanggan/nama_lengkap')?>");
  $('[name="jenis_gangguan"]').load("<?php echo site_url('getselect/pilih_mul/jenis_gangguan/id_jenis_gangguan/jenis_gangguan')?>");
  $('[name="prioritas"]').load("<?php echo site_url('getselect/get_enum_values/pengaduan/prioritas')?>");
}

// ------------
var kode_pelanggan = $('[name="kode_pelanggan"]').select2({
  placeholder: '--- Kode Pelanggan / Nama Lengkap ---',
  width : "100%",
  dropdownParent : $('#myModal'),
  ajax: {
    url: "<?php echo site_url('Api_search/cari_plgn')?>",
    dataType: 'json',
    delay: 350,
    processResults: function (data) {
      return {
        results: data.items
      };
    },
    cache: true
  },
  // tambahan untuk template
  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
  minimumInputLength: 1,
  templateResult: formatRepo,
  templateSelection: formatRepoSelection
});


function formatRepo (repo) {
  // console.log(repo);
  if (repo.loading) {
    return repo.text;
  }

  var markup = "<div class='select2-result-repository clearfix'>" +
    "<div class='select2-result-repository__avatar'><span class='fa fa-camera fa-4x'><span></div>" +
    "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'>" + repo.items_detail.kode + "</div>";

  if (repo.items_detail.nama) {
    markup += "<div class='select2-result-repository__description'>" + repo.items_detail.nama + "</div>";
  }

  markup += "<div class='select2-result-repository__statistics'>" +
    "<small><i class='fa fa-map'></i> " + repo.items_detail.wilayah + "</small>," +
    " <small><i class='fa fa-location'></i> " + repo.items_detail.alamat + "</small>" +
    " <span class='pull-right'><small><i class='fa fa-circle-o'></i> " + repo.items_detail.status + "</small></span>" +
    "</div>" +
    "</div></div>";

  return markup;
}

function formatRepoSelection (repo) {
  return repo.nama || repo.text;
}

// ------------



var jenis_gangguan = $('[name="jenis_gangguan"]').select2({
  placeholder : "Pilih Jenis Gangguan",
  width : "100%",
  dropdownParent : $('#myModal')
});

var prioritas = $('[name="prioritas"]').select2({
  placeholder : "Pilih Prioritas Pelayanan",
  width : "100%",
  dropdownParent : $('#myModal')
});

var table;
$(document).ready(function(){
  $('.btnFokus').focus(); // fokus ke field ketika tombol tambah di klik
  $('.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      format: "yyyy/mm/dd"
  });

  table = $('#table').DataTable({
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('pengaduan/ajax_list')?>",
        "type": "POST"
    },
    //Set column definition initialisation properties.
    "columnDefs": [
    {
        "targets": [ -1 ], //last column
        "orderable": false, //set not orderable
    },
    ],

      // pageLength: 25,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [
          { extend: 'copy'},
          {extend: 'csv'},
          {extend: 'excel', title: '<?php echo $active; ?>'},
          {extend: 'pdf', title: '<?php echo $active; ?>'},

          {extend: 'print',
           customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');

                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');
          }
          }
      ]

  });

  $("input").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
  });
  $("textarea").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
  });
  // $("select").change(function(){
  //     $(this).parent().parent().removeClass('has-error');
  //     $(this).next().empty();
  // });

  // Instance the tour
        var tour = new Tour({
            steps: [{
                    element: "#step1",
                    title: "Klik Tambah Data",
                    content: "Introduce new users to your product by walking them through it step by step.",
                    placement: "bottom"
                },
                {
                    element: "#step2",
                    title: "Isi data dengan benar",
                    content: "Content of my step",
                    placement: "top"
                },
                {
                    element: ".step3",
                    title: "Klik Tombol Simpan",
                    content: "Introduce new users to your product by walking them through it step by step.",
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
                    title: "Data baru berhasil ditambahkan pada tabel",
                    content: "Introduce new users to your product by walking them through it step by step.",
                    placement: "top"
                }
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

<script type="text/javascript">
var save_method;

function reload_table(){
  table.ajax.reload(null,false); //reload datatable ajax
}


function adds()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('[name="id_pengaduan"]').val('');
    $('#myModal').modal('show'); // show bootstrap modal
    $('.help-block').empty();
    $('.fokus').focus();
    $('.modal-title').text('Add <?php echo ucwords(str_replace('_',' ',$active)); ?>'); // Set Title to Bootstrap modal title
}

function save()
{
  // $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
  $('#btnSave').text('Saving...'); //change button text
  $('#btnSave').attr('disabled',true); //set button disable
  var url;
  if(save_method == 'add') {
    url = "<?php echo site_url('pengaduan/save_pengaduan')?>";
  } else {
    url = "<?php echo site_url('pengaduan/update_pengaduan')?>";
  }
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
        $('#myModal').modal('hide');
        reload_table();
        $('.btnFokus').focus();
        notif('Berhasil menambah/edit data!','Sukses','success');
      } else {
        for (var i = 0; i < data.inputerror.length; i++)
        {
            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
        }
      }
      $('#btnSave').text('Save changes'); //change button text
      $('#btnSave').attr('disabled',false); //set button enable
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      notif('Gagal mengUpdate data!','Error','error');
      $('#btnSave').text('Save changes'); //change button text
      $('#btnSave').attr('disabled',false); //set button enable
    }
  });
}

function edits(id)
{
  save_method = 'update';
  $('#form')[0].reset(); // reset form on modals
  $.ajax({
      url : "<?php echo site_url('pengaduan/get_edit/')?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_pengaduan"]').val(data.id_pengaduan);
        kode_pelanggan.val(data.kode_pelanggan).trigger('change');
        prioritas.val(data.prioritas).trigger('change');
        jenis_gangguan.val(data.jenis_gangguan).trigger('change');
        $('[name="tgl_lapor"]').val(data.tgl_lapor);
        $('[name="tgl_gangguan"]').val(data.tgl_gangguan);
        $('[name="keterangan"]').val(data.keterangan);
        $('#myModal').modal('show');
        $('.modal-title').text('Edit <?php echo ucwords(str_replace('_',' ',$active)); ?>');
    },
    error: function (jqXHR, textStatus, errorThrown) {
      notif('Gagal mengambil data!','Error','error');
    }
  });
}

function deletes(id)
{
  if(confirm('Are you sure delete this data?'))
  {
    $.ajax({
      url : "<?php echo site_url('pengaduan/delete_pengaduan')?>/"+id,
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        notif('Berhasil menghapus data!','Sukses','success');
        reload_table();
        $('.btnFokus').focus();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        notif('Gagal menghapus data!','Error','error');
      }
    });

  }
}

function views(id)
{
  $.ajax({
      url : "<?php echo site_url('pengaduan/vget_edit/')?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('.v1').text(data.kode_pelanggan);
        $('.v2').text(data.nama_lengkap);
        $('.v3').text(data.wilayah);
        $('.v4').text(data.alamat);
        $('.v5').html(data.status);
        $('.v6').html(data.prioritas);
        $('.v7').text(data.tgl_gangguan);
        $('.v8').text(data.tgl_lapor);
        $('.v9').text(data.jenis_gangguan);
        $('.v10').text(data.keterangan);
        $('#DetailModal').modal('show');
        $('.modal-title').text('Detail <?php echo ucwords(str_replace('_',' ',$active)); ?>');
    },
    error: function (jqXHR, textStatus, errorThrown) {
      notif('Gagal mengambil data!','Error','error');
    }
  });
}


</script>
</body>

</html>
