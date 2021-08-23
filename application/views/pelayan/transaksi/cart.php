 <form action="<?php echo base_url('pelayan/transaksi/bayar-langsung') ?>" method="post" id="form">

    <div class="row">
              <div class="col-lg-2">
                <label for="id_transaksi_penjualan">No. Transaksi</label>
                  <input type="text" class="form-control" id="id_transaksi_penjualan" name="id_transaksi_penjualan" value="<?php echo $kodeotomatis; ?>" required="" readonly="">
              </div>
              <div class="col-lg-2">
                <label for="id_user">Pelayan</label>
                  <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $this->datalogin->id_user ?>" required="" readonly="" >
              </div>
              <div class="col-lg-2">
                <label for="id_meja">Meja</label>
                  <select name="id_meja" id="id_meja" class="form-control" required="">
                    <option value="">** Pilih Meja **</option>
                    <?php foreach ($datameja as $value) { ?>
                    <option value="<?php echo $value['id_meja']; ?>"><?php echo $value['nama_meja']; ?></option>
                    <?php } ?>
                  </select>
              </div>
                    <div class="col-lg-3">
                <label for="pelanggan">Pelanggan</label>
                <input type="text" name="pelanggan" class="form-control" id="pelanggan">
              </div>
  <div class="col-lg-2">
                <label for="tanggal_transaksi">Tanggal</label>
                  <input type="text" class="form-control" id="tanggal" name="tanggal_transaksi" value="<?php echo date('d-m-Y'); ?>" required="" >
              </div>
            </div>
            
              
          <br>


          <table class="table table-bordered table-striped table-hover">
            <tbody>
              <tr>
                <th> Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Sebelum Dskon</th>
                <th>Diskon(%)</th>
                <th>Total Setelah Diskon</th>
              </tr>
              <?php
              $no = 1;
              $total_semua = 0;
              foreach ($datatransaksisementara as $value) {
                $total_semua += $value['total_semua'];
               ?>
              <tr>
                <td><?php echo $value['nama_produk']; ?></td>
                <td>Rp. <?php echo number_format($value['harga_produk'], 0, ',', '.'); ?>,00</td>
                <td><?php echo $value['jumlah_transaksi']; ?></td>
                <td>Rp. <?php echo number_format($value['total_semua'], 0, ',', '.'); ?>,00</td>
                <td><?php echo $value['diskon_persen'] ?></td>
                <td>Rp. <?php echo number_format($value['total_transaksi'], 0, ',', '.'); ?>,00</td>
               
              </tr>
              <?php
              $no++;
            }
              ?>
            </tbody>
            <tfoot>
              <tr>
                  <td colspan="3"><b>Total Harga Pemesanan</b></td>
                  <td>Rp. <?php echo number_format($total_semua,0,',','.') ?>,00</td>
                  <td></td>
                  <td colspan="1">
                    <b>Rp. <?php echo number_format($datatotaltransaksisementara, 0, ',', '.') ; ?>,00</b>
                  </td>
                </tr>
            </tfoot>
          </table>

<br>
<div class="row">
  <div class="col-lg-6">
    <h4>Total</h4>
          <table class="table table-striped">
            <tr>
              <td>Nilai Total</td><td><input type="text" readonly name="total_semua" class="form-control" value="<?php echo $sum_total[0]->total ?>"></td>
            </tr>
            <tr>
              <td>Diskon Total</td><td><input type="text" readonly class="form-control" name="diskon_total" value="<?php echo $sum_diskon[0]->diskon ?>"></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="text" name="total" readonly class="form-control" value="<?php echo $datatotaltransaksisementara ?>"></td>
            </tr>
            <tr>
              <td>Service Fee</td><td><input type="text" readonly name="service_fee_angka" class="form-control" value="<?php echo $keServiceFee ?>">
                <input type="hidden" name="service_fee_persen" value="<?php echo $serv ?>">

              </td>
            </tr>
            <tr>
              <td>Pajak <?php echo $pjk.'%' ?></td><td><input readonly type="text" class="form-control" name="pajak_angka" value="<?php echo $kePajak ?>">
                <input type="hidden" name="pajak_persen" value="<?php echo $pjk ?>">
              </td>
            </tr>
            <tr>
              <td>Total</td><td><h3 id="totale"><?php echo number_format($totalSemua,0,',','.') ?></h3><input type="hidden" class="form-control" name="totall" value="<?php echo $totalSemua ?>"></td>
            </tr>
          </table>
  </div>
  <div class="col-lg-6">
       <h4>Pembayaran</h4>
          <table  class="table table-striped">
            
            <tr>
              <td>Tunai</td><td><input type="text" class="form-control" name="tunai" id="tunai" onkeyup="return hitungKurang(this.value)"></td>
            </tr>
            <tr>
              <td>DP</td><td><input type="text" class="form-control" name="dp" id="dp"></td>
            </tr>
            <tr>
              <td>Voucher</td><td><input type="text" class="form-control" name="voucher" id="voucher"></td>
            </tr>
            <tr>
              <td>Card</td><td><input type="text" class="form-control" name="card" id="card"></td>
            </tr>
            <tr>
              <td>Kredit</td><td><input type="text" class="form-control" name="kredit" id="kredit"></td>
            </tr>
            <tr>
              <td>Kurang</td>
              <td>
<input type="hidden" name="kembalian" id="kurangane">
                <h3 id="kurang"><?php echo number_format($totalSemua,0,',','.') ?></h3></td>
            </tr>
          </table>
  </div>
  <div class="col-lg-4 pull-left">
   
    <div id="wrappp" style="display: none;">
       <a target="_blank" href="<?php echo base_url("kasir/transaksi/cetak-nota/".$kodeotomatis) ?>"  class="btn btn-default">Cetak Nota</a>
    <a  target="_blank" href="<?php echo base_url("kasir/transaksi/billing-note/".$kodeotomatis) ?>"  class="btn btn-default">Bill</a>
    <a  target="_blank" href="<?php echo base_url("kasir/transaksi/Kitchen-slip/".$kodeotomatis) ?>"  class="btn btn-default">Kitchen Slip</a>
    </div>
  </div>
  <div class="col-lg-4 pull-right" >
    <input type="hidden" name="type" id="type">
  <button type="button" class="btn btn-primary btn-save-bayar" data-type="simpan">Simpan</button>
  <button type="button" class="btn btn-success btn-save-bayar bayarr" disabled="" data-type="bayar">Bayar</button>
  <button class="btn btn-danger btn-close" >Tutup</button>
  </div>
</div>
<div class="alert alert-warning">
  <br>
  <i class="fa fa-info"></i> Jika anda memilih <b>Bayar</b>,Otomatis Status Pembayaran Akan Menjadi <b>Sudah Bayar</b>
</div>
  </form>
       
        </div>