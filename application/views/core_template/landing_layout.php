<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> | <?= $template['title']; ?></title>
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

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
         
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          
          
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
         

         
           
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="<?= base_url('auth/logoutLanding') ?>" class="" >
                <!-- The user image in the navbar-->
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"> <i class=" fa fa-sign-out"></i> Logout</span>
              </a>
              
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      

      <!-- Main content -->
      <section class="content">
        <?= $template['partials']['content']; ?>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        
      </div>
      <strong>Copyright &copy; <?= date('Y') ?> <a target="_blank" href=""><strong>UPT TIK SPSUIKA</strong> | All rights
    reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>

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
<script type="text/javascript">
  function sisawaktu(t) {
    var time = new Date(t);
    var n = new Date();
    var x = setInterval(function() {
      var now = new Date().getTime();
      var dis = time.getTime() - now;
      var h = Math.floor((dis % (1000 * 60 * 60 * 60)) / (1000 * 60 * 60));
      var m = Math.floor((dis % (1000 * 60 * 60)) / (1000 * 60));
      var s = Math.floor((dis % (1000 * 60)) / (1000));
      h = ("0" + h).slice(-2);
      m = ("0" + m).slice(-2);
      s = ("0" + s).slice(-2);
      var cd = h + ":" + m + ":" + s;
      $('.sisawaktu').html(cd);
    }, 100);
    setTimeout(function() {
      waktuHabis();
    }, (time.getTime() - n.getTime()));
  }

  function countdown(t) {
    var time = new Date(t);
    var n = new Date();
    var x = setInterval(function() {
      var now = new Date().getTime();
      var dis = time.getTime() - now;
      var d = Math.floor(dis / (1000 * 60 * 60 * 24));
      var h = Math.floor((dis % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var m = Math.floor((dis % (1000 * 60 * 60)) / (1000 * 60));
      var s = Math.floor((dis % (1000 * 60)) / (1000));
      d = ("0" + d).slice(-2);
      h = ("0" + h).slice(-2);
      m = ("0" + m).slice(-2);
      s = ("0" + s).slice(-2);
      var cd = d + " Hari, " + h + " Jam, " + m + " Menit, " + s + " Detik ";
      $('.countdown').html(cd);

      setTimeout(function() {
        location.reload()
      }, dis);
    }, 1000);
  }

  function ajaxcsrf() {
    var csrfname = '<?= $this->security->get_csrf_token_name() ?>';
    var csrfhash = '<?= $this->security->get_csrf_hash() ?>';
    var csrf = {};
    csrf[csrfname] = csrfhash;
    $.ajaxSetup({
      "data": csrf
    });
  }

  $(document).ready(function() {
    setInterval(function() {
      var date = new Date();
      var h = date.getHours(),
        m = date.getMinutes(),
        s = date.getSeconds();
      h = ("0" + h).slice(-2);
      m = ("0" + m).slice(-2);
      s = ("0" + s).slice(-2);

      var time = h + ":" + m + ":" + s;
      $('.live-clock').html(time);
    }, 1000);
  });
</script>


</body>
</html>
