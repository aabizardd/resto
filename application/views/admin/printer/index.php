<div class="box">
    <!-- /.box-header -->
      <div class="box-body">
<a class="btn btn-primary" href="<?php echo base_url('admin/printer/create') ?>">Tambah</a>
        <table class="table table-striped">
          <thead>
            <th>IP Printer</th>
            <th>Port Printer</th>
            <th>Cetak Ke</th>
            <th>Opsi</th>
          </thead>
          <tbody>
            <?php if ($data->num_rows()>0): ?>
                <?php foreach ($data->result() as $d): ?>
                  <tr>
                    <td><?php echo $d->ip_printer ?></td>
                    <td><?php echo $d->port_printer ?></td>
                    <td><?php echo $d->cetak_ke ?></td>
                    <td><a onclick="return confirm('Yakin Akan Menghapus Data?')" class="btn btn-danger" href="<?php echo base_url('admin/printer/hapus/'.$d->id_printer) ?>">Hapus</a></td>
                  </tr>
                <?php endforeach ?>
            <?php endif ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-footer -->
    <!-- /.box-body -->
</div>
<!-- /.box -->