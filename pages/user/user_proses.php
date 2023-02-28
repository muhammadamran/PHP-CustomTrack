<?php
include '../../db/db.php';
$aksi = $_GET['aksi'];

if ($aksi == 'insert') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $expired = $_POST['expired_date'];

    $insert = $db->query('INSERT INTO user (username, password, nama, email, role, expired_date) VALUES ("' . $username . '", "' . $password . '", "' . $nama . '", "' . $email . '", "' . $role . '",' . ($expired == '' || empty($expired) ? "NULL" : '"' . $expired . '"') . ')');

    if ($insert) {
        echo '<script>alert("Data berhasil ditambahkan");location.href = "../../index.php?m=user&s=user"</script>';
    } else {
        echo '<script>alert("Data gagal ditambahkan");history.go(-1)</script>';
    }
} else if ($aksi == 'update') {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $expired = $_POST['expired_date'];

    $update = $db->query('UPDATE user SET nama="' . $nama . '", email="' . $email . '", role="' . $role . '", expired_date=' . ($expired == '' || empty($expired) ? "NULL" : '"' . $expired . '"') . ' WHERE id="' . $id . '"');

    if ($update) {
        echo '<script>alert("Data berhasil diedit");location.href = "../../index.php?m=user&s=user"</script>';
    } else {
        echo '<script>alert("Data gagal diedit");history.go(-1)</script>';
    }
} else if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $hapus = $db->query('DELETE FROM user WHERE id="' . $id . '"');

    if ($hapus) {
        echo '<script>alert("Data berhasil dihapus");location.href = "../../index.php?m=user&s=user"</script>';
    } else {
        echo '<script>alert("Data gagal dihapus");history.go(-1)</script>';
    }
} else if ($aksi == 'update_password') {
    $id = $_GET['id'];
    $password = md5($_POST['password']);

    $change = $db->query('UPDATE user SET password="' . $password . '" WHERE id="' . $id . '"');

    if ($change) {
        echo '<script>alert("Password berhasil diganti");location.href = "../../index.php?m=user&s=user"</script>';
    } else {
        echo '<script>alert("Password gagal diganti");history.go(-1)</script>';
    }
}
