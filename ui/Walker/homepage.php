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
<body>
    <h1><?= $walker -> __toString()?></h1>
    <a href="<?= "?pid=" . base64_encode("ui/Walker/homepage.php")?>&session=close" type="submit" class="btn btn-primary" name="logout">Log-out</a>
</body>
