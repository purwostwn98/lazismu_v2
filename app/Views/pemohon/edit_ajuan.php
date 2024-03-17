<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<?php
$session = \Config\Services::session();
?>
<div class="page-content container">
    <div class="row container container-plus mx-auto mt-0 mb-4 justify-content-center">
        <div class="d-sm-flex align-items-left justify-content-between mb-3 mt-4">
            <h3 class="h5 mb-0 text-left text-gray-800">Edit Ajuan - <?= $ajuan['nomor_ajuan']; ?></h3>
        </div>
        <?= form_open_multipart("", ['class' => 'formAjukan']); ?>
        <?= csrf_field(); ?>
        <!-- Form Ajuan -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ajuan Bantuan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Jenis Bantuan</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <select class="form-control col-sm-12  border-left-info animated--grow-in" name="jenis_bantuan" id="div" onchange="getval(this);" disabled>
                                <option value="" disabled>Pilih jenis ajuan</option>
                                <option <?= ($ajuan['jenis_ajuan'] == 'Individu') ? 'selected' : ''; ?> value="Individu">Individu</option>
                                <option <?= ($ajuan['jenis_ajuan'] == 'Lembaga') ? 'selected' : ''; ?> value="Lembaga">Lembaga</option>
                            </select>
                            <p class="text-danger text-sm error_jenis_bantuan"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Pilih Pilar</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <select name="pilar" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control pilar_selects" disabled>
                                <option value="" disabled>Pilih Pilar</option>
                                <?php foreach ($data_pilar as $program) : ?>
                                    <option <?= ($ajuan['id_pilar'] == $program['id_pilar']) ? 'selected' : ''; ?> value="<?= $program['id_pilar']; ?>"><?= $program['nama_pilar']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger text-sm error_pilar"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Pilih Kategori Program</label>
                    </div>
                    <div class="col-sm-6 select_kategori">
                        <div class="form-group has-danger">
                            <select name="kategori" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kategori" disabled>
                                <?php foreach ($data_ktg_program as $program) : ?>
                                    <option <?= ($ajuan['id_kategori_program'] == $program['id_kategori_program']) ? 'selected' : ''; ?> value="<?= $program['id_kategori_program']; ?>"><?= $program['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger text-sm error_kategori"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Pilih Program</label>
                    </div>
                    <div class="col-sm-6 select_program">
                        <div class="form-group has-danger">
                            <select name="program" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kategori" disabled>
                                <?php foreach ($data_program as $program) : ?>
                                    <option <?= ($ajuan['id_program'] == $program['id_program']) ? 'selected' : ''; ?> value="<?= $program['id_program']; ?>"><?= $program['nama_program']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger text-sm error_program"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"> </div>
                    <div class="col-sm-4">
                        <label for="">Nilai Ajuan</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <label class="sr-only" for="inlineFormInputGroup">Nilai Ajuan</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input value="<?= $ajuan['nilai_diajukan']; ?>" type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nilai_kebutuhan" id="inputku" placeholder="-" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                <p class="text-danger text-sm error_nilai_kebutuhan"><i></i></p>
                            </div>
                            <small id="nilai" class="form-text text-primary"><i>Isikan nominal bantuan yang dibutuhkan misalnya 750000</i></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"> </div>
                    <div class="col-sm-4">
                        <label for="">Deskripsi Ajuan (Keperluan)</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <textarea type="text" rows="3" class="form-control col-sm-12  border-left-info animated--grow-in" name="deskripsi_permohonan" id="keperluan"><?= $ajuan['deskripsi_ajuan']; ?></textarea>
                            <small id="nilai1" class="form-text text-primary"><i>Isikan alasan mengapa mengajukan dan untuk apa bantuan digunakan</i></small>
                        </div>
                    </div>
                </div>
                <div class="row download_template_formulir">
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
                                        <?php if ($ajuan['jenis_formulir'] == 1) { ?>
                                            <li>Download template formulir analisa individu <a target="_blank" href="<?= base_url(); ?>/template_formulir/formulir_01.pdf">di sini</a></li>
                                        <?php } elseif ($ajuan['jenis_formulir'] == 2) { ?>
                                            <li>Download template formulir analisa lembaga <a target="_blank" href="<?= base_url(); ?>/template_formulir/formulir_02.pdf">di sini</a></li>
                                        <?php } elseif ($ajuan['jenis_formulir'] == 3) { ?>
                                            <li>Download template formulir analisa umum <a target="_blank" href="<?= base_url(); ?>/template_formulir/formulir_03.pdf">di sini</a></li>
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
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Formulir Analisa</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <a href="<?= base_url(); ?>/file_formulir/<?= $ajuan['file_formulir']; ?>" class="btn btn-success btn-sm btn-icon-split mb-2" target="_blank">
                                <span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text"> Lihat</span>
                            </a><br>
                            <input type="hidden" name="formulir_lama" value="<?= $ajuan['file_formulir']; ?>">
                            <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_formulir" name="file_formulir">
                            <small id="nilai1" class="form-text text-primary"><i>Tidak perlu diupload ulang jika tidak ada pergantian file</i></small>
                            <p class="text-danger text-sm error_formulir"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>

        <!-- Identitas Lembaga -->
        <?php if ($ajuan['jenis_ajuan'] == 'Lembaga') { ?>
            <div id="form_lembaga" class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Identitas Lembaga</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <label for="">Nama Lembaga</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-danger">
                                <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_lembaga" id="namaLbg" value="<?= $ajuan['nama_lembaga']; ?>" readonly>
                                <p class="text-danger text-sm error_nama_lembaga"><i></i></p>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <label for="">Alamat Lembaga</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-danger">
                                <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="alamat_lembaga" id="alamatLbg" value="<?= $ajuan['alamat_lembaga']; ?>" readonly>
                                <p class="text-danger text-sm error_alamat_lembaga"><i></i></p>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <label for="">No. Akta Lembaga</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-danger">
                                <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nomor_lembaga" id="noAkta" value="<?= $ajuan['nomor_lembaga']; ?>" readonly>
                                <p class="text-danger text-sm error_nomor_lembaga"><i></i></p>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- Persyaratan Ajuan -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Persyaratan Bantuan</h6>
            </div>
            <div class="card-body unggahSyarat">
                <!-- Pilih program bantuan terlebih dahulu -->
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary bgc-primary-l3 brc-primary-m2 d-flex align-items-center" role="alert">
                            <i class="fas fa-info-circle mr-3 fa-2x text-blue"></i>
                            <div class="syarat_program">
                                <div class="judul mb-2">
                                    <b> Syarat yang harus dilengkapi</b>
                                </div>
                                <div class="list_syarat">
                                    <ul>
                                        <?php foreach ($syarat_program as $syarat) { ?>
                                            <li><?= $syarat['syarat_program']; ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="foot">
                                    <i>Syarat di atas harus dilengkapi dan dijadikan dalam satu file pdf dengan diurutkan sesuai urutan yang tertera di atas. Upload file tersebut pada form di bawah ini.</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Proposal</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <a href="<?= base_url(); ?>/file_proposal/<?= $ajuan['file_proposal']; ?>" class="btn btn-success btn-sm btn-icon-split mb-2" target="_blank">
                                <span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text"> Lihat</span>
                            </a><br>
                            <input type="hidden" name="proposal_lama" value="<?= $ajuan['file_proposal']; ?>">
                            <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_proposal" name="file_proposal">
                            <small id="nilai1" class="form-text text-primary"><i>Tidak perlu diupload ulang jika tidak ada pergantian file</i></small>
                            <p class="text-danger text-sm error_proposal"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-sm-1"> </div> -->
            <div class="checkbox mx-3 col-12">
                <label for="persetujuan"><input type="checkbox" name="persetujuan" id="persetujuan" required="">
                    Menyatakan bahwa apa yang tertulis pada formulir dan syarat yang diunggah benar adanya dan bersedia dibatalkan ajuannya apabila
                    data tidak valid.</label>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <p class="text-right">
                    <button class="btn btn-secondary btn-md btn-icon-split" onclick="del(this.value)"><span class="icon text-white-50"> <i class="fas fa-times"></i></span><span class="text"> Batal</span></button> &nbsp;&nbsp;
                    <button type="submit" class="btn btn-success btn-md btn-icon-split btnAjukan"><span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text"> Ajukan</span></button>
                </p>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>/assets/js/angkaRibuan.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('.pilar_selects').change(function() {
        var id_pilar = $('.pilar_selects').val();
        $.ajax({
            url: "<?= site_url('dynamic/select_kategori'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_pilar: id_pilar
            },
            success: function(response) {
                $('.select_kategori').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>
<script>
    //Untuk hide/show form Lembaga
    function getval(sel) {
        if (sel.value == "Individu") {
            $("#form_lembaga").css("display", "none");
            $('.srtKeterangan').css("display", "block");
        } else if (sel.value == "Lembaga") {
            $("#form_lembaga").css("display", "block");
            $('.srtKeterangan').css("display", "none");
        }
    }


    $(document).ready(function() {
        $('.formAjukan').submit(function(e) {
            e.preventDefault();
            let form = $('.formAjukan')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('pemohon/simpan_edit_ajuan'); ?>",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnAjukan').prop('disabled', true);
                    $('.btnAjukan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnAjukan').prop('disabled', false);
                    $('.btnAjukan').html("<span class='icon text-white-50'> <i class='fas fa-check'></i></span><span class='text'>Ajukan</span>");
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.jenis_bantuan) {
                            $('.error_jenis_bantuan').html('<i>' + response.error.jenis_bantuan + '</i>');
                        }
                        if (response.error.program) {
                            $('.error_program').html('<i>' + response.error.program + '</i>');
                        }
                        if (response.error.kategori_program) {
                            $('.error_kategori').html('<i>' + response.error.kategori_program + '</i>');
                        }
                        if (response.error.nilai_kebutuhan) {
                            $('.error_nilai_kebutuhan').html('<i>' + response.error.nilai_kebutuhan + '</i>');
                        }
                        if (response.error.nama_lembaga) {
                            $('.error_nama_lembaga').html('<i>' + response.error.nama_lembaga + '</i>');
                        }
                        if (response.error.alamat_lembaga) {
                            $('.error_alamat_lembaga').html('<i>' + response.error.alamat_lembaga + '</i>');
                        }
                        if (response.error.nomor_lembaga) {
                            $('.error_nomor_lembaga').html('<i>' + response.error.nomor_lembaga + '</i>');
                        }
                        if (response.error.nama_lembaga) {
                            $('.error_nama_lembaga').html('<i>' + response.error.nama_lembaga + '</i>');
                        }
                        if (response.error.file_formulir) {
                            $('.error_formulir').html('<i>' + response.error.file_formulir + '</i>');
                        }
                        if (response.error.proposal) {
                            $('.error_proposal').html('<i>' + response.error.proposal + '</i>');
                        }
                        $("input[name='csrf_test_name']").val(response.error.token);
                    }
                    if (response.berhasil) {
                        Swal.fire({
                            title: 'No. Ajuan : ' + response.berhasil.nomor_ajuan,
                            text: response.berhasil.pesan,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = '<?= site_url('/pemohon/detail_ajuan'); ?>';
                            }
                        });
                    } else if (response.gagal) {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.gagal.pesan,
                            icon: 'error',
                            confirmButtonText: 'Ok'
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
<?= $this->endSection(); ?>