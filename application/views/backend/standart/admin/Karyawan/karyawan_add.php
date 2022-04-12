
<?php $this->load->view('backend/standart/fine_upload'); ?>

<section class="content-header">
   <h1>
    Manajemen Karyawan
      <small></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class=""> <a href="<?= base_url('admin/karyawan') ?>">Karyawan</a></li>
      <li class="active">add</li>
   </ol>
</section>



<!-- Main content -->
<section class="content">
  <div class="row" >
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg- classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">
                     <a class="btn btn-flat btn-success" title="Kembali" href="<?= site_url('admin/karyawan'); ?>"><i class="fa fa-reply" ></i> Kembali</a>                     
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET.'/img/add2.png'; ?>" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Tambah data</h3>
                     <h5 class="widget-user-desc">Karyawan<i class="label bg-yellow"></i></h5>
                  </div>

                 <?= form_open('', [
                    'name'    => 'form_user', 
                    'class'   => 'form-horizontal', 
                    'id'      => 'form_user', 
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST'
                  ]); 

                  ?>
                   <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Kode Karaywan <i class="required">*</i></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="code" id="code" placeholder="Kode Karyawan" value="">
                          <small class="info help-block"></small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">NIK<i class="required">*</i></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="">
                          <small class="info help-block"></small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Nama <i class="required">*</i></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Karyawan" value="">
                          <small class="info help-block"></small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Email <i class="required">*</i></label>
                        <div class="col-sm-8">
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="">
                          <small class="info help-block"></small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="category" class="col-sm-2 control-label">Status Kontrak 
                        </label>
                        <div class="col-sm-8">
                            <select  class="form-control chosen chosen-select-deselect" name="status_karyawan" id="status_karyawan" data-placeholder="Select Status" >
                                <option value=""></option>
                                <option value="TETAP">TETAP</option>
                                <option value="KONTRAK">KONTRAK</option>
                                <option value="KONTRAK FAKULTAS">KONTRAK FAKULTAS</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Tempat  Lahir <i class="required">*</i></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="">
                          <small class="info help-block"></small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Tanggal  Lahir <i class="required">*</i></label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="">
                          <small class="info help-block"></small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Jenis Kelamin <i class="required">*</i></label>
                        <div class="col-sm-8">
                          <input type="radio" class="form-radio" name="jenis_kelamin" id="jenis_kelamin"  value=""> Laki Laki
                          <input type="radio" class="form-radio" name="jenis_kelamin" id="jenis_kelamin"  value=""> Perempuan
                          <small class="info help-block"></small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Alamat<i class="required">*</i></label>
                        <div class="col-sm-8">
                          <textarea cols="5" rows="5" class="form-control" name="alamat"></textarea>
                          <small class="info help-block"></small>
                        </div>
                    </div>

                      <div class="form-group ">
                            <label for="category" class="col-sm-2 control-label">Group Departement  
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="departements" id="departements" data-placeholder="Select Group departement" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('departements') as $row): ?>
                                    <option value="<?= $row->id ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </div>
                        </div>


                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Photo </label>

                        <div class="col-sm-8">
                            <div id="user_avatar_galery" ></div>
                            <input name="user_avatar_uuid" id="user_avatar_uuid" type="hidden" value="<?= set_value('user_avatar_uuid'); ?>">
                            <input name="user_avatar_name" id="user_avatar_name" type="hidden" value="<?= set_value('user_avatar_name')?>">
                            <small class="info help-block">
                              Format file must PNG, JPEG.
                            </small>
                        </div>

                    </div>
                    <div class="message">
                      
                    </div>

                    <div class="row-fluid col-md-7">
                        <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Save</button>
                        <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Save and Go to The List</a>
                        <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</a>
                        <span class="loading loading-hide"><img src="<?= BASE_ASSET ?>img/loading-spin-primary.svg"> <i>Loading, Saving data</i></span>
                     </div>

                  <?= form_close(); ?>
                  
                  
               </div>
               
               <!-- /.widget-user -->

            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>

</section>

<!-- Page script -->
<script>
  $(document).ready(function() {
    $('#btn_cancel').click(function() {
        swal({
                title: "Are you sure?",
                text: "the data that you have created will be in the exhaust!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes!",
                cancelButtonText: "No!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location.href = BASE_URL + 'admin/karyawan';
                }
            });

        return false;
    }); //end btn cancel/

    $('.btn_save').click(function() {
        $('.message').fadeOut();

        var form_user = $('#form_user');
        var data_post = form_user.serializeArray();
        var save_type = $(this).attr('data-stype');
        var uuid = $('#user_avatar_uuid').val();
        if (uuid == null) {
          data_post.push({
              name: 'uuid',
              value: uuid
          });
        }
        data_post.push({
            name: 'save_type',
            value: save_type
        });

        $('.loading').show();


        $.ajax({
                url: BASE_URL + '/admin/karyawan/add_save',
                type: 'POST',
                dataType: 'json',
                data: data_post,
            })
            .done(function(res) {
                if (res.success) {
                    var id = $('#user_avatar_galery').find('li').attr('qq-file-id');

                    if (res.message == false) {
                        window.location.href = BASE_URL + 'admin/karyawan';
                        return;
                    }

                    $('.message').printMessage({
                        message: res.message
                    });
                    $('.message').fadeIn();
                    $('form input[type != hidden], form textarea, form select').val('');
                    $('.chosen').val('').trigger('chosen:updated');
                    $('#user_avatar_galery').fineUploader('deleteFile', id);

                } else {
                    $('.message').printMessage({
                        message: res.message,
                        type: 'warning'
                    });
                    $('.message').fadeIn();
                }

            })
            .fail(function() {
                $('.message').printMessage({
                    message: 'Error save data',
                    type: 'warning'
                });
            })
            .always(function() {
                $('.loading').hide();
                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 1000);
            });

        return false;
    }); //end btn save/

    $('#user_avatar_galery').fineUploader({

        template: 'qq-template-gallery',
        request: {
            endpoint: BASE_URL + '/admin/karyawan/upload_avatar_file',
            params: {
                '<?= $this->security->get_csrf_token_name(); ?>': '<?=   $this->security->get_csrf_hash(); ?>'
            }
        },
        deleteFile: {
            enabled: true,
            endpoint: BASE_URL + '/admin/karyawan/delete_avatar_file'
        },
        thumbnails: {
            placeholders: {
                waitingPath: BASE_ASSET  + 'lib/fine-upload/placeholders/waiting-generic.png',
                notAvailablePath: BASE_ASSET  + 'lib/fine-upload/placeholders/not_available-generic.png'
            }
        },
        multiple: false,
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
        },
        showMessage: function(msg) {
            toastr['error'](msg);
        },
        callbacks: {
            onComplete: function(id, name) {
                var uuid = $('#user_avatar_galery').fineUploader('getUuid', id);
                $('#user_avatar_uuid').val(uuid);
                $('#user_avatar_name').val(name);
            },
            onSubmit: function(id, name) {
                var uuid = $('#user_avatar_uuid').val();
                $.get(BASE_URL + 'admin/karyawan/delete_avatar_file/' + uuid);

            }
        }
    }); //end image galey/
}); //end doc ready/
</script>
