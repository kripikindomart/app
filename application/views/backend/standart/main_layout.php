<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> SPsUIKA | <?= $template['title']; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/plugins/bootstrap/dist/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/plugins/font-awesome/css/font-awesome.min.css' ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/plugins/Ionicons/css/ionicons.min.css' ?>">
  <link rel="stylesheet" href="<?=  BASE_TEMPLATE.'adminlte/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css' ?>">
 <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/plugins/iCheck/all.css' ?>">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/dist/css/AdminLTE.min.css' ?>">
  <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/dist/css/skins/_all-skins.min.css' ?>">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>app/template/adminlte/plugins/morris.js/morris.css">
  <link rel="stylesheet" href="<?= BASE_ASSET.'css/custom.css' ?>">
  <link rel="stylesheet" href="<?= BASE_ASSET.'css/crud.css' ?>">
  <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/plugins/pace/pace.min.css' ?>">
  <link rel="stylesheet" href="<?= BASE_ASSET.'css/github.min.css'; ?>">
  <link rel="stylesheet" href="<?= BASE_ASSET.'lib/flag-icon/css/flag-icon.css'; ?>" rel="stylesheet" media="all" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_ASSET.'lib/toastr/build/toastr.min.css' ?>">


  
  
  <!-- EXTEND CSS -->

  <link rel="stylesheet" href="<?= BASE_ASSET; ?>lib/chosen/chosen.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>lib/jquery-switch-button/jquery.switchButton.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_ASSET.'lib/toastr/build/toastr.min.css' ?>">
  <link rel="stylesheet" href="<?= BASE_ASSET.'lib/fancy-box/source/jquery.fancybox.css?v=2.1.5' ?>" media="screen" />
  <!-- Datepicker -->
  <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/plugins/datepicker/datepicker3.css'; ?>">
  <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/plugins/daterangepicker/daterangepicker.css'; ?>">
  <link rel="stylesheet" href="<?= BASE_TEMPLATE.'adminlte/plugins/datetimepicker/jquery.datetimepicker.css'; ?>"/>


  <link href="<?= BASE_ASSET.'lib/datatables/jquery.dataTables.min.css' ?>" rel="stylesheet" type="text/css" />
  <link href="<?= BASE_ASSET.'lib/datatables/buttons.bootstrap.min.css' ?>" rel="stylesheet" type="text/css" />
  <link href="<?= BASE_ASSET.'lib/datatables/fixedHeader.bootstrap.min.css' ?>" rel="stylesheet" type="text/css" />
  <link href="<?= BASE_ASSET.'lib/datatables/responsive.bootstrap.min.css' ?>" rel="stylesheet" type="text/css" />
  <link href="<?= BASE_ASSET.'lib/datatables/scroller.bootstrap.min.css' ?>" rel="stylesheet" type="text/css" />
  <link href="<?= BASE_ASSET.'lib/sweetalert/sweetalert.css' ?>" rel="stylesheet" type="text/css" />
  <link href="<?= BASE_ASSET.'lib/select2/css/select2-bootstrap.min.css' ?>" rel="stylesheet" type="text/css" />
  <link href="<?= BASE_ASSET.'lib/select2/css/select2.min.css' ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?= BASE_ASSET.'lib/js-scroll/style/jquery.jscrollpane.css'; ?>" rel="stylesheet" media="all" />
  <link rel="stylesheet" href="<?= BASE_ASSET.'lib/fine-upload/fine-uploader-gallery.min.css'; ?>" rel="stylesheet" media="all" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- jQuery 3 -->
  <script src="<?= BASE_TEMPLATE.'adminlte/plugins/jquery/dist/jquery.min.js' ?>"></script>
 



<!-- EXTENDS SCRIPT-->
<script src="<?= BASE_ASSET.'js/custom.js'; ?>" ></script>
<script src="<?= BASE_ASSET.'lib/select2/js/select2.js'; ?>"></script>
<script src="<?= BASE_ASSET.'lib/fine-upload/jquery.fine-uploader.js'; ?>"></script>
<script src="<?= BASE_ASSET.'lib/select2/js/select2.full.js'; ?>"></script>
<script src="<?= BASE_ASSET.'lib/fine-upload/jquery.fine-uploader.js'; ?>"></script>
<script src="<?= BASE_ASSET.'lib/sweetalert/sweetalert.min.js'; ?>"></script>
<script src="<?= BASE_ASSET.'lib/fancy-box/source/jquery.fancybox.js?v=2.1.5'; ?>"></script>
<script src="<?= BASE_ASSET.'lib/chosen/chosen.jquery.min.js'; ?>" type="text/javascript"></script>
<script src="<?= BASE_ASSET.'lib/jquery-ui/jquery-ui.js'; ?>"></script>
<script src="<?= BASE_ASSET.'lib/jquery-switch-button/jquery.switchButton.js'; ?>"></script>
<script src="<?= BASE_ASSET.'js/respond.min.js'; ?>"></script>
<script type="text/javascript" src="<?= BASE_ASSET.'js/highlight.min.js'; ?>"></script>


