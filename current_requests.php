<?php
// Σύνδεση με τη βάση δεδομένων
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'emergency_items';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ερώτημα SQL για ανάκτηση των τρεχόντων αιτημάτων
$sql = "SELECT * FROM requests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Αρχή της λίστας
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        // Εμφάνιση των τρεχόντων αιτημάτων ως στοιχεία λίστας
        echo "<li>Είδος: " . $row['request_title'] . ", Πλήθος Ατόμων: " . $row['number_of_people'] . ", Ημερομηνία και ώρα: " .$row['request_time'] . ", Κατάσταση αιτήματος: " .$row['request_status'] ."</li>";
        // Μπορείτε να εμφανίσετε κι άλλες λεπτομέρειες από τη βάση ανάλογα με τη δομή τους
    }
    // Τέλος της λίστας
    echo "</ul>";
} else {
    echo "Δεν υπάρχουν τρέχοντα αιτήματα.";
}

// Κλείσιμο σύνδεσης με τη βάση δεδομένων
$conn->close();
?>
