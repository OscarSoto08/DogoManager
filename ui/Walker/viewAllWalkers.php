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

<script>
$(document).ready(function () {
    let pendingWalkerBtn = null;

    function showStatusMessage(message, type = 'success') {
        const alertBox = $('#status-alert');
        alertBox
            .removeClass('d-none alert-success alert-danger')
            .addClass('alert-' + (type === 'success' ? 'success' : 'danger'))
            .text(message);
        setTimeout(() => alertBox.addClass('d-none'), 2000);
    }

    $(document).on("click", ".btn-status", function () {
        pendingWalkerBtn = $(this);
        const newVal = pendingWalkerBtn.data("active") ? 0 : 1;
        const action = newVal ? "activate" : "disable";
        $('#confirm-text').text(`Are you sure you want to ${action} this walker?`);
        $('#custom-confirm').removeClass('d-none');
    });

    $(document).on("click", "#confirm-no", function () {
        $('#custom-confirm').addClass('d-none');
        pendingWalkerBtn = null;
    });

    $(document).on("click", "#confirm-yes", function () {
        if (!pendingWalkerBtn) return;

        const $btn   = pendingWalkerBtn;
        const id     = $btn.data("id");
        const active = $btn.data("active");
        const newVal = active ? 0 : 1;
        const $badge = $btn.closest(".card-body").find(".badge");

        $.post("ui/Walker/toggleWalkerStatus.php", { id, isActive: newVal }, function (resp) {
            if (resp.success) {
                $btn.data("active", newVal)
                    .toggleClass("btn-danger btn-success")
                    .text(newVal ? "Disable" : "Enable");

                $badge.toggleClass("bg-success bg-secondary")
                      .text(newVal ? "Active" : "Inactive");

                showStatusMessage("Walker status updated successfully.");
            } else {
                showStatusMessage("Could not change status.", 'error');
            }
        }, "json").fail(() => showStatusMessage("AJAX error", 'error'));

        $('#custom-confirm').addClass('d-none');
        pendingWalkerBtn = null;
    });
});
</script>




<section id="admin-walkers" class="mt-5">
    
  <h2 class="h2 fw-bold" style="font-family:'Poppins',sans-serif">All Walkers</h2>

  <div class="row row-cols-1 row-cols-md-3 g-4">
  <?php
    require_once 'Business/Walker.php';

    $walkerObj = new Walker();
    // Get all walkers from database
    $walkers = $walkerObj->fetchAllWalkers();

    foreach ($walkers as $walker):
        $active = $walker->isActive() ? 1 : 0;
        $badgeClass = $active ? 'bg-success' : 'bg-secondary';
        $badgeText  = $active ? 'Active' : 'Inactive';
        $btnClass   = $active ? 'btn-danger' : 'btn-success';
        $btnLabel   = $active ? 'Disable' : 'Enable';
  ?>
    
    <!-- Walker Card -->
    <div class="col">
      <div class="card border-0 rounded-3 shadow-sm overflow-hidden h-100">
        <!-- Profile Picture -->
        <img
          src="<?= $walker->getProfilePicture() ?? "img/profilePicture.jpg" ?>"
          class="card-img-top"
          style="height: 200px; object-fit: cover;"
          alt="Photo of <?= $walker->getName() . " " . $walker->getLastName()?>" />

        <div class="card-body text-center">
          <!-- Name -->
          <h5 class="card-title fw-bold"><?= $walker->getName() . ' ' . $walker->getLastName() ?></h5>

          <!-- Hourly Rate -->
          <p class="text-muted mb-1">Rate: $<?= number_format($walker->getRatePerHour(), 2) ?> / hour</p>

          <!-- Status Badge -->
          <span class="badge <?= $badgeClass ?> mb-2"><?= $badgeText ?></span><br>

          <!-- Toggle Status Button -->
          <button
            class="btn btn-sm <?= $btnClass ?> btn-status rounded-pill"
            data-id="<?= $walker->getId() ?>"
            data-active="<?= $active ?>">
            <?= $btnLabel ?>
          </button>
          <a href='?pid=<?= base64_encode("ui/Walker/editWalker.php") ?>&id=<?= $walker->getId() ?>'
            class="btn btn-outline-primary btn-sm rounded-pill mt-2">
            <i class="fa-solid fa-pen-to-square me-1"></i> Update
            </a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</section>

<!-- Custom confirmation box -->
<div id="custom-confirm" class="alert alert-warning d-none position-fixed top-50 start-50 translate-middle shadow" style="z-index: 9999; width: 300px;">
  <p id="confirm-text" class="mb-3">Are you sure?</p>
  <div class="d-flex justify-content-end gap-2">
    <button id="confirm-yes" class="btn btn-sm btn-primary">Yes</button>
    <button id="confirm-no" class="btn btn-sm btn-secondary">Cancel</button>
  </div>
</div>

<!-- Feedback alert -->
<div id="status-alert" class="alert d-none position-fixed bottom-0 end-0 m-4" role="alert"></div>

