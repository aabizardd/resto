<div class="modal-body">
          <table id="table" class="table table-hover table-bordered">
            <thead>
            <tr>
              <th>No.</th>
              <th>ID</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach ($dataproduk as $value) { ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $value['id_produk']; ?></td>
              <td><?php echo $value['nama_produk']; ?></td>
              <td><?php echo $value['produk_kategori']; ?></td>
              <td>Rp. <?php echo number_format($value['harga_produk'], 0, ',', '.'); ?>,00</td>
              <td><?php echo $value['keterangan_produk']; ?></td>
              <td>
                <a class="btn btn-xs btn-info idProduk" onclick="$('#modalidproduk').modal('hide')" data-id="<?php echo $value['id_produk']; ?>">Pilih</a>
              </td>
            </tr>
            <?php
            $no ++;
            }
            ?>
          </table>
      </div>

      <form>
            <div class="col-sm-2">
              <label for="produk_kategori">Produk</label>
              <div class="input-group">
              <input type="text" class="form-control" id="id_produk" name="id_produk" onkeyup="isi_otomatis()" autofocus="">
              <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modalidproduk">Cari</button>
              </span>
            </div>
            </div>
            <div class="col-sm-3">
              <label for="produk_kategori">Nama Produk</label>
              <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" disabled="">
            </div>
            <div class="col-sm-2">
              <label for="harga_produk">Harga</label>
              <input type="text" class="form-control harga" onkeyup="hitungTransaksi();" id="harga_produk" name="harga_produk" placeholder="Harga Produk" disabled="">
            </div>
            <div class="col-sm-2">
              <label for="produk_kategori">Jumlah</label>
              <input type="number" class="form-control jumlah"  onkeyup="hitungTransaksi();" id="jumlah_transaksi" name="jumlah_transaksi" placeholder="Jumlah" value="" required="" >
            </div>
            <div class="col-sm-2">
              <label for="produk_kategori">Total</label>
              <input type="text" class="form-control total" id="total_transaksi" name="total_transaksi" value="" placeholder="Total Harga" required="" readonly="">
            </div>
            <div class="col-sm-1">
              <label for="aksi" class="row col-sm-12">Aksi</label>
              <div class="row col-sm-12">
                <input type="submit" name="submit" class="btn btn-success" value="Tambah">
              </div>
            </div>
          </form>