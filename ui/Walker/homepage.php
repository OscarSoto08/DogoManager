<?php
if($_SESSION["role"] != "Walker"){
    header("Location: ?pid=". base64_encode("ui/failure/Forbidden403.php"));
    exit();
}

$walker = new Walker($_SESSION["userID"]);
$walker -> retrieve();
if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_GET["session"]) && $_GET["session"] === "close"){
        $walker -> logout();
    }
}
?>

<?php require_once __DIR__ . '/navbarWalker.php'; ?>
<body>


<!-- Contenido principal -->
<div class="container d-flex justify-content-center">
    <div class="card">
        <div class="card-header">Walker Profile</div>
        <div class="card-body text-center">
            <h5 class="card-title">
                <i class="fa-solid fa-dog me-2 text-primary"></i>
                <?= $_SESSION["role"] . ": " . $walker->getName() . " " . $walker->getLastName(); ?>
            </h5>
            <p class="card-text">
                <i class="fa-solid fa-envelope me-2 text-secondary"></i>
                <?= $walker->getEmail(); ?>
            </p>
            <hr>
            <div class="info-section mt-3 text-start">
                <p><i class="fa-solid fa-dollar-sign me-2 text-warning"></i><strong>Rate:</strong> <?= number_format($walker->getRatePerHour(), 2); ?> / hour</p>
                <p><i class="fa-solid fa-quote-left me-2 text-info"></i><strong>Description:</strong> <?= $walker->getDescription(); ?></p>
                <p><i class="fa-solid fa-star me-2 text-warning"></i><strong>Rating Avg:</strong> <?= number_format($walker->getRatingAvg(), 2); ?></p>
            </div>
        </div>
    </div>
</div>
</body>
