<?php
if($_SESSION["role"] != "Admin"){
    header("Location: ?pid=". base64_encode("ui/failure/Forbidden403.php"));
    exit();
}

$admin = new Admin($_SESSION["userID"]);
$admin -> retrieve();

if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_GET["logout"])){
        $admin -> logout();
    }
}

?>
<body>
    <h1><?= $admin -> __tostring()?></h1>
    <form action="<?= "?pid=" . base64_encode("ui/Admin/homepage")?>" method="GET"><button type="submit" class="btn btn-primary" name="logout">Log-out</button></form>
</body>
