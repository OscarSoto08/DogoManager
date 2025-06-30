<?php
if ($_SESSION["role"] !== "Owner") {
    header("Location: ?pid=" . base64_encode("ui/failure/Forbidden403.php"));
    exit();
}

require_once __DIR__ . '/../../Persistance/Connection.php';
require_once __DIR__ . '/../../Business/Invoice.php';
require_once __DIR__ . '/../../Business/Walk.php';
require_once __DIR__ . '/../../Business/Place.php';
require_once __DIR__ . '/../../Business/Walker.php';
require_once __DIR__ . '/../../Business/Puppy.php';
require_once __DIR__ . '/../../Business/Breed.php';

if (empty($_GET["id"])) {
    echo "<p>Invoice ID missing.</p>";
    exit();
}

$invoiceId = $_GET["id"];

// 1) Cargar la factura
$connection = new Connection();
$connection->open();
$connection->query("
    SELECT id, total, created_at, id_walk
    FROM invoice
    WHERE id = '{$invoiceId}'
");
$row = $connection->fetch_row();
$connection->close();

if (!$row) {
    echo "<p>Invoice not found.</p>";
    exit();
}

$invoice = new Invoice($row[0], $row[1], $row[2]);

// 2) Cargar el paseo asociado (incluye place_name y walker y puppies)
$walk = new Walk($row[3]);
$walk->retrieve();
?>

<?php require_once __DIR__ . '/navbarOwner.php'; ?>

<div class="main-container">
    <h1>🧾 Invoice #<?= htmlspecialchars($invoice->getId()) ?></h1>
    <p><strong>Date:</strong> <?= htmlspecialchars($invoice->getCreatedAt()) ?></p>
    <p><strong>Total:</strong> $<?= number_format($invoice->getTotal(), 2) ?></p>
    <hr>

    <h2>🐕 Walk Details</h2>
    <p><strong>Start:</strong> <?= htmlspecialchars($walk->getStartsAt()) ?></p>
    <p><strong>End:</strong> <?= htmlspecialchars($walk->getEndsAt()) ?></p>
    <p><strong>Duration:</strong> <?= htmlspecialchars($walk->getDuration()) ?></p>

    <?php if ($walk->getWalker()): ?>
        <p>
            <strong>Walker:</strong>
            <?= htmlspecialchars($walk->getWalker()->getName() . ' ' . $walk->getWalker()->getLastName()) ?>
        </p>
    <?php endif; ?>

    <?php if ($walk->getPlace()): ?>
        <p>
            <strong>Place:</strong>
            <?= htmlspecialchars($walk->getPlace()->getName()) ?>
        </p>
    <?php endif; ?>

<h3>🐶 Puppies:</h3>
<?php if (!empty($walk->getPuppies())): ?>
    <ul>
        <?php foreach ($walk->getPuppies() as $puppy): ?>
            <li>
                <?= htmlspecialchars($puppy->getName()) ?>
                (Breed: <?= htmlspecialchars($puppy->getbreed()->getName()) ?>,
                 Age: <?= htmlspecialchars($puppy->getAge()) ?>)
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No puppies registered for this walk.</p>
<?php endif; ?>

</div>
