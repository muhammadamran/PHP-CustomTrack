<?php
session_start();
include '../../db/db.php';
$aksi = $_GET['aksi'];

if ($aksi == 'insert') {
    $expired = $_POST['expired_date'];
    $link = $_POST['link'];
    $created_by = $_SESSION['id'];

    $file_name = $_FILES['image']['name'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
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

    $file_upload = 'banner-' . date('YmdHis') . '.' . $file_ext;

    $insert = $db->query('INSERT INTO banner (
        image, 
        link, 
        expired_date, 
        created_by
    ) VALUES (
        "'.$file_upload.'", 
        "'.$link.'", 
        '.($expired == '' || empty($expired) ? "NULL" : '"' . $expired . '"').', 
        '.$created_by.'
    )');

    if ($insert) {
        move_uploaded_file($file_tmp, "../../assets/uploads/banner/".$file_upload);
        echo '<script>alert("Data berhasil ditambahkan");location.href = "../../index.php?m=banner&s=banner"</script>';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }
} else if ($aksi == 'update') {
    $id = $_GET['id'];
    $expired = $_POST['expired_date'];
    $link = $_POST['link'];
    
    $file_name = $_FILES['image']['name'];

    if (!empty($file_name)) {
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
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
    
        $file_upload = 'banner-' . date('YmdHis') . '.' . $file_ext;

        $update = $db->query('UPDATE banner SET image="'.$file_upload.'", link="'.$link.'", expired_date='.($expired == '' || empty($expired) ? "NULL" : '"' . $expired . '"').' WHERE id="'.$id.'"');
    } else {
        $update = $db->query('UPDATE banner SET link="'.$link.'", expired_date='.($expired == '' || empty($expired) ? "NULL" : '"' . $expired . '"').' WHERE id="'.$id.'"');
    }

    if ($update) {
        if (!empty($file_name)) {
            move_uploaded_file($file_tmp, "../../assets/uploads/banner/".$file_upload);
        }
        echo '<script>alert("Data berhasil diedit");location.href = "../../index.php?m=banner&s=banner"</script>';
    } else {
        echo '<script>alert("Data gagal diedit");history.go(-1)</script>';
    }
} else if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $hapus = $db->query('DELETE FROM banner WHERE id="'.$id.'"');

    if ($hapus) {
        echo '<script>alert("Data berhasil dihapus");location.href = "../../index.php?m=banner&s=banner"</script>';
    } else {
        echo '<script>alert("Data gagal dihapus");history.go(-1)</script>';
    }
}