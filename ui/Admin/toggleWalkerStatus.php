<?php
header('Content-Type: application/json');

// Calculate the project root directory
$root = dirname(__DIR__, 2);

// Add the root path to the PHP include path so require_once can find the file
set_include_path(get_include_path() . PATH_SEPARATOR . $root);

// Now we can include files using paths relative to the project root
require_once 'Business/Walker.php';

// Check if both required POST parameters are present
if (isset($_POST['id'], $_POST['isActive'])) {
    $id       = intval($_POST['id']);
    $newState = ($_POST['isActive'] == '1');

    $walker = new Walker(id: $id);
    $walker->setActive($newState);
    // If the update was successful
    if ($walker->updateStatus()) {
        echo json_encode([
            'success'  => true,
            'isActive' => $newState ? 1 : 0
        ]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

// If the request was malformed or missing data
echo json_encode(['success' => false]);
