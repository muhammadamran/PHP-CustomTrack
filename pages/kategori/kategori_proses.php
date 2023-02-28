<?php
include '../../db/db.php';
$aksi = $_GET['aksi'];

if ($aksi == 'insert') {
    $nama_kategori = $_POST['nama_kategori'];
    
    $insert = $db->query('INSERT INTO kategori (nama_kategori) VALUES ("'.$nama_kategori.'")');

    if ($insert) {
        echo '<script>alert("Data berhasil ditambahkan");location.href = "../../index.php?m=kategori&s=kategori"</script>';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }
} else if ($aksi == 'update') {
    $id = $_GET['id'];
    $nama_kategori = $_POST['nama_kategori'];
    
    $update = $db->query('UPDATE kategori SET nama_kategori="'.$nama_kategori.'" WHERE id="'.$id.'"');

    if ($update) {
        echo '<script>alert("Data berhasil diedit");location.href = "../../index.php?m=kategori&s=kategori"</script>';
    } else {
        echo '<script>alert("Data gagal diedit");history.go(-1)</script>';
    }
} else if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $hapus = $db->query('DELETE FROM kategori WHERE id="'.$id.'"');

    if ($hapus) {
        echo '<script>alert("Data berhasil dihapus");location.href = "../../index.php?m=kategori&s=kategori"</script>';
    } else {
        echo '<script>alert("Data gagal dihapus");history.go(-1)</script>';
    }
}