<script src="<?= BASE_TEMPLATE.'adminlte/plugins/iCheck/icheck.min.js' ?>"></script>
<script src="<?= BASE_ASSET.'lib/toastr/build/toastr.min.js' ?>"></script>
<script src="<?= BASE_TEMPLATE.'/adminlte/plugins/datetimepicker/build/jquery.datetimepicker.full.js'; ?>"></script>

<!-- Input Mask -->
<script src="<?= BASE_TEMPLATE.'adminlte/plugins/input-mask/jquery.inputmask.js'; ?>"></script>
<script src="<?= BASE_TEMPLATE.'adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js'; ?>"></script>
<script src="<?= BASE_TEMPLATE.'adminlte/plugins/input-mask/jquery.inputmask.extensions.js'; ?>"></script>

<!-- Datatables-->
<script src="<?= BASE_ASSET.'lib/' ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/dataTables.bootstrap.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/dataTables.buttons.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/buttons.bootstrap.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/jszip.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/pdfmake.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/vfs_fonts.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/buttons.html5.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/buttons.print.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/dataTables.keyTable.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/dataTables.responsive.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/responsive.bootstrap.min.js"></script>
<script src="<?= BASE_ASSET.'lib/' ?>datatables/dataTables.scroller.min.js"></script>

<script type="text/javascript">
      // To make Pace works on Ajax calls
      $(document).ajaxStart(function () {
        Pace.restart()
        $('.sidebar-menu').tree();
      })
      //Flat red color scheme for iCheck
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
       
    function ajaxcsrf() {
        var csrfname = '<?= $this->security->get_csrf_token_name() ?>';
        var csrfhash = '<?= $this->security->get_csrf_hash() ?>';
        var csrf = {};
        csrf[csrfname] = csrfhash;
        $.ajaxSetup({
          "data": csrf
        });
      }

      function reload_ajax() {
        table.ajax.reload(null, false); 
      }
</script>
 <script>
    var BASE_URL = "<?= base_url(); ?>";
    var BASE_ASSET = "<?= BASE_ASSET ?>";
    var BASE_AJAX = "<?= base_url('admin/'); ?>";
    var HTTP_REFERER = "<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/' ; ?>";
    var csrf = '<?= $this->security->get_csrf_token_name(); ?>';
    var token = '<?= $this->security->get_csrf_hash(); ?>';
    var uri_segment = '<?= $this->uri->segment(2) ?>';
    $(document).ready(function(){

      toastr.options = {
        "positionClass": "toast-top-center",
      }
      

      var f_message = '<?= $this->session->flashdata('f_message'); ?>';
      var f_type = '<?= $this->session->flashdata('f_type'); ?>';

      if (f_message.length > 0) {
        toastr[f_type](f_message);
      }

      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
      });
      

    });
  </script>


