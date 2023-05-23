<?php 

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {

 ?>

   
 <?php
     include 'db.con.php';   

    $m="SELECT id FROM applicationstatus WHERE status= 'under consideration'";
    $c= mysqli_query($conn, $m);
    if(mysqli_num_rows($c)==1){
        $b= mysqli_fetch_assoc($c);
        $vs=$b['id'];
    }
    ?>
<?php
if (isset($_GET['apply_id'])) {
            $property_id = (int) $_GET['apply_id'];
$property_id='1234';
            $sql = "SELECT id FROM rentalapplication WHERE property_id=$property_id and home_seeker_id={$_SESSION['id']}";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                $sql = "SELECT id FROM rentalapplication ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                   $id1 = (int) str_replace('ra', '', $row['id']) + 1;
                $id1 = 'ra' . str_pad($id, 3, '0', STR_PAD_LEFT);



                $sql = "INSERT INTO rentalapplication 
                        (id, property_id, home_seeker_id, application_status_id) VALUE
                        ('$id1',$property_id,{$_SESSION['id']},'$vs')";
                mysqli_query($conn, $sql);

}}
 $id= $_GET['id'];
    $query1 = "SELECT name, rooms, rent_cost ,location ,max_tenants ,description  FROM Property WHERE id= '$id'";
    $result2 = mysqli_query($conn, $query1);
    if($_SESSION['role']=='homeseeker') {
        $query2 = "SELECT name,phone_number , email_address  FROM HomeOwner WHERE id=(SELECT homeowner_id FROM Property WHERE id='$id')";
        $result3 = mysqli_query($conn, $query2);
    }
    $q="SELECT category FROM PropertyCategory WHERE id=(SELECT property_category_id FROM Property WHERE id='$id')";
    $r = mysqli_query($conn, $q);
    ?>
    <?php
while($row = mysqli_fetch_assoc($result2)){

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


    <div   div class="prop-details">
        <div class="attributes">
            <div class="attr">
                <div class="att">
                    <h4>Property Name</h4>
                </div>
                <div class="detail">
                    <p><?php echo $row['name'] ?></p>
                </div>
            </div>
            
            <div class="attr">
                <div class="att" >
                    <h4>Category</h4>
                </div>
                <div class="detail">
                    <p><?php while ($e = mysqli_fetch_assoc($r)){
                       echo $e['category'];}?></p>
                </div>
            </div>
            
            <div class="attr">
                <div  class="att">
                    <h4>Number of Rooms</h4>
                </div>
                <div class="detail">
                    <p><?php echo $row['rooms'] ?></p>
                </div>
            </div>
            
            <div class="attr">
                <div  class="att">
                    <h4>Rent</h4>
                </div>
                <div class="detail">
                    <p><?php echo $row['rent_cost'] ?></p>
                </div>
            </div>

            <div class="attr">
                <div  class="att">
                    <h4>Max number of tenants</h4>
                </div>
                <div class="detail">
                    <p><?php echo $row['max_tenants'] ?></p>
                </div>
            </div>
            
            <div class="attr">
                <div  class="att">
                    <h4>Location</h4>
                </div>
                <div class="detail">
                    <p><?php echo $row['location'] ?></p>
                </div>
            </div>
    
            <div class="attr">
                <div  class="att">
                    <h4>description</h4>
                </div>
                <div class="detail">
                    <p><?php echo $row['description'] ?></p>
                </div>
            </div>
<?php }
            ?>
    
        </div>
        <div class="images">
            <table>
                <tr>
                    <th class="left-edge">images</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                </tr><?php
                $i= "SELECT path FROM PropertyImage WHERE property_id='$id'";
                $o=mysqli_query($conn, $i);
                while ($row2 = mysqli_fetch_assoc($o)){
                ?>
                
                    <td><img src="<?php echo $row2['path']; ?>" alt=""/></td>
                    <td><img src="<?php echo $row2['path']; ?>" alt=""/></td>
                    <td><img src="<?php echo $row2['path']; ?>" alt=""/></td>
               <?php     } ?>
                </tr>
            </table>
            
        </div>
    </div>
<?php
    if($_SESSION['role']=='homeseeker'){
        $seeker=$_SESSION['id'];
         $x = "SELECT * FROM RentalApplication WHERE home_seeker_id = '$seeker' AND property_id ='$id'";
        
    $s=mysqli_query($conn, $x);
        if(mysqli_num_rows($s)==0){
            echo "<div class='attr'>"." <a href='homeseeker.php?apply_id=$id'>". "<button id='apply' class='table-btn'>Apply</button></a></div>";

    }
  
    
    echo "<h4>HOMEOWNER DETAILS</h4>";

if(mysqli_num_rows($result3)==1){
    $v = mysqli_fetch_assoc($result3);
    
        echo "<table><tr><td><h4>Name</h4> <br>" .$v['name']."</td>";
        echo "<td><h4>Phone number</h4><br>" .$v['phone_number']."</td>";
        echo "<td><h4>Email address</h4> <br>" .$v['email_address']."</td></tr></table>";}

    
        
       
    }
    else{
       echo" <div class='attr'><a href='editproperty.php?id=$id'><button class='table-btn'>Edit</button></a></div>";
    }


?>
    </main>
   
   <!--  <script> $(document).ready(function() {
    $('#apply').click(function() {
        
  <?php /*$number= rand();
  mysqli_query($conn, "INSERT INTO `rentalapplication`(`id`, `property_id`, `home_seeker_id`, `application_status_id`) VALUES ('$number','$id','$n','$vs')");*/ ?>
      });
      }); </script>-->
    </body>
   </html>

   <?php 


}else {
    header('Location: homepage.php');
} 

 
