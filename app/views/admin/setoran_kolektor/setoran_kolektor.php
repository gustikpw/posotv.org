<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-3">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
        <!-- <small>You have 42 messages and 6 notifications.</small> -->
    </div>
    <div class="col-md-6">
    </div>
    <div class="col-md-3">
      <span>Camera Actived</span>
      <span id="listCamera"></span>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-lg-6">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5>Pindai Kwitansi <small><?php echo ucwords(str_replace('_',' ',$active)); ?></small></h5>
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
                <div class="row">
                  <div class="col-lg-4 b-r">
                    <video class="vidscan img-rounded" id="preview"></video>
                  </div>
                  <div class="col-lg-8">
                    <span class="help-block m-b-none text-warning font-italic">Masukan No. Invoice jika scanner tidak bekerja!</span>
                    <div class="input-group"><input type="text" name="kode_invoice" placeholder="No. Invoice" class="form-control" onkeyup="setUpper()">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-primary" onclick="getDetail('kode','invoiceCode')"><span class="fa fa-search"></span> Go!</button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5>Keterangan</h5>
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
                <div class="row">
                  <!-- <button type="button" class="btn btn-sm btn-danger" onclick="delAlltr()"><i class="fa fa-trash"></i> Hapus Semua</button> -->
                  <div class="col-lg-12">
                    <label for="t_setoran">Total Setoran</label>
                    <h1><strong id="t_setoran">0</strong></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
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
                  <form id="formScanned" action="#" method="post">
                    <input type="text" name="nama_kolektor" value="<?php echo $_SESSION['username']; ?>" hidden="hidden">
                    <table class="table table-hover" id="table">
                      <thead>
                        <tr>
                            <th>No Invoice</th>
                            <th>Kode Pelanggan</th>
                            <th>Nama Lengkap</th>
                            <th>Wilayah</th>
                            <th>Bulan Penagihan</th>
                            <th>Status</th>
                            <th>Tarif</th>
                            <th style="width:100px">Jml Setoran</th>
                            <th class="text-center" style="width:180px">
                              <a href="javascript:void(0)" id="#btnSave" class="btn btn-sm btn-success" onclick="save()"><i class="fa fa-floppy-o"></i> Simpan</a>
                              <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="delAlltr()"><i class="fa fa-trash"></i> Hapus</button>
                            </th>
                        </tr>
                      </thead>
                      <tbody id="dataScanned">
                        <tr id="noData">
                          <td colspan="9" class="text-center text-danger"><h3>Tidak ada data! Silahkan Scan Robekan Kwitansi pada Kamera!</h3></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
