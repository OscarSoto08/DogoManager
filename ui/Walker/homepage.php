<?php
if($_SESSION["role"] != "Walker"){
    header("Location: ?pid=". base64_encode("ui/failure/Forbidden403.php"));
    exit();
}
$walker = new Walker($_SESSION["userID"]);
$walker -> retrieve();
if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_GET["logout"])){
        $walker -> logout();
    }
}
?>
<body>
    <h1><?= $walker -> __toString()?></h1>
    <form action="<?= "?pid=" . base64_encode("ui/Walker/homepage")?>" method="GET">
        <button type="submit" class="btn btn-primary" name="logout">Log-out</button>
</body>
