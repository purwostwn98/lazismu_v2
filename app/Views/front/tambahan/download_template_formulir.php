<div class="col-md-1"> </div>
<div class="col-md-10">
    <div class="alert alert-primary bgc-primary-l3 brc-primary-m2 d-flex align-items-center" role="alert">
        <i class="fas fa-info-circle mr-3 fa-2x text-blue"></i>
        <div class="syarat_program">
            <div class="judul mb-2">
                <b>Template formulir analisa</b>
            </div>
            <div class="list_syarat">
                <ul>
                    <?php if ($program['jenis_formulir'] == 1) { ?>
                        <li>Download template formulir analisa individu <a target="_blank" href="<?= base_url(); ?>/template_formulir/rumah_individu_01.pdf">di sini</a></li>
                    <?php } elseif ($program['jenis_formulir'] == 2) { ?>
                        <li>Download template formulir analisa sekolah <a target="_blank" href="<?= base_url(); ?>/template_formulir/sekolah_02.pdf">di sini</a></li>
                    <?php } elseif ($program['jenis_formulir'] == 3) { ?>
                        <li>Download template formulir analisa usaha <a target="_blank" href="<?= base_url(); ?>/template_formulir/usaha_individu_03.pdf">di sini</a></li>
                    <?php } elseif ($program['jenis_formulir'] == 4) { ?>
                        <li>Download template formulir analisa masjid <a target="_blank" href="<?= base_url(); ?>/template_formulir/masjid_04.pdf">di sini</a></li>
                    <?php } else {  ?>
                        <li>Template formulir tidak tersedia, mohon upload dokumen data mengenai organisasi Anda</li>
                    <?php } ?>
                </ul>
            </div>
            <div class="foot">
                <i>Download template formulir analisa di atas. Isi kemudian upload pada form di bawah ini!</i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-1"> </div>