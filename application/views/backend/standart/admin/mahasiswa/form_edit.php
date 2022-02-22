
<?php $this->load->view('core_template/fine_upload'); ?>




<!-- Main content -->
<section class="content">
  <div class="row" >
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">
                     <a class="btn btn-flat btn-success" title="Kembali" href="<?= site_url('admin/mahasiswa'); ?>"><i class="fa fa-reply" ></i> Kembali</a>                     
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET ?>/img/add2.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Add</h3>
                     <h5 class="widget-user-desc">New<i class="label bg-yellow"></i></h5>
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
                        <label for="username" class="col-sm-2 control-label">Username <i class="required">*</i></label>
                        <?= form_hidden('id', $input->id); ?>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa" placeholder="Username" value="<?= set_value('nama_lengkap', $input->nama_lengkap) ?>">
                          <small class="info help-block">The username of user.</small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="email" class="col-sm-2 control-label">Email <i class="required">*</i></label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?= set_value('email', $input->email) ?>" readonly="readonly">
                          <small class="info help-block">The email of user.</small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="fullname" class="col-sm-2 control-label">No Registrasi<i class="required">*</i></label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="no_registrasi" id="no_registrasi" placeholder="No Registrasi" value="<?= set_value('no_registrasi', $input->no_registrasi) ?>">
                          <small class="info help-block"></small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="fullname" class="col-sm-2 control-label">No Hp (WA) <i class="required">*</i></label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?= set_value('no_hp', $input->no_hp) ?>">
                          <small class="info help-block"></small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Program Studi <i class="required">*</i></label>

                        <div class="col-sm-8">
                          <?= form_dropdown('prodi', getDropdownList('master_prodi', ['id', 'program_studi'], ['prodiID != ' => 'ADM']), set_value('program_studi', $input->id_master_prodi) , ['class' => 'form-control chosen chosen-select']); ?>
                            <small class="info help-block">
                             Select one role.
                          </small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Foto </label>

                        <div class="col-sm-8">
                            <div id="user_avatar_galery" src="<?= BASE_URL . 'uploads/user/' . $input->foto; ?>" ></div>
                            <input name="user_avatar_uuid" id="user_avatar_uuid" type="hidden" value="<?= set_value('user_avatar_uuid', $input->id); ?>">
                            <input name="user_avatar_name" id="user_avatar_name" type="hidden" value="<?= set_value('user_avatar_name' )?>">
                            <small class="info help-block">
                              Format file must PNG, JPEG.
                            </small>
                        </div>

                    </div>
                    <div class="message">
                      
                    </div>

                    <div class="row-fluid col-md-7">
                        <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Update</button>
                        <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Update and Go to The List</a>
                        <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</a>
                        <span class="loading loading-hide"><img src="<?= BASE_ASSET ?>/img/loading-spin-primary.svg"> <i>Loading, Saving data</i></span>
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
            confirmButtonColor: "#d33",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                window.location.href = BASE_URL + 'admin/mahasiswa';
            }
        });

        return false;
    }); /*end btn cancel*/




    $('.btn_save').click(function() {
        $('.message').fadeOut();

        var form_user = $('#form_user');
        var data_post = form_user.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({
            name: 'save_type',
            value: save_type
        });

        $('.loading').show();

        // data_post.group = $('#group').chosen().val();

        $.ajax({
                url: BASE_URL + 'admin/mahasiswa/edit_save',
                type: 'POST',
                dataType: 'json',
                data: data_post,
            })
            .done(function(res) {
                if (res.success) {
                    var id = $('#user_avatar_galery').find('li').attr('qq-file-id');

                    if (save_type == 'back') {
                        window.location.href = res.redirect;
                        return;
                    }

                    $('.message').printMessage({
                        message: res.message
                    });
                    $('.message').fadeIn();
             

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
    }); /*end btn save*/
    $('#user_avatar_galery').fineUploader({
        template: 'qq-template-gallery',
        request: {
            endpoint: BASE_URL + 'admin/mahasiswa/upload_avatar_file',
            params: {
                '<?= $this->security->get_csrf_token_name(); ?>': '<?=   $this->security->get_csrf_hash(); ?>'
            }
        },
        deleteFile: {
            enabled: true,
            endpoint: BASE_URL + 'admin/mahasiswa/delete_avatar_file'
        },
        thumbnails: {
            placeholders: {
                waitingPath: BASE_URL + 'assets/libraries/fine-upload/placeholders/waiting-generic.png',
                notAvailablePath: BASE_URL + 'assets/libraries/fine-upload/placeholders/not_available-generic.png'
            }
        },
         session: {
           endpoint: BASE_URL + 'admin/mahasiswa/get_avatar_file/<?= $input->id; ?>',
           refreshOnRequest: true
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
                $.get(BASE_URL + 'admin/mahasiswa/delete_avatar_file/' + uuid);
            }
        }
    }); /*end image galey*/
}); /*end doc ready*/
</script>
