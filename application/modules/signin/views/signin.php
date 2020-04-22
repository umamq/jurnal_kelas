<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <meta name="robots" value="noindex,nofollow" />
    <title>Sign In Page</title>
    <style>/* Base styles */
     *,*:after,*:before{box-sizing:border-box}html{font-size:100%;line-height:1.5;height:100%}body{overflow-y: hidden;background:linear-gradient(-45deg,#ee7752,#e73c7e,#23a6d5,#23d5ab);background-size:400% 400%;animation:gradient 10s ease infinite}@keyframes gradient{0%{background-position:0 50%}50%{background-position:100% 50%}100%{background-position:0 50%}}img{vertical-align:middle;max-width:100%}button{cursor:pointer;border:0;padding:0;background-color:transparent}.container{position:absolute;width:24em;left:50%;top:50%;transform:translate(-50%,-50%);animation:intro .7s cubic-bezier(0.175,0.885,0.32,1.275) forwards}.profile{position:relative}.profile--open .profile__form{visibility:visible;height:auto;opacity:1;transform:translateY(-6em);padding-top:12em}.profile--open .profile__fields{opacity:1;visibility:visible}.profile--open .profile__avatar{transform:translate(-50%,-1.5em);border-radius:50%}.profile__form{position:relative;background:white;visibility:hidden;opacity:0;height:0;padding:3em;border-radius:.25em;-webkit-filter:drop-shadow(0 0 2em rgba(0,0,0,0.2));transition:opacity .4s ease-in-out,height .4s ease-in-out,transform .4s cubic-bezier(0.175,0.885,0.32,1.275),padding .4s cubic-bezier(0.175,0.885,0.32,1.275)}.profile__fields{opacity:0;visibility:hidden;transition:opacity .2s cubic-bezier(0.175,0.885,0.32,1.275)}.profile__avatar{position:absolute;z-index:1;left:50%;transform:translateX(-50%);border-radius:1.25em;overflow:hidden;width:4.5em;height:4.5em;display:block;transition:transform .3s cubic-bezier(0.175,0.885,0.32,1.275);will-change:transform}.profile__avatar:focus{outline:0}.profile__footer{padding-top:1em}.field{position:relative;margin-bottom:2em}.label{position:absolute;height:2rem;line-height:2rem;bottom:0;color:#999;transition:all .3s cubic-bezier(0.175,0.885,0.32,1.275)}.input{width:100%;font-size:100%;border:0;padding:0;background-color:transparent;height:2rem;line-height:2rem;border-bottom:1px solid #eee;color:#777;transition:all .2s ease-in}.input:focus{outline:0;border-color:#ccc}.input:focus+.label,input:valid+.label{transform:translateY(-100%);font-size:.75rem;color:#ccc}.btn{border:0;font-size:.75rem;height:2.5rem;line-height:2.5rem;padding:0 1.5rem;color:white;background:#8e49e8;text-transform:uppercase;border-radius:.25rem;letter-spacing:.2em;transition:background .2s}.btn:focus{outline:0}.btn:hover,.btn:focus{background:#a678e2}@keyframes intro{from{opacity:0;top:0}to{opacity:1;top:50%}}
    </style>
    <!--Google Font - Work Sans-->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit&hl=id" async defer></script>
  </head>
  <body>
    <div class="container" style="margin-top:40px;padding-top: 50px">
      <div class="profile profile--close profile--open">
        <button class="profile__avatar" id="toggleProfile">
          <img src="<?php echo site_url('assets/signin/images/signin_avatar.png')?>" alt="Avatar" />
        </button>

        <!-- <form action="" method="post"> -->
        <?php echo form_open();?>

          <div class="profile__form">
            <div class="profile__fields">
              <div class="field">
                <input name="username" type="text" id="fieldUser" class="input" placeholder="Username" required pattern=.*\S.* />
                <!-- <label for="fieldUser" class="label">Email</label> -->
              </div>
              <div class="field">
                <input name="password" type="password" id="fieldPassword" class="input" placeholder="Password" required pattern=.*\S.* />
                <!-- <label for="fieldPassword" class="label">Password</label> -->
              </div>

              <?php echo $this->recaptcha->render()?>

              <div class="profile__footer">
                <button class="btn" type="submit">Login</button>
              </div>
            </div>
           </div>
        <!-- </form> -->
        <?php echo form_close();?>
      </div>
    </div>
  </body>
  <script>
    /* Simple VanillaJS to toggle class */
    document.getElementById('toggleProfile').addEventListener('click', function () {
      [].map.call(document.querySelectorAll('.profile'), function(el) {
        el.classList.toggle('profile--open');
      });
    });

    <?php $this->load->config('recaptcha', true); ?>
     var CaptchaCallback = function() {
       $('.g-recaptcha').each(function(index, el) {
         grecaptcha.render(el, {'sitekey' : '<?php echo $this->config->item('recaptcha_sitekey', 'recaptcha')?>'});
       });
     };
  </script>
</html>
