<?php

// URL του JSON αρχείου
$json_url = "http://usidas.ceid.upatras.gr/web/2023/export.php";

// Λαμβάνουμε τα δεδομένα από το JSON αρχείο
$json_data = file_get_contents($json_url);

// Ανάλυση του JSON σε πίνακα PHP
$data = json_decode($json_data, true);  

// Σύνδεση με τη βάση δεδομένων
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emergency_items";

$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert categories into db
foreach ($data['categories'] as $category) {
    $category_id = $category['id'];
    $category_name = $category['category_name'];

    $category_sql = "INSERT INTO categories (id, category_name)
                      VALUES ('$category_id', '$category_name')";


if ($conn->query($category_sql) !== TRUE) {
        echo "Error inserting category record: " . $conn->error;
    }
}


// Εισαγωγή δεδομένων item στη db
foreach ($data['items'] as $item) {
    $id = $item['id'];
    $name = $item['name'];
    $category = $item['category'];

    foreach ($item['details'] as $detail) {
        $detail_name = $detail['detail_name'];
        $detail_value = $detail['detail_value'];

        $sql = "INSERT INTO items(id, name, category, detail_name, detail_value)
                VALUES ('$id', '$name', '$category', '$detail_name', '$detail_value')";

        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully";
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    }
}

// Κλείσιμο σύνδεσης με τη βάση δεδομένων
$conn->close();

?>