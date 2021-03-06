<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Dosen<small>Data</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dosen</li>
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
                        <?php is_allowed('Dosen_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Dosen']); ?>  (Ctrl+a)" href="<?=  site_url('admin/Dosen/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Dosen']); ?></a>
                        <?php }) ?>
                        <?php is_allowed('Dosen_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Dosen" href="<?= site_url('admin/Dosen/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('Dosen_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Dosen" href="<?= site_url('admin/Dosen/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Dosen</h3>
                     <h5 class="widget-user-desc">  Dosen  <i class="label bg-yellow">  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_dosen" id="form_dosen" action="<?= base_url('admin/Dosen/index'); ?>">
                  

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
										<th>Nik</th>
								<th>Nama Lengkap</th>
								<th>Jenis Kelamin</th>
								<th>No Ktp</th>
								<th>Gelar Kesarjanaan</th>
								<th>Tempat Lahir</th>
								<th>Tanggal Lahir</th>
								<th>Status Kawin</th>
								<th>Alamat Rumah</th>
								<th>Email</th>
								<th>No Hp</th>
								<th>Prodi</th>
								<th>Fungsional</th>
								<th>Golongan</th>
								<th>Foto</th>
								<th>Status Dosen</th>
				<th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_Dosen">
                     
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
                           <option <?= $this->input->get('f') == 'nik' ? 'selected' :''; ?> value="nik">Nik</option>
                           <option <?= $this->input->get('f') == 'nama_lengkap' ? 'selected' :''; ?> value="nama_lengkap">Nama Lengkap</option>
                           <option <?= $this->input->get('f') == 'jenis_kelamin' ? 'selected' :''; ?> value="jenis_kelamin">Jenis Kelamin</option>
                           <option <?= $this->input->get('f') == 'no_ktp' ? 'selected' :''; ?> value="no_ktp">No Ktp</option>
                           <option <?= $this->input->get('f') == 'gelar_kesarjanaan' ? 'selected' :''; ?> value="gelar_kesarjanaan">Gelar Kesarjanaan</option>
                           <option <?= $this->input->get('f') == 'tempat_lahir' ? 'selected' :''; ?> value="tempat_lahir">Tempat Lahir</option>
                           <option <?= $this->input->get('f') == 'tanggal_lahir' ? 'selected' :''; ?> value="tanggal_lahir">Tanggal Lahir</option>
                           <option <?= $this->input->get('f') == 'status_kawin' ? 'selected' :''; ?> value="status_kawin">Status Kawin</option>
                           <option <?= $this->input->get('f') == 'alamat_rumah' ? 'selected' :''; ?> value="alamat_rumah">Alamat Rumah</option>
                           <option <?= $this->input->get('f') == 'email' ? 'selected' :''; ?> value="email">Email</option>
                           <option <?= $this->input->get('f') == 'no_hp' ? 'selected' :''; ?> value="no_hp">No Hp</option>
                           <option <?= $this->input->get('f') == 'id_master_prodi' ? 'selected' :''; ?> value="id_master_prodi">Id Master Prodi</option>
                           <option <?= $this->input->get('f') == 'fungsional' ? 'selected' :''; ?> value="fungsional">Fungsional</option>
                           <option <?= $this->input->get('f') == 'golongan' ? 'selected' :''; ?> value="golongan">Golongan</option>
                           <option <?= $this->input->get('f') == 'foto' ? 'selected' :''; ?> value="foto">Foto</option>
                           <option <?= $this->input->get('f') == 'status_dosen' ? 'selected' :''; ?> value="status_dosen">Status Dosen</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/master_dosen');?>" title="<?= cclang('reset_filter'); ?>">
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
      var serialize_bulk = $('#form_dosen').serialize();
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
		                url: "<?= site_url('admin/dosen/delete')?>",
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
            	
               // document.location.href = BASE_URL + '/admin/dosen/delete?' + serialize_bulk;      
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
      url: BASE_AJAX + "dosen/ajax",
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