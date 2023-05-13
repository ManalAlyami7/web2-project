

<!DOCTYPE html>
<html>
<head>
<title>Log in</title>
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/login.css">
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
            <a  href="signup.php">sign-up</a>
            <a class="active" href="login.php">log-in </a>
        </div>
        
    </div>
</header>
<main>
<h2>Log in</h2>
<form id="form1" action="" method="POST">
  <div class="field">
  <label for="user">User type</label>
    <select id="menu" name="user">
    <option id="seeker" name="pk">homeseeker</option>
    <option id ="owner"  name="pk">homeowner</option>
  </select>
  </div>
  <div class="field">
    <label for="email">Email</label>
    <input type="text" id="email" name="email">
  </div>
  <div class="field">
    <label for="Password">Password</label>
    <input type="text" id="Password" name="password">
  </div>
 <input type="submit" value="Log in">
</form> 



<?php
session_start(); 

include "db.con.php";

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $email = validate($_POST['email']);

    $pass = validate($_POST['password']);

    if (empty($email)) {
        // header("Location: login.php?error=username is required");

        exit();

    }else if(empty($pass)){

        // header("Location: login.php?error=Password is required");

        exit();

    }else{

      $sql = "SELECT * FROM homeseeker WHERE email_address='$email' AND password='$pass'";
        $location = "Location: homeseeker.php";
      $location ='';
      if($_POST["user"] == 'homeseeker') {
        $sql = "SELECT * FROM homeseeker WHERE email_address='$email' AND password='$pass'";
        $location = "Location: homeseeker.php";
      } else if ($_POST["user"] == 'homeowner') {
        $sql = "SELECT * FROM homeowner WHERE email_address='$email' AND password='$pass'";
        $location = "Location: homeowner.php";
      }


        

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['email_address'] === $email && $row['password'] === $pass) {

                $_SESSION['id'] = $row['id'];

                $_SESSION['role'] = $_POST['user'];

                header($location);

                exit();

            }else{
                echo '<div class="warning"><p>Incorect User name or password</p></div>';

                exit();

            }

        }else{

          echo '<div class="warning"><p>Incorect User name or password</p></div>';

            exit();

        }

    }

  }?>

  </main>

</body>
</html>

