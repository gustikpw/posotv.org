<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-12">
      <h2><?php echo ucwords(str_replace('_',' ',$active)); ?></h2>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1"> Pelanggan</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Kwitansi</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Surat</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="col-lg-6">
                              <form role="form" id="form_inv_key">
                                  <h3></h3>
                                  <div class="form-group">
                                    <label class="text-warning">Wilayah</label>
                                    <select class="form-control" name="wilayah">
                                      <option value="">-- Pilih Wilayah --</option>
                                      <option value="0">Semua</option>
                                      <option value="40">KAP | Kapling</option>
                                      <option value="41">KM9 | KM9</option>
                                      <option value="42">KOM | Kompi</option>
                                      <option value="43">KWA | Kawua A</option>
                                      <option value="44">KWB | Kawua B</option>
                                      <option value="45">KWC | Kawua C</option>
                                      <option value="46">KWD | Kawua D</option>
                                      <option value="47">KWE | Kawua E</option>
                                      <option value="48">KWF | Kawua F</option>
                                      <option value="49">KWG | Kawua G</option>
                                      <option value="50">KWH | Kawua H</option>
                                      <option value="51">LEM | Lembomawo</option>
                                      <option value="52">MAL | Maliwuko</option>
                                      <option value="53">MOR | Morarena</option>
                                      <option value="54">RAN | Ranononcu</option>
                                      <option value="55">SAY | Sayo</option>
                                      <option value="56">TAG | Tagolu</option>
                                      <option value="57">TAM | Tambaro</option>
                                    </select>
                                    <span class="help-block m-b-none"></span>
                                  </div>

                                  <div class="form-group">
                                    <button class="btn btn-sm btn-primary" type="button" id="generate">Generate</button>
                                  </div>
                              </form>
                              <div class="border-bottom"></div>
                            </div>
                            <div class="col-lg-6">

                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                          <div class="col-md-6">

                          </div>
                          <div class="col-md-6">

                          </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                          <div class="col-lg-12">

                          </div>
                        </div>
                    </div>
                </div>


            </div>
          </div>
        </div>

      
      </div>
