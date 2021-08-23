<div class="row">
    <!-- /.box-header -->
  <div class="col-sm-12">
  <?php if ($this->session->flashdata('berhasil_simpan')) { ?>
    <?php $this->load->view('alert/berhasil_simpan'); ?>
  <?php } ?>

  <?php if ($this->session->flashdata('berhasil_edit')) { ?>
    <?php $this->load->view('alert/berhasil_edit'); ?>
  <?php } ?>

  <?php if ($this->session->flashdata('gagal_edit')) { ?>
    <?php $this->load->view('alert/gagal_edit'); ?>
  <?php } ?>

  <?php if ($this->session->flashdata('berhasil_hapus')) { ?>
    <?php $this->load->view('alert/berhasil_hapus'); ?>
  <?php } ?>
  
  <?php echo validation_errors(); ?>
      <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Transaksi</h3>
      </div>
        <div class="box-body">
          <?php echo form_open(base_url("$this->url1/$this->url2/edit/".$editdatatransaksi->id_transaksi_penjualan)) ; ?>
          <div class="row">
              <div class="col-sm-2">
                <label for="id_transaksi_penjualan">No. Transaksi</label>
                  <input type="text" class="form-control" id="id_transaksi_penjualan" name="id_transaksi_penjualan" value="<?php echo $editdatatransaksi->id_transaksi_penjualan; ?>" required="" readonly="">
              </div>
              <div class="col-sm-2">
                <label for="id_user">Pelayan</label>
                  <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $editdatatransaksi->id_user; ?>" required="" readonly="" >
              </div>
              <div class="col-sm-2">
                <label for="id_meja">Meja</label>
                  <select name="id_meja" id="id_meja" class="form-control" required="">
                    <option value="<?php echo $editdatatransaksi->id_meja; ?>">** <?php echo $editdatatransaksi->nama_meja; ?> **</option>
                    <?php foreach ($datameja as $value) { ?>
                    <option value="<?php echo $value['id_meja']; ?>"><?php echo $value['nama_meja']; ?></option>
                    <?php } ?>
                  </select>
              </div>
              <div class="col-sm-2">
                <label for="tanggal_transaksi">Tanggal</label>
                  <input type="text" class="form-control" id="tanggal" name="tanggal_transaksi" value="<?php echo date("d-m-Y", strtotime($editdatatransaksi->tanggal_transaksi)); ?>" required="" >
              </div>
              <div class="col-sm-2">
                <label for="total_transaksi">Total Transaksi</label>
                  <input type="text" class="form-control" value="Rp. <?php echo number_format($datatotaltransaksidetail, 0, ',', '.') ; ?>,00" readonly="" required="" >
              </div>
              <div class="col-sm-2">
                <label for="aksi" class="col-sm-12">Aksi</label>
                <div class="col-sm-12">
                  <input type="submit" name="simpan" class="btn btn-success btn-block" value="Perbaharui">
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
        <?php echo form_open(base_url("$this->url1/$this->url2/edit/".$editdatatransaksi->id_transaksi_penjualan),'class="form-horizontal"') ; ?>
          <div class="form-group">
            <label for="id_produk" class="col-sm-4">ID</label>
            <div class="col-sm-8">
              <input type="text" class="form-control reset" id="id_produk" name="id_produk" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="nama_produk" class="col-sm-4">Produk</label>
            <div class="col-sm-8">
 <input type="hidden" class="form-control" id="id_transaksi_penjualan" name="id_transaksi_penjualan" value="<?php echo $editdatatransaksi->id_transaksi_penjualan; ?>" readonly="">
              <input type="hidden" class="form-control" id="id_user" name="id_user" value="admin" readonly="">
              <input type="text" class="form-control reset" id="nama_produk" name="nama_produk" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="harga_produk" class="col-sm-4">Harga</label>
            <div class="col-sm-8">
              <input type="text" class="form-control reset" id="harga_produk" name="harga_produk" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="harga_produk" class="col-sm-4">Diskon (dalam %)</label>
            <div class="col-sm-8">
              <input type="text" class="form-control reset" id="diskon_produk" name="diskon_produk" readonly="">
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

  <div class="col-sm-12">
      <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data Pemesanan</h3>
      </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <tbody>
               <table class="table table-bordered table-striped table-hover">
            <tbody>
              <tr>
                <th>No.</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
               <th>Qty</th>
                <th>Total Sebelum Diskon</th>
                <th>Diskon(%)</th>
                <th>DIskon</th>
                <th>Total Setelah Diskon</th>

                <th>Aksi</th>
              </tr>
              <?php
              $no = 1;

              $totalsemua = 0;
              $totaldiskon = 0;
              
              foreach ($editdatatransaksidetail as $value) {
  $totalsemua += $value['total_semua'];
                $totaldiskon += $value['diskon_angka'];


               ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $value['id_produk']; ?></td>
                <td><?php echo $value['nama_produk']; ?></td>
                <td>Rp. <?php echo number_format($value['harga_produk'], 0, ',', '.'); ?>,00</td>
                                                <td><?php echo $value['jumlah_transaksi']; ?></td>

                <td>Rp. <?php echo number_format($value['total_semua'], 0, ',', '.'); ?>,00</td>
                <td><?php echo $value['diskon_persen'] ?></td>
                <td><?php echo $value['diskon_angka'] ?></td>
                <td>Rp. <?php echo number_format($value['total_transaksi'], 0, ',', '.'); ?>,00</td>

                 <td>
                  <a href="<?php echo base_url("$this->url1/$this->url2/hapus_transaksi_edit/".$editdatatransaksi->id_transaksi_penjualan."/".$value['id_transaksi_penjualan_detail']); ?>" class="btn btn-xs btn-danger">
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
                  <td colspan="7"><b>Total Harga Pemesanan</b></td>
                  <td colspan="2">
                    <b>Rp. <?php echo number_format($datatotaltransaksidetail, 0, ',', '.') ; ?>,00</b>
                  </td>
                </tr>
            </tfoot>
          </table>



           <?php if ($pembayaran_detail->num_rows()>0): ?>
            <h3>Rincian </h3>
            <?php 
            $pembayaran = $pembayaran_detail->row();
             ?>
            <div class="row">
                <div class="col-lg-6">
                  <table class="table table-striped">
                    <tr>
                      <td>Total Semua (Belum Diskon & Lain)</td><td><?php echo $totalsemua ?></td>
                    </tr>
                    <tr>
                      <td>Total Diskon</td><td><?php echo '- '.$totaldiskon ?></td>
                    </tr>
                    <tr>
                      <td></td><td><?php echo $totalsemua-$totaldiskon ?></td>
                    </tr>
                    <tr>

                      <?php 

                      $totals = $totalsemua-$totaldiskon;
                      $service_fee_angka = $totals * ($pembayaran->service_fee_persen/100);
                      $pajak_angka = $totals * ($pembayaran->pajak_persen/100);

                      $semuanya = $totals + $service_fee_angka +$pajak_angka;
                       ?>
                      <td>Service Fee (<b><?php echo $pembayaran->service_fee_persen.'%' ?></b>)</td>
                      <td><?php echo '+ '.$service_fee_angka ?></td>
                    </tr>
                    <tr>
                      <td>Pajak (<b><?php echo $pembayaran->pajak_persen.'%' ?></b>)</td>
                      <td><?php echo '+ '.$pajak_angka ?></td>
                    </tr>
                    <tr>
                      <td><span style="font-size: 20px;">Total Transaksi</span></td>
                      <td>
                        <span id="total_transaksine" style="display: none;"><?php echo $semuanya ?></span><span style="font-size: 25px;font-weight: bold"><?php echo $semuanya ?></span></td>
                    </tr>
                  </table>
                </div>

                   <?php if ($pembayaran_detail->num_rows()>0): ?>

        <div class="col-sm-6">
          <form action="<?php echo base_url("kasir/transaksi/update/".$editdatatransaksi->id_transaksi_penjualan) ?>" method="post">

            <input type="hidden" name="total_semua" value="<?php echo $totalsemua ?>">
            <input type="hidden" name="total_diskon" value="<?php echo $totaldiskon ?>">
            <input type="hidden" name="service_fee_angka" value="<?php echo $service_fee_angka ?>">
            <input type="hidden" name="pajak_angka" value="<?php echo $pajak_angka ?>">
            <input type="hidden" name="total_transaksi" value="<?php echo $semuanya ?>">
            <div class="form-group">
              <label>Tunai</label>
              <input type="text" name="tunai" class="form-control" value="<?php echo $pembayaran->tunai ?>" id="tunaine"> 
            </div>
            <div class="form-group">
              <label>DP</label>
              <input type="text" name="dp" class="form-control" value="<?php echo $pembayaran->dp ?>"> 
            </div>
            <div class="form-group">
              <label>Voucher</label>
              <input type="text" name="voucher" class="form-control" value="<?php echo $pembayaran->voucher ?>"> 
            </div>
            <div class="form-group">
              <label>Card</label>
              <input type="text" name="card" class="form-control" value="<?php echo $pembayaran->card ?>"> 
            </div>
            <div class="form-group">
              <label>Kredit</label>
              <input type="text" name="kredit" class="form-control" value="<?php echo $pembayaran->kredit ?>"> 
              <input type="hidden" name="kembalian" id="kurangane">
            </div>
            <div class="form-group">
              <label>Status Transaksi</label>
              <select class="form-control" name="status_transaksi">
                <option value="">Pilih Status Transaksi</option>
                <option <?php echo $editdatatransaksi->status_pembayaran_transaksi =="Sudah Bayar" ? "selected":"" ?> value="Sudah Bayar">Sudah Bayar</option>
                <option <?php echo $editdatatransaksi->status_pembayaran_transaksi =="Belum Bayar" ? "selected":"" ?> value="Belum Bayar">Belum Bayar</option>

              </select>
            </div>
            <div class="form-group">
              <label>Terima Semua Pesanan</label>
             
             <select class="form-control" name="terima">
              <option value="0">Pilih</option>
                <option value="1">Terima</option>
              <option value="2">Tolak</option>
             </select>
            </div>
            <div class="form-group">
              <label>Kembalian</label><br>
              <span id="kembaliane" style="font-size: 25px;font-weight: bold;"><?php echo $pembayaran->kembali ?></span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-bayaran">Bayar</button>
            </div>
          </form>

<div class="pull-right">
  <a class="btn btn-default" href="<?php echo base_url('kasir/transaksi/cetak-nota/'.$editdatatransaksi->id_transaksi_penjualan) ?>">Cetak Nota Penjualan</a>
  <a class="btn btn-default"  href="<?php echo base_url('kasir/transaksi/billing-note/'.$editdatatransaksi->id_transaksi_penjualan) ?>">Bill</a>
  <a  href="<?php echo base_url('kasir/transaksi/kitchen-slip/'.$editdatatransaksi->id_transaksi_penjualan) ?>" class="btn btn-default">Kitchen Slip</a>
</div>

        </div>

      <?php endif ?>
            </div>
          <?php endif ?>

        </div>
      </div>
  </div>
</div>