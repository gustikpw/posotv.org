<script src="<?php echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/bootstrapTour/bootstrap-tour.min.js') ?>"></script>

<script>
var table;
$(document).ready(function(){
  $('.btnFokus').focus();

  table = $('#table').DataTable({
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('tarif/ajax_list')?>",
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
  $("select").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
  });

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
    $('[name="id_tarif"]').val('');
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
    url = "<?php echo site_url('tarif/save_tarif')?>";
  } else {
    url = "<?php echo site_url('tarif/update_tarif')?>";
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
      url : "<?php echo site_url('tarif/get_edit/')?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_tarif"]').val(data.id_tarif);
        $('[name="kode_tarif"]').val(data.kode_tarif);
        $('[name="jml_tv"]').val(data.jml_tv);
        $('[name="tarif"]').val(data.tarif);
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
      url : "<?php echo site_url('tarif/delete_tarif')?>/"+id,
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
      url : "<?php echo site_url('tarif/get_edit/')?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('.v1').text(data.id_tarif);
        $('.v2').text(data.kode_tarif);
        $('.v3').text(data.jml_tv);
        $('.v4').text(data.tarif);
        $('.v5').text(data.keterangan);
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
