<?php

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ?pid=' . base64_encode('ui/home/home.php'));
    exit;
}
$admin = new Admin($_SESSION["userID"]);
$admin -> retrieve();


$root = dirname(__DIR__, 2);
set_include_path(get_include_path() . PATH_SEPARATOR . $root);
require_once 'Business/Walker.php';

if (
    isset($_POST['id'], $_POST['name'], $_POST['lastName'],
          $_POST['email'], $_POST['ratePerHour'], $_POST['description'])
) {
    $walker = new Walker(
        id:          (int)$_POST['id'],
        name:        trim($_POST['name']),
        lastName:    trim($_POST['lastName']),
        email:       trim($_POST['email']),
        ratePerHour: (float)$_POST['ratePerHour'],
        description: trim($_POST['description'])
    );


if ($walker->update()) {
    header('Location: ?pid=' . base64_encode('ui/Admin/viewAllWalkers.php') . '&status=success');
} else {
    header('Location: ?pid=' . base64_encode('ui/Admin/viewAllWalkers.php') . '&status=fail');
}
exit;

}

header('Location: ?pid=' . base64_encode('ui/Admin/viewAllWalkers.php') . '&status=success');
exit;
