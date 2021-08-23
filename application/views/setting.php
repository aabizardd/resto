<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
    	
<div class="row">
	<div class="col-lg-6">
		<form action="<?php echo base_url(uri_string()); ?>" method="post">
			<div class="form-group">
				<label>Pajak (%)</label>
				<input type="number" name="pajak" value="<?php echo $data->num_rows()>0 ? $data->result()[0]->nilai :0; ?>" class="form-control">
			</div>
			<div class="form-group">
				<label>Service Fee (%)</label>
				<input type="number" name="service_fee" class="form-control" value="<?php echo $data->num_rows()>0 ? $data->result()[1]->nilai :0; ?>">
			</div>
			<button class="btn btn-primary">Ubah</button>
		</form>
	</div>
</div>
    </div>
</div>