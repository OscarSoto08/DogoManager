<?php

if($_SESSION["role"] != "Admin"){
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
    exit();
}
$admin = new Admin($_SESSION["userID"]);
$admin -> retrieve();


?>

<?php
require_once "ui/Admin/navbarAdmin.php";
?>

<?php
if ($_SESSION["role"] != "Admin") {
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
    exit();
}

require_once 'Business/Walker.php';

if (isset($_GET["id"])) {
    $walker = new Walker($_GET["id"]);
    $walker->retrieve();
} else {
    echo "<div class='alert alert-danger'>Walker not found.</div>";
    exit();
}
?>

<div class="container mt-5">
  <h2>Edit Walker</h2>
  <form method="POST" action="?pid=<?= base64_encode("ui/Walker/editWalkerAjax.php") ?>">
    <input type="hidden" name="id" value="<?= $walker->getId() ?>">
    
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" class="form-control" name="name" value="<?= $walker->getName() ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Last Name</label>
      <input type="text" class="form-control" name="lastName" value="<?= $walker->getLastName() ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" value="<?= $walker->getEmail() ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Rate Per Hour</label>
      <input type="number" class="form-control" name="ratePerHour" step="0.01" value="<?= $walker->getRatePerHour() ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" name="description"><?= $walker->getDescription() ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save Changes</button>
    
  </form>
</div>
