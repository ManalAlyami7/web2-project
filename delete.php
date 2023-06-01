<?php

include_once 'db.con.php';
$property_id = $_REQUEST['id'];

$query = "DELETE FROM rentalapplication WHERE property_id=$property_id";
mysqli_query($conn, $query);

$query = "DELETE FROM propertyimage WHERE property_id=$property_id";
mysqli_query($conn, $query);

$query = "DELETE FROM property WHERE id=$property_id";
mysqli_query($conn, $query);
echo "Property has been deleted";
