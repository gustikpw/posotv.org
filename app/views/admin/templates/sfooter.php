<!-- Mainly scripts -->
<script src="<?php echo base_url('assets/inspinia271/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/metisMenu/jquery.metisMenu.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>

<!-- Peity -->
<script src="<?php echo base_url('assets/inspinia271/js/plugins/peity/jquery.peity.min.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/demo/peity-demo.js') ?>"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url('assets/inspinia271/js/inspinia.js') ?>"></script>
<script src="<?php echo base_url('assets/inspinia271/js/plugins/pace/pace.min.js') ?>"></script>

<!-- jQuery UI -->
<script src="<?php echo base_url('assets/inspinia271/js/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>

<!-- GITTER -->
<script src="<?php echo base_url('assets/inspinia271/js/plugins/gritter/jquery.gritter.min.js') ?>"></script>

<!-- Sparkline -->
<script src="<?php echo base_url('assets/inspinia271/js/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>

<!-- Sparkline demo data  -->
<script src="<?php echo base_url('assets/inspinia271/js/demo/sparkline-demo.js') ?>"></script>

<!-- ChartJS-->
<!-- <script src="<?php //echo base_url('assets/inspinia271/js/plugins/chartJs/Chart.min.js') ?>"></script> -->

<!-- Toastr -->
<script src="<?php echo base_url('assets/inspinia271/js/plugins/toastr/toastr.min.js') ?>"></script>


<script>
var jdlPesan,isiPesan, msgType;

    $(document).ready(function() {
        // notif(isiPesan,jdlPesan,msgType);
    });

    function notif(isiPesan,jdlPesan,msgType) {
      setTimeout(function() {
          toastr.options = {
              closeButton: true,
              progressBar: true,
              showMethod: 'slideDown',
              timeOut: 4000
          };
          if (msgType=='success') {
            toastr.success(isiPesan,jdlPesan)
          } else if (msgType=='info') {
            toastr.info(isiPesan,jdlPesan)
          } else if (msgType=='warning') {
            toastr.warning(isiPesan,jdlPesan)
          } else if(msgType=='error') {
            toastr.error(isiPesan,jdlPesan)
          }
      }, 1300);

    }
</script>

<!-- content script -->
