<!DOCTYPE html>
<html lang="en">

<head>
    <title>Flight Schedule</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="css/styleTable.css">
</head>

<body>
    <div class="main">
        <header>
            <?php
            //CHANGE $activemenu ="" FOR DIFFERENT PAGE
            $activemenu = "flightSchedule";
            $log = "logout";
            include('include/navbar.php'); //THIS LINE REMAINS SAME
            ?>
        </header>
        <h1 style="padding:5% 20% 5% 50%; font-size:2.5em">Flight Schedules</h1>
        <br>
        <br>

        <?php

        require 'include/db_connect.php';
        //CREATE TBALE HEADERS
        echo "<table id=\"Grid\" style=\"width:100%;\">";
        echo "<tr>";
        echo "<th>Flight number</th>";
        echo "<th>Destination</th>";
        echo  "<th>Aiport</th>";
        echo    "<th>Arrival Time</th>";
        echo    "<th>Gate</th>";
        echo "</tr>";

        $sql = "SELECT * FROM flight";

        $result = $conn->query($sql);

        if ($result) {
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['flightNo'] . "</td>";
                echo "<td>" . $row['Destination'] . "</td>";
                echo "<td>" . $row['Airport'] . "</td>";
                echo "<td>" . $row['ArrivalTime'] . "</td>";
                echo "<td>" . $row['gate'] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </div>
</body>

</html>