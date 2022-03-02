var table;

$(document).ready(function() {


  $('.dataTables_filter').on('change', function(){
	    let id = $(this).val();
	    let src = BASE_AJAX+'komponen/setup_list_ajax';
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
    // Optional function  

	
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
      url: BASE_AJAX + "komponen/setup_list_ajax",
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
      { data: "kategori" },
      { data: "aktif" },
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

function urlExists(url){
    url.onerror = "";
    url.src = BASE_URL+"uploads/user/default2.png";;
    return true;
}

function urlExisithref(url){
    url.onerror = "";
    url.href = BASE_URL+"uploads/user/default2.png";;
    return true;
}


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
                            url :BASE_URL+'admin/komponen/delete_setup',
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
                url :'<?= base_url()?>admin/komponen/create_user',
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