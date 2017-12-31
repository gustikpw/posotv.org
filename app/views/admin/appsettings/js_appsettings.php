<!-- <script src="<?php //echo base_url('assets/inspinia271/js/plugins/dataTables/datatables.min.js') ?>"></script> -->
<script src="<?php echo base_url('assets/inspinia271/js/plugins/bootstrapTour/bootstrap-tour.min.js') ?>"></script>

<script>
var table;
$(document).ready(function(){

});

function editTerms(val) {
  $("[name='"+val+"']").toggle();
  $("[name='"+val+"']").toggleClass("form-control");
  // $("span").toggle();
  // $("[name='"+val+"']").text();
}
</script>
</body>

</html>
