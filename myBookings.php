<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Bookings</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="css/styleTable.css">
    <link rel="icon" type="image/jpg" href="images/dodo.jpg">
</head>

<body>
    <div class="main">
        <header>
            <?php
            //CHANGE $activemenu ="" FOR DIFFERENT PAGE
            $activemenu = "bookings";
            $log = "logout";
            include('include/navbar.php'); //THIS LINE REMAINS SAME
            ?>
        </header>
        <h1 style="font-size:25px; position:absolute; right:400px;" ;>Tickets Booked</h1>
        <br>
        <br>
        <br>

        <?php

        require 'include/db_connect.php';
        $user_id = $_SESSION['user_id'];

        $customersql = "SELECT * FROM customer WHERE UserID =$user_id  ";
        $result = $conn->query($customersql);
        if ($result) {
            $row = $result->fetch();
            $cust_id = $row['CustID'];
        }



        //CREATE TBALE HEADERS
        echo "<table id=\"Grid\" style=\"width:100%;\">";
        echo "<tr>";
        echo "<th>TicketNo</th>";
        echo "<th>FlightNo</th>";
        echo "<th>Origin</th>";
        echo "<th>Destination</th>";
        echo  "<th>Class</th>";
        echo    "<th>Price</th>";
        echo    "<th>booking_date</th>";
        echo    "<th>Cancel Ticket</th>";
        echo "</tr>";

        
        $ticketsql = "SELECT * FROM ticket WHERE CustID = '$cust_id'";
        $result = $conn->query($ticketsql);
        if ($result) {
            while ($row = $result->fetch()) {
                $TicketNo = $row['TicketNo'];
                $booking_date = $row['booking_date'];
                $class = $row['class'];
                $FlightNo = $row['FlightNo'];
                //echo $TicketNo;

                $flightsql = "SELECT * FROM flight WHERE flightNo = $FlightNo";
                $result1 = $conn->query($flightsql);
                if ($result1) {
                    $row = $result1->fetch();
                    $Destination = $row['Destination'];
                    $origin= $row['Take_off'];
                }

                $pricesql = "SELECT * FROM flight WHERE flightNo = $FlightNo ";
                $result2 = $conn->query($pricesql);
                if ($result2) {
                    $row = $result2->fetch();
                    if($class=="Economy"){
                        $price=$row['EconomyPrice'];
                    }
                    else{
                        $price=$row['FirstPrice'];
                    }
                }


             

                echo "<tr>";
                echo "<td>" . $TicketNo . "</td>";
                echo "<td>"  .$FlightNo. "</td>";
                echo "<td>" . $origin . "</td>";
                echo "<td>" . $Destination . "</td>";
                echo "<td>" . $class . "</td>";
                echo "<td>" . $price . "</td>";
                echo "<td>" . $booking_date . "</td>";
                echo "<td><a href = delete.php?id=" . $TicketNo . ">Delete</a></td>";
                echo "</tr>";
            }
        }
        ?>
</body>

</html>