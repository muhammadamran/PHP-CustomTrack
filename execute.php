<!-- Script -->
<?php
session_start();
include 'db/db.php';

function login($data)
{
    if ($data['password_hash'] == $data['password']) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['branch'] = $data['branch'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = $data['role'];
        return 2;
    } else return 1;
}

if (isset($_POST["username"])) {
    $username_ = $db->real_escape_string($_POST["username"]);
} else {
    $username_ = "";
}
if (isset($_POST["password"])) {
    $password_ = $db->real_escape_string($_POST["password"]);
} else {
    $password_ = "";
}

$user = $db->query("SELECT id, password, name, branch, email, role FROM tb_users WHERE username='" . $username_ . "' AND password='" . md5($password_) . "'", 0);
$result = $user->fetch_assoc();
$id = $result['id'];
$password = $result['password'];
$name = $result['name'];
$branch = $result['branch'];
$email = $result['email'];
$role = $result['role'];

if ($role == 'admin') {
    $data = [
        'id' => $id,
        'name' => $name,
        'password' => $password,
        'password_hash' => md5($password_),
        'branch' => $branch,
        'email' => $email,
        'role' => $role,
    ];

    $loginArea = login($data);

    if ($loginArea == 2) {
        echo '<script>alert("Hai, ' . $name . '. you have successfully logged in");location.href = "index.php"</script>';
    } else if ($loginArea == 1) {
        echo '<script>alert("Failed Login");window.history.go(-1);</script>';
    }
} else {
    echo '<script>alert("Failed Login, You dont have access");window.history.go(-1);</script>';
}
?>
<!-- End Script -->