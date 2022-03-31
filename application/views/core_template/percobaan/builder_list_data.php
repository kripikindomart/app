<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      <?= ucwords($subject); ?><small>Data</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?= ucwords($subject); ?></li>
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
                        <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
                        <?php if ($this->input->post('create')) { ?>{php_open_tag} is_allowed('<?= $controller_name; ?>_add', function(){{php_close_tag}
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="{php_open_tag_echo} cclang('add_new_button', ['<?= ucwords(clean_snake_case($controller_name)); ?>']); {php_close_tag}  (Ctrl+a)" href="{php_open_tag_echo}  site_url('admin/<?= $controller_name; ?>/add'); {php_close_tag}"><i class="fa fa-plus-square-o" ></i> {php_open_tag_echo} cclang('add_new_button', ['<?= ucwords(clean_snake_case($controller_name)); ?>']); {php_close_tag}</a>
                        {php_open_tag} }) {php_close_tag}
                        <?php } ?>{php_open_tag} is_allowed('<?= $controller_name; ?>_export', function(){{php_close_tag}
                        <a class="btn btn-flat btn-success" title="{php_open_tag_echo} cclang('export'); {php_close_tag} <?= ucwords(clean_snake_case($controller_name)); ?>" href="{php_open_tag_echo} site_url('admin/<?= $controller_name; ?>/export'); {php_close_tag}"><i class="fa fa-file-excel-o" ></i> {php_open_tag_echo} cclang('export'); {php_close_tag} XLS</a>
                        {php_open_tag} }) {php_close_tag}
                        {php_open_tag} is_allowed('<?= $controller_name; ?>_export', function(){{php_close_tag}
                        <a class="btn btn-flat btn-success" title="{php_open_tag_echo} cclang('export'); {php_close_tag} pdf <?= ucwords(clean_snake_case($controller_name)); ?>" href="{php_open_tag_echo} site_url('admin/<?= $controller_name; ?>/export_pdf'); {php_close_tag}"><i class="fa fa-file-pdf-o" ></i> {php_open_tag_echo} cclang('export'); {php_close_tag} PDF</a>
                        {php_open_tag} }) {php_close_tag}
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username"><?= ucwords($subject); ?></h3>
                     <h5 class="widget-user-desc">  <?= ucwords($subject); ?>  <i class="label bg-yellow">  {php_open_tag_echo} cclang('items'); {php_close_tag}</i></h5>
                  </div>

                  <form name="form_<?= $uc_controller_name; ?>" id="form_<?= $uc_controller_name; ?>" action="{php_open_tag_echo} base_url('admin/<?= $controller_name; ?>/index'); {php_close_tag}">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable" style="width: 98%;">
                     <thead>
                        <tr class="">
                           <td width="5px">
                            <div class="text-center">
                            <input type="checkbox" class="checkbox icheckbox_flat-green toltip select_all " id="check_all" name="check_all" title="<?= cclang('check_all') ?>">
                            </div>
                           </td>
                           <td>#</td>
		<?php foreach ($this->crud_builder->getFieldShowInColumn(true) as $option): ?>
		<?php if ($option['label'] != $primary_key): ?>
		<th><?= ucwords(clean_snake_case($option['label'])); ?></th>
		<?php endif ?>
		<?php endforeach; ?><th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_<?= $controller_name; ?>">
                     
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete">Delete</option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="{php_open_tag_echo} cclang('apply_bulk_action'); {php_close_tag}">{php_open_tag_echo} cclang('apply_button'); {php_close_tag}</button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="{php_open_tag_echo} cclang('filter'); {php_close_tag}" value="{php_open_tag_echo} $this->input->get('q'); {php_close_tag}">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value="">{php_open_tag_echo} cclang('all'); {php_close_tag}</option>
                           <?php foreach ($this->crud_builder->getFieldShowInColumn() as $field): 
                          ?> <option {php_open_tag_echo} $this->input->get('f') == '<?= $field; ?>' ? 'selected' :''; {php_close_tag} value="<?= $field; ?>"><?= ucwords(clean_snake_case($field)); ?></option>
                          <?php endforeach;
                        ?></select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="{php_open_tag_echo} cclang('filter_search'); {php_close_tag}">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="{php_open_tag_echo} base_url('administrator/<?= $table_name; ?>');{php_close_tag}" title="{php_open_tag_echo} cclang('reset_filter'); {php_close_tag}">
                        <i class="fa fa-undo"></i>
                        </a>
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

<!-- Page script -->
<script>
  $(document).ready(function(){
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "{php_open_tag_echo} cclang('are_you_sure'); {php_close_tag}",
          text: "{php_open_tag_echo} cclang('data_to_be_deleted_can_not_be_restored'); {php_close_tag}",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "{php_open_tag_echo} cclang('yes_delete_it'); {php_close_tag}",
          cancelButtonText: "{php_open_tag_echo} cclang('no_cancel_plx'); {php_close_tag}",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_<?= $uc_controller_name; ?>').serialize();
      var list_id = [];
	    $(".data-check:checked").each(function() {
	            list_id.push(this.value);
	    });
      if (bulk.val() == 'delete') {

         swal({
            title: "{php_open_tag_echo} cclang('are_you_sure'); {php_close_tag}",
            text: "{php_open_tag_echo} cclang('data_to_be_deleted_can_not_be_restored'); {php_close_tag}",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{php_open_tag_echo} cclang('yes_delete_it'); {php_close_tag}",
            cancelButtonText: "{php_open_tag_echo} cclang('no_cancel_plx'); {php_close_tag}",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
            	if(list_id.length > 0){
            		$.ajax({
		                type: "POST",
		                data: {id:list_id},
		                url: "{php_open_tag_echo} site_url('admin/{uc_controller_name}/delete'){php_close_tag}",
		                dataType: "JSON",
		                success: function(data)
		                {
		                    if(data.status)
		                    {
		                        reload_table();
		                    }
		                    else
		                    {
		                        alert('Failed.');
		                    }
		                     
		                },
		                error: function (jqXHR, textStatus, errorThrown)
		                {
		                    alert('Error deleting data');
		                }
		            });
            	} else {
            		alert('Error deleting data');
            	}
            	
               // document.location.href = BASE_URL + '/admin/<?= $uc_controller_name; ?>/delete?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "{php_open_tag_echo} cclang('please_choose_bulk_action_first'); {php_close_tag}",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/




$(document).ready(function() {



	table = $(".dataTable").DataTable({
    responsive: true,
    autoWidth:false,
    fnDrawCallback: function(oSettings){
    if ($(".dataTable tr").length < 11) {
      $('.dataTables_paginate').hide();
    }
   

	
	$('.fancybox').fancybox();
	

	
   },
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    order : [],
    ajax: {
      url: BASE_AJAX + "<?= $uc_controller_name ?>/ajax",
      type: "POST",
      // data: data,
    },
    columnDefs : [
      { 
          "targets": [ -1, 1, 0 ], //last column
          "orderable": false, //set not orderable

      }
    ],
    rowId: function(a) {
      return a;
    },
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(0)", row).html(index);
    }


  });

  table
    .buttons()
    .container()
    .appendTo(".dataTable .col-md-6:eq(0)");

 
  
  $(".select_all").on("click", function() {
      if (this.checked) {
        $(".check").each(function() {
          this.checked = true;
          $(".select_all").prop("checked", true);
        });
      } else {
        $(".check").each(function() {
          this.checked = false;
          $(".select_all").prop("checked", false);
        });
      }
   });  
});  
    
});
</script>