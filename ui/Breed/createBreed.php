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
<?php
require_once "ui/Admin/navbarAdmin.php";
?>
<?php
require_once 'Business/Breed.php';


$success = null;
//FUNCIONA SOLO SI LA TABLA BREED TIENE SU ID CON AUTO_INCREMENT

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $size = $_POST["size"] ?? "";

    if ($name && $size) {
        $breed = new Breed("", $name, $size);
        $success = $breed->insert();
    } else {
        $success = false;
    }
}
?>


<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Add New Breed</h5>
        </div>
        <div class="card-body">
          <?php if ($success === true): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Breed added successfully!
              <a href="?pid=<?= base64_encode("ui/Breed/viewBreeds.php") ?>" class="btn btn-sm btn-link">Go back</a>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php elseif ($success === false): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Failed to add breed. Please fill out all fields correctly.
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Breed Name</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="size" class="form-label">Size</label>
              <select name="size" id="size" class="form-select" required>
                <option value="" selected disabled>Choose size</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="Giant">Giant</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Breed</button>
            <a href="?pid=<?= base64_encode("ui/Breed/viewBreeds.php") ?>" class="btn btn-secondary ms-2">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
