<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<div class="page-content container">
    <div class="page-header border-0 ">
        <h1 class="text-grey-d1 pb-0 mb-0 text-130">
            Overview &amp; Stats
            <?php if ($filter == 'filter') { ?>
                (<?= $tglAwal . ' - ' . $tglAkhir; ?>)
            <?php } ?>
        </h1>

        <div class="page-tools">
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2" data-toggle="modal" data-target="#filterModal">
                <i class="fas fa-search fa-sm text-white-50"></i> Filter Tanggal
            </button>
            <!-- button Ekspor pdf -->
            <a href=" /admin/ekspor_excel?filter=<?= $filter; ?>&tgAwal=<?= $norm_tglAwal; ?>&tgAkhir=<?= $norm_tglAkhir; ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm ml-2 btnPdf" name="btnPdf">
                <i class="fa fa-file-excel fa-sm text-white-50"></i> Ekspor Excel
            </a>
        </div>
    </div>

    <!-- stat boxes -->
    <div class="row px-2">
        <div class="col-12 col-sm-6 col-md-3 px-2 mb-1 mb-md-0">
            <div class="pos-rel d-flex flex-column text-center bgc-white px-2 py-3 radius-1 shadow-sm h-100">
                <div class="mb-1">
                    <span class="d-inline-block bgc-primary-l2 p-3 radius-round">
                        <i class="fa fa-comment text-primary-m1 text-180 w-4"></i>
                    </span>
                </div>
                <div class="mt-2px">
                    <h2 class="text-primary pb-0"><b><?= $count_ajuan_baru; ?></b></h2>
                    <div class="text-dark-tp5 text-110">Ajuan Baru</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 px-2 mb-1 mb-md-0">
            <div class="pos-rel d-flex flex-column text-center bgc-white px-2 py-3 radius-1 shadow-sm h-100">
                <div class="mb-1">
                    <span class="d-inline-block bgc-info-l2 p-3 radius-round">
                        <i class="fa fa-hourglass text-info-m1 text-180 w-4"></i>
                    </span>
                </div>

                <div class="mt-2px">
                    <h2 class="text-blue pb-0"><b><?= $count_ajuan_proses; ?></b></h2>
                    <div class="text-dark-tp5 text-110">Dalam Proses</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 px-2 mb-1 mb-md-0">
            <div class="pos-rel d-flex flex-column text-center bgc-white px-2 py-3 radius-1 shadow-sm h-100">
                <div class="mb-1">
                    <span class="d-inline-block bgc-warning-l2 p-3 radius-round">
                        <i class="fa fa-comment text-warning-m1 text-180 w-4"></i>
                    </span>
                </div>
                <div class="mt-2px">
                    <h2 class="text-orange pb-0"><b><?= $count_ajuan_rutin; ?></b></h2>
                    <div class="text-dark-tp5 text-110">Rutin Berjalan</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 px-2 mb-1 mb-md-0">
            <div class="pos-rel d-flex flex-column text-center bgc-white px-2 py-3 radius-1 shadow-sm h-100">
                <div class="mb-1">
                    <span class="d-inline-block bgc-secondary-l2 p-3 radius-round">
                        <i class="fa fa-check-square text-secondary-m1 text-180 w-4"></i>
                    </span>
                </div>

                <div class="mt-2px">
                    <h2 class="text-secondary pb-0"><b><?= $count_ajuan_selesai; ?></b></h2>
                    <div class="text-dark-tp5 text-110">Selesai</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-2 bgc-warning my-3 radius-round">
        <div class="col-12 text-center">
            <h6 class="pt-2 text-white">Total Dana Tersalurkan <span><b>Rp. <?= number_format((float)$total_dana['nilai_penyerahan'], 0, ',', '.'); ?></b></span></h6>
        </div>
    </div>

    <div class="row px-2 mt-3 bgc-white justify-align-center">
        <div class="col-lg-6 py-3">
            <h3 class="text-grey-d1 pb-0 mb-0 text-100">
                Dana Tersalurkan dari Infaq Umum (Rp. <?= number_format((float)$nominal_infak, 0, ',', '.'); ?>)
            </h3>
            <canvas id="myInfak" class="mx-n1 mx-md-0"></canvas>
        </div>
        <div class="col-lg-6 py-3">
            <h3 class="text-grey-d1 pb-0 mb-0 text-100">
                Dana Tersalurkan dari Zakat (Rp. <?= number_format((float)$nominal_zakat, 0, ',', '.'); ?>)
            </h3>
            <canvas id="myZakat" class="mx-n1 mx-md-0"></canvas>
        </div>
    </div>

    <div class="row px-2 mt-3 bgc-white justify-align-center">
        <div class="col-lg-6 py-3">
            <h3 class="text-grey-d1 pb-0 mb-0 text-100">
                Dana Tersalurkan dari Infaq Terikat (Rp. <?= number_format((float)$nominal_sosial, 0, ',', '.'); ?>)
            </h3>
            <canvas id="mySosial" class="mx-n1 mx-md-0"></canvas>
        </div>
        <div class="col-lg-6 py-3">
            <h3 class="text-grey-d1 pb-0 mb-0 text-100">
                Dana Tersalurkan dari Amil (Rp. <?= number_format((float)$nominal_amil, 0, ',', '.'); ?>)
            </h3>
            <canvas id="myAmil" class="mx-n1 mx-md-0"></canvas>
        </div>
    </div>

    <div class="row px-2 mt-3 bgc-white justify-align-center">
        <div class="col-lg-8 py-3">
            <h3 class="text-grey-d1 pb-0 mb-0 text-100">
                Statistik Program
            </h3>
            <canvas id="myChart" class="mx-n1 mx-md-0"></canvas>
        </div>
        <div class="col-lg-4 py-3">
            <h3 class="text-grey-d1 pb-0 mb-0 text-100">
                Statistik Pilar
            </h3>
            <canvas id="myChart2" class="mx-n1 mx-md-0"></canvas>
        </div>
    </div>

    <div class="row mt-3 bgc-white justify-content-center">
        <div class="col-12 py-3">
            <h3 class="text-grey-d1 pb-0 mb-0 text-100">
                Statistik Bulanan (<?= $tahun; ?>)
            </h3>
            <canvas id="myChart3" class="mx-n1 mx-md-0"></canvas>
        </div>
    </div>
