<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<div class="row container container-plus mx-auto mt-0 mb-4 justify-content-center">
    <div class="d-sm-flex col-12 align-items-center justify-content-center mb-3 mt-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Biodata</h1>
    </div>
    <?= form_open("/admin/simpan_edit_pemohon", ['class' => 'form_biodata col-md-12']); ?>
    <?= csrf_field(); ?>
    <!-- Form Ajuan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Biodata Pemohon</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-md-4">
                    <label for="">Nomor Induk Kependudukan</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <input type="text" class="form-control col-sm-12 col-md-12  border-left-info animated--grow-in" name="nik" id="nik" value="<?= $biodata['nik']; ?>" readonly>
                        <p class="text-danger text-sm error_nik"><i></i></p>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="biodata mt-1">
                <div class="row mt-3">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Nama Lengkap</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_pemohon" value="<?= $biodata['nama_pemohon']; ?>">
                            <p class="text-danger text-sm error_nama_lengkap"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Jenis Kelamin</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <select class="form-control col-sm-12  border-left-info animated--grow-in" name="jenis_kelamin" id="div">
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option <?= ($biodata['jenis_kelamin'] == 'laki-laki') ? 'selected' : ''; ?> value="laki-laki">Laki-laki</option>
                                <option <?= ($biodata['jenis_kelamin'] == 'perempuan') ? 'selected' : ''; ?> value="perempuan">Perempuan</option>
                            </select>
                            <p class="text-danger text-sm error_jenis_kelamin"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Tempat Lahir</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="tempat_lahir" value="<?= $biodata['tempat_lahir']; ?>">
                            <p class="text-danger text-sm error_tempat_lahir"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Tanggal Lahir</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <input type="date" class="form-control col-sm-12  border-left-info animated--grow-in" name="tanggal_lahir" value="<?= $biodata['tanggal_lahir']; ?>">
                            <p class="text-danger text-sm error_tanggal_lahir"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Provinsi</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control prov_select" name="provinsi">
                                <option value="" disabled>Pilih Provinsi</option>
                                <?php foreach ($provinsi as $prov) : ?>
                                    <option <?= ($biodata['id_provinsi'] == $prov['id_provinsi']) ? 'selected' : ''; ?> value="<?= $prov['id_provinsi']; ?>"><?= $prov['nama_provinsi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger text-sm error_provinsi"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>


                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Kabupaten/Kota</label>
                    </div>
                    <div class="col-sm-6 kabupaten_select">
                        <div class="form-group has-danger">
                            <select name="kabupaten" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kab_select">
                                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                                <?php foreach ($kabupaten as $kab) : ?>
                                    <option <?= ($biodata['id_kabupaten'] == $kab['id_kabupaten']) ? 'selected' : ''; ?> value="<?= $kab['id_kabupaten']; ?>"><?= $kab['nama_kabupaten']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Kecamatan</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <select name="kecamatan" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kec_select">
                                <option value="" disabled>Pilih Kecamatan</option>
                                <?php foreach ($kecamatan as $kab) : ?>
                                    <option <?= ($biodata['id_kecamatan'] == $kab['id_kecamatan']) ? 'selected' : ''; ?> value="<?= $kab['id_kecamatan']; ?>"><?= $kab['nama_kecamatan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Kelurahan/Desa</label>
                    </div>
                    <div class="col-sm-6 kelurahan_select">
                        <div class="form-group has-danger">
                            <select name="kelurahan" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kel_select">
                                <option value="" disabled>Pilih Kelurahan/Desa</option>
                                <?php foreach ($kelurahan as $kab) : ?>
                                    <option <?= ($biodata['id_kelurahan'] == $kab['id_kelurahan']) ? 'selected' : ''; ?> value="<?= $kab['id_kelurahan']; ?>"><?= $kab['nama_kelurahan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>


                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Alamat Detail</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="alamat_detail" placeholder="Cont. Jalan Merpati No.2 " value="<?= $biodata['alamat_detail']; ?>">
                            <p class="text-danger text-sm error_alamat_detail"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Agama</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <select class="form-control col-sm-12  border-left-info animated--grow-in" name="agama">
                                <option value="" disabled>Pilih Agama</option>
                                <option <?= ($biodata['agama'] == 'Islam') ? 'selected' : ''; ?> value="Islam">Islam</option>
                                <option <?= ($biodata['agama'] == 'Protestan') ? 'selected' : ''; ?> value="Protestan">Protestan</option>
                                <option <?= ($biodata['agama'] == 'Katolik') ? 'selected' : ''; ?> value="Katolik">Katolik</option>
                                <option <?= ($biodata['agama'] == 'Hindhu') ? 'selected' : ''; ?> value="Hindhu">Hindhu</option>
                                <option <?= ($biodata['agama'] == 'Budha') ? 'selected' : ''; ?> value="Budha">Budha</option>
                            </select>
                            <p class="text-danger text-sm error_agama"><i></i></p>
                            <!-- <small id="nilai0" class="form-text text-primary"><i>Keterangan detail Program Bantuan silahkan buka di halaman depan</i></small> -->
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Telepon</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="telepon" value="<?= $biodata['telepon']; ?>">
                            <p class="text-danger text-sm error_telepon"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="">Email</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <input type="email" class="form-control col-sm-12  border-left-info animated--grow-in" name="email" value="<?= $biodata['email']; ?>">
                            <p class="text-danger text-sm error_email"><i></i></p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 justify-content-right">
            <p class="text-right pt-2">
                <button onclick="history.back()" class=" pt-15 pb-2 radius-round active btn btn-md btn-outline-secondary btn-h-light-secondary btn-a-secondary" role="button" aria-selected="true">
                    <span class="icon text-white-50"> <i class="fas fa-times"></i> </span> Batal
                </button>
                <button type="submit" class=" pt-15 pb-2 active radius-round btn btn-md btn-outline-warning btn-h-light-warning btn-a-warning btndaftar" role="button" aria-selected="true">
                    <span class="icon text-white-50"> <i class="fas fa-check"></i> </span> Simpan
                </button>
                <!-- <a href="/front/formulir_ajuan" class=" pt-15 pb-2 active radius-round btn btn-md btn-outline-warning btn-h-light-warning btn-a-warning" role="button" aria-selected="true">
                    <span class="icon text-white-50"> <i class="fas fa-check"></i> </span> Simpan
                </a> -->
            </p>
        </div>
    </div>
    <?= form_close(); ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>
    //Untuk hide/show form Lembaga
    function getval(sel) {
        if (sel.value == "0") {
            $("#form_lembaga").css("display", "none");
            $('.srtKeterangan').css("display", "block");
        } else if (sel.value == "1") {
            $("#form_lembaga").css("display", "block");
            $('.srtKeterangan').css("display", "none");
        }
    }
</script>

<script type="text/javascript">
    $('.form_biodata').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btndaftar').prop('disabled', true);
                $('.btndaftar').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btndaftar').prop('disabled', false);
                $('.btndaftar').html('<span class="icon text-white-50"> <i class="fas fa-check"></i> </span> Simpan');
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.nik) {
                        $('.error_nik').html('<i>' + response.error.nik + '</i>');
                    }
                    if (response.error.nama_pemohon) {
                        $('.error_nama_lengkap').html('<i>' + response.error.nama_pemohon + '</i>');
                    }
                    if (response.error.jenis_kelamin) {
                        $('.error_jenis_kelamin').html('<i>' + response.error.jenis_kelamin + '</i>');
                    }
                    if (response.error.tempat_lahir) {
                        $('.error_tempat_lahir').html('<i>' + response.error.tempat_lahir + '</i>');
                    }
                    if (response.error.tanggal_lahir) {
                        $('.error_tanggal_lahir').html('<i>' + response.error.tanggal_lahir + '</i>');
                    }
                    if (response.error.provinsi) {
                        $('.error_provinsi').html('<i>' + response.error.provinsi + '</i>');
                    }
                    if (response.error.kabupaten) {
                        $('.error_kabupaten').html('<i>' + response.error.kabupaten + '</i>');
                    }
                    if (response.error.kecamatan) {
                        $('.error_kecamatan').html('<i>' + response.error.kecamatan + '</i>');
                    }
                    if (response.error.kelurahan) {
                        $('.error_kelurahan').html('<i>' + response.error.kelurahan + '</i>');
                    }
                    if (response.error.alamat_detail) {
                        $('.error_alamat_detail').html('<i>' + response.error.alamat_detail + '</i>');
                    }
                    if (response.error.agama) {
                        $('.error_agama').html('<i>' + response.error.agama + '</i>');
                    }
                    if (response.error.telepon) {
                        $('.error_telepon').html('<i>' + response.error.telepon + '</i>');
                    }
                    if (response.error.email) {
                        $('.error_email').html('<i>' + response.error.email + '</i>');
                    }
                    $("input[name='csrf_test_name']").val(response.error.token);
                }

                if (response.berhasil) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: response.berhasil.pesan,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = response.berhasil.link;
                        }
                    });
                }
                if (response.gagal) {
                    Swal.fire({
                        title: 'Gagal',
                        text: response.gagal.pesan,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }

                if (response.terdaftar) {
                    window.location = response.terdaftar.link_form_ajuan;
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
</script>
<?= $this->endSection(); ?>