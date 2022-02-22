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
            <li>File yang di import hanya bisa berupa text dan tidak bisa menyertakan gambar</li>
            <li>Untuk data ProgramStudi, hanya bisa diisi menggunakan ID ProgramStudi. <a data-toggle="modal" href="#kelasId" style="text-decoration:none" class="btn btn-xs btn-primary">Lihat ID</a>.</li>
        </ul>
        <div class="text-center">
            <a href="<?= base_url('uploads/import/format/format_soal_2.xlsx') ?>" class="btn-default btn">Download Format</a>
        </div>
        <br>
        <div class="row">
            <?= form_open_multipart('admin/soal/preview'); ?>
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
                    <table class="table table-bordered " style="width: 100%">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>ID Program Studi</td>
                                <td>PErtanyaan / Soal</td>
                                <td>Pilihan A</td>
                                <td>Pilihan B</td>
                                <td>Pilihan C</td>
                                <td>Pilihan D</td>
                                <td>Pilihan E</td>
                                <td>Jawaban</td>
                                <td>Bobot</td>
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
                                        <td class="<?= $data['id_prodi'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['id_prodi'] == null ? 'BELUM DIISI' : $data['id_prodi']; ?>
                                        </td>
                                        <td class="<?= $data['pertanyaan'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['pertanyaan'] == null ? 'BELUM DIISI' : $data['pertanyaan'];; ?>
                                        </td>
                                        <td class="<?= $data['opsi_a'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_a'] == null ? 'BELUM DIISI' : $data['opsi_a'];; ?>
                                        </td>
                                        <td class="<?= $data['opsi_b'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_b'] == null ? 'BELUM DIISI' : $data['opsi_b'];; ?>
                                        </td>
                                        <td class="<?= $data['opsi_c'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_c'] == null ? 'BELUM DIISI' : $data['opsi_c'];; ?>
                                        </td>
                                        <td class="<?= $data['opsi_d'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_d'] == null ? 'BELUM DIISI' : $data['opsi_d'];; ?>
                                        </td>
                                        <td class="<?= $data['opsi_e'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_e'] == null ? 'BELUM DIISI' : $data['opsi_e'];; ?>
                                        </td>
                                        <td class="<?= $data['jawaban'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['jawaban'] == null ? 'BELUM DIISI' : $data['jawaban'];; ?>
                                        </td>
                                        <td class="<?= $data['bobot'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['bobot'] == null ? 'BELUM DIISI' : $data['bobot'];; ?>
                                        </td>
                                    </tr>
                            <?php
                                        if ($data['id_prodi'] == null || $data['pertanyaan'] == null || $data['jawaban'] == null || $data['bobot'] == null) {
                                            $status = false;
                                        }
                                    endforeach;
                                }
                                ?>
                        </tbody>
                    </table>
                    <?php if ($status) : ?>

                        <?= form_open('admin/soal/do_import', null, ['data' => json_encode($import)]); ?>
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