<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      <?= ucwords($subject); ?><small>{php_open_tag_echo} cclang('list_all'); {php_close_tag}</small>
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
                     <h5 class="widget-user-desc">{php_open_tag_echo} cclang('list_all', ['<?= ucwords($subject); ?>']); {php_close_tag}  <i class="label bg-yellow">{php_open_tag_echo} $<?= $controller_name; ?>_counts; {php_close_tag}  {php_open_tag_echo} cclang('items'); {php_close_tag}</i></h5>
                  </div>

                  <form name="form_<?= $uc_controller_name; ?>" id="form_<?= $uc_controller_name; ?>" action="{php_open_tag_echo} base_url('admin/<?= $controller_name; ?>/index'); {php_close_tag}">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <?php foreach ($this->crud_builder->getFieldShowInColumn(true) as $option): ?><th><?= ucwords(clean_snake_case($option['label'])); ?></th>
                           <?php endforeach; ?><th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_<?= $controller_name; ?>">
                     {php_open_tag} foreach($<?= $controller_name; ?>s as $<?= $controller_name; ?>): {php_close_tag}
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="{php_open_tag_echo} $<?= $controller_name; ?>->{primary_key}; ?>">
                           </td>
                           
                           <?php foreach ($this->crud_builder->getFieldShowInColumn() as $field): ?><?php 
                           $relation = $this->crud_builder->getFieldRelation($field);
                           if (!$this->crud_builder->getFieldFile($field) AND !$this->crud_builder->getFieldFileMultiple($field) AND !$relation){ 
                            ?><td>{php_open_tag_echo} _ent($<?= $table_name; ?>-><?= $field; ?>); {php_close_tag}</td><?php } elseif ($relation){
                            ?><td>{php_open_tag_echo} _ent($<?= $table_name; ?>-><?= $relation['relation_label']; ?>); {php_close_tag}</td>
                            <?php } elseif($this->crud_builder->getFieldFileMultiple($field)) { 
                            ?><td>
                              {php_open_tag} foreach (explode(',', $<?= $table_name; ?>-><?= $field; ?>) as $file): {php_close_tag}
                              {php_open_tag} if (!empty($file)): {php_close_tag}
                                {php_open_tag} if (is_image($file)): {php_close_tag}
                                <a class="fancybox" rel="group" href="{php_open_tag_echo} BASE_URL . 'uploads/<?= $table_name; ?>/' . $file; {php_close_tag}">
                                  <img src="{php_open_tag_echo} BASE_URL . 'uploads/<?= $table_name; ?>/' . $file; {php_close_tag}" class="image-responsive" alt="image <?= $table_name; ?>" title="<?= $field; ?> <?= $table_name; ?>" width="40px">
                                </a>
                                {php_open_tag} else: {php_close_tag}
                                  <a href="{php_open_tag_echo} BASE_URL . 'administrator/file/download/<?= $table_name; ?>/' . $file; {php_close_tag}">
                                   <img src="{php_open_tag_echo} get_icon_file($file); {php_close_tag}" class="image-responsive image-icon" alt="image <?= $table_name; ?>" title="<?= $field; ?> {php_open_tag_echo} $file; {php_close_tag}" width="40px"> 
                                 </a>
                                {php_open_tag} endif; {php_close_tag}
                              {php_open_tag} endif; {php_close_tag}
                              {php_open_tag} endforeach; {php_close_tag}
                           </td>
                           <?php } else { 
                            ?><td>
                              {php_open_tag} if (!empty($<?= $table_name; ?>-><?= $field; ?>)): {php_close_tag}
                                {php_open_tag} if (is_image($<?= $table_name; ?>-><?= $field; ?>)): {php_close_tag}
                                <a class="fancybox" rel="group" href="{php_open_tag_echo} BASE_URL . 'uploads/<?= $table_name; ?>/' . $<?= $table_name; ?>-><?= $field;?>; {php_close_tag}">
                                  <img src="{php_open_tag_echo} BASE_URL . 'uploads/<?= $table_name; ?>/' . $<?= $table_name; ?>-><?= $field;?>; {php_close_tag}" class="image-responsive" alt="image <?= $table_name; ?>" title="<?= $field; ?> <?= $table_name; ?>" width="40px">
                                </a>
                                {php_open_tag} else: {php_close_tag}
                                  <a href="{php_open_tag_echo} BASE_URL . 'administrator/file/download/<?= $table_name; ?>/' . $<?= $table_name; ?>-><?= $field;?>; {php_close_tag}">
                                   <img src="{php_open_tag_echo} get_icon_file($<?= $table_name; ?>-><?= $field; ?>); {php_close_tag}" class="image-responsive image-icon" alt="image <?= $table_name; ?>" title="<?= $field; ?> {php_open_tag_echo} $<?= $table_name; ?>-><?= $field; ?>; {php_close_tag}" width="40px"> 
                                 </a>
                                {php_open_tag} endif; {php_close_tag}
                              {php_open_tag} endif; {php_close_tag}
                           </td>
                           <?php } ?> 
                           <?php endforeach; 
                           ?><td width="200">
                              <?php if ($this->input->post('read')) { ?>{php_open_tag} is_allowed('<?= $table_name; ?>_view', function() use ($<?= $table_name; ?>){{php_close_tag}
                              <a href="{php_open_tag_echo} site_url('administrator/<?= $table_name; ?>/view/' . ${table_name}->{primary_key}); {php_close_tag}" class="label-default"><i class="fa fa-newspaper-o"></i> {php_open_tag_echo} cclang('view_button'); {php_close_tag}
                              {php_open_tag} }) {php_close_tag}
                              <?php } ?><?php if ($this->input->post('update')) { ?>{php_open_tag} is_allowed('<?= $table_name; ?>_update', function() use ($<?= $table_name; ?>){{php_close_tag}
                              <a href="{php_open_tag_echo} site_url('administrator/<?= $table_name; ?>/edit/' . ${table_name}->{primary_key}); {php_close_tag}" class="label-default"><i class="fa fa-edit "></i> {php_open_tag_echo} cclang('update_button'); {php_close_tag}</a>
                              {php_open_tag} }) {php_close_tag}
                              <?php } ?>{php_open_tag} is_allowed('<?= $table_name; ?>_delete', function() use ($<?= $table_name; ?>){{php_close_tag}
                              <a href="javascript:void(0);" data-href="{php_open_tag_echo} site_url('administrator/<?= $table_name; ?>/delete/' . ${table_name}->{primary_key}); {php_close_tag}" class="label-default remove-data"><i class="fa fa-close"></i> {php_open_tag_echo} cclang('remove_button'); {php_close_tag}</a>
                               {php_open_tag} }) {php_close_tag}
                           </td>
                        </tr>
                      {php_open_tag} endforeach; {php_close_tag}
                      {php_open_tag} if ($<?= $table_name; ?>_counts == 0) :{php_close_tag}
                         <tr>
                           <td colspan="100">
                           <?= ucwords($subject); ?> data is not available
                           </td>
                         </tr>
                      {php_open_tag} endif; {php_close_tag}
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
                        {php_open_tag_echo} $pagination; {php_close_tag}
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
      var serialize_bulk = $('#form_<?= $table_name; ?>').serialize();

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
               document.location.href = BASE_URL + '/administrator/<?= $table_name; ?>/delete?' + serialize_bulk;      
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
      url: BASE_AJAX + "<?= $uc_controller_name ?>/ajaxList",
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