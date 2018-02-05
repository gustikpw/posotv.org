<!-- sidebar & navigation -->
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?=base_url('assets/inspinia271/img/profile_small.jpg') ?>" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$_SESSION['alias']; ?></strong>
                            </span> <span class="text-muted text-xs block"><?=ucfirst($_SESSION['level']); ?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="<?=site_url('login/logout') ?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            PS
                        </div>
                    </li>
                    <li class="special_link">
                        <a href="<?= site_url('dashboard')?>"><i class="fa fa-laptop"></i> <span class="nav-label">DASHBOARD</span></a>
                    </li>
                    <li class="<?=$x1 = ($active == "profil_perusahaan" || $active == "bagian" || $active == "jabatan" || $active == "karyawan" || $active == "wilayah" || $active == "status" || $active == "tarif" || $active == "pelanggan" || $active == "kwitansi" || $active == "kolektor" || $active == "sms_inbox") ? 'active' : '' ?>">
                        <a href="index-2.html"><i class="fa fa-th-large"></i> <span class="nav-label">Master Data</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?=$x1a = ($active == "profil_perusahaan") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/profil_perusahaan')?>">Profil Perusahaan</a></li>
                            <li class="<?=$x1b = ($active == "bagian") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/bagian')?>">Bagian</a></li>
                            <li class="<?=$x1c = ($active == "jabatan") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/jabatan')?>">Jabatan</a></li>
                            <li class="<?=$x1d = ($active == "karyawan") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/karyawan')?>">Karyawan</a></li>
                            <li class="<?=$x1e = ($active == "wilayah") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/wilayah')?>">Wilayah</a></li>
                            <li class="<?=$x1f = ($active == "status") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/status')?>">Status</a></li>
                            <li class="<?=$x1g = ($active == "tarif") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/tarif')?>">Tarif</a></li>
                            <li class="<?=$x1h = ($active == "pelanggan") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/pelanggan')?>">Pelanggan</a></li>
                            <li class="<?=$x1i = ($active == "kwitansi") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/kwitansi')?>">Kwitansi</a></li>
                            <li class="<?=$x1j = ($active == "kolektor") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/kolektor')?>">Kolektor</a></li>
                            <li class="<?=$x1k = ($active == "sms_inbox") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/sms_inbox')?>">Inbox</a></li>
                        </ul>
                    </li>
                    <li class="<?=$x2 = ($active == "pengaduan" || $active == "jenis_gangguan" || $active == "perbaikan_gangguan" || $active == "tunggakan") ? 'active' : '' ?>">
                        <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Pelayanan </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                          <li class="<?=$x2a = ($active == "pengaduan") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/pengaduan')?>">Pengaduan</a></li>
                          <li class="<?=$x2b = ($active == "jenis_gangguan") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/jenis_gangguan')?>">Jenis Gangguan</a></li>
                          <li class="<?=$x2c = ($active == "perbaikan_gangguan") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/perbaikan_gangguan')?>">Perbaikan Gangguan</a></li>
                          <li class="<?=$x2d = ($active == "tunggakan") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/tunggakan')?>">Tunggakan</a></li>
                        </ul>
                    </li>
                    <li class="<?=$x5 = ($active == "pemutusan") ? 'active' : '' ?>">
                        <a href="mailbox.html"><i class="fa fa-warning"></i> <span class="nav-label">Penindakan <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level collapse">
                          <li class="<?=$x5a = ($active == "pemutusan") ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/pemutusan')?>">Pemutusan</a></li>
                        </ul>
                    </li>

                    <!-- <li>
                        <a href="grid_options.html"><i class="fa fa-laptop"></i> <span class="nav-label">Grid options</span></a>
                    </li> -->

                    <li class="<?=$x3 = ($active == "setoran_kolektor" || $active == "setoran_operator" || $active == "liputan") ? 'active' : '' ?>">
                        <a href="#"><i class="fa fa-money"></i> <span class="nav-label">Keuangan </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="<?=$x3 ?>">
                                <a href="#" id="damian">Pendapatan <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                  <li class="<?=$x3a = ($active == 'setoran_kolektor') ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/setoran_kolektor')?>">Setoran Kolektor</a></li>
                                  <li class="<?=$x3b = ($active == 'setoran_operator') ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/setoran_operator')?>">Setoran Operator</a></li>
                                  <li class="<?=$x3c = ($active == 'liputan') ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/liputan')?>">Liputan</a></li>
                                </ul>
                            </li>
                            <li>
                              <a href="#">Pengeluaran <span class="fa arrow"></span></a>
                              <ul class="nav nav-third-level">
                                  <li>
                                      <a href="#">Penggajian</a>
                                  </li>
                                  <li>
                                      <a href="#">Konten</a>
                                  </li>
                                  <li>
                                      <a href="#">Lain-lain</a>
                                  </li>

                              </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="<?=$x4 = ($active == "appsettings") ? 'active' : '' ?>">
                        <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="<?=$x4a = ($active == 'appsettings') ? 'active' : '' ?>"><a href="<?=site_url('dashboard/url/appsettings')?>">App Settings</a></li>

                        </ul>
                    </li>

                    <li class="special_link">
                        <a href="<?=site_url('login/logout') ?>"><i class="fa fa-sign-out"></i> <span class="nav-label">Log Out</span></a>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <!-- <img src="<?=base_url('assets/img/poso.tv.xs.png') ?>" class="img-rounded m-t-sm" alt="POSO TV" width="auto" height="40"> -->
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to POSO TV WebApp</span>
                </li>
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php //echo base_url('assets/inspinia271/img/a7.jpg') ?>">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->


                <li>
                    <a href="<?=site_url('login/logout') ?>">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle startTour" title="Take the Tour!">
                        <i class="fa fa-plane"></i>
                    </a>
                </li>
            </ul>

        </nav>
      </div>


        <!-- bagian dibawah adalah wrapper-content -->
