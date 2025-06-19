<?php
// createWalkerAjax.php
header('Content-Type: application/json; charset=utf-8');
require_once 'Persistance/Connection.php';
require_once 'Persistance/WalkerDAO.php';
require_once 'Business/Walker.php';

session_start();
if ($_SESSION['role'] !== 'Admin') {
  echo json_encode([
    'success' => false,
    'message' => 'No tienes permiso para realizar esta acción'
  ]);
  exit;
}

//get data by POST
$name       = trim($_POST['name'] ?? '');
$lastName   = trim($_POST['lastName'] ?? '');
$email      = trim($_POST['email'] ?? '');
$password   = trim($_POST['password'] ?? '');
$ratePerHour= floatval($_POST['ratePerHour'] ?? 0);
$description= trim($_POST['description'] ?? '');

if (!$name || !$lastName || !$email || !$password) {
  echo json_encode([
    'success' => false,
    'message' => 'Todos los campos obligatorios deben estar completos'
  ]);
  exit;
}

$hash = md5($password);

// create Walker and save
try {
  $conn = new Connection();
  $conn->open();
  $dao  = new WalkerDAO(
    id: '',
    name: $name,
    lastName: $lastName,
    email: $email,
    password: $hash,
    profilePicture: '',
    isActive: true,
    ratePerHour: $ratePerHour,
    description: $description,
    ratingAvg: 0.0
  );
  //sql sentence
$sqlInsert = "INSERT INTO Walker (name, last_name, email, password, profile_picture, is_active, rate_per_hour, description, rating_avg)
              VALUES (
                '{$dao->getName()}',
                '{$dao->getLastName()}',
                '{$dao->getEmail()}',
                '{$dao->getPassword()}',
                '',
                1,
                {$dao->getRatePerHour()},
                '{$dao->getDescription()}',
                0.0
              )";

  $conn->query($sqlInsert);
  $conn->close();

  echo json_encode([
    'success' => true,
    'message' => 'Paseador creado correctamente'
  ]);
} catch(Exception $ex) {
  echo json_encode([
    'success' => false,
    'message' => 'Error al crear paseador: ' . $ex->getMessage()
  ]);
}
