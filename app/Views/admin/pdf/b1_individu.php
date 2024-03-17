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

<?php
$tgl2 = explode('-', $data_individu['tgl_lahir']);
$datetime = explode(' ', $tanggal_now);
$tgl_now =  explode('-', $datetime[0]);
?>

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
            <td rowspan="2" style="width: 20%;"></td>
            <td style="text-align: center; font-size: 14px; width:60%;"><br><br><strong>FORMULIR PENDAFTARAN MUSTAHIK</strong></td>
            <td rowspan="2" style="text-align: right; width: 20%; font-size: 11px"><b>B1</b></td>
        </tr>
    </table>
    <br>
    <br>
    <span style="font-size: 11px" align="justify"><i>Data Pribadi</i></span>
    <br>
    <table class="body_table" cellpadding="2" style="width:100%">
        <tr>
            <td style="width: 5%;"></td>
            <td style="width: 30%;">Nomor Registrasi</td>
            <td style="width: 2%">:</td>
            <td style="width: 64%;"><b><?= $ajuan['nomor_ajuan']; ?></b></td>
        </tr>
        <tr>
            <td></td>
            <td>Nomor KK</td>
            <td>:</td>
            <td><?= $data_individu['kk']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Nomor NIK KTP</td>
            <td>:</td>
            <td><?= $data_individu['nik']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td><?= $data_individu['nama_mustahik']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Tempat, Tanggal Lahir</td>
            <td>:</td>
            <?php if (!empty($data_individu['tgl_lahir'])) { ?>
                <td><?= $data_individu['tempat_lahir']; ?>, <?= $tgl2[2] . ' ' . $bulan[(int)$tgl2[1]] . ' ' . $tgl2[0]; ?></td>
            <?php  } ?>
        </tr>
        <tr>
            <td></td>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $data_individu['alamat']; ?> <br><?= $data_individu['nama_kelurahan']; ?>, <?= $data_individu['nama_kecamatan']; ?>, <?= $data_individu['nama_kabupaten']; ?>, <?= $data_individu['nama_provinsi']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?= $data_individu['kelamin_mustahik']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Agama</td>
            <td>:</td>
            <td><?= $data_individu['agama_mustahik']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Status Marital</td>
            <td>:</td>
            <td><?= $data_individu['status_marital']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Status Pendidikan</td>
            <td>:</td>
            <td><?= $data_individu['status_pendidikan']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Pekerjaan</td>
            <td>:</td>
            <td><?= $data_individu['nama_pekerjaan']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Penghasilan</td>
            <td>:</td>
            <td><?= $data_individu['label_penghasilan']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>No Telp.</td>
            <td>:</td>
            <td><?= $data_individu['no_handphone']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Email</td>
            <td>:</td>
            <td><?= $data_individu['email']; ?></td>
        </tr>
    </table>

    <!-- Detail pengajuan -->
    <br>
    <br>
    <span style="font-size: 11px" align="justify"><i>Detail Pengajuan</i></span>
    <br>
    <table class="body_table" cellpadding="2" style="width:100%">
        <tr>
            <td style="width: 5%;"></td>
            <td style="width: 30%;">Program Bantuan</td>
            <td style="width: 2%">:</td>
            <td style="width: 64%;"><b><?= $ajuan['nama_kategori']; ?></b><br><?= $ajuan['nama_program']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Deskripsi Ajuan (Keperluan)</td>
            <td>:</td>
            <td><?= $ajuan['deskripsi_ajuan']; ?></td>
        </tr>
    </table>

    <!-- Persyaratan -->
    <br>
    <br>
    <span style="font-size: 11px" align="justify"><i>Persyaratan</i></span>
    <br>
    <?php if (!empty($syarat)) { ?>
        <table class="body_table" cellpadding="2" style="width:100%">
            <?php foreach ($syarat as $s) { ?>
                <tr>
                    <td style="width: 5%;"></td>
                    <td style="width: 10;">- </td>
                    <td style="width: 64%;"><?= $s['syarat_program']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else {
        echo "belum ada syarat tersimpan";
    } ?>

    <table style="font-size: 13px;">
        <tr>
            <td style="width: 40%; text-align: center;">
                <br><br><br>Petugas
            </td>
            <td style="width: 20%;"></td>
            <td style="width: 40%; text-align: center;">Surakarta, <?= $tgl_now[2] . ' ' . $bulan[(int)$tgl_now[1]] . ' ' . $tgl_now[0]; ?><br><br>Pemohon</td>
        </tr>
        <tr>
            <td>
                <br>
                <br>
                <br>
            </td>
            <td></td>
            <td>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">_____________________</td>
            <td></td>
            <td style="text-align: center;">_____________________</td>
        </tr>
    </table>
</body>

</html>