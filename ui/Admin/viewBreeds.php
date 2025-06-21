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
require_once __DIR__ . '/navbarAdmin.php';
?>

<?php


require_once 'Business/Breed.php';
$breed = new Breed();
$breeds = $breed->getAll();
?>

<div class="container-fluid mt-4">
    <!-- Modal -->
  <div class="modal fade" id="editBreedModal" tabindex="-1" aria-labelledby="editBreedLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="?pid=<?= base64_encode("ui/Admin/editBreedAjax.php") ?>" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBreedLabel">Edit Breed</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <input type="hidden" name="id" id="breed-id">
          
          <div class="mb-3">
            <label for="breed-name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="breed-name" required>
          </div>

          <div class="mb-3">
            <label for="breed-size" class="form-label">Size</label>
            <select class="form-select" name="size" id="breed-size" required>
              <option value="Small">Small</option>
              <option value="Medium">Medium</option>
              <option value="Large">Large</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-primary fw-bold">All Breeds</h4>
        <?php if (isset($_GET['status'])): ?>
  <div class="alert alert-<?= $_GET['status'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
    <?= $_GET['status'] === 'success'
        ? 'Breed updated successfully.'
        : ($_GET['status'] === 'fail'
            ? 'Failed to update breed.'
            : 'Invalid form submission.') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

        <!-- (botón futuro para agregar raza) -->
        <a href="?pid=<?= base64_encode("ui/Admin/createBreed.php") ?>" class="btn btn-primary btn-sm">
          <i class="fas fa-plus"></i> Add Breed
        </a>
      </div>

      <div class="table-responsive shadow-sm border rounded p-3 bg-white">
        <table class="table table-hover table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Size</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($breeds as $b): ?>
              <tr>
                <td><?= $b->getId() ?></td>
                <td><?= $b->getName() ?></td>
                <td><?= $b->getSize() ?></td>
                <td>
                  <button
                    class="btn btn-sm btn-outline-primary me-1 btn-edit-breed"
                    data-id="<?= $b->getId() ?>"
                    data-name="<?= htmlspecialchars($b->getName()) ?>"
                    data-size="<?= htmlspecialchars($b->getSize()) ?>"
                    data-bs-toggle="modal"
                    data-bs-target="#editBreedModal"
                  >
                    <i class="fas fa-edit"></i> Edit
                  </button>

                  <form method="POST" action="?pid=<?= base64_encode("ui/Admin/deactivateBreed.php") ?>" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this breed?')">
                    <input type="hidden" name="id" value="<?= $b->getId() ?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                      <i class="fas fa-trash-alt"></i> Delete
                    </button>
                  </form>

                </td>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-edit-breed');

    editButtons.forEach(button => {
      button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const size = button.getAttribute('data-size');

        document.getElementById('breed-id').value = id;
        document.getElementById('breed-name').value = name;
        document.getElementById('breed-size').value = size;
      });
    });
  });
</script>

