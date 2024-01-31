<?php

    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'emergency_items';

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

  // Ανάκτηση των δεδομένων από τη φόρμα HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_title = $_POST['requestType'];
    $request_content = $_POST['numberOfPeople'];
    $request_platos = $_POST['g_platos'];
    $request_mikos = $_POST['g_mikos'];
    $request_onomatep = $_POST['onomatep'];
    $request_til = $_POST['til'];

    // Εισαγωγή δεδομένων στη βάση δεδομένων
    $sql = "INSERT INTO requests (request_title, number_of_people, request_time, request_date, request_status, latitude, longitude,onomateponimo,tilefono) 
    VALUES ('$request_title', '$request_content', NOW(), NOW(), 'Εκκρεμές', '$request_platos', '$request_mikos', '$request_onomatep', '$request_til')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Το αίτημα προστέθηκε με επιτυχία!";
    } else {
        echo "Σφάλμα κατά την εισαγωγή: " . $conn->error;
    }
}

    $conn->close();

?>