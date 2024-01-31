<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'emergency_items';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM requests WHERE request_status = 'Εκκρεμές'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<li>';
        echo 'Είδος: ' . $row['request_title'] . ', Πλήθος Ατόμων: ' . $row['number_of_people'];
        echo ', Ημερομηνία και ώρα: ' . $row['request_time'] . ', Κατάσταση αιτήματος: ' . $row['request_status'];
        echo '<button onclick="changeAdminRequestStatus(\'' . $row['request_time'] . '\')">Αλλαγή Κατάστασης</button>';
        echo '</li>';   
    }
} else {
    echo 'Δεν υπάρχουν αιτήματα που χρειάζονται επεξεργασία από τον διαχειριστή.';
}

$conn->close();
?>
