<?php
session_start();
include '../../db/db.php';
$aksi = $_GET['aksi'];

if ($aksi == 'insert') {
    $title = $_POST['title'];
    $created_date = date('Y-m-d H:i:s');
    $created_by = $_SESSION['id'];

    $file_name = $_FILES['gambar']['name'];
    $file_tmp =$_FILES['gambar']['tmp_name'];
    $file_type = $_FILES['gambar']['type'];
    $file_ext = '';
    if ($file_type == 'image/jpg' || $file_type == 'image/jpeg') {
        $file_ext = 'jpg';
    } else if ($file_type == 'image/png') {
        $file_ext = 'png';
    } else if ($file_type == 'image/gif') {
        $file_ext = 'gif';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }

    $file_upload = 'galeri-' . date('YmdHis') . '.' . $file_ext;

    $insert = $db->query('INSERT INTO galeri (
        gambar, 
        title, 
        created_date,
        created_by
    ) VALUES (
        "'.$file_upload.'", 
        "'.$title.'", 
        "'.$created_date.'", 
        '.$created_by.'
    )');

    if ($insert) {
        move_uploaded_file($file_tmp, "../../assets/uploads/galeri/".$file_upload);
        echo '<script>alert("Data berhasil ditambahkan");location.href = "../../index.php?m=galeri&s=galeri"</script>';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }
} else if ($aksi == 'update') {
    $id = $_GET['id'];
    $title = $_POST['title'];
    
    $file_name = $_FILES['gambar']['name'];

    if (!empty($file_name)) {
        $file_tmp =$_FILES['gambar']['tmp_name'];
        $file_type = $_FILES['gambar']['type'];
        $file_ext = '';
        if ($file_type == 'image/jpg' || $file_type == 'image/jpeg') {
            $file_ext = 'jpg';
        } else if ($file_type == 'image/png') {
            $file_ext = 'png';
        } else if ($file_type == 'image/gif') {
            $file_ext = 'gif';
        } else {
            echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
        }
    
        $file_upload = 'galeri-' . date('YmdHis') . '.' . $file_ext;

        $update = $db->query('UPDATE galeri SET gambar="'.$file_upload.'", title="'.$title.'" WHERE id="'.$id.'"');
    } else {
        $update = $db->query('UPDATE galeri SET title="'.$title.'" WHERE id="'.$id.'"');
    }

    if ($update) {
        if (!empty($file_name)) {
            move_uploaded_file($file_tmp, "../../assets/uploads/galeri/".$file_upload);
        }
        echo '<script>alert("Data berhasil diedit");location.href = "../../index.php?m=galeri&s=galeri"</script>';
    } else {
        echo '<script>alert("Data gagal diedit");history.go(-1)</script>';
    }
} else if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $hapus = $db->query('DELETE FROM galeri WHERE id="'.$id.'"');

    if ($hapus) {
        echo '<script>alert("Data berhasil dihapus");location.href = "../../index.php?m=galeri&s=galeri"</script>';
    } else {
        echo '<script>alert("Data gagal dihapus");history.go(-1)</script>';
    }
}