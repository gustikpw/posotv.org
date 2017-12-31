<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-3">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
        <!-- <small>You have 42 messages and 6 notifications.</small> -->
    </div>
    <div class="col-md-6">
    </div>
    <!-- <div class="col-md-3" id="step1">
      <div class="tombol">
        <a class="btn btn-primary pull-right btnFokus" href="javascript:void()" onclick="adds()" title="Tambah Data" ><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
      </div>
    </div> -->
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
          <div class="col-lg-5">
            <div class="ibox float-e-margins" id="step0">
              <div class="ibox-title bg-primary">
                <h5>Register <?php echo ucwords(str_replace('_',' ',$active)); ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
              </div>
              <div class="ibox-content ">
                <div class="row">
                  <form id="formKwitansi" action="#" class="form-horizontal">
                    <div class="col-lg-12">
                      <div class="form-group" id="step1"><label class="col-lg-4 control-label ">Bulan Penagiahan</label>
                          <div class="col-lg-8"><input type="text" name="bulan_penagihan" placeholder="Pilih Bulan Penagihan" class="form-control date" readonly> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"  id="step2"><label class="col-lg-4 control-label">Pilih Wilayah</label>
                        <div class="col-lg-8"><select name="wilayah" class="form-control"></select> <span class="help-block m-b-none"></span>
                        </div>
                      </div>
                      <div class="form-group" id="step3"><label class="col-lg-4 control-label ">Sandi</label>
                          <div class="col-lg-8"><input type="password" name="sandi" placeholder="Sandi Keamanan Kwitansi" class="form-control"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="ibox-footer">
                <span class="pull-right">
                  <a href="#" class="btn btn-primary" onclick="regInvoice()"  id="step4"><i class="fa fa-hdd-o"></i> Register Invoice</a>
                </span>
                Daftarkan invoice dahulu! <br><br>
              </div>
            </div>

          </div>


          <!-- panel pdf -->
          <div class="col-lg-7">
            <div class="ibox float-e-margins step5" id="ibox2">
              <div class="ibox-title bg-primary">
                <h5>Generated Kwitansi</h5>
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
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
                <div class="row">
                  <table id="table" class="table table-hover table-condensed">
                    <thead>
                      <tr>
                        <th>Registered Kwitansi</th>
                        <th>Bulan Tagihan</th>
                        <th style="width:200px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="dataFiles">
                    </tbody>
                  </table>

                </div>
              </div>
              <div class="ibox-footer">
                <span class="pull-right">
                  <!-- <a href="#" class="btn btn-primary" onclick="regInvoice()"><i class="fa fa-hdd-o"></i> Register Invoice</a> -->
                </span>
                Daftar Invoice yang telah ter-Registrasi ke sistem! <br><br>
              </div>
            </div>

          </div>

        </div>

      </div>
