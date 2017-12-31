<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-3">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
        <!-- <small>You have 42 messages and 6 notifications.</small> -->
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
                      <th>Kode Karyawan</th>
                      <th>Nama Lengkap</th>
                      <th>Bagian</th>
                      <th>Jabatan</th>
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
                <h4 class="modal-title">Tambah <?php echo ucwords(str_replace('_',' ',$active)); ?></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body" id="step2">
              <div class="row">
                <form id="form" action="#" class="form-horizontal">
                    <input type="text" name="id_karyawan" hidden>
                    <div class="col-lg-6 b-r">
                      <div class="form-group"><label class="col-lg-3 control-label ">Kode Karyawan</label>
                          <div class="col-lg-9"><input type="text" name="kode_karyawan" placeholder="Kode Karyawan" class="form-control fokus" value="PTV"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Nama Lengkap</label>
                          <div class="col-lg-9"><input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Bagian</label>
                          <div class="col-lg-9"><select name="bagian" class="form-control"></select> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Jabatan</label>
                          <div class="col-lg-9"><select name="jabatan" class="form-control"></select> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Status</label>
                          <div class="col-lg-9"><select name="status" class="form-control"></select> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                    </div>
                    <div class="col-lg-6 b-r">
                      <div class="form-group"><label class="col-lg-3 control-label ">Tanggal Masuk</label>
                          <div class="col-lg-9"><input type="text" name="tgl_masuk" placeholder="Tanggal Masuk" class="form-control date"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Tanggal Berakhir</label>
                          <div class="col-lg-9"><input type="text" name="tgl_berakhir" placeholder="Tanggal Berakhir" class="form-control date"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">No KTP</label>
                          <div class="col-lg-9"><input type="text" name="no_ktp" placeholder="NO KTP" class="form-control"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Alamat</label>
                          <div class="col-lg-9"><textarea name="alamat" placeholder="Alamat" class="form-control"></textarea> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-3 control-label">Telepon</label>
                          <div class="col-lg-9"><input type="text" name="telp" placeholder="Telepon" class="form-control"> <span class="help-block m-b-none"></span>
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Detail <?php echo ucwords(str_replace('_',' ',$active)); ?></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
              <div class="row">
                <table class="table table-striped table-hover" >
                <tr>
                    <td class="font-bold">ID</td>
                    <td class="font-bold v1"></td>
                </tr>
                <tr>
                    <td class="font-bold">Kode Karyawan</td>
                    <td class="font-bold v2"></td>
                </tr>
                <tr>
                    <td class="font-bold">Nama Lengkap</td>
                    <td class="font-bold v3"></td>
                </tr>
                <tr>
                    <td class="font-bold">Bagian</td>
                    <td class="font-bold v4"></td>
                </tr>
                <tr>
                    <td class="font-bold">Jabatan</td>
                    <td class="font-bold v5"></td>
                </tr>
                <tr>
                    <td class="font-bold">Status</td>
                    <td class="font-bold v6"></td>
                </tr>
                <tr>
                    <td class="font-bold">Tanggal Masuk</td>
                    <td class="font-bold v7"></td>
                </tr>
                <tr>
                    <td class="font-bold">Tanggal Berakhir</td>
                    <td class="font-bold v8"></td>
                </tr>
                <tr>
                    <td class="font-bold">No KTP</td>
                    <td class="font-bold v9"></td>
                </tr>
                <tr>
                    <td class="font-bold">Alamat</td>
                    <td class="font-bold v10"></td>
                </tr>
                <tr>
                    <td class="font-bold">Telepon</td>
                    <td class="font-bold v11"></td>
                </tr>
                <tbody>

                </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
