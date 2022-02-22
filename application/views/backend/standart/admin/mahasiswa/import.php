<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Import data Mahasiswa</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <ul class="alert alert-info" style="padding-left: 40px">
                <li>Silahkan import data dari excel, menggunakan format yang sudah disediakan</li>
                <li>Data tidak boleh ada yang kosong, harus terisi semua.</li>
                <li>Untuk data ProgramStudi, hanya bisa diisi menggunakan ID ProgramStudi. <a data-toggle="modal" href="#kelasId" style="text-decoration:none" class="btn btn-xs btn-primary">Lihat ID</a>.</li>
            </ul>
            <div class="text-center">
                <a href="<?= base_url('uploads/import/format/format_mahasiswa.xlsx') ?>" class="btn-default btn">Download Format</a>
            </div>
            <br>
            <div class="row">
                <?= form_open_multipart('admin/mahasiswa/preview'); ?>
                <label for="file" class="col-sm-offset-1 col-sm-3 text-right">Pilih File</label>
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="file" name="upload_file">
                    </div>
                </div>
                <div class="col-sm-3">
                    <button name="preview" type="submit" class="btn btn-sm btn-success">Preview</button>
                </div>
                <?= form_close(); ?>
                <div class="col-sm-6 col-sm-offset-3">
                    <?php if (isset($_POST['preview'])) : ?>
                        <br>
                        <h4>Preview Data</h4>
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>No Registrasi</td>
                                    <td>Nama Mahasiswa</td>
                                    <td>No Hp</td>
                                    <td>ID Program Studi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $status = true;
                                    if (empty($import)) {
                                        echo '<tr><td colspan="2" class="text-center">Data kosong! pastikan anda menggunakan format yang telah disediakan.</td></tr>';
                                    } else {
                                        $no = 1;
                                        foreach ($import as $data) :
                                            ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td class="<?= $data['no_registrasi'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['no_registrasi'] == null ? 'BELUM DIISI' : $data['no_registrasi']; ?>
                                            </td>
                                            <td class="<?= $data['nama_lengkap'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['nama_lengkap'] == null ? 'BELUM DIISI' : $data['nama_lengkap'];; ?>
                                            </td>
                                           
                                            <td class="<?= $data['no_hp'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['no_hp'] == null ? 'BELUM DIISI' : $data['no_hp'];; ?>
                                            </td>
                                            <td class="<?= $data['id_master_prodi'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['id_master_prodi'] == null ? 'BELUM DIISI' : get_data($data['id_master_prodi'], 'id', 'master_prodi', 'program_studi'); ?>
                                            </td>
                                        </tr>
                                <?php
                                            if ($data['no_registrasi'] == null || $data['nama_lengkap'] == null ||  $data['no_hp'] == null ) {
                                                $status = false;
                                            }
                                        endforeach;
                                    }
                                    ?>
                            </tbody>
                        </table>
                        <?php if ($status) : ?>

                            <?= form_open('admin/mahasiswa/do_import', null, ['data' => json_encode($import)]); ?>
                            <button type='submit' class='btn btn-block btn-flat bg-purple'>Import</button>
                            <?= form_close(); ?>

                        <?php endif; ?>
                        <br>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="kelasId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Data Program Studi</h4>
            </div>
            <div class="modal-body">
                <table id="kelas" class="table table-bordered table-condensed table-striped" style="width: 100%">
                    <thead>
                        <th>ID</th>
                        <th>Program Studi</th>
                        <th>Jenjang</th>
                    </thead>
                    <tbody>
                        <?php foreach ($content as $k) : ?>
                            <tr>
                                <td><?= $k->id; ?></td>
                                <td><?= $k->program_studi; ?></td>
                                <td><?= $k->jenjang; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let table;
        table = $("#kelas").DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
        });
    });
</script>