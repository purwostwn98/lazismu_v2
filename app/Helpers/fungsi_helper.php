<?php
function terbilang($angka)
{
    $bilangan = array(
        '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'
    );

    if ($angka < 12) {
        return $bilangan[$angka];
    } elseif ($angka < 20) {
        return $bilangan[$angka - 10] . ' belas';
    } elseif ($angka < 100) {
        return $bilangan[($angka / 10)] . ' puluh ' . $bilangan[$angka % 10];
    } elseif ($angka < 200) {
        return ' seratus ' . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        return $bilangan[($angka / 100)] . ' ratus ' . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        return ' seribu ' . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        return terbilang($angka / 1000) . ' ribu ' . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        return terbilang($angka / 1000000) . ' juta ' . terbilang($angka % 1000000);
    } else {
        return 'Angka terlalu besar';
    }
}

function printr($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit;
}

// Api get data dosen
function konek_star($param)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://star.ums.ac.id/abubakar/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $param,
        CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=5lkql9uog08qo2cvmuvjjvvii7fkqukm'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response = json_decode($response, true);
    return $response;
}

function token_star()
{
    $token_api =  konek_star(array('act' => 'GetToken', 'username' => 'wur115', 'password' => 'a'));
    return $token_api['token'];
}

function get_dosen_akademik()
{
    $token = token_star();
    $data =  konek_star(array('token' => $token, 'act' => 'ListDosen'));
    return $data['rows'];
}

function getNamaHari($date)
{
    $daysOfWeek = array(
        "Sunday" => "Minggu",
        "Monday" => "Senin",
        "Tuesday" => "Selasa",
        "Wednesday" => "Rabu",
        "Thursday" => "Kamis",
        "Friday" => "Jumat",
        "Saturday" => "Sabtu"
    );
    $dayName = date('l', strtotime($date));
    return $daysOfWeek[$dayName];
}
