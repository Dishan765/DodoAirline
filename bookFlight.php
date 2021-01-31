<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
}

if (isset($_POST['bookFlight'])) {
  //Retrieve the field values from our registration form.

  if (!empty($_POST['dest'])) {
    $content=($_POST['dest']);
    $destdate=explode(" ", $content);
    
    $dest = $destdate[0];
    $book_date = $destdate[1];
  }


  if (!empty($_POST['status'])) {
    $status = trim($_POST['status']);
  }

  $user_id = $_SESSION['user_id'];

  require 'include/db_connect.php'; //CONNECT TO DATABASE

  $cust_id = $user_id + 100;

  $chkcustomer = "SELECT COUNT(CustID) AS num FROM customer WHERE CustID = $cust_id";
  $resultcustomer = $conn->query($chkcustomer);

  $row = $resultcustomer->fetch();

  if ($row['num'] <= 0) {
    $sqlcustomer = "INSERT INTO `customer` (`CustID`, `UserID`) VALUES ($cust_id, $user_id)";
    $addcutomer = $conn->exec($sqlcustomer);
  }

  //read seatsAvailable from table flight and store it in a variable
  //decrease seats available for the specific flight
  $sqlflight = "SELECT * FROM flight";

  $resflight = $conn->query($sqlflight);

  if ($resflight) {
    //echo var_dump($resflight);
    //$row = $resflight->fetch();
    while ($row = $resflight->fetch()) {
      $destcmp = $row['Destination'];
     

      if ($destcmp == $dest) {
        $flightNo = $row['flightNo'];
        $flightdate=$row['FlightDate'];
      }

      //DECREASE SEATS AVAILABLE

    }
  } else {
    echo "ERROR cannot get flightNo from database";
  }

  /*$sqlprice = "SELECT * FROM price";
  $resprice = $conn->query($sqlprice);
  if ($resprice) {
    //echo var_dump($resprice);
    while ($row = $resprice->fetch()) {
      $statuscmp = $row['class'];
      //echo $statuscmp;
      //echo "<br>";

      if ($statuscmp == $status) {
        $price = $row['price'];
      }
    }
  } else {
    echo "ERROR  from database";
  }*/

  //$Price = 20000; //to create table price which is to filled by admin
  $sqlticket = "INSERT INTO `ticket` (`FlightNo`, `Class`, `booking_date`, `CustID`) VALUES ( $flightNo,'$status', '$flightdate',$cust_id) ";

  $addResult = $conn->exec($sqlticket);

  $conn == null;

  header("Location:myBookings.php");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>AirLines | Book</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
  <link rel="icon" type="image/jpg" href="images/dodo.jpg">
</head>

<body id="page3">
  <div class="main">
    <!--header -->
    <header>
      <?php
      $activemenu = "bookings";
      $log = "logout";
      include('include/navbar.php'); //THIS LINE REMAINS SAME
      ?>
    </header>
    <!-- / header -->

    <form action="bookFlight.php" method="POST" >

      <div class="container">
        <!--radio buttons for directions-->
        <!--<input type="radio" name="direction" value="male" checked> Return
        <input type="radio" name="direction" value="female"> One-Way-->

        <?php


        require 'include/db_connect.php';

        
        $date=date('y-m-d');
        $dest_sql = "SELECT * FROM flight where FlightDate>=\"$date\" and status=\"Scheduled\"";
        $result = $conn->query($dest_sql);

        if ($result) {
          echo "<label for=\"dest\"><b>Select Flight and scheduled date: </b></label>";
          echo "<select name=\"dest\" >";
          while ($row = $result->fetch()) {
            $origin=$row['Take_off'];
            $departuredate=$row["FlightDate"];
            $deptdate=date("y-m-d", strtotime($row["FlightDate"]));
            $destination = $row['Destination'];
            $arrivaldate=$row["arrivaldate"];
            $arrdate=date("y-m-d", strtotime($row["arrivaldate"]));
          

            echo "<option value=\"" . $destination."  ".$fdate. "\">". $origin."&nbsp".$deptdate."&nbsp TO &nbsp" . $destination."&nbsp".$arrdate. "</option>";

            

          

          }
          echo "</select>";
           
        } else {
          echo "ERROR from database";
        }
        ?>
        <br>
        <br>
        <br>
        
        <input type="radio" name="status" value="Economy" checked >Economy Class

        <input type="radio" name="status" value="First"> First Class
        <br>
        <button type="submit" name="bookFlight" class="registerbtn">Book</button>
      
    </form>
  </div>
  <!--content -->

</body>

</html>