<?php
session_start();
//|| !isset($_SESSION['logged_in'])
if (!isset($_SESSION['user_id'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}


?>

<!DOCTYPE html>
<html>

<head>
    <title> Dodo AirLines</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>

<body id="page1">
    <div class="main">
        <!--header -->
        <header>
            <?php
            //CHANGE $activemenu ="" FOR DIFFERENT PAGE
            $activemenu = "home";
            $log = "logout";
            include('include/navbar.php'); //THIS LINE REMAINS SAME
            ?>

        </header>
        <!-- / header -->

        <!--content -->
        <section id="content">
            <div class="for_banners">
                <article class="col1">
                    <div class="tabs">
                        <ul class="nav">
                            <li class="selected"><a href="#Flight">Flight</a></li>
                        </ul>
                        <div class="content">
                            <div class="tab-content" id="Flight">
                                <!--
                                <form id="form_1" action="#" method="post">
                                    <div>
                                        <div class="radio">
                                            <div class="wrapper">
                                                <input type="radio" name="name1" checked>Round

                                                <input type="radio" name="name1">One-way
                                            </div>
                                            <div class="wrapper">
                                                <div class="col1">
                                                    <div class="row"> <span class="left">Destination</span>
                                                        <input type="text" class="input1">
                                                    </div>
                                                    <div class="row"> <span class="left">Outbound</span>
                                                        <input type="text" class="input1">
                                                    </div>
                                                    <div class="row"> <span class="left">Return</span>
                                                        <input type="text" class="input1">
                                                    </div>
                                                    <div class="row"> <span class="left">number of passengers:</span>
                                                        <input type="text" class="input1">
                                                    </div>
                                                    <div class="wrapper"> <span class="right relative"><a href="#" class="button1"><strong>Submit</strong></a></span>
                                                    </div>

                                                </div>

                                </form>
-->
                                <div class="wrapper pad1">
                                    <article class="col1">
                                        <div class="box1">
                                            <h2 class="top">Offers of the Week from Mauritius</h2>
                                            <div class="pad"> <strong>South Africa</strong><br>
                                                <ul class="pad_bot1 list1">
                                                    <li> <span class="right color1">from MUR 43000.-</span> </li>
                                                </ul>
                                                <strong>To Reunion</strong><br>
                                                <ul class="pad_bot1 list1">
                                                    <li> <span class="right color1">first class :from MUR 50000.-</span> </li>
                                                    <li> <span class="right color1">economy: from MUR 20000.-</span> </li>
                                                </ul>
                                                <strong>To France</strong><br>
                                                <ul class="pad_bot2 list1">
                                                    <li> <span class="right color1">from MUR 28000.-</span> <a href="book2.html">Paris</a> </li>
                                                    <li> <span class="right color1">from MUR 20000.-</span> <a href="book2.html">Lyon</a> </li>
                                                    <li> <span class="right color1">from MUR 25000.-</span> <a href="book2.html">Marseille</a> </li>
                                                </ul>
                                            </div>
                                            <h2>From Mauritius to Rodrigues</h2>
                                            <div class="pad"> <strong>Port Mathurin</strong><br>
                                                <ul class="pad_bot2 list1">
                                                    <li class="pad_bot1"> <span class="right color1">from MUR 12000.-</span> <a href="book2.html"></a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                </div>
                </article>

                <div class="col2">
                    <div class="slideshow-container">

                        <div class="mySlides fade">
                            <div class="numbertext">1 / 3</div>
                            <img src="images/rome.jpg" style="width:100%">

                        </div>

                        <div class="mySlides fade">
                            <div class="numbertext">2 / 3</div>
                            <img src="images/back.jpg" style="width:100%">

                        </div>

                        <div class="mySlides fade">
                            <div class="numbertext">3 / 3</div>
                            <img src="images/banner-bg.jpg" style="width:100%">

                        </div>

                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        <br>


                        <div style="text-align:center">
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                        </div>
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
                    setTimeout(showSlides, 10000); // Change image every 2 seconds
                }
            </script>
</body>

</html>