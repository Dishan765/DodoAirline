<?php
session_start();
$pwdmatch = "";
if (isset($_POST['login'])) {
    //Retrieve the field values from our registration form.


    if (!empty($_POST['email'])) {
        $email = trim($_POST['email']);
    }

    if (!empty($_POST['pass'])) {
        $pass = trim($_POST['pass']);
    }

    require 'include/db_connect.php'; //CONNECT TO DATABASE

    //Construct the SQL statement and prepare it.
    $sql =  "SELECT userID, Email, Password,usermeta,FirstName FROM user WHERE Email = :email";
    //echo $sql;
    $stmt = $conn->prepare($sql);

    //Bind the provided email to our prepared statement.
    $stmt->bindValue(':email', $email);

    //Execute.
    $stmt->execute();

    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt === false) {
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        die('Incorrect username / password combination!');
        //header('Location/signup.php');
    } else {
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.


        //Compare the passwords.
        $validPassword = password_verify($pass, $row['Password']);
        //echo "test";
        //echo $validPassword;


        //If $validPassword is TRUE, the login has been successful.
        if ($validPassword) {

            //Provide the user with a login session.
            $_SESSION['user_id'] = $row['userID'];
            $_SESSION['user_name'] = $row['FirstName'];
            //$_SESSION['logged_in'] = time();
            if ($row['usermeta'] == "admin") {
                $_SESSION['admin'] = 'admin';
                header('Location:admin.php');
            }
            //Redirect to our protected page, which we called home.php
            header('Location:index.php');

            exit;
        } else {
            //$validPassword was FALSE. Passwords do not match.

            //$pwdmatch = "* Incorrect username or password";

            $pwdmatch = '<script>alert("Incorrect username or password")</script>';

            //redirect to a new page loginfail.php which provides user a link to click
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book a flight</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
    <link rel="icon" type="image/jpg" href="images/dodo.jpg">

    <style>
        input.inputWidth {
            width: 70%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid black;
            /* border-radius: 4px; */
        }
    </style>
</head>
<script>
    function validateform() {

        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(login.email.value)) {
            return true;
        } else {
            alert("Enter a valid email");
            return false;
        }

    }
</script>

<body>
    <div class="main">
        <header>
            <?php
            //CHANGE $activemenu ="" FOR DIFFERENT PAGE
            $activemenu = "login";
            include('include/navbar.php'); //THIS LINE REMAINS SAME



            ?>
        </header>
        <?php
        if (isset($_GET['page'])) {
            if ($_GET['page'] == "signup") {
                echo '<h2 style = "text-align:center">Successful registration</h2><br/>';
            }
        }
        ?>

        <h1 id="register-h1" style="position:relative; right:50px">Log in</h1>
        <hr>

        <form name="login" onsubmit="return validateform()" action="login.php" method="POST">

            <div class="container">

                <!-- <span class="error" style="color:red"><?php //echo $pwdmatch 
                                                            ?></span><br> -->
                <?php echo $pwdmatch ?>
                <label for="email"><b>Email</b></label><br/>
                <input class="inputWidth" type="text" placeholder="Enter Email" name="email" required>
                <br/>

                <label for="pass"><b>Password</b></label><br/>
                <input class="inputWidth" type="password" placeholder="Enter Password" name="pass" required>

                <hr>
                <button type="submit" name="login" class="registerbtn" style = "margin-left:25%">Log in</button>
            </div>
        </form>
    </div>
</body>

</html>