<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign up</title>
<link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/signup.css">
        <link rel="apple-touch-icon" sizes="180x180" href="icon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="icon/avicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
        <link rel="manifest" href="icon/site.webmanifest">
</head>
<body>
<header>
   
        <div class="topnav">
            <div class="logo">
                <a href="homepage.php"><img src="img/comfortKey-logo.png" alt=""></a>
            </div>
            <div class="navigation">
                <a  href="homepage.php">Home Page</a>
                <a class="active" href="signup.php">sign-up</a>
                <a href="login.php">log-in </a>
            </div>
            
        </div>
</header>
<main>
<h2>Sign up</h2>
<form action="" method='POST'>
    
<div class="container">
    <div class="col">
<div class="sign"><label>First name<br> <input type="text" name="first_name"></label></div>
<div class="sign"><label>Last name<br> <input type="text" name="last_name"></label></div>
<div class="sign"><label>Age<br> <input type="text" name="age"></label></div>
</div>

<div class="col">
<div class="sign"><label>Number of family members<br> <input type="text" name="family_member"></label></div>
<div class="sign"><label>Income<br> <input type="text" name="income"></label></div>
<div class="sign"><label>Job<br> <input type="text" name="job"></label></div>
</div>

<div class="col">
<div class="sign"><label>Phone number<br> <input type="text" name="phone_number"></label></div>
<div class="sign"><label>Email<br> <input type="text" name="email_address"></label></div>
<div class="sign"><label>Password<br> <input type="text" name="password"></label></div>
</div>
</div>
<input type="submit" value="Sign up" >
</form>


<?php
    

    
if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the
    // Database Connection.
    include 'db.con.php';   
    
    $first_name = $_POST["first_name"]; 
    $last_name = $_POST["last_name"]; 
    $age = $_POST["age"]; 
    $family_member = $_POST["family_member"]; 
    $income = $_POST["income"]; 
    $job = $_POST["job"]; 
    $phone_number = $_POST["phone_number"]; 
    $email_address = $_POST["email_address"]; 
    $password = $_POST["password"]; 
    $id = uniqid();
            
    
    $sql = "Select * from homeseeker where email_address='$email_address'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0) {
    
            $hash = password_hash($password, 
                                PASSWORD_DEFAULT);
                
            // Password Hashing is used here. 
            $sql = "INSERT INTO `homeseeker` (`id`,`first_name`, `last_name`, `age`,  `family_member`, `income`, `job`, `phone_number`, `email_address`, `password`) VALUES ('$id','$first_name', '$last_name', '$age', '$family_member', '$income', '$job', '$phone_number', '$email_address',
                '$hash')";
    
            $result = mysqli_query($conn, $sql);


            if ($result) {


                $_SESSION['id'] =$id;

                $_SESSION['role'] = "homeseeker";

                header('Location: homeseeker.php');

                exit();
                
            }


        
        
    }// end if 
    
   if($num>0) 
   {
    echo '<div class="warning"><p>the email address already exists</p></div>';
    exit();
   } 
    
}//end if   
    
?>

</main>
</body>
</html>
