<?php 

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    if($_SESSION['role'] == 'homeowner') {

 ?>

<!DOCTYPE html>
<html>
<head>
<title>edit property</title>
<link rel="stylesheet" href="css/editproperty.css">
<link rel="stylesheet" href="css/navbar.css">
<link rel="apple-touch-icon" sizes="180x180" href="icon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="icon/avicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
        <link rel="manifest" href="icon/site.webmanifest">
</head>

<body>
<header>
    
    <header>
   
        <div class="topnav">
            <div class="logo">
                <a href="homeowner.php"><img src="img/comfortKey-logo.png" alt=""></a>
            </div>
            <div class="navigation">
                <a  href="property-detail.php">Back</a>
                <a  href="logout.php">Log out</a>
                
            </div>
            
        </div>
</header>    
       
</header>
<main>
    <h2>Edit my Property</h2>

<div class="forms">
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="container">
                <div class="col">
                    <?php 
                    include "db.con.php";
                        $prop_id = 1234;
                        $sql = "SELECT * FROM property WHERE id = '$prop_id'";
                        $result = mysqli_query($conn, $sql);
                        $row =mysqli_fetch_array($result);
                        $cat_name = $row['property_category_id'];
                        $cat_results = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM propertycategory WHERE id = '$cat_name'"));
                        $category = $cat_results['category'];
                        $img_sql = "SELECT * FROM propertyimage WHERE property_id = '$prop_id'";
                        $result_img = mysqli_query($conn, $img_sql);
                        
                        
                    ?>
                    <div class="sign"><label>Property Name<br> <input type="text" value="<?php echo $row['name'] ?>" name="name"></label></div>
                    <div class="sign"><label>Category<br> <input type="text" value="<?php echo $category ?>" name="category"></label></div>
                    <div class="sign"><label>Number of Rooms<br> <input type="text" value="<?php echo $row['rooms'] ?>" name="rooms"></label></div>
                    <div class="sign"><label>Rent<br> <input type="text" value="<?php echo $row['rent_cost'] ?>" name="rent"></label></div>
                    
                    </div>
                    
                    <div class="col">
                    <div class="sign"><label>Location<br> <input type="text" value="<?php echo $row['location'] ?>" name="location"></label></div>
                    <div class="sign"><label>Max number of tenants<br> <input type="text" value="<?php echo $row['max_tenants'] ?>" name="tenants"></label></div>
                    <div class="sign"><label>description<br> <input type="text" value="<?php echo $row['description'] ?>" name="description"></label></div>
                    <div class="sign"><label class="upload">upload pictures of the property<br> <input type="file" class="file-input" name="image"></label></div>
                    
                    </div>

        
        </div>
        <input class="save" type="submit" value="Save">
</form>

<div class="images">
    <table>
        <tr>
            <th class="left-edge">images</th>
            <th class="right-edge"></th>
        </tr>
        <?php while($row_img = mysqli_fetch_array($result_img)) {
            $img_id = $row_img['id'];
            $path = $row_img['path'];
            echo "
            <tr>
                <td><img src='$path' alt=''/></td>
                <td><a class='table-btn' href='editproperty.php?img_delete=$img_id&img_path=$path'>Delete</a>
                </td>
            </tr>";
        }
        ?>
        
        
    </table>
    
</div>
</div>
    

</main>
</body>
</html>

<?php 
    if(isset($_GET['img_delete']) && isset($_GET['img_path'])) {
        $image_id = $_GET['img_delete'];
        $img_path = $_GET['img_path'];
        $delete_sql = "DELETE FROM propertyimage WHERE id = '$image_id'";
        unlink($img_path);
        if (mysqli_query($conn, $delete_sql)) {
            header('Location: editproperty.php');
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

    }
?>

<?php 
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if(!(
        isset($_POST['name']) && isset($_POST['category']) && isset($_POST['rooms']) && isset($_POST['rent']) && isset($_POST['location']) && isset($_POST['tenants']) && isset($_POST['description']))) {
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
    
    
    $sql = "UPDATE property SET `property_category_id` = '$category_id', `name` = '$name',  `rooms` ='$rooms', `rent_cost` = '$rent', `location` ='$location', `max_tenants` ='$tenants', `description` ='$description' WHERE id = '$prop_id'";
    $result = mysqli_query($conn, $sql);
     
    $image_path = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./img/" . $image_path;

    if(move_uploaded_file($tempname, $folder)) {    
        $img_id = uniqid();
        $img_sql = "INSERT INTO `propertyimage` (`id`,`property_id`, `path`) VALUES ('$img_id','$prop_id', '$folder')";
        $img_result = mysqli_query($conn, $img_sql);
    }

            
    header('Location: editproperty.php');
 
    
        
}
?>


<?php 


} else {
    header('Location: homepage.php');
} } else {
    header('Location: homepage.php');
}

 ?>