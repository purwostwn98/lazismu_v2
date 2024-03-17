<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<div class="page-content container">
    <div class="page-header border-0 ">
        <h1 class="text-grey-d1 pb-0 mb-0 text-130">
            Ajuan Lembaga
        </h1>

        <!-- <div class="page-tools">
            <div class="action-buttons text-nowrap">
                <a class="btn bgc-white btn-light-secondary mx-0" href="#" data-toggle="tooltip" title="Details">
                    <i class="fa fa-search-plus text-info"></i>
                </a>
                <a class="btn bgc-white btn-light-secondary mx-0" href="#" data-toggle="tooltip" title="Print">
                    <i class="fa fa-print text-purple-m1"></i>
                </a>
                <a class="btn bgc-white btn-light-secondary mx-0" href="#" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-trash text-danger-m1"></i>
                </a>
            </div>
        </div> -->
    </div>

    <div class="row px-2 bgc-white">
        <div class="col-md-12 mt-4 mt-md-0">
            <ul class="nav nav-tabs nav-tabs-simple nav-tabs-scroll border-b-1 brc-secondary-l2 mx-n3 mx-md-0 px-3 px-md-0" role="tablist">
                <li class="nav-item">
                    <a class="nav-link brc-warning-tp2 d-style active btn_baru" id="home-tab" data-toggle="tab" href="#home0" role="tab" aria-controls="home" aria-selected="true" onclick="tabel_baru('baru_lbg')">
                        <i class="fa fa-bell text-warning-m2 mr-3px"></i>
                        <span class="d-n-active">Ajuan Baru</span>
                        <span class="d-active text-warning">Ajuan Baru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link brc-purple-tp2 d-style" id="profile-tab" data-toggle="tab" href="#profile0" role="tab" aria-controls="profile" aria-selected="false" onclick="tabel_proses('proses_lbg')">
                        <i class="fa fa-hourglass text-purple-m2 mr-3px"></i>
                        <span class="d-n-active">Dalam Proses</span>
                        <span class="d-active text-purple">Dalam Proses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link brc-blue-tp2 d-style" id="rutin-tab" data-toggle="tab" href="#rutin0" role="tab" aria-controls="rutin" aria-selected="false" onclick="tabel_rutin('rutin_lbg')">
                        <i class="fa fa-flask text-blue-m2 mr-3px"></i>
                        <span class="d-n-active">Rutin Berjalan</span>
                        <span class="d-active text-blue">Rutin Berjalan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link brc-success-tp2 d-style" id="contact-tab" data-toggle="tab" href="#contact0" role="tab" aria-controls="contact" aria-selected="false" onclick="tabel_selesai('selesai_lbg')">
                        <i class="fa fa-check-square text-success-m2 mr-3px"></i>
                        <span class="d-n-active">Selesai</span>
                        <span class="d-active text-success">Selesai</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link brc-danger-tp2 d-style" id="ditolak-tab" data-toggle="tab" href="#ditolak0" role="tab" aria-controls="ditolak" aria-selected="false" onclick="tabel_ditolak('ditolak_lbg')">
                        <i class="fa fa-times text-danger-m2 mr-3px"></i>
                        <span class="d-n-active">Selesai (Ditolak)</span>
                        <span class="d-active text-danger">Selesai (Ditolak)</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content tab-sliding px-0 mx-n3 mx-md-0">
                <div class="tab-pane show active text-95 px-3 px-md-2 baru" id="home0" role="tabpanel" aria-labelledby="home-tab">
                </div>
                <div class="tab-pane text-95 px-3 px-md-2 proses" id="profile0" role="tabpanel" aria-labelledby="profile-tab">
                </div>
                <div class="tab-pane text-95 px-3 px-md-2 rutin" id="rutin0" role="tabpanel" aria-labelledby="rutin-tab">
                </div>
                <div class="tab-pane text-95 px-3 px-md-2 selesai" id="contact0" role="tabpanel" aria-labelledby="contact-tab">
                </div>
                <div class="tab-pane text-95 px-3 px-md-2 ditolak" id="ditolak0" role="tabpanel" aria-labelledby="ditolak-tab">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    $(window).on("load", readyFn);

    function readyFn(jQuery) {
        $(document).ready(function() {
            $(".btn_baru").trigger("click");
        });
    }


    function tabel_baru(params) {
        $.ajax({
            url: "<?= site_url('admin/tabel_baru'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                jenis: params
            },
            success: function(response) {
                // console.log(response);
                $('.baru').html(response.data);
                $('.proses').html('');
                $('.rutin').html('');
                $('.selesai').html('');
                $('.ditolak').html('');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function tabel_proses(params) {
        $.ajax({
            url: "<?= site_url('admin/tabel_proses'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                jenis: params
            },
            success: function(response) {
                // console.log(response);
                $('.baru').html('');
                $('.proses').html(response.data);
                $('.rutin').html('');
                $('.selesai').html('');
                $('.ditolak').html('');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function tabel_rutin(params) {
        $.ajax({
            url: "<?= site_url('admin/tabel_rutin'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                jenis: params
            },
            success: function(response) {
                // console.log(response);
                $('.baru').html('');
                $('.proses').html('');
                $('.rutin').html(response.data);
                $('.selesai').html('');
                $('.ditolak').html('');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function tabel_selesai(params) {
        $.ajax({
            url: "<?= site_url('admin/tabel_selesai'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                jenis: params
            },
            success: function(response) {
                // console.log(response);
                $('.baru').html('');
                $('.proses').html('');
                $('.rutin').html('');
                $('.selesai').html(response.data);
                $('.ditolak').html('');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function tabel_ditolak(params) {
        $.ajax({
            url: "<?= site_url('admin/tabel_ditolak'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                jenis: params
            },
            success: function(response) {
                // console.log(response);
                $('.baru').html('');
                $('.proses').html('');
                $('.rutin').html('');
                $('.selesai').html('');
                $('.ditolak').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection(); ?>