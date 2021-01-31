<?php
require 'include/db_connect.php';

$deletesql = "DELETE FROM ratings WHERE reviewID = '$_GET[id]'";

$resultdelete = $conn->query($deletesql);

if ($resultdelete) {
    header("refresh:1;url = adminreview.php");
} else {
    echo "ERROR DELETING";
}
