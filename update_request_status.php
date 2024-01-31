<?php
// Συνδεση στη βάση δεδομένων
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'emergency_items';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Λήψη των δεδομένων από το αίτημα AJAX
$requestTime = $_POST['requestTime'];
$newStatus = $_POST['newStatus'];

// Μετατροπή της νέας κατάστασης σε αριθμητική τιμή (προσαρμογή στην ανάγκη σας)
if ($newStatus == 'Ολοκληρωμένο') {
    $newStatusValue = 1;
} elseif ($newStatus == 'Αποδεκτό') {
    $newStatusValue = 2;
} elseif ($newStatus == 'Ακυρωμένο') {
    $newStatusValue = 3;
} else {
    echo "Μη έγκυρη νέα κατάσταση.";
    exit;
}

// Ενημέρωση της κατάστασης στη βάση δεδομένων
$sql = "UPDATE requests SET request_status = ? WHERE request_time = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Error in preparing statement";
} else {
    $stmt->bind_param("is", $newStatusValue, $requestTime);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Επιτυχής ενημέρωση κατάστασης!";
    } else {
        echo "Αποτυχία ενημέρωσης κατάστασης. Καμία εγγραφή δεν ενημερώθηκε.";
    }

    $stmt->close();
}

$conn->close();
?>



