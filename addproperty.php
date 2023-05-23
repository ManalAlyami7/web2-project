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
<form action="" enctype="multipart/form-data" method="POST" >

<div class="container">
        <div class="col">
            <div class="sign"><label>Property Name<br> <input type="text" name="name"></label></div>
            <div class="sign"><label>Category<br>
             <select type="text" name="category">
                <option value="villa">villa</option>
                <option value="appartment">appartment</option>
             </select>
        
            </label></div>
            <div class="sign"><label>Number of Rooms<br> <input type="text" name="rooms"></label></div>
            <div class="sign"><label>Rent<br> <input type="text" name="rent"></label></div>
            
            
            
            </div>
            
            <div class="col">
            <div class="sign"><label>Location<br> <input type="text" name="location"></label></div>
            <div class="sign"><label>Max number of tenants<br> <input type="text" name="tenants"></label></div>
            <div class="sign"><label>description<br> <input type="text" name="description"></label></div>
            <div class="sign"><label class="upload">upload pictures of the property<br> <input type="file" class="file-input" name="image"></label></div>
            
            </div>
    

</div>
<input type="submit" value="Add property">
</form>

<?php
include "db.con.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if(!(
            isset($_POST['name']) && isset($_POST['category']) && isset($_POST['rooms']) && isset($_POST['rent']) && isset($_POST['location']) && isset($_POST['tenants']) && isset($_POST['description']) && isset($_POST['image']))) {

                echo '<div class="warning"><p>Add all fields</p></div>';
                exit();

            }
        $name = $_POST['name'];
        $category = $_POST['category'];
        $row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM propertycategory WHERE category = '$category'"));
        $category_id = $row['id'];
        $rooms = $_POST['rooms'];
        $rent = $_POST['rent'];
        $location = $_POST['location'];
        $tenants = $_POST['tenants'];
        $description = $_POST['description'];
        $homeowner_id = $_SESSION['id'];
        $id = uniqid();

        
        $image_path = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./img/" . $image_path;
        echo $tempname;
    
        move_uploaded_file($tempname, $folder);
        
        
        $sql = "INSERT INTO `property` (`id`,`homeowner_id`, `property_category_id`, `name`,  `rooms`, `rent_cost`, `location`, `max_tenants`, `description`) VALUES ('$id','$homeowner_id', '$category_id', '$name', '$rooms', '$rent', '$location', '$tenants', '$description')";

        $result = mysqli_query($conn, $sql);

        

        if ($result) {

            $img_id = uniqid();
            $img_sql = "INSERT INTO `propertyimage` (`id`,`property_id`, `path`) VALUES ('$img_id','$id', '$folder')";
            $img_result = mysqli_query($conn, $img_sql);

            if($img_result ) {
                header('Location: homeowner.php');
            } else {
                echo '<div class="warning"><p>Something wrong happened with images</p></div>';
            }
            

        }else{

          echo '<div class="warning"><p>Something wrong happened</p></div>';

        }
    }

  ?>

 
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