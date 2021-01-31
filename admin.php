<?php
session_start();

 //add new Flight 
  if (isset($_POST['addflight'])) {
  
    //getting data from input form add flight
    $date = trim($_POST['date']);
    $originairport = trim($_POST['origin_airport']);
    $origin = trim($_POST['origin']);
    $destairport = trim($_POST['destination_airport']);
    $destination = trim($_POST['destination']);
    $takeofftime = trim($_POST['takeofftime']);
    $Landingtime = trim($_POST['Landingtime']);
    $ecoprice=trim($_POST['ecoprice']);
    $busprice=trim($_POST['busprice']);
    $Landingday=trim($_POST['Landingday']);


    require 'include/db_connect.php'; 
    //inserting form data in DB
    $sql = "INSERT INTO flight(Take_off,takeoff_airport,Destination,destination_Airport,takeoffTime,LandingTime,FlightDate,status,EconomyPrice,FirstPrice,arrivaldate) VALUES (:origin,:origin_airport,:destination,:destination_airport,:takeoff,:land,:date,\"Scheduled\",:eco,:first,:arrivaldate)";
    $stmt = $conn->prepare($sql);

    //Bind our variables.
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':origin', $origin);
    $stmt->bindValue(':origin_airport', $originairport);
    $stmt->bindValue(':destination', $destination);
    $stmt->bindValue(':destination_airport', $destairport);
    $stmt->bindValue(':takeoff', $takeofftime);
    $stmt->bindValue(':land', $Landingtime);
    $stmt->bindValue(':eco',  $ecoprice);
    $stmt->bindValue(':first', $busprice);

    //setting landing day date based upon option selected
    if($Landingday=="same"){
      $stmt->bindValue(':arrivaldate', $date);
      
    }
    else{
      $arrdate=date('Y-m-d', strtotime($date. ' + 1 days'));
      $stmt->bindValue(':arrivaldate', $arrdate);
    }
    
    //Execute the statement and insert the new flight.
    $result=$stmt->execute();
    if($result){
      echo '<script language="javascript">';
      echo 'alert("input successful")';
      echo '</script>';
    }



      
   }

   
  //updating status of a flight 
  if (isset($_POST['substatus'])) {
    //getting form data
    $fstatus = trim($_POST['fstatus']);
    $fno = trim($_POST['number']);
    
    //updating status of flight based on flightno input
    require 'include/db_connect.php'; 
    $sql="update flight set status=\"$fstatus\" where flightNo=\"$fno\"";
    $stmt = $conn->prepare($sql);

    //Execute the statement and update flight status.
    $result=$stmt->execute();
    if($result){
    echo '<script language="javascript">';
    echo 'alert("updatesuccessful")';
    echo '</script>';
    }
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="icon" type="image/jpg" href="images/dodo.jpg">
 
<style>
  /*flight registration modal css*/ 
  /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5px auto; /* 15% from the top and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  /* Position it in the top right corner outside of the modal */
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

/* Close button on hover */
.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)}
  to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
  from {transform: scale(0)}
  to {transform: scale(1)}
}

/*Accordion css*/ 
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: cornflowerblue;
}

