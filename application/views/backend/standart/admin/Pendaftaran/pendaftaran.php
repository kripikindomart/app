<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Prodi
      <small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Prodi</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      <div class="col-md-3">
         <div class="box box-warning">
            <div class="box-header with-border">
                        <div class="box-title">Filter</div>
                    </div><!-- /.box-header -->
            <div class="box-body ">
                <div class="form-group">
                      <label>Pilih Program Studi</label>
                      <div id="data-kelas">
                          <select id="prodi_filter" class="form-control chosen chosen-select filter" style="width:100% !important">
                              <option value="all">Semua Program Studi</option>
                              <?php foreach ($prodi as $m) :?>
                                <option value="<?=$m->id?>"><?=$m->program_studi?></option>
                              <?php endforeach; ?>
                            </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label>Tahun Angkatan</label>
                      <div id="data-angkatan">
                        <select id="thn_angkatan" class="form-control chosen chosen-select filter" style="width:100% !important">
                              <option value="">Semua Angkatan</option>
                              <?php foreach ($angkatan as $m) :?>
                                <option value="<?=$m->id?>"><?=$m->keterangan?></option>
                              <?php endforeach; ?>
                            </select>
                          
                      </div>
                  </div>

                  <div class="form-group">
                     <a href="<?= site_url('admin/mahasiswa/create') ?>" class="btn btn-sm btn-info btn-flat " id="add">Tambah data</a>
                  </div>

            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
      <div class="col-md-9">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="row">
                        <div class="col-sm-4">
                          
                          <a href="<?= BASE_URL('admin/mahasiswa/import') ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Import</a>
                          <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
                          <div class="pull-right">
                             <!--  <button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Delete</button> -->
                          </div>
                        </div>
                        <div class="form-group col-sm-4 ">
                            
                        </div>
                        <div class="col-sm-4 ">
                          <div class="row ">
                            <div class="col-md-12 pull-right">
                                 <div class="col-sm-6 padd-left-0 " >
                                    <select type="text" class="form-control chosen chosen-select bulk" name="bulk"  placeholder="Site Email" >
                                       <option value="">Bulk</option>
                                       <option value="delete">Delete</option>
                                       <option value="add">Create User</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-2 padd-left-0 ">
                                    <button type="button" class="btn btn-flat apply"  name="apply"  value="Apply" title="">Apply</button>
                                 </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
               
                  <?= form_open('admin/mahasiswa/delete', array('id' => 'form_user')); ?>
                  
                  <div class="table-responsive"> 
                  <table id="mahasiswa" class="table table-striped dataTable table table-bordered table-hover" style="width:100% !important">
                    <thead>
                    <tr>
                        <th width="5px">No.</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>No HP</th>
                        <th>Program Studi</th>
                        <th width="100" class="text-center">Aksi</th>
                        <td width="5px">
                            <div class="text-center">
                            <input type="checkbox" class="checkbox select_all"  name="select_all" title="<?= cclang('check_all') ?>">
                            </div>
                        </td>
                    </tr>
                     </thead>
                     </thead>
                      <tfoot>
                          <tr>
                              <th width="5px">No.</th>
                              <th>NPM</th>
                              <th>Nama Mahasiswa</th>
                              <th>No HP</th>
                              <th>Program Studi</th>
                              <th width="100" class="text-center">Aksi</th>
                             <td width="5px">
                                  <div class="text-center">
                                  <input type="checkbox" class="checkbox select_all"  name="select_all" title="<?= cclang('check_all') ?>">
                                  </div>
                              </td>
                          </tr>
                      </tfoot>
                  </table>
                  </div>
                  <?= form_close() ?>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-6 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select bulk" name="bulk"  placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete">Delete</option>
                           <option value="add">Create User</option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat apply"  name="apply"  value="Apply" title="">Apply</button>
                     </div>
                     
                     
                  </div>
                  <?= form_close(); ?>
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                      
                     </div>
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>
</section>
<!-- /.content -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#03904e; color:#fff; ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Form Pengajuan</h3>
            </div>
            <div class="modal-body form">
                <form class="form form-horizontal" method="post" enctype="multipart/form-data" id="form">
                  <input type="hidden" name="id">
                    <div class="form-group ">
                        <label for="label" class="col-sm-2 control-label">Pendaftran Ujian</label>
                        <div class="col-sm-8">
                          <select name="jenjang" id="" class="form-control select2">
                            <option value=""> - Pilih Ujian - </option>
                            <option value="kompre">Komprehensif</option>
                            <option value="tesis">Sidang Tesis</option>
                            <option value="disertasi">Sidang Disertasi</option>
                          </select>
                          <i class="required"><small></small></i>
                        </div>
                    </div>  

                  <input type="hidden" name="id">
                    <div class="form-group ">
                        <label for="label" class="col-sm-2 control-label">Program Studi</label>
                        <div class="col-sm-8">
                          <input type="text" name="prodi" class="form-control" id="prodi" readonly>
                          <i class="required"><small></small></i>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="url" class="col-sm-2 control-label">Tahun Angkatan <i class="required">*</i></label>
                         <div class="col-sm-8">
                             <input type="text" name="angkatan" class="form-control" id="angkatan" readonly>
                       
                          <i class="required"><small></small></i>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="url" class="col-sm-2 control-label">Nama Mahasiswa<i class="required">*</i></label>

                         <div class="col-sm-8">
                          <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa" placeholder="Nama" value="" readonly>
                          <i class="required"><small></small></i>
                        </div>
                    </div>
                    

                </form>
            </div>
            <div class="modal-footer">

                <div class="message">

                </div>
                <span class="loading loading-hide"><img src="<?= base_url('assets'); ?>/img/loading-spin-primary.svg"> <i>Loading, Saving data</i></span>
               <!--  <button type="submit" class="btn btn-flat btn-primary btn_save btn_action" id="simpan" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Save</button> -->
                <button type="submit" class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="simpan" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Ajukan</button>
                <button type="button" data-dismiss="modal" class="btn btn-flat btn-default " id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript" src="<?= APP.'mahasiswa/mahasiswa_list.js' ?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $(document).on('click', '.btn-aktif', function(event) {
            event.preventDefault();
            /* Act on the event */
            var id = $(this).attr('data-id')
            $.ajax({
                url: '<?= base_url('admin/pendaftaran/getData') ?>',
                type: 'POST',
                dataType: 'json',
                data: {id:id},
            })
            .done(function(res) {
                if (res.success == true) {
                    $('form input[type != hidden], form textarea, form select').val('');
                   $('#modal_form').modal('show'); 
                   $('#angkatan').val(res.data.keterangan)
                   $('#nama_mahasiswa').val(res.data.nama_lengkap)
                   $('#prodi').val(res.data.program_studi)
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
        });
    });
</script>