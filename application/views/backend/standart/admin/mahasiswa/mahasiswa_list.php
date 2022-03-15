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




