<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Data Siswa<small>Data</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Siswa</li>
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
                        <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
                        <?php is_allowed('Student_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Student']); ?>  (Ctrl+a)" href="<?=  site_url('admin/Student/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Student']); ?></a>
                        <?php }) ?>
                        <?php is_allowed('Student_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Student" href="<?= site_url('admin/Student/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('Student_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Student" href="<?= site_url('admin/Student/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Data Siswa</h3>
                     <h5 class="widget-user-desc">  Data Siswa  <i class="label bg-yellow">  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_student" id="form_student" action="<?= base_url('admin/Student/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <td width="5px">
                            <div class="text-center">
                            <input type="checkbox" class="checkbox icheckbox_flat-green toltip select_all " id="check_all" name="check_all" title="Mark All">
                            </div>
                           </td>
                           <td>#</td>
                           <th>Program Studi</th>
                           <th>Kelas Id</th>
                           <th>Subkelas Id</th>
                           <th>Total Semester</th>
                           <th>Code</th>
                           <th>Nik</th>
                           <th>Nama</th>
                           <th>Email</th>
                           <th>Status Mahasiswa</th>
                           <th>Status Penerimaan</th>
                           <th>Jenis Kelamin</th>
                           <th>Tempat Lahir</th>
                           <th>Tanggal Lahir</th>
                           <th>Alamat</th>
                           <th>Kode Pos</th>
                           <th>No Hp</th>
                           <th>Pendidikan Terakhir</th>
                           <th>Asal Universitas S1</th>
                           <th>Asal Universitas S2</th>
                           <th>Asal Universitas S3</th>
                           <th>Gelar Terakhir</th>
                           <th>Pekerjaan</th>
                           <th>Alamat Pekerjaan</th>
                           <th>Nama Ibu</th>
                           <th>Photo</th>
                           <th>Judul Thesis</th>
                           <th>Status Akun</th>
                           <th>Daftar Tgl</th>
                           <th>Diterima Tgl</th>
                           <th>Created At</th>
                           <th>Updated At</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_Student">
                     
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
                            <option <?= $this->input->get('f') == 'program_studi_id' ? 'selected' :''; ?> value="program_studi_id">Program Studi Id</option>
                           <option <?= $this->input->get('f') == 'kelas_id' ? 'selected' :''; ?> value="kelas_id">Kelas Id</option>
                           <option <?= $this->input->get('f') == 'subkelas_id' ? 'selected' :''; ?> value="subkelas_id">Subkelas Id</option>
                           <option <?= $this->input->get('f') == 'total_semester' ? 'selected' :''; ?> value="total_semester">Total Semester</option>
                           <option <?= $this->input->get('f') == 'code' ? 'selected' :''; ?> value="code">Code</option>
                           <option <?= $this->input->get('f') == 'nik' ? 'selected' :''; ?> value="nik">Nik</option>
                           <option <?= $this->input->get('f') == 'nama' ? 'selected' :''; ?> value="nama">Nama</option>
                           <option <?= $this->input->get('f') == 'email' ? 'selected' :''; ?> value="email">Email</option>
                           <option <?= $this->input->get('f') == 'status_mahasiswa' ? 'selected' :''; ?> value="status_mahasiswa">Status Mahasiswa</option>
                           <option <?= $this->input->get('f') == 'status_penerimaan' ? 'selected' :''; ?> value="status_penerimaan">Status Penerimaan</option>
                           <option <?= $this->input->get('f') == 'jenis_kelamin' ? 'selected' :''; ?> value="jenis_kelamin">Jenis Kelamin</option>
                           <option <?= $this->input->get('f') == 'tempat_lahir' ? 'selected' :''; ?> value="tempat_lahir">Tempat Lahir</option>
                           <option <?= $this->input->get('f') == 'tanggal_lahir' ? 'selected' :''; ?> value="tanggal_lahir">Tanggal Lahir</option>
                           <option <?= $this->input->get('f') == 'alamat' ? 'selected' :''; ?> value="alamat">Alamat</option>
                           <option <?= $this->input->get('f') == 'kode_pos' ? 'selected' :''; ?> value="kode_pos">Kode Pos</option>
                           <option <?= $this->input->get('f') == 'no_hp' ? 'selected' :''; ?> value="no_hp">No Hp</option>
                           <option <?= $this->input->get('f') == 'pendidikan_terakhir' ? 'selected' :''; ?> value="pendidikan_terakhir">Pendidikan Terakhir</option>
                           <option <?= $this->input->get('f') == 'asal_universitas_s1' ? 'selected' :''; ?> value="asal_universitas_s1">Asal Universitas S1</option>
                           <option <?= $this->input->get('f') == 'asal_universitas_s2' ? 'selected' :''; ?> value="asal_universitas_s2">Asal Universitas S2</option>
                           <option <?= $this->input->get('f') == 'asal_universitas_s3' ? 'selected' :''; ?> value="asal_universitas_s3">Asal Universitas S3</option>
                           <option <?= $this->input->get('f') == 'gelar_terakhir' ? 'selected' :''; ?> value="gelar_terakhir">Gelar Terakhir</option>
                           <option <?= $this->input->get('f') == 'pekerjaan' ? 'selected' :''; ?> value="pekerjaan">Pekerjaan</option>
                           <option <?= $this->input->get('f') == 'alamat_pekerjaan' ? 'selected' :''; ?> value="alamat_pekerjaan">Alamat Pekerjaan</option>
                           <option <?= $this->input->get('f') == 'nama_ibu' ? 'selected' :''; ?> value="nama_ibu">Nama Ibu</option>
                           <option <?= $this->input->get('f') == 'photo' ? 'selected' :''; ?> value="photo">Photo</option>
                           <option <?= $this->input->get('f') == 'judul_thesis' ? 'selected' :''; ?> value="judul_thesis">Judul Thesis</option>
                           <option <?= $this->input->get('f') == 'status_akun' ? 'selected' :''; ?> value="status_akun">Status Akun</option>
                           <option <?= $this->input->get('f') == 'daftar_tgl' ? 'selected' :''; ?> value="daftar_tgl">Daftar Tgl</option>
                           <option <?= $this->input->get('f') == 'diterima_tgl' ? 'selected' :''; ?> value="diterima_tgl">Diterima Tgl</option>
                           <option <?= $this->input->get('f') == 'created_at' ? 'selected' :''; ?> value="created_at">Created At</option>
                           <option <?= $this->input->get('f') == 'updated_at' ? 'selected' :''; ?> value="updated_at">Updated At</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/students');?>" title="<?= cclang('reset_filter'); ?>">
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
      var serialize_bulk = $('#form_students').serialize();

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
               document.location.href = BASE_URL + '/administrator/students/delete?' + serialize_bulk;      
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
      url: BASE_AJAX + "student/getDatatable",
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
                 name : "program_studis.nama",
                 data: "program_studis_nama",
                 orderable: true,
                 searchable: true
             },
            
                    
                      {
                          name : "students.kelas_id",
                          data: "kelas_id",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.subkelas_id",
                          data: "subkelas_id",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.total_semester",
                          data: "total_semester",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.code",
                          data: "code",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.nik",
                          data: "nik",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.nama",
                          data: "nama",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.email",
                          data: "email",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.status_mahasiswa",
                          data: "status_mahasiswa",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.status_penerimaan",
                          data: "status_penerimaan",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.jenis_kelamin",
                          data: "jenis_kelamin",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.tempat_lahir",
                          data: "tempat_lahir",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.tanggal_lahir",
                          data: "tanggal_lahir",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.alamat",
                          data: "alamat",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.kode_pos",
                          data: "kode_pos",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.no_hp",
                          data: "no_hp",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.pendidikan_terakhir",
                          data: "pendidikan_terakhir",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.asal_universitas_s1",
                          data: "asal_universitas_s1",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.asal_universitas_s2",
                          data: "asal_universitas_s2",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.asal_universitas_s3",
                          data: "asal_universitas_s3",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.gelar_terakhir",
                          data: "gelar_terakhir",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.pekerjaan",
                          data: "pekerjaan",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.alamat_pekerjaan",
                          data: "alamat_pekerjaan",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.nama_ibu",
                          data: "nama_ibu",
                          orderable: true,
                          searchable: true
                      },
     
                      { data: "photo",
                        orderable: false,
                        searchable : false,
                        render : function(data){
                           let files = "";
                           var url = BASE_URL+"uploads/user/"+data;
                         
                           if (url) {
                              files = url;
                           } else {
                              files = BASE_URL+"uploads/user/default2.png";
                           }
                           
                           return '<div class="chip"><a class="fancybox" rel="group" href="'+files+'" onerror="urlExisithref(this);"><img onerror="urlExists(this);"  src="'+files+'" alt="Person" width="50" height="50"></a></div>';
                        }
                     },
                     
                      {
                          name : "students.judul_thesis",
                          data: "judul_thesis",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.status_akun",
                          data: "status_akun",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.daftar_tgl",
                          data: "daftar_tgl",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.diterima_tgl",
                          data: "diterima_tgl",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.created_at",
                          data: "created_at",
                          orderable: true,
                          searchable: true
                      },
           
                      {
                          name : "students.updated_at",
                          data: "updated_at",
                          orderable: true,
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
                  <input name="select_all[]" class="icheckbox_flat-green select_all" value="${data}" type="checkbox">
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

   function urlExists(url){
       url.onerror = "";
       url.src = BASE_URL+"uploads/user/default2.png";
       return true;
   }

   function urlExisithref(url){
       url.onerror = "";
       url.href = BASE_URL+"uploads/user/default2.png";
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
});  
    
});
</script>