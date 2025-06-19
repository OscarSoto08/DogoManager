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
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #e3f2fd 0%, #f8fbff 100%);
    min-height: 100vh;
    color: #2c3e50;
}

/* Navbar */
.navbar {
    background: white;
    padding: 1rem 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    font-weight: bold;
    font-size: 1.5rem;
    color: #42a5f5 !important;
}

.nav-link {
    color: #546e7a !important;
    font-weight: 500;
    transition: color 0.3s ease;
}

.nav-link:hover, .nav-link.active {
    color: #42a5f5 !important;
    background-color: #e3f2fd;
    border-radius: 10px;
}

.dropdown-menu {
    border-radius: 12px;
    border: none;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.dropdown-item:hover {
    background-color: #e3f2fd;
    color: #1976d2;
}

/* Card */
.card {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    margin-top: 2rem;
}

.card-header {
    background: linear-gradient(135deg, #42a5f5, #64b5f6);
    color: white;
    font-weight: 600;
    border-radius: 20px 20px 0 0;
    text-align: center;
}

.card-body {
    text-align: center;
}

.card-title {
    color: #1976d2;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.card-text {
    color: #546e7a;
    font-size: 0.95rem;
}

</style>

<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fa-solid fa-dog me-2"></i> DogoManager
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <!-- Navegación principal -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-chart-bar me-1"></i> View Stats</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-shoe-prints me-1"></i> View Walks</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-tie me-1"></i> Walkers
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Add Walkers</a></li>
                        <li><a class="dropdown-item" href="#">View Walkers</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Other Options</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Perfil del Admin -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-shield me-1"></i>
                        Admin: <?= $admin->getName() . " " . $admin->getLastName(); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                        <li>
                            <form action="<?= "?pid=" . base64_encode("ui/Admin/homepage.php") ?>" method="POST" style="margin: 0;">
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

<!-- Main Content -->
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
