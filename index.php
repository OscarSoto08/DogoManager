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
    <link rel="icon" href="img/logo.png">
    <link href="https://use.fontawesome.com/releases/v6.7.2/css/all.css"
      rel="stylesheet">
    <link href="ui/home/style.css" rel="stylesheet">
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <!-- jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
<?php
if (PHP_SESSION_NONE === session_status()) {
  session_start();
}

// Include necessary business files
foreach(array_diff(scandir('Business'), ['.', '..']) as $file) {
  if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    require_once "Business/$file";
  }
}

require_once 'Persistance/Connection.php';

$no_auth_pages = [
  "ui/home/home.php",
  "ui/home/modalLogin.php",
  "ui/home/modalSignUp.php",
  "ui/failure/Forbidden403.php",
  "ui/failure/NotFound404.php",
  "ui/home/verifyCode.php",
];

$auth_pages = [
  "ui/Admin/homepage.php",
  "ui/Owner/homepage.php",
  "ui/Owner/chooseWalker.php",
  "ui/Walker/homepage.php",
  "ui/Admin/searchWalkers.php",
  "ui/Admin/createWalker.php",
  "ui/Admin/viewAllWalkers.php",
  "ui/Admin/editWalker.php",
  "ui/Admin/editWalkerAjax.php",
  "ui/Admin/viewBreeds.php",
  "ui/Admin/editBreedAjax.php",
  "ui/Admin/deactivateBreed.php",
  "ui/Admin/createBreed.php",
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

</html>