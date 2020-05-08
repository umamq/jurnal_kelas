 <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<style type="text/css">
	@charset "UTF-8";
	.select2-result-repository {
		padding-top: 4px;
		padding-bottom: 3px
	}

	.select2-result-repository__avatar {
		float: left;
		width: 70px;
		margin-right: 10px
	}

	.select2-result-repository__avatar img {
		width: 100%;
		height: auto;
		border-radius: 2px
	}

	.select2-result-repository__meta {
		margin-left: 70px
	}

	.select2-result-repository__title {
		color: black;
		font-weight: 700;
		word-wrap: break-word;
		line-height: 1.1;
		margin-bottom: 4px
	}

	.select2-result-repository__forks,
	.select2-result-repository__stargazers {
		margin-right: 1em
	}

	.select2-result-repository__forks,
	.select2-result-repository__stargazers,
	.select2-result-repository__watchers {
		display: inline-block;
		color: #aaa;
		font-size: 11px
	}

	.select2-result-repository__avatar img {
	    width: 70px;
	    height: 70px;
	    border-radius: 2px;
	}

	.select2-result-repository__description {
		font-size: 13px;
		color: #777;
		margin-top: 4px
	}

	.select2-results__option--highlighted .select2-result-repository__title {
		color: white
	}

	.select2-results__option--highlighted .select2-result-repository__forks,
	.select2-results__option--highlighted .select2-result-repository__stargazers,
	.select2-results__option--highlighted .select2-result-repository__description,
	.select2-results__option--highlighted .select2-result-repository__watchers {
		color: #c6dcef
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice {
	    /*background-color: #007bff;*/
	    /*border-color: #006fe6;*/
	    color: black;
	    /*padding: 0 10px;*/
	    /*margin-top: .31rem;*/
	}
</style>


<div class="callout callout-success">
  <h4>Pilih Data Siswa</h4>
  <form class="" method="POST" action="">
      <input type="hidden" name="kelas_id" value="<?php echo $kelas_id?>">		
	  <div class="form-group">
	    <!-- <label class="col-form-label" for="inputDefault">Data siswa</label> -->
	    <select class="form-control siswa-data-ajax" multiple="" name="siswa[]" required=""></select>
	    <!-- <input type="text"  placeholder="Default input" id="inputDefault"> -->
	  </div>	
	  <button type="submit" class="btn btn-success">Tambahkan</button>
	</form>
</div>

<div class="callout callout-warning">
	<table id="datatable" class="display" style="width:100%">
	    <thead>
	        <tr>
	            <th>Nama Siswa</th>
	            <th>NISN</th>
	            <th>Aksi</th>
	        </tr>
	    </thead>
	    <tbody>
		    <?php foreach ($list_siswa->result_array() as $row) { ?>
			<tr>
		       <td><?php echo $row['nama_lengkap']?></td>
		       <td><?php echo $row['nisn']?></td>
		       <td>
		       	<a onclick="return confirm('anda yakin untuk menghapus data siswa dari kelas?')" href="<?php echo site_url('admin/hapus-siswa-kelas/' . simple_crypt($row['id'],'e') . '/' . simple_crypt($kelas_id,'e')  );?>" class="btn btn-danger" style="color:white"><i class="fas fa-trash-alt"></i></a></td>
		    </tr>	
			<?php } ?>                   
		</tbody>
	</table>
</div>



<script type="text/javascript">
   $('#datatable').DataTable({
      "fnDrawCallback": function() { },
      "initComplete": function(settings, json) { }
   });

	$(".siswa-data-ajax").select2({
	  ajax: {
	    url: "<?php echo site_url('ajax_search/siswa')?>",
	    dataType: 'json',
	    delay: 250,
	    data: function (params) {
	      return {
	        q: params.term, // search term,
	        page: params.page
	      };
	    },
	    processResults: function (data, params) {
	      // parse the results into the format expected by Select2
	      // since we are using custom formatting functions we do not need to
	      // alter the remote JSON data, except to indicate that infinite
	      // scrolling can be used
	      params.page = params.page || 1;
	      return {
	        results: data.items,
	        pagination: {
	          more: (params.page * 10) < data.total_count
	        }
	      };
	    },
	    cache: true
	  },
	  placeholder: 'Mencari data siswa...',
	  minimumInputLength: 3,
	  templateResult: formatRepo,
	  templateSelection: formatRepoSelection
	});

	function formatRepo (repo) {
	  if (repo.loading) {
	    return repo.text;
	  }

	  var $container = $(
	    "<div class='select2-result-repository clearfix'>" +
	      "<div class='select2-result-repository__avatar'><img src='" + repo.foto + "' /></div>" +
	      "<div class='select2-result-repository__meta'>" +
	        "<div class='select2-result-repository__title'></div>" +
	        "<div class='select2-result-repository__description'></div>" +
	        "<div class='select2-result-repository__statistics'>" +
	          "<div class='select2-result-repository__forks'><i class='fa fa-phone'></i> </div>" +
	          "<div class='select2-result-repository__stargazers'><i class='fa fa-envelope-square'></i> </div>" +
	          "<div class='select2-result-repository__watchers'><i class='fa fa-map-marker-alt'></i> </div>" +
	        "</div>" +
	      "</div>" +
	    "</div>"
	  );

	  $container.find(".select2-result-repository__title").text(repo.nama_lengkap);
	  $container.find(".select2-result-repository__description").text(repo.nisn);
	  $container.find(".select2-result-repository__forks").append(repo.telp);
	  $container.find(".select2-result-repository__stargazers").append(repo.email);
	  $container.find(".select2-result-repository__watchers").append(repo.alamat);

	  return $container;
	}

	function formatRepoSelection (repo) {
	  return repo.nama_lengkap || repo.text;
	}
</script>