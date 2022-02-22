<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <a href="<?=base_url('admin/hasilujian')?>" class="btn btn-flat btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                <button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-purple"><i class="fa fa-refresh"></i> Reload</button>
                <div class="pull-right">
                    <a target="_blank" href="<?=base_url()?>admin/hasilujian/cetak_detail/<?=$this->uri->segment(4)?>" class="btn bg-maroon btn-flat btn-sm">
                        <i class="fa fa-print"></i> Print
                    </a>
                    <a target="_blank" href="<?=base_url()?>admin/hasilujian/export/<?=$this->uri->segment(4)?>" class="btn bg-green btn-flat btn-sm">
                        <i class="fa fa-download"></i> Excel
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <table class="table w-100">
                    <tr>
                        <th>Nama Ujian</th>
                        <td><?=$ujian->title_ujian?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Soal</th>
                        <td><?=$ujian->jumlah_soal?></td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td><?=$ujian->waktu_pengerjaan?> Menit</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td><?=strftime('%A, %d %B %Y', strtotime($ujian->tgl_mulai))?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Selasi</th>
                        <td><?=strftime('%A, %d %B %Y', strtotime($ujian->tgl_berakhir))?></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <table class="table w-100">
                    <tr>
                        <th>Program Studi</th>
                        <td><?=$ujian->program_studi?></td>
                    </tr>
                    <tr>
                        <th>Nilai Terendah</th>
                        <td><?=$nilai->min_nilai?></td>
                    </tr>
                    <tr>
                        <th>Nilai Tertinggi</th>
                        <td><?=$nilai->max_nilai?></td>
                    </tr>
                    <tr>
                        <th>Rata-rata Nilai</th>
                        <td><?=$nilai->avg_nilai?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="detail_hasil" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Peserta</th>
                <th>Program Studi</th>
                <th>Jumlah Benar</th>
                <th>Nilai</th>
                <th>Action</th>
            </tr>        
        </thead>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Nama Peserta</th>
                <th>Program Studi</th>
                <th>Jumlah Benar</th>
                <th>Nilai</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table>
    </div>
</div>

<script type="text/javascript">
    var id = '<?=$this->uri->segment(4)?>';
</script>

<script>
    var table;

$(document).ready(function () {

    ajaxcsrf();

    table = $("#detail_hasil").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#detail_hasil_filter input')
                .off('.DT')
                .on('keyup.DT', function (e) {
                    api.search(this.value).draw();
                });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
            "url": BASE_URL + "admin/hasilujian/nilai_perprodi/"+id,
            "type": "POST",
        },
        columns: [
            {
                "data": "no_registrasi",
                "orderable": false,
                "searchable": false
            },
            { "data": 'nama_lengkap' },
            { "data": 'program_studi' },
            { "data": 'jml_benar' },
            { "data": 'nilai' },
        ],
        columnDefs: [
          {
            searchable: false,
            targets: 5,
            data: "id",
            render: function(data, type, row, meta) {
              return `<div class="text-center">
                                    
                                    <button type="button" class="btn btn-xs btn-danger delete" data-id="${data}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>`;
            }
          }
        ],
        order: [
            [4, 'asc']
        ],
        rowId: function (a) {
            return a;
        },
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(6)', row).html(index);
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
                        url :BASE_URL + 'admin/hasilujian/delete',
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