<?php

$conn = new PDO('mysql:host=localhost; dbname=emergency_items','root','');

foreach ($_POST['item_id'] as $key => $value){
    $sql = 'insert into items(id,name,category,detail_name,detail_value) VALUES (:id, :name, :category, :detail_name, :detail_value)';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'id' => $value,
        'name'=> $_POST['item_name'][$key],
        'category' => $_POST['item_category'][$key],
        'detail_name' => $_POST['item_detail_name'][$key],
        'detail_value' => $_POST['item_detail_value'][$key]
    ]);
}
echo 'Items inserted successfully!';
?>