<div class="box">
    <!-- /.box-header -->
    <?php echo form_open(base_url("$this->url1/$this->url2/"),'class="form-horizontal"') ; ?>
      <div class="box-body">
        <?php if ($this->session->flashdata('berhasil_edit')) { ?>
          <?php $this->load->view('alert/berhasil_edit'); ?>
        <?php } ?>
        <div class="form-group">
          <label for="nama_web" class="col-sm-3">Nama Aplikasi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_web" name="nama_web" placeholder="Nama Web" value="<?php echo $web->nama_web; ?>" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="slogan_web" class="col-sm-3">Deskripsi Aplikasi</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="slogan_web" placeholder="Deskripsi Aplikasi" required=""><?php echo $web->slogan_web; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="telp_web" class="col-sm-3">Telepon Aplikasi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="telp_web" name="telp_web" placeholder="Telepon Aplikasi"  value="<?php echo $web->telp_web; ?>" required="">
          </div>
        </div> 
        <div class="form-group">
          <label for="fax_web" class="col-sm-3">Fax Aplikasi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="fax_web" name="fax_web" placeholder="Fak Aplikasi"  value="<?php echo $web->fax_web; ?>" required="">
          </div>
        </div> 
        <div class="form-group">
          <label for="alamat_web" class="col-sm-3">Alamat Aplikasi</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="alamat_web" placeholder="Alamat Aplikasi" required=""><?php echo $web->alamat_web; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="kabupaten_web" class="col-sm-3">Kabupaten Aplikasi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="kabupaten_web" name="kabupaten_web" placeholder="Kabupaten Aplikasi"  value="<?php echo $web->kabupaten_web; ?>"  required="">
          </div>
        </div> 
        <div class="form-group">
          <label for="email_web" class="col-sm-3">Email Aplikasi</label>
          <div class="col-sm-9"> 
            <input type="text" class="form-control" id="email_web" name="email_web" value="<?php echo $web->email_web; ?>" placeholder="Email Aplikasi" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="author_web" class="col-sm-3">Author Aplikasi</label>
          <div class="col-sm-9"> 
            <input type="text" class="form-control" id="author_web" name="author_web" value="<?php echo $web->author_web; ?>" placeholder="Author Web" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="deskripsi_web" class="col-sm-3">Deskripsi Aplikasi</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="deskripsi_web" name="deskripsi_web" placeholder="Deskripsi Web" required=""><?php echo $web->deskripsi_web; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="keyword_web" class="col-sm-3">Keyword Aplikasi</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="keyword_web" name="keyword_web" placeholder="Keyword Web" required=""><?php echo $web->keyword_web; ?></textarea>
          </div>
        </div>  
        <div class="form-group">
          <label for="tahun_web" class="col-sm-3">Tahun Aplikasi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="tahun_web" name="tahun_web" placeholder="Tahun Web" value="<?php echo $web->tahun_web; ?>"  required="">
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-9">
              <input type="submit" name="submit" class="btn btn-primary" value="Perbaharui">
          </div>
        </div>
      </div>
      <!-- /.box-footer -->
    <?php echo form_close(); ?>
    <!-- /.box-body -->
</div>
<!-- /.box -->
<h3><?php echo $judul2; ?></h3>
<div class="box">
    <!-- /.box-header -->
    <form class="form-horizontal" action="<?php echo base_url("$this->url1/$this->url2/"); ?>" method="post" enctype="multipart/form-data" />
      <div class="box-body">
        <?php if ($this->session->flashdata('berhasil_upload')) { ?>
          <?php $this->load->view('alert/berhasil_upload'); ?>
        <?php } ?>
        <?php if ($this->session->flashdata('gagal_upload')) { ?>
          <?php $this->load->view('alert/gagal_upload'); ?>
        <?php } ?>
        <div class="form-group">
          <label for="logo_web" class="col-sm-3">Logo Sebelumnya</label>
          <div class="col-sm-9">
            <img src="<?php echo base_url('assets/images/logo/'.$web->logo_web); ?>" width="150px">
          </div>
        </div>
        <div class="form-group">
          <label for="logo_web" class="col-sm-3">Logo Baru</label>
          <div class="col-sm-9">
            <input type="file" class="form-control" id="logo_web" name="logo_web" placeholder="Logo Web">
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-9">
              <input type="submit" name="upload" class="btn btn-primary" value="Perbaharui">
          </div>
        </div>
      </div>
      <!-- /.box-footer -->
    </form>
    <!-- /.box-body -->
</div>
<!-- /.box -->