</div>

<!-- Modal filter tanggal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="filterModalLabel"><strong>Filter tanggal</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formFilter" action="/admin/index">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputAddress">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="inputAddress" name="tgAwal" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="inputAddress2" name="tgAkhir" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="/admin/index?hpsFilter=noFilter" role="button" class="btn btn-success">Hapus Filter</a>
                    <input type="hidden" name="filterTgl" value="filter">
                    <button type="submit" class="btn btn-primary btnFilter" name="btnFilter">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Statistik Zakat -->
<script>
    const myZakat = new Chart(
        document.getElementById('myZakat'), {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($list_zakat as $nama_ktg => $jumlah_ktg) { ?> "<?= $nama_ktg; ?>",
                    <?php } ?>
                ],
                datasets: [{
                    label: 'Nominal',
                    data: [
                        <?php foreach ($list_zakat as $nama_ktg => $jumlah_ktg) { ?> <?= $jumlah_ktg; ?>,
                        <?php } ?>
                    ],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                    ],
                    borderColor: [
                        'rgb(54, 162, 235)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    );
</script>

<!-- Statistik Infak -->
<script>
    const myInfak = new Chart(
        document.getElementById('myInfak'), {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($list_infak as $nama_ktg => $jumlah_ktg) { ?> "<?= $nama_ktg; ?>",
                    <?php } ?>
                ],
                datasets: [{
                    label: 'Nominal',
                    data: [
                        <?php foreach ($list_infak as $nama_ktg => $jumlah_ktg) { ?> <?= $jumlah_ktg; ?>,
                        <?php } ?>
                    ],
                    backgroundColor: [
                        // 'rgba(50,205,50)',
                        'rgb(255, 205, 86)'
                    ],
                    borderColor: [
                        // 'rgb(50,205,50)',
                        'rgb(255, 205, 86)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    );
</script>

<!-- Statistik Sosial Keagamaan Lainnya -->
<script>
    const mySosial = new Chart(
        document.getElementById('mySosial'), {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($list_sosial as $nama_ktg => $jumlah_ktg) { ?> "<?= $nama_ktg; ?>",
                    <?php } ?>
                ],
                datasets: [{
                    label: 'Nominal',
                    data: [
                        <?php foreach ($list_sosial as $nama_ktg => $jumlah_ktg) { ?> <?= $jumlah_ktg; ?>,
                        <?php } ?>
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    );
</script>

<!-- Statistik Amil-->
<script>
    const myAmil = new Chart(
        document.getElementById('myAmil'), {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($list_amil as $nama_ktg => $jumlah_ktg) { ?> "<?= $nama_ktg; ?>",
                    <?php } ?>
                ],
                datasets: [{
                    label: 'Nominal',
                    data: [
                        <?php foreach ($list_amil as $nama_ktg => $jumlah_ktg) { ?> <?= $jumlah_ktg; ?>,
                        <?php } ?>
                    ],
                    backgroundColor: [
                        'rgb(138, 43, 226)',
                    ],
                    borderColor: [
                        'rgb(138, 43, 226)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    );
</script>

<!-- Statistik Program -->
<script>
    const myChart = new Chart(
        document.getElementById('myChart'), {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($list_ktg as $nama_ktg => $jumlah_ktg) { ?> "<?= $nama_ktg; ?>",
                    <?php } ?>
                ],
                datasets: [{
                    label: 'Jumlah Ajuan',
                    data: [
                        <?php foreach ($list_ktg as $nama_ktg => $jumlah_ktg) { ?> <?= $jumlah_ktg; ?>,
                        <?php } ?>
                    ],
                    backgroundColor: [
                        'rgba(50,205,50)'
                    ],
                    borderColor: [
                        'rgb(50,205,50)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    );
</script>

<!-- Statistik Pilar -->
<script>
    const myChart2 = new Chart(
        document.getElementById('myChart2'), {
            type: 'doughnut',
            data: {
                labels: [
                    <?php foreach ($list_pilar as $nama_pilar => $jumlah_pilar) { ?> "<?= $nama_pilar; ?>",
                    <?php } ?>
                ],
                datasets: [{
                    label: 'Stats Pilar',
                    data: [
                        <?php foreach ($list_pilar as $nama_pilar => $jumlah_pilar) { ?> <?= $jumlah_pilar; ?>,
                        <?php } ?>
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(66, 245, 66)',
                        'rgb(138, 43, 226)',
                        'rgb(220, 220, 220)'
                    ],
                    hoverOffset: 4
                }]
            }
            // options: {
            //     scales: {
            //         y: {
            //             beginAtZero: true
            //         }
            //     }
            // },
        }
    );
</script>

<!-- Time Series-->
<script>
    const myChart3 = new Chart(
        document.getElementById('myChart3'), {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Jumlah Ajuan',
                    data: [
                        <?php foreach ($list_ajuan as $bulan => $jumlah_ajuan) { ?> <?= $jumlah_ajuan; ?>,
                        <?php } ?>
                    ],
                    backgroundColor: [
                        'rgba(247, 150, 5)'
                    ],
                    borderColor: [
                        'rgb(247, 150, 5)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    );
</script>
<?= $this->endSection(); ?>