var table;

$(document).ready(function() {


  $('#prodi_filter').on('change', function(){
    let id_prodi = $(this).val();
    let src = BASE_URL+'admin/mahasiswa/ajax';
    let url;


    if(id_prodi !== 'all'){
      let src2 = src + '/' + id_prodi;
      url = $(this).prop('checked') === true ? src : src2;
    }else{
      url = src;
    }

    table.ajax.url(url).load();
  });


  table = $("#mahasiswa").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#mahasiswa_filter input")
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
      url: BASE_URL + "admin/mahasiswa/ajax",
      type: "POST"
      //data: csrf
    },
    columns: [
      {
        data: "id",
        orderable: false,
        searchable: false
      },
      { data: "npm" },
      { data: "nama_lengkap" },
      { data: "no_hp" },
      { data: "program_studi" },
    ],
    columnDefs: [
      {
        searchable: false,
        targets: 5,
        data: {
          id: "id",
          ada: "ada"
        },
        render: function(data, type, row, meta) {
          let btn;
          if (data.ada > 0) {
            btn = "";
          } else {
            btn = `<button title="Buat user berdasarkan mahasiswa" data-id="${data.id}" type="button" class="btn btn-xs btn-primary btn-aktif">
                <i class="fa fa-user-plus"></i>
              </button>`;
          }
          return `<div class="text-center">
                  <a title="Edit data terpilih" class="btn btn-xs btn-warning" href="${BASE_URL}admin/mahasiswa/edit/${data.id}">
                    <i class="fa fa-pencil"></i>
                  </a>
                  ${btn}
                  <button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger delete" data-id="${data.id}" >
                    <i class="fa fa-trash"></i>
                  </button>
                </div>
                `;
        }
      },
      {
        targets: 6,
        data: "id",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                  <input name="delete_id[]" class="flat-red check" value="${data}" type="checkbox">
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
      $("td:eq(0)", row).html(index);
    }
  });

  table
  .buttons()
  .container()
  .appendTo("#mahasiswa_wrapper .col-md-6:eq(0)");

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
                            url :BASE_URL+'admin/mahasiswa/delete',
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

        } else if (bulk.val() == 'add'){
          $.ajax({
                url :BASE_URL+'admin/mahasiswa/create_user',
                type :'POST',
                dataType: 'json',
                data: serialize_bulk, 
            })

             .done(function(data){
              console.log(data);
                if (data.success == true) {
                  reload_ajax();
                    swal({
                      title: "Berhasil !",
                      text: data.message,
                      type: "success",
                  });

                 return;
                } else {
                   reload_ajax();
                    toastr['error'](data.message);   
                    return;
                }
            }) 

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

  $("#mahasiswa tbody").on("click", "tr .check", function() {
    var check = $("#mahasiswa tbody tr .check").length;
    var checked = $("#mahasiswa tbody tr .check:checked").length;
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
                        url :BASE_URL+'admin/mahasiswa/delete',
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


  $("#mahasiswa").on("click", ".btn-aktif", function() {
    let delete_id = $(this).attr("data-id");

    $.ajax({
      url: BASE_URL + "admin/mahasiswa/create_user",
      type :'POST',
      dataType: 'json',
      data: {delete_id:delete_id}, 
      success: function(response) {
        if (response.success) {
          var title = response.success ? "Berhasil" : "Gagal";
          var type = response.success ? "success" : "error";
          swal({
              title: title,
              text: response.message,
              type: type,
          });
        }
        reload_ajax();
      }
    });
  });

});