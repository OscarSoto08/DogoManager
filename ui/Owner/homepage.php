<?php
if($_SESSION["role"] != "Owner"){
    header("Location: ?pid=". base64_encode("ui/failure/Forbidden403.php"));
    exit();
}
$owner = new Owner($_SESSION["userID"]);
$owner -> retrieve();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["logout"])){
        $owner -> logout();
    }
}
?>
<body>
    <h1><?= $owner -> __toString()?></h1>
    <form action="<?= "?pid=" . base64_encode("ui/Owner/homepage.php")?>" method="POST"><button type="submit" class="btn btn-primary" name="logout">Log-out</button></form>
</body>

