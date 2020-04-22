<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>KURIKULUM | JURNAL KELAS</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.2/css/adminlte.min.css" />
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo site_url('assets/css/app.css?uuid=' . uniqid())?>" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-flash.css" />


      <?php
        if(isset($css_files)){
          foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
          <?php endforeach;
        }else{ ?>
          <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" >
          <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
      <?php }; ?>

      <?php
        if(isset($js_files)){
          foreach($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
          <?php endforeach;
        }else{ ?>
          <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script> -->
          <!-- jQuery -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
          <script src="<?php echo site_url('assets/summernote/dist/summernote-lite.js')?>"></script> 
          <!-- <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script> -->
      <?php }; ?>

      <!-- REQUIRED SCRIPTS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.2/js/adminlte.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Cookies.js/0.3.1/cookies.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
      <script src="<?php echo site_url('assets/js/app.js?uuid=' . uniqid())?>"></script>

      <script> var site_url = '<?php echo site_url('kurikulum/')?>'; </script>

   </head>
   <body class="hold-transition sidebar-mini">
      <div class="wrapper">
         <!-- Navbar -->
          <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
               </li>
               <li class="nav-item d-none d-sm-inline-block">
                  <a href="<?php echo site_url('kurikulum')?>" class="nav-link">Beranda</a>
               </li>
               <!-- li class="nav-item d-none d-sm-inline-block">
                  <a href="#" class="nav-link">Contact</a>
               </li> -->
            </ul>
            <!-- SEARCH FORM -->
           <!--  <form class="form-inline ml-3">
               <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                     <button class="btn btn-navbar" type="submit">
                     <i class="fas fa-search"></i>
                     </button>
                  </div>
               </div>
            </form> -->
            <!-- Right navbar links -->

           <!--  <ul class="navbar-nav ml-auto">
               
               <li class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                     <a href="#" class="dropdown-item">
               
                        <div class="media">
                           <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                           <div class="media-body">
                              <h3 class="dropdown-item-title">
                                 Brad Diesel
                                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm">Call me whenever you can...</p>
                              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                           </div>
                        </div>
               
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                        
                        <div class="media">
                           <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                           <div class="media-body">
                              <h3 class="dropdown-item-title">
                                 John Pierce
                                 <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm">I got your message bro</p>
                              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                           </div>
                        </div>
                        
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                        
                        <div class="media">
                           <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                           <div class="media-body">
                              <h3 class="dropdown-item-title">
                                 Nora Silvester
                                 <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                              
                              <p class="text-sm">The subject goes here</p>
                              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                           </div>
                        </div>
                        
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                  </div>
               </li>
              
               <li class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                     <span class="dropdown-header">15 Notifications</span>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> 4 new messages
                     <span class="float-right text-muted text-sm">3 mins</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                     <i class="fas fa-users mr-2"></i> 8 friend requests
                     <span class="float-right text-muted text-sm">12 hours</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                     <i class="fas fa-file mr-2"></i> 3 new reports
                     <span class="float-right text-muted text-sm">2 days</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                  </div>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                     class="fas fa-th-large"></i></a>
               </li>
            </ul> -->
         </nav>
         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <!-- <a href="index3.html" class="brand-link">
            <img src="https://via.placeholder.com/150/FF0000" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
            <span class="brand-text font-weight-light">JURNAL KELAS</span>
            </a> -->
            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img src="https://ui-avatars.com/api/?name=<?php echo $nama_lengkap;?>&rounded=true&background=0D8ABC&color=fff"  class="img-circle elevation-2">
                     <!-- <img src="https://via.placeholder.com/150/FF0000" alt="User Image"> -->
                  </div>
                  <div class="info">
                     <a href="#" class="d-block"><?php echo $nama_lengkap;?></a>
                  </div>
               </div>
               <!-- Sidebar Menu -->
               <nav class="mt-2 main-menu">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <li class="nav-item">
                        <a href="<?php echo site_url('kurikulum')?>" class="nav-link">
                           <i class="nav-icon fas fa-home"></i>
                           <p>Beranda</p>
                        </a>
                     </li>
                     <li class="nav-header">MONITORING</li>
                     <li class="nav-item">
                        <a href="<?php echo site_url('kurikulum/jurnal-kelas')?>" class="nav-link">
                           <i class="nav-icon fas fa-calendar"></i>
                           <p>Jurnal Kelas</p>
                        </a>
                     </li>                    
                     <li class="nav-header">REKAPITULASI</li>
                     <li class="nav-item">
                        <a href="<?php echo site_url('kurikulum/rekap-jurnal-kelas')?>" class="nav-link">
                           <i class="nav-icon fas fa-book"></i>
                           <p>Jurnal Kelas</p>
                        </a>
                     </li>  
                     <!-- <li class="nav-item">
                        <a href="<?php echo site_url('kurikulum/rekap-bulanan')?>" class="nav-link">
                           <i class="nav-icon fas fa-book"></i>
                           <p>Jurnal Bulanan</p>
                        </a>
                     </li>   -->
                     <li class="nav-item">
                        <a href="<?php echo site_url('kurikulum/rekap-kehadiran-guru')?>" class="nav-link">
                           <i class="nav-icon fas fa-book"></i>
                           <p>Kehadiran Guru</p>
                        </a>
                     </li>  


                     <li class="nav-header">SETTINGS</li>                                          
                     <li class="nav-item">
                        <a href="<?php echo site_url('kurikulum/profile/edit/' . $user_id)?>" class="nav-link">
                           <i class="nav-icon fas fa-school"></i>
                           <p>Profile</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?php echo site_url('kurikulum/ganti-password')?>" class="nav-link">
                           <i class="nav-icon fas fa-lock"></i>
                           <p>Ganti Password</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?php echo site_url('signout')?>" class="nav-link">
                           <i class="nav-icon fas fa-sign-out-alt"></i>
                           <p>Keluar</p>
                        </a>
                     </li>


                  </ul>
               </nav>
               <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><?php echo $page_title?></h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <?php echo $this->breadcrumbs->show();?>                      
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
               <div class="container-fluid">
                  <div class="row">                     
                    <div class="col-lg-12">
                      <div class="card card-primary card-outline">
                        <div class="card-body">                           
                         <?php if(isset($keterangan)){ ?>           
                          <div class="alert alert-dark">
                            <strong class="animated infinite slow flash delay-1s">INFORMASI : </strong> <?php echo $keterangan;?>
                          </div>
                         <?php } ?>
                         <?php if(isset($output)){ echo $output; }else{ include $page_name . ".php"; } ?>
                        </div>                   
                      </div>
                    </div> 
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
               <h5>MENU</h5>
               <!-- <p><a href="<?php echo site_url('kurikulum/ubah-password')?>">Ubah Password</a></p> -->
               <!-- <p><a href="<?php echo site_url('admin/profile')?>">Profile</a></p> -->
               <p><a href="<?php echo site_url('signout')?>">Keluar</a></p>
            </div>
         </aside>
         <!-- /.control-sidebar -->
         <!-- Main Footer -->
         <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
               Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
         </footer>
      </div>
      <!-- ./wrapper -->

      <script type="text/javascript">

        <?php if(has_alert()):
           foreach(has_alert() as $type => $message): ?>
           <?php if($type === 'alert-danger'){ ?>
             swal({
                 html : true,
                 title: 'Error !',
                 text: '<?php echo trim(preg_replace("/\s+/", " ", $message)); ?>',
                 type: 'error',
                 confirmButtonText: 'OK'
             });
           <?php }elseif($type === 'alert-warning'){ ?>
             swal({          
                  html : true,         
                 title: 'Peringatan',
                 text: '<?php echo $message; ?>',
                 type: 'warning',
                 confirmButtonText: 'Ok'
             });
          <?php }elseif($type === 'alert-success'){ ?>
             swal({
                  html : true,
                 title: 'Berhasil',
                 text: '<?php echo $message; ?>',
                 type: 'success',
                 confirmButtonText: 'Ok'
             });
          <?php }elseif($type === 'alert-info'){ ?>

           swal({
                  html : true,
                 title: 'Informasi',
                 text: '<?php echo $message; ?>',
                 type: 'info',
                 confirmButtonText: 'Ok'
             });

          <?php }; ?>
           <?php endforeach;
         endif; ?>

        
         $(document).ready(function() {
           $('.texteditor').summernote({
             height: 300,
             maximumImageFileSize: 1048576,
             callbacks: {
               onImageUpload: function(files, editor, welEditable) {
                 for (var i = files.length - 1; i >= 0; i--) {
                   sendFile(files[i], this);
                 }
               },
               onChange: function(contents, $editable) {                 
               }
             }
           });            
         });

       function sendFile(file, el) {
           var form_data = new FormData();
           form_data.append('file', file);
           $.ajax({
             data: form_data,
             type: "POST",
             url: '<?php echo site_url('editor/upload')?>',
             cache: false,
             contentType: false,
             processData: false,
             success: function(url) {
               $(el).summernote('editor.insertImage', url);
             }
           });
         }

         $('.groceryCrudTable').dataTable( {
          "ordering": false
         } );
      </script>
      
   </body>
</html>