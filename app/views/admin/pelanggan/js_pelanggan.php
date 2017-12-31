<script src="<?php echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/bootstrapTour/bootstrap-tour.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/select2/select2.full.min.js') ?>"></script>
<!-- <script src="<?php //echo base_url('assets/inspinia271/js/plugins/chosen/chosen.jquery.js') ?>"></script> -->

<script>
var save_method, wilMethod, pdf_data;

$(function(){
  getSelect();
});

function getSelect() {
  $('[name="wilayah"]').load("<?php echo site_url('getselect/pilih_mul/wilayah/id_wilayah/wilayah')?>");
  $('[name="tarif"]').load("<?php echo site_url('getselect/pilih_mul_dua/tarif/id_tarif/tarif/keterangan')?>");
  $('[name="status"]').load("<?php echo site_url('getselect/pilih_mul/status/id_status/status')?>");
}

var wilayah = $('[name="wilayah"]').select2({
  placeholder : "Pilih Wilayah Pelanggan Berdomisili",
  width : "100%",
  // dropdownParent : $('.myModal')
});
var tarif = $('[name="tarif"]').select2({
  placeholder : "Pilih Jenis Tarif",
  width : "100%",
  // dropdownParent : $('#myModal')
});
var zstatus = $('[name="status"]').select2({
  placeholder : "Pilih Status Berlangganan",
  width : "100%",
  // dropdownParent : $('#myModal')
});

var table,pdfdata;
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

  $("[name='wilayah']").on("change", function () {
    if (save_method=='add') {
      getCode(wilayah.val());
    } else if (save_method=='update' && wilMethod=='on') {
      getCode(wilayah.val());
    }
  });

  table = $('#table').DataTable({
    processing: true, //Feature control the processing indicator.
    serverSide: true, //Feature control DataTables' server-side processing mode.
    order: [], //Initial no order.
    // Load data for the table's content from an Ajax source
    ajax: {
        url: "<?php echo site_url('pelanggan/ajax_list')?>",
        type: "POST",
        data : function ( d ) {
           pdf_data = d;
        }
    },
      scrollY:        "500px",
      // scrollX:        true,
      scrollCollapse: true,
      // paging:         false,
      fixedColumns:   true,
    //Set column definition initialisation properties.
    columnDefs: [
       {
         visible: false,
         targets: [ 3 ], //last column
         // orderable: false, //set not orderable
       },
       {
         targets: [ 0,-1 ], //last column
         orderable: false, //set not orderable
       },
    ],

    // Grouping
      drawCallback: function ( settings ) {
         var api = this.api();
         var rows = api.rows( {page:'current'} ).nodes();
         var last=null;

         api.column(3, {page:'current'} ).data().each( function ( group, i ) {
             if ( last !== group ) {
                 $(rows).eq( i ).before(
                     '<tr class="group bg-info"><td colspan="9" class="font-bold">'+group+'</td></tr>'
                 );

                 last = group;
             }
         } );
      },

      // pageLength: 25,
      // responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [
          // { extend: 'copy'},
          { text: 'PDFku',
             action: function ( e, dt, node, config) {
                tespdf();
             }
          },
          {extend: 'csv'},
          {extend: 'excel', title: '<?php echo $active; ?>'},
          {extend: 'pdf', title: '<?php echo $active; ?>',
            exportOptions: {
              columns: [ 1,2,3,4,5,6,7 ]
            }
          },

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

/* Untuk fpdf
 *
 */
   // table.on( 'xhr', function ( e, dt, settings, json ) {
   //    console.log(dt);
   // });



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

function tespdf() {
   $.ajax({
       url : "http://localhost/posotv.org/pelanggan/exportpdf",
       type: "POST",
       data : pdf_data,
       dataType: "JSON",
       success: function(data) {
         console.log(data);
     }
   });
}

function reload_table(){
  table.ajax.reload(null,false); //reload datatable ajax
}

function getCode(wil) {
  $.ajax({
      url : "<?php echo site_url('pelanggan/getCode/')?>" + wil,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="kode_pelanggan"]').val(data.newCode).attr("readonly","true");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      notif('Gagal mengambil Kode Pelanggan Baru! \n'+errorThrown,'Error','error');
    }
  });
}

function adds()
{
    save_method = 'add';
    wilMethod='on';
    $('#form')[0].reset(); // reset form on modals
    $('[name="id_pelanggan"]').val('');
    wilayah.val('');
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
    url = "<?php echo site_url('pelanggan/save_pelanggan')?>";
  } else {
    url = "<?php echo site_url('pelanggan/update_pelanggan')?>";
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
      notif('Gagal mengUpdate data! \n'+errorThrown,'Error','error');
      $('#btnSave').text('Save changes'); //change button text
      $('#btnSave').attr('disabled',false); //set button enable
    }
  });
}

function edits(id)
{
  save_method = 'update';
  wilMethod='off';
  $('#form')[0].reset(); // reset form on modals
  $.ajax({
      url : "<?php echo site_url('pelanggan/get_edit/')?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_pelanggan"]').val(data.id_pelanggan);
        $('[name="kode_pelanggan"]').val(data.kode_pelanggan);
        wilayah.val(data.wilayah).trigger('change');
        wilMethod='on';
        tarif.val(data.tarif).trigger('change');
        zstatus.val(data.status).trigger('change');
        $('[name="no_ktp"]').val(data.no_ktp);
        $('[name="nama_lengkap"]').val(data.nama_lengkap);
        $('[name="alamat"]').val(data.alamat);
        $('[name="telp"]').val(data.telp);
        $('[name="tgl_pasang"]').val(data.tgl_pasang);
        $('[name="foto"]').val(data.foto);
        $('#myModal').modal('show');
        $('.modal-title').text('Edit <?php echo ucwords(str_replace('_',' ',$active)); ?>');
    },
    error: function (jqXHR, textStatus, errorThrown) {
      notif('Gagal mengambil data! \n'+errorThrown,'Error','error');
    }
  });
}

function deletes(id)
{
  if(confirm('Are you sure delete this data?'))
  {
    $.ajax({
      url : "<?php echo site_url('pelanggan/delete_pelanggan')?>/"+id,
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
      url : "<?php echo site_url('pelanggan/vget_edit/')?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('.v1').text(data.kode_pelanggan);
        $('.v2').text(data.nama_lengkap);
        $('.v3').text(data.wilayah);
        $('.v4').text(data.alamat);
        $('.v6').html(data.tarif);
        $('.v5').html(data.status);
        $('.v7').text(data.tgl_pasang);
        $('.v8').text(data.telp);
        $('.v9').text(data.foto);
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
