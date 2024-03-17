<html>

<head>
    <style>
        .pernyataan th {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .pernyataan td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 13px;
        }

        .body_table td {
            font-size: 13px;
        }
    </style>
</head>
<?php
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

<?php $tgl_ml = explode('-', $surat_tugas['tanggal_mulai']); ?>
<?php $tgl_sl = explode('-', $surat_tugas['tanggal_selesai']); ?>

<body>
    <br>
    <table cellpadding="1" style="width:100%">
        <tr>
            <td style="text-align: left;" rowspan="3" style="width: 20%;">
                <img width="100px" src="/assets/favicon.png" alt="">
            </td>
            <td style="width: 80%; text-align: left; font-size: 15px;"><strong>LAZISMU</strong></td>
        </tr>
        <tr>
            <td style="font-size: 15px; text-align: left;"><strong>UNIVERSITAS MUHAMMADIYAH SURAKARTA</strong></td>
        </tr>
        <tr>
            <td style="font-size: 10px; text-align: left;">Gedung A Lt 1 (Kampus 1 UMS) Jl. A. Yani Tromol Pos1, Pabelan, Kartasura, Sukoharjo <br>email: lazismu@ums.ac.id Telp. (0271) 717417 ext. 2282, Hp/Wa: 085363766667 <br>
            </td>
        </tr>
    </table>
    <hr style="margin-top: 2px;">
    <table class="judul" style="width: 100%;">
        <tr>
            <td style="text-align: center; font-size: 15px;"><br><br><strong>SURAT TUGAS</strong></td>
        </tr>
        <tr>
            <td style="font-size: 10px; text-align: center;">Nomor Ajuan: <?= $data_ajuan['nomor_ajuan']; ?></td>
        </tr>
    </table>
    <p style="font-size: 13px" align="justify">Yang bertanda tangan di bawah ini</p>
    <table class="body_table" cellpadding="2" style="width:100%">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td style="width: 2%">:</td>
            <td style="width: 69%;"><?= $surat_tugas['nama_penanggung_jawab']; ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?= $surat_tugas['jabatan']; ?></td>
        </tr>
        <tr>
            <td>Berdasarkan</td>
            <td>:</td>
            <td><?= $surat_tugas['berdasarkan']; ?>
                <?php if ($surat_tugas['berdasarkan'] == 'Rapat Pengurus' && $data_ajuan['status_ajuan'] >= 3) { ?>
                    <?php
                    $waktu = explode(' ', $tanggal_rapat);
                    $tgl = explode('-', $waktu[0])
                    ?>
                    pada tanggal <b><?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?></b>
                <?php } ?></td>
        </tr>
        <tr>
            <td>Memberikan tugas kepada</td>
            <td>:</td>
            <td>
                <ol>
                    <?php foreach ($nama_delegasi as $d => $dlg) { ?><li><?= $dlg['nama_delegasi']; ?></li><?php } ?>
                </ol>
            </td>
        </tr>
        <tr>
            <td>Dengan agenda</td>
            <td>:</td>
            <td><?= $surat_tugas['agenda']; ?></td>
        </tr>
        <tr>
            <td colspan="3">Pada tanggal <b><?= $tgl_ml[2] . ' ' . $bulan[(int)$tgl_ml[1]] . ' ' . $tgl_ml[0]; ?></b> s/d <b><?= $tgl_sl[2] . ' ' . $bulan[(int)$tgl_sl[1]] . ' ' . $tgl_sl[0]; ?></b> di <b><?= $surat_tugas['lokasi']; ?></b></td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
    </table>

    <table class="pernyataan" cellpadding="10" style="width:100%">
        <tr>
            <td style="width: 60%">
                1.
            </td>
            <td style="width: 20%;">
                1.
            </td>
            <td style="width: 20%;">

            </td>
        </tr>
        <tr>
            <td>
                2.
            </td>
            <td>

            </td>
            <td>
                2.
            </td>
        </tr>
        <tr>
            <td>
                3.
            </td>
            <td>
                3.
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                4.
            </td>
            <td>

            </td>
            <td>
                4.
            </td>
        </tr>
        <tr>
            <td>
                5.
            </td>
            <td>
                5.
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                6.
            </td>
            <td>

            </td>
            <td>
                6.
            </td>
        </tr>
    </table>
    <br>
    <p style="font-size: 13px;">Demikian Surat Tugas ini dibuat untuk dipergunakan sebagaiman mestinya</p>
    <table style="font-size: 13px;">
        <tr>
            <td style="width: 40%;">

            </td>
            <td style="width: 20%;"></td>
            <td style="width: 40%; text-align: center;">Surakarta,_________________ <br> </td>
        </tr>
        <tr>
            <td>
                <br>
                <br>
                <br>
                <br>
                <br>
            </td>
            <td></td>
            <td>
                <br>
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;"></td>
            <td></td>
            <td style="text-align: center;"><?= $surat_tugas['nama_penanggung_jawab']; ?></td>
        </tr>
    </table>
</body>

</html>