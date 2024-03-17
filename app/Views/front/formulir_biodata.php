<?= $this->extend("/layout/template_front.php"); ?>
<?= $this->section("konten"); ?>
<div class="row container container-plus mx-auto mt-0 mb-4 justify-content-center">
    <div class="d-sm-flex col-12 align-items-center justify-content-center mb-3 mt-4">
        <h1 class="h3 mb-0 text-gray-800">Formulir Biodata</h1>
    </div>
    <?= form_open("/pemohon/simpan_biodata_pemohon", ['class' => 'form_biodata col-md-9']); ?>
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
                <div class="col-md-3">
                    <div class="form-group has-danger">
                        <input type="text" class="form-control col-sm-12 col-md-12  border-left-info animated--grow-in" name="nik" id="nik" value="">
                        <p class="text-danger text-sm error_nik"><i></i></p>
                    </div>

                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary btn_biodata">Cek Biodata</button>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="biodata mt-1">
                <!-- tambahan/form_biodata -->
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 justify-content-right">
            <p class="text-right pt-2">
                <a href="/" class=" pt-15 pb-2 radius-round active btn btn-md btn-outline-secondary btn-h-light-secondary btn-a-secondary" role="button" aria-selected="true">
                    <span class="icon text-white-50"> <i class="fas fa-times"></i> </span> Batal
                </a>
                <button type="submit" class=" pt-15 pb-2 active radius-round btn btn-md btn-outline-warning btn-h-light-warning btn-a-warning btndaftar" role="button" aria-selected="true" disabled>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
    $('.btn_biodata').click(function() {
        var nik = $('#nik').val();
        $.ajax({
            url: "<?= site_url('dynamic/cek_form_biodata'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                nik: nik
            },
            success: function(response) {
                $('.biodata').html(response.data);
                $('.btndaftar').prop('disabled', false);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
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