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

// Εκτέλεση του SQL query για τον πίνακα items
$sqlItems = "SELECT * FROM items";
$resultItems = $conn->query($sqlItems);

// Εκτέλεση του SQL query για τον πίνακα item_diasosti
$sqlDiasosti = "SELECT * FROM item_diasosti";
$resultDiasosti = $conn->query($sqlDiasosti);

// Αποτελέσματα σε μορφή JSON
$data = [
    'items' => [],
    'diasosti' => []
];

if ($resultItems->num_rows > 0) {
    while ($row = $resultItems->fetch_assoc()) {
        $data['items'][] = $row;
    }
}

if ($resultDiasosti->num_rows > 0) {
    while ($row = $resultDiasosti->fetch_assoc()) {
        $data['diasosti'][] = $row;
    }
}

echo json_encode($data);

// Κλείσιμο της σύνδεσης με τη βάση δεδομένων
$conn->close();
?>