<div class="row bg-white darker py-1">
    <div class="col-md-4">
        <label for="">
            <b>Alasan / catatan</b>
        </label>
    </div>
    <div class="col-md-8">
        <textarea name="catatan" class="form-control" id="id-textarea-autosize" placeholder="catatan (opsional)" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 86px;"></textarea>
    </div>
</div>


<?php if ($jenis == 2) { ?>
    <hr class="m-0 p-1">
    <div class="row bg-white darker py-1">
        <div class="col-md-4">
            <label for="">
                <b>Jadwal Agenda Rapat</b>
            </label>
        </div>
        <div class="col-md-8">
            <input name="tanggal" type="date" class="form-control" id="rtr" placeholder="Rencana Tanggal Rapat" required>
        </div>
    </div>
<?php } ?>

<?php if ($jenis == 3) { ?>
    <hr class="m-0 p-1">
    <div class="row bg-white darker py-1">
        <div class="col-md-4">
            <label for="">
                <b>Tanggal Rapat</b>
            </label>
        </div>
        <div class="col-md-8">
            <input name="tanggal" type="date" class="form-control" id="tr" placeholder="Tanggal Rapat" required>
        </div>
    </div>
<?php } ?>

<?php if ($jenis == 4) { ?>
    <hr class="m-0 p-1">
    <div class="row bg-white darker py-1">
        <div class="col-md-4">
            <label for="">
                <b>Jadwal Agenda Survey</b>
            </label>
        </div>
        <div class="col-md-8">
            <input name="tanggal" type="date" class="form-control" id="tr" placeholder="Agenda Survey" required>
        </div>
    </div>
<?php } ?>

<?php if ($jenis == 5) { ?>
    <hr class="m-0 p-1">
    <div class="row bg-white darker py-1">
        <div class="col-md-4">
            <label for="">
                <b>Tanggal Survey</b>
            </label>
        </div>
        <div class="col-md-8">
            <input name="tanggal" type="date" class="form-control" id="tr" placeholder="Tanggal Survey" required>
        </div>
    </div>
<?php } ?>

<?php if (($jenis == 7) || ($jenis == 8)) { ?>
    <div class="row bg-white darker py-1">
        <div class="col-md-4">
            <label for="">
                <b>Nilai bantuan disetujui</b>
            </label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nilai_disetujui" id="inputku" placeholder="-" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required>
        </div>
    </div>
<?php } ?>
<input type="hidden" value="<?= $jenis; ?>" name="status_ajuan">

<script type="text/javascript" src="<?= base_url(); ?>/application/js/ribuanNominal.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/node_modules/autosize/dist/autosize.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/node_modules/bootstrap-maxlength/bootstrap-maxlength.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>/node_modules/inputmask/dist/jquery.inputmask.js"></script>


<script type="text/javascript" src="<?= base_url(); ?>/node_modules/nouislider/distribute/nouislider.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/node_modules/ion-rangeslider/js/ion.rangeSlider.js"></script>


<script type="text/javascript" src="<?= base_url(); ?>/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>


<script type="text/javascript" src="<?= base_url(); ?>/node_modules/tiny-date-picker/dist/date-range-picker.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/node_modules/moment/moment.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/node_modules/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>


<script type="text/javascript" src="<?= base_url(); ?>/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>/node_modules/es6-object-assign/dist/object-assign-auto.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/node_modules/@jaames/iro/dist/iro.js"></script>


<script type="text/javascript" src="<?= base_url(); ?>/node_modules/jquery-knob/dist/jquery.knob.min.js"></script>


<!-- include Ace script -->
<script type="text/javascript" src="<?= base_url(); ?>/dist/js/ace.js"></script>


<script type="text/javascript" src="<?= base_url(); ?>/assets/js/demo.js"></script>
<!-- this is only for Ace's demo and you don't need it -->

<!-- "Form Elements" page script to enable its demo functionality -->
<script type="text/javascript" src="<?= base_url(); ?>/application/views/default/pages/partials/form-elements/@page-script.js"></script>