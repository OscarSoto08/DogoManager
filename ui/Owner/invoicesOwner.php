<?php
if ($_SESSION["role"] != "Owner") {
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
    exit();
}

require_once __DIR__ . '/../../Business/Invoice.php';
require_once __DIR__ . '/../../Business/Walk.php';
require_once __DIR__ . '/../../Business/Owner.php';

$owner = new Owner($_SESSION["userID"]);
$owner->retrieve();

$invoices = Invoice::getByOwnerId($owner->getId());
?>

<?php require_once __DIR__ . '/navbarOwner.php'; ?>

<div class="main-container">
    <h1 class="section-title">💳 My Invoices</h1>

    <?php if (empty($invoices)): ?>
        <p>No invoices found.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th># Invoice ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoices as $invoice): ?>
                    <tr>
                        <td><?= $invoice->getId() ?></td>
                        <td><?= $invoice->getCreatedAt() ?></td>
                        <td>$<?= number_format($invoice->getTotal(), 2) ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="?pid=<?= base64_encode('ui/Owner/invoicesDetails.php') ?>&id=<?= $invoice->getId() ?>">
                                View Details
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
