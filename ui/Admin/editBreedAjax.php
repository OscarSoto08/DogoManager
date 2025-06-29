<?php
if ($_SESSION["role"] != "Admin") {
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
    exit();
}

require_once 'Business/Breed.php';

if (isset($_POST['id'], $_POST['name'], $_POST['size'])) {
    $id   = intval($_POST['id']);
    $name = trim($_POST['name']);
    $size = trim($_POST['size']);

    $breed = new Breed($id, $name, $size);

    if ($breed->update()) {
        header("Location: ?pid=" . base64_encode("ui/Admin/viewBreeds.php") . "&status=success");
    } else {
        header("Location: ?pid=" . base64_encode("ui/Admin/viewBreeds.php") . "&status=fail");
    }
    exit;
}


header("Location: ?pid=" . base64_encode("ui/Admin/viewBreeds.php") . "&status=invalid");
exit;