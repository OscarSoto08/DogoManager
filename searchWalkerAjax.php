<?php
require_once("Business/Walker.php");

if (isset($_GET["filter"])) {
    $filter = trim($_GET["filter"]);
    $walker = new Walker();
    $result = $walker->searchWalkers($filter);

    if (count($result) > 0) {
        echo "<table class='table table-striped'>";
        echo "<thead><tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Rate</th>
                <th>Rating</th>
                <th>Status</th>     
                <th>Action</th>    
              </tr></thead>";
        echo "<tbody>";
        foreach ($result as $w) {
            $active    = $w->isActive() ? 1 : 0;
            $btnClass  = $active ? 'btn-danger'  : 'btn-success';
            $btnLabel  = $active ? 'Disable'     : 'Enable';
            $statusStr = $active ? 'Active'      : 'Inactive';

            echo "<tr>";
            echo "<td>{$w->getId()}</td>";
            echo "<td>{$w->getName()} {$w->getLastName()}</td>";
            echo "<td>{$w->getEmail()}</td>";
            echo "<td>$" . number_format($w->getRatePerHour(), 2) . "</td>";
            echo "<td>" . number_format($w->getRatingAvg(), 2) . "</td>";

            // Status column
            echo "<td><span class='badge " . ($active ? "bg-success" : "bg-secondary") . "'>$statusStr</span></td>";

            // Action column with button
            echo "<td>
                    <button
                      class='btn btn-sm btn-status {$btnClass}'
                      data-id='{$w->getId()}'
                      data-active='{$active}'>
                      {$btnLabel}
                    </button>
                  </td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-warning'>Didn't find results</div>";
    }
}
?>
