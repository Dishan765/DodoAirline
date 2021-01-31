<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book a flight</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
</head>

<body>
    <div class="main">
        <header>
            <?php
            //CHANGE $activemenu ="" FOR DIFFERENT PAGE
            $activemenu = "signup";
            include('include/navbar.php'); //THIS LINE REMAINS SAME
            ?>
        </header>

        <h1 style="font-size:3em">USERNAME ALREADY EXISTS</h1>
        <a href="signup.php">Register Again</a>
    </div>
</body>

</html>