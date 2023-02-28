<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "custom_track";

$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

class helpers
{
    function dateIndonesia($date)
    {
        $result = '';
        if (!empty($date) && $date !== '0000-00-00') {
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl   = substr($date, 8, 2);

            $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
        }
        return $result;
    }

    function dateTimeIndonesia($date)
    {
        $result = '';
        if (!empty($date) && $date !== '0000-00-00 00:00:00') {
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl   = substr($date, 8, 2);

            $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun . ' - ' . substr($date, 11, 19);
        }
        return $result;
    }

    function berita($content)
    {
        $isi = strip_tags($content);
        if (strlen($isi) > 80) {
            $berita = substr($isi, 0, 80) . ' ...';
        } else {
            $berita = $content;
        }

        return $berita;
    }

    function hargaRupiah($harga)
    {
        return "Rp. " . number_format($harga, 0, ',', '.');
    }
}

$helpers = new helpers();
