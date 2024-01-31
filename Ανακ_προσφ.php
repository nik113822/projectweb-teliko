<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Ανακοινώσεις και Προσφορές</h2>

</body>
   
</html>





<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'emergency_items';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ανάκτηση όλων των ανακοινώσεων
$sql = "SELECT * FROM announcements";
$result = $conn->query($sql);

// Εμφάνιση ανακοινώσεων
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "<h2>{$row['title']}</h2>";
        echo "<p>{$row['content']}</p>";
        echo "<p>Είδος: {$row['item']}</p>";
        echo "<hr>";

         // Φόρμα για εκδήλωση προσφοράς
         echo "<form action='submit_offer.php' method='POST'>";
         echo "<input type='hidden' name='title' value='{$row['title']}'>";
         echo "Όνομα ανακοίνωσης: <input type='text' name='an_title'>";
         echo "Όνοματεπωνυμο: <input type='text' name='onoma_xristi'>";

         echo "Είδος: <input type='text' name='title'>";
         echo "Ποσότητα: <input type='text' name='offer'>"; echo "<br>";
         echo "Γεωγραφικό πλάτος:<input type='text' name='g_platoss'>";
         echo "Γεωγραφικό μήκος:<input type='text' name='g_mhkos'>";
         
         echo "<button type='submit'>Υποβολή Προσφοράς</button>";
         echo "</form>";
 
         echo "<hr>";
    }
} else {
    echo "Δεν υπάρχουν ανακοινώσεις ακόμα.";
}

// Κλείσιμο σύνδεσης
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εμφάνιση Δεδομένων με AJAX</title>
    <!-- Συμπερίληψη της βιβλιοθήκης jQuery -->
    <style>
        body {
            background-color: #6067f0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #343a40;
        }

        .card-header {
            background-color: #343a40;
            color: white;
        }

label {
            margin-top: 10px;
        }
 
</style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<h2>ΠΡΟΒΟΛΗ ΠΡΟΣΦΟΡΩΝ</h2>
<!-- Εμφάνιση δεδομένων σε αυτό το div -->
<div id="result"></div>

<script>
    // Καλείτε όταν το έγγραφο HTML έχει φορτωθεί
    $(document).ready(function() {
        // Κάνει AJAX κλήση για να πάρει τα δεδομένα από τον server
        $.ajax({
            url: 'emfanisi_prosforon_politon.php', 
            type: 'GET',
            dataType: 'json', // Τα δεδομένα που αναμένουμε είναι σε μορφή JSON
            success: function(data) {
            // Δημιουργία δικής σας δομής για την προβολή των δεδομένων
            var html = '<div>';
            $.each(data.offers, function(index, offer) {
                html += '<p>Είδος που προσφέρεται: ' + offer.title + '</p>';
                html += '<p>Ποσότητα:' + offer.offer_amount + '</p>';
                html += '<p>Ονοματεπώνυμο πολίτη: ' + offer.username + '</p>';
                html += '<p>Αφορά την ανακοίνωση: ' + offer.announcement_title + '</p>';
                html += '<hr>';
            });
            html += '</div>';

            // Εμφανίζει το HTML στο div με id "result"
            $('#result').html(html);
        },
        error: function(error) {
            console.error('Σφάλμα κατά τη φόρτωση των δεδομένων:', error);
        }
    });
});
           /* success: function(data) {
                // Εμφανίζει τα δεδομένα στο div με id "result"
                $('#result').html(JSON.stringify(data, null, 10));
            },
            error: function(error) {
                console.error('Σφάλμα κατά τη φόρτωση των δεδομένων:', error);
            }
        });
    });*/
</script>

</body>
</html>
