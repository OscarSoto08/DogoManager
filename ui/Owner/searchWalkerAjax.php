<?php

$root = dirname(__DIR__, 2);
require_once $root . '/Business/Walker.php';


if (isset($_GET['filter'])) {
    $filter = trim($_GET['filter']);
    $walker = new Walker();
    $results = $walker->searchActiveWalkers($filter);
} else {
    $walker = new Walker();
    $results = $walker->fetchAllActive();
}

foreach ($results as $w): ?>
  <div class="col-md-4 mb-4">
    <div class="card h-100 shadow-sm">
      <img  src="<?= $w->getProfilePicture() ?? '/img/profilePicture.jpg' ?>" class="card-img-top" alt="Walker Profile Picture" style="height: 200px; object-fit: cover;">
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
