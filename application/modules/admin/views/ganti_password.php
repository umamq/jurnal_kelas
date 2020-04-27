<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/password-strength-meter@1.2.2/dist/password.min.css">
<script src="<?php echo site_url('assets/js/password.js')?>"></script>

<?php echo form_open('admin/ganti-password','');?>
<div class="form-group">
   <label>Password Lama</label>
   <input type="password" class="form-control" placeholder="Password Lama" id="pass_lama" name="pass_lama" required>
   <!-- <span class="help-block">* Kosongkan jika tidak ingin merubah password</span> -->
</div>
<div class="form-group" id="div_pass_baru">
   <label>Password Baru</label>
   <input type="password" class="form-control" placeholder="Password Baru" id="pass_baru" name="pass_baru" required>
</div>
<div class="form-group" id="div_pass_ulangi">
   <label>Ulangi</label>
   <input type="password" class="form-control" placeholder="Ulangi Password" id="pass_ulangi" name="pass_ulangi" required>
   <small id="passwordnotsame" class="form-text text-danger">Password tidak sama!.</small>
</div>
<button type="submit" class="btn btn-success">Submit</button>
<?php echo form_close();?>


<script>
   $('#div_pass_baru , #div_pass_ulangi').hide();
   
   $( "#pass_lama").keyup(function() {
     if($(this).val() != ''){
       $('#div_pass_baru , #div_pass_ulangi').show();
     }else{
       $('#div_pass_baru , #div_pass_ulangi').hide();
     }
   });
   
   $('#pass_baru').password({
     shortPass: 'Password terlalu pendek',
     badPass: 'Password lemah; Coba kombinasi huruf & angka',
     goodPass: 'Medium; Coba kombinasi karakter spesial (!@#$%^)',
     strongPass: 'Password kuat',
     containsField: 'Password mengandung password lama!',
     enterPass: 'Ketik password anda',
     showPercent: true,
     showText: true, // shows the text tips
     animate: true, // whether or not to animate the progress bar on input blur/focus
     animateSpeed: 'fast', // the above animation speed
     field: false, // select the username field (selector or jQuery instance) for better password checks
     fieldPartialMatch: true, // whether to check for partials in field
     minimumLength: 4 // minimum password length (below this threshold, the score is 0)
   });
   
   $('#pass_ulangi').on('input',function(e){
      var pass_baru = $('#pass_baru').val();
      var pass_ulangi = $(this).val();
   
      if(pass_ulangi == pass_baru){
       $('#passwordnotsame').hide();
      }else{
       $('#passwordnotsame').show();
      }
   
   });
   
</script>