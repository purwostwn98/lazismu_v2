<input type="hidden" name="status" value="<?= $status; ?>">
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <p class="alert <?= ($biodata == 404) ? 'alert-danger' : 'alert-info'; ?> mb-1">
            <?= $pesan; ?>
        </p>
    </div>
    <div class="col-sm-1"></div>
</div>

<!-- form biodata lengkap -->

<?php if ($biodata != 404) { ?>
    <?php if ($status == 1) { ?>
        <div class="row mt-3">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Nama Lengkap</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_pemohon">
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
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
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
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="tempat_lahir">
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
                    <input type="date" class="form-control col-sm-12  border-left-info animated--grow-in" name="tanggal_lahir">
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
                        <option value="" disabled selected>Pilih Provinsi</option>
                        <?php foreach ($provinsi as $prov) : ?>
                            <option value="<?= $prov['id_provinsi']; ?>"><?= $prov['nama_provinsi']; ?></option>
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
                    <select class="form-control col-sm-12  border-left-info animated--grow-in" name="kabupaten" id="kodeBantuan" onchange="getBantuan(this);">
                        <option value="" disabled selected>Pilih Kabupaten</option>
                        <option value="">List Kabupaten</option>
                    </select>
                    <p class="text-danger text-sm error_kabupaten"><i></i></p>
                    <!-- <small id="nilai0" class="form-text text-primary"><i>Keterangan detail Program Bantuan silahkan buka di halaman depan</i></small> -->
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
                <div class="form-group has-danger kecamatan_select">
                    <select class="form-control col-sm-12  border-left-info animated--grow-in" name="kecamatan" id="kodeBantuan" onchange="getBantuan(this);">
                        <option value="" disabled selected>Pilih Kecamatan</option>
                        <option value="">List Kecamatan</option>
                    </select>
                    <p class="text-danger text-sm error_kecamatan"><i></i></p>
                    <!-- <small id="nilai0" class="form-text text-primary"><i>Keterangan detail Program Bantuan silahkan buka di halaman depan</i></small> -->
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
                    <select class="form-control col-sm-12  border-left-info animated--grow-in" name="kelurahan" id="kodeBantuan" onchange="getBantuan(this);">
                        <option value="" disabled selected>Pilih Kelurahan/Desa</option>
                        <option value="">List Kelurahan/Desa</option>
                    </select>
                    <p class="text-danger text-sm error_kelurahan"><i></i></p>
                    <!-- <small id="nilai0" class="form-text text-primary"><i>Keterangan detail Program Bantuan silahkan buka di halaman depan</i></small> -->
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
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="alamat_detail" placeholder="Cont. Jalan Merpati No.2 ">
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
                        <option value="" disabled selected>Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindhu">Hindhu</option>
                        <option value="Budha">Budha</option>
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
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="telepon">
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
                    <input type="email" class="form-control col-sm-12  border-left-info animated--grow-in" name="email">
                    <p class="text-danger text-sm error_email"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    <?php } elseif ($status == 0) { ?>
        <div class="row mt-3">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Nama Lengkap</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_pemohon" value="<?= $biodata['nama_pemohon']; ?>" readonly>
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
                    <select class="form-control col-sm-12  border-left-info animated--grow-in" name="jenis_kelamin" id="div" readonly>
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
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="tempat_lahir" value="<?= $biodata['tempat_lahir']; ?>" readonly>
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
                    <input type="date" class="form-control col-sm-12  border-left-info animated--grow-in" name="tanggal_lahir" value="<?= $biodata['tanggal_lahir']; ?>" readonly>
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
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control prov_select" name="provinsi" readonly disabled>
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
                    <select name="kabupaten" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kab_select" readonly disabled>
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
                    <select name="kecamatan" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kec_select" readonly disabled>
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
                    <select name="kelurahan" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kel_select" readonly disabled>
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
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="alamat_detail" placeholder="Cont. Jalan Merpati No.2 " value="<?= $biodata['alamat_detail']; ?>" readonly>
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
                    <select class="form-control col-sm-12  border-left-info animated--grow-in" name="agama" readonly disabled>
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
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="telepon" value="<?= $biodata['telepon']; ?>" readonly>
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
                    <input type="email" class="form-control col-sm-12  border-left-info animated--grow-in" name="email" value="<?= $biodata['email']; ?>" readonly>
                    <p class="text-danger text-sm error_email"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>

    <?php } ?>

<?php } ?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/application/views/default/pages/partials/form-elements-2/@page-script.js"></script>
<script type="text/javascript">
    $('.prov_select').change(function() {
        var id_provinsi = $('.prov_select').val();
        // alert(id_provinsi);
        $.ajax({
            url: "<?= site_url('dynamic/load_kabupaten'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_provinsi: id_provinsi
            },
            success: function(response) {
                $('.kabupaten_select').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });


    // $('.kab_select').change(function() {
    //     var id_kabupaten = $('.kab_select').val();
    //     // alert(id_kecamatan);
    //     $.ajax({
    //         url: "<?= site_url('dynamic/load_kecamatan'); ?>",
    //         type: "POST",
    //         dataType: "json",
    //         data: {
    //             id_kabupaten: id_kabupaten
    //         },
    //         success: function(response) {
    //             $('.kecamatan_select').html(response.data);
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //         }
    //     });
    // });
</script>