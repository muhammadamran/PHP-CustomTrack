<?php
session_start();
include '../../db/db.php';
$aksi = $_GET['aksi'];

if ($aksi == 'insert') {
    $title = $_POST['title'];
    $tipe = $_POST['tipe'];
    $kategori_id = $_POST['kategori_id'];
    $sinopsis = $_POST['sinopsis'];
    $content = $_POST['content'];
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

    $file_upload = 'blog-' . date('YmdHis') . '.' . $file_ext;

    $insert = $db->query('INSERT INTO blog (
        image, 
        title, 
        tipe, 
        kategori_id, 
        sinopsis,
        content, 
        created_by
    ) VALUES (
        "'.$file_upload.'", 
        "'.$title.'", 
        "'.$tipe.'", 
        "'.$kategori_id.'", 
        "'.$sinopsis.'", 
        "'.$content.'", 
        '.$created_by.'
    )');

    if ($insert) {
        move_uploaded_file($file_tmp, "../../assets/uploads/blog/".$file_upload);
        echo '<script>alert("Data berhasil ditambahkan");location.href = "../../index.php?m=blog&s=blog"</script>';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }
} else if ($aksi == 'update') {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $tipe = $_POST['tipe'];
    $kategori_id = $_POST['kategori_id'];
    $sinopsis = $_POST['sinopsis'];
    $content = $_POST['content'];
    $updated_date = date('Y-m-d H:i:s');
    $updated_by = $_SESSION['id'];
    
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
    
        $file_upload = 'blog-' . date('YmdHis') . '.' . $file_ext;

        $update = $db->query('UPDATE blog SET image="'.$file_upload.'", title="'.$title.'", tipe="'.$tipe.'", kategori_id="'.$kategori_id.'", content="'.$content.'", sinopsis="'.$sinopsis.'", updated_date="'.$updated_date.'", updated_by="'.$updated_by.'" WHERE id="'.$id.'"');
    } else {
        $update = $db->query('UPDATE blog SET title="'.$title.'", tipe="'.$tipe.'", kategori_id="'.$kategori_id.'", content="'.$content.'", sinopsis="'.$sinopsis.'", updated_date="'.$updated_date.'", updated_by="'.$updated_by.'" WHERE id="'.$id.'"');
    }

    if ($update) {
        if (!empty($file_name)) {
            move_uploaded_file($file_tmp, "../../assets/uploads/blog/".$file_upload);
        }
        echo '<script>alert("Data berhasil diedit");location.href = "../../index.php?m=blog&s=blog"</script>';
    } else {
        echo '<script>alert("Data gagal diedit");history.go(-1)</script>';
    }
} else if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $hapus = $db->query('DELETE FROM blog WHERE id="'.$id.'"');

    if ($hapus) {
        echo '<script>alert("Data berhasil dihapus");location.href = "../../index.php?m=blog&s=blog"</script>';
    } else {
        echo '<script>alert("Data gagal dihapus");history.go(-1)</script>';
    }
}