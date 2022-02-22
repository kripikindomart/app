<section class="content">

  <div class="row">
      <!-- Left col -->
      <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="row">
              <div class="col-sm-4">
                
                <a href="<?= BASE_URL('admin/enroll') ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Kembali</a>
                <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
                <div class="pull-right">
                   <!--  <button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Delete</button> -->
                </div>
              </div>
              <div class="form-group col-sm-4 text-center">
                  <h4><strong><?= $prodi->program_studi ?></strong></h4>
                  <h5><strong><?php 
                    foreach ($group as $row) {
                      echo $row->title_ujian;
                    }
                    ?></strong></h3>
              </div>
              <div class="col-sm-4 pull-right">
                <div class="row ">
                  <div class="col-md-12">
                       <div class="col-sm-6 padd-left-0 " >
                          
                       </div>
                       <div class="col-sm-2 padd-left-0 ">
                          
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
                          <td width="50" class="text-center">
                              <input class="select_all" type="checkbox">
                          </td>
                          <th width="25">No.</th>
                          <th>Title Soal</th>
                          <th width="150">Soal (Pertanyaan)</th>
                          <th>Jawaban</th>
                          <th>Bobot</th>
                          <th  class="text-center">Aksi</th>
                          
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <td width="50" class="text-center">
                              <input class="select_all" type="checkbox">
                          </td>
                          <th width="25">No.</th>
                          <th>Title Soal</th>
                          <th width="150">Soal (Pertanyaan)</th>
                          <th>Jawaban</th>
                          <th>Bobot</th>
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
                          
                       </div>
                       <div class="col-sm-2 padd-left-0 ">
                      
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
</section>
<script >
  var table;
  $(document).ready(function() {
  //ajaxcsrf();

  $('#prodi_filter').on('change', function(){
    let id_prodi = $(this).val();
    let src = '<?=base_url()?>admin/enroll/detailAjax';
    let url;


    if(id_prodi !== 'all'){
      let src2 = src + '/' + id_prodi;
      url = $(this).prop('checked') === true ? src : src2;
    }else{
      url = src;
    }

    table.ajax.url(url).load();
  });


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
      // {
      //   extend: "copy",
      //   exportOptions: { columns: [1, 2, 3, 4] }
      // },
      // {
      //   extend: "print",
      //   exportOptions: { columns: [1, 2, 3, 4] }
      // },
      // {
      //   extend: "excel",
      //   exportOptions: { columns: [1, 2, 3, 4] }
      // },
      // {
      //   extend: "pdf",
      //   exportOptions: { columns: [1, 2, 3, 4] }
      // }
    ],
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: BASE_URL + "admin/enroll/detailAjax/"+"<?= $this->uri->segment(5)?>",
      type: "POST"
      //data: csrf
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
      { data: "title_soal" },
      { data: "pertanyaan" },
      { data: "jawaban" },
      { data: "bobot" },
    ],
    columnDefs: [
    
      {
        targets: 0,
        data: "id",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                  <input name="delete_id[]" class="check" value="${data}" type="checkbox">
                </div>`;
        }
      },
      {
        searchable: false,
        targets: 6,
        data: "id",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                                <a href="${BASE_URL}admin/soal/detail/${data}" class="btn btn-xs btn-default">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                                
                            </div>`;
        }
      }
    ],
    order: [[1, "dsc"]],
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
    .appendTo("#soal_wrapper .col-md-6:eq(0)");

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
                        url :'<?= base_url()?>admin/soal/delete',
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