<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<?php
$session = \Config\Services::session();
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
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between">
        <div class="col-auto">
            <h1 class="page-title text-primary-d2">
                Detail Ajuan
            </h1>
        </div>
        <div class="col-auto">
            <input type="hidden" class="csrf_input" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <button onclick="hapus_ajuan(<?= $ajuan['id_ajuan']; ?>);" type="button" class="btn btn-danger btn-sm btn_hapus" data-dismiss="modal"><i class="fa fa-trash"></i> | Hapus Ajuan</button>
        </div>
    </div>

    <!-- //alert  -->
    <div class="row">
        <div class="col-9">
            <?php if ($session->getFlashdata('berhasil')) { ?>
                <div class="alert alert-success" role="alert">
                    <?= $session->getFlashdata('berhasil'); ?>
                </div>
            <?php  } ?>
        </div>
    </div>

    <!-- Biodata Pemohon -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">Data Pemohon</h6>
        </div>
        <div class="card-body">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>NIK</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['nik']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Nama</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['nama_pemohon']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Jenis Kelamin</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['jenis_kelamin']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Tempat Lahir</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['tempat_lahir']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Tanggal Lahir</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['tanggal_lahir']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Alamat</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['alamat_detail']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Agama</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['agama']; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Ajaun -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">Data Ajuan Bantuan</h6>
            <a target="_blank" href="/pemohon/pdf_no_ajuan/<?= $ajuan['nomor_ajuan']; ?>" class="btn btn-sm btn-danger">Cetak Ajuan</a>
        </div>
        <div class="card-body">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Nomor Ajuan</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <strong><?= $ajuan['nomor_ajuan']; ?></strong>
                </div>
            </div>
            <hr class="m-0 p-1">
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
                        <b>Deskripsi Ajuan (Keperluan)</b> | <button onclick="editDeskripsi('<?= $ajuan['id_ajuan']; ?>')" class="btn btn-sm"><i class="fa fa-edit text-warning"></i></button>
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
            <?php if ($ajuan['status_ajuan'] >= 7) { ?>
                <hr class="m-0 p-1">
                <div class="row bg-white darker">
                    <div class="col-md-4">
                        <label for="">
                            <b>Ajuan telah tersalurkan?</b>
                        </label>
                    </div>
                    <div class="col-md-8">
                        <?= $ajuan['status_tersalurkan']; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Form B1/ data mustahik -->
    <?php if ($ajuan['jenis_ajuan'] == 'Individu') { ?>
        <div class="card shadow mb-4">
            <div class="card-header d-sm-flex align-items-center justify-content-between bgc-info py-3">
                <h6 class="m-0 font-weight-bold text-white">Data Calon Mustahik (B1)</h6>
                <?php if (!empty($data_individu)) { ?>
                    <div class="div">
                        <button onclick="editDataIndividu('<?= $data_individu['id_individu']; ?>')" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> | Edit data</button>
                        <a target="_blank" href="/admin/cetakB1individu?ajuan=<?= $ajuan['nomor_ajuan']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-copy"></i> | Cetak B1</a>
                    </div>
                <?php } ?>
            </div>
            <div class="card-body">
                <?php if (!empty($data_individu)) { ?>
                    <div class="data_ind">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Nama Lengkap</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['nama_mustahik']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>NIK</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['nik']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>File NIK</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <a class="btn btn-sm btn-info" target="_blank" href="<?= base_url(); ?>/file_ktp/<?= $data_individu['foto_ktp']; ?>">Lihat</a>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>KK</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['kk']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>File KK</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <a class="btn btn-sm btn-info" target="_blank" href="<?= base_url(); ?>/file_kk/<?= $data_individu['foto_kk']; ?>">Lihat</a>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Jenis Kelamin</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['kelamin_mustahik']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Tempat, Tgl. Lahir</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['tempat_lahir'] . ', ' . $data_individu['tgl_lahir']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Agama</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['agama_mustahik']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Alamat</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['alamat']; ?> <br> <?= $data_individu['nama_kelurahan']; ?>, <?= $data_individu['nama_kecamatan']; ?>, <?= $data_individu['nama_kabupaten']; ?>, <?= $data_individu['nama_provinsi']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Status Pendidikan</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['status_pendidikan']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Status Marital</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['status_marital']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Pekerjaan</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['nama_pekerjaan']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Penghasilan</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['label_penghasilan']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Jumlah Keluarga</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['jml_keluarga']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>No Handphone</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['no_handphone']; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-1">
                        <div class="row bg-white darker">
                            <div class="col-md-4">
                                <label for="">
                                    <b>Email</b>
                                </label>
                            </div>
                            <div class="col-md-8">
                                <?= $data_individu['email']; ?>
                            </div>
                        </div>
                    </div>
                <?php } else {  ?>
                    Belum ada data mustahik (form B1) <br>
                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="loadFormMustahik('<?= $ajuan['nomor_ajuan']; ?>')">
                        Tambahkan data calon mustahik
                    </button>
                    <?php if ($session->getFlashdata('gagal')) { ?>
                        <p class="text-danger text-sm error_nama"><i><?= $session->getFlashdata('gagal'); ?></i></p>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

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

    <!-- Keputusan Akhir -->
    <?= form_open("/admin/simpan_tindakan", ['class' => 'formulir_tindakan']); ?>
    <?= csrf_field(); ?>
    <input type="hidden" name="nomor_ajuan" value="<?= $ajuan['nomor_ajuan']; ?>">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bgc-warning">
            <h6 class="m-0 font-weight-bold text-white">Form Tindakan</h6>
        </div>
        <div class="card-body">
            <div class="row bg-white darker py-1">
                <div class="col-md-4">
                    <label for="">
                        <b>Sifat Bantuan</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <select name="sifat_bantuan" class="form-control" id="form-field-select-1" required>
                        <option value=""> - </option>
                        <option <?= ($ajuan['sifat_bantuan'] == 'Insidental') ? 'selected' : ''; ?> value="Insidental">Insidental</option>
                        <option <?= ($ajuan['sifat_bantuan'] == 'Rutin') ? 'selected' : ''; ?> value="Rutin">Rutin</option>
                    </select>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker py-2">
                <div class="col-md-4">
                    <label for="">
                        <b>Dapat diedit</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <select name="edit_ajuan" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1" id="form-field-select-11" required>
                        <option value="Closed" <?= ($ajuan['edit_ajuan'] == 'Closed') ? 'Selected' : ''; ?>>Closed</option>
                        <option value="Open" <?= ($ajuan['edit_ajuan'] == 'Open') ? 'Selected' : ''; ?>>Open</option>
                    </select>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker py-2">
                <div class="col-md-4">
                    <label for="">
                        <b>Tindakan</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <select name="status_ajuan" onchange="tindakan(this)" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-11" required>
                        <option value="" selected disabled>Pilih tindakan</option>
                        <?php foreach ($status_ajuan as $sts) : ?>
                            <option value="<?= $sts['id_status']; ?>"><?= $sts['keterangan_status']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="form_tindakan">

            </div>
            <!-- Button -->
            <div class="row mb-2 mt-3">
                <div class="col text-right">
                    <a href="/admin/dftr_ajuan_i" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-times"></i>
                        </span>
                        <span class="text"> Batal</span>
                    </a>
                    <button type="submit" role="button" class="btn btn-success btn-icon-split btnConfirm">
                        <span class='icon text-white-50'>
                            <i class='fas fa-save'></i>
                        </span>
                        <span class='text'> Simpan Tindakan</span>
                    </button> &nbsp;
                </div>
            </div>
        </div>
    </div>
    <?= form_close(); ?>

    <!-- Form B3 -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-secondary py-3">
            <h6 class="m-0 font-weight-bold text-white">Form B3</h6>
            <!-- <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#b3Modal"> -->
            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="loadModalB3('<?= $ajuan['nomor_ajuan']; ?>')">
                <i class="fa fa-plus text-110 mr-1"></i> <?= (empty($data_b3)) ? "Isi form B3" : "Edit form B3"; ?>
            </button>
        </div>
        <div class="card-body" style="font-size: 13px;">
            <div class="row">
                <div class="col-12">
                    <table id="simple-table" class="table table-bordered table-bordered-x table-hover text-dark-m2">
                        <thead class="text-dark-m3 bgc-grey-l4">
                            <tr>
                                <th class="text-center">Sumber Dana</th>
                                <th class="text-center">Asnaf/Kategori</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data_b3)) { ?>
                                <tr>
                                    <td>#</td>
                                    <td>Belum ada data B3</td>
                                    <td>-</td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td class="text-center"><?= $data_b3['dana_dari']; ?></td>
                                    <td class="text-center"><?= $data_b3['ket_kategori_penerima']; ?></td>
                                    <td class="text-center"><?= $data_b3['ket_bentuk_penyerahan']; ?></td>
                                </tr>
                            <?php   } ?>
                        </tbody>
                    </table>
                </div><!-- /.col -->
            </div>
        </div>
    </div>

    <!-- Surat Tugas -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-secondary py-3">
            <h6 class="m-0 font-weight-bold text-white">Surat Tugas</h6>
            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus text-110 mr-1"></i> Buat Surat Tugas
            </button>
        </div>
        <div class="card-body" style="font-size: 13px;">
            <div class="row">
                <div class="col-12">
                    <table id="simple-table" class="table table-bordered table-bordered-x table-hover text-dark-m2">
                        <thead class="text-dark-m3 bgc-grey-l4">
                            <tr>
                                <th>No</th>
                                <th>Surat Tugas</th>
                                <th>Nama PJ</th>
                                <th class="d-none d-sm-table-cell">Tanggal Mulai</th>
                                <th class="d-none d-sm-table-cell">Tanggal Selesai</th>
                                <th class='d-none d-sm-table-cell text-center'>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($surat_tugas != "") { ?>
                                <?php foreach ($surat_tugas as $n => $st) { ?>
                                    <tr>
                                        <td><?= $n + 1; ?></td>
                                        <td class="d-none d-sm-table-cell">Surat Tugas <?= $n + 1; ?></td>
                                        <td><?= $st['nama_penanggung_jawab']; ?></td>
                                        <td>
                                            <?php
                                            $tgl = explode('-', $st['tanggal_mulai'])
                                            ?>
                                            <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $tgl2 = explode('-', $st['tanggal_selesai'])
                                            ?>
                                            <?= $tgl2[2] . ' ' . $bulan[(int)$tgl2[1]] . ' ' . $tgl2[0] ?>
                                        </td>
                                        <td class='d-none d-sm-table-cell'>
                                            <a href="/admin/lihat_surat_tugas/<?= $st['id_surat_tugas']; ?>" class="btn btn-xs btn-info"><i class="fa fa-eye text-110 align-text-bottom mr-1"></i> Lihat</a>
                                            <?php if ($st['file_surat_tugas'] != "") { ?>
                                                <a href="<?= base_url(); ?>/file_surat_tugas/<?= $st['file_surat_tugas']; ?>" class="btn btn-xs btn-success" target="_blank"><i class="fa fa-file text-110 align-text-bottom mr-1"></i> Download Bukti</a>
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

    <!-- Berita Acara -->
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-secondary py-3">
            <h6 class="m-0 font-weight-bold text-white">Berita Acara</h6>
            <?php if ($ajuan['status_ajuan'] >= 7) { ?>
                <button type="button" class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-target="#tersalurkanModal">
                    <i class="fa fa-plus text-110 mr-1"></i> Edit Status Tersalurkan
                </button>
            <?php } ?>
            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#beritaacaraModal">
                <i class="fa fa-plus text-110 mr-1"></i> Buat Berita Acara
            </button>
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
                                        <td class="d-none d-sm-table-cell">Berita Acara <?= $n + 1; ?></td>
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
                                            <button onclick="hapusBeritaAcara('<?= $st['id_berita_acara']; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash text-110 align-text-bottom mr-1"></i></button>
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
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bgc-danger py-3">
            <h6 class="m-0 font-weight-bold text-white">Laporan Pertanggungjawaban (LPJ)</h6>
        </div>
        <div class="card-body">
            <?= form_open("/pemohon/do_unggah_dokumentasi", ['class' => 'field_dokumentasi']); ?>
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-sm-4">
                    <label for=""><strong>Unggah Dokumentasi</strong></label>
                </div>
                <div class="col-sm-5">
                    <div class="form-group has-danger">
                        <input type="file" class="form-control col-sm-12 border-left-info animated--grow-in" id="file_dokumentasi" name="file_dokumentasi" required>
                        <p class="text-danger text-sm error_dokumentasi"><i></i></p>
                    </div>
                </div>
                <input type="hidden" name="no_ajuan" id="" value="<?= $ajuan['nomor_ajuan']; ?>">
                <div class="col-sm-3"><button type="submit" class="btn btn-primary btn_unggah_doc">Unggah</button></div>
            </div>
            <?= form_close(); ?>
            <div class="row">
                <div class="col-4">
                    <strong>LPJ yang telah diunggah:</strong>
                </div>
                <ul>
                    <?php foreach ($dokumentasi as $key => $v) { ?>
                        <li>
                            <a href="/file_dokumentasi/<?= $v['nama_file']; ?>" class="<?= ($v['status'] == 'ditolak') ? 'text-danger' : 'text-primary'; ?>" target="_blank">diunggah tanggal <?= $v['created_at']; ?></a>
                            <button onclick="tolakDokumentasi('<?= $v['id_dokumentasi']; ?>')" class="btn btn-sm btn-warning"><i class="fas fa-ban"></i></button> | <button onclick="tbhCtt('<?= $v['id_dokumentasi']; ?>', 'documentation')" class="btn btn-sm btn-info">Tambah Catatan</button>
                            <?php if ($v['catatan'] != "") { ?>
                                <br> <span style="font-size: 12px;">Catatan: <i><?= $v['catatan']; ?></i></span>
                            <?php } ?>
                        </li>
                    <?php  } ?>
                </ul>
            </div>
            <hr>
            <?= form_open("/pemohon/do_unggah_kuitansi", ['class' => 'field_kuitansi']); ?>
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-sm-4">
                    <label for=""><strong>Unggah Kwitansi</strong></label>
                </div>
                <div class="col-sm-5">
                    <div class="form-group has-danger">
                        <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_kuitansi" name="file_kuitansi">
                        <p class="text-danger text-sm error_formulir"><i></i></p>
                    </div>
                </div>
                <input type="hidden" name="no_ajuan" id="" value="<?= $ajuan['nomor_ajuan']; ?>">
                <div class="col-sm-3"><button type="submit" class="btn btn-primary btn_unggah_kuitansi">Unggah</button></div>
            </div>
            <?= form_close(); ?>
            <div class="row">
                <div class="col-4">
                    <strong>Kwitansi yang telah diunggah:</strong>
                </div>
                <ul>
                    <?php foreach ($kuitansi as $key => $v) { ?>
                        <li>
                            <a href="/file_kuitansi/<?= $v['nama']; ?>" class="<?= ($v['status'] == 'ditolak') ? 'text-danger' : 'text-primary'; ?>" target="_blank">diunggah tanggal <?= $v['created_at']; ?></a>
                            <button onclick="tolakKuitansi('<?= $v['id_kuitansi']; ?>')" class="btn btn-sm btn-warning"><i class="fas fa-ban"></i></button> | <button onclick="tbhCtt('<?= $v['id_kuitansi']; ?>', 'nota')" class="btn btn-sm btn-info">Tambah Kuitansi</button>
                            <?php if ($v['catatan'] != "") { ?>
                                <br> <span style="font-size: 12px;">Catatan: <i><?= $v['catatan']; ?></i></span>
                            <?php } ?>
                        </li>
                    <?php  } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal Form Surat Tugas -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Surat Tugas (<?= $ajuan['nomor_ajuan']; ?>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/admin/simpan_surat_tugas", ['class' => 'formulir_surat_tugas']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="nomor_ajuan" id="" value="<?= $ajuan['nomor_ajuan']; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Nama Penanggung Jawab</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="nama_penanggung_jawab" type="text" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Jabatan</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="jabatan" type="text" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Berdasarkan</label>
                    </div>
                    <div class="col-sm-7">
                        <select name="berdasarkan" class="form-control" id="form-field-select-1" required>
                            <option value="" selected disabled></option>
                            <option value="Rapat Pengurus">Rapat Pengurus</option>
                            <option value="Surat/Proposal">Surat/Proposal</option>
                        </select>
                    </div>
                </div>
                <p> Memberikan tugas kepada :</p>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-right pr-0">
                        <label for="id-form-field-1" class="mb-0">Jumlah orang</label>
                    </div>
                    <div class="col-sm-4">
                        <select name="jumlah_delegasi" class="form-control jumlah_delegasi" id="form-field-select-1">
                            <option value="" selected disabled></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        orang
                    </div>
                </div>
                <div class="nama_delegasi">

                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Dengan agenda</label>
                    </div>
                    <div class="col-sm-7">
                        <select name="agenda" class="form-control" id="form-field-select-1" required>
                            <option value="" selected disabled></option>
                            <option value="Survey">Survey</option>
                            <option value="Menyalurkan">Menyalurkan</option>
                            <option value="Monev">Monev</option>
                            <option value="Koordinasi">Koordinasi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <p> Pada hari/tanggal :</p>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Tanggal mulai</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="tanggal_mulai" type="date" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Tanggal selesai</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="tanggal_selesai" type="date" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Tempat/lokasi</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="lokasi" type="text" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn_st">Simpan Surat Tugas</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal Form Berita Acara -->
<div class="modal fade" id="beritaacaraModal" tabindex="-1" role="dialog" aria-labelledby="beritaAcaraModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="beritaAcaraModal">Berita Acara (<?= $ajuan['nomor_ajuan']; ?>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/admin/simpan_berita_acara", ['class' => 'formulir_berita_acara']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="nomor_ajuan" id="no_ajuan" value="<?= $ajuan['nomor_ajuan']; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">yang bertandatangan</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="yang_bertandatangan" type="text" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Tanggal</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="tanggal_penyerahan" type="date" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Tempat/lokasi</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="lokasi_penyerahan" type="text" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Berdasarkan</label>
                    </div>
                    <div class="col-sm-7">
                        <select name="berdasarkan" class="form-control" id="form-field-select-1" required>
                            <option value="" selected disabled></option>
                            <option value="Rapat Pengurus">Rapat Pengurus</option>
                            <option value="Laporan/SPJ">Laporan/SPJ</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Bentuk Penyerahan</label>
                    </div>
                    <div class="col-sm-7">
                        <?php if (empty($data_b3)) { ?>
                            <select name="bentuk_penyerahan" class="form-control bentuk_penyerahan" id="btk_penyerahan">
                                <option value="" selected disabled></option>
                                <?php foreach ($bentuk_bantuan as $bentuk) { ?>
                                    <option value="<?= $bentuk['id_bentuk_penyerahan']; ?>"><?= $bentuk['ket_bentuk_penyerahan']; ?></option>
                                <?php } ?>
                            </select>
                        <?php } else { ?>
                            <select name="__" class="form-control bentuk_penyerahan" id="btk_penyerahan" disabled>
                                <?php foreach ($bentuk_bantuan as $bentuk) { ?>
                                    <option <?= ($data_b3['bentuk_penyerahan'] == $bentuk['id_bentuk_penyerahan']) ? "selected" : ""; ?> value="<?= $bentuk['id_bentuk_penyerahan']; ?>"><?= $bentuk['ket_bentuk_penyerahan']; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="bentuk_penyerahan" id="" value="<?= $data_b3['bentuk_penyerahan']; ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="ket_bentuk">

                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Dana dari</label>
                    </div>
                    <div class="col-sm-7">
                        <?php if (empty($data_b3)) { ?>
                            <select name="dana_dari" class="form-control dana_dari" id="dndr" required>
                                <option value="" selected disabled></option>
                                <option value="Zakat">Zakat</option>
                                <option value="Infaq Umum">Infaq Umum</option>
                                <option value="Amil">Amil</option>
                                <option value="Infaq Terikat">Infaq Terikat</option>
                                <option value="DSKL">DSKL</option>
                            </select>
                        <?php } else { ?>
                            <select name="_" class="form-control dana_dari" id="dndr" required disabled>
                                <option <?= ($data_b3['dana_dari'] == 'Zakat') ? "selected" : ""; ?> value="Zakat">Zakat</option>
                                <option <?= ($data_b3['dana_dari'] == 'Infaq Umum') ? "selected" : ""; ?> value="Infaq Umum">Infaq Umum</option>
                                <option <?= ($data_b3['dana_dari'] == 'Amil') ? "selected" : ""; ?> value="Amil">Amil</option>
                                <option <?= ($data_b3['dana_dari'] == 'Infaq Terikat') ? "selected" : ""; ?> value="Infaq Terikat">Infaq Terikat</option>
                                <option <?= ($data_b3['dana_dari'] == 'DSKL') ? "selected" : ""; ?> value="DSKL">DSKL</option>
                            </select>
                            <input type="hidden" name="dana_dari" id="" value="<?= $data_b3['dana_dari']; ?>">
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Kategori Penerima</label>
                    </div>
                    <div class="col-sm-7 kategori_penerima">
                        <?php if (empty($data_b3)) { ?>
                            <select name="kategori_penerima" class="form-control" id="form-field-select-1" required>
                                <option value="" selected disabled></option>
                                <option value="" selected disabled>Pilih dana dari terlebih dahulu</option>
                            </select>
                        <?php } else { ?>
                            <select name="_" class="form-control" id="form-field-select-1" required disabled>
                                <option value="<?= $data_b3['id_kategori_penerima']; ?>" selected><?= $data_b3['ket_kategori_penerima']; ?></option>
                            </select>
                            <input type="hidden" name="kategori_penerima" id="" value="<?= $data_b3['id_kategori_penerima']; ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">yang menerima</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="yang_menerima" type="text" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn_ba">Simpan Berita Acara</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal Status Tersalurkan -->
<div class="modal fade" id="tersalurkanModal" tabindex="-1" role="dialog" aria-labelledby="tersalurkanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tersalurkanModalLabel">Upload File Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/admin/do_edit_tersalurkan", ['class' => 'formulir_tersalurkan']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="id_ajuan" value="<?= $ajuan['id_ajuan']; ?>">
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Status tersalurkan</label>
                    </div>
                    <div class="col-sm-7">
                        <select name="status_tersalurkan" class="form-control" id="form-field-select-1" required>
                            <option value="" selected disabled> -- </option>
                            <option value="belum">belum</option>
                            <option value="tersalurkan sebagian">Tersalurkan sebagian</option>
                            <option value="tersalurkan semua">Tersalurkan semua</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn_st">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<div class="ctt"></div>
<div class="modal_deskripsi"></div>
<div class="modal_form_mustahik"></div>
<div class="modal_edit_mustahik"></div>
<div class="modal_b3"></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function tindakan(params) {
        $.ajax({
            url: "<?= site_url('dynamic/form_tindakan'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                jenis: params.value
            },
            success: function(response) {
                $('.form_tindakan').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function loadFormMustahik(nomor_ajuan) {
        $.ajax({
            url: "<?= site_url('dynamic/load_modal_mustahik'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                nomor_ajuan: nomor_ajuan
            },
            success: function(response) {
                $('.modal_form_mustahik').html(response.data);
                $('#addMustahikModal').modal("show");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function editDataIndividu(id_individu) {
        $.ajax({
            url: "<?= site_url('dynamic/load_modal_edit_mustahik'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_individu: id_individu
            },
            success: function(response) {
                $('.modal_edit_mustahik').html(response.data);
                $('#editMustahikModal').modal("show");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>


<script>
    $(document).ready(function() {
        var bentuk_penyerahan = $("#btk_penyerahan").val();
        // jika bentuk penyerahan tidak kosong
        if (bentuk_penyerahan != "") {
            $.ajax({
                url: "<?= site_url('dynamic/load_ket_penyerahan'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    bentuk: bentuk_penyerahan
                },
                success: function(response) {
                    console.log(response);
                    $('.ket_bentuk').html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        $('.formulir_tindakan').submit(function(e) {
            e.preventDefault();
            var status = $('.ini_status option:selected').text();
            Swal.fire({
                    title: 'Are you sure?',
                    html: "Anda yakin untuk mengubah status ajuan menjadi <b>" + status + "</b>?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya yakin!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: $(".formulir_tindakan").attr('action'),
                            data: $(".formulir_tindakan").serialize(),
                            dataType: "json",
                            beforeSend: function() {
                                $('.btnConfirm').prop('disabled', true);
                                $('.btnConfirm').html('<i class="fa fa-spin fa-spinner"></i>');
                            },
                            complete: function() {
                                $('.btnConfirm').prop('disabled', false);
                                $('.btnConfirm').html("<span class='icon text-white-50'><i class='fas fa-save'></i></span><span class='text'>Simpan</span>");
                            },
                            success: function(response) {
                                if (response.berhasil) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: response.berhasil.pesan,
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                    // $("input[name='csrf_test_name']").val(response.error.token);
                                }
                                if (response.gagal) {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: response.gagal.pesan,
                                        icon: 'error',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            }
                        });
                        return false;
                    } else {
                        return false;
                    }
                });
        });

        $('.formulir_surat_tugas').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(".formulir_surat_tugas").attr('action'),
                data: $(".formulir_surat_tugas").serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn_st').prop('disabled', true);
                    $('.btn_st').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn_st').prop('disabled', false);
                    $('.btn_st').html("Simpan Surat Tugas");
                },
                success: function(response) {
                    if (response.berhasil) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.berhasil.pesan,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                        // $("input[name='csrf_test_name']").val(response.error.token);
                    }
                    if (response.gagal) {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.gagal.pesan,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        $('.formulir_berita_acara').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(".formulir_berita_acara").attr('action'),
                data: $(".formulir_berita_acara").serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn_ba').prop('disabled', true);
                    $('.btn_ba').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn_ba').prop('disabled', false);
                    $('.btn_ba').html("Simpan Berita Acara");
                },
                success: function(response) {
                    if (response.berhasil) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.berhasil.pesan,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                    if (response.gagal) {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.gagal.pesan,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        $('.formulir_tersalurkan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(".formulir_tersalurkan").attr('action'),
                data: $(".formulir_tersalurkan").serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn_st').prop('disabled', true);
                    $('.btn_st').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn_st').prop('disabled', false);
                    $('.btn_st').html("Simpan");
                },
                success: function(response) {
                    if (response.berhasil) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.berhasil.pesan,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else if (response.gagal) {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.gagal.pesan,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });


    });
</script>

<script>
    $('.jumlah_delegasi').change(function(e) {
        e.preventDefault();
        var jumlah = $('.jumlah_delegasi').val();
        $.ajax({
            url: "<?= site_url('dynamic/load_nama_delegasi'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                jumlah: jumlah
            },
            success: function(response) {
                console.log(response);
                $('.nama_delegasi').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    $('.bentuk_penyerahan').change(function(e) {
        e.preventDefault();
        var bentuk = $('.bentuk_penyerahan').val();
        $.ajax({
            url: "<?= site_url('dynamic/load_ket_penyerahan'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                bentuk: bentuk
            },
            success: function(response) {
                console.log(response);
                $('.ket_bentuk').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    $('.dana_dari').change(function(e) {
        e.preventDefault();
        var dana = $('#dndr').val();
        $.ajax({
            url: "<?= site_url('dynamic/load_kategori_penerima'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                dana: dana
            },
            success: function(response) {
                console.log(response);
                $('.kategori_penerima').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>

<script type="text/javascript">
    function hapus_ajuan(params) {
        Swal.fire({
                title: 'Anda ingin menghapus ajuan?',
                html: "Semua data yang mengacu pada ajuan ini akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
                    var csrfHash = $('.csrf_input').val(); // CSRF hash
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('admin/hapus_ajuan'); ?>",
                        data: {
                            id_ajuan: params,
                            [csrfName]: csrfHash
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('.btn_hapus').prop('disabled', true);
                            $('.btn_hapus').html('<i class="fa fa-spin fa-spinner"></i>');
                        },
                        complete: function() {
                            $('.btn_hapus').prop('disabled', false);
                            $('.btn_hapus').html("<i class='fa fa-trash text-danger-m1 text-120'></i>");
                        },
                        success: function(response) {
                            if (response.berhasil) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: response.berhasil.pesan,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = response.berhasil.link;
                                    }
                                });
                            }
                            if (response.gagal) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: response.gagal.pesan,
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = response.gagal.link;
                                    }
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                    return false;
                } else {
                    return false;
                }
            });
    }

    function hapusBeritaAcara(params) {
        Swal.fire({
                title: 'Anda yakin?',
                html: "Data berita acara akan di hapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
                    var csrfHash = $('.csrf_input').val(); // CSRF hash
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('admin/hapus_berita_acara'); ?>",
                        data: {
                            id_berita_acara: params,
                            nik: <?= $ajuan['nik']; ?>,
                            no_ajuan: <?= $ajuan['id_ajuan']; ?>,
                            [csrfName]: csrfHash
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('.btn_hapus').prop('disabled', true);
                            $('.btn_hapus').html('<i class="fa fa-spin fa-spinner"></i>');
                        },
                        complete: function() {
                            $('.btn_hapus').prop('disabled', false);
                            $('.btn_hapus').html("<i class='fa fa-trash text-danger-m1 text-120'></i>");
                        },
                        success: function(response) {
                            if (response.berhasil) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: response.berhasil.pesan,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            } else if (response.gagal) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: response.gagal.pesan,
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = response.gagal.link;
                                    }
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                    return false;
                } else {
                    return false;
                }
            });
    }
</script>

<script>
    $('.field_dokumentasi').submit(function(e) {
        e.preventDefault();
        let form = $('.field_dokumentasi')[0];
        let data = new FormData(form);
        $.ajax({
            type: "post",
            url: "<?= site_url('pemohon/do_unggah_dokumentasi'); ?>",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('.btn_unggah_doc').prop('disabled', true);
                $('.btn_unggah_doc').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btn_unggah_doc').prop('disabled', false);
                $('.btn_unggah_doc').html("Unggah");
            },
            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        title: 'Gagal',
                        text: response.error.file_dokumentasi,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("input[name='csrf_test_name']").val(response.error.token);
                        }
                    });
                }
                if (response.berhasil) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: response.berhasil.pesan,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (response.gagal) {
                    Swal.fire({
                        title: 'Gagal',
                        text: response.gagal.pesan,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    });

    $('.field_kuitansi').submit(function(e) {
        e.preventDefault();
        let form = $('.field_kuitansi')[0];
        let data = new FormData(form);
        $.ajax({
            type: "post",
            url: "<?= site_url('pemohon/do_unggah_kuitansi'); ?>",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('.btn_unggah_kuitansi').prop('disabled', true);
                $('.btn_unggah_kuitansi').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btn_unggah_kuitansi').prop('disabled', false);
                $('.btn_unggah_kuitansi').html("Unggah");
            },
            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        title: 'Gagal',
                        text: response.error.file_kuitansi,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("input[name='csrf_test_name']").val(response.error.token);
                        }
                    });
                }
                if (response.berhasil) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: response.berhasil.pesan,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (response.gagal) {
                    Swal.fire({
                        title: 'Gagal',
                        text: response.gagal.pesan,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    });

    function tolakDokumentasi(params) {
        Swal.fire({
                title: 'Anda yakin?',
                html: "Data dokumentasi akan ditolak",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tolak!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
                    var csrfHash = $('.csrf_input').val(); // CSRF hash
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('admin/tolak_dokumentasi'); ?>",
                        data: {
                            id: params,
                            jenis: 'documentation',
                            [csrfName]: csrfHash
                        },
                        dataType: "json",
                        beforeSend: function() {},
                        complete: function() {},
                        success: function(response) {
                            if (response.berhasil) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: response.berhasil.pesan,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            } else if (response.gagal) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: response.gagal.pesan,
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = response.gagal.link;
                                    }
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                    return false;
                } else {
                    return false;
                }
            });
    }

    function tolakKuitansi(params) {
        Swal.fire({
                title: 'Anda yakin?',
                html: "Data kuitansi akan ditolak",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tolak!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
                    var csrfHash = $('.csrf_input').val(); // CSRF hash
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('admin/tolak_dokumentasi'); ?>",
                        data: {
                            id: params,
                            jenis: 'nota',
                            [csrfName]: csrfHash
                        },
                        dataType: "json",
                        beforeSend: function() {},
                        complete: function() {},
                        success: function(response) {
                            if (response.berhasil) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: response.berhasil.pesan,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            } else if (response.gagal) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: response.gagal.pesan,
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = response.gagal.link;
                                    }
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                    return false;
                } else {
                    return false;
                }
            });
    }

    function tbhCtt(params1, params2) {
        $.ajax({
            url: "<?= site_url('dynamic/load_modal_ctt_doc'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id: params1,
                jenis: params2
            },
            success: function(response) {
                $('.ctt').html(response.data);
                $('#cttDokumentasiModal').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<script>
    function editDeskripsi(params) {
        $.ajax({
            url: "<?= site_url('dynamic/load_modal_deskripsi'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                idajuan: params
            },
            success: function(response) {
                $('.modal_deskripsi').html(response.data);
                $('#editDeskripsiModal').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<script>
    function loadModalB3(noajuan) {
        $.ajax({
            url: "<?= site_url('dynamic/load_modal_b3'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                noajuan: noajuan
            },
            success: function(response) {
                $('.modal_b3').html(response.data);
                $('#b3Modal').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<script>
    //Menghilangkan Alert
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $('#peringatan').css('display', 'none');
        });
    }, 10000);
</script>

<?= $this->endSection(); ?>