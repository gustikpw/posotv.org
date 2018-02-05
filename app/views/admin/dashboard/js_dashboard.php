<!-- Flot -->
<script src="<?= base_url('assets/inspinia271/js/plugins/flot/jquery.flot.js') ?>"></script>
<script src="<?= base_url('assets/inspinia271/js/plugins/flot/jquery.flot.tooltip.min.js') ?>"></script>
<script src="<?= base_url('assets/inspinia271/js/plugins/flot/jquery.flot.spline.js') ?>"></script>
<script src="<?= base_url('assets/inspinia271/js/plugins/flot/jquery.flot.resize.js') ?>"></script>
<script src="<?= base_url('assets/inspinia271/js/plugins/flot/jquery.flot.pie.js') ?>"></script>
<script src="<?= base_url('assets/inspinia271/js/plugins/flot/jquery.flot.symbol.js') ?>"></script>
<script src="<?= base_url('assets/inspinia271/js/plugins/flot/jquery.flot.time.js') ?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/inspinia271/js/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
<!-- Chart.js -->
<script src="<?= base_url('assets/inspinia271/js/plugins/chartJs/Chart.min.js') ?>"></script>

<!-- <script>
$(document).ready(function() {

    var sparklineCharts = function(){
        $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#1ab394',
            fillColor: "transparent"
        });

        $("#sparkline2").sparkline([32, 11, 25, 37, 41, 32, 34, 42], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#1ab394',
            fillColor: "transparent"
        });

        $("#sparkline3").sparkline([34, 22, 24, 41, 10, 18, 16,8], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#1C84C6',
            fillColor: "transparent"
        });
    };

    var sparkResize;

    $(window).resize(function(e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineCharts, 500);
    });

    sparklineCharts();




    var data1 = [
        [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,20],[11,10],[12,13],[13,4],[14,7],[15,8],[16,12]
    ];
    var data2 = [
        [0,0],[1,2],[2,7],[3,4],[4,11],[5,4],[6,2],[7,5],[8,11],[9,5],[10,4],[11,1],[12,5],[13,2],[14,5],[15,2],[16,0]
    ];

});
</script> -->

<!-- <script>
    $(document).ready(function() {

        var lineData = {
            labels: ["January", "February"],
            datasets: [
                {
                    label: "Mama Tasya",
                    backgroundColor: "rgba(26,179,148,0.5)",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48]
                },
                {
                    label: "Mama Mendi",
                    backgroundColor: "rgba(220,220,220,0.5)",
                    borderColor: "rgba(220,220,220,1)",
                    pointBackgroundColor: "rgba(220,220,220,1)",
                    pointBorderColor: "#fff",
                    data: [65, 59]
                }
            ]
        };

        console.log(lineData);

        // var lineOptions = {
        //     responsive: true
        // };
        //
        //
        // var ctx = document.getElementById("lineChart").getContext("2d");
        // new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

    });
</script> -->

<script>
$(document).ready(function(){

   $.ajax({
      url : "<?=site_url('Api_search/dashboard_data')?>",
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
         // console.log(data.line_chart_data);
         // piedata = ;
         // linedata = ;
         // Pelanggan
         $(".det1").text(data.pelanggan.total_pelanggan);
         $(".det2").text(data.pelanggan.pelanggan_aktif);
         $(".det3").text(data.pelanggan.pelanggan_putus_sementara);
         $(".det4").text(data.pelanggan.pelanggan_non_aktif);
         det7 = (data.pelanggan.pelanggan_non_aktif*1) + (data.pelanggan.pelanggan_putus_sementara*1);
         $(".det7").text(det7);
         // Wilayah
         $(".det5").text(data.total_wilayah);
         $(".det6").html(data.wilayah);
         $(".det8").text(data.chart_des.total_setoran.total);
         $(".det9").text(data.chart_des.total_setoran.bulan);
         $(".det10").text(data.chart_des.max_setoran.kolektor);
         $(".det11").text(data.chart_des.max_setoran.total);
         $(".det12").text(data.chart_des.update_on);
         $(".det13").text(data.chart_des.last_month_summary.bulan);
         $(".det14").text(data.chart_des.last_month_summary.total);
         // Persentase Pencapaian
         $(".det15").html(data.pencapaian.target);
         $(".det16").html(data.pencapaian.tercapai);
         $(".det17").html(data.pencapaian.tercapai_percent);
         $(".det18").html(data.pencapaian.margin);

         // Chart
         donat(data.doughnutchart_data);
         mylineChart(data.line_chart_data);

      }
   });

});

function donat(isi) {
   var myoption = {
      responsive: true,
      animation:{
          animateScale:true
      }
   };

   var ctx2 = document.getElementById("doughnutChart").getContext("2d");
   new Chart(ctx2, {
     type: 'doughnut',
     data: isi,
     options: myoption
   });
}

function mylineChart(lineData) {
   lineOptions = {
       responsive: true,
       animation:{
           animateScale:true
       },
       scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return 'Rp ' + value;
                    }
                }
            }]
        }
   };

   var ctx = document.getElementById("lineChart").getContext("2d");
   new Chart(ctx, {
      type: 'line',
      data: lineData,
      options:lineOptions
   });
}


</script>
</body>

</html>
