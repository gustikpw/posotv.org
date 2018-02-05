<div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="p-w-md m-t-sm">
            <div class="row">

                <div class="col-sm-8">
                  <div class="m-l-n-xs">
                    <img src="<?=base_url('assets/img/poso.tv.xs.png')?>" class="img-rounded" alt="" width=""><br>
                  </div>

                    <small>
                      PT. POSO MEDIA VISION
                    </small>
                    <br><br>
                    <div class="border-bottom"></div>
                    <!-- <div id="sparkline1" class="m-b-sm"></div> -->
                    <div class="row">
                        <div class="col-xs-3 border-right">
                            <small class="stats-label">Target Rp</small>
                            <h2 class="no-margins"><span class="font-bold det15"></span></h2>
                        </div>
                        <div class="col-xs-3 border-right">
                          <small class="stats-label">Tercapai Rp</small>
                          <h2 class="no-margins"><span class="font-bold det16"></span></h2>
                        </div>
                        <div class="col-xs-3 border-right">
                            <small class="stats-label">% Tercapai</small>
                            <h2 class="no-margins"><span class="det17"></span></h2>
                        </div>
                        <div class="col-xs-3">
                            <small class="stats-label">% Margin</small>
                            <h2 class="no-margins"><span class="det18"></span></h2>
                        </div>
                    </div>

                    <div class="border-bottom"></div>

                </div>
                <div class="col-sm-4">
                    <!-- <h1 class="m-b-xs">
                        98,100
                    </h1>
                    <small>
                        Sales in last 24h
                    </small>
                    <div id="sparkline2" class="m-b-sm"></div>
                    <div class="row">
                        <div class="col-xs-4">
                            <small class="stats-label">Pages / Visit</small>
                            <h4>166 781.80</h4>
                        </div>

                        <div class="col-xs-4">
                            <small class="stats-label">% New Visits</small>
                            <h4>22.45%</h4>
                        </div>
                        <div class="col-xs-4">
                            <small class="stats-label">Last week</small>
                            <h4>862.044</h4>
                        </div>
                    </div> -->


                </div>
                <div class="col-sm-4">

                    <div class="row m-t-xs">
                        <div class="col-xs-6">
                            <h5 class="m-b-xs">Total Customers</h5>
                            <h1 class="no-margins"><span class="det1">0</span></h1>
                            <!-- <div class="font-bold text-navy">98% <i class="fa fa-bolt"></i></div> -->
                        </div>
                        <div class="col-xs-6">
                            <h5 class="m-b-xs">Inactive</h5>
                            <h1 class="no-margins"><span class="det7">0</span></h1>
                            <!-- <div class="font-bold text-navy">98% <i class="fa fa-bolt"></i></div> -->
                        </div>
                    </div>


                    <table class="table small m-t-sm">
                        <tbody>
                        <tr>
                            <td>
                              <div class="dropdown">
                                <a href="javascript:void(0)" class="text-info dropdown-toggle" id="menu1" data-toggle="dropdown">
                                  <strong><span>More</span></strong> Details
                                  <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                  <li><a role="menuitem" href="#"><i class="fa fa-circle-o text-info"></i> Aktif <span class="text-success font-bold det2 pull-right"></span></a></li>
                                  <li><a role="menuitem" href="#"><i class="fa fa-question-circle text-warning"></i> Penalty <span class="text-warning font-bold det3 pull-right"></span></a></li>
                                  <li><a role="menuitem" href="#"><i class="fa fa-times-circle-o text-warning"></i> Non-Aktif<span class="text-danger font-bold det4 pull-right"></span></a></li>
                                </ul>
                              </div>
                            </td>
                            <td>
                              <div class="dropdown">
                                <a href="javascript:void(0)" class="text-info dropdown-toggle" id="menu2" data-toggle="dropdown">
                                  <strong><span class="det5">0</span></strong> Total Wilayah
                                  <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu det6" role="menu" aria-labelledby="menu2">
                                </ul>
                              </div>
                            </td>

                        </tr>
                        <!-- <tr>
                            <td>
                                <strong>61</strong> Comments
                            </td>
                            <td>
                                <strong>54</strong> Articles
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>154</strong> Companies
                            </td>
                            <td>
                                <strong>32</strong> Clients
                            </td>
                        </tr> -->
                        </tbody>
                    </table>



                </div>

            </div>

            <div class="row">
               <div class="col-lg-8">
                  <div>
                      <span class="pull-right text-right">
                      <small>Setoran tertinggi kolektor: <strong><span class="det10">Superadmin</span></strong></small>
                          <br/>
                          All deposit: <span class="det11">7.250.000</span>
                      </span>
                      <h1 class="m-b-xs"><span class="det8">0</span></h1>
                      <h3 class="font-bold no-margins">
                          <span class="det9">February</span> revenue
                      </h3>
                      <small>By all collectors.</small>
                  </div>

                  <div>
                     <canvas id="lineChart" height="150"></canvas>
                  </div>

                  <div class="m-t-md">
                     <small class="pull-right">
                         <i class="fa fa-clock-o"> </i>
                         Update on <span class="det12">1.01.2018</span><br>
                         <small>Grafik akan tersedia jika semua kolektor telah melakukan setoran min 1x</small>
                     </small>
                    <small>
                        <strong>Analisis setoran:</strong> Nilai telah berubah dari waktu ke waktu,<br> dan bulan lalu <span class="det13">0</span> mencapai level max <span class="det14">0</span>.
                    </small>
                  </div>

               </div>
               <div class="col-lg-4">
                 <div class="border-left">
                    <canvas id="doughnutChart" width="100%"></canvas>
                 </div>
               </div>
            </div>


            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-content">

                        </div>
                    </div>
                </div>
            </div>

        </div>

      </div>
