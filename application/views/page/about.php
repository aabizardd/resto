<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#information" data-toggle="tab">Inofrmation</a></li>
              <li><a href="#skills" data-toggle="tab">Skills</a></li>
              <li><a href="#services" data-toggle="tab">Services</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="information">
                <?php echo form_open(base_url("$this->url1/$this->url2/tambah"),'class="form-horizontal"') ; ?>
                  <div class="box-body">
                  <?php echo validation_errors(); ?>
                    <div class="form-group">
                      <label for="nama_meja" class="col-sm-3">Web Site</label>
                      <div class="col-sm-9">
                        : <a href="https://www.klampis.com/" target="_blank">Raul Gonzalez/</a>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nama_meja" class="col-sm-3">Phone</label>
                      <div class="col-sm-9">
                        : 081214111876
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nama_meja" class="col-sm-3">WhatsApp</label>
                      <div class="col-sm-9">
                        : 081214111876
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nama_meja" class="col-sm-3">Email</label>
                      <div class="col-sm-9">
                        : <a href="mailto:support@klampis.com" target="_blank">gonzalezpaulus@gmail.com</a>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nama_meja" class="col-sm-3">City</label>
                      <div class="col-sm-9">
                        : Bengkulu
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nama_meja" class="col-sm-3">Province</label>
                      <div class="col-sm-9">
                        : Bengkulu
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nama_meja" class="col-sm-3">Addres</label>
                      <div class="col-sm-9">
                        : Jalan Hibrida ujung no 1
                      </div>
                    </div>
                  <?php echo form_close(); ?>
                  </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="skills">
                <!-- The timeline -->
               
                  <!-- /.info-box-content -->
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
