<div class="judul mb-2">
    <b> Syarat yang harus dilengkapi</b>
</div>

<?php if ($data_program != "") { ?>
    <div class="list_syarat">
        <ul>
            <?php foreach ($data_program as $syarat) { ?>
                <li><?= $syarat['syarat_program']; ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } else {
    echo "belum ada syarat tersimpan";
} ?>
<div class="foot">
    <i>Syarat di atas harus dilengkapi dan dijadikan dalam satu file pdf dengan diurutkan sesuai urutan yang tertera di atas. Upload file tersebut pada form di bawah ini.</i>
</div>