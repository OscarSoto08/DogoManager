<?php
if($_SESSION["role"] != "Admin"){
    header("Location: ?pid=". base64_encode("ui/failure/Forbidden403.php"));
    exit();
}

$admin = new Admin($_SESSION["userID"]);
$admin -> retrieve();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["logout"])){
        $admin -> logout();
    }
}
?>


<body>
<?php require_once __DIR__ . '/navbarAdmin.php'; ?>


<div class="container d-flex justify-content-center">
    <div class="card">
        <div class="card-header">Admin Profile</div>
        <div class="card-body">
            <h5 class="card-title">
                <i class="fa-solid fa-user-shield me-2 text-primary"></i>
                <?= $_SESSION["role"] . ": " . $admin->getName() . " " . $admin->getLastName(); ?>
            </h5>
            <p class="card-text">
                <i class="fa-solid fa-envelope me-2 text-secondary"></i>
                <?= $admin->getEmail(); ?>
            </p>
        </div>
    </div>
</div>
</body>
