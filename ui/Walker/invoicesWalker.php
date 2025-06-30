<?php
if ($_SESSION["role"] !== "Walker") {
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
    exit();
}

require_once __DIR__ . '/../../Business/Invoice.php';
require_once __DIR__ . '/../../Business/Walker.php';

$walker = new Walker($_SESSION["userID"]);
$walker->retrieve();

$invoices = Invoice::getByWalkerId($walker->getId());
?>

<?php require_once __DIR__ . '/navbarWalker.php'; ?>

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
                    <th>Walk ID</th>
                </tr>
            </thead>
<tbody>
  <?php foreach ($invoices as $inv): ?>
    <tr>
      <td><?= htmlspecialchars($inv->getId()) ?></td>
      <td><?= htmlspecialchars($inv->getCreatedAt()) ?></td>
      <td>$<?= number_format($inv->getTotal(), 2) ?></td>
      <td>
        <?php
          $walkProp = $inv->getWalk();
          if (is_object($walkProp) && method_exists($walkProp, 'getId')) {
              echo htmlspecialchars($walkProp->getId());
          } else {
              echo htmlspecialchars($walkProp);
          }
        ?>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

        </table>
    <?php endif; ?>
</div>
