<table class="table table-bordered" id="monitoring">
  <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center">Tanggal</th>
      <th id="th_1" scope="col" class="text-center">Keterangan</th>      
    </tr>
  </thead>
  <tbody>
    <?php foreach ($kehadiran->result_array() as $row) { ?>
      <tr>
        <th scope="row"><?=$row['tgl']?></th>
        <th scope="row"><?=$row['status']?></th>
      </tr>  
    <?php } ?>
  </tbody>
</table>
