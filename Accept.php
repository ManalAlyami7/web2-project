<?php


include 'db.con.php';
if(isset($_POST['P_id'])&&isset($_POST['A_id'])){
        
      $p=$_POST['P_id'];
            $a=$_POST['A_id'];
           $query = "UPDATE RentalApplication SET application_status_id = (SELECT id FROM applicationstatus WHERE status ='accepted') WHERE id = '$a'";
        $re5= mysqli_query($conn, $query);
    $query2 = "UPDATE RentalApplication SET application_status_id =(SELECT id FROM applicationstatus WHERE status ='declined')  WHERE property_id = '$p' AND id != '$a'";
   $re4= mysqli_query($conn, $query2);
   if($re4&& $re5){
       
       
       echo true;
   }
  

}
        

        


   