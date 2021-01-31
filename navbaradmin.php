<div class="wrapper">
     <h1><a href="index.php" id="logo">AirLines</a></h1>
     <span id="slogan">Fast, Frequent &amp; Safe Flights</span>
     <nav id="top_nav">
         <ul>
             <?php
                if ($activemenu == "login") {
                    echo  "<li><a href=\"signup.php\">Signup</a></li>";
                } else if ($activemenu == "signup") {
                    echo "<li><a href=\"login.php\">Login</a></li>";
                } else if ($log == "logout") {
                    echo  "<li><a href=\"logout.php\">logout</a></li><br>";
                    echo  "<li style=\"color:white\">Admin:" .$_SESSION['user_name']."</li>";
                } else {
                    echo  "<li><a href=\"signup.php\">Signup</a></li>";
                    echo "<li><a href=\"login.php\">Login</a></li>";
                }

                ?>
         </ul>
     </nav>
 </div>


 <div class="navbar">
     <?php
        // if ($activemenu = "home") {
        //     echo "<a href=\"home.php\"";
        //     if ($activemenu == "home")
        //         echo "class =\"active\"";
        //     echo ">Home</a>";
        // } else {
        //     echo "<a href=\"index.php\"";
        //     if ($activemenu == "home")
        //         echo "class =\"active\"";
        //     echo ">Home</a>";
        // }
        ?>
     <div class="dropdown">
         <a href="index.php" <?php
                                if ($activemenu == "home")
                                    echo "class =\"active\"";
                                ?>> Home</a>
     </div>

    <!-- <div class="dropdown">
         <button class="dropbtn <?php
                                //if ($activemenu == "bookings")
                                    //echo "curr";
                                ?>">Bookings</button>
         <div class="dropdown-content">
             <a href="bookFlight.php">Book a flight</a>
             <a href="myBookings.php">MyBookings</a>
         </div>
     </div>-->

     <?php
        // if ($log = "logout") {
        //     echo "<a href=\"PrflightSchedule.php\"";
        //     if ($activemenu == "flightSchedule")
        //         echo "class =\"active\"";
        //     echo ">Flight Schedule</a>";
        // } else {
        //     echo "<a href=\"flightSchedule.php\"";
        //     if ($activemenu == "flightSchedue")
        //         echo "class =\"active\"";
        //     echo ">Flight Schedule</a>";
        // }
        ?>
     <div class="dropdown">
         <a href="flightSchedule.php" <?php
                                        if ($activemenu == "flightSchedule")
                                            echo "class =\"active\"";
                                        ?>> Flight Schedule</a>
     </div>


     <div class="dropdown">


         <a href="adminreview.php" <?php
                                if ($activemenu == "adminreview")
                                    echo "class =\"active\"";
                                ?>>Customers Review</a>

     </div>

     <div class="dropdown">


         <a href="admin.php" <?php
                                if ($activemenu == "admin")
                                    echo "class =\"active\"";
                                ?>> Admin</a>

     </div>

 </div>