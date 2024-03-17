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
                <label for="">Foto KTP (pdf/jpg/png)</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_ktp" name="file_ktp" required>
                    <p class="text-danger text-sm error_ktp"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">No. KK</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" class="form-control col-sm-12 col-md-8" id="id-form-field-1" name="no_kk" value="<?= ($status == 0) ? $biodata['kk'] : ""; ?>" required>
                    <p class="text-danger text-sm"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Foto KK (pdf/jpg/png)</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_kk" name="file_kk" required>
                    <p class="text-danger text-sm error_kk"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Nama Lengkap</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="nama sesuai dengan ktp" value="<?= ($status == 0) ? $biodata['nama_mustahik'] : ""; ?>" name="nama" required>
                    <p class="text-danger text-sm"><i></i></p>
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
                    <input type="text" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="sesuai dengan ktp" name="tempat_lahir" required>
                    <p class="text-danger text-sm"><i></i></p>
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
                    <input type="date" class="form-control col-sm-12 col-md-12" id="id-form-field-1" name="tgl_lahir" required>
                    <p class="text-danger text-sm"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Jenis kelamin</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select class="form-control col-sm-12  border-left-info animated--grow-in" name="jenkel" required>
                        <option value="" selected disabled>pilih jenis kelamin</option>
                        <option <?= ($status == 0) ? (($biodata['kelamin_mustahik'] == 'Laki-laki') ? "selected" : "") : ""; ?> value="Laki-laki">Laki-laki</option>
                        <option <?= ($status == 0) ? (($biodata['kelamin_mustahik'] == 'Perempuan') ? "selected" : "") : ""; ?> value="Perempuan">Perempuan</option>
                    </select>
                    <p class="text-danger text-sm"><i></i></p>
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
                    <select class="form-control col-sm-12  border-left-info animated--grow-in" name="agama" required>
                        <option value="" disabled selected>pilih agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindhu">Hindhu</option>
                        <option value="Budha">Budha</option>
                    </select>
                    <p class="text-danger text-sm error_pilar"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Alamat Tinggal (KTP)</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="nama jalan, dusun, rt/rw, desa(kelurahan)" name="alamat_ktp" required>
                    <p class="text-danger text-sm error_pilar"><i></i></p>
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
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control prov_select" name="provinsi" required>
                        <option value="" selected disabled>pilih provinsi</option>
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
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="kabupaten" required>
                        <option value="" selected disabled>pilih kabupaten/kota</option>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Kecamatan</label>
            </div>
            <div class="col-sm-6 kecamatan_select">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="kecamatan" required>
                        <option value="" selected disabled>pilih kecamatan</option>
                    </select>
                    <p class="text-danger text-sm"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Desa/Kelurahan</label>
            </div>
            <div class="col-sm-6 kelurahan_select">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="kelurahan" required>
                        <option value="" selected disabled>pilih desa/kelurahan</option>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Status Pendidikan</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="pendidikan" required>
                        <option value="" selected disabled>pilih pendidikan terakhir</option>
                        'SD','SMP','SMA/SMK','Diploma','Sarjana','Pascasarjana','tidak tamat SD'
                        <option value="tidak tamat SD">tidak tamat SD</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Sarjana">Sarjana</option>
                        <option value="Pascasarjana">Pascasarjana</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Status Marital</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="marital" required>
                        <option value="" selected disabled>pilih status marital</option>
                        <option value="Lajang">Lajang</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Cerai">Cerai</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Pekerjaan</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="pekerjaan" required>
                        <option value="" selected disabled>pilih pekerjaan</option>
                        <?php foreach ($pekerjaan as $key => $v) { ?>
                            <option value="<?= $v['id_pekerjaan']; ?>"><?= $v['nama_pekerjaan']; ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Penghasilan</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="penghasilan" required>
                        <option value="" selected disabled>pilih penghasilan</option>
                        <?php foreach ($penghasilan as $key => $v) { ?>
                            <option value="<?= $v['id_penghasilan']; ?>"><?= $v['label_penghasilan']; ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Jml. Keluarga</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="number" name="jml_keluarga" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="jumlah keluarga dalam satu KK" required>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">No Handphone (WA)</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" name="no_handphone" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="nomor handphone" required>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
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
                    <input type="email" name="email_mustahik" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="email mustahik" required>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    <?php } elseif ($status == 0) { ?>
        <input type="hidden" name="nama_file_ktp_old" id="" value="<?= $biodata['foto_ktp']; ?>">
        <input type="hidden" name="nama_file_kk_old" id="" value="<?= $biodata['foto_kk']; ?>">
        <div class="row mt-3">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Foto KTP (pdf/jpg/png) | </label>
                <a class="btn btn-sm btn-info" target="_blank" href="<?= base_url(); ?>/file_ktp/<?= $biodata['foto_ktp']; ?>"><i class="fa fa-eye"></i> | Lihat</a>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_ktp" name="file_ktp" placeholder="Anda tidak perlu upload ulang jika tidak ada perubahan">
                    <p class="text-info text-sm error_ktp"><i>Anda tidak perlu upload ulang, jika tidak ada perubahan</i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">No. KK</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" class="form-control col-sm-12 col-md-8" id="id-form-field-1" name="no_kk" value="<?= ($status == 0) ? $biodata['kk'] : ""; ?>" required>
                    <p class="text-danger text-sm"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Foto KK (pdf/jpg/png) | </label>
                <a class="btn btn-sm btn-info" target="_blank" href="<?= base_url(); ?>/file_kk/<?= $biodata['foto_kk']; ?>"><i class="fa fa-eye"></i> | Lihat</a>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_kk" name="file_kk">
                    <p class="text-danger text-sm error_kk"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Nama Lengkap</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="nama sesuai dengan ktp" value="<?= ($status == 0) ? $biodata['nama_mustahik'] : ""; ?>" name="nama" required>
                    <p class="text-danger text-sm"><i></i></p>
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
                    <input type="text" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="sesuai dengan ktp" value="<?= ($status == 0) ? $biodata['tempat_lahir'] : ""; ?>" name="tempat_lahir" required>
                    <p class="text-danger text-sm"><i></i></p>
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
                    <input type="date" class="form-control col-sm-12 col-md-12" id="id-form-field-1" value="<?= ($status == 0) ? $biodata['tgl_lahir'] : ""; ?>" name="tgl_lahir" required>
                    <p class="text-danger text-sm"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Jenis kelamin</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select class="form-control col-sm-12  border-left-info animated--grow-in" name="jenkel" required>
                        <option value="" selected disabled>pilih jenis kelamin</option>
                        <option <?= ($status == 0) ? (($biodata['kelamin_mustahik'] == 'Laki-laki') ? "selected" : "") : ""; ?> value="Laki-laki">Laki-laki</option>
                        <option <?= ($status == 0) ? (($biodata['kelamin_mustahik'] == 'Perempuan') ? "selected" : "") : ""; ?> value="Perempuan">Perempuan</option>
                    </select>
                    <p class="text-danger text-sm"><i></i></p>
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
                    <select class="form-control col-sm-12  border-left-info animated--grow-in" name="agama" required>
                        <option value="" disabled selected>pilih agama</option>
                        <option <?= ($biodata['agama_mustahik'] == 'Islam') ? "selected" : ""; ?> value="Islam">Islam</option>
                        <option <?= ($biodata['agama_mustahik'] == 'Protestan') ? "selected" : ""; ?> value="Protestan">Protestan</option>
                        <option <?= ($biodata['agama_mustahik'] == 'Katolik') ? "selected" : ""; ?> value="Katolik">Katolik</option>
                        <option <?= ($biodata['agama_mustahik'] == 'Hindhu') ? "selected" : ""; ?> value="Hindhu">Hindhu</option>
                        <option <?= ($biodata['agama_mustahik'] == 'Budha') ? "selected" : ""; ?> value="Budha">Budha</option>
                    </select>
                    <p class="text-danger text-sm error_pilar"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Alamat Tinggal (KTP)</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="nama jalan, dusun, rt/rw, desa(kelurahan)" name="alamat_ktp" value="<?= ($status == 0) ? $biodata['alamat'] : ""; ?>" required>
                    <p class="text-danger text-sm error_pilar"><i></i></p>
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
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control prov_select" name="provinsi" required>
                        <option value="" selected disabled>pilih provinsi</option>
                        <?php foreach ($provinsi as $prov) : ?>
                            <option <?= ($biodata['provinsi'] == $prov['id_provinsi']) ? "selected" : ""; ?> value="<?= $prov['id_provinsi']; ?>"><?= $prov['nama_provinsi']; ?></option>
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
                        <option value="" disabled>Pilih Kabupaten/Kota</option>
                        <?php foreach ($kabupaten as $kab) : ?>
                            <option <?= ($biodata['kabupaten'] == $kab['id_kabupaten']) ? "selected" : ""; ?> value="<?= $kab['id_kabupaten']; ?>"><?= $kab['nama_kabupaten']; ?></option>
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
            <div class="col-sm-6 kecamatan_select">
                <div class="form-group has-danger">
                    <select name="kecamatan" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kec_select">
                        <option value="" disabled>Pilih Kecamatan</option>
                        <?php foreach ($kecamatan as $kab) : ?>
                            <option <?= ($biodata['kecamatan'] == $kab['id_kecamatan']) ? "selected" : ""; ?> value="<?= $kab['id_kecamatan']; ?>"><?= $kab['nama_kecamatan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Desa/Kelurahan</label>
            </div>
            <div class="col-sm-6 kelurahan_select">
                <div class="form-group has-danger">
                    <select name="kelurahan" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kel_select">
                        <option value="" disabled selected>Pilih Kelurahan/Desa</option>
                        <?php foreach ($kelurahan as $kab) : ?>
                            <option <?= ($biodata['desa'] == $kab['id_kelurahan']) ? "selected" : ""; ?> value="<?= $kab['id_kelurahan']; ?>"><?= $kab['nama_kelurahan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Status Pendidikan</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="pendidikan" required>
                        <option value="" disabled>pilih pendidikan terakhir</option>
                        <option <?= ($biodata['status_pendidikan'] == "tidak tamat SD") ? "selected" : ""; ?> value="tidak tamat SD">tidak tamat SD</option>
                        <option <?= ($biodata['status_pendidikan'] == "SD") ? "selected" : ""; ?> value="SD">SD</option>
                        <option <?= ($biodata['status_pendidikan'] == "SMP") ? "selected" : ""; ?> value="SMP">SMP</option>
                        <option <?= ($biodata['status_pendidikan'] == "SMA/SMK") ? "selected" : ""; ?> value="SMA/SMK">SMA/SMK</option>
                        <option <?= ($biodata['status_pendidikan'] == "Diploma") ? "selected" : ""; ?> value="Diploma">Diploma</option>
                        <option <?= ($biodata['status_pendidikan'] == "Sarjana") ? "selected" : ""; ?> value="Sarjana">Sarjana</option>
                        <option <?= ($biodata['status_pendidikan'] == "Pascasarjana") ? "selected" : ""; ?> value="Pascasarjana">Pascasarjana</option>
                        <option <?= ($biodata['status_pendidikan'] == "lainnya") ? "selected" : ""; ?> value="lainnya">Lainnya</option>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Status Marital</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="marital" required>
                        <option value="" disabled>pilih status marital</option>
                        <option <?= ($biodata['status_marital'] == "Lajang") ? "selected" : ""; ?> value="Lajang">Lajang</option>
                        <option <?= ($biodata['status_marital'] == "Menikah") ? "selected" : ""; ?> value="Menikah">Menikah</option>
                        <option <?= ($biodata['status_marital'] == "Cerai") ? "selected" : ""; ?> value="Cerai">Cerai</option>
                        <option <?= ($biodata['status_marital'] == "Lainnya") ? "selected" : ""; ?> value="Lainnya">Lainnya</option>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Pekerjaan</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="pekerjaan" required>
                        <option value="" selected disabled>pilih pekerjaan</option>
                        <?php foreach ($pekerjaan as $key => $v) { ?>
                            <option <?= ($biodata['pekerjaan'] == $v['id_pekerjaan']) ? "selected" : ""; ?> value="<?= $v['id_pekerjaan']; ?>"><?= $v['nama_pekerjaan']; ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Penghasilan</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control" name="penghasilan" required>
                        <option value="" selected disabled>pilih penghasilan</option>
                        <?php foreach ($penghasilan as $key => $v) { ?>
                            <option <?= ($biodata['penghasilan'] == $v['id_penghasilan']) ? "selected" : ""; ?> value="<?= $v['id_penghasilan']; ?>"><?= $v['label_penghasilan']; ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">Jml. Keluarga</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="number" name="jml_keluarga" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="jumlah keluarga dalam satu KK" value="<?= $biodata['jml_keluarga']; ?>" required>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
                <label for="">No Handphone (WA)</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-danger">
                    <input type="text" name="no_handphone" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="nomor handphone" value="<?= $biodata['no_handphone']; ?>" required>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
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
                    <input type="email" name="email_mustahik" class="form-control col-sm-12 col-md-12" id="id-form-field-1" placeholder="email mustahik" value="<?= $biodata['email']; ?>" required>
                    <p class="text-danger text-sm error_provinsi"><i></i></p>
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
</script>