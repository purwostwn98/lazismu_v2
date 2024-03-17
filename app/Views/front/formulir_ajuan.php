<?= $this->extend("/layout/template_front.php"); ?>
<?= $this->section("konten"); ?>
<div class="row container mx-3 mt-0 mb-4 justify-content-center">
    <div class="col-12">
        <div class="d-sm-flex align-items-center justify-content-center mb-3 mt-4">
            <h1 class="h3 mb-0 text-gray-800">Formulir Ajuan Bantuan</h1>
        </div>
    </div>
</div>


<?= form_open_multipart("", ['class' => 'formAjukan']); ?>
<?= csrf_field(); ?>
<input type="hidden" name="nik" value="<?= $pemohon['nik']; ?>">
<!-- Form Ajuan -->
<div class="row mx-3">
    <div class="col-12">
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
                            <select class="form-control col-sm-12  border-left-info animated--grow-in" name="jenis_bantuan" id="div" onchange="getval(this);">
                                <option value="" selected disabled>Pilih jenis ajuan</option>
                                <option value="Individu">Individu</option>
                                <option value="Lembaga">Lembaga</option>
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
                            <select name="pilar" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control pilar_selects">
                                <option value="" disabled selected>Pilih Pilar</option>
                                <?php foreach ($data_pilar as $program) : ?>
                                    <option value="<?= $program['id_pilar']; ?>"><?= $program['nama_pilar']; ?></option>
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
                            <select name="kategori" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kategori">
                                <option value="" disabled selected>Pilih pilar terlebih dahulu</option>
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
                            <select name="program" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control program_selects">
                                <option value="" disabled selected>Pilih kategori terlebih dahulu</option>
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
                                <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nilai_kebutuhan" id="inputku" placeholder="-" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
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
                            <textarea type="text" rows="3" class="form-control col-sm-12  border-left-info animated--grow-in" name="deskripsi_permohonan" id="keperluan" value=""></textarea>
                            <small id="nilai1" class="form-text text-primary"><i>Isikan alasan mengapa mengajukan dan untuk apa bantuan digunakan</i></small>
                        </div>
                    </div>
                </div>
                <div class="row download_template_formulir">
                    ...
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Formulir Analisa</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_formulir" name="file_formulir">
                            <p class="text-danger text-sm error_formulir"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Identitas Penerima (mustahik individu) -->
<div id="form_individu" class="row mx-3" style="display: none;">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Mustahik Individu</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for=""><b>NIK</b></label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" class="form-control nik_individu" id="form-field-mask-1" inputmode="text" name="nik_mustahik">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" id="cariMustahik" type="button"><i class="fa fa-calendar mr-1"></i> Cari!</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="form_mustahik">
                    <!-- form diambil dari dynamic -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Identitas Lembaga -->
<div id="form_lembaga" style="display: none;" class="row mx-3">
    <div class="col-12">
        <div class="card shadow mb-4">
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
                            <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_lembaga" id="namaLbg" value="">
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
                            <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="alamat_lembaga" id="alamatLbg" value="">
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
                            <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nomor_lembaga" id="noAkta" placeholder="Jika tidak ada isikan 0">
                            <p class="text-danger text-sm error_nomor_lembaga"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Persyaratan Ajuan -->
<div class="row mx-3">
    <div class="col-12">
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
                                        <li>Pilih program terlebih dahulu</li>
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
                            <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_proposal" name="file_proposal">
                            <p class="text-danger text-sm error_proposal"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mx-3">
    <div class="checkbox mx-3 col-12">
        <label for="persetujuan"><input type="checkbox" name="persetujuan" id="persetujuan" required="">
            Menyatakan bahwa apa yang tertulis pada formulir dan syarat yang diunggah benar adanya dan penerima bersedia membuat laporan pertanggungjawaban (LPJ) jika ajuan telah disetujui. Ajuan akan dibatalkan jika data tidak valid.</label>
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
            $("#form_individu").css("display", "block");
        } else if (sel.value == "Lembaga") {
            $("#form_lembaga").css("display", "block");
            $('.srtKeterangan').css("display", "none");
            $("#form_individu").css("display", "none");
        }
    }

    $(document).ready(function() {
        $('.formAjukan').submit(function(e) {
            e.preventDefault();
            let form = $('.formAjukan')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('pemohon/simpan_ajuan'); ?>",
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
                        if (response.error.file_ktp) {
                            $('.error_ktp').html('<i>' + response.error.file_ktp + '</i>');
                        }
                        if (response.error.file_kk) {
                            $('.error_kk').html('<i>' + response.error.file_kk + '</i>');
                        }
                        $("input[name='csrf_test_name']").val(response.error.token);
                    }
                    if (response.berhasil) {
                        Swal.fire({
                            title: 'No. Ajuan : ' + response.berhasil.nomor_ajuan,
                            text: response.berhasil.pesan,
                            icon: 'success',
                            confirmButtonText: 'Ok, dan Simpan'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // window.location = '<?= site_url('/'); ?>';
                                window.location = response.berhasil.link;
                            }
                        });
                    } else if (response.gagal) {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.gagal.pesan,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = '<?= site_url('/'); ?>';
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        $("#cariMustahik").on("click", function() {
            var nik = $('.nik_individu').val();
            $.ajax({
                url: "<?= site_url('dynamic/cek_form_mustahik'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    nik_mustahik: nik
                },
                success: function(response) {
                    $('.form_mustahik').html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

        })
    });
</script>

<?= $this->endSection(); ?>