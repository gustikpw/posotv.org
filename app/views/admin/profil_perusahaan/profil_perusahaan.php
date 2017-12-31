<div class="row  border-bottom white-bg dashboard-header">

    <div class="col-md-3">
        <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
        <!-- <small>You have 42 messages and 6 notifications.</small> -->
    </div>
    <div class="col-md-6">

    </div>
    <div class="col-md-3">

    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
          <div class="row m-b-lg m-t-lg">
              <div class="col-md-5">

                  <div class="profile-image">
                      <img src="<?php echo base_url('assets/inspinia271/img/a4.jpg')?>" class="img-thumbnail m-b-md" alt="profile">
                      <a data-toggle="modal" class="btn btn-primary btn-sm btn-block" href="#modal-form" onclick="editProfil('<?php echo $profilP->id_profil ?>')"><i class="fa fa-refresh"></i> Update Profile</a>
                  </div>
                  <div class="profile-info">
                      <div class="">
                          <div>
                              <h2 class="no-margins">
                                <strong> <span class="p1"> <?php echo $profilP->nama_perusahaan; ?> </span></strong>
                              </h2>
                              <h4 class="p2"><?php echo $profilP->alias; ?></h4>
                                <span class="p3"> <?php echo $profilP->slogan; ?></span>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-7">
                  <table class="table small m-b-xs">
                      <tbody>
                      <tr>
                          <td>
                              <strong><i class="fa fa-map-marker"></i> <span class="p4"> <?php echo $profilP->alamat; ?></span></strong>
                          </td>
                          <td>
                            <strong><i class="fa fa-map-marker"></i> <span class="p7"> <?php echo $profilP->kodepos; ?></span></strong>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <strong><i class="fa fa-phone"></i> <span class="p6"> <?php echo $profilP->telp; ?></span></strong>
                          </td>
                          <td>
                            <strong><i class="fa fa-envelope"></i> <span class="p5"> <?php echo $profilP->email; ?></span></strong>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <a href="<?php echo $profilP->facebook; ?>" target="_blank" class="p8"><strong><i class="fa fa-facebook"></i> POSO.TV Page</strong></a>
                          </td>
                          <td>
                            <a href="<?php echo $profilP->youtube; ?>" target="_blank" class="p9"><strong><i class="fa fa-youtube"></i> POSO.TV Channel</strong></a>
                          </td>
                      </tr>
                      </tbody>
                  </table>
              </div>


          </div>

          <div class="modal inmodal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content animated flipInY">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <h4 class="modal-title">Update Profil Perusahaan</h4>
                          <small class="font-bold"></small>
                      </div>
                      <div class="modal-body">
                        <div class="row">

                        <form id="form" action="#" class="form-horizontal">
                            <input type="text" name="id_profil" hidden>
                            <div class="col-lg-6 b-r">
                              <div class="form-group"><label class="col-lg-2 control-label">Nama Perusahaan</label>
                                  <div class="col-lg-10"><input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                              <div class="form-group"><label class="col-lg-2 control-label">Alias</label>
                                  <div class="col-lg-10"><input type="text" name="alias" placeholder="Alias" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                              <div class="form-group"><label class="col-lg-2 control-label">Slogan</label>
                                  <div class="col-lg-10"><input type="text" name="slogan" placeholder="Slogan" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                              <div class="form-group"><label class="col-lg-2 control-label">Alamat</label>
                                  <div class="col-lg-10"><input type="text" name="alamat" placeholder="Alamat" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                                  <div class="col-lg-10"><input type="text" name="email" placeholder="Email" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                              <div class="form-group"><label class="col-lg-2 control-label">Telepon</label>
                                  <div class="col-lg-10"><input type="text" name="telp" placeholder="Telepon" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                              <div class="form-group"><label class="col-lg-2 control-label">Kode Pos</label>
                                  <div class="col-lg-10"><input type="text" name="kodepos" placeholder="Kode Pos" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                              <div class="form-group"><label class="col-lg-2 control-label">Logo</label>
                                  <div class="col-lg-10"><input type="text" name="logo" placeholder="Logo" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                              <div class="form-group"><label class="col-lg-2 control-label">Facebook</label>
                                  <div class="col-lg-10"><input type="text" name="facebook" placeholder="Facebook" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                              <div class="form-group"><label class="col-lg-2 control-label">Youtube</label>
                                  <div class="col-lg-10"><input type="text" name="youtube" placeholder="Youtube" class="form-control"> <span class="help-block m-b-none"></span>
                                  </div>
                              </div>
                            </div>
                        </form>
                      </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save changes</button>
                      </div>
                  </div>
              </div>
          </div>