.panel {
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
</style>

</head>
<script>  
function validateform(){  

  var form = new FormData(document.getElementById("form"));
var x = form.get("ecoprice");
  if (isNaN(x)) 
  {
    alert("Must input numbers");
    return false;
  }

  var y = form.get("busprice");
  if (isNaN(y)) 
  {
    alert("Must input numbers");
    return false;
  }

  var origin = form.get("origin");
  if (isNaN(origin)) 
  {
    return true;
  }
  else{
    alert("Origin cannot be numerical");
    return false;
  }

  var originair = form.get("origin_airport");
  if (isNaN(originair)) 
  {
    return true;
  }
  else{
    alert("Origin airport cannot be numerical");
    return false;
  }

  var destination = form.get("destination");
  if (isNaN(destination)) 
  {
    return true;
  }
  else{
    alert("destination cannot be numerical");
    return false;
  }
  var destair = form.get("destination_airport");
  if (isNaN(destair)) 
  {
    return true;
  }
  else{
    alert("destination airport cannot be numerical");
    return false;
  }
  
}  
</script> 

<body id="page3">
  <div class="main">
    <!--header -->
    <header>
      <?php
      $activemenu = "admin";
      $log = "logout";
      include('navbaradmin.php'); //THIS LINE REMAINS SAME
      ?>
    </header>

    <h2>Admin Page</h2>
    <p>Click on the buttons to choose page to update:</p>

    <button class="accordion">Flight Schedule</button>
    <div class="panel">
      <br>

      <!--adding flights to flight schedule-->
      
      <p >Add flight  <button type="button" style="color:blue" onclick="document.getElementById('id01').style.display='block'">Add </button>

      <!-- Modal for adding flight -->
      <div id="id01" class="modal">

       

        <!-- Modal Content arrival -->
        <form id="form" name="addflight" class="modal-content animate" action="admin.php" method="POST" onsubmit="return validateform()" >
        <span onclick="document.getElementById('id01').style.display='none'"style=" position:relative; left:825px;" class="close" title="Close PopUp">&times;</span>

        <img src="images/dodo5.png" alt="logo" style="width:100px; height:100px; position:relative; left:700px;">

         
          <h1 style="font-size:35px;">Flight Registration</h1>

          <div class="container">
            <label for="date"><b>Flight takeoff date:</b></label>
            <input type="date" id="txtDate" placeholder="" name="date" required>
            <span class="error">*only dates in the future can be selected</span>
            <br><br>

            <label for="origin"><b>Origin</b></label>
            <input type="text" placeholder="Enter origin" name="origin" required>

            <label for="origin_airport"><b>Origin Airport</b></label>
            <input type="text" placeholder="Enter origin airport" name="origin_airport" required>

            <label for="destination"><b>Destination</b></label>
            <input type="text" placeholder="Enter Destination" name="destination" required>

            <label for="destination_airport"><b>Destination  Airport</b></label>
            <input type="text" placeholder="Enter  destination airport" name="destination_airport" required>


            <label for="takeofftime"><b>Take off time</b></label>
            <input type="time" placeholder="Enter take off time " name="takeofftime" required>

            <label for="Landingtime"><b>Estimated arrival time and day</b></label>
            <input type="time" placeholder="Enter Landing time " name="Landingtime" required>
            <select  name="Landingday">
               <option value="same">Same day </option>
               <option value="next">Next day</option>
            </select>

            <br>
            <br>

            <label for="ecoprice"><b>Economy class ticket price:</b></label>
            <input type="text" placeholder="Enter ticket price for economy class" name="ecoprice" required>

            <label for="busprice"><b>First-class ticket price:</b></label>
            <input type="text" placeholder="Enter ticket price for first class  " name="busprice" required>

            <button style="width:60px; height:30px; background-color:cornflowerblue;" type="submit" name="addflight">Submit</button>
      
           </div>

          <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          </div>
       </form>
     </div>



      <p>Update Flight status<button type="button" style="color:blue" onclick="document.getElementById('id02').style.display='block'">Update</button></p>
      <!-- Modal for flight status -->
      <div id="id02" class="modal">
        <span onclick="document.getElementById('id02').style.display='none'"
        class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->
       <form class="modal-content animate" action="admin.php" method="POST">
        <span onclick="document.getElementById('id02').style.display='none'"style=" position:relative; left:925px;" class="close" title="Close PopUp">&times;</span>

         <img src="images/dodo5.png" alt="logo" style="width:100px; height:100px; position:relative; left:800px;">
          
          <h1 style="font-size:35px;">Flight Status</h1>

          <div class="container">

              <label for="number"><b>Flightno</b></label>
              <input type="text" placeholder="Enter flight number" name="number" required>

              <label for="fstatus"><b>status:</b></label>
              <select id="fstatus" name="fstatus">
                <option value="cancelled">cancelled</option>
                <option value="Airborne">Airborne</option>
                <option value="Boarding">Boarding</option>
               <option value="Scheduled">Scheduled</option>
               <option value="Landed">Landed</option>
               <option value="Delayed">Delayed</option>

              </select>

              <button style="width:60px; height:30px; background-color:cornflowerblue;" type="submit" name="substatus">Submit</button>
            
            </div>

            <div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
      </div>
  </div>

    <!-- insert image in database for homepage slideshow-->
    <button class="accordion">Insert Images for homepage slideshow:</button>
    <div class="panel">

      <br/>
      <form method="post" enctype="multipart/form-data">  
        <input type="file" name="image" id="image" />  
        <br/>  
        <br>
        <input style="background-color:cornflowerblue" type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  
      </form>  

      <?php   //inserting image in database

        //DATABASE
        $connect = mysqli_connect("localhost", "root", "15dell15", "dodo3"); 
        $connect-> set_charset("utf8");
        if(isset($_POST["insert"]))  
        {  
          $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
          $query = "INSERT INTO homeimg (imageData ) VALUES ('$file')";  
          if(mysqli_query($connect, $query))  
          {  
            echo '<script>alert("Image Inserted into Database")</script>';  
          }  
        }  
      ?>

    </div>
 
 
    
  </div>

  

</body>

<script>
  // date input validation
  $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#txtDate').attr('min', maxDate);
    $('#txDate').attr('min', maxDate);

});
</script>

<script>
  //accordion js
      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {  
        acc[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var panel = this.nextElementSibling;
          if (panel.style.maxHeight) {
           panel.style.maxHeight = null;
          } else {
           panel.style.maxHeight = panel.scrollHeight + "px";
          } 
        });
      }
</script>
</html>
<script>
$(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>