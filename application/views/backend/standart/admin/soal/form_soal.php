<div class="row" >
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <?=form_open_multipart('admin/soal/save', array('id'=>'formsoal'), array('method'=>'add'));?>
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">
                     <a class="btn btn-flat btn-success" title="Kembali" href="<?= site_url('admin/soal'); ?>"><i class="fa fa-reply" ></i> Kembali</a>                     
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET ?>/img/add2.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Add</h3>
                     <h5 class="widget-user-desc">New<i class="label bg-yellow"></i></h5>
                  </div>
                
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="form-group col-sm-12">
                            <label>Title Soal</label>
                           
                            <input type="text" class="form-control" name="title_soal">
                            <small class="help-block" style="color: #dc3545"><?=form_error('program_studi')?></small>
                         
                        </div>
                        
                        <div class="col-sm-12">
                            <label for="soal" class="control-label">Soal (Pertanyaan)</label>
                            <div class="form-group">
                                <input type="file" name="file_soal" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('file_soal')?></small>
                            </div>
                            <div class="form-group">
                                <textarea name="soal" id="soal" class="form-control  ckeditor"><?=set_value('soal')?></textarea>
                                <small class="help-block" style="color: #dc3545"><?=form_error('soal')?></small>
                            </div>
                        </div>
                        
                        <!-- 
                            Membuat perulangan A-E 
                        -->
                        <?php
                        $abjad = ['a', 'b', 'c', 'd', 'e']; 
                        foreach ($abjad as $abj) :
                            $ABJ = strtoupper($abj); // Abjad Kapital
                        ?>

                        <div class="col-sm-12">
                            <label for="file">Jawaban <?= $ABJ; ?></label>
                            <div class="form-group">
                                <input type="file" name="file_<?= $abj; ?>" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('file_'.$abj)?></small>
                            </div>
                            <div class="form-group">
                                <textarea name="jawaban_<?= $abj; ?>" id="jawaban_<?= $abj; ?>" class="form-control froala-editor ckeditor"><?=set_value('jawaban_a')?></textarea>
                                <small class="help-block" style="color: #dc3545"><?=form_error('jawaban_'.$abj)?></small>
                            </div>
                        </div>

                        <?php endforeach; ?>

                        <div class="form-group col-sm-12">
                            <label for="jawaban" class="control-label">Kunci Jawaban</label>
                            <select required="required" name="jawaban" id="jawaban" class="form-control select2" style="width:100%!important">
                                <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>                
                            <small class="help-block" style="color: #dc3545"><?=form_error('jawaban')?></small>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="bobot" class="control-label">Bobot Soal</label>
                            <input required="required" value="1" type="number" name="bobot" placeholder="Bobot Soal" id="bobot" class="form-control">
                            <small class="help-block" style="color: #dc3545"><?=form_error('bobot')?></small>
                        </div>
                        <div class="form-group pull-right">
                            <!-- <a href="<?=base_url('soal')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Batal</a>
                            <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button> -->
                        </div>
                    </div>
                </div>
                
             
            </div>
            <div class="row-fluid col-md-7 ">
                    <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' method='save' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Save</button>
                    <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Save and Go to The List</a>
                    <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</a>
                    <span class="loading loading-hide"><img src="<?= BASE_ASSET ?>/img/loading-spin-primary.svg"> <i>Loading, Saving data</i></span>
            </div>
               <!-- /.widget-user -->
            <?=form_close();?>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>            



   <script>
     jQuery(document).ready(function($) {
        $('.btn_action').click(function(event) {
          save_method = $(this).attr('method')
            if (save_method == 'save') {
                 var url = '<?= base_url('admin/soal/save'); ?>';
                  var save_type = $(this).attr('data-stype');
            } else {
                var url = '<?= base_url('admin/soal/edit_save'); ?>';
                var save_type = 'back';
            }
             $.ajax({
               url: url,
               type:"post",
               dataType: 'json',
               data:new FormData(form),
               processData:false,
               contentType:false,
               cache:false,
               async:false,
           })
             .done(function(res) {
                if (res.success == true) {
                  if (save_type == 'stay') {
                    $('form input[type != hidden], form textarea, form select').val('');
                    $('.message').printMessage({
                          message: res.message
                      });
                  } else {

                    toastr['success'](res.message);
                    $('form input[type != hidden], form textarea, form select').val('');
                    return;
                  }

                } else {
                  $('.message').printMessage({
                          message: res.message,
                          type: 'warning'
                  });
                  $('.message').fadeIn();
                }

             })
             .fail(function() {
               console.log("error");
             })
             .always(function() {
             });
      });
     });
   </script>