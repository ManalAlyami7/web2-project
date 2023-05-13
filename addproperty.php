<?php 

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    if($_SESSION['role'] == 'homeowner') {

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add new Property</title>
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/addproperty.css">
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="avicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
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
<h2>Add new Property</h2>
<form action="">

<div class="container">
        <div class="col">
            <div class="sign"><label>Property Name<br> <input type="text" ></label></div>
            <div class="sign"><label>Category<br> <input type="text" ></label></div>
            <div class="sign"><label>Number of Rooms<br> <input type="text" ></label></div>
            <div class="sign"><label>Rent<br> <input type="text" ></label></div>
            
            
            
            </div>
            
            <div class="col">
            <div class="sign"><label>Location<br> <input type="text" ></label></div>
            <div class="sign"><label>Max number of tenants<br> <input type="text" ></label></div>
            <div class="sign"><label>description<br> <input type="text" ></label></div>
            <div class="sign"><label class="upload">upload pictures of the property<br> <input type="file" class="file-input" accept="image/png, image/gif, image/jpeg" name="image"></label></div>
            
            </div>
    

</div>
<input type="submit" value="Add property">
</form>

</main>
</body>
</html>

<?php 


} else {
    header('Location: homepage.php');
} } else {
    header('Location: homepage.php');
}

 ?>