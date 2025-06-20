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
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fa-solid fa-dog me-2"></i> DogoManager
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-chart-bar me-1"></i> View Stats</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-shoe-prints me-1"></i> View Walks</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-tie me-1"></i> Walkers
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Add Walkers</a></li>
                        <li class="nav-item">
                          <a class="nav-link" href='?pid=<?= base64_encode("ui/Admin/searchWalkers.php") ?>'>
                              <i class="fa-solid fa-search me-1"></i> Search Walker
                          </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Other Options</a></li>
                    </ul>
                </li>
            </ul>

            
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-shield me-1"></i>
                        Admin: <?= $admin->getName() . " " . $admin->getLastName(); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                        <li>
                            <form action="<?= "?pid=" . base64_encode("ui/Admin/homepage.php") ?>" method="POST" style="margin: 0;">
                                <button type="submit" class="dropdown-item" name="logout" style="border: none; background: none;">
                                    Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>



<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Search Walker</h4>
        </div>
        <div class="card-body">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="filter" placeholder="Name or lastname of walker" autocomplete="off" />
                    </div>
                </div>
            </div>
            <div id="result"></div>
        </div>
    </div>
</div>
<div id="status-alert" class="alert d-none" role="alert"></div>

<script>
// ========= 1. Bootstrap-style alert for feedback messages =========
function showStatusMessage(message, type = 'success') {
    const alertBox = $('#status-alert');
    alertBox
        .removeClass('d-none alert-success alert-danger')              // reset alert styles
        .addClass('alert-' + (type === 'success' ? 'success' : 'danger')) // apply success or error style
        .text(message);                                               // set message text

    setTimeout(() => {
        alertBox.addClass('d-none');                                  // auto-hide after 2 seconds
    }, 2000);
}

// ========= 2. Global variable to store the clicked button =========
let pendingWalkerBtn = null;

$(document).ready(function () {
    // ========= 3. AJAX search on input keyup =========
    $('#filter').keyup(function () {
        if ($(this).val().length > 2) {
            const filter = encodeURIComponent($(this).val());
            $('#result').load('searchWalkerAjax.php?filter=' + filter);
        }
    });

    // ========= 4. When clicking the status toggle button =========
    $(document).on('click', '.btn-status', function () {
        pendingWalkerBtn = $(this);                                  // store button reference
        const newActive = pendingWalkerBtn.data('active') ? 0 : 1;   // determine the next state
        const actionTxt = newActive ? 'activate' : 'desactivate';     // text for confirmation

        // Set modal confirmation message
        $('#confirmModal .modal-body')
            .text(`Are you sure you want to ${actionTxt} this walker?`);

        // Show the confirmation modal
        const confirmModal = new bootstrap.Modal(
            document.getElementById('confirmModal')
        );
        confirmModal.show();
    });

    // ========= 5. When user confirms status change from modal =========
    $('#confirmChangeBtn').on('click', function () {
        if (!pendingWalkerBtn) return;  // safety check

        const btn           = pendingWalkerBtn;
        const walkerId      = btn.data('id');
        const currentActive = btn.data('active');
        const newActive     = currentActive ? 0 : 1;

        // AJAX request to toggle walker status
        $.ajax({
            url:    'ui/Admin/toggleWalkerStatus.php',
            method: 'POST',
            data:   { id: walkerId, isActive: newActive },
            dataType: 'json'
        })
        .done(function (res) {
            if (res.success) {
                // 1. Update button label, style, and data
                btn.data('active', newActive)
                   .text(newActive ? 'Disable' : 'Enable')
                   .toggleClass('btn-success btn-danger');

                // 2. Update the "Status" column (6th column, index 5)
                const statusCell = btn.closest('tr').find('td:eq(5)');
                const statusText = newActive ? 'Active' : 'Inactive';
                const badgeClass = newActive ? 'bg-success' : 'bg-secondary';
                statusCell.html(`<span class="badge ${badgeClass}">${statusText}</span>`);

                // 3. Show success alert
                showStatusMessage('Walker status updated successfully.', 'success');
            } else {
                // Show logical/server error
                showStatusMessage('Could not change walker status.', 'error');
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            // AJAX/network error
            console.error('AJAX Error:', textStatus, errorThrown);
            showStatusMessage('Server connection failed.', 'error');
        });

        // Hide the confirmation modal
        bootstrap.Modal.getInstance(
            document.getElementById('confirmModal')
        ).hide();

        // Reset the stored button
        pendingWalkerBtn = null;
    });
});
</script>



<!-- Modal for confirming status change -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Status Change</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to change the walker's status?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="confirmChangeBtn" type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>

<div id="status-alert" class="alert d-none" role="alert"></div>

</body>
