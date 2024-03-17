<div class="page-tools pt-1 mt-3 mt-sm-0 mb-sm-n1"></div>
<div class="row">
    <div class="col-md-12" style="font-size: 13px">
        <div class="table-responsive-md">
            <table id="datatable" class="table table-border-y text-dark-m2 text-95 border-y-1 brc-secondary-l1">
                <thead class="text-secondary-m2 text-uppercase text-85">
                    <tr>
                        <th class="border-0 bgc-h-default-l3">No.</th>
                        <th class="border-0 bgc-h-default-l3">Tanggal Ajuan</th>
                        <th class="border-0 bgc-h-default-l3">NIK</th>
                        <th class="border-0 bgc-h-default-l3">Nama</th>
                        <?php if ($jenis == 'proses_lbg') { ?>
                            <th class="border-0 bgc-h-default-l3">Lembaga</th>
                        <?php } ?>
                        <th class="border-0 bgc-h-default-l3">No. Ajuan</th>
                        <th class="border-0 bgc-h-default-l3">Program</th>
                        <th class="border-0 bgc-h-default-l3">Status</th>
                        <th class="border-0 bgc-h-default-l3">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($ajuan_baru as $ajuan) : ?>
                        <tr class="d-style bgc-h-default-l4">
                            <td>
                                <span class="text-105"><?= $no++; ?></span>
                            </td>
                            <td>
                                <span class="text-105"><?= $ajuan['tgl_diajukan']; ?></span>
                            </td>
                            <td>
                                <span class="text-105"><?= $ajuan['nik']; ?></span>
                            </td>
                            <td>
                                <span class="text-105"><?= $ajuan['nama_pemohon']; ?></span>
                            </td>
                            <?php if ($jenis == 'proses_lbg') { ?>
                                <td>
                                    <span class="text-105"><?= $ajuan['nama_lembaga']; ?></span>
                                </td>
                            <?php } ?>
                            <td class="text-600 text-grey-d1">
                                <span class="badge badge badge-secondary arrowed-right"><?= $ajuan['nomor_ajuan']; ?></span>
                            </td>
                            <td class="text-grey"><?= $ajuan['nama_program']; ?></td>
                            <?php
                            if ($ajuan['status_ajuan'] == 2) {
                                $badge = 'badge-secondary';
                            } elseif ($ajuan['status_ajuan'] == 3) {
                                $badge = 'badge-primary';
                            } elseif ($ajuan['status_ajuan'] == 4) {
                                $badge = 'badge-warning';
                            } elseif ($ajuan['status_ajuan'] == 5) {
                                $badge = 'badge-info';
                            } elseif ($ajuan['status_ajuan'] == 6) {
                                $badge = 'badge-danger';
                            } elseif ($ajuan['status_ajuan'] == 7) {
                                $badge = 'badge-success';
                            } elseif ($ajuan['status_ajuan'] == 8) {
                                $badge = 'badge-success';
                            } elseif ($ajuan['status_ajuan'] == 9) {
                                $badge = 'badge-secondary';
                            }
                            ?>
                            <td>
                                <span class="badge badge <?= $badge; ?> arrowed-in radius-0" class="text-105"><?= $ajuan['keterangan_status']; ?></span>
                            </td>
                            <td>
                                <a data-rel="tooltip" title="Lihat Detail" href="/admin/tindakan/<?= $ajuan['nik']; ?>/<?= $ajuan['nomor_ajuan']; ?>"><i class="fa fa-eye text-blue-m1 text-120"></i> Konfirmasi</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>/application/views/default/pages/partials/table-datatables/@page-script.js"></script>