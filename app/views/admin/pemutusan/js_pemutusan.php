<script src="<?=base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script src="<?=base_url('assets/inspinia271/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script>

<script>
var table;
$(document).ready(function(){
  $('.datepicker').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      format: "yyyy-mm-dd"
  });

  table = $('#table').DataTable({
    ajax : {
       url : "<?php echo site_url('pemutusan/pemutusan_list')?>"
    },
    order: [],
    columnDefs:[
       {
          targets: [ -1 ],
          orderable: false
       }
    ]
  });
});

function showModal(val) {
  $('.kode_plgn').text(val);
  $("[name='kode_pelanggan']").val(val);
  $('#myModal').modal('show');
}

function openWindow() {
  kode = $("[name='kode_pelanggan']").val();
  tgl_pemutusan = $("[name='tgl_pemutusan']").val();
  link = "<?=site_url()?>pemutusan/surat?kode="+kode+"&tgl_pemutusan="+tgl_pemutusan;
  window.open(link,'','width=800,height=600');
}

function reload_table() {
   tabel.ajax.reload(null,false);
}
</script>
</body>

</html>
