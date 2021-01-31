<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$nameErr = $rateErr =  $flightErr = "";
if (isset($_POST['submit'])) {
    if (empty($_POST["txt_name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["txt_name"]);
    }


    if (empty($_POST["txt_rating"])) {
        $rateErr = "Rating is required";
    } else {
        $rate = test_input($_POST["txt_rating"]);
    }

    if (empty($_POST["txt_comment"])) {
        $commentErr = "";
    } else {
        $comment = test_input($_POST["txt_comment"]);
    }

    if (empty($_POST["txt_flight"])) {
        $flightErr = "Choose a flight to review";
    } else {
        $flight = $_POST["txt_flight"];
    }
    echo $flight;
    $date = date('Y-m-d');
    $fdate = date("Y-m-d", strtotime($date));

    if ($nameErr == "" && $rateErr == "" && $flightErr == "") {
        //echo $flight;
        list($ticket_no, $cust_id) = explode("|", $flight);

        require_once "include/db_connect.php";
        try {
            $conn->beginTransaction();
            $rateSql = "INSERT INTO ratings (CustID, Comment, TicketNo, ratings, name,reviewdate)
                        VALUES(?,?,?,?,?,CURDATE())";
            $stmt = $conn->prepare($rateSql);
            $stmt->execute([$cust_id, $comment, $ticket_no, $rate, $name,]);

            $updateSql = "UPDATE ticket SET reviewed = '1' WHERE TicketNo = ?";
            $stmt1 = $conn->prepare($updateSql);
            $stmt1->execute([$ticket_no]);


            $result = $conn->commit();
        } catch (PDOException $e) {
            $conn->rollback();
            echo "ERROR: " . $e->getMessage();
        }
    }
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Review</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/form.css" type="text/css" media="all">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .error {
            color: #FF0000;
        }

        #reviewStyle {
            width: 100%;
            border-collapse: collapse;
        }



        #reviewStyle td,
        th {
            border: 1px solid black;

        }


        #reviewStyle th {
            height: 50px;
            background-color: blue;
            color: white;
        }

        .highlight {
            background-color: paleturquoise;
        }

        #commentStyle {
            width: 75%;
            height: 200px;
            border: 3px solid #cccccc;
            /*padding: 5px;*/
            font-family: Tahoma, sans-serif;
        }

        #btn_more {
            padding: 10px;
            margin-left: 50%;
            background-color: blue;
            color: white;
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            $(document).on("click", "#reviewStyle tr", function() {
                var selected = $(this).hasClass("highlight");
                $("#reviewStyle tr").removeClass("highlight");
                if (!selected)
                    $(this).addClass("highlight");

                var valueclicked = $(this).children('td.fullvalue').text();
                $("#txt_flight").val(valueclicked);
                //alert(valueclicked);
            });
        });

        $(document).ready(function() {


            $(document).on("click", "#btn_more", function() {
                var lastTicketNo = $("#ticketno").val();
                // alert(lastTicketNo);
                var userID = $("#userid").val();


                $('#btn_more').hide();
                $("#loading").text("Loading...");

                $.post(
                    "include/getReviews.php", {
                        lastTicketNo: lastTicketNo,
                        userID: userID
                    },
                    function(data, status) {

                        if (data != '') {
                            //alert(data);
                            $("#ticketno").remove();
                            $('#reviewStyle').append(data);
                            $("#btn_more").show();
                            $("#loading").hide();
                        } else {
                            $('#btn_more').hide();
                            $("#loading").show();
                            $("#loading").text("No more data");
                        }
                    }
                );
            });

        });
    </script>


    <link rel="icon" type="image/jpg" href="images/dodo.jpg">

</head>


