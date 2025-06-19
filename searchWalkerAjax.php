<?php
require_once("Business/Walker.php");

if (isset($_GET["filter"])) {
    $filter = trim($_GET["filter"]);
    $walker = new Walker();
    $result = $walker->searchWalkers($filter);

    if (count($result) > 0) {
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Rate</th><th>Rating</th></tr></thead>";
        echo "<tbody>";
        foreach ($result as $w) {
            echo "<tr>";
            echo "<td>" . $w->getId() . "</td>";
            echo "<td>" . $w->getName() . " " . $w->getLastName() . "</td>";
            echo "<td>" . $w->getEmail() . "</td>";
            echo "<td>$" . number_format($w->getRatePerHour(), 2) . "</td>";
            echo "<td>" . number_format($w->getRatingAvg(), 2) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-warning'>Didn't find results</div>";
    }
}
?>
