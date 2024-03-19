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
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between bgc-warning">
        <div class="col-auto">
            <h1 class="page-title text-dark">
                <i class="fa fa-edit text-white"></i>
                Notulensi Rapat
            </h1>
        </div>
        <div class="col-auto">
            <input type="hidden" class="csrf_input" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <input type="number" name="tahun" id="">
            <button class="btn btn-sm btn-primary">Filter Tahun</button>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-6">
                <span style="font-size: 14px;">Notulensi Tahun 2024</span>
            </div>
            <div class="col-6">
                <p class="text-right">
                    <a href="/admin/formulir_notulensi" class="btn btn-sm btn-primary">Buat Notulensi</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table style="font-size: 12px;" class="table table-stripped">
                    <thead class="bgc-dark text-white">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam mulai</th>
                        <th>Jam selesai</th>
                        <th>Pemimpin Rapat</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                        <?php foreach ($notulensi as $key => $value) { ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $value['tgl_rapat']; ?></td>
                                <td><?= $value['jam_mulai']; ?></td>
                                <td><?= $value['jam_selesai']; ?></td>
                                <td><?= $value['pemimpin_rapat']; ?></td>
                                <!-- <td>10</td>
                        <td>
                            <ol>
                                <li>Proposal Masuk</li>
                                <li>Studi Tiru</li>
                                <li>Beras UMS</li>
                            </ol>
                        </td> -->
                                <td><a class="btn btn-info btn-sm" href="/admin/detail_notulensi?idnotulensi=<?= $value['id']; ?>">detail</a></td>
                            </tr>
                        <?php  } ?>
                        <!-- <td>1</td>
                        <td>Jumat</td>
                        <td>19 Januari 2024</td>
                        <td>10.20 WIB</td>
                        <td>11.30 WIB</td>
                        <td>DR. Mahasri Shobahiya, M.Ag</td>
                        <td>10</td>
                        <td>
                            <ol>
                                <li>Proposal Masuk</li>
                                <li>Studi Tiru</li>
                                <li>Beras UMS</li>
                            </ol>
                        </td>
                        <td><button class="btn btn-info btn-sm">detail</button></td> -->
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
    </div>
</div>


<?= $this->endSection(); ?>