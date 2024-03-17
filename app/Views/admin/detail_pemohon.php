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
    <div class="page-header border-0 ">
        <h1 class="text-grey-d1 pb-0 mb-0 text-130">
            Biodata Pemohon
        </h1>

        <div class="page-tools">
            <div class="action-buttons text-nowrap">
                <a class="btn bgc-white btn-light-secondary mx-0" href="admin/edit_pemohon/<?= $ajuan['nik']; ?>" data-toggle="tooltip" title="Edit Pemohon">
                    <i class="fa fa-edit text-warning" aria-hidden="true"></i>
                </a>
                <!-- <a class="btn bgc-white btn-light-secondary mx-0" href="#" data-toggle="tooltip" title="Print">
                    <i class="fa fa-print text-purple-m1"></i>
                </a> -->
                <a class="btn bgc-white btn-light-secondary mx-0" href="#" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-trash text-danger-m1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="bgc-white p-3">
        <!-- Content Row Data Pemohon-->
        <div class="row">
            <div class="col-md-6">
                <label for="">
                    <b>Nomor Induk Kependudukan (NIK)</b>
                </label>
            </div>
            <div class="col-md-6">
                <?= $ajuan['nik']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-6">
                <label for="">
                    <b>Nama Lengkap</b>
                </label>
            </div>
            <div class="col-md-6">
                <?= $ajuan['nama_pemohon']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row">
            <div class="col-md-6">
                <label for="">
                    <b>Tempat, Tanggal Lahir</b>
                </label>
            </div>
            <div class="col-md-6">
                <?php
                $tgl = explode('-', $ajuan['tanggal_lahir'])
                ?>
                <?= $ajuan['tempat_lahir']; ?>, <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0] ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-6">
                <label for="">
                    <b>Jenis Kelamin</b>
                </label>
            </div>
            <div class="col-md-6">
                <?= $ajuan['jenis_kelamin']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row">
            <div class="col-md-6">
                <label for="">
                    <b>Alamat</b>
                </label>
            </div>
            <div class="col-md-6">
                <?= $ajuan['alamat_detail']; ?>, <br>
                <?= $ajuan['nama_kelurahan']; ?>, <?= $ajuan['nama_kecamatan']; ?>, <?= $ajuan['nama_kabupaten']; ?>, <?= $ajuan['nama_provinsi']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-6">
                <label for="">
                    <b>Agama</b>
                </label>
            </div>
            <div class="col-md-6">
                <?= $ajuan['agama']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row">
            <div class="col-md-6">
                <label for="">
                    <b>Telepon</b>
                </label>
            </div>
            <div class="col-md-6">
                <?= $ajuan['telepon']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-6">
                <label for="">
                    <b>E-mail</b>
                </label>
            </div>
            <div class="col-md-6">
                <?= $ajuan['email']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
    </div>
</div><!-- /.page-content -->
<?= $this->endSection(); ?>