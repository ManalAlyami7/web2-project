<?php 

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    if($_SESSION['role'] == 'homeowner') {

 ?>
<?php
  
if(isset($_GET['id'])){
$id=$_GET['id'];
    include 'db.con.php';
$query1 = "SELECT * FROM `homeseeker` WHERE id='$id'";}
    $result2 = mysqli_query($conn,$query1);
while($row = mysqli_fetch_assoc($result2)){
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Applicant Details</title>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/applicant.css">
        <link rel="apple-touch-icon" sizes="180x180" href="icon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="icon/avicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
        <link rel="manifest" href="icon/site.webmanifest">
    </head>

    <body>
        <header>
   
            <div class="topnav">
                <div class="logo">
                    <a href="homeowner.php"><img src="img/comfortKey-logo.png" alt=""></a>
                </div>
                <div class="navigation">
                    <a  href="homeowner.php">Back</a>
                    <a  href="logout.php">Log out</a>
                    
                </div>
                
            </div>
    </header>
    <main>
        <img src="img/key_door_open1.jpg" alt="">
    <hr>
    <h1>Applicant Details</h1>
    <div class="attributes">
        <div class="attr">
            <div class="att">
                <h4>First Name</h4>
            </div>
            <div class="detail">
                <p><?php echo $row['first_name'];?></p>
            </div>
        </div>
        
        <div class="attr">
            <div class="att" >
                <h4>Last Name</h4>
            </div>
            <div class="detail">
                <p><?php echo $row['last_name'];?></p>
            </div>
        </div>
        
        <div class="attr">
            <div  class="att">
                <h4>Number of family members</h4>
            </div>
            <div class="detail">
                <p><?php echo $row['family_member'];?></p>
            </div>
        </div>
        <div class="attr">
            <div  class="att">
                <h4>Age</h4>
            </div>
            <div class="detail">
                <p><?php echo $row['age'];?></p>
            </div>
        </div>
        
        <div class="attr">
            <div  class="att">
                <h4>Phone Number</h4>
            </div>
            <div class="detail">
                <p><?php echo $row['phone_number'];?></p>
            </div>
        </div>
        
        <div class="attr">
            <div  class="att">
                <h4>Email Address</h4>
            </div>
            <div class="detail">
                <p><?php echo $row['email_address'];?></p>
            </div>
        </div>
        <div class="attr">
            <div  class="att">
                <h4>Income</h4>
            </div>
            <div class="detail">
                <p><?php echo $row['income'];?></p>
            </div>
        </div>
        <div class="attr">
            <div  class="att">
                <h4>Job</h4>
            </div>
            <div class="detail">
                <p><?php echo $row['job'];?></p>
            </div>
        </div>

    </div>

    </main>
    </body>
    
   </html>
<?php } ?>

   <?php 


} else {
    header('Location: homepage.php');
} } else {
    header('Location: homepage.php');
}

