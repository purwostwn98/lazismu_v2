<?= $this->extend("/layout/template_front.php"); ?>
<?= $this->section("konten"); ?>

<div class="row container container-plus mx-auto mt-0 mb-4 justify-content-center">
    <div class="col-md-12 justify-content-center">
        <div class="row p-3 mt-2 align-item-center justify-content-between">
            <div class="col-auto">
                <h2 class="text-black-m1 text-130 pb-2 mb-1 mt-3 text-center text-bold"><?= $pilar['nama_pilar']; ?></h2>
            </div>
            <div class="col-auto">
                <a href="/front/formulir_biodata" class="pt-15 pb-2 radius-round btn btn-md btn-primary btn-h-light-primary btn-a-primary" role="button" aria-selected="true">
                    Formulir Pengajuan
                </a>
            </div>
        </div>

        <div class="accordion" id="accordionExample">
            <?php foreach ($list_program as $key => $ktg) { ?>
                <div class="card">
                    <div class="card-header align-items-center justify-content-between" id="heading_<?= $key; ?>">
                        <h2 class="card-title">
                            <a class="accordion-toggle collapsed" href="#collapse_<?= $key; ?>" data-toggle="collapse" aria-expanded="true" aria-controls="collapse_<?= $key; ?>">
                                <i class="fa fa-angle-right toggle-icon mr-1"></i>
                                <?= $ktg[0]; ?>
                            </a>
                        </h2>
                        <?php
                        if ($ktg[2] == 1) {
                            echo "<span class='badge badge-sm badge-success arrowed arrowed-in-right mr-2'>Aktif</span>";
                        } else {
                            echo "<span class='badge badge-sm badge-secondary arrowed arrowed-in-right mr-2'>Closed</span>";
                        }
                        ?>
                    </div>
                    <div id="collapse_<?= $key; ?>" class="collapse" aria-labelledby="heading_<?= $key; ?>" data-parent="#accordionExample">
                        <div class="card-body">
                            <?= $ktg[1]; ?>
                            <br>
                            <br>
                            <span><b>Bentuk Program</b></span>
                            <ul>
                                <?php foreach ($ktg[3] as $p => $prg) { ?>
                                    <li><?= $prg['nama_program']; ?> <br>
                                        <span><b>Syarat Program: </b></span>
                                        <ol>
                                            <?php foreach ($ktg[4][$p] as $s => $syarat) { ?>
                                                <li><?= $syarat['syarat_program']; ?></li>
                                            <?php } ?>
                                        </ol>
                                    </li>
                                    <br>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</div>



<?= $this->endSection(); ?>