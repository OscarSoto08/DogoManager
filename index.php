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

$offline_pages = [
  "ui/home/home.php",
];

$online_pages = [
];


if(empty($_GET["pid"])) {
  include "ui/home/home.php";
}else{
  $pid = base64_decode($_GET["pid"]);
  if (in_array($pid, $offline_pages)) {
    include $pid;
  } elseif (in_array($pid, $online_pages)) {
    if(!isset($_SESSION["idUser"])) {
      
    } else{
      include $pid;
    }
  } else {
    echo "<h1 class='text-center text-danger'>Page not found</h1>";
  }
}
?>
  <!-- Bootstrap JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>