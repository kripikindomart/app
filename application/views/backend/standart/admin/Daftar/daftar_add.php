<link rel="stylesheet" type="text/css" href="<?= BASE_ASSET; ?>css/crud.css">
<script src="<?= BASE_ASSET.'js/crud.js'; ?>" ></script>
<?php $this->load->view('backend/standart/fine_upload'); ?>

<section class="content-header">
   <h1>
    Daftar Ujian
      <small></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class=""> <a href="<?= base_url('admin/form_template') ?>">daftar</a></li>
      <li class="active">add</li>
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
                  <!-- Add the bg color to the header using any of the bg- classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">
                     <a class="btn btn-flat btn-success" title="Kembali" href="<?= site_url('admin/form_template'); ?>"><i class="fa fa-reply" ></i> Kembali</a>                     
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET.'/img/add2.png'; ?>" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Pendaftaran</h3>
                     <h5 class="widget-user-desc">Ujian<i class="label bg-yellow"></i></h5>
                  </div>

                 <?= form_open('', [
                    'name'    => 'form_user', 
                    'class'   => 'form-horizontal', 
                    'id'      => 'form_user', 
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST'
                  ]); 

                  ?>
                  <div class="form-group ">
                        <label for="username" class="col-sm-2 control-label">Ujian <i class="required">*</i></label>

                        <div class="col-sm-8">
                          <select  class="form-control chosen chosen-select-deselect" name="seminar" id="seminar" data-placeholder="Select" >
                                    <option value=""></option>
                                    <?php foreach ($option as $row): ?>
                                    	<option value="<?= $row->nama_template ?>"><?= ucwords($row->nama_template) ?></option>
                                    <?php endforeach ?>
                                    
                                </select>
                          <small class="info help-block">*Title untuk judul form</small>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="table-wrapper">
	                       <table class="table table-responsive table table-bordered table-striped" id="tbl_posts" style="width: 90% !important; margin: 0 auto;">
	                       		<thead>
	                       			<tr>
	                       				<td>Persyaratan</td>
	                       				<td>#</td>
	                       				<td>Penanggung Jawab</td>
	                       			</tr>
	                       		</thead>
	                       		<tbody id="tbl_posts_body">
	                       			
	                       		</tbody>
	                       </table>
						
                  		 </div>

                    </div>
                    <div class="message">
                      
                    </div>

                    <div class="row-fluid col-md-7">
                        <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Save</button>
                        <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Save and Go to The List</a>
                        <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</a>
                        <span class="loading loading-hide"><img src="<?= BASE_ASSET ?>img/loading-spin-primary.svg"> <i>Loading, Saving data</i></span>
                     </div>

                  <?= form_close(); ?>
                  
                  <div style="display:none;">
						    <table id="sample_table">
						      <tr>
						      	<td><span class="sn"></span>.</td>
               					<td>
               						
               						<select name="kategori[]"  class="kategori form-control ">
               							<option value="0">-Pilih kategori-</option>
               							<?php foreach ($kat_komponen as $row): ?>
               							<option value="<?= $row->id ?>"><?= $row->kategori ?></option>
               							<?php endforeach ?>
               						</select>
               						<br>
               						<p id="data_komponen" class="">
               							
               						</p>
               					</td>
               					<td>
               						<select name="pejabat[]" id="pejabat" class="form-control  pejabat_komponen pejabat_add" >
               							
               						</select>
               						
               					</td>
               					<td>
               						<button type="button" class="btn btn-flat btn-danger delete-record" >
			                       	-
			                       </button>
               					</td>
               				</tr>
						     </tr>
						   </table>

						 </div>
						 <br>
						   <br>
						   <br>
						   <br>
               </div>
               
               <!-- /.widget-user -->

            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>

