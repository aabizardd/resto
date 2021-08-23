<div class="row">
    <!-- /.box-header -->
  <div class="col-sm-12">
  <?php if ($this->session->flashdata('berhasil_simpan')) { ?>
    <?php $this->load->view('alert/berhasil_simpan'); ?>
  <?php } ?>

  <?php if ($this->session->flashdata('berhasil_edit')) { ?>
    <?php $this->load->view('alert/berhasil_edit'); ?>
  <?php } ?>

  <?php if ($this->session->flashdata('berhasil_hapus')) { ?>
    <?php $this->load->view('alert/berhasil_hapus'); ?>
  <?php } ?>
  
  <?php echo validation_errors(); ?>
      <div class="box" style="display: none;">
      <div class="box-header with-border">
        <h3 class="box-title">Transaksi</h3>
      </div>
        <div class="box-body">
          <?php echo form_open(base_url("$this->url1/$this->url2/tambah")) ; ?>
          <div class="row">
              <div class="col-sm-2">
                <label for="id_transaksi_penjualan">No. Transaksi</label>
                  <input type="text" class="form-control" id="id_transaksi_penjualan" name="id_transaksi_penjualan" value="<?php echo $kodeotomatis; ?>" required="" readonly="">
              </div>
              <div class="col-sm-2">
                <label for="id_user">Pelayan</label>
                  <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $this->datalogin->id_user ?>" required="" readonly="" >
              </div>
              <div class="col-sm-2">
                <label for="id_meja">Meja</label>
                  <select name="id_meja" id="id_mejax" class="form-control" required="">
                    <option value="">** Pilih Meja **</option>
                    <?php foreach ($datameja as $value) { ?>
                    <option value="<?php echo $value['id_meja']; ?>"><?php echo $value['nama_meja']; ?></option>
                    <?php } ?>
                  </select>
              </div>
              <div class="col-sm-2">
                <label for="tanggal_transaksi">Tanggal</label>
                  <input type="text" class="form-control" id="tanggal" name="tanggal_transaksi" value="<?php echo date('d-m-Y'); ?>" required="" >
              </div>
              <div class="col-sm-2">
                <label for="total_transaksi">Total Transaksi</label>
                  <input type="text" class="form-control" value="Rp. <?php echo number_format($datatotaltransaksisementara, 0, ',', '.') ; ?>,00" readonly="" required="" >
                  <input type="hidden" class="form-control" name="total_transaksi" value="<?php echo $datatotaltransaksisementara; ?>" readonly="" required="" >
              </div>
              <div class="col-sm-2">
                <label for="aksi" class="col-sm-12">Aksi</label>
                <div class="col-sm-12">

                  <input type="submit" name="simpan" class="btn btn-success btn-block " value="Simpan">

                </div>
              </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
  </div>

  <div class="col-sm-8">
      <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Data Produk</h3>
          </div>
          <div class="box-body" style="height: 320px; overflow: scroll;">
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">

              <?php if ($kategori->num_rows()>0): ?>
                
              <?php foreach ($kategori->result() as $t): ?>
              <li class=""><a class="menuiteme" href="#" data-href="<?php echo base_url("/pelayan/transaksi/getPage/".$t->id_produk_kategori); ?>" data-toggle="tab" aria-expanded="false"><?php echo $t->produk_kategori ?></a></li>
                
              <?php endforeach ?>
              <?php endif ?>

            <!--   <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Dropdown <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                </ul>
              </li> -->
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" >
                <center><h5>Silahkan Pilih Menu Terlebih Dahulu</h5></center>
                </div>
              <!-- /.tab-pane -->
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
             
          </div>
      </div>
  </div>

  <div class="col-sm-4">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Produk</h3>
        </div>
        <div class="box-body">
        <?php echo form_open(base_url("$this->url1/$this->url2/tambah"),'class="form-horizontal"') ; ?>
          <div class="form-group">
            <label for="id_produk" class="col-sm-4">ID</label>
            <div class="col-sm-8">
              <input type="text" class="form-control reset" id="id_produk" name="id_produk" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="nama_produk" class="col-sm-4">Produk</label>
            <div class="col-sm-8">
              <input type="hidden" class="form-control" id="id_transaksi_penjualan" name="id_transaksi_penjualan" value="<?php echo $kodeotomatis; ?>" readonly="">
              <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $this->datalogin->id_user; ?>" readonly="">
              <input type="text" class="form-control reset" id="nama_produk" name="nama_produk" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="harga_produk" class="col-sm-4">Harga</label>
            <div class="col-sm-8">
              <input type="text" class="form-control reset" id="harga_produk" name="harga_produk" readonly="" >
            </div>
          </div>
          <div class="form-group">
            <label for="harga_produk" class="col-sm-4">Diskon (dalam %)</label>
            <div class="col-sm-8">
              <input type="text" class="form-control reset" id="diskon_produk" name="diskon_produk" readonly="" >
              <input type="hidden" name="total_diskon" id="total_diskon">
            </div>
          </div>
          <div class="form-group">
            <label for="jumlah_produk" class="col-sm-4">Jumlah</label>
            <div class="col-sm-8">
              <input type="number" class="form-control reset" onchange="subTotal(this.value)" onkeyup="subTotal(this.value)" min="0" id="jumlah_transaksi" name="jumlah_transaksi" required="">
              <input type="hidden" name="diskon_angka" id="diskon_angka">
              <input type="hidden" name="total_semua" id="total_semua">
            </div>
          </div>
          
          <div class="form-group">
            <label for="total_transaksi" class="col-sm-4">Sub Total</label>
            <div class="col-sm-8">
              <input type="text" class="form-control reset" id="total_transaksi" name="total_transaksi" readonly="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <input type="submit" name="submit" class="btn btn-primary" value="Tambah">
                <input type="reset" class="btn btn-danger" value="Hapus">
            </div>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>

  <div class="col-sm-12" >
      <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data Pemesanan</h3>
      </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <tbody>
              <tr>
                <th>No.</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
               
                <th>Total Sebelum Diskon</th>
                <th>Diskon(%)</th>
                <th>Total Setelah Diskon</th>

                <th>Aksi</th>
              </tr>
              <?php
              $no = 1;
              foreach ($datatransaksisementara as $value) { ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $value['id_produk']; ?></td>
                <td><?php echo $value['nama_produk']; ?></td>
                <td>Rp. <?php echo number_format($value['harga_produk'], 0, ',', '.'); ?>,00</td>

                <td>Rp. <?php echo number_format($value['total_semua'], 0, ',', '.'); ?>,00</td>
                <td><?php echo $value['diskon_persen'] ?></td>
                <td>Rp. <?php echo number_format($value['total_transaksi'], 0, ',', '.'); ?>,00</td>
               
                <td>
                  <a href="<?php echo base_url("$this->url1/$this->url2/hapus_transaksi/".$value['id_transaksi_penjualan_detail_sementara']); ?>" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php
              $no++;
            }
              ?>
            </tbody>
            <tfoot>
              <tr>
                  <td colspan="6"><b>Total Harga Pemesanan</b></td>
                  <td colspan="2">
                    <b>Rp. <?php echo number_format($datatotaltransaksisementara, 0, ',', '.') ; ?>,00</b>
                  </td>
                </tr>
            </tfoot>
          </table>
          <div class="col-lg-3 pull-right">
            <br>
                  <button type="button" data-href="<?php echo base_url('pelayan/transaksi/cart') ?>" class="btn btn-info btn-block btn-modal" data-toggle="modal" data-title="Transaksi Langsung" data-target="#myModal">Selanjutnya</button>
          </div>
        </div>
      </div>
  </div>
</div>


<!-- MODAL BAYAR -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div id="mdl-bdy">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
