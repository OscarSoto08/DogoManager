<?php
if ($_SESSION["role"] != "Admin") {
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
    exit();
}

require_once 'Business/Breed.php';
//MODIFICACION DE TABLA BREED CON IS_ACTIVE
if (isset($_POST['id'])) {
    $breed = new Breed();
    $breed->setId($_POST['id']);

    if ($breed->deactivate()) {
        header("Location: ?pid=" . base64_encode("ui/Breed/viewBreeds.php") . "&status=success");
    } else {
        header("Location: ?pid=" . base64_encode("ui/Breed/viewBreeds.php") . "&status=fail");
    }
    exit;
}

header("Location: ?pid=" . base64_encode("ui/Breed/viewBreeds.php") . "&status=invalid");
exit;
