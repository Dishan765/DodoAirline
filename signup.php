      <?php
        session_start();
        $error_msg = "";
        $FnameErr = $LnameErr =  $emailErr = $passwordErr = "";
        $firstName = $lastName = $gender = $email = $pass = "";
        $emailExist = false;

        if (isset($_POST['register'])) {
            //Retrieve the field values from our registration form.
            if (!empty($_POST['Fname'])) {
                $firstName = trim($_POST['Fname']);
            } else {
                $FnameErr = "Name is required";
            }


            if (!empty($_POST['Lname'])) {
                $lastName = trim($_POST['Lname']);
                //$lastName = $_POST('Lname');
            } else {
                $LnameErr = "Name is required";
            }


            if (!empty($_POST['gender'])) {
                $gender = trim($_POST['gender']);
                //$gender = $_POST('gender');
            }

            if (!empty($_POST['email'])) {
                $email = trim($_POST['email']);

                require 'include/db_connect.php'; //CONNECT TO DATABASE

                //Construct the SQL statement and prepare it.
                $sql = "SELECT COUNT(Email) AS num FROM user WHERE Email = :email";
                //echo $sql;
                $stmt = $conn->prepare($sql);

                //Bind the provided email to our prepared statement.
                $stmt->bindValue(':email', $email);

                //Execute.
                $stmt->execute();

                //Fetch the row.
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                //If the provided email already exists - display error.
                if ($row['num'] > 0) {
                    //die('That username already exists!');
                    $emailErr = "Email already exists-Login";
                    $emailExist = true;
                }
            } else {
                $emailErr = "Email is required";
            }

            if (!empty($_POST['pass'])) {
                $pass = trim($_POST['pass']);
            } else {
                $passwordErr = "Password is required";
            }


            if ($emailErr == '' && $FnameErr == '' && $LnameErr == '' && $passwordErr == '' && $emailExist == false) {

                require 'include/db_connect.php'; //CONNECT TO DATABASE


                //Hash the password as we do NOT want to store our passwords in plain text.
                $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));


                //Prepare our INSERT statement.
                //Remember: We are inserting a new row into our users table.
                $sql = "INSERT INTO user (Sex,Password,LastName,FirstName,Email,usermeta) VALUES (:gender,:pass,:Lname,:Fname,:email,\"user\")";
                $stmt = $conn->prepare($sql);

                //Bind our variables.
                $stmt->bindValue(':gender', $gender);
                $stmt->bindValue(':pass', $passwordHash);
                $stmt->bindValue(':Lname', $lastName);
                $stmt->bindValue(':Fname', $firstName);
                $stmt->bindValue(':email', $email);


                //Execute the statement and insert the new account.
                $result = $stmt->execute();
                //echo $result;

                //If the signup process is successful.
                if ($result) {
                    header("Location:login.php?page=signup");
                    exit();
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
              .error {
                  color: red;
              }

              input.inputWidth {
                  width: 70%;
                  padding: 12px 20px;
                  margin: 8px 0;
                  box-sizing: border-box;
                  border: 2px solid black;
                  /* border-radius: 4px; */
              }
          </style>
          <script src="RegisterValidator.js"></script>

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

              <h1 id="register-h1" style="position:relative; right:150px">User Registration</h1>
              <hr>
              <form onsubmit="return validateForm()" action="signup.php" method="POST">

                  <div class="container">

                      <label for="Fname"><b>First Name</b></label><br />
                      <input id="fname" class="inputWidth" type=" text" placeholder="Enter name" name="Fname" value=<?php echo $firstName ?>>
                      <span class="error" id="FNameErr">*</span><br /><br />


                      <label for="Lname"><b>Last Name</b></label><br />
                      <input id="lname" class="inputWidth" type="text" placeholder="Enter name" name="Lname" value = <?php echo $lastName?>>
                      <span class="error" id="LNameErr">*</span><br /><br />
                      <!--radio buttons for sex-->
                      <label for="gender"><b>Gender</b></label>
                      <br>
                      <input type="radio" name="gender" value="male" checked> Male<br>
                      <input type="radio" name="gender" value="female"> Female<br>
                      <input type="radio" name="gender" value="other"> Other

                      <br>
                      <label for="email"><b>Email</b></label><br>
                      <input id="email" class="inputWidth" type="text" placeholder="Enter Email" name="email" value = <?php echo $email?>>
                      <span class="error" id="emailErr">*<?php echo $emailErr ?></span><br /><br />

                      <label for="pass"><b>Password</b></label><br>
                      <input id="pass" class="inputWidth" type="password" placeholder="Enter Password" name="pass">
                      <span class="error" id="passwordErr">*</span><br /><br />

                      <hr>
                      <button type="submit" name="register" class="registerbtn" style="margin-left:50%">Register</button>
                  </div>

                  <div class="container signin">
                      <p>Already have an account? <a href="login.php">Log in</a>.</p>
                  </div>
              </form>
          </div>
      </body>

      </html>