<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Panel</title>
<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('assets/app/template/adminlte/plugins/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/app/template/adminlte/plugins/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('assets/app/template/adminlte/plugins/Ionicons/css/ionicons.min.css') ?>">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/app/template/adminlte/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url('assets/app/template/adminlte/dist/css/skins/_all-skins.min.css') ?>">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?= base_url('assets/app/template/adminlte/plugins/pace/pace.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/lib/chosen/chosen.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/app/template/adminlte/plugins/iCheck/flat/blue.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/app/template/adminlte/plugins/iCheck/all.css') ?>">
  <!-- Google Font -->
   <link rel="stylesheet" type="text/css" href="<?= base_url('assets/lib/toastr/build/toastr.min.css') ?>">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>

html{overflow-x: hidden;}
.logo {
    width: 100%;
    max-width: 100px;
    height: auto;
}

.login-box-body {
      border-top: 5px solid #00a65a;
    }
</style>
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/lib/toastr/toastr.js') ?>"></script>
<script>
    var BASE_URL = "<?= base_url(); ?>";
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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    
    <div class="image">
    
    </div>
    <a href=""><b>Login</b></a>
    <span>Panel</span>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login dengan Email / Username</p>
    <div id="infoMessage" class="text-center"><?php echo $error;?></div>
            
        <!-- /ERROR HERE -->
     <?= form_open('auth/cek_login', [
        'name'    => 'form_login', 
        'id'      => 'form_login', 
        'method'  => 'POST'
      ]); ?>
      <div class="form-group has-feedback ">
        <?php echo form_input(array(
                    'name' => 'username',
                    'type' => 'text',
                    'id' => 'username',
                    'placeholder' => 'Username / Email',
                    'autofocus' => 'autofocus',
                    'class' => 'form-control',
                    'autocomplete'=>'off')); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo form_input(array('name' => 'password',
                      'id' => 'password',
                      'type' => 'password',
                      'placeholder' => 'Password',
                      'class' => 'form-control',)); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> <i class="primary"></i><span class="">Remember Me</span>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    <?= form_close(); ?>

    <!-- /.social-auth-links -->

    <a href="<?= site_url('administrator/forgot-password'); ?>">I forgot my password</a><br>
    <a href="<?= site_url('administrator/register'); ?>" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/app/template/adminlte/plugins/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- PACE -->
<script src="<?= base_url('assets/app/template/adminlte/plugins/PACE/pace.min.js') ?>"></script>


<!-- AdminLTE App -->
<script src="<?= base_url('assets/app/template/adminlte/dist/js/adminlte.min.js') ?>"></script>


<script src="<?= base_url('assets/lib/chosen/chosen.jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/app/template/adminlte/plugins/iCheck/icheck.min.js') ?>"></script>
<script>
  $(function () {
    $('#remember').iCheck({
      checkboxClass: 'icheckbox_flat-red',
      radioClass: 'iradio_square-red',
      increaseArea: '20%' // optional
    });


  });
</script>

<script>
  $(document).ready(function(){
    $('form#form_login input').on('change', function(){
        $(this).parent().removeClass('has-error');  
        $(this).next().next().text('');
    });

    $('form#form_login').on('submit', function(e){
      console.log($(this).serialize());
        e.preventDefault();
        e.stopImmediatePropagation();

        var infobox = $('#infoMessage');
        infobox.addClass('callout callout-info').text('Checking...');

        var btnsubmit = $('#submit');
        btnsubmit.attr('disabled', 'disabled').val('Wait...');

        $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){
            infobox.removeAttr('class').text('');
            btnsubmit.removeAttr('disabled').val('Login');
            if(data.status == true){
                var go = BASE_URL + data.url;
                window.location.href = go;
            }else{
                if(data.status == false){
                  
                    if (data.invalid != null) {
                      // $.each(data.invalid, function(key, val){
                      // console.log(val);
                      infobox.addClass('callout callout-warning text-center').html(data.error);
                      infobox.fadeIn();
                      // $('[name="'+key+'"').parent().addClass('has-error');
                      // $('[name="'+key+'"').next().next().text(val);
                      // if(val == ''){
                      //     $('[name="'+key+'"').parent().removeClass('has-error');  
                      //     $('[name="'+key+'"').next().next().text('');
                      // }
                      // });
                    } else if(data.failed != null){
                        infobox.addClass('callout callout-danger text-center').text(data.failed);
                    }
                }
                    
                }
            }
        });
    });
});
</script>
</body>
</html>
