<?php
session_start();
?>
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
            $activemenu = "flightSchedule";
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

        $date=date("Y-m-d");

        require 'include/db_connect.php';
        
        echo"<img src=\"images/dodo5.png\" alt=\"logo\" style=\"width:70px; height:70px; position:relative; left:550px;\">";
        echo"<h1 style=\"font-size:25px;\">Flight Schedule </h1>";
        
    
        //CREATE TABLE HEADERS 
        echo "<table >";
        echo "<tr>";
        echo "<th>Date</th>";
        echo "<th>Flight number</th>";
        echo "<th>Origin</th>";
        echo "<th>Destination</th>";
        echo "<th>Departure</th>";
        echo "<th>Arrival</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        
        

        $date=date('y-m-d');
       
        $sql = "SELECT * FROM flight WHERE FlightDate>=\"$date\" or arrivaldate>=\"$date\";";

        $result = $conn->query($sql);

        if ($result) {
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['FlightDate'] . "</td>";
                echo "<td>" . $row['flightNo'] . "</td>";
                echo "<td>" . $row['Take_off'] ."&nbsp".$row['Takeoff_airport']. "</td>";
                echo "<td>" . $row['Destination'] ."&nbsp".$row['destination_Airport']. "</td>";
                echo "<td>" . $row['TakeoffTime'] . "</td>";
                if($row['arrivaldate']==$row['FlightDate'] ){
                    echo "<td>" . $row['LandingTime'] . "</td>";
                }
                else{
                    echo "<td>" . $row['LandingTime']  ."&nbsp".$row['arrivaldate']."</td>";
                }
               
                echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
            }
        }
        
        ?>

    </div>

      
    
</body>

</html>