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
                                <th class="border-0 bgc-h-default-l3">NIK</th>
                                <th class="border-0 bgc-h-default-l3">Nama</th>
                                <th class="border-0 bgc-h-default-l3">Kelurahan</th>
                                <th class="border-0 bgc-h-default-l3">Kecamatan</th>
                                <th class="border-0 bgc-h-default-l3">Kabupaten</th>
                                <th class="border-0 bgc-h-default-l3">Provinsi</th>
                                <th class="border-0 bgc-h-default-l3">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_pengaju as $pemohon) : ?>
                                <tr class="d-style bgc-h-default-l4">
                                    <td>
                                        <span class="text-105"><?= $no++; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $pemohon['nik']; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $pemohon['nama_pemohon']; ?></span>
                                    </td>
                                    <td class="text-grey"><?= $pemohon['nama_kelurahan']; ?></td>
                                    <td class="text-grey"><?= $pemohon['nama_kecamatan']; ?></td>
                                    <td class="text-grey"><?= $pemohon['nama_kabupaten']; ?></td>
                                    <td class="text-grey"><?= $pemohon['nama_provinsi']; ?></td>
                                    <td class="text-grey">
                                        <a data-rel="tooltip" title="Lihat Detail" href="/admin/detail_pemohon/<?= $pemohon['nik']; ?>"><i class="fa fa-eye text-blue-m1 text-120"></i></a>
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