<body>
    <div class="main">
        <header>
            <?php //CHANGE $activemenu ="" FOR DIFFERENT PAGE
            $activemenu = "review";


            if (isset($_SESSION['user_id'])) {
                $log = "logout";
            } else {
                $log = "login";
            }

            //$log = "logout";
            include('include/navbar.php'); //THIS LINE REMAINS SAME


            $log = "logout";
            if (isset($_SESSION['admin'])) {
                include('navbaradmin.php'); //THIS LINE REMAINS SAME

            } else {
                include('include/navbar.php'); //THIS LINE REMAINS SAME

            }


            ?>
        </header>
        <?php include('include/db_connect.php');
        $user_id = $_SESSION['user_id'];


        $sql1 = "SELECT ticket.CustID,ticket.TicketNo,ticket.FlightNo,
                                            ticket.booking_date,ticket.class,
                                            flight.Destination, flight.FlightDate,flight.EconomyPrice,flight.FirstPrice
                                    FROM ticket 
                                    INNER JOIN flight 
                                    ON ticket.FlightNo=flight.FlightNo 
                                    WHERE (ticket.CustID=(SELECT CustID FROM customer WHERE UserID=?))
                                    AND ticket.reviewed = '0' 
                                    ORDER BY ticket.TicketNo LIMIT 2";
        $result = $conn->prepare($sql1);
        $result->execute([$user_id]);



        $numrows = $result->rowCount();

        if ($numrows == 0) {
            echo "<h2>No flights booked OR all reviews for flights already made.</h2>";
            exit();
        }
        ?>
        <div style="padding:5% 50%  0% 20%;font-size : 35px;">Review a Flight</div>
        <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Name: <br /><input class = "inputWidth" type="text" name="txt_name" value="<?php echo $_SESSION['user_name'] ?>" readonly />
            <!-- <span class="error">* <?php echo $nameErr; ?></span><br /><br /> -->
            <br/><br/>
            <label><b>Choose a flight you want to rate by clicking on the row representing it<b></label>
            <span class="error"><?php echo "*" . $flightErr; ?>
            </span>

            <table id="reviewStyle">
                <tr>
                    <th>Ticket No</th>
                    <th>Destination</th>
                    <th>Price</th>
                    <th>Flight Date</th>
                    <th>Class</th>
                </tr>
                <?php
                while ($row = $result->fetch()) {
                    $str = "";
                    $str = $str . $row['TicketNo'] . "|";
                    $str = $str . $row['CustID'] . "|";
                    //$str = $str . $row['FlightNo'] . "|";
                    //$str = $str . $row['Destination'] . "|";
                    //$str = $str . $row['price'] . "|";
                    //$str = $str . $row['FlightDate'] . "|";

                    //Last ticket number displayed
                    $ticketNumber = $row['TicketNo'];

                    if ($row['class'] == "Economy") {
                        $price = $row['EconomyPrice'];
                    } else {
                        $price = $row['FirstPrice'];
                    }




                    echo "<tr>";
                    echo "<td>" . $row['TicketNo'] . "</td>";
                    //echo "<td>" . $row['FlightNo'] . "</td>";
                    echo "<td>" . $row['Destination'] . "</td>";
                    echo "<td>" . $price . "</td>";
                    echo "<td>" . $row['FlightDate'] . "</td>";
                    //echo "<td>" . $row['booking_date'] . "</td>";
                    echo "<td>" . $row['class'] . "</td>";
                    echo "<td style='display:none' class='fullvalue'>" . $str . "</td>";
                    echo "</tr>";
                }
                ?>
            </table> <br />
            <!-- PHP button more should not appear when $numrow =0 and when $numrows >$numcount-->
            <!-- where $numcount is all reviews for that user -->

            <input type="button" id="btn_more" value="Show more"></input>
            <p id="loading" style="text-align:center"></p>
            <input type="hidden" name="ticketno" id="ticketno" value="<?php echo $ticketNumber
                                                                        ?>" />
            <input type="hidden" name="userid" id="userid" value="<?php echo $user_id
                                                                    ?>" />

            <input type="hidden" name="txt_flight" id="txt_flight"> </input> <br />

            <label>Select your rating:</label>
            <select name="txt_rating" id="rateStyle">
                <option value="" selected>Please select a value</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <span class="error">* <?php echo $rateErr; ?></span><br /><br />

            Comment: <br />
            <textarea placeholder="Remember, be nice" name="txt_comment" id="commentStyle"></textarea><br /><br />

            <button type="submit" name="submit" class="registerbtn" style = "margin-left:40%">Submit</button>
        </form>
    </div>
</body>

</html>