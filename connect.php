<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "emergency_items";

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
   
    die("failed to connect!");


}
/*
function registerUser($firstName, $lastName, $phone, $email, $username, $password){
    global $conn;

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (onoma, eponimo, tilefono, email, onoma_xristi, kodikos) VALUES ('$firstName', '$lastName', '$phone', '$email', '$username', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Επιτυχής εγγραφή!";
    } else {
        echo "Σφάλμα κατά την εγγραφή: " . $conn->error;
}
}*/
?>