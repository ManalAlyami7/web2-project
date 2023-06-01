

<!DOCTYPE html>
<html>
<head>
<title>Home Owner</title>
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/homeowner.css">
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="avicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
    function Accept(Pid,Aid) {
                         const status = document.getElementById('s');

        $.ajax({
            url: "Accept.php",
            dataType: "json",
             type: "POST",
            data: {P_id: Pid,A_id:Aid},
            success: (res) => {
                        console.log('suc', res);
                       if(res){
                            window.location.reload();
                        }
                        
                    },
                    error: (res) => {
                        console.log('err', res);
                    }
            
                                  });}

    
     function Decline(Pid,Aid) {
                   const s = document.getElementById('s');

        $.ajax({
            url: "Decline.php",
            dataType: "json",
             type: "POST",
            data: {P_id: Pid,A_id:Aid},
                success: (res) => {
                        console.log('suc', res);
                        if(res){
                            window.location.reload();
                        }
                    },
                    error: (res) => {
                        console.log('err', res);
                    }
            
                                  });}

/* /* 
newCategory = select.value;
                const rows = document.getElementById('rows2');
                $.ajax({
                    url: "catFilter.php",
                    dataType: "json",
                    type: "POST",
                    data: { category_id: newCategory },
                    success: (res) => {
                        console.log('suc', res);
                        rows.innerHTML = '';
                        for(i=0; i<res.length; i++) {
                            row = res[i];
                            rows.innerHTML += `<tr>
                                    <td><a href="property-detail.php?id=${row['id'] }">${row['name']}</a></td>
                                    <td>${row['category'] }</td>
                                    <td>${row['rent_cost'] }/month</td>
                                    <td>${row['rooms'] }</td>
                                    <td>${row['location'] }</td>
                                    <td class="apply"><a href="?apply_id=${row['id'] }">Apply</a></td>
                                </tr>`;
                        };
                        if(res.length === 0) rows.innerHTML = `<td>No properties match current category!</td>`;
                    },
                    error: (res) => {
                        console.log('err', res);
                    }

                });
 * $(document).ready(function() {
    
     $('.table-btn').click(function() {
       $.post('declineOrAccept.php',{method: 'decline'}, function(response) {
           var returned = response;
         if(returned){
     $('#status').text(");}
  
        
       });

});
});
$(document).ready(function() {
$('.table-btn').click(function() {
       $.post('declineOrAccept.php',{method: 'accept'}, function(response) {
           var re = response;
           if(re){
                 $('#status').text("");}

});
        }
);

});
    
    */
    </script>
 
</head>
<body>
    <?php
    session_start();
    

    if (!isset($_SESSION['id']) ) {
      header('Location: homepage.php');
      exit;
    }
    if (!isset($_SESSION['role']) ) {
        header('Location: homepage.php');
        exit;
      }
      if ($_SESSION['role'] != 'homeowner') {
        header('Location: homeseeker.php');
        exit;
      }
       include 'db.con.php';

      $userId = $_SESSION['id'];

$query1 = "SELECT * FROM homeowner WHERE id=$userId";
$result = mysqli_query($conn, $query1);


$owner = mysqli_fetch_assoc($result);
$query1 = "SELECT
             Property.name AS property_name,
             Property.location AS property_location,
             CONCAT(HomeSeeker.first_name, ' ', HomeSeeker.last_name) AS applicant_name,
             ApplicationStatus.status AS application_status,
             RentalApplication.id AS application_id,
             RentalApplication.property_id AS property_id,
             RentalApplication.home_seeker_id AS applicant_id
           FROM
             RentalApplication
             JOIN Property ON RentalApplication.property_id = Property.id
             JOIN HomeSeeker ON RentalApplication.home_seeker_id = HomeSeeker.id
             JOIN ApplicationStatus ON RentalApplication.application_status_id = ApplicationStatus.id
           WHERE
             Property.homeowner_id = $userId";
$resultTab1 = mysqli_query($conn, $query1);


$query2 = "SELECT p.id, p.name, pc.category, p.rent_cost, p.rooms, p.location
          FROM Property p
          INNER JOIN PropertyCategory pc ON p.property_category_id = pc.id
          WHERE p.id NOT IN (
            SELECT property_id
            FROM RentalApplication
            WHERE application_status_id = (SELECT id FROM applicationstatus WHERE status = 'accepted')) AND p.homeowner_id = $userId";
