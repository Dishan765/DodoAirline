<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer Reviews</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="css/styleTable.css">
    <link rel="icon" type="image/jpg" href="images/dodo.jpg">
    <style>
        /*css for table */ 
        table {
            font-family: arial, sans-serif;
            
            border-collapse: collapse;
            width: 100%;
        }

        td {
            border: 10px solid black;
            text-align: left;
            padding: 8px;
            
        }

         th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            background-color: cornflowerblue;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <div class="main">
        <header>
            <?php
            //CHANGE $activemenu ="" FOR DIFFERENT PAGE
            $activemenu = "adminreview";

            //$log = "";
            if (isset($_SESSION['user_id'])) {
                $log = "logout";
            } else {
                $log = "login";
            }
            if (isset($_SESSION['admin'])) {
                include('navbaradmin.php'); //THIS LINE REMAINS SAME
        
              } else {
                include('include/navbar.php'); //THIS LINE REMAINS SAME
        
              }
            
            ?>
        </header>
        <?php



require 'include/db_connect.php';

echo"<img src=\"images/dodo5.png\" alt=\"logo\" style=\"width:70px; height:70px; position:relative; left:550px;\">";
echo"<h1 style=\"font-size:25px;\">Customer Reviews </h1>";


//CREATE TABLE HEADERS 
echo "<table >";
echo "<tr>";
echo "<th>Review date</th>";
echo "<th>Customer ID</th>";
echo "<th>Review ID</th>";
echo "<th>Ticket Number</th>";
echo "<th>Name</th>";
echo "<th>Comment</th>";
echo "<th>Ratings</th>";
echo "<th>Delete Review</th>";
echo "</tr>";




$sql = "SELECT * FROM (
    SELECT * FROM ratings ORDER BY reviewdate DESC LIMIT 5
) sub
ORDER BY reviewdate DESC ;";

$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['reviewdate'] . "</td>";
        echo "<td>" . $row['CustID'] . "</td>";
        echo "<td>" . $row['reviewID']. "</td>";
        echo "<td>" . $row['TicketNo'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['Comment'] . "</td>";
        echo "<td>" . $row['ratings'] . "</td>";
        echo "<td><a href = deletereview.php?id=" .$row['reviewID'] . ">Delete</a></td>";
        echo "</tr>";
    }
}

?>

</div>

      
    
</body>

</html>