<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-3">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
    </div>
    <div class="col-md-6">
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
          <div class="col-lg-12">
             <div class="ibox float-e-margins">
              <div class="ibox-title bg-primary">
                <h5>Tabel <?php echo ucwords(str_replace('_',' ',$active)); ?></h5>
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
                <div class="table-responsive" id="step4">
                  <table class="table table-hover table-condensed" id="table">
                  <thead>
                  <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Nama Lengkap</th>
                      <th>Wilayah</th>
                      <th>Status</th>
                      <th>Tarif Iuran</th>
                      <th title="Total yang harus dibayar">Total</th>
                      <th>Kolektor</th>
                      <th>Banyak</th>
                      <th class="bg-warning text-center">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>


      <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-md">
              <div class="modal-content animated flipInY">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4 class="modal-title">Tentukan tanggal pemutusan</h4>
                      <small class="font-bold"></small>
                  </div>
                  <div class="modal-body" id="step2">
                    <div class="row">
                      <form id="formpemutusan" action="#" class="form-horizontal">
                          <input type="text" name="id_status" hidden>
                          <div class="col-lg-12 b-r">
                            <h3>Kode Pelanggan : <span class="kode_plgn"></span></h3>
                            <input type="text" name="kode_pelanggan" hidden>
                            <div class="form-group"><label class="col-lg-2 control-label">Tanggal Pemutusan</label>
                                <div class="col-lg-10"><input type="text" name="tgl_pemutusan" placeholder="Tanggal Pemutusan" class="form-control datepicker"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary step3" id="btnSetPemutusan" onclick="openWindow()">Cetak Surat</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