</head>
<body class="hold-transition sidebar-mini fixed skin-purple-light " id="body">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('assets/app/template/include/') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>PP</b>s</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SPs - UIKA</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         <!--  <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?= BASE_URL.'uploads/user/'.(!empty(get_user_data('avatar')) ? get_user_data('avatar') :'default.png'); ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> -->
          <!-- Notifications: style can be found in dropdown.less -->
        <!--   <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                inner menu: contains the actual data
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> -->
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= BASE_URL.'uploads/user/'.(!empty(get_user_data('avatar')) ? get_user_data('avatar') :'default.png'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= _ent(ucwords(clean_snake_case(get_user_data('full_name')))); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= BASE_URL.'uploads/user/'.(!empty(get_user_data('avatar')) ? get_user_data('avatar') :'default.png'); ?>" class="img-circle" alt="User Image">

                <p>
                  <?= _ent(ucwords(clean_snake_case($this->aauth->get_user()->full_name))); ?>
                  <small>Last Login, <?= date('Y-M-D', strtotime(get_user_data('last_login'))); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
        
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><?= cclang('profile'); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url('auth/logout'); ?>" class="btn btn-default btn-flat"><?= cclang('sign_out'); ?></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li class="dropdown ">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
             <span class="flag-icon <?= get_current_initial_lang(); ?>"></span> <?= get_current_lang(); ?> </a>
             <ul class="dropdown-menu" role="menu">
             <?php foreach (get_langs() as $lang): ?>
                <li><a href="<?= site_url('web/switch_lang/'.$lang['folder_name']); ?>"><span class="flag-icon <?= $lang['icon_name']; ?>"></span> <?= $lang['name']; ?></a></li>
              <?php endforeach; ?>
             </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= BASE_URL.'uploads/user/'.(!empty(get_user_data('avatar')) ? get_user_data('avatar') :'default.png'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= _ent(ucwords(clean_snake_case(get_user_data('full_name')))); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
    
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>  
        <li class="treeview" style="height: auto;">
          <a href="#" ><i class="fa fa fa-folder"></i> <span>Master Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu" >
            <ul class="sidebar-menu  sidebar-admin tree" data-widget="tree">
              <li class=" "> 
                <a href="<?= base_url('admin/prodi') ?>" >
                  <i class="fa  fa-circle-o"></i> <span>Prodi</span>
                </a>
              </li>
              <li class=" "> 
                <a href="<?= base_url('admin/mahasiswa') ?>"><i class="fa  fa-circle-o"></i> <span>Mahasiswa</span>
                </a>
              </li>

              <li class=" "> 
                <a href="<?= base_url('admin/dosen') ?>"><i class="fa  fa-circle-o"></i> <span>Dosen</span>
                </a>
              </li>

              <li class=" "> 
                <a href="<?= base_url('admin/grade') ?>"><i class="fa  fa-circle-o"></i> <span>Grade Nilai</span>
                </a>
              </li>

              <li class=" "> 
                <a href="<?= base_url('admin/tahun') ?>"><i class="fa  fa-circle-o"></i> <span>Tahun Angkatan</span>
                </a>
              </li>

            </ul>
          </ul>
        </li>
        <li class="treeview" style="height: auto;">
          <a href="#" ><i class="fa fa fa-book"></i> <span>Ujian</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu" >
            <ul class="sidebar-menu  sidebar-admin tree" data-widget="tree">
              <li class=" "> 
                <a href="<?= base_url('admin/ujian') ?>" >
                  <i class="fa  fa-circle-o"></i> <span>Pendaftaran</span>
                </a>
              </li>
              <li class=" "> 
                <a href="<?= base_url('admin/kelengkapan') ?>"><i class="fa  fa-circle-o"></i> <span>Kelengkapan</span>
                </a>
              </li>

              <li class=" "> 
                <a href="<?= base_url('admin/pengajuan') ?>"><i class="fa  fa-circle-o"></i> <span>Pengajuan SK</span>
                </a>
              </li>

              <li class=" "> 
                <a href="<?= base_url('admin/surat/sk') ?>"><i class="fa  fa-circle-o"></i> <span>Data SK</span>
                </a>
              </li>

             

            </ul>
          </ul>
        </li>
        <li class="treeview" style="height: auto;">
          <a href="#" ><i class="fa fa fa-file-text-o "></i> <span>Data Surat</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu" >
            <ul class="sidebar-menu  sidebar-admin tree" data-widget="tree">
              <li class=" "> 
                <a href="<?= base_url('admin/ujian') ?>" >
                  <i class="fa  fa-circle-o"></i> <span>Data Pengajuan</span>
                </a>
              </li>
              <li class=" "> 
                <a href="<?= base_url('admin/surat/sk') ?>"><i class="fa  fa-circle-o"></i> <span>Data SK</span>
                </a>
              </li>

              <li class=" "> 
                <a href="<?= base_url('admin/surat') ?>"><i class="fa  fa-circle-o"></i> <span>Data Surat</span>
                </a>
              </li>

              <li class=" "> 
                <a href="<?= base_url('admin/surat/add') ?>"><i class="fa  fa-circle-o"></i> <span>Buat Surat</span>
                </a>
              </li>

             

            </ul>
          </ul>
        </li>
       

        <li class=" "> 
          <a href="<?= base_url('admin/course') ?>" ><i class="fa fa fa-book "></i> <span>Kelengkapan</span>
          </a>
        </li> 
        <li class="header treeview">REPORTS</li>
        <li>
          <a href="<?= base_url('admin/hasilujian') ?>"><i class="fa fa-file"></i> Hasil Ujian</a>
        </li> 
        <li class="header treeview">Administrator</li>
        <li>
          <a href="<?= base_url('admin/users') ?>"><i class="fa fa-users"></i>Users System</a>
        </li>  

        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   

      <?= $template['partials']['content']; ?>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a target="_blank" href="http://asrulmaa.online"><strong>Devisi IT SPSUIKA</strong> | All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="<?= BASE_TEMPLATE.'adminlte/plugins/PACE/pace.min.js' ?>"></script>


<!-- Bootstrap 3.3.7 -->
<script src="<?= BASE_TEMPLATE.'adminlte/plugins/bootstrap/dist/js/bootstrap.min.js' ?>"></script>
<!-- SlimScroll -->
<script src="<?= BASE_TEMPLATE; ?>/adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="<?= base_url('assets/app/template/adminlte/') ?>plugins/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= BASE_TEMPLATE.'adminlte/dist/js/adminlte.min.js'  ?>"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/app/template/adminlte/') ?>dist/js/demo.js"></script>

<script src="<?= BASE_ASSET.'lib/ckeditor/ckeditor.js' ?>"></script>



</body>
</html>
