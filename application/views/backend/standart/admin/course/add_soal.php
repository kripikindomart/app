<section class="content">
  <div class="row">
    <!-- Left col -->
    <div class="col-md-12">
      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-sm-4">
              <a href="<?= site_url('admin/course/') ?>" class="btn btn-sm btn-success btn-flat " id="add">Kembali</a>
              <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
              <div class="pull-right">
                 <!--  <button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Delete</button> -->
              </div>
            </div>
            <div class="form-group col-sm-4 text-center">
                <select id="prodi_filter" class="form-control chosen chosen-select" style="width:100% !important">
                  <option value="all">Semua Soal</option>
                  <?php foreach ($title_soal as $m) :?>
                    <?php $title = ($m->title_soal == null || empty($m->title_soal)) ? 'Tidak ada Title' : $m->title_soal ?>
                    <option value="<?=$title?>"><?=$title?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-4 pull-right">
              <div class="row ">
                <div class="col-md-12">
                     <div class="col-sm-6 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select bulk" name="bulk"  placeholder="Site Email" >
                           <option value="add">Tambah Soal</option>
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
        <?= form_open('admin/group/save_soal_group', array('id' => 'form_user')); ?>
        <input type="hidden" value="<?= $group ?>" name="group_id">
        <div class="table-responsive">
            <table id="soal" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                         <td width="50" class="text-center">
                                <input class="select_all" type="checkbox">
                            </td>
                            <th width="25">No.</th>
                            <th>Title Soal</th>
                            <th>Soal (Pertanyaan)</th>
                            <th>Bobot</th>
                        
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                         <td width="50" class="text-center">
                                <input class="select_all" type="checkbox">
                            </td>
                            <th width="25">No.</th>
                            <th>Title Soal</th>
                            <th>Soal (Pertanyaan)</th>
                            <th>Bobot</th>
                        
                    </tr>
                </tfoot>
            </table>
        </div>
        <?= form_close() ?>
        <div class="box-footer clearfix">
          <!-- /.widget-user -->
              
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
    let src = '<?=base_url()?>admin/course/get_soal';
    let url;


    if(id_prodi !== 'all'){
      let src2 = src+ '/' +'<?= $this->uri->segment(4) ?>' + '/' + id_prodi + '/' ;
      url = $(this).prop('checked') === true ? src : src2;
    }else{
      url = src + '/' + '<?= $this->uri->segment(4) ?>';;
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
      
    ],
    paging: true,
    lengthChange: false,
    searching: false,
    ordering: true,
    info: false,
    autoWidth: true,
    fixedHeader: true,

    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: BASE_URL + "admin/course/get_soal"+"/<?= $this->uri->segment(4) ?>" ,
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
        var form = $('#form_user')[0];
        var data = new FormData(form);
        var serialize_bulk = $('#form_user').serializeArray();
        if (bulk.val() == 'add') {
             swal({
             title: "Anda Yakin ?",
             text: "data yang dipilih akan di pada group soal",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#6455dd",
             confirmButtonText: "Ya, Tambahkan !",
             cancelButtonText: "Tidak, Kembali !",
             closeOnConfirm: true,
             closeOnCancel: true
         },
             function(isConfirm) {
                 if (isConfirm) {
                  location.reload();
                   $.ajax({
                      url :'<?= base_url()?>admin/course/add_soal_group/'+ '<?= $this->uri->segment(4) ?>',
                      type :'POST',
                      dataType: 'json',
                      data: data, 
                      processData:false,
                       contentType:false,
                       cache:false,
                       async:false,
                  })
                   .done(function(res){
                    console.log(res);
                      if (res.success == true) {
                        location.reload();
                        table.ajax.reload(null, false);
                        //reload_ajax();
                          swal({
                            title: "Berhasil !",
                            text: res.message,
                            type: "success",
                        });

                       return;
                      } else {
                          toastr['error'](res.message);   
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
                                location.reload();
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