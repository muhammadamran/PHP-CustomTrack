<?php
session_start();
include "db/db.php";

$url = $_SERVER['REQUEST_URI'];
$get_api = explode('/', $url);

if ($get_api[1] == 'api') {
  include $get_api[1] . '/' . $get_api[2] . '.php';
} else {
  if (!empty($_SESSION['role'])) {
    include "include/head.php";
    include "include/sidebar.php";
    include "include/header.php";

    if (empty($_GET['m']) and empty($_GET['s'])) {
      include "pages/home/home.php";
    } else if ($_GET['m'] != "" and $_GET['s'] != "") {
      if (file_exists("pages/" . $_GET['m'] . "/" . $_GET['s'] . ".php")) {
        include "pages/" . $_GET['m'] . "/" . $_GET['s'] . ".php";
      } else {
        include "notfound.php";
      }
    }

    include "include/footer.php";
  } else {
    include "login.php";
  }
}
