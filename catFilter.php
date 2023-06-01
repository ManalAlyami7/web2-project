<?php

include "db.con.php";


if (isset($_POST['category_id'])) {
    $category = 'property_category_id = ' . (int) $_POST['category_id'] . ' AND ';
    if($_POST['category_id'] == ''){
        $category = '';
    }
    $sql = "SELECT p.id, p.name, pc.category, p.rooms, p.location, p.rent_cost
        FROM property as p 
        join propertycategory as pc on pc.id=p.property_category_id
        WHERE $category  p.id NOT in (
            SELECT property_id FROM rentalapplication 
            WHERE application_status_id = '0000'
        )";

    $result = mysqli_query($conn, $sql);

    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}
 else {
    echo '';
}
