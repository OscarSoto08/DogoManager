<?php
if($_SESSION["role"] != "Admin"){
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
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
                        <li class="nav-item">
                          <a class="nav-link" href='?pid=<?= base64_encode("ui/Admin/searchWalkers.php") ?>'>
                              <i class="fa-solid fa-search me-1"></i> Search Walker
                          </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Other Options</a></li>
                    </ul>
                </li>
            </ul>

            
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



<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Search Walker</h4>
        </div>
        <div class="card-body">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="filter" placeholder="Name or lastname of walker" autocomplete="off" />
                    </div>
                </div>
            </div>
            <div id="result"></div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#filter").keyup(function(){
        if($("#filter").val().length > 2){
            var filter = encodeURIComponent($("#filter").val());
            var route = "searchWalkerAjax.php?filter=" + filter;
            console.log("looking: " + route);
            $("#result").load(route);
        }
    });
});
</script>
</body>
