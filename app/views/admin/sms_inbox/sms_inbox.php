<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-3">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
        <!-- <small>You have 42 messages and 6 notifications.</small> -->
    </div>
    <div class="col-md-6">
    </div>
    <div class="col-md-3" id="step1">
      <div class="tombol">
        <a class="btn btn-primary pull-right btnFokus" href="javascript:void()" onclick="sendsms()" title="Kirim SMS" ><i class="glyphicon glyphicon-plus"></i> Kirim SMS</a>
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
                      <th>Pengirim</th>
                      <th>Pesan</th>
                      <th>Waktu Pesan</th>
                      <th class="bg-warning text-center" style="width:60px">Aksi</th>
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
<div class="modal inmodal" id="DetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Detail <?php echo ucwords(str_replace('_',' ',$active)); ?></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-5">
                    <div class="contact-box center-version">
                        <a href="javascript:void(0)">
                            <!-- <img alt="image" class="img-circle" src=""> -->
                            <span class="fa fa-picture-o fa-4x"></span>
                            <h3 class="m-b-xs"><strong class="v1"></strong></h3>
                            <div class="font-bold v2"></div>
                            <address class="m-t-md">
                                <strong class="v3"></strong><br>
                                <span class="v4"></span><br>
                                <abbr title="Phone">P: </abbr><span class="v5"></span>
                            </address>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                  <div class="contact-box-footer">
                    <table class="table table-striped table-hover" >
                      <tr>
                        <td class="font-bold">Pesan</td>
                      </tr>
                      <tr>
                        <td>
                          <pre><span class="v7"></span></pre>
                        </td>
                      </tr>
                      <tr>
                        <td class="pull-right">
                          <small>ReceivingDateTime</small><br>
                          <span class="v8"></span>
                        </td>
                      </tr>
                    </table>
                    <br>
                    <button type="button" class="btn btn-sm btn-white pull-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
            </div> -->
        </div>
    </div>
</div>
