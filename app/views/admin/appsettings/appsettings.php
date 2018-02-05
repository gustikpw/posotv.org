<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-12">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
    </div>
    <!-- <div class="col-md-6">
    </div>
    <div class="col-md-3" id="step1">
      <div class="tombol">
        <a class="btn btn-primary pull-right btnFokus" href="javascript:void()" onclick="adds()" title="Tambah Data" ><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
      </div>
    </div> -->
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1"> General</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Kwitansi</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Surat</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="col-lg-6">

                            </div>
                            <div class="col-lg-6">

                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                          <div class="col-md-6">
                            <form role="form" id="form_inv_key">
                                <h3>Pengaturan Kwitansi/Invoice</h3>
                                <div class="alert alert-success alert-dismissable fade in">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    A wonderful serenity has taken possession. <a class="alert-link" href="#">Alert Link</a>.
                                </div>
                                <div class="form-group">
                                  <label class="text-warning">Sandi Invoice Lama</label>
                                  <input type="password" name="invoice_key_old" placeholder="Sandi Invoice Lama" class="form-control"> <span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Sandi Invoice Baru</label>
                                  <input type="password" name="invoice_key_new" placeholder="Sandi Invoice Baru" class="form-control"> <span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Ulangi Sandi Baru</label>
                                  <input type="password" name="repeat" placeholder="Ulangi Sandi Baru" class="form-control" onkeyup="validasi()"> <span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <button class="btn btn-sm btn-primary" type="button" id="saveSandi" disabled>Simpan</button>
                                </div>
                            </form>
                            <div class="border-bottom"></div>
                          </div>
                          <div class="col-md-6">
                            <form role="form" id="form_terms">
                                <h3>Informasi Kwitansi/Invoice</h3>
                                <div class="alert alert-success alert-dismissable fade in">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    A wonderful serenity has taken possession. <a class="alert-link" href="#">Alert Link</a>.
                                </div>
                                <div class="form-group">
                                  <label class="text-warning">Pembayaran mulai/berakhir :</label>
                                  <input type="text" name="batas" placeholder="" class="form-control input-sm"><span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Info 1</label>
                                  <input type="text" name="info1" placeholder="" class="form-control input-sm"><span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Info 2</label>
                                  <input type="text" name="info2" placeholder="" class="form-control input-sm"><span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Info 3</label>
                                  <input type="text" name="info3" placeholder="" class="form-control input-sm"><span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Info 4</label>
                                  <input type="text" name="info4" placeholder="" class="form-control input-sm"><span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Info 5 <small>(Optional)</small></label>
                                  <input type="text" name="info5" placeholder="" class="form-control input-sm"> <span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Info 6 <small>(Optional)</small></label>
                                  <input type="text" name="info6" placeholder="" class="form-control input-sm"> <span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <button class="btn btn-sm btn-primary pull-right" type="button" onclick="save_settings('invoice_terms')">Simpan</button>
                                </div>
                            </form>
                          </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                          <div class="col-lg-12">
                            <form role="form" id="form_surat" action="#">
                                <h3>Paragraf surat pemutusan</h3>
                                <div class="alert alert-success alert-dismissable fade in">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    A wonderful serenity has taken possession. <a class="alert-link" href="#">Alert Link</a>.
                                </div>
                                <div class="form-group">
                                  <label class="text-warning">Perihal</label>
                                  <input type="text" name="perihal" placeholder="Perihal" class="form-control"> <span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Isi surat</label>
                                  <textarea name="pembuka" placeholder="paragraf pembuka" class="form-control"></textarea> <span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Keterangan</label>
                                  <textarea name="ket1" placeholder="Keterangan 1" class="form-control" rows="5"></textarea> <span class="help-block m-b-none"></span>
                                </div>
                                <div class="form-group">
                                  <label class="text-success">Penutup</label>
                                  <textarea name="penutup" placeholder="Penutup" class="form-control"></textarea> <span class="help-block m-b-none"></span>
                                </div>
                                <!-- <div class="col-md-6"> -->
                                   <div class="form-group">
                                      <label class="text-success">Nama Pimpinan</label>
                                      <input type="text" name="pimpinan" placeholder="Nama Pimpinan" class="form-control"> <span class="help-block m-b-none"></span>
                                   </div>
                                <!-- </div> -->
                                <!-- <div class="col-md-6"> -->
                                   <div class="form-group">
                                      <label class="text-success">Jabatan</label>
                                      <input type="text" name="jabatan" placeholder="Jabatan" class="form-control"> <span class="help-block m-b-none"></span>
                                   </div>
                                <!-- </div> -->
                                <div class="form-group">
                                  <div class="border-top"></div><br>
                                  <button class="btn btn-md btn-primary pull-right" type="button" onclick="save_settings('surat_pemutusan')">Simpan</button>
                                </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>


            </div>
          </div>
        </div>

        <!-- <div class="row">
          <div class="col-lg-6">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5>Kwitansi</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
              </div>
              <div class="ibox-content">

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
              </div>
              <div class="ibox-content">

              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5><i class="fa fa-envelope"></i> Surat Pemutusan</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
              </div>
              <div class="ibox-content">

              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
              </div>
              <div class="ibox-content">

              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
              </div>
              <div class="ibox-content">

              </div>
            </div>
          </div>

        </div> -->
      </div>
