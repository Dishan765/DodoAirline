<?php
require 'include/db_connect.php';

$deletesql = "DELETE FROM ticket WHERE TicketNo = '$_GET[id]'";

$resultdelete = $conn->query($deletesql);

if ($resultdelete) {
    header("refresh:1;url = myBookings.php");
} else {
    echo "ERROR DELETING";
}
