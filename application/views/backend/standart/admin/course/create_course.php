
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
                     <a class="btn btn-flat btn-success" title="Kembali" href="<?= site_url('admin/course/'); ?>"><i class="fa fa-reply" ></i> Kembali</a>                     
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
                        <label for="username" class="col-sm-2 control-label">Title Ujian<i class="required">*</i></label>

                        <div class="col-sm-8">
                          <textarea name="title_ujian" id="" cols="30" rows="10" class="form-control"></textarea>
                          
                          <small class="info help-block"></small>
                        </div>
                    </div>

                   

                    <!-- <div class="form-group ">
                        <label for="fullname" class="col-sm-2 control-label">jumlah Soal (Max) <i class="required">*</i></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="jumlah_soal" id="jumlah_soal" placeholder="Jumlah Soal (Max)" value="">
                          <small class="info help-block"></small>
                        </div>
                    </div> -->

                    <div class="form-group ">
                        <label for="fullname" class="col-sm-2 control-label">Waktu Pengerjaan <i class="required">*</i></label>

                        <div class="col-sm-8">
                          <input type="number" class="form-control" name="waktu_pengerjaan" id="waktu_pengerjaan" placeholder="Waktu Pengerjaan" value="">
                          <small class="info help-block">(Tidak boleh negatif) <br><strong>Co : 60 (dalam menit) </strong></small>
                        </div>
                    </div>

                    

                    <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Jenis Soal </label>

                        <div class="col-sm-8">
                            <select required="required" name="jenis" id="jenis" class="form-control chosen chosen-select" style="width:100%!important">
                                  <option value="" disabled selected>Jenis Soal</option>
                                  <option value="urut">Urut (Soal berurutan)</option>
                                  <option value="acak">Acak (Soal di Acak) </option>
                              </select>
                            <small class="info help-block">
                              Pilih Jenis Soal (default urut)
                            </small>
                        </div>

                    </div>

                    <div class="form-group ">

                        <label for="fullname" class="col-sm-2 control-label">Tanggal Pengerjaan / Tangal berakhir <i class="required"></i></label>



                        <div class="col-sm-8">

                          <div class="row">

                              <div class="col-xs-6">

                                  <div class="input-group date">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal_maulai" value="" class="form-control pull-right kalender" >
                                  </div>

                              </div>
                               <div class="col-xs-6">

                                  <div class="input-group date">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal_berakhir" value="" class="form-control pull-right kalender" >
                                  </div>

                              </div>

                            </div>
                            <small class="info help-block required">
                            Hari ini Tanggal : <i class="required"><?= date('d-M-Y') ?></i>
                           </small>
                          

                        </div>

                    </div>

                    <div class="message">
                      
                    </div>

                    <div class="row-fluid col-md-7">
                        <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Save</button>
                        <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Save and Go to The List</a>
                        <a class="btn btn-flat btn-default " id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</a>
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
    $('.kalender').datetimepicker({
      autoclose: true,
      defaultDate : new Date()

    });

    
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
                window.location.href = BASE_URL + 'admin/course/';
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
                url: BASE_URL + 'admin/course/add_save',
                type: 'POST',
                dataType: 'json',
                data: data_post,
            })
            .done(function(res) {
                if (res.success) {
                    

                    if (save_type == 'back') {
                        window.location.href = res.redirect;
                        return;
                    }

                    $('.message').printMessage({
                        message: res.message
                    });
                    $('.message').fadeIn();
                    $('form input[type != hidden], form textarea, form select').val('');
                    $('.chosen').val('').trigger('chosen:updated');

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
    
}); /*end doc ready*/
</script>
