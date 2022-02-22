var table;

$(document).ready(function() {


    

    $(document).on('change', 'input.switch-button', function(event) {
    	event.preventDefault();
    	/* Act on the event */
    	var status = 'disabled';
        var id = $(this).attr('data-user-id');
        var data = [];

        if ($(this).prop('checked')) {
            status = 'enabled';
        }

        data.push({
            name: 'status',
            value: status
        });
        data.push({
            name: 'id',
            value: id
        });
     

        $.ajax({
                url: BASE_URL + '/admin/users/set_status',
                type: 'POST',
                dataType: 'JSON',
                data: data,
            })
            .done(function(data) {
                if (data.success) {
                    toastr['success'](data.message);
                } else {
                    toastr['warning'](data.message);
                }

            })
            .fail(function() {
                toastr['error']('Error update status');
            });
    });


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
      url: BASE_AJAX + "users/ajaxList",
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