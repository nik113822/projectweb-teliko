<?php

session_start(); 

include("connect.php");
include("leitourgikotita.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['onoma_xristi'];
    $password = $_POST['kodikos'];

    if (!empty($username) && !empty($password) && !is_numeric($username)) {
        // Ερώτημα στη βάση δεδομένων
        $query = "SELECT * FROM users WHERE onoma_xristi = '$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            // Έλεγχος κωδικού
            if ($user_data['kodikos'] === $password) {
                $_SESSION['onoma_xristi'] = $user_data['onoma_xristi'];

                // Έλεγχος ρόλου "admin"
                if ($user_data['admin'] == 1) {
                    // Είναι admin, οδηγούμε στη σελίδα admin.php
                    header("Location: admin.php");
                    die;
                } else {
                    // Δεν είναι admin, οδηγούμε στη σελίδα index.php
                    header("Location: index.php");
                    die;
                }
            } else {
                echo "Λάθος κωδικός ή όνομα";
            }
        } else {
            echo "Λάθος κωδικός ή όνομα";
        }
    } else {
        echo "Βάλτε έγκυρα στοιχεία!";
    }
}
?>
