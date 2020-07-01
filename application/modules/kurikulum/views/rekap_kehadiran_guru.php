<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

<div class="row">                     
    <div class="col-md-2">
    	<div class="card mb-3" style="max-width: 20rem;">
		    <div class="card-header text-white bg-primary">Filter</div>
		    <div class="card-body">
		      <form method="POST" action="" autocomplete="off">
		      	<div class="form-group date">
		      	  <label for="exampleInputEmail1">Tanggal Awal</label>
				  <input name="tgl_awal" value="<?php echo set_value('tgl_awal')?>" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
				</div>
				<div class="form-group date">
				  <label for="exampleInputEmail1">Tanggal Akhir</label>	
				  <input name="tgl_akhir" value="<?php echo set_value('tgl_akhir')?>" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
				</div>
		      	
		      	<button type="submit" class="btn btn-block btn-success">Tampilkan</button>
		      </form>
		    </div>
		  </div>
    </div>
    <div class="col-md-10">
		<table class="table table-hover table-striped table-bordered" id="datatable">
		   <thead  class="thead-dark">
		      <tr>
		         <th scope="col">Nama Guru</th>
		         <th scope="col" class="text-center">NUPTK</th>
		         <th scope="col" class="text-center">HADIR</th>
		         <th scope="col" class="text-center">ALPA / KOSONG</th>
		         <th scope="col" class="text-center">DIGANTIKAN</th>
		         <th scope="col" class="text-center">% Kehadiran</th>	
		         <th scope="col" class="text-center">Details</th>	         
		      </tr>
		   </thead>
		   <tbody>
		   		<?php 
			   		if(!empty($_POST)){ 
			   			foreach ($kehadiran->result_array() as $key) {
			   				echo "<tr>";
			   				echo "	<td>" . $key['nama_lengkap'] ."</td>";
			   				echo "	<td>" . $key['nuptk'] ."</td>";
			   				echo "	<td class='text-center'>" . $key['guru_hadir'] ."</td>";
			   				echo "	<td class='text-center'>" . $key['guru_kosong'] ."</td>";
			   				echo "	<td class='text-center'>" . $key['guru_digantikan'] ."</td>";
			   				echo "	<td class='text-center " . kehadiran_row_color($key['jml']) ."'>" . $key['jml'] ."</td>";
			   				echo "	<td class='text-center'><a href='#!' onClick=\"loadkehadiran('" . $key['pegawai_id'] . "')\">Lihat</a></td>";
			   				echo "</tr>";		
			   			}
			   		}
		   		?>
		   </tbody>
		</table>
    </div>
</div>

<div class="modal fade" id="modal_kehadiran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Kehadiran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<script>
	$('.date').datepicker({
	    todayHighlight: true,
	    language: "id",
	    format: "yyyy-mm-dd"
	}).on('changeDate', function(e){
	    $(this).datepicker('hide');
	});

	<?php if(!empty($_POST)){ ?>
	function loadkehadiran(i_pegawai_id){
		// alert(i_pegawai_id);
		$.post( site_url + "detailkehadiran", 
			{ 
				pegawai_id: i_pegawai_id, 
				tgl_awal: "<?php echo set_value('tgl_awal')?>" ,
				tgl_akhir: "<?php echo set_value('tgl_akhir')?>" ,
			}
		  ).done(function( data ) {
		  	$('.modal-body').html(data.detail_kehadiran);
		    $('#modal_kehadiran').modal('show');
		  });
		
	}	
	<?php } ?>	
</script>