<?php
// Σύνδεση στη βάση δεδομένων
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emergency_items";

// Δημιουργία σύνδεσης
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ερώτημα SQL για ανάκτηση των δεδομένων από τη βάση
$sql = "SELECT title, offer_amount, username, announcement_title,  latitude ,longitude FROM offers";
$result = $conn->query($sql);

// Αν υπάρχουν αποτελέσματα, μετατροπή τους σε μορφή που μπορεί να χρησιμοποιηθεί από τον JavaScript
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data); // Επιστρέφει τα δεδομένα σε μορφή JSON
} else {
    echo "0 results";
}
$conn->close();
?>