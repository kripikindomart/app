<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Menu
      <small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Menu</li>
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
                        <?php is_allowed('Menu_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', 'Menu'); ?> (Ctrl+a)" href="<?= site_url('admin/Menu/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', 'Menu'); ?></a>
                        <?php }) ?>
                        <?php is_allowed('Menu_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export', 'Menu'); ?>" href="<?= site_url('admin/Menu/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export', 'Excel'); ?></a>
                        <?php }) ?>
                        <?php is_allowed('Menu_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export', 'PDF Menu'); ?>" href="<?= site_url('admin/Menu/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export', 'PDF'); ?></a>
                        <?php }) ?>
                        <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Menu</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', 'Menu'); ?> <i class="label bg-yellow count-label">  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_Menu" id="form_Menu" action="<?= base_url('administrator/Menu/index'); ?>">
                  
                  <div class=""> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <td width="5px">
                            <div class="text-center">
                            <input type="checkbox" class="checkbox icheckbox_flat-green toltip select_all" id="check_all" name="check_all" title="<?= cclang('check_all') ?>">
                            </div>
                           </td>
                           <th>Nama Menu</th>
                           <th>Type Menu</th>
                           <th class="action">Category Menu</th>
                           <th class="action">Url / Sug</th>
                           <th class="action">Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_Menu">
                      
                     </tbody>
                     <tfoot>
                       <tr>
                        <td width="5px">
                            <div class="text-center">
                            <input type="checkbox" class="checkbox icheckbox_flat-green toltip select_all" id="check_all" name="check_all" title="<?= cclang('check_all') ?>">
                            </div>
                           </td>
                           <th>Name</th>
                           <th>Definition</th>
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


<script type="text/javascript" src="<?= APP.'menu/menu_list.js' ?>"></script>
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
                        url :'<?= base_url()?>admin/Menu/delete',
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

        var serialize_bulk = $('#form_Menu').serializeAssoc();
        
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
                      url :'<?= base_url()?>admin/Menu/delete',
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

}); /*end doc ready*/
</script>