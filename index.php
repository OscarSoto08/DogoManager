<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DogoManager</title>

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://use.fontawesome.com/releases/v6.7.2/css/all.css"
      rel="stylesheet">
    <link href="ui/home/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" ></script>
  </head>
<?php
if (PHP_SESSION_NONE === session_status()) {
  session_start();
}


require_once 'Business/Admin.php';
require_once 'Business/Walker.php';
require_once 'Business/Owner.php';
require_once 'Persistance/Connection.php';

$no_auth_pages = [
  "ui/home/home.php",
  "ui/home/modalLogin.php",
  "ui/home/modalSignUp.php",
  "ui/failure/Forbidden403.php",
  "ui/failure/NotFound404.php",
];

$auth_pages = [
  "ui/Admin/homepage.php",
  "ui/Owner/homepage.php",
  "ui/Walker/homepage.php",
];


if(empty($_GET["pid"])) {
  include "ui/home/home.php";
}else{
  $pid = base64_decode($_GET["pid"]);
  if (in_array($pid, $no_auth_pages)) {
    include $pid;
  } elseif (in_array($pid, $auth_pages)) {
    if(!isset($_SESSION["userID"])) {
      include "ui/home/home.php";
    } else{
      include $pid;
    }
  } else {
    include "ui/failure/NotFound404.php";
  }
}
?>
  <!-- Bootstrap JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>