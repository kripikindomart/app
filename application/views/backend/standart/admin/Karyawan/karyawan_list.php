<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Data Karyawan<small>Data</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Karyawan</li>
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
                        <?php is_allowed('Karyawan_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Karyawan']); ?>  (Ctrl+a)" href="<?=  site_url('admin/Karyawan/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Karyawan']); ?></a>
                        <?php }) ?>
                        <?php is_allowed('Karyawan_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Karyawan" href="<?= site_url('admin/Karyawan/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('Karyawan_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Karyawan" href="<?= site_url('admin/Karyawan/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Data Karyawan</h3>
                     <h5 class="widget-user-desc">  Data Karyawan  <i class="label bg-yellow">  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_karyawan" id="form_karyawan" action="<?= base_url('admin/Karyawan/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <td width="5px">
                            <div class="text-center">
                            <input type="checkbox" class="checkbox icheckbox_flat-green toltip select_all " id="check_all" name="check_all" title="<?= cclang('check_all') ?>">
                            </div>
                           </td>
                           <td>#</td>
                           <th>Code</th>
                           <th>Nik</th>
                           <th>Nama</th>
                           <th>Email</th>
                           <th>Jenis Kelamin</th>
                           <th>Photo</th>
                           <th>Program Studi</th>
                           <th>Departement</th>
                           <th>Status Akun</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_Karyawan">
                     
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
                            <option <?= $this->input->get('f') == 'code' ? 'selected' :''; ?> value="code">Code</option>
                           <option <?= $this->input->get('f') == 'nik' ? 'selected' :''; ?> value="nik">Nik</option>
                           <option <?= $this->input->get('f') == 'nama' ? 'selected' :''; ?> value="nama">Nama</option>
                           <option <?= $this->input->get('f') == 'email' ? 'selected' :''; ?> value="email">Email</option>
                           <option <?= $this->input->get('f') == 'jenis_kelamin' ? 'selected' :''; ?> value="jenis_kelamin">Jenis Kelamin</option>
                           <option <?= $this->input->get('f') == 'photo' ? 'selected' :''; ?> value="photo">Photo</option>
                           <option <?= $this->input->get('f') == 'program_studi_id' ? 'selected' :''; ?> value="program_studi_id">Program Studi Id</option>
                           <option <?= $this->input->get('f') == 'departement_id' ? 'selected' :''; ?> value="departement_id">Departement Id</option>
                           <option <?= $this->input->get('f') == 'status_akun' ? 'selected' :''; ?> value="status_akun">Status Akun</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/karyawans');?>" title="<?= cclang('reset_filter'); ?>">
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
      var serialize_bulk = $('#form_karyawans').serialize();

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
               document.location.href = BASE_URL + '/administrator/karyawans/delete?' + serialize_bulk;      
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


    

  }); /*end doc ready*/




  var table;

$(document).ready(function() {


  $('.dataTables_filter').on('change', function(){
	    let id = $(this).val();
	    let src = BASE_AJAX+'users/getDatatable';
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
    if ($(".dataTable tr").length < 11) {
      $('.dataTables_paginate').hide();
    }
   


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
     
    ],
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: BASE_AJAX + "karyawan/getDatatable",
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
     
    {
        data: "code",
        orderable: false,
        searchable: true
    },
     
    {
        data: "nik",
        orderable: false,
        searchable: true
    },
     
    {
        data: "nama",
        orderable: false,
        searchable: true
    },
     
    {
        data: "email",
        orderable: true,
        searchable: true
    },
     
    {
        data: "jenis_kelamin",
        orderable: false,
        searchable: true
    },
     
    {
        data: "photo",
        orderable: false,
        searchable: true
    },
        {
        data: "program_studis",
        orderable: true,
        searchable: true
    },
   
        {
        data: "departements",
        orderable: true,
        searchable: true
    },
   
     
    {
        data: "status_akun",
        orderable: false,
        searchable: true
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
</script>