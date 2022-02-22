<div class="row">
    <div class="col-sm-4">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Akun</h3>
            </div>
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <td><strong>No REG </strong></td>
                    <td><?= $informasi->no_registrasi ?></td>
                </tr>
                <tr>
                    <td><strong>Nama Mahasiswa</strong></td>
                    <td><?= $informasi->nama_lengkap ?></td>
                </tr>
                <tr>
                    <td><strong>Gender</strong></td>
                    <td><?= $informasi->jenis_kelamin ?></td>
                </tr>
                <tr>
                    <td><strong>NIK </strong></td>
                    <td><?= $informasi->no_ktp ?></td>
                </tr>
                <tr>
                    <td><strong>Tempat Lahir </strong></td>
                    <td><?= $informasi->tempat_lahir ?></td>
                </tr>
                <tr>
                    <td><strong>Program Studi </strong></td>
                    <td><label for="" class="badge bg-green"><?= $informasi->program_studi ?></label></td>
                </tr>

                <tr>
                    <td><strong>No. Handphone </strong></td>
                    <td><label for="" class="badge badge-success"><?= $informasi->no_hp ?></label></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-8">
      <?php if ($success == 'Y'): ?>
          <div class="box box-solid">
            <div class="box-header bg-purple">
                



            </div>
            <div class="box-body">
                <div class="text-center">
                    <h1 style="font-size : 150px; color: #00a65a;"><i class="fa fa-check" aria-hidden="true"></i></h1>
                    <h3>Selamat Anda Telah Menyelesaikan Tes</h3>
                    <p>Anda telah selesai melaksanakan ujian penerimaan mahasiswa baru <br>
                        <strong>Sekolah Pascasarjana Universitas Ibn Khaldun Bogor</strong>
                        <br><strong>TAHUN AKADEMIK 2020/2021</strong>                                        
                    </p>

                    <br>
                    <br>
                    <p>
                        <strong>Info Selanjutnya akan di umumkan oleh panitia penerimaan mahasiswa baru</strong>
                    </p>
                </div>
               
            </div>
        </div>
      <?php else: ?>
        <div class="box box-solid">
            <div class="box-header bg-purple">
                <h3 class="box-title">Pemberitahuan</h3>
            </div>
            <div class="box-body">
                <p><strong>PERATURAN UJIAN</strong>
                    <ol>
                        <li>Mohon untuk membaca <strong>Panduan</strong> terlebih dahulu</li>
                        <li>
                            selama ujian berlangsung, mahasiswa wajib mengerjakan sendiri tanpa bantuan orang lain serta dilarang mengakses internet
                        </li>

                        <li>
                            ujian tulis dilaksanakan selama 30 menit, dan sistem aplikasi ujian akan menutup secara otomatis jika sudah mencapai waktunya. harap dimaksimalkan waktu ujian
                        </li>
                    </ol>
                </p>
                
                <?php if ($success != 'Y'): ?>
                    <p>Untuk memulai ujian masuk silahkan klik tombol di bawah ini</p> 
                    <div class="center">
                        <button id="btncek" type="button" data-key="<?= $encrypted_id ?>" data-id="<?= $ujian->id ?>" href="<?= base_url('kelas/').$informasi->prodiID; ?>" class="btn btn-flat btn-lg btn-success">Mulai Ujian</button>
                    </div>
                <?php endif ?>
                        
               
            </div>
        </div>
         
        <div class="box box-solid">
            <div class="box-header bg-orange">
                <h3 class="box-title">PANDUAN UJIAN</h3>
            </div>
            <div class="box-body">
                <p><strong>Berikut beberapa hal yang perlu anda ketahui sebelum menekan tombol mulai</strong></p>
                    <ol>
                       <li>Bacalah Soal dengan teliti</li>
                        <li>Gunanakn browser google chrome, Mozila Firefox untuk PC atau laptop dan chrome untuk ponsel</li>
                        <li><h4><strong>Untuk saat ini sistem belum Support pada perangkat Iphone & Macbook</strong></h4></li>
                        <li>Timer waktu akan berjalan otomatis dan terdapat pada bilah kanan dengan tanda berwarna merah</li>
                        <li>Jika pada soal terdapat sebuah gambar, anda bisa mengklik gambar tersebut untuk memperbesar gambar</li>
                        <li>Jika jawaban berupa gambar, klik kolom putih pada jawaban untuk memilih sebuah jawaban yang di inginkan </li>
                        <li>Gunakan tombol next untuk berpindah soal, back untuk kembali ke soal sebelumnya
                        </li>
                        <li>Tombol ragu di gunakan untuk memilih jawaban ragu (Jika jawaban benar maka akan di nilai jika salah maka bernilai 0). <strong> jika anda tidak mengisi maka jawaban akan dinilai 0</strong></li>
                        <li>
                            Tombol navigasi di gunakan untuk memudahkan pengguna agar bisa melihat soal soal yang di inginkan sesuai dengan urutan soal
                        </li>
                        <li>Perlu di perhatikan jika pada tombol navigasi soal belum berubah warna (hijau di isi), orange (di isi ragu), itu pertanda bahwa soal tersebut belum di isi</li>
                        <li>Untuk mengakhiri sesi jika tidak ada tombol selesai maka klik angka terakhir pada navigasi maka tombol selesai akan muncul</li>
                        <li><strong>Periksa kembali soal saudara jika masih ada waktu tersisa</strong></li>
                        <li><strong>Hasil ujian akan di umumkan kembali oleh staff Prodi masing masing</strong></li>
                        <li><strong style="font-size: 20px">Pastikan pekerjaan anda sudah selesai dengan meng-klik tombol SELESAI, karna anda tidak bisa login kembali</strong></li>
                        <li><strong>Tombol selesai ada pada akhir soal, maka dari itu saudara harus mengklik soal terakhir untuk mengakhiri sesi</strong></li>
                    </ol>
               
            </div>
        </div>
      <?php endif ?>
        
    </div>
</div>

<script>
$(document).ready(function () {

    $('#btncek').on('click', function () {
        var idUjian = $(this).data('id');
        var token = $(this).data('id');
        var key = $(this).data('key');
        console.log(token)
        $.ajax({
            url: BASE_URL + 'kelas/cektoken/',
            type: 'POST',
            data: {
                id_ujian: idUjian,
                token: token
            },
            cache: false,
            success: function (result) {
                if(result.status){
                    
                   
                    location.href = BASE_URL + 'kelas/ujian/?key=' + key;
                }
            }
        });
    });

    var time = $('.countdown');
    if (time.length) {
        countdown(time.data('time'));
    }
});
</script>