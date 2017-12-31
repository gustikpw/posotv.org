<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-3">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
    </div>
    <div class="col-md-6">
    </div>
    <div class="col-md-3" id="step1">
      <div class="tombol">
        <a class="btn btn-primary pull-right btnFokus" href="javascript:void()" onclick="adds()" title="Tambah Data" ><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
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
                <form role="form">
                    <p>Pengaturan Kwitansi/Invoice</p>
                    <div class="form-group">
                      <label class="text-warning">Sandi Invoice Lama</label>
                      <input type="password" name="invoice_key_old" placeholder="Sandi Invoice Lama" class="form-control"> <span class="help-block m-b-none"></span>
                    </div>
                    <div class="form-group">
                      <label class="text-success">Sandi Invoice Baru</label>
                      <input type="password" name="invoice_key_new" placeholder="Sandi Invoice Baru" class="form-control"> <span class="help-block m-b-none"></span>
                    </div>
                    <div class="form-group">
                        <!-- <div class="col-lg-offset-2 col-lg-10"> -->
                            <button class="btn btn-sm btn-white" type="submit">Simpan</button>
                        <!-- </div> -->
                    </div>
                </form>
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
                <form role="form">
                    <p>Informasi Kwitansi/Invoice</p>
                    <div class="form-group">
                      <label class="text-warning">Pembayaran mulai/berakhir :</label>
                      <span class="help-block m-b-none" ondblclick="editTerms('batas')">Pembayaran akan mulai tanggal 2 s/d 15 setiap bulannya. </span>
                      <input type="text" name="batas" placeholder="" class="input-sm" hidden="hidden">
                    </div>
                    <div class="form-group">
                      <label class="text-success">Info 1</label>
                      <span class="help-block m-b-none" ondblclick="editTerms('info1')"> * Bawa kwitansi lama untuk pembayaran tunggakan selanjutnya.</span>
                      <input type="text" name="info1" placeholder="" class="input-sm" hidden="hidden">
                    </div>
                    <div class="form-group">
                      <label class="text-success">Info 2</label>
                      <span class="help-block m-b-none" ondblclick="editTerms('info2')">* Menunggak 2 (dua) bulan akan dilakukan pemutusan sementara</span>
                      <input type="text" name="info2" placeholder="" class="input-sm" hidden="hidden">
                    </div>
                    <div class="form-group">
                      <label class="text-success">Info 3</label>
                      <span class="help-block m-b-none" ondblclick="editTerms('info3')"> dan disambung kembali setelah menunasi tunggakan</span>
                      <input type="text" name="info3" placeholder="" class="input-sm" hidden="hidden">
                    </div>
                    <div class="form-group">
                      <label class="text-success">Info 4</label>
                      <span class="help-block m-b-none" ondblclick="editTerms('info4')">* Syarat dan ketentuan berlaku.</span>
                      <input type="text" name="info4" placeholder="" class="input-sm" hidden="hidden">
                    </div>
                    <div class="form-group">
                      <label class="text-success" ondblclick="editTerms('info5')">Info 5 <small>(Optional)</small></label>
                      <input type="text" name="info5" placeholder="" class="form-control input-sm"> <span class="help-block m-b-none"></span>
                    </div>
                    <div class="form-group">
                      <label class="text-success" ondblclick="editTerms('info6')">Info 6 <small>(Optional)</small></label>
                      <input type="text" name="info6" placeholder="" class="form-control input-sm"> <span class="help-block m-b-none"></span>
                    </div>
                    <div class="form-group">
                        <!-- <div class="col-lg-offset-2 col-lg-10"> -->
                            <button class="btn btn-sm btn-white" type="submit">Simpan</button>
                        <!-- </div> -->
                    </div>
                </form>
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

        </div>
      </div>
