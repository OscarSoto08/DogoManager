<?php
if ($_SESSION["role"] != "Admin") {
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
    exit();
}
$admin = new Admin($_SESSION["userID"]);
$admin->retrieve();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["logout"])) {
        $admin->logout();
    }
}
?>

<body>
<?php require_once "ui/Admin/navbarAdmin.php"; ?>

<div class="container-fluid mt-4">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">

      <div class="row align-items-center mb-3">
        <div class="col-md-6">
          <h4 class="fw-bold text-primary">Search Walker</h4>
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="filter" placeholder="Name or lastname of walker" autocomplete="off">
        </div>
      </div>

      <div class="table-responsive shadow-sm rounded border">
        <div id="result"></div>
      </div>

    </div>
  </div>
</div>

<!-- Alert for messages -->
<div id="status-alert" class="alert d-none mt-3" role="alert"></div>

<!-- Custom confirmation box -->
<div id="custom-confirm" class="alert alert-warning d-none position-fixed top-50 start-50 translate-middle shadow" style="z-index: 9999; width: 300px;">
  <p id="confirm-text" class="mb-3">Are you sure?</p>
  <div class="d-flex justify-content-end gap-2">
    <button id="confirm-yes" class="btn btn-sm btn-primary">Yes</button>
    <button id="confirm-no" class="btn btn-sm btn-secondary">Cancel</button>
  </div>
</div>

<script>
function showStatusMessage(message, type = 'success') {
    const alertBox = $('#status-alert');
    alertBox
        .removeClass('d-none alert-success alert-danger')
        .addClass('alert-' + (type === 'success' ? 'success' : 'danger'))
        .text(message);
    setTimeout(() => {
        alertBox.addClass('d-none');
    }, 2000);
}

let pendingWalkerBtn = null;

$(document).ready(function () {
    // Search input keyup
    $('#filter').keyup(function () {
        if ($(this).val().length > 2) {
            const filter = encodeURIComponent($(this).val());
            $('#result').load('searchWalkerAjax.php?filter=' + filter);
        }
    });

    // Click on status button
    $(document).on('click', '.btn-status', function () {
        pendingWalkerBtn = $(this);
        const newActive = pendingWalkerBtn.data('active') ? 0 : 1;
        const actionTxt = newActive ? 'activate' : 'disable';

        $('#confirm-text').text(`Are you sure you want to ${actionTxt} this walker?`);
        $('#custom-confirm').removeClass('d-none');
    });

    // Cancel button in confirmation
    $('#confirm-no').on('click', function () {
        $('#custom-confirm').addClass('d-none');
        pendingWalkerBtn = null;
    });

    // Confirm button
    $('#confirm-yes').on('click', function () {
        if (!pendingWalkerBtn) return;

        const btn = pendingWalkerBtn;
        const walkerId = btn.data('id');
        const currentActive = btn.data('active');
        const newActive = currentActive ? 0 : 1;

        $.ajax({
            url: 'ui/Walker/toggleWalkerStatus.php',
            method: 'POST',
            data: { id: walkerId, isActive: newActive },
            dataType: 'json'
        })
        .done(function (res) {
            if (res.success) {
                btn.data('active', newActive)
                   .text(newActive ? 'Disable' : 'Enable')
                   .toggleClass('btn-success btn-danger');

                const statusCell = btn.closest('tr').find('td:eq(5)');
                const statusText = newActive ? 'Active' : 'Inactive';
                const badgeClass = newActive ? 'bg-success' : 'bg-secondary';
                statusCell.html(`<span class="badge ${badgeClass}">${statusText}</span>`);

                showStatusMessage('Walker status updated successfully.', 'success');
            } else {
                showStatusMessage('Could not change walker status.', 'error');
            }
        })
        .fail(function () {
            showStatusMessage('Server connection failed.', 'error');
        });

        $('#custom-confirm').addClass('d-none');
        pendingWalkerBtn = null;
    });
});
</script>
</body>
