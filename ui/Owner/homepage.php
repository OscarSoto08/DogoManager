<?php
if($_SESSION["role"] != "Owner"){
    header("Location: ?pid=". base64_encode("ui/failure/Forbidden403.php"));
    exit();
}
$owner = new Owner($_SESSION["userID"]);
$owner -> retrieve();

if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_GET["logout"])){
        $owner -> logout();
    }
}
?>
<body>
    <h1><?= $owner -> __toString()?></h1>
    <form action="<?= "?pid=" . base64_encode("ui/Owner/homepage")?>" method="GET"><button type="submit" class="btn btn-primary" name="logout">Log-out</button></form>
</body>