</section>
<!-- Page script -->
<script>
	let lineNo = 1;
  $(document).ready(function() {
  	//Helper function to keep table row from collapsing when being sorted
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    };

    function chosenupdate() {
    	$('.chosen').prop('disabled', false).trigger("liszt:updated");
    }

    $(document).on('change', '#seminar', function(event) {
    	event.preventDefault();
    	/* Act on the event */
    	var	seminar = $(this).val()
    	$('#tbl_posts_body tr').remove()
    	$.ajax({
    		url: '<?= base_url('admin/daftar/getUjian') ?>',
    		type: 'post',
    		dataType: 'json',
    		data: {seminar: seminar},
    	})
    	.done(function(res) {
    		var i = 0;	
    		$.each(res.data_komponen, function(index, val) {
    			var jenis = '';
    			if (val.jenis =='upload') {
    				jenis = '<input type="file" class="form-control">';
    			} else {
    				jenis = '';
    			}
    			$('#tbl_posts tbody').append('<tr>'+
    				'<td><strong>'+val.kategori+'</strong>'+
    				'<div class="list">'+val.komponen+'</div>'+
    				'</td>'+
    				'<td width="20%">'+jenis+'<br><br><span class="badge bg-red">Belum di verifikasi</span></td>'+
    			'</td>'+
    			'<td><span>'+val.jabatan+'</span><br><br><br><br><br><span><strong>'+val.nama+'</strong></span>'+
	             '</td>'+
    			'</tr>'
    			

    			);
    			})

    		$('#tbl_posts tbody').append('<tr>'+
    				'<td>Mengetahui,<br>'+res.data_ujian.jabatan+'</span><br><br><br><span class="badge bg-red">Menunggu Verifikasi</span><br><br><span><strong>'+res.data_ujian.nama+'</td>'+
    				'<td colspan="2"></td>'+
    			'</tr>');
    		var el = $('.list');
    		$(el).each(function(key, val) {
			    var values = $(val).html().split(',');
			    $(val).html('<ul>' + $.map(values, function(v) { 
			      return '<li>' + v + '</li>';
			    }).join('') + '</ul>');
			});
    		// $.each(res.data_komponen.komponen, function(index, val) {
    		// 	 $('#tbl_posts tbody').append('<tr>'+
    		// 	'<td><strong>'+index+'</strong>'+
    		// 	'<ul><li>'+res.data_komponen.komponen[index][i]+'</li></ul>'+

    		// 	'</td>'+
    		// 	'<td width="20%"><span class="badge bg-green">Telah di verifikasi</span></td>'+
    		// 	'</td>'+
    		// 	'<td><span>'+res.data_komponen.jabatan+'</span><br><br><br><br><br><span><strong>'+res.data_komponen.nama+'</strong></span>'+
	     //         '</td>'+
    		// 	'</tr>');

    		// 	 i++;
    		// });
    		
    		
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	
    });
 
    jQuery(document).delegate('.add_row', 'click', function(e) {
	     e.preventDefault();  

	     // var clone_content = $('#tbl_posts_body tr').clone(true);
	     // console.log(clone_content);

	     // var parent = jQuery('#tbl_posts_body tr').last();
	     // clone_content.clone(true).insertAfter(parent); 
     	//  $('#tbl_posts_body tr:last select').chosen();


	     $('.pejabat_add').attr('disabled')  
	     var content = jQuery('#sample_table tr'),
	     size = jQuery('#tbl_posts >tbody >tr').length + 1,
	     element = null,    
	     element = content.clone();
	     element.attr('id', 'rec-'+size);
	     element.find('.delete-record').attr('data-id', size);
	     element.find('.kategori').attr('id','kategori-'+ size);
	     element.find('#data_komponen').attr('id','data_komponen-'+ size);
	     element.find('#pejabat').attr('id','pejabat-'+ size);
	     element.find('.kategori').attr('data-id', size);
	     element.find('.pejabat_komponen').attr('data-id', size);
	     element.appendTo('#tbl_posts_body');
	     element.find('.sn').html(size);
	      $('#kategori-'+ size).addClass('chosen chosen-select');
	      $('#pejabat-'+ size).addClass('chosen chosen-select');
	      $('#kategori-'+ size).chosen();
	      $('#pejabat-'+ size).chosen();
      
   });

    jQuery(document).delegate('.delete-record', 'click', function(e) {
	     e.preventDefault();    
	     var didConfirm = confirm("Are you sure You want to delete");
	     if (didConfirm == true) {
	      var id = jQuery(this).attr('data-id');
	      var targetDiv = jQuery(this).attr('targetDiv');
	      jQuery('#rec-' + id).remove();
	      
	    //regnerate index number on table
	    $('#tbl_posts_body tr').each(function(index) {
	      //alert(index);
	      $(this).find('span.sn').html(index+1);
	    });
	    return true;
	  } else {
	    return false;
	  }
	});

     	
     	
        // markup = "<tr><td>""</td></tr>";
        // tableBody = $("table tbody");
        // tableBody.append(markup);
        // lineNo++;
    //});


    $(document).on('change', '.kategori', function(event) {
    	event.preventDefault();
    	$('.pejabat_komponen').removeAttr('disabled')
    	var data_id = jQuery(this).attr('data-id');
    	if (typeof data_id !== typeof undefined && data_id !== false) {
    		var id = $(this).val()
    		$.ajax({
	    		url: '<?= base_url('admin/form_template/getKomponen') ?>',
	    		type: 'post',
	    		dataType: 'json',
	    		data: {id: id},
	    		success : function(res) {
	    			if (res.success == true) {
	    				var pejabat = res.komponen.pejabat_id
	    				$.ajax({
	    					url: '<?= base_url('admin/form_template/get_option') ?>',
	    					type: 'POST',
	    					dataType: 'JSON',
	    					data: {pejabat: pejabat},
	    					beforeSend: function(){ 
							   $('#pejabat-'+data_id).empty(); 
							  },
	    					success : function(res){
	    						$('#pejabat-'+data_id).append(res.message)
	    						$('#pejabat-'+data_id).trigger("chosen:updated");
       							 $('#pejabat-'+data_id).trigger("liszt:updated");
	    					}
	    					
	    				})
	    				
	    				$('#data_komponen-'+data_id).html(res.data)
	    			} else {
	    				var pejabat = '';
	    				$.ajax({
	    					url: '<?= base_url('admin/form_template/get_option') ?>',
	    					type: 'POST',
	    					dataType: 'JSON',
	    					data: {pejabat: pejabat},
	    					beforeSend: function(){ 
							   $('#pejabat-'+data_id).empty(); 
							  },
	    					success : function(res){
	    						$('#pejabat-'+data_id).append(res.message)
	    						$('#pejabat-'+data_id).trigger("chosen:updated");
       							 $('#pejabat-'+data_id).trigger("liszt:updated");
	    					}
	    				})
	    				$('#data_komponen-'+data_id).html(res.data)
	    			}
	    		}
	    	})
    	} else {
    		/* Act on the event */
	    	var id = $(this).val()
	    	$.ajax({
	    		url: '<?= base_url('admin/form_template/getKomponen') ?>',
	    		type: 'post',
	    		dataType: 'json',
	    		data: {id: id},
	    		success : function(res) {
	    			if (res.success == true) {
	    				var pejabat = res.komponen.pejabat_id

	    				$.ajax({
	    					url: '<?= base_url('admin/form_template/get_option') ?>',
	    					type: 'POST',
	    					dataType: 'JSON',
	    					data: {pejabat: pejabat},
	    					beforeSend: function(){ 
							   $("#pejabat").empty(); 
							  },
	    					success : function(res){
	    						$('#pejabat').append(res.message)
	    						$("#pejabat").trigger("chosen:updated");
       							 $("#pejabat").trigger("liszt:updated");
	    					}
	    				})
	    				
	    				$('#data_komponen').html(res.data)
	    			} else {
	    				var pejabat = '';
	    				$.ajax({
	    					url: '<?= base_url('admin/form_template/get_option') ?>',
	    					type: 'POST',
	    					dataType: 'JSON',
	    					data: {pejabat: pejabat},
	    					beforeSend: function(){ 
							   $("#pejabat").empty(); 
							  },
	    					success : function(res){
	    						$('#pejabat').append(res.message)
	    						$("#pejabat").trigger("chosen:updated");
       							 $("#pejabat").trigger("liszt:updated");
	    					}
	    				})
	    				$('#data_komponen').html(res.data)
	    			}
	    		}
	    	})
    	}
    });

    $(document).on('change', '.pejabat_komponen', function(event) {
    	event.preventDefault();
    	/* Act on the event */
    	var data_id = jQuery(this).attr('data-id');
    	if (typeof data_id !== typeof undefined && data_id !== false) {
    		  var komponen_id = $('#kategori-'+data_id).val();
		       var pejabat_id = $('#pejabat-'+data_id).val();
		       if (komponen_id !== 0) {
		  			$.ajax({
		  				url: '<?= base_url('admin/form_template/setPejabatKomponen') ?>',
		  				type: 'post',
		  				dataType: 'json',
		  				data: {komponen_id: komponen_id, pejabat_id : pejabat_id},
		  				success : function(res){
		  					 toastr['success'](res.message);
		  				}
		  			})
		       }
    	} else {
    		var komponen_id = $('.kategori').val();
		       var pejabat_id = $(this).val();
		       if (komponen_id !== 0) {
		  			$.ajax({
		  				url: '<?= base_url('admin/form_template/setPejabatKomponen') ?>',
		  				type: 'post',
		  				dataType: 'json',
		  				data: {komponen_id: komponen_id, pejabat_id : pejabat_id},
		  				success : function(res){
		  					
		                  toastr['success'](res.message);
		  				}
		  			})
		       }
    	}
     

    });	

    //Renumber table rows
    function renumber_table(tableID) {
        $(tableID + " tr").each(function() {
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority').val(count);
        });
    }
  	
    $('#btn_cancel').click(function() {
        swal({
                title: "Are you sure?",
                text: "the data that you have created will be in the exhaust!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes!",
                cancelButtonText: "No!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location.href = BASE_URL + 'admin/form_template';
                }
            });

        return false;
    }); //end btn cancel/

    $('.btn_save').click(function() {
        $('.message').fadeOut();

        var form_user = $('#form_user');
        var data_post = form_user.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({
            name: 'save_type',
            value: save_type
        });

        $('.loading').show();

        $.ajax({
        	url: '<?= base_url('admin/form_template/add_save') ?>',
        	type: 'post',
        	dataType: 'json',
        	data: data_post,
        	success : function(res) {
        		if (res.success == true) {
        			if (res.data == false) {
        				window.location.href = BASE_URL + 'admin/form_template';
        			} else {
        				$('.message').printMessage({message : res.message});
            	 		$('.message').fadeIn();
        			}
        		}
        		 
        	}
        })
        
        

      
    }); //end btn save/

    $('#user_avatar_galery').fineUploader({

        template: 'qq-template-gallery',
        request: {
            endpoint: BASE_URL + '/admin/users/upload_avatar_file',
            params: {
                '<?= $this->security->get_csrf_token_name(); ?>': '<?=   $this->security->get_csrf_hash(); ?>'
            }
        },
        deleteFile: {
            enabled: true,
            endpoint: BASE_URL + '/admin/users/delete_avatar_file'
        },
        thumbnails: {
            placeholders: {
                waitingPath: BASE_ASSET  + 'lib/fine-upload/placeholders/waiting-generic.png',
                notAvailablePath: BASE_ASSET  + 'lib/fine-upload/placeholders/not_available-generic.png'
            }
        },
        multiple: false,
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
        },
        showMessage: function(msg) {
            toastr['error'](msg);
        },
        callbacks: {
            onComplete: function(id, name) {
                var uuid = $('#user_avatar_galery').fineUploader('getUuid', id);
                $('#user_avatar_uuid').val(uuid);
                $('#user_avatar_name').val(name);
            },
            onSubmit: function(id, name) {
                var uuid = $('#user_avatar_uuid').val();
                $.get(BASE_URL + 'admin/users/delete_avatar_file/' + uuid);

            }
        }
    }); //end image galey/
}); //end doc ready/
</script>
