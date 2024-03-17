<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<?php
$session = \Config\Services::session();

use CodeIgniter\I18n\Time;

$bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
?>
<div class="page-content container">
    <div style="border-radius: 10px;" class="row justify-content-between bgc-secondary py-3">
        <div class="col-6">
            <h1 class="page-title text-dark">
                <i class="fas fa-download"></i>
                Data Penghimpunan
            </h1>
        </div>
        <div class="col-6">
            <input type="hidden" class="csrf_input" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <select class="filterbulan" name="filterbln" onchange="loadData()">
                <option value="" disabled></option>
                <?php for ($i = 1; $i < 13; $i++) {  ?>
                    <option <?= ($bln == $i) ? 'selected' : ''; ?> value="<?= $i; ?>"><?= $bulan[$i]; ?></option>
                <?php  } ?>
            </select>
            <input type="number" name="tahun" id="" class="filtertahun" value="<?= $tahun; ?>" onchange="loadData()">
            <a href="#" id="ekspor" class="btn btn-sm btn-success">Export Excel</a>
        </div>
    </div>
    <div class="row py-2 justify-content-between">
        <div class="col-8">
            <span class="judul" style="font-size: 15px;">Penghimpunan --</span>
        </div>
        <div class="col-4">
            <a href="/admin/form_penghimpunan" class="btn btn-sm btn-primary">Tambah Data Penghimpunan</a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <?php if ($session->getFlashdata('gagal')) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $session->getFlashdata('gagal'); ?>
                </div>
            <?php } elseif ($session->getFlashdata('berhasil')) { ?>
                <div class="alert alert-success" role="alert">
                    <?= $session->getFlashdata('berhasil'); ?>
                </div>
            <?php  } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11">
            <div style="max-width:100%" class="card brc-success-tp2">
                <div class="p-0 initabel">

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        var bulan = $(".filterbulan").val();
        var tahun = $(".filtertahun").val();
        dataTabel(bulan, tahun);
        $(".judul").html("Penghimpunan " + bulan + "-" + tahun);
        $("#ekspor").attr("href", "/admin/export_penghimpunan?bulan=" + bulan + "&tahun=" + tahun);
    });
</script>
<script>
    //Menghilangkan Alert
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $('#peringatan').css('display', 'none');
        });
    }, 5000);
</script>

<script>
    function loadData() {
        var bulan = $(".filterbulan").val();
        var tahun = $(".filtertahun").val();
        $(".judul").html("Penghimpunan " + bulan + "-" + tahun);
        $("#ekspor").attr("href", "/admin/export_penghimpunan?bulan=" + bulan + "&tahun=" + tahun);
        dataTabel(bulan, tahun);
    }


    function dataTabel(bulan, tahun) {
        $.ajax({
            url: "<?= site_url('dynamic/load_tabel_himpun'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                bulan: bulan,
                tahun: tahun
            },
            dataType: "json",
            beforeSend: function() {
                $('.initabel').html('Sedang loading ... ');
            },
            complete: function() {},
            success: function(response) {
                $(".initabel").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }
</script>

<?= $this->endSection(); ?>