<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-6 col-xs-4">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
    </div>
    <div class="col-md-3">
    </div>
    <div class="col-md-3" id="step1">
      <div class="tombol">
        <a class="btn btn-primary pull-right btnFokus" href="javascript:void(0)" onclick="adds()" title="Tambah Data" ><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
      </div>
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
                  <table class="table table-hover" id="table">
                  <thead>
                  <tr>
                      <th>Foto</th>
                      <th>Kode Pelanggan</th>
                      <th>Nama Lengkap</th>
                      <th>Wilayah</th>
                      <th>Alamat</th>
                      <th>Tgl Pasang</th>
                      <th>Tarif</th>
                      <th>Status</th>
                      <th class="bg-warning text-center" style="width:180px">Aksi</th>
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
    <div class="modal-dialog" style="width:80%">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah <?php echo ucwords(str_replace('_',' ',$active)); ?> Pelanggan</h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body" id="step2">
              <div class="row">
                <form id="form" action="#" class="form-horizontal">
                    <input type="text" name="id_pelanggan" hidden>
                    <div class="col-lg-6 b-r">
                      <div class="form-group"><label class="col-lg-3 control-label ">Wilayah</label>
                        <div class="col-lg-9"><select name="wilayah" class="form-control fokus"></select> <span class="help-block m-b-none"></span>
                        </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label ">Kode Pelanggan</label>
                          <div class="col-lg-9"><input type="text" maxlength="6" name="kode_pelanggan" class="form-control" readonly> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label ">Nomor e-KTP/SIM</label>
                          <div class="col-lg-9"><input type="text" name="no_ktp" placeholder="Nomor e-KTP/SIM" class="form-control"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Nama Lengkap</label>
                          <div class="col-lg-9"><input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Alamat</label>
                        <div class="col-lg-9"><textarea name="alamat" placeholder="Alamat" class="form-control"></textarea> <span class="help-block m-b-none"></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 b-r">
                      <div class="form-group"><label class="col-lg-3 control-label">Tanggal Pasang</label>
                        <div class="col-lg-9"><input type="text" name="tgl_pasang" placeholder="Tanggal Pasang/Instalasi" class="form-control date"> <span class="help-block m-b-none"></span>
                        </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Telepon/HP</label>
                          <div class="col-lg-9"><input type="text" name="telp" placeholder="Telepon/HP" class="form-control"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Tarif Berlangganan</label>
                          <div class="col-lg-9"><select name="tarif" class="form-control"></select> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Status</label>
                          <div class="col-lg-9"><select name="status" class="form-control"></select> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Foto</label>
                          <div class="col-lg-9"><input type="text" name="foto" placeholder="Foto" class="form-control"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                    </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary step3" id="btnSave" onclick="save()">Save changes</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal inmodal" id="DetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog " ><!--style="width:60%"-->
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Detail <?php echo ucwords(str_replace('_',' ',$active)); ?></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
              <div class="row m-b-lg m-t-lg">
                  <div class="col-md-8">
                      <div class="profile-image">
                          <img src="<?php echo base_url('assets/inspinia271/img/a4.jpg') ?>" class="img-circle circle-border m-b-md" alt="profile">
                      </div>
                      <div class="profile-info">
                          <div class="">
                              <div>
                                  <h2 class="no-margins">
                                      <span class="font-bold v1">KWA001</span> | <span class="v2">Alex Smith</span>
                                  </h2>
                                  <h3 class="v3">Kawua A</h3>
                                  <h5><span class="v4">Jl. Kijang No. 1</span></h5>
                                  <small>
                                      <!-- <dt>Keterangan Gangguan</dt> -->
                                      <!-- <dd class="text-warning">Gambar Kabur dan Kabel tidak rapi</dd> -->
                                  </small>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <table class="table small m-b-xs">
                          <tbody>
                          <tr>
                              <td>
                                  Status <strong><span class="v5">Aktif</span></strong>
                              </td>
                              <td>
                                  Tarif <strong><span class="v6">Rp. 35.000,-</span></strong>
                              </td>

                          </tr>
                          <tr>
                              <td class="font-bold">
                                  Tgl Instalasi <h3><strong><span class="v7">2017-06-12</span></strong></h3>
                              </td>
                              <td class="font-bold">
                                  Telepon <h3><strong><span class="v8">0080 8485 7234</span></strong></h3>
                              </td>
                          </tr>
                          </tbody>
                      </table>
                  </div>
                  <!-- <div class="col-md-3">
                    <small>Jenis Gangguan</small>
                    <h3 class="no-margins text-danger"><span class="v9">Kabel Putus</span></h3>
                    <small>Keterangan</small>
                    <dt class="text-bold"><span class="v10">Gambar Kabur dan Kabel tidak rapi</span></dt>
                  </div> -->
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
