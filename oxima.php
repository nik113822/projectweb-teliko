<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emergency_items";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 // Εάν πατηθεί το κουμπί υποβολής της φόρμας
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Πάρτε το όνομα χρήστη από τη φόρμα
    $username_input = $_POST["usernam"];

    // Εκτέλεση ερωτήματος SQL για ανάκτηση των αντίστοιχων εγγραφών
    $sql1 = "SELECT * FROM item_diasosti WHERE onoma_xristi = '$username_input'";
    $result1 = $conn->query($sql1);

    // Έλεγχος αν υπάρχουν εγγραφές
    if ($result1->num_rows > 0) {
        // Εκτύπωση των εγγραφών
        while ($row = $result1->fetch_assoc()) {
            echo "Όνομα Αντικειμένου: " . $row["onoma_item"] . " - Ποσότητα: " . $row["quantity"] . "<br>";
        }
    } else {
        echo "Δεν βρέθηκαν εγγραφές για τον χρήστη " . $username_input;
    }
}

    $conn->close();
    ?>