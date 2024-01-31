<?php
// Σύνδεση με τη βάση δεδομένων
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emergency_items";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Εκτέλεση του SQL query για τον πίνακα offers
$sqloffers = "SELECT * FROM offers";
$resultoffers = $conn->query($sqloffers);


// Αποτελέσματα σε μορφή JSON
$data = [
    'offers' => [],
];

if ($resultoffers->num_rows > 0) {
    while ($row = $resultoffers->fetch_assoc()) {
        $data['offers'][] = $row;
    }
}


echo json_encode($data);

// Κλείσιμο της σύνδεσης με τη βάση δεδομένων
$conn->close();
?>