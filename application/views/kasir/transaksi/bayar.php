
    <?php if ($this->session->flashdata('berhasil_simpan')) { ?>
      <?php $this->load->view('alert/berhasil_simpan'); ?>
    <?php } ?>

    <?php if ($this->session->flashdata('berhasil_edit')) { ?>
      <?php $this->load->view('alert/berhasil_edit'); ?>
    <?php } ?>

    <?php if ($this->session->flashdata('berhasil_hapus')) { ?>
      <?php $this->load->view('alert/berhasil_hapus'); ?>
    <?php } ?>


<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      <!-- Main content -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <?php echo $web->nama_web; ?>
            <small class="pull-right">Tanggal Transaksi : <?php echo $detailtransaksi->tanggal_transaksi; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-3 invoice-col">
          <b>Karyawan :</b>
          <address>
            <strong><?php echo $detailtransaksi->nama_karyawan; ?></strong><br>
            <?php echo $detailtransaksi->alamat_karyawan; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          <b>Meja :</b>
          <address>
            <strong>ID Meja : <?php echo $detailtransaksi->id_meja; ?></strong><br>
            Nama Meja : <?php echo $detailtransaksi->nama_meja; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          <b>Faktur</b><br>
          <b>No. Transaksi:</b> <?php echo $detailtransaksi->id_transaksi_penjualan; ?><br>
          <b>Tanggal Transaksi:</b> <?php echo $detailtransaksi->tanggal_transaksi; ?><br>
        </div>
        <div class="col-sm-3 invoice-col">
          <b>Nama Pelanggan:</b> <br><?php echo $detailtransaksi->pelanggan; ?><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
             
              <tr>
                <th>No.</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                                <th>Status</th>
                                <th>Catatan</th>
                <th>Harga Produk</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $totalsemua = 0;
              $totaldiskon = 0;
              foreach ($datadetailtransaksi as $value) {


                $totalsemua += $value['total_semua'];
                $totaldiskon += $value['diskon_angka'];


               ?>
              <tr <?php if ($value['status_transaksi'] == "Tolak") { ?> class="bg-red-active" <?php } ?>>
                <td><?php echo $no; ?></td>
                <td><?php echo $value['id_produk']; ?></td>
                <td><?php echo $value['nama_produk']; ?></td>
                <td><?php echo $value['status_transaksi']; ?></td>
                <td><?php echo $value['catatan_status_detail']; ?></td>
                <?php if ($value['status_transaksi'] == "Tolak") { ?>
                <td colspan="3"></td>
                <?php } else { ?>
                <td>Rp. <?php echo number_format($value['harga_produk'], 0, ',', '.'); ?>,00</td>
                <td><?php echo $value['jumlah_transaksi']; ?></td>
                                <td>Rp. <?php echo number_format($value['diskon_angka'], 0, ',', '.'); ?>,00</td>

                <td>Rp. <?php echo number_format($value['total_transaksi'], 0, ',', '.'); ?>,00</td>
                <?php } ?>
              </tr>
              <?php
              $no++;
              }
              ?>
            </tbody>
            <tfoot>
              <tr>
                  <td colspan="8"><b>Total Harga Pemesanan</b></td>
                  <td colspan="2">
                    <b>Rp. <?php echo number_format($datatotaltransaksisementara, 0, ',', '.') ; ?>,00</b>
                  </td>
                </tr>
            </tfoot>
          </table>
<br>
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
                      <td>
                        <span id="total_transaksine" style="display: none;"> <?php echo $semuanya ?></span>
                        <span style="font-size: 20px;">Total Transaksi</span></td>
                      <td><span style="font-size: 25px;font-weight: bold"><?php echo $semuanya ?></span></td>
                    </tr>
                  </table>
                </div>
            </div>
          <?php endif ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-sm-6">
          <form action="http://localhost/scafe/admin/meja/tambah" class="form-horizontal" method="post" accept-charset="utf-8">
              <div class="form-group">
                <label for="id_user" class="col-sm-3">ID Kasir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $this->datalogin->id_user; ?>" placeholder="ID User" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label for="nama_karyawan" class="col-sm-3">Nama Kasir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="<?php echo $this->datalogin->nama_karyawan; ?>" placeholder="Nama Karyawan" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label for="level" class="col-sm-3">Status</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="level" name="level" value="<?php echo $this->datalogin->level; ?>" placeholder="Status Karyawan" readonly="">
                </div>
              </div>
          </form>          
        </div>
                   <?php if ($pembayaran_detail->num_rows()>0): ?>

        <div class="col-sm-6">
          <form action="<?php echo base_url("kasir/transaksi/update/".$detailtransaksi->id_transaksi_penjualan) ?>" method="post">

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
            </div>
            <div class="form-group">
              <label>Status Transaksi</label>
              <select class="form-control" name="status_transaksi">
                <option value="">Pilih Status Transaksi</option>
                <option <?php echo $detailtransaksi->status_pembayaran_transaksi =="Sudah Bayar" ? "selected":"" ?> value="Sudah Bayar">Sudah Bayar</option>
                <option <?php echo $detailtransaksi->status_pembayaran_transaksi =="Belum Bayar" ? "selected":"" ?> value="Belum Bayar">Belum Bayar</option>

              </select>
            </div>
            <div class="form-group">
              <label>Kembalian</label><br>
              <span id="kembaliane" style="font-size: 25px;font-weight: bold;"><?php echo $pembayaran->tunai-$semuanya ?></span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Bayar</button>
            </div>
          </form>
        </div>

      <?php endif ?>
        <div class="col-sm-6" style="display: none;">
          <?php echo form_open(base_url("$this->url1/$this->url2/bayar/".$detailtransaksi->id_transaksi_penjualan),'class="form-horizontal"') ; ?>
              <div class="form-group">
                <label for="total_transaksi" class="col-sm-3">Total</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $this->datalogin->id_user; ?>" placeholder="ID User" readonly="">
                    <input type="text" class="form-control" id="total_transaksi" name="total_transaksi" value="<?php echo number_format($semuanya, 0, ',', '.') ; ?>" placeholder="Total Transaksi" readonly="">
                    <span class="input-group-addon">,00</span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="bayar_transaksi" class="col-sm-3">Bayar</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control bayar" id="pembayaran_transaksi" name="pembayaran_transaksi" onchange="hitungKembalian(this.value)" onkeyup="hitungKembalian(this.value)" min="0">
                    <span class="input-group-addon">,00</span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="kembalian_transaksi" class="col-sm-3">Kembalian</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="kembalian_transaksi" name="kembalian_transaksi" value="" placeholder="Kembalian" readonly="">
                    <span class="input-group-addon">,00</span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-3 col-lg-9">
                    <input type="submit" name="submit" id="selesai" disabled="disabled" class="btn btn-primary" value="Bayar">
                    <input type="submit" name="bayarcetak" id="bayarcetak" disabled="disabled" class="btn btn-success" value="Bayar dan Cetak">
                    <input type="reset" name="reset" class="btn btn-warning" value="Hapus">
                </div>
              </div>
          <?php echo form_close(); ?>        
        </div>
      </div>
    </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->  