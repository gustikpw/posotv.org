<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-6">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
        <!-- <small>You have 42 messages and 6 notifications.</small> -->
    </div>
    <div class="col-md-3">
    </div>
    <div class="col-md-3" id="step1">
      <div class="tombol">
        <!-- <a class="btn btn-primary pull-right btnFokus" href="javascript:void()" onclick="adds()" title="Tambah Data" ><i class="glyphicon glyphicon-plus"></i> Tambah Data</a> -->
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
                      <th>ID</th>
                      <th>Kode Pelanggan</th>
                      <th>Nama Lengkap</th>
                      <th>Wilayah</th>
                      <th>Tgl Lapor</th>
                      <th>Jenis Gangguan</th>
                      <th>Prioritas</th>
                      <th>Status Aduan</th>
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

<!-- Detail Modal -->
<div class="modal inmodal" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width:95%">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Detail <?php echo ucwords(str_replace('_',' ',$active)); ?></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
              <div class="row m-b-lg m-t-lg">
                  <div class="col-md-5">
                      <div class="profile-image">
                          <img src="<?php echo base_url('assets/inspinia271/img/a4.jpg') ?>" class="img-circle circle-border m-b-md" alt="profile">
                      </div>
                      <div class="profile-info">
                          <div class="">
                              <div>
                                  <h2 class="no-margins">
                                      <span class="font-bold v1">KWA001</span> | <span class="v2">Alex Smith</span>
                                  </h2>
                                  <h4 class="v3">Kawua A</h4>
                                  <small>
                                      <strong><span class="v4">Jl. Kijang No. 1</span></strong>
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
                                  Prioritas <strong><span class="v6">Low</span></strong>
                              </td>

                          </tr>
                          <tr>
                              <td class="font-bold">
                                  Tgl Gangguan <h3><strong><span class="v7">2017-06-12</span></strong></h3>
                              </td>
                              <td class="font-bold">
                                  Tgl Lapor <h3><strong><span class="v8">2017-06-12</span></strong></h3>
                              </td>
                          </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="col-md-3">
                    <small>Jenis Gangguan</small>
                    <h3 class="no-margins text-danger v9">Kabel Putus</h3>
                    <small>Keterangan</small>
                    <dt class="text-bold v10">Gambar Kabur dan Kabel tidak rapi</dt>
                  </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                <form id="formUpdate" action="#" class="form-horizontal">
                    <input type="text" name="id_pengaduan" hidden>
                    <div class="col-lg-12 b-r">
                      <div class="form-group"><label class="col-lg-3 control-label">Tanggal Perbaikan</label>
                          <div class="col-lg-9"><input type="text" name="tgl_perbaikan" placeholder="Tanggal Perbaikan" class="form-control date fokus"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Teknisi</label>
                          <div class="col-lg-9">
                            <select name="teknisi[]" id="teknisi" class="select2_demo_2" multiple="multiple">

                            </select>
                            <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Sebab</label>
                          <div class="col-lg-9"><textarea type="text" name="sebab" placeholder="Sebab Gangguan" class="form-control"></textarea> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Tindakan</label>
                          <div class="col-lg-9"><textarea name="tindakan" placeholder="Tindakan yang dilakukan dalam perbaikan" class="form-control"></textarea> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Status Aduan</label>
                          <div class="col-lg-9"><select name="status_aduan" class="form-control"></select> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                    </div>
                </form>
                </div>
                <div class="col-md-6">
                  <div class="text-bold bg-warning p-xxs m-xxs">History Tunggakan</div>
                  <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>2017-06-02</td>
                      <td>Rp. 30.000,-</td>
                    </tr>
                    <tr>
                      <td>2017-06-02</td>
                      <td>Rp. 30.000,-</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total</th>
                      <th>Rp. 60.000,-</th>
                    </tr>
                  </tfoot>
                  </table>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary step3" id="btnSave" onclick="save()">Save changes</button>
              <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
