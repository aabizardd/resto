<div class="box">
    <!-- /.box-header -->
    <?php echo form_open(base_url("$this->url1/$this->url2/"),'class="form-horizontal"') ; ?>
      <div class="box-body">
        <?php if ($this->session->flashdata('berhasil_edit')) { ?>
          <?php $this->load->view('alert/berhasil_edit'); ?>
        <?php } ?>
        <?php if ($this->session->flashdata('gagal_edit')) { ?>
          <?php $this->load->view('alert/gagal_edit'); ?>
        <?php } ?>
        <div class="form-group">
          <label for="ip_printer" class="col-sm-3">IP Printer</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="ip_printer" name="ip_printer" placeholder="IP Printer" value="<?php echo @$printer->ip_printer; ?>" required="">
          </div>  
        </div>
        <div class="form-group">
          <label for="port_printer" class="col-sm-3">Port Printer</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="port_printer" name="port_printer" placeholder="Port Printer" value="<?php echo @$printer->port_printer; ?>" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="port_printer" class="col-sm-3">Cetak Ke</label>
          <div class="col-sm-9">
           
           <select class="form-control" name="cetak_ke">
             <option value="">Pilih Data</option>
             <option <?php echo @$printer->cetak_ke=='pelanggan'?'selected':'' ?> value="pelanggan">Pelanggan</option>
             <option <?php  echo @$printer->cetak_ke=='bill'?'selected':'' ?> value="bill">Bill</option>
             <option <?php  echo @$printer->cetak_ke=='dapur'?'selected':'' ?> value="dapur">Dapur</option>
           </select>
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