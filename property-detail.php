<?php 

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {

 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Property Details</title>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/property-detail.css">
        <link rel="apple-touch-icon" sizes="180x180" href="icon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="icon/avicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
        <link rel="manifest" href="icon/site.webmanifest">
    </head>

    <body>
        <header>
   
            <div class="topnav">
                <div class="logo">
                    <a href="homeseeker.php"><img src="img/comfortKey-logo.png" alt=""></a>
                </div>
                <div class="navigation">
                    <a  href="homeseeker.php">Back</a>
                    <a  href="logout.php">Log out</a>
                    
                </div>
                
            </div>
    </header>
    <main>
        <img src="img/property-img.jpg" alt="">
    <hr>
    <h1>Property Details</h1>
    <div class="attr">
        <button class="table-btn">Apply</button>
        <a href="editproperty.php"><button class="table-btn">Edit</button></a>
    </div>

    <div   div class="prop-details">
        <div class="attributes">
            <div class="attr">
                <div class="att">
                    <h4>Property Name</h4>
                </div>
                <div class="detail">
                    <p>Olaya Plaza</p>
                </div>
            </div>
            
            <div class="attr">
                <div class="att" >
                    <h4>Category</h4>
                </div>
                <div class="detail">
                    <p>Appartment</p>
                </div>
            </div>
            
            <div class="attr">
                <div  class="att">
                    <h4>Number of Rooms</h4>
                </div>
                <div class="detail">
                    <p>5</p>
                </div>
            </div>
            
            <div class="attr">
                <div  class="att">
                    <h4>Rent</h4>
                </div>
                <div class="detail">
                    <p>3000</p>
                </div>
            </div>

            <div class="attr">
                <div  class="att">
                    <h4>Max number of tenants</h4>
                </div>
                <div class="detail">
                    <p>1</p>
                </div>
            </div>
            
            <div class="attr">
                <div  class="att">
                    <h4>Location</h4>
                </div>
                <div class="detail">
                    <p>Riyadh, Olaya dist</p>
                </div>
            </div>
    
            <div class="attr">
                <div  class="att">
                    <h4>description</h4>
                </div>
                <div class="detail">
                    <p>beautiful appartment...</p>
                </div>
            </div>

            
    
        </div>
        <div class="images">
            <table>
                <tr>
                    <th class="left-edge">images</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td><img src="img/appa.jpeg" alt=""/></td>
                    <td><img src="img/appa.jpeg" alt=""/></td>
                    <td><img src="img/appa.jpeg" alt=""/></td>
                    
                </tr>
            </table>
            
        </div>
    </div>

    </main>
    
    </body>
    
   </html>

   <?php 


} else {
    header('Location: homepage.php');
} 

 ?>