<?php
session_start();
include '../../db/db.php';
$aksi = $_GET['aksi'];

if ($aksi == 'insert') {
    $podcast = $_POST['podcast'];
    $created_by = $_SESSION['id'];

    $insert = $db->query("INSERT INTO podcast (
        podcast, 
        created_by
    ) VALUES (
        '".$podcast."', 
        ".$created_by."
    )");

    if ($insert) {
        echo '<script>alert("Data berhasil ditambahkan");location.href = "../../index.php?m=podcast&s=podcast"</script>';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }
} else if ($aksi == 'update') {
    $id = $_GET['id'];
    $podcast = $_POST['podcast'];

    $update = $db->query("UPDATE podcast SET podcast='".$podcast."' WHERE id=".$id."");

    if ($update) {
        echo '<script>alert("Data berhasil diedit");location.href = "../../index.php?m=podcast&s=podcast"</script>';
    } else {
        echo '<script>alert("Data gagal diedit");history.go(-1)</script>';
    }
} else if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $hapus = $db->query('DELETE FROM podcast WHERE id="'.$id.'"');

    if ($hapus) {
        echo '<script>alert("Data berhasil dihapus");location.href = "../../index.php?m=podcast&s=podcast"</script>';
    } else {
        echo '<script>alert("Data gagal dihapus");history.go(-1)</script>';
    }
}