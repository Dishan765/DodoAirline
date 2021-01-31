<?php

$output = '';
require_once "db_connect.php";
$lastTicketNo = htmlspecialchars($_POST['lastTicketNo']);
$user_id = htmlspecialchars($_POST['userID']);
$ticketNumber = '';
// echo $user_id;

// echo $lastTicketNo;
$sql = "SELECT ticket.CustID,ticket.TicketNo,ticket.FlightNo,
                                            ticket.booking_date,ticket.class,
                                            flight.Destination, flight.FlightDate,flight.EconomyPrice,flight.FirstPrice
                                    FROM ticket 
                                    INNER JOIN flight 
                                    ON ticket.FlightNo=flight.FlightNo 
                                    WHERE (ticket.CustID=(SELECT CustID FROM customer WHERE UserID=?))
                                    AND ticket.reviewed = '0' 
                                    AND ticket.TicketNo> ? 
                                    ORDER BY ticket.TicketNo LIMIT 2";
$result = $conn->prepare($sql);
$result->execute([$user_id, $lastTicketNo]);

while ($row = $result->fetch()) {
    $str = "";
    $str = $str . $row['TicketNo'] . "|";
    $str = $str . $row['CustID'] . "|";

    // $sql2 = "SELECT * FROM price WHERE class =? AND flightNo =?";
    // $result2 = $conn->prepare($sql2);
    // $result2->execute([$row['class'], $row['FlightNo']]);

    // while ($row2 = $result2->fetch()) {
    //     $price = $row2['price'];
    // }

    if($row['class'] == "Economy"){
        $price = $row['EconomyPrice'];
    }
    else{
        $price = $row['FirstPrice'];
    }


    //Last ticket number displayed
    $ticketNumber = $row['TicketNo'];

    $output .= "<tr>";
    $output .= "<td>" . $ticketNumber . "</td>";
    $output .= "<td>" . $row['Destination'] . "</td>";
    $output .= "<td>" . $price . "</td>";
    $output .= "<td>" . $row['FlightDate'] . "</td>";
    $output .= "<td>" . $row['class'] . "</td>";
    $output .= "<td style='display:none' class='fullvalue'>" . $str . "</td>";
    $output .= "</tr>";
}

if ($result->rowCount() != 0) {
    $output .= "<input type='hidden' name='ticketno' id='ticketno' value='$ticketNumber' />";
}

echo $output;