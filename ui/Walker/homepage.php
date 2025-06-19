<?php
if($_SESSION["role"] != "Walker"){
    header("Location: ?pid=". base64_encode("ui/failure/Forbidden403.php"));
    exit();
}
$walker = new Walker($_SESSION["userID"]);
$walker -> retrieve();
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["logout"])){
        $walker -> logout();
    }
}
?>
<?php include "ui/home/header.php"; ?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black bg-opacity-50 shadow">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fa-solid fa-dog me-2"></i>
            DogoManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="fa-solid fa-house me-1"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-chart-bar me-1"></i> View Stats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-shoe-prints me-1"></i> View Walks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>


            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user-circle me-1"></i>
                    Walker: <?= $walker->getName() . " " . $walker->getLastName(); ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                    <li>
                    <form action="<?= "?pid=" . base64_encode("ui/Walker/homepage.php") ?>" method="POST" style="margin: 0;">
                        <button type="submit" class="dropdown-item" name="logout" style="border: none; background: none;">
                        Log Out
                        </button>
                    </form>
                    </li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-4 d-flex justify-content-center">
        <div class="card shadow rounded-4 border-0" style="max-width: 540px; width: 100%; font-size: 1.05rem;">

            <div class="card-header bg-gradient bg-primary text-white text-center py-2 rounded-top-4">
            <h6 class="mb-0 text-uppercase letter-spacing">User Data</h6>

            </div>
            <div class="card-body px-5 py-4 text-center">

            <div class="mb-3">
                <h5 class="card-title fw-semibold mb-1">
                <i class="fa-solid fa-dog me-2 text-primary"></i>
                <?= $_SESSION["role"] . ": " . $walker->getName() . " " . $walker->getLastName(); ?>
                </h5>
                <p class="card-text text-muted small mb-1">
                <i class="fa-solid fa-envelope me-2 text-secondary"></i>
                <?= $walker->getEmail(); ?>
                </p>
            </div>
            <hr>
            <div class="mt-2 small text-muted">
                <p class="mb-1">
                <i class="fa-solid fa-dollar-sign me-2 text-warning"></i>
                <strong>Rate:</strong> <?= number_format($walker->getRatePerHour(), 2); ?>
                </p>
                <p class="mb-1">
                <i class="fa-solid fa-quote-left me-2 text-info"></i>
                <strong>Description:</strong> <?= $walker->getDescription(); ?>
                </p>
                <p class="mb-0">
                <i class="fa-solid fa-star me-2 text-warning"></i>
                <strong>Rating Avg:</strong> <?= number_format($walker->getRatingAvg(), 2); ?>
                </p>
            </div>
            </div>
        </div>
    </div>
</body>
