<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $offer_amount = $_POST['offer'];
    $username = $_POST['onoma_xristi']; 
    $announcement_title = $_POST['an_title'];
    $offer_latitude=$_POST['g_platoss'];
    $offer_longitude=$_POST['g_mhkos'];


    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'emergency_items';

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert offer data into the database
    $sql = "INSERT INTO offers (title, offer_amount, username, announcement_title, latitude, longitude) VALUES
     ('$title', '$offer_amount','$username','$announcement_title','$offer_latitude','$offer_longitude')";

    if ($conn->query($sql) === TRUE) {
        echo "Η προσφορά υποβλήθηκε με επιτυχία!";
    } else {
        echo "Σφάλμα κατά την υποβολή της προσφοράς: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Μη έγκυρη μέθοδος αίτησης!";
}
?>
