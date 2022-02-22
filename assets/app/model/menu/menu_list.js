var table;
$(document).ready(function() {


	$('.dataTables_filter').on('change', function(){
	    let id = $(this).val();
	    let src = '<?=base_url()?>admin/menu/ajaxList';
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
      url: BASE_URL + "admin/group/ajaxList",
      type: "POST",
      //data: csrf,
    },
    columns: [
      {
        data: "id",
        orderable: false,
        searchable: false
      },
      { data: "name" },
      { data: "definition" },
      { data:  {
          id: "id",
          btn_edit: "btn_edit",
          btn_delete:"btn_delete"
        }, 
        orderable: false,
        searchable: false,
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                  ${data.btn_edit}
                  ${data.btn_delete}
                </div>`;
        }

    },

    ],
    columnDefs: [
    //   {
    //     searchable: false,
    //     targets:3,
    //     data: {
    //       id: "id",
    //       btn_edit: "btn_edit",
    //       btn_delete:"btn_delete"
    //     },
    //     render: function(data, type, row, meta) {
    //      let btn_edit;
    //      let btn_delete;
    //       if (data.btn_edit == "") {
    //         btn_edit = "";
    //       } else {
    //         btn_edit = `
				// <a title="Edit data terpilih" class="btn btn-xs btn-warning" href="${BASE_URL}admin/mahasiswa/edit/${data.id}">
	   //          <i class="fa fa-pencil"></i>
	   //        </a>		
    //           `;
    //       }

    //       if (data.btn_delete == "") {
    //         btn_delete = "";
    //       } else {
    //         btn_delete = `
				// <button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger delete" data-id="${data.id}" >
    //                 <i class="fa fa-trash"></i>
    //               </button>		
    //           `;
    //       }

    //       if (btn_delete == "" && btn_edit == "") {
    //       	$(".action").remove();
    //       } else {
    //       	return `<div class="text-center">
    //               ${btn_edit}
    //               ${btn_delete}
    //             </div>
    //             `;
    //       }
          
    //     }
    //   },
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
    order: [[2, "asc"]],
    rowId: function(a) {
      return a;
    },
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(4)", row).html(index);
    }
  });

  table
    .buttons()
    .container()
    .appendTo(".dataTable .col-md-6:eq(0)");
});


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
                            url :'<?= base_url()?>admin/mahasiswa/delete',
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
                url :'<?= base_url()?>admin/mahasiswa/create_user',
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
                    toastr['error'](data.message);   
                    return;
                }
            }) 

          return false;
        }
        else if (bulk.val() == '') {
            swal({
                title: "Opps",
                text: "<?= cclang('please_choose_bulk_action_first') ?>",
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