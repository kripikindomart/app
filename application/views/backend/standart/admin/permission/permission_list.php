<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      permission
      <small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">permission</li>
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
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">
                        <?php is_allowed('group_add', function(){?>
                        <button class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', 'Permission'); ?> (Ctrl+a)" href="<?= site_url('admin/permission/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', 'Permission'); ?></button>
                        <?php }) ?>
                        <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Permission</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', 'Permission'); ?> <i class="label bg-yellow count-label">  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_group" id="form_group" action="<?= base_url('administrator/group/index'); ?>">
                  
                  <div class=""> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <td width="5px">
                            <div class="text-center">
                            <input type="checkbox" class="checkbox icheckbox_flat-green toltip select_all " id="check_all" name="check_all" title="<?= cclang('check_all') ?>">
                            </div>
                           </td>
                           <th width="5px">No.</th>
                           <th>Permission</th>
                           <th>Detail</th>
                           <th class="action">Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_group">
                      
                     </tbody>
                     <tfoot>
                       <tr>
                        <td width="5px">
                            <div class="text-center">
                            <input type="checkbox" class="checkbox icheckbox_flat-green toltip select_all" id="check_all" name="check_all" title="<?= cclang('check_all') ?>">
                            </div>
                           </td>
                           <th width="5px">No.</th>
                           <th>Permission</th>
                           <th>Detail</th>
                           <th class="action">Action</th>
                      </tr>
                     </tfoot>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select bulk" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete"><?= cclang('delete'); ?></option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="apply bulk actions"><?= cclang('apply_button'); ?></button>
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
<div class="modal fade" id="modal_form" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#03904e; color:#fff; ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Edit Data</h3>
            </div>
            <div class="modal-body  form-horizontal">
                <?= form_open('', [
                    'name'    => 'form_user', 
                    'class'   => 'form-horizontal', 
                    'id'      => 'form', 
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST'
                  ]); 

                  ?>
                  <input type="hidden" name="id">


                    <div class="form-group ">

                        <label for="text" class="col-sm-2 control-label">Permission <i class="required"></i></label>



                        <div class="col-sm-8">

                          <input type="text" class="form-control" name="permission" id="permission" placeholder="Permission" value="">

                          <small class="info help-block"></small>

                        </div>

                    </div>

                    <div class="form-group ">

                        <label for="text" class="col-sm-2 control-label">Detail <i class="required"></i></label>



                        <div class="col-sm-8">

                          <textarea name="detal" id="" cols="30" rows="10" class="form-control"></textarea>

                          <small class="info help-block"></small>

                        </div>

                    </div>



                  <?= form_close(); ?>
                  
                  
            </div>
            <div class="modal-footer">

                <div class="message">

                </div>
                <span class="loading loading-hide"><img src="<?= base_url('assets'); ?>/img/loading-spin-primary.svg"> <i>Loading, Updating data</i></span>
                <button type="submit" class="btn btn-flat btn-info btn_save btn_action" id="simpan" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Update Data</button>
                <button type="button" data-dismiss="modal" class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="<?= APP.'permission/permission_list.js' ?>"></script>
<!-- Page script -->
<script>


  $(document).ready(function() {
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });


     $(document).on('click', '.delete', function(){
       var delete_id = $(this).attr('data-id');
        swal({
                title: "<?= cclang('are_you_sure'); ?>",
                text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
                cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                   $.ajax({
                        url :'<?= base_url()?>admin/permission/delete',
                        type :'POST',
                        dataType: 'json',
                        data: {delete_id:delete_id}, 
                    })

                     .done(function(data){
                        if (data.success ==true) {
                                reload_ajax();
                                toastr['success'](data.message);  
                                return;
                        } else {
                            toastr['error'](data.message);   
                        }
                    }) 
                } 
            })
        
    });


    $('#apply').click(function() {
        var bulk = $('.bulk');

        var serialize_bulk = $('#form_group').serializeAssoc();
        
        if (bulk.val() == 'delete') {
           if ('delete_id' in serialize_bulk) {
               swal({
               title: "<?= cclang('are_you_sure'); ?>",
               text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
               type: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
               cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
               closeOnConfirm: true,
               closeOnCancel: true
           },
           function(isConfirm) {
               if (isConfirm) {
                 $.ajax({
                      url :'<?= base_url()?>admin/permission/delete',
                      type :'POST',
                      dataType: 'json',
                      data: serialize_bulk, 
                  })

                   .done(function(data){
                      if (data.success == true) {
                        reload_ajax();
                          toastr['success'](data.message);
                       return;
                      } else {
                          toastr['error'](data.message);   
                      }
                  }) 
              } 
           });
            return false;
           } else {
              swal({
                title: "Opps",
                text: "<?= cclang('data_is_not_avaiable') ?>",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Okay!",
                closeOnConfirm: true,
                closeOnCancel: true,
                customClass: 'swal-wide',
            });

            return false;
           }

          

        }  else if (bulk.val() == '') {
            swal({
                title: "Opps",
                text: "<?= cclang('please_choose_bulk_action_first') ?>",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Okay!",
                closeOnConfirm: true,
                closeOnCancel: true,
                customClass: 'swal-wide',
            });

            return false;
        } else {
          if (checkboxes.length <= 0) {
             swal({
                title: "Opps",
                text: "<?= cclang('data_is_not_avaiable') ?>",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Okay!",
                closeOnConfirm: true,
                closeOnCancel: true,
                customClass: 'swal-wide',
            });

            return false;
          }
        }

        return false;
    }); /*end appliy click*/

    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event) {
        if (checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

    $('#btn_add_new').click(function(event) {
      /* Act on the event */
      event.preventDefault();
      $('#modal_form').modal('show');


    });

}); /*end doc ready*/
</script>