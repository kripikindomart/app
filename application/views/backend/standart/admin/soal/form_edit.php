<div class="row" >
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <?=form_open_multipart('', array('id'=>'formsoal'), array('method'=>'edit', 'id_soal'=>$soal->id));?>
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
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="dosen_id" class="control-label">Program Studi</label>

                                <?= form_dropdown('prodi_id', getDropdownList('master_prodi', ['id', 'program_studi']), set_value('program_studi', $soal->id_master_prodi) , ['class' => 'form-control select2']); ?>
                                <small class="help-block" style="color: #dc3545"><?=form_error('dosen_id')?></small>
                            </div>
                            
                            <div class="col-sm-12">
                                <label for="soal" class="control-label text-center">Soal (Pertanyaan)</label>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <input type="file" name="file_soal" class="form-control" >
                                        <small class="help-block" style="color: #dc3545"><?=form_error('file_soal')?></small>
                                        <?php if(!empty($soal->file)) : ?>
                                            <?=tampil_media('uploads/bank_soal/'.$soal->file);?>
                                        <button type="button" class="btn btn-flat btn-danger hapus" data-id="file" data-value="<?= $soal->file ?>"><i class="fa fa-trash"></i> Hapus Gambar</button>    
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <textarea name="soal" id="soal" class="form-control froala-editor ckeditor"><?=$soal->pertanyaan?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('soal')?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 
                                Membuat perulangan A-E 
                            -->
                            <?php
                            $abjad = ['a', 'b', 'c', 'd', 'e']; 
                            foreach ($abjad as $abj) :
                                $ABJ = strtoupper($abj); // Abjad Kapital
                                $file = 'file_'.$abj;
                                $opsi = 'opsi_'.$abj;
                            ?>
                            
                            <div class="col-sm-12">
                                <label for="jawaban_<?= $abj; ?>" class="control-label text-center">Jawaban <?= $ABJ; ?></label>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <input type="file" name="<?= $file; ?>" class="form-control" value="<?= $soal->file ?>">
                                        <small class="help-block" style="color: #dc3545"><?=form_error($file)?></small>
                                        <?php if(!empty($soal->$file)) : ?>
                                            <?=tampil_media('uploads/bank_soal/'.$soal->$file);?>
                                            <button type="button" class="btn btn-flat btn-danger hapus" data-value="<?= $soal->file ?>" data-id="<?= $file; ?>"><i class="fa fa-trash"></i> Hapus Gambar</button>   
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <textarea name="jawaban_<?= $abj; ?>" id="jawaban_<?= $abj; ?>" class="form-control froala-editor ckeditor"><?=$soal->$opsi?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('jawaban_'.$abj)?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <?php endforeach; ?>
                            
                            <div class="form-group col-sm-12">
                                <label for="jawaban" class="control-label">Kunci Jawaban</label>
                                <select required="required" name="jawaban" id="jawaban" class="form-control select2" style="width:100%!important">
                                    <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                    <option <?=$soal->jawaban==="A"?"selected":""?> value="A">A</option>
                                    <option <?=$soal->jawaban==="B"?"selected":""?> value="B">B</option>
                                    <option <?=$soal->jawaban==="C"?"selected":""?> value="C">C</option>
                                    <option <?=$soal->jawaban==="D"?"selected":""?> value="D">D</option>
                                    <option <?=$soal->jawaban==="E"?"selected":""?> value="E">E</option>
                                </select>                
                                <small class="help-block" style="color: #dc3545"><?=form_error('jawaban')?></small>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="bobot" class="control-label">Bobot Nilai</label>
                                <input required="required" value="<?=$soal->bobot?>" type="number" name="bobot" placeholder="Bobot Soal" id="bobot" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('bobot')?></small>
                            </div>
                            <div class="col-sm-12">
                                <!-- <div class="form-group pull-right">
                                    <a href="<?=base_url('soal')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Batal</a>
                                    <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                                </div> -->
                            </div>

                        </div>
                    </div>
                    </div>
                    
                </div>
                <div class="message"></div>
               <!-- /.widget-user -->
               <div class="row-fluid col-md-7 ">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Save</button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Save and Go to The List</a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</a>
                            <span class="loading loading-hide"><img src="<?= BASE_ASSET ?>/img/loading-spin-primary.svg"> <i>Loading, Saving data</i></span>
                    </div>
            <?=form_close();?>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>   


   <script>
       jQuery(document).ready(function($) {
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
                        window.location.href = BASE_URL + 'admin/soal';
                    }
                });

                return false;
            }); /*end btn cancel*/

           //for delete
            $(document).on('click', '.hapus', function(){
               var form = $('#formsoal')[0];
               var data_id = $(this).attr('data-id');
               var data_value = $(this).attr('data-value');
               var formsoal = $('#formsoal');
               var data = formsoal.serializeArray();
               var formData = new FormData(form);
               formData.append('data_id', data_id);
               formData.append('data_value', data_value);
               data.push({
                name : "data_id",
                value : data_id,
               });

               data.push({
                name : "data_value",
                value : data_value,
               })

               console.log(formData);    

                swal({
                        title: "Anda Yakin?",
                        text: "gambar yang di hapus tidak bisa di restore!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, Hapus !",
                        cancelButtonText: "Tidak !",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                           $.ajax({
                                url :'<?= base_url()?>' +'admin/soal/delete_image',
                                type :'POST',
                                dataType: 'json',
                                data: formData,
                                 processData:false,
                                 contentType:false,
                                 cache:false,
                                 async:false,
                            })

                             .done(function(data){
                                console.log(data);
                                if (data.success ==true) {
                                        location.reload();
                                        return;
                                } else {
                                    toastr['error'](data.message);   
                                }
                            }) 
                        } 
                    })
                
            });

             $('.btn_save').click(function() {
                $('.message').fadeOut();

                var form_user = $('#formsoal');
                var data_post = form_user.serializeArray();
                var save_type = $(this).attr('data-stype');
                var form = $('#formsoal')[0];
                data_post.push({
                    name: 'save_type',
                    value: save_type
                });

                $('.loading').show();

                // data_post.group = $('#group').chosen().val();

                $.ajax({
                        url: BASE_URL + 'admin/soal/edit_save',
                        type: 'POST',
                        dataType: 'json',
                        data:new FormData(form),
                         processData:false,
                         contentType:false,
                         cache:false,
                         async:false,
                    })
                    .done(function(res) {
                        console.log(res)
                        if (res.success) {
                            if (save_type == 'back') {
                                window.location.href = res.redirect;
                                return;
                            }
                            location.reload();    
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
       });
   </script>