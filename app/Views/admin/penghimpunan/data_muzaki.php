<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<div class="page-content container">
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-sm-center justify-align-between">
        <h1 class="page-title text-primary-d2">
            Data Muzaki
        </h1>
        <a href="/admin/sinkron_dosen" class="btn btn-warning"> <i class="fas fa-cloud-download-alt"></i> Sinkronkan Dosen</a>
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
                                <th class="border-0 bgc-h-default-l3">ID</th>
                                <th class="border-0 bgc-h-default-l3">Nama</th>
                                <th class="border-0 bgc-h-default-l3">Alamat</th>
                                <th class="border-0 bgc-h-default-l3">No. Telp</th>
                                <th class="border-0 bgc-h-default-l3">Email</th>
                                <th class="border-0 bgc-h-default-l3">Perorangan/Lembaga</th>
                                <th class="border-0 bgc-h-default-l3">Dosen</th>
                                <th class="border-0 bgc-h-default-l3">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($muzaki as $i => $m) : ?>
                                <tr class="d-style bgc-h-default-l4">
                                    <td>
                                        <span class="text-105"><?= $i + 1; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $m['id_muzaki']; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $m['nama_muzaki']; ?></span>
                                    </td>
                                    <td class="text-grey"><?= $m['alamat_muzaki']; ?></td>
                                    <td class="text-grey"><?= $m['tlp_muzaki']; ?></td>
                                    <td class="text-grey"><?= $m['email_muzaki']; ?></td>
                                    <td class="text-grey"><?= $m['jenis_muzaki']; ?></td>
                                    <td class="text-grey"><?= $m['is_dosen']; ?></td>
                                    <td class="text-grey">
                                        <a data-rel="tooltip" title="Edit" href="#"><i class="fa fa-edit text-blue-m1 text-120"></i></a>
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