<?php
session_start();
include '../../db/db.php';
$aksi = $_GET['aksi'];

if ($aksi == 'insert') {
    $nama_file = $_POST['nama_file'];
    $created_by = $_SESSION['id'];

    $file_name = $_FILES['file']['name'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_ext = '';
    if ($file_type == 'image/jpg' || $file_type == 'image/jpeg') {
        $file_ext = 'jpg';
    } else if ($file_type == 'image/png') {
        $file_ext = 'png';
    } else if ($file_type == 'image/gif') { 
        $file_ext = 'gif';
    } else if ($file_type == 'application/pdf') {
        $file_ext = 'pdf';
    } else if ($file_type == 'application/msword') {
        $file_ext = 'doc';
    } else if ($file_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
        $file_ext = 'docx';
    } else if ($file_type == 'application/vnd.ms-excel') {
        $file_ext = 'xls';
    } else if ($file_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
        $file_ext = 'xlsx';
    } else if ($file_type == 'application/vnd.ms-powerpoint') {
        $file_ext = 'ppt';
    } else if ($file_type == 'application/vnd.openxmlformats-officedocument.presentationml.presentation') {
        $file_ext = 'pptx';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }

    $file_upload = 'repo-' . date('YmdHis') . '.' . $file_ext;

    $insert = $db->query('INSERT INTO repo (
        file, 
        nama_file
    ) VALUES (
        "'.$file_upload.'", 
        "'.$nama_file.'"
    )');

    if ($insert) {
        move_uploaded_file($file_tmp, "../../assets/uploads/repo/".$file_upload);
        echo '<script>alert("Data berhasil ditambahkan");location.href = "../../index.php?m=repo&s=repo"</script>';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }
} else if ($aksi == 'update') {
    $id = $_GET['id'];
    $nama_file = $_POST['nama_file'];
    
    $file_name = $_FILES['file']['name'];

    if (!empty($file_name)) {
        $file_tmp =$_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_ext = '';
        if ($file_type == 'image/jpg' || $file_type == 'image/jpeg') {
            $file_ext = 'jpg';
        } else if ($file_type == 'image/png') {
            $file_ext = 'png';
        } else if ($file_type == 'image/gif') {
            $file_ext = 'gif';
        } else if ($file_type == 'application/pdf') {
            $file_ext = 'pdf';
        } else if ($file_type == 'application/msword') {
            $file_ext = 'doc';
        } else if ($file_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            $file_ext = 'docx';
        } else if ($file_type == 'application/vnd.ms-excel') {
            $file_ext = 'xls';
        } else if ($file_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            $file_ext = 'xlsx';
        } else if ($file_type == 'application/vnd.ms-powerpoint') {
            $file_ext = 'ppt';
        } else if ($file_type == 'application/vnd.openxmlformats-officedocument.presentationml.presentation') {
            $file_ext = 'pptx';
        } else {
            echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
        }
    
        $file_upload = 'repo-' . date('YmdHis') . '.' . $file_ext;

        $update = $db->query('UPDATE repo SET file="'.$file_upload.'", nama_file="'.$nama_file.'" WHERE id="'.$id.'"');
    } else {
        $update = $db->query('UPDATE repo SET nama_file="'.$nama_file.'" WHERE id="'.$id.'"');
    }

    if ($update) {
        if (!empty($file_name)) {
            move_uploaded_file($file_tmp, "../../assets/uploads/repo/".$file_upload);
        }
        echo '<script>alert("Data berhasil diedit");location.href = "../../index.php?m=repo&s=repo"</script>';
    } else {
        echo '<script>alert("Data gagal diedit");history.go(-1)</script>';
    }
} else if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $hapus = $db->query('DELETE FROM repo WHERE id="'.$id.'"');

    if ($hapus) {
        echo '<script>alert("Data berhasil dihapus");location.href = "../../index.php?m=repo&s=repo"</script>';
    } else {
        echo '<script>alert("Data gagal dihapus");history.go(-1)</script>';
    }
}