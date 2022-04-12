<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Pendaftaran Ujian<small>Data</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pendaftaran Ujian</li>
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
                        <?php is_allowed('daftar_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Daftar']); ?>  (Ctrl+a)" href="<?=  site_url('admin/daftar/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Daftar']); ?></a>
                        <?php }) ?>
                        <?php is_allowed('daftar_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Daftar" href="<?= site_url('admin/daftar/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('daftar_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Daftar" href="<?= site_url('admin/daftar/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Pendaftaran Ujian</h3>
                     <h5 class="widget-user-desc">  Pendaftaran Ujian  <i class="label bg-yellow">  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_daftar" id="form_daftar" action="<?= base_url('admin/Daftar/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable" style="width: 98%;">
                     <thead>
                        <tr class="">
                           <td width="5px">
                            <div class="text-center">
                            <input type="checkbox" class="checkbox icheckbox_flat-green toltip select_all " id="check_all" name="check_all" title="Mark All">
                            </div>
                           </td>
                           <td>#</td>
										<th>Kode</th>
								<th>Npm</th>
								<th>Ujian</th>
								<th>Form</th>
								<th>Tanggal Pendaftaran</th>
								<th>Tanggal Ujian</th>
				<th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_Daftar">
                     
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
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value=""><?= cclang('all'); ?></option>
                            <option <?= $this->input->get('f') == 'id' ? 'selected' :''; ?> value="id">Id</option>
                           <option <?= $this->input->get('f') == 'kode' ? 'selected' :''; ?> value="kode">Kode</option>
                           <option <?= $this->input->get('f') == 'npm' ? 'selected' :''; ?> value="npm">Npm</option>
                           <option <?= $this->input->get('f') == 'ujian_id' ? 'selected' :''; ?> value="ujian_id">Ujian Id</option>
                           <option <?= $this->input->get('f') == 'form_id' ? 'selected' :''; ?> value="form_id">Form Id</option>
                           <option <?= $this->input->get('f') == 'tanggal_daftar' ? 'selected' :''; ?> value="tanggal_daftar">Tanggal Daftar</option>
                           <option <?= $this->input->get('f') == 'tanggal_ujian' ? 'selected' :''; ?> value="tanggal_ujian">Tanggal Ujian</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/mhs_daftar');?>" title="<?= cclang('reset_filter'); ?>">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>
                  </form>                  <div class="col-md-4">
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
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_daftar').serialize();
      var list_id = [];
	    $(".data-check:checked").each(function() {
	            list_id.push(this.value);
	    });
      if (bulk.val() == 'delete') {

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
          function(isConfirm){
            if (isConfirm) {
            	if(list_id.length > 0){
            		$.ajax({
		                type: "POST",
		                data: {id:list_id},
		                url: "<?= site_url('admin/daftar/delete')?>",
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
            	
               // document.location.href = BASE_URL + '/admin/daftar/delete?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
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
      url: BASE_AJAX + "daftar/ajax",
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