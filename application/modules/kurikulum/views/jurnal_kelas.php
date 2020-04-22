<style type="text/css"> .font12{ font-size: 12px;} </style>

<table class="table table-bordered" id="monitoring">
  <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center">Kelas</th>
      <th id="th_1" scope="col" class="text-center">Jam - 1 <!--<h6 class="font12">00:00 s/d 00:00</h6> --></th>
      <th id="th_2" scope="col" class="text-center">Jam - 2 <!--<h6 class="font12">00:00 s/d 00:00</h6> --></th>
      <th id="th_3" scope="col" class="text-center">Jam - 3 <!--<h6 class="font12">00:00 s/d 00:00</h6> --></th>
      <th id="th_4" scope="col" class="text-center">Jam - 4 <!--<h6 class="font12">00:00 s/d 00:00</h6> --></th>
      <th id="th_5" scope="col" class="text-center">Jam - 5 <!--<h6 class="font12">00:00 s/d 00:00</h6> --></th>
      <th id="th_6" scope="col" class="text-center">Jam - 6 <!--<h6 class="font12">00:00 s/d 00:00</h6> --></th>
      <th id="th_7" scope="col" class="text-center">Jam - 7 <!--<h6 class="font12">00:00 s/d 00:00</h6> --></th>
      <th id="th_8" scope="col" class="text-center">Jam - 8 <!--<h6 class="font12">00:00 s/d 00:00</h6> --></th>
      <!-- <th scope="col" class="text-center">Jam - 9 <h6 class="font12">00:00 s/d 00:00</h6></th> -->
      <!-- <th scope="col" class="text-center">Jam - 10 <h6 class="font12">00:00 s/d 00:00</h6></th> -->
    </tr>
  </thead>
  <tbody id="jurnal_kelas">
    
  </tbody>
</table>

<script> 

    (function worker() {
      $.ajax({
        url: '<?=site_url('kurikulum/jurnal_kelas/get_ajax');?>',
        success: function(data) {
          $('#jurnal_kelas').html(data.jurnal_kelas);
        },
        complete: function() {
          setTimeout(worker, 5000);
        }
      });
    })();
  
</script>

