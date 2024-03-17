<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<div class="page-content container">
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-sm-center">
        <h1 class="page-title text-primary-d2">
            Riwayat Ajuan
        </h1>
    </div>
    <div class="bgc-white p-2">
        <div class="page-tools pt-1 mt-3 mt-sm-0 mb-sm-n1"></div>
        <div class="row">
            <div class="col-md-12" style="font-size: 14px">
                <div class="table-responsive-md">
                    <table id="datatable" class="table table-border-y text-dark-m2 text-95 border-y-1 brc-secondary-l1">
                        <thead class="text-secondary-m2 text-uppercase text-85">
                            <tr>
                                <th class="border-0 bgc-h-default-l3">No.</th>
                                <th class="border-0 bgc-h-default-l3">Tanggal Ajuan</th>
                                <th class="border-0 bgc-h-default-l3">No. Ajuan</th>
                                <th class="border-0 bgc-h-default-l3">Program</th>
                                <th class="border-0 bgc-h-default-l3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_ajuan as $ajuan) : ?>
                                <tr class="d-style bgc-h-default-l4">
                                    <td>
                                        <span class="text-105"><?= $no++; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $ajuan['tgl_diajukan']; ?></span>
                                    </td>
                                    <td class="text-600 text-grey-d1">
                                        <span class="badge badge badge-secondary arrowed-right"><?= $ajuan['nomor_ajuan']; ?></span>
                                    </td>
                                    <td class="text-grey"><?= $ajuan['nama_program']; ?></td>
                                    <?php
                                    if ($ajuan['status_ajuan'] == 1) {
                                        $badge = 'badge-secondary';
                                    } elseif ($ajuan['status_ajuan'] == 2) {
                                        $badge = 'badge-secondary';
                                    } elseif ($ajuan['status_ajuan'] == 3) {
                                        $badge = 'badge-primary';
                                    } elseif ($ajuan['status_ajuan'] == 4) {
                                        $badge = 'badge-warning';
                                    } elseif ($ajuan['status_ajuan'] == 5) {
                                        $badge = 'badge-info';
                                    } elseif ($ajuan['status_ajuan'] == 6) {
                                        $badge = 'badge-danger';
                                    } elseif ($ajuan['status_ajuan'] >= 7) {
                                        $badge = 'badge-success';
                                    }
                                    ?>
                                    <td class="text-grey">
                                        <div><span class='badge <?= $badge; ?> badge-sm'><?= $ajuan['keterangan_status']; ?></span></div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>