$resultTab2 = mysqli_query($conn, $query2);
if(isset($_GET["method"])){
    $property_id = $_GET["P_id"];
    /*if ($_GET["method"] == 'accept' || $_GET["method"] == 'decline') {
      $application_id = $_GET["A_id"];
      if ($_GET["method"] == 'accept') {
        $query = "UPDATE RentalApplication SET application_status_id = '0000' WHERE id = '$application_id'";
        mysqli_query($conn, $query);
        $query = "UPDATE RentalApplication SET application_status_id = '0001'  WHERE property_id = '$property_id' AND id != '$application_id'";
        mysqli_query($conn, $query);
      } else {
        $query = "UPDATE RentalApplication SET application_status_id = '0001' WHERE id = '$application_id'";
        mysqli_query($conn, $query);
      }
    }*/  if ($_GET["method"] == 'delete') {
      $query = "DELETE FROM rentalapplication WHERE property_id=$property_id";
      mysqli_query($conn, $query);
      $query = "DELETE FROM propertyimage WHERE property_id=$property_id";
      mysqli_query($conn, $query);
      $query = "DELETE FROM property WHERE id=$property_id";
      mysqli_query($conn, $query);
    }
    header('location:homeowner.php');
}
    ?>
  <header>
   <div class="topnav">
        <div class="logo">
          <a href="homeowner.php"><img src="img/comfortKey-logo.png" alt=""></a>
        </div>
        <div class="navigation">
            <a href="#info" href="#">my info</a>
            <a  href="logout.php">Log out</a>
        </div>
        
    </div>
</header>
<main>

  <div class="info-container" id="info">
    <video id='vid' width="900" autoplay muted>
        <source src="img/HomeHeader.mp4" type="video/mp4">
      Your browser does not support the video tag.
      </video>      
    <div class="info">
        <h2>Welcome <?php echo $owner['name']; ?>!</h2>
        <div class="info-details">
            <div class="detail">
                <p>name:</p>
                <p><?php echo $owner['name']; ?></p>
            </div>
            
            <div class="detail">
                <p>Phone number:</p>
                <p><?php echo $owner['phone_number']; ?></p>
            </div>
            <div class="detail">
                <p>Email address:</p>
                <p><?php echo $owner['email_address']; ?></p>

            </div>
        </div>
    </div>
</div>

<div class="tables">
  
<table id="rental">
  <caption>Rental Applications</caption>
  <tr>
  <th class="left-edge">Property Name</th>
  <th>Location</th>
  <th>Applicant</th>
  <th>Status</th>
  <th class="right-edge"></th>
  <?php
                while($property = mysqli_fetch_assoc($resultTab1)) {
                    echo "<tr>";
                    echo "<td><a href='property-detail.php?id=" . $property["property_id"] . "'>" . $property["property_name"] . "</a></td>";
                    echo "<td>" . $property["property_location"] . "</td>";
                    echo "<td><a href='applicant.php?id=" . $property["applicant_id"] . "'>" . $property["applicant_name"] . "</a></td>";
                    echo "<td id ='s'>" . $property["application_status"] . "</td>";
                    echo "<td>";
                    if ($property["application_status"] == "under consideration") {?>
                        <button id='acc' class='table-btn' onclick="Accept('<?php echo $property['property_id']; ?>','<?php echo $property["application_id"]; ?>')">Accept</button>

                        <button id='dec' class='table-btn' onclick="Decline('<?php echo $property['property_id']; ?>','<?php echo $property["application_id"]; ?>')">Decline</button>
                        
               <?php     }
                    echo "</td>";
                    echo "</tr>";
      /*  $A_ID= $property["application_id"];
        $P_ID=$property["property_id"];*/
                }
                ?>
 
  </table>
  
  <div class="Listed-prop">
    <h2>Listed Properties</h2>
  <a href="AddProperty.php" class="table-btn add">Add Property</a>

  </div>
  <table id="Listed">
 
  
  <tr>
  <th class="left-edge">Property Name</th>
  <th>Category</th>
  <th>Rent</th>
  <th>Rooms</th>
  <th>Location</th>
  <th class="right-edge"></th>
  </tr>
  <?php
                 while ($property = mysqli_fetch_assoc($resultTab2)) {
                    echo "<tr>";
                    echo "<td><a href='property-detail.php?id=" . $property['id'] . "'>" . $property['name'] . "</a></td>";
                    echo "<td>" . $property['category'] . "</td>";
                    echo "<td>" . $property['rent_cost'] . "</td>";
                    echo "<td>" . $property['rooms'] . "</td>";
                    echo "<td>" . $property['location'] . "</td>";
                    echo "<td><a href='homeowner.php?method=delete&P_id=".$property["id"]."'>delete</a></td>";
                    
                    echo "</tr>";
                }
            
                ?>
  
  
  </table>
</div>

</main>
   

</body>
</html>
