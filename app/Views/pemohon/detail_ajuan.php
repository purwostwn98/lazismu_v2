<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<?php
$bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
?>

<div class="page-content container">
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-sm-center">
        <h1 class="page-title text-primary-d2">
            Detail Ajuan
        </h1>
    </div>

    <!-- Data Ajaun -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">Data Ajuan Bantuan</h6>
            <?php if ($ajuan['edit_ajuan'] == 'Open') { ?>
                <a href="/pemohon/halaman_edit_ajuan" class="btn btn-warning waves-effect waves-light">
                    <i class="fa fa-edit text-110 mr-1"></i> Edit Ajuan
                </a>
            <?php } ?>
        </div>
        <div class="card-body">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Jenis Bantuan</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['jenis_ajuan']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Program Bantuan</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <b><?= $ajuan['nama_kategori']; ?></b><br>
                    <?= $ajuan['nama_program']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Nilai yang diajukan</b>
                    </label>
                </div>
                <div class="col-md-8">
                    Rp <?= number_format((float)$ajuan['nilai_diajukan'], 0, ',', '.'); ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Deskripsi Ajuan (Keperluan)</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['deskripsi_ajuan']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Tgl. Ajuan</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['tgl_diajukan']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>File Formulir</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <a href="<?= base_url(); ?>/file_formulir/<?= $ajuan['file_formulir']; ?>" class="btn btn-success btn-sm btn-icon-split mb-2" target="_blank">
                        <span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text"> Lihat</span>
                    </a>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>File Proposal</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <a href="<?= base_url(); ?>/file_proposal/<?= $ajuan['file_proposal']; ?>" class="btn btn-success btn-sm btn-icon-split mb-2" target="_blank">
                        <span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text"> Lihat</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Lembaga (Jika Lembaga) -->
    <?php if ($ajuan['jenis_ajuan'] == 'Lembaga') { ?>
        <div class="card shadow mb-4">
            <div class="card-header d-sm-flex align-items-center justify-content-between bgc-info py-3">
                <h6 class="m-0 font-weight-bold text-white">Data Lembaga</h6>
            </div>
            <div class="card-body">
                <div class="row bg-white darker">
                    <div class="col-md-4">
                        <label for="">
                            <b>Nama Lembaga</b>
                        </label>
                    </div>
                    <div class="col-md-8">
                        <?= $ajuan['nama_lembaga']; ?>
                    </div>
                </div>
                <hr class="m-0 p-1">
                <div class="row bg-white darker">
                    <div class="col-md-4">
                        <label for="">
                            <b>Alamat Lembaga</b>
                        </label>
                    </div>
                    <div class="col-md-8">
                        <?= $ajuan['alamat_lembaga']; ?>
                    </div>
                </div>
                <hr class="m-0 p-1">
                <div class="row bg-white darker">
                    <div class="col-md-4">
                        <label for="">
                            <b>No. Lembaga</b>
                        </label>
                    </div>
                    <div class="col-md-8">
                        <?= $ajuan['nomor_lembaga']; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Status Ajuan -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-info py-3">
            <h6 class="m-0 font-weight-bold text-white">Status Ajuan</h6>
            <span class="bg-warning text-white p-1">
                <?= $ajuan['keterangan_status']; ?>
            </span>
        </div>
        <div class="card-body" style="font-size: 13px;">
            <div class="row">
                <div class="col-12">
                    <table id="simple-table" class="table table-bordered table-bordered-x table-hover text-dark-m2">
                        <thead class="text-dark-m3 bgc-grey-l4">
                            <tr>
                                <th>Status</th>
                                <th><i class="far fa-clock text-110 text-success-d1"></i> Tanggal</th>
                                <th class="d-none d-sm-table-cell">Catatan</th>
                                <th class='d-none d-sm-table-cell'>Oleh</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($array_log as $key => $log) : ?>
                                <tr class="bgc-h-default-l3 d-style">
                                    <td><a href='#' class='text-blue-d2'><?= $log[0]; ?></a></td>
                                    <?php if (($log[5] == 2) || ($log[5] == 4)) { ?>
                                        <td>Agenda : Bulan <?= $bulan[(int)$log[4][0]]; ?> minggu ke <?= $log[4][1]; ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <?php
                                            $waktu = explode(' ', $log['1']);
                                            $tgl = explode('-', $waktu[0])
                                            ?>
                                            <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0] ?>
                                        </td>
                                    <?php } ?>
                                    <td class='d-none d-sm-table-cell'>
                                        <?php if (($log[5] == 7) || ($log[5] == 8)) { ?>
                                            Nilai yang disetujui : <b>Rp <?= number_format((float)$ajuan['nilai_disetujui'], 0, ',', '.'); ?></b><br>
                                        <?php } ?>
                                        <?= $log[2]; ?>
                                    </td>
                                    <td class='d-none d-sm-table-cell'><?= $log[3]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.col -->
            </div>
        </div>
    </div>

    <!-- Berita Acara -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-secondary py-3">
            <h6 class="m-0 font-weight-bold text-white">Berita Acara</h6>
        </div>
        <div class="card-body" style="font-size: 13px;">
            <div class="row">
                <div class="col-12">
                    <table id="simple-table" class="table table-bordered table-bordered-x table-hover text-dark-m2">
                        <thead class="text-dark-m3 bgc-grey-l4">
                            <tr>
                                <th>No</th>
                                <th>Berita Acara</th>
                                <th>Nama PJ</th>
                                <th class="d-none d-sm-table-cell">Tanggal dibuat</th>
                                <th class="d-none d-sm-table-cell">Tanggal penyerahan</th>
                                <th class='d-none d-sm-table-cell'>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($berita_acara != "") { ?>
                                <?php foreach ($berita_acara as $n => $st) { ?>
                                    <tr>
                                        <td><?= $n + 1; ?></td>
                                        <td class="d-none d-sm-table-cell">Surat Tugas <?= $n + 1; ?></td>
                                        <td><?= $st['yang_bertandatangan']; ?></td>
                                        <td>
                                            <?php
                                            $waktu = explode(' ', $st['ba_created_at']);
                                            $tgl = explode('-', $waktu[0]);
                                            ?>
                                            <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $tgl2 = explode('-', $st['tanggal_penyerahan']);
                                            ?>
                                            <?= $tgl2[2] . ' ' . $bulan[(int)$tgl2[1]] . ' ' . $tgl2[0] ?>
                                        </td>
                                        <td class='d-none d-sm-table-cell'>
                                            <a href="/admin/lihat_berita_acara/<?= $st['id_berita_acara']; ?>/<?= $st['nomor_ajuan']; ?>" class="btn btn-xs btn-info"><i class="fa fa-eye text-110 align-text-bottom mr-1"></i> Lihat</a>
                                            <?php if ($st['file_berita_acara'] != "") { ?>
                                                <a href="<?= base_url(); ?>/file_berita_acara/<?= $st['file_berita_acara']; ?>" class="btn btn-xs btn-success" target="_blank"><i class="fa fa-file text-110 align-text-bottom mr-1"></i> Download Bukti</a>
                                            <?php } ?>

                                        </td>
                                    </tr>
                            <?php }
                            } else {
                                echo "belum ada surat tugas";
                            } ?>
                        </tbody>
                    </table>
                </div><!-- /.col -->
            </div>
        </div>
    </div>

    <!-- Laporan Pertanggungjawaban (LPJ) -->
    <!-- <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-danger py-3">
            <h6 class="m-0 font-weight-bold text-white">Laporan Pertanggungjawaban (LPJ)</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <p><i>Template Laporan LPJ dapat didownload di <a target="_blank" href="<?= base_url(); ?>/template_doc/contohlpj.docx" class="px-1 btn-primary">sini</a></i></p>
                    <p><i>Template kwitansi dapat didownload di <a target="_blank" href="<?= base_url(); ?>/template_doc/KWITANSI.docx" class="px-1 btn-primary">sini</a></i></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <label for=""><strong>Status</strong></label>
                </div>
                <div class="col-sm-5">
                    <div class="form-group has-danger">
                        <span style="border-radius: 5px;" class="p-1 bgc-danger text-white">ditolak</span>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for=""><strong>Catatan untuk pemohon</strong></label>
                </div>
                <div class="col-sm-8">
                    <div class="form-group has-danger">
                        <span> Foto dokumentasi tidak menunjukkan kegiatan, mohon diganti dan diupload kembali</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <label for=""><strong>Unggah LPJ</strong></label>
                </div>
                <div class="col-sm-5">
                    <div class="form-group has-danger">
                        <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_formulir" name="file_formulir">
                        <p class="text-danger text-sm error_formulir"><i></i></p>
                    </div>
                </div>
                <div class="col-sm-3"><button class="btn btn-primary">Unggah</button></div>
            </div>
            <div class="row">
                <div class="col-4">
                    <strong>LPJ yang telah diunggah:</strong>
                </div>
                <ul>
                    <li><a href="#">diunggah tanggal 21 Desember 2023 - 13:00 WIB</a></li>
                </ul>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <label for=""><strong>Unggah Kwitansi</strong></label>
                </div>
                <div class="col-sm-5">
                    <div class="form-group has-danger">
                        <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_formulir" name="file_formulir">
                        <p class="text-danger text-sm error_formulir"><i></i></p>
                    </div>
                </div>
                <div class="col-sm-3"><button class="btn btn-primary">Unggah</button></div>
            </div>
            <div class="row">
                <div class="col-4">
                    <strong>Kwitansi yang telah diunggah:</strong>
                </div>
                <ul>
                    <li><a href="#">diunggah tanggal 21 Desember 2023 - 13:27 WIB</a></li>
                </ul>
            </div>
        </div>
    </div> -->

    <!-- <div class="row mb-2">
        <div class="col text-center">
            <a href="/pemohon/cetakResume" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa fa-file-pdf"></i>
                </span>
                <span class="text">Cetak Resume</span>
            </a>
        </div>
    </div> -->
</div>

<?= $this->endSection(); ?>