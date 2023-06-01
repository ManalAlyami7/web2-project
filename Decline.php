<?php



include 'db.con.php';
    if(isset($_POST['P_id'])&&isset($_POST['A_id'])){
        
      $p=$_POST['P_id'];
            $a=$_POST['A_id'];
        $query = "UPDATE RentalApplication SET application_status_id = (SELECT id FROM applicationstatus WHERE status ='declined') WHERE id = '$a'";
      if(  mysqli_query($conn, $query)){
        
      echo true;}
   
}
        

        

