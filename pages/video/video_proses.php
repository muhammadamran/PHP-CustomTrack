<?php
include '../../db/db.php';
$aksi = $_GET['aksi'];

if ($aksi == 'insert') {
    $title = $_POST['title'];
    $video = $_POST['video'];
    
    $insert = $db->query('INSERT INTO video (title,video) VALUES ("'.$title.'","'.$video.'")');

    if ($insert) {
        echo '<script>alert("Data berhasil ditambahkan");location.href = "../../index.php?m=video&s=video"</script>';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }
} else if ($aksi == 'update') {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $video = $_POST['video'];
    
    $update = $db->query('UPDATE video SET title="'.$title.'", video="'.$video.'" WHERE id="'.$id.'"');

    if ($update) {
        echo '<script>alert("Data berhasil diedit");location.href = "../../index.php?m=video&s=video"</script>';
    } else {
        echo '<script>alert("Data gagal diedit");history.go(-1)</script>';
    }
} else if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $hapus = $db->query('DELETE FROM video WHERE id="'.$id.'"');

    if ($hapus) {
        echo '<script>alert("Data berhasil dihapus");location.href = "../../index.php?m=video&s=video"</script>';
    } else {
        echo '<script>alert("Data gagal dihapus");history.go(-1)</script>';
    }
}