<script src="<?php echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/bootstrapTour/bootstrap-tour.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/select2/select2.full.min.js') ?>"></script>
<!-- <script src="<?php //echo base_url('assets/inspinia271/js/plugins/chosen/chosen.jquery.js') ?>"></script> -->

<script>
var pilih2 = $(".select2_demo_2").select2({
  dropdownParent: $('#updateModal'),
  placeholder : "Silahkan Pilih Teknisi",
  width : "100%",
  allowClear : true
});
var table;
$(document).ready(function(){
  // $('.btnFokus').focus(); // fokus ke field ketika tombol tambah di klik
  $('.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      format: "yyyy-mm-dd"
  });

  table = $('#table').DataTable({
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('Perbaikan_gangguan/ajax_list')?>",
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

<script>
$(function(){
  getSelect();
});

function getSelect() {
  $('[name="teknisi[]"]').load("<?php echo site_url('getselect/pilih_mul/karyawan/id_karyawan/nama_lengkap')?>");
  $('[name="status_aduan"]').load("<?php echo site_url('getselect/get_enum_values/pengaduan/status_aduan')?>");
}
var save_method;

function reload_table(){
  table.ajax.reload(null,false); //reload datatable ajax
}


// function adds()
// {
//     save_method = 'add';
//     $('#form')[0].reset(); // reset form on modals
//     $('[name="id_pengaduan"]').val('');
//     $('#myModal').modal('show'); // show bootstrap modal
//     $('.help-block').empty();
//     $('.fokus').focus();
//     $('.modal-title').text('Add <?php echo ucwords(str_replace('_',' ',$active)); ?>'); // Set Title to Bootstrap modal title
// }

function save()
{
  // $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
  $('#btnSave').text('Saving...'); //change button text
  $('#btnSave').attr('disabled',true); //set button disable

  // ajax adding data to database
  $.ajax({
    url : "<?php echo site_url('Perbaikan_gangguan/update_pengaduan')?>",
    type: "POST",
    data: $('#formUpdate1').serialize(),
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
  $('#formUpdate')[0].reset(); // reset form on modals
  $.ajax({
      url : "<?php echo site_url('Perbaikan_gangguan/get_edit/')?>" + id,
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
        $('[name="id_pengaduan"]').val(data.id_pengaduan);
        $('[name="tgl_perbaikan"]').val(data.tgl_perbaikan).focus();
        pilih2.val(data.teknisi).trigger("change"); // menampilkan data yang dipilih ke select2
        $('[name="sebab"]').val(data.sebab);
        $('[name="tindakan"]').val(data.tindakan);
        $('[name="status_aduan"]').val(data.status_aduan);
        $('#updateModal').modal('show');
        $('.modal-title').text('Edit <?php echo ucwords(str_replace('_',' ',$active)); ?>');
        $('[name="tgl_perbaikan"]').focus();
        // $('#panel_detailku').slideToggle();
        // $('.judul').text("Detail <?php //echo ucwords(str_replace('_',' ',$active)) ?>");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      notif('Gagal mengambil data!','Error','error');
    }
  });
}

function views(id)
{
  $.ajax({
      url : "<?php echo site_url('Perbaikan_gangguan/get_edit/')?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('.v1').text(data.id_pengaduan);
        $('.v2').text(data.kode_pengaduan);
        $('.v3').text(data.nama_lengkap);
        $('.v4').text(data.bagian);
        $('.v5').text(data.jabatan);
        $('.v6').text(data.status);
        $('.v7').text(data.tgl_masuk);
        $('.v8').text(data.tgl_berakhir);
        $('.v9').text(data.no_ktp);
        $('.v10').text(data.alamat);
        $('.v11').text(data.telp);
        // $('#DetailModal').modal('show');
        // $('.modal-title').text('Detail <?php echo ucwords(str_replace('_',' ',$active)); ?>');
        $('#formUpdate1')[0].reset();
        $('#panel_detailku').slideToggle();
        $('.judul').text('Detail <?php echo ucwords(str_replace('_',' ',$active)); ?>');
    },
    error: function (jqXHR, textStatus, errorThrown) {
      notif('Gagal mengambil data!','Error','error');
    }
  });
}
</script>
</body>

</html>
