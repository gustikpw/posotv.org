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
                      <th>Bagian</th>
                      <th>Keterangan</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah <?php echo ucwords(str_replace('_',' ',$active)); ?></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body" id="step2">
              <div class="row">
                <form id="form" action="#" class="form-horizontal">
                    <input type="text" name="id_bagian" hidden>
                    <div class="col-lg-12 b-r">
                      <div class="form-group"><label class="col-lg-2 control-label ">Bagian</label>
                          <div class="col-lg-10"><input type="text" name="bagian" placeholder="Bagian" class="form-control fokus"> <span class="help-block m-b-none"></span>
                          </div>
                      </div>
                      <div class="form-group"><label class="col-lg-2 control-label">Keterangan</label>
                          <div class="col-lg-10"><input type="text" name="keterangan" placeholder="Keterangan" class="form-control"> <span class="help-block m-b-none"></span>
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
                    <td class="font-bold">Bagian</td>
                    <td class="font-bold v2"></td>
                </tr>
                <tr>
                    <td class="font-bold">keterangan</td>
                    <td class="font-bold v3"></td>
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
