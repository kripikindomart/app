<?php


if(time() >= $soal->waktu_habis)
{
   
    redirect('kelas', 'location', 301);
    
}
?>
<div class="row">
        <div class="col-sm-3">
            <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Navigasi Soal</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body text-center" id="tampil_jawaban">
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border bg-orange">
                        <h3 class="box-title">panduan ujian</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body text-justify" >
                        <p><strong>Berikut beberapa hal yang perlu anda ketahui</strong></p>
                        <ul>
                            <li>Bacalah Soal dengan teliti</li>
                            <li>Timer waktu akan berjalan otomatis dan terdapat pada bilah kanan dengan tanda berwarna merah</li>
                            <li>Jika pada soal terdapa sebuah gambar, anda bisa mengklik gambar tersebut untuk memperbesar gambar</li>
                            <li>Jika jawaban berupa gambar, klik kolom putih pada jawaban untuk memilih sebuah jawaban yang di inginkan </li>
                            <li>Gunakan tombol next untuk berpindah soal, back untuk kembali ke soal sebelumnya
                            </li>
                            <li>Tombol ragu di gunakan untuk memilih jawaban ragu (Jika jawaban benar maka akan di nilai jika salah maka bernilai 0). <strong> jika anda tidak mengisi maka jawaban akan dinilai 0</strong></li>
                            <li>
                                Tombol navigasi di gunakan untuk memudahkan pengguna agar bisa melihat soal soal yang di inginkan sesuai dengan urutan soal
                            </li>
                            <li>Perlu di perhatikan jika pada tombol navigasi soal belum berubah warna (hijau di isi), orange (di isi ragu), itu pertanda bahwa soal tersebut belum di isi</li>
                            <li>Untuk mengakhiri sesi jika tidak ada tombol selesai maka klik angka terakhir pada navigasi maka tombol selesai akan muncul</li>
                            <li><strong>Periksa kembali soal sodara jika masih ada waktu tersisa</strong></li>
                        </ul>
                    </div>    
                    </div>
                </div>
            </div>    
        </div>
        <div class="col-sm-9">
            <?=form_open('', array('id'=>'ujian'), array('id'=> $id_tes));?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><span class="badge bg-blue">Soal #<span id="soalke"></span> </span></h3>
                    <div class="box-tools pull-right">
                        <span class="badge bg-red">Sisa Waktu <span class="sisawaktu" data-time="<?=$soal->tgl_selesai?>"></span></span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <?=$html?>
                </div>
                <div class="box-footer text-center">
                    <a class="action back btn btn-info" rel="0" onclick="return back();"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    <a class="ragu_ragu btn btn-warning" rel="1" onclick="return tidak_jawab();">Ragu-ragu</a>
                    <a class="action next btn btn-info" rel="2" onclick="return next();"><i class="glyphicon glyphicon-chevron-right"></i> Next</a>
                    <a class="selesai action submit btn btn-danger" onclick="return simpan_akhir();"><i class="glyphicon glyphicon-stop"></i> Selesai</a>
                    <input type="hidden" name="jml_soal" id="jml_soal" value="<?=$no; ?>">
                </div>
            </div>
            <?=form_close();?>
        </div>    
    </div>
</div>

<script type="text/javascript">
    var base_url        = "<?=base_url(); ?>";
    var id_tes          = "<?=$id_tes; ?>";
    var widget          = $(".step");
    var total_widget    = widget.length;

    var time = $('.countdown');
    if (time.length) {
        countdown(time.data('time'));
    } 
</script>

<script src="<?=base_url()?>assets/js/sheet.js"></script>