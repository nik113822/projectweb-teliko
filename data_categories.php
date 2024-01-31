<?php
$conn = mysqli_connect("localhost", "root", "", "emergency_items"); 
$result = mysqli_query($conn, "SELECT category_name FROM categories");

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
   
    $data[] = $row;
}

echo json_encode($data);
exit();
?>
