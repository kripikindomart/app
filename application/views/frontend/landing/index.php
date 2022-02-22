<div class="row">
    <div class="col-sm-4">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Masukan No Pendaftaran anda di sini</h3>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg"></p>
                <div id="infoMessage" class="text-center"></div>
                        
                    <!-- /ERROR HERE -->
                 <?= form_open('auth/landing_login', [
                    'name'    => 'form_login', 
                    'id'      => 'form_login', 
                    'method'  => 'POST'
                  ]); ?>
                  <div class="form-group has-feedback ">
                    <?php echo form_input(array(
                                'name' => 'username',
                                'type' => 'text',
                                'id' => 'username',
                                'placeholder' => 'NO PENDAFTARAN',
                                'autofocus' => 'autofocus',
                                'class' => 'form-control',
                                'autocomplete'=>'off')); ?>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
                  
                  <div class="row">
                    
                    <!-- /.col -->
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                  </div>
                <?= form_close(); ?>

                <!-- /.social-auth-links -->

                
              </div>
        </div>
    </div>
    <div class="col-sm-8">
      
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
                            ujian tulis dilaksanakan selama 30 Menit, dan sistem aplikasi ujian akan menutup secara otomatis jika sudah mencapai waktunya. harap dimaksimalkan waktu ujian
                        </li>
                    </ol>
                </p>
                
                <div class="center">

                        
                  
                    
                </div>
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
        
    </div>
</div>

<script>
$(document).ready(function () {

    $('form#form_login').on('submit', function(e){
      console.log($(this).serialize());
        e.preventDefault();
        e.stopImmediatePropagation();

        var infobox = $('#infoMessage');
        infobox.addClass('callout callout-info').text('Checking...');

        var btnsubmit = $('#submit');
        btnsubmit.attr('disabled', 'disabled').val('Wait...');

        $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){
            infobox.removeAttr('class').text('');
            btnsubmit.removeAttr('disabled').val('Login');
            if(data.status == true){
                var go = BASE_URL + data.url;
                window.location.href = go;
            }else{
                if(data.status == false){
                  
                    if (data.invalid != null) {
                      
                      infobox.addClass('callout callout-warning text-center').html(data.error);
                      infobox.fadeIn();
                      
                    } else if(data.failed != null){
                        infobox.addClass('callout callout-danger text-center').text(data.failed);
                    }
                }
                    
                }
            }
        });
    });
});
</script>