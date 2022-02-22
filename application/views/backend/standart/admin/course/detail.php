<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-sm-4">
              <a href="<?= site_url('admin/group/create/').$this->uri->segment(4) ?>" class="btn btn-sm btn-info btn-flat " id="add">Tambah data</a>
              
              <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>

              <a href="<?= site_url('admin/group/') ?>" class="btn btn-sm btn-success btn-flat " id="add">Kembali</a>
              <div class="pull-right">
                 <!--  <button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Delete</button> -->
              </div>
            </div>
            <div class="form-group col-sm-4 text-center">
                <h3><strong><?php 
                foreach ($prodi as $row) {
                  echo $row->program_studi." - ". $row->jenjang;
                }
                ?></strong></h3>
            </div>
            <div class="col-sm-4 pull-right">
              <div class="row ">
                <div class="col-md-12">
                     <div class="col-sm-6 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select bulk" name="bulk"  placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete">Delete</option>
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
        <!-- /.box-header -->
        <div class="box-body">
        <?= form_open('admin/soal/delete', array('id' => 'form_user')); ?>
        <div class="table-responsive">
            <table id="soal" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="50" class="text-center">
                            <input class="select_all" type="checkbox">
                        </th>
                        <th width="25">No.</th>
                        <th width="100">Title</th>
                        <th>Jumlah Soal</th>
                        <th>Waktu Pengerjaan</th>
                        <th>Jenis Soal</th>
                        <th  class="text-center">Aksi</th>
                        
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th width="50" class="text-center">
                            <input class="select_all" type="checkbox">
                        </th>
                        <th width="25">No.</th>
                        <th width="50">Title</th>
                        <th>Jumlah Soal</th>
                        <th>Waktu Pengerjaan</th>
                        <th>Jenis Soal</th>
                        <th  class="text-center">Aksi</th>
                        

                    </tr>
                </tfoot>
            </table>
        </div>
        <?= form_close() ?>
        <div class="box-footer clearfix">
          <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select bulk" name="bulk"  placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete">Delete</option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat apply"  name="apply"  value="Apply" title="">Apply</button>
                     </div>
                  </div>
                 
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                       
                     </div>
                  </div>
               </div>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<div class="modal fade " tabindex="-1" role="dialog" id="modalIcon">
  <div class="modal-dialog full-width " role="document">
    <div class="modal-content">
     <div class="modal-header" style="background-color:#03904e; color:#fff; ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title text-center">Tambah Soal</h3>
      </div>
      <div class="modal-body form">
        <form class="form form-horizontal" method="post" enctype="multipart/form-data" id="form">
          <input type="hidden" name="id">
            <div class="form-group ">
                <label for="label" class="col-sm-2 control-label">Program Studi</label>
                <div class="col-sm-10">
                  <select id="prodi_filter" class="form-control select2" style="width:100% !important">
                    <option value="all">Semua Program Studi</option>
                    <?php foreach ($prodi_data as $m) :?>
                      <option value="<?=$m->id?>"><?=$m->program_studi?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>
          
            <div class="table-responsive">
                <table id="bank_soal" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">
                                <input class="select_all" type="checkbox">
                            </th>
                            <th width="25">No.</th>
                            <th>Program Studi</th>
                            <th>Soal (Pertanyaan)</th>
                            <th>Bobot</th>
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="50" class="text-center">
                                <input class="select_all" type="checkbox">
                            </th>
                            <th width="25">No.</th>
                            <th>Program Studi</th>
                            <th>Soal (Pertanyaan)</th>
                            <th>Bobot</th>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        
            
        
        </form>
      </div>
      <div class="modal-footer">

          <div class="message">

          </div>
          <span class="loading loading-hide"><img src="<?= base_url('assets'); ?>/img/loading-spin-primary.svg"> <i>Loading, Saving data</i></span>
          <button type="submit" class="btn btn-flat btn-primary btn_save btn_action" id="simpan" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Save</button>
          <button type="submit" class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="simpan" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Save and Go to The List</button>
          <button type="button" data-dismiss="modal" class="btn btn-flat btn-default " id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script >
  var table;
  $(document).ready(function() {
  //ajaxcsrf();


  $(document).on('click', '.add_soal', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('#modalIcon').modal('show');
  });


  $('#prodi_filter').on('change', function(){
    let id_prodi = $(this).val();
    let src = '<?=base_url()?>admin/group/ajax';
    let url;


    if(id_prodi !== 'all'){
      let src2 = src + '/' + id_prodi;
      url = $(this).prop('checked') === true ? src : src2;
    }else{
      url = src;
    }

    table.ajax.url(url).load();
  });

 

  
  // SOAL
  table = $("#soal").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#soal_filter input")
        .off(".DT")
        .on("keyup.DT", function(e) {
          api.search(this.value).draw();
        });
    },
    dom:
      "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
      {
        extend: "copy",
        exportOptions: { columns: [2, 3] }
      },
      {
        extend: "print",
        exportOptions: { columns: [2, 3] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [2, 3] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [2, 3] }
      }
    ],
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: BASE_URL + "admin/group/detail_ajax/" + "<?= $this->uri->segment(4)?>",
      type: "POST"
      //data: csrf
    },
    columns: [
      
      {
        data: "id_prodi",
        orderable: false,
        searchable: false
      },
      {
        data: "id_prodi",
        orderable: false,
        searchable: false
      },
      { data: "title_ujian" },
      { data: "total_soal" ,
        orderable: false,
        searchable: false,
        render : function(data, type, row, meta) {
          return `<span class='badge bg-green'>${data}</span>`;
        }
      },
      { data: "waktu_pengerjaan" ,
        orderable: false,
        searchable: false,},
      { data: "jenis" ,
        orderable: false,
        searchable: false,
        render : function(data, type, row, meta) {
          return `<span class='badge bg-green'>${data}</span>`;
        }
      },

    ],
    columnDefs: [
    
      {
        targets: 0,
        data: "id_prodi",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                  <input name="delete_id[]" class="check" value="${data}" type="checkbox">
                </div>`;
        }
      },
      {
        searchable: false,
        targets: 6,
        data: "id_group",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                                <a href="${BASE_URL}admin/group/add_soal/${data}"  class="btn btn-xs btn-success ">
                                    <i class="fa fa-plus"></i> Tambah Soal
                                </a>
                                <button type="button" class="btn btn-xs btn-danger delete" data-id="${data}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </div>`;
        }
      }
    ],
    order: [[4, "dsc"]],
    rowId: function(a) {
      return a;
    },
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(1)", row).html(index);
    }
  });

  table
    .buttons()
    .container()
    .appendTo("#group_wrapper .col-md-6:eq(0)");

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

   $('.apply').click(function() {

        var bulk = $('.bulk');

        var serialize_bulk = $('#form_user').serializeArray();
        console.log(serialize_bulk)
        if (bulk.val() == 'delete') {
             swal({
             title: "Anda Yakin ?",
             text: "data yang terpilih akan di hapus dan tidak bisadi rstore ulang !",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "Ya, Hapus !",
             cancelButtonText: "Tidak, Kembali !",
             closeOnConfirm: true,
             closeOnCancel: true
         },
                 function(isConfirm) {
                     if (isConfirm) {
                       $.ajax({
                            url :'<?= base_url()?>admin/soal/delete',
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

        } 
        else if (bulk.val() == '') {
            swal({
                title: "Upss",
                text: "Pilih salah satu aksi masal terlebih dahulu !",
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

    }); /*end appliy click*/

  $("#soal tbody").on("click", "tr .check", function() {
    var check = $("#soal tbody tr .check").length;
    var checked = $("#soal tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });

  $(document).on('click', '.delete', function(){
       var delete_id = $(this).attr('data-id');
        swal({
                title: "Anda Yakin?",
                text: "data yang di hapus tidak bisa di restore!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus !",
                cancelButtonText: "Tidak !",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                   $.ajax({
                        url :'<?= base_url()?>admin/group/delete',
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


  
});



</script>