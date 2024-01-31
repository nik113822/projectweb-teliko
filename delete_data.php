<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "emergency_items";

    // Σύνδεση στη βάση δεδομένων
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Αποτυχία σύνδεσης: " . $conn->connect_error);
    }

    // Διαγραφή δεδομένων από τη βάση
    if (isset($_POST['item_id'])) {
        $item_ids = $_POST['item_id'];

        foreach ($item_ids as $index => $item_id) {
            // Εξασφάλιση των δεδομένων πριν τη χρήση στο ερώτημα SQL
            //$item_id = mysqli_real_escape_string($conn, $item_id); το ειχαμε βαλει για sql injections αλλα τελικα δεν χρειαζεται

            $delete_item_sql = "DELETE FROM items WHERE id = '$item_id'";

            if ($conn->query($delete_item_sql) !== TRUE) {
                echo "Σφάλμα διαγραφής είδους με ID: $item_id - " . $conn->error;
            } else {
                echo "Επιτυχής διαγραφή είδους με ID: $item_id<br>";
            }
        }
    }

    $conn->close();
}
?>
