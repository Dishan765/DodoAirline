<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
  <title> Dodo AirLines</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
  <link rel="icon" type="image/jpg" href="images/dodo.jpg">
</head>

<body id="page1">
  <div class="main">

    <!--header -->
    <header>
      <?php
      //CHANGE $activemenu ="" FOR DIFFERENT PAGE
      $activemenu = "home";
      $log = "";
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
    <!-- / header -->

    <!--content -->
    <section id="content">
      <div class="for_banners">
        <article class="col1">
          <div class="tabs">
            <ul class="nav">
              <li class="selected"><a href="#Flight">Flight Offers</a></li>
            </ul>
            <div class="content">
              <div class="tab-content" id="Flight">

                <div class="wrapper pad1">
                  <article class="col1">
                    <div class="box1" style="position:absolute; right:5px; top:5px">
                      <h2 class="top">Offers of the Week</h2>

                      <?php
                      $date = date('y-m-d');
                      //DATABASE 
                      $connect = mysqli_connect("localhost", "root", "12345", "dodo");
                      $query = "SELECT * FROM (SELECT * FROM flight where  FlightDate>=\"$date\" and status=\"Scheduled\" order by Flightdate DESC LIMIT 5)sub
                         ORDER BY FlightDate DESC ;";
                      $result = mysqli_query($connect, $query);
                      while ($row = mysqli_fetch_array($result)) {
                        echo " <strong style=\"color:cornflowerblue\" >" . $row['Take_off'] . "&nbsp" . $row['Takeoff_airport'] . "&nbsp To &nbsp" . $row['Destination'] . "&nbsp" . $row['destination_Airport'] . "</strong><br>";
                        echo "<ul class=\"pad_bot1 list1\">";
                        echo " <li > <span class=\"right color1\" style=\"color:black\">First class : " . $row['FirstPrice'] . "&nbsp MUR</span> </li>";
                        echo "  <li> <span class=\"right color1\"style=\"color:black\">Economy:  " . $row['EconomyPrice'] . "&nbsp MUR</span> </li>";
                        echo "</ul>";
                      }
                      ?>

                      <h2 style="color:black">Flight reviews </h2>
                      <div>
                        <?php
                        $date = date('y-m-d');
                        //DATABASE
                        $connect = mysqli_connect("localhost", "root", "12345", "dodo");


                        $query = "SELECT * FROM (
                          SELECT * FROM ratings ORDER BY reviewdate DESC LIMIT 5
                      ) sub
                      ORDER BY reviewdate DESC ; ";
                        $result = mysqli_query($connect, $query);
                        while ($row = mysqli_fetch_array($result)) {
                          echo " <strong style=\"color:cornflowerblue\" >" . $row['reviewdate'] . "&nbsp" . $row['name'] . "&nbsp" . $row['Comment'] . "</strong><br>";
                          echo "<ul class=\"pad_bot1 list1\">";

                          echo "</ul>";
                        }
                        ?>

                      </div>
                    </div>
                </div>
        </article>

        <div class="col2">

          <?php
          //DATABASE
          $connect = mysqli_connect("localhost", "root", "12345", "dodo");
          $connect->set_charset("utf8");
          $query = "SELECT * FROM homeimg ORDER BY imageid DESC";
          $result = mysqli_query($connect, $query);
          while ($row = mysqli_fetch_array($result)) {
            echo "<div class=\"slideshow-container\">";
            echo "<div class=\"mySlides fade\">";
            echo " <div class=\"numbertext\"></div>";
            echo '  
                          
                                    <img src="data:image/jpeg;base64,' . base64_encode($row['imageData']) . '" style="width:100%" class="img-thumnail" />  
                           
                     ';
            echo "</div>";

            echo "<div style=\"text-align:center\">";
            echo "<span class=\"dot\" onclick=\"currentSlide(" . $row['imageid'] . ")\"></span>";
            echo " </div>";
          }
          ?>

          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>
          <br>



          <h3>About Our Airlines<span>created and launched in Nov 2019</span></h3>
          <div class="wrapper">
            <article class="cols">
              <figure><img src="images/page1_img1.jpg" alt="" class="pad_bot2"></figure>
              <p class="pad_bot1"><strong>Airlines History.</strong></p>
              <p>Dodo Airline is an airline based at the Sir Seewoosagur Ramgoolam Airport of Mauritius in the Indian Ocean. It operates scheduled services from Mauritius to metropolitan France, South Africa, Thailand, India and a number of destinations in the Indian Ocean. </p>
            </article>
            <article class="cols pad_left1">
              <figure><img src="images/page1_img2.jpg" alt="" class="pad_bot2"></figure>
              <p class="pad_bot1"><strong>This Airlines goes with two packages.</strong></p>
              <p>We are an airline from Mauritius, proudly connecting our country to the world with exceptional Mauritian hospitality through innovative employees determined to exceed the expectations of our customers. We are committed to delivering sustained profitability in a socially responsible manner.
                We want to:</p>

              <ol>
                <li>1.Consistently delight our customers by providing a unique travel experience in a genuine Mauritian style. </li>
                <li>2.Constantly improve our products and services in line with changing customer expectations.</li>
                <li>3.Be a rewarding performance-driven organisation and a great place to work.</li>
                <li>4.Deliver sustainable returns for our shareholders.</li>
                <li>5.Be a top independent driver of the Mauritian economy.</li>
              </ol>
          </div>
          <br>
        </div>
        <br>

      </div>

      </article>
    </section>
    <!--content end-->
    <!--footer -->
    <footer>
      <div class="wrapper">

      </div>

      <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          slideIndex++;
          if (slideIndex > slides.length) {
            slideIndex = 1
          }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex - 1].style.display = "block";
          dots[slideIndex - 1].className += " active";
          setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
      </script>
</body>

</html>