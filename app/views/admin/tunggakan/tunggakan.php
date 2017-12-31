<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-5">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
        <div class="ibox-content ibox-heading animated fadeInDown tampil" style="display:none">
          <h3><span class="v1 font-bold">KWA001</span>
              <div class="stat-percent text-warning"><span class="v2">Rp. 300.000,- </span><i class="fa fa-warning"></i></div>
          </h3>
          <h3><span class="v3">Gusti Ketut Putra Wijaya</span></h3>
          <small>
            <i class="fa fa-map"></i> <span class="v4"> Jl. Otto Iskandar Dinata | </span>
            <i class="fa fa-map-marker"></i> <span class="v5"> Kawua A </span>
            <span class="pull-right"><i class="fa fa-circle-o"></i> <span class="v6"> Aktif</span></span>
          </small>
        </div>
        <!-- <small>You have 42 messages and 6 notifications.</small> -->
    </div>
    <div class="col-md-2">
    </div>
    <div class="col-md-5">
      <div class="input-group"><input type="search" name="kode_invoice" placeholder="Kode Pelanggan/No. Invoice" class="form-control" onkeyup="setUpper()" onsearch="getData()">
        <span class="input-group-btn">
          <button type="button" class="btn btn-primary" onclick="getData()"><span class="fa fa-search"></span> Go!</button>
        </span>
      </div>
      <span class="help-block m-b-none text-warning font-italic">Masukan Kode Pelanggan/No. Invoice jika scanner tidak bekerja!</span>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-lg-6">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5><?php echo ucwords(str_replace('_',' ',$active)); ?></h5>
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
                  <div class="col-lg-12">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                            <th>No Invoice</th>
                            <th>Bulan Penagihan</th>
                            <th>Status</th>
                            <th>Tarif</th>
                        </tr>
                      </thead>
                      <tbody id="tableTunggakan">
                        <tr><td colspan="4" class="font-bold text-danger text-center">Tidak ada data!</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5>Pembayaran Terakhir</h5>
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
                  <div class="col-lg-12">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                            <th>No Invoice</th>
                            <th>Bulan Penagihan</th>
                            <th>Status</th>
                            <th>Tarif</th>
                            <th style="width:100px">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="tableLastPembayaran">
                        <tr><td colspan="5" class="font-bold text-danger text-center">Tidak ada data!</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
