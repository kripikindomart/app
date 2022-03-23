<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Data Dosen<small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Dosen</li>
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
                     <h3 class="widget-user-username">Data Dosen</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', ['Data Dosen']); ?>  <i class="label bg-yellow"><?= $Dosen_counts; ?>  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_dosen" id="form_dosen" action="<?= base_url('admin/Dosen/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>Nik</th>
                           <th>Nama Lengkap</th>
                           <th>No Ktp</th>
                           <th>Gelar Kesarjanaan</th>
                           <th>Tempat Lahir</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_Dosen">
                     <?php foreach($Dosens as $Dosen): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $Dosen->id; ?>">
                           </td>
                           
                           <td><?= _ent($master_dosen->nik); ?></td> 
                           <td><?= _ent($master_dosen->nama_lengkap); ?></td> 
                           <td><?= _ent($master_dosen->no_ktp); ?></td> 
                           <td><?= _ent($master_dosen->gelar_kesarjanaan); ?></td> 
                           <td><?= _ent($master_dosen->tempat_lahir); ?></td> 
                           <td width="200">
                              <?php is_allowed('master_dosen_view', function() use ($master_dosen){?>
                              <a href="<?= site_url('administrator/master_dosen/view/' . $master_dosen->id); ?>" class="label-default"><i class="fa fa-newspaper-o"></i> <?= cclang('view_button'); ?>
                              <?php }) ?>
                              <?php is_allowed('master_dosen_update', function() use ($master_dosen){?>
                              <a href="<?= site_url('administrator/master_dosen/edit/' . $master_dosen->id); ?>" class="label-default"><i class="fa fa-edit "></i> <?= cclang('update_button'); ?></a>
                              <?php }) ?>
                              <?php is_allowed('master_dosen_delete', function() use ($master_dosen){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/master_dosen/delete/' . $master_dosen->id); ?>" class="label-default remove-data"><i class="fa fa-close"></i> <?= cclang('remove_button'); ?></a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($master_dosen_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Data Dosen data is not available
                           </td>
                         </tr>
                      <?php endif; ?>
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
                            <option <?= $this->input->get('f') == 'nik' ? 'selected' :''; ?> value="nik">Nik</option>
                           <option <?= $this->input->get('f') == 'nama_lengkap' ? 'selected' :''; ?> value="nama_lengkap">Nama Lengkap</option>
                           <option <?= $this->input->get('f') == 'no_ktp' ? 'selected' :''; ?> value="no_ktp">No Ktp</option>
                           <option <?= $this->input->get('f') == 'gelar_kesarjanaan' ? 'selected' :''; ?> value="gelar_kesarjanaan">Gelar Kesarjanaan</option>
                           <option <?= $this->input->get('f') == 'tempat_lahir' ? 'selected' :''; ?> value="tempat_lahir">Tempat Lahir</option>
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
                        <?= $pagination; ?>
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
      var serialize_bulk = $('#form_master_dosen').serialize();

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
               document.location.href = BASE_URL + '/administrator/master_dosen/delete?' + serialize_bulk;      
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

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

  }); /*end doc ready*/




  var table;

$(document).ready(function() {


  $('.dataTables_filter').on('change', function(){
	    let id = $(this).val();
	    let src = BASE_AJAX+'users/ajaxList';
	    let url;


	    if(id !== 'all'){
	      let src2 = src + '/' + id;
	      url = $(this).prop('checked') === true ? src : src2;
	    }else{
	      url = src;
	    }

	    table.ajax.url(url).load();
  });


	table = $(".dataTable").DataTable({
    responsive: true,
    autoWidth:false,
    fnDrawCallback: function(oSettings){
    // if ($(".dataTable tr").length < 11) {
    //   $('.dataTables_paginate').hide();
    // }
   

	$('.switch-button').bootstrapToggle({
		  on: 'Enabled',
      	off: 'Disabled'
	});
	$('.fancybox').fancybox();
	

	
   },
    initComplete: function(settings, json) {
      var api = this.api();
      $(".dataTables_filter input")
        .off(".DT")
        .on("keyup.DT", function(e) {
          api.search(this.value).draw();
        });

      var count = $(".dataTable tr").length-2
      $('.count-label').prepend(count);  
    },
    dom:
      "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
      // {
      //   extend: "copy",
      //   exportOptions: { columns: [1, 2] }
      // },
      // {
      //   extend: "print",
      //   exportOptions: { columns: [1, 2] }
      // },
      // {
      //   extend: "excel",
      //   exportOptions: { columns: [1, 2] }
      // },
      // {
      //   extend: "pdf",
      //   exportOptions: { columns: [1, 2] }
      // }
    ],
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: BASE_AJAX + "dosen/ajaxList",
      type: "POST",
      // data: data,

    },
    columns: [
      {
        data: "id",
        orderable: false,
        searchable: false
      },
      {
        data: "id",
        orderable: false,
        searchable: false
      },
      { data: {username: "username", avatar:"avatar"},
      	orderable: false,
      	searchable : false,
      	render : function(data){
      		let files = "";
          var url = BASE_URL+"uploads/user/"+data.avatar;
          
      		if (url) {
      			files = url;
      		} else {
      			files = BASE_URL+"uploads/user/default2.png";
      		}
      		
      		return '<div class="chip"><a class="fancybox" rel="group" href="'+files+'" onerror="urlExisithref(this);"><img onerror="urlExists(this);"  src="'+files+'" alt="Person" width="50" height="50"></a> '+data.username+'</div>';
      	}
      },
      { data: "email" },
      { data: "full_name" },
      { data: {id:"id", banned:"banned", status: 'status'},
      	orderable: false,
      	searchable : false,
      	render : function (data, type, row, meta){
      		let check = data.banned == 0  ? 'checked' : '';

      		
      		
      		//let btn = `<input type="checkbox" name="status" data-user-id="${data.id}" class="switch-button" ${check}>`;
      		let btn = `<input data-size="mini" data-onstyle="success" data-offstyle="danger" class="switch-button" type="checkbox" ${check} data-toggle="toggle" name="status" data-user-id="${data.id}">`;
      		if (data.status == 1  ) {
      			return btn ;
      		} else if (data.status == '') {
      			return check = data.banned ? 'N' : 'Y';
      		}


      		
      	}	  	

      },
      { data:  {
          id: "id",
          btn_edit: "btn_edit",
          btn_delete:"btn_delete"
        }, 
        orderable: false,
        searchable: false,
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                  ${data.btn_detail}
                  ${data.btn_edit}
                  ${data.btn_delete}
                </div>`;
        }

    },

    ],
    columnDefs: [
      {
        targets: 0,
        data: "id",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                  <input name="delete_id[]" class="icheckbox_flat-green check" value="${data}" type="checkbox">
                </div>`;
        }
      }
    ],
    order: [[1, "asc"]],
    rowId: function(a) {
      return a;
    },
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      //Untuk No Halaman
      $("td:eq(1)", row).html(index);

      	 
    },


  });

  table
    .buttons()
    .container()
    .appendTo(".dataTable .col-md-6:eq(0)");


    
});
</script>