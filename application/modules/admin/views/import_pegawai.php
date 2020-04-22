<div class="panel panel-primary"> 
	<div class="panel-heading"> 
		<h3 class="panel-title">Import Data Pegawai</h3> 
	</div> 
	<div class="panel-body">
<!-- <legend>Import Data Guru</legend> -->
		<div class="alert alert-success">Pada form ini anda bisa melakukan import data pegawai sesuai dengan contoh format file excel dibawah ini<br>
			<a href="<?php echo base_URL() . 'uploads/data_pegawai.xls'?>">Download Format File</a>
		</div>
		<form action="<?php echo site_url('admin/import-pegawai');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
			<input type="hidden" name="upload_me" value="">
			<div class="form-group">
			    <label for="exampleInputFile">File Data</label>
			    <input type="file" id="exampleInputFile" name="userfile">
			    <p class="help-block">File berisi data pegawai</p>
			  </div>
			
			<button type="submit" class="btn btn-success">Import</button>
		</form>
	</div> 
</div>