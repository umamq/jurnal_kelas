<div class="row">  
  <?php foreach ($kelas->result_array() as $row) { ?>
    <div class="col-12 col-sm-6 col-md-4">
      <a href="<?=site_url('admin/kelola-jadwalpelajaran/' . $row['kelas_id']) ?>">
        <div class="info-box">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tasks"></i></span>
          <div class="info-box-content">
            <span class="info-box-text"><h5><?=$row['nama_kelas'];?></h5></span>
            <span class="info-box-text"><?=$row['nama_jurusan'];?></span>
            <span class="info-box-number"><?=$row['jumlah_siswa'];?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </a>
      <!-- /.info-box -->
    </div>
  <?php } ?>        
<!-- /.col -->
</div>