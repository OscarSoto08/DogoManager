<?php
if ($_SESSION["role"] != "Owner") {
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
    exit();
}
$owner = new Owner($_SESSION["userID"]);
$owner->retrieve();

$root = dirname(__DIR__, 2);
require_once $root . '/Business/Walker.php';

$walker = new Walker();
$walkers = $walker->fetchAllActive(); 

?>
<?php
require_once __DIR__ . '/navbarOwner.php'; 
?>
<div class="container mt-4">
  <h2 class="text-primary fw-bold mb-4">Choose a Walker</h2>

  <!--  -->
  <div class="mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Search by name..." onkeyup="searchWalkers(this.value)">
  </div>

  <!--  -->
  <div class="row" id="walkerResults">
    <?php foreach ($walkers as $w): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="<?= $w->getProfilePicture() ?: 'img/default_profile.png' ?>" class="card-img-top" alt="Walker Profile Picture" style="height: 200px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title"><?= $w->getName() . " " . $w->getLastName() ?></h5>
            <p class="card-text">
              <?= $w->getDescription() ?><br>
              <strong>Rate: </strong> $<?= $w->getRatePerHour() ?>/hr<br>
              <strong>Rating: </strong> <?= number_format($w->getRatingAvg(), 1) ?> ⭐
            </p>
          </div>
          <div class="card-footer text-end">
            <button class="btn btn-outline-primary btn-sm">Choose</button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- AJAX -->
<script>
function searchWalkers(filter) {
  $.ajax({
    url: "ui/Owner/searchWalkerAjax.php",
    method: "GET",
    data: { filter },
    success: function(response) {
      $('#walkerResults').html(response);
    }
  });
}
</script>
