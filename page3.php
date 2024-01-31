<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcement_title = $_POST['title'];
    $announcement_content = $_POST['content'];
    
     // Ελέγχουμε αν υπάρχει το πεδίο 'item' στον πίνακα $_POST
     if (isset($_POST['item'])) {
        // Μετατροπή του πίνακα σε συμβολοσειρά με διαχωριστικό ','
        $announcement_items = implode(', ', $_POST['item']);
    } else {
        // Εάν δεν υπάρχει επιλεγμένο item, θέστε το $announcement_items σε κενή συμβολοσειρά ή κάποια τιμή που θέλετε
        $announcement_items = '';
    }

    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'emergency_items';

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert announcement data into the database
    $sql = "INSERT INTO announcements (title, content ,item) VALUES ('$announcement_title', '$announcement_content', '$announcement_items')";

    if ($conn->query($sql) === TRUE) {
        // Get the last inserted announcement ID
        $announcement_id = $conn->insert_id;

        echo "Announcement created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
var ajax = new XMLHttpRequest(); // Δημιουργία ενός νέου αντικειμένου XMLHttpRequest
    ajax.open("GET", "data_items.php", true); /* Καθορισμός του τύπου του αιτήματος (GET), 
    του URL ("data_categories.php") και καθορισμός ότι είναι ασύγχρονο (true)*/
    ajax.send(); // Αποστολή του αιτήματος
 
    ajax.onreadystatechange = function() /*// Ορισμός μιας συνάρτησης επανάκλησης για τoν χειρισμό
    της απάντησης όταν αλλάζει η κατάσταση του αιτήματος. Στην συνεχεια γινεται ελεγχος αν το αίτημα
    έχει ολοκληρωθεί (readyState == 4) και αν η κατάσταση της απάντησης είναι OK (status == 200)
    Μετα γινεται ανάλυση του responseText (υποθέτοντας ότι είναι έγκυρο JSON) και αποθήκευση του αποτελέσματος
    στη μεταβλητή 'data'. */
    
    {  
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data); //Καταγραφή των δεδομένων στο console για σκοπούς εντοπισμού σφαλμάτων
 
            var itemsSelect = document.getElementById("announcement_items"); //// Ανάκτηση του στοιχείου <select> με βάση το id "announcement_items"

        for(var a = 0; a < data.length; a++) {  // Δημιουργία ενός νέου στοιχείου 'option'
            var item = data[a].name;  // Λήψη της τιμής του πεδίου 'name' από το αντικείμενο του πίνακα 'data'

            var option = document.createElement("option");
            option.value = item;   // Ορισμός της τιμής της επιλογής (value) ως το 'item'
            option.text = item; // Ορισμός του κειμένου της επιλογής ως το 'item'

            itemsSelect.add(option);  // Προσθήκη της επιλογής στο dropdown
        }
    }
};
</script>
<style>
        body {
            background-color: #7ea39f;
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
</head>
<body>

<!-- Announcement Form -->
<div class="card shadow mt-4">
    <div class="card-header">
        <h4>Φόρμα Δημιουργίας Ανακοινώσεων</h4>
    </div>
    <div class="card-body p-4">
        <form action="#" method="POST" id="announcement_form">
            <div class="mb-3">
                <label for="announcement_title" class="form-label">Τίτλος Ανακοίνωσης</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <br>

            <div class="mb-3">
                <label for="announcement_content" class="form-label">Περιεχόμενο Ανακοίνωσης</label>
                <textarea class="form-control" name="content" required></textarea>
            </div>
<br>

<div class="mb-3">
                <label for="announcement_items" class="form-label">Είδη</label>
                <select class="form-control" name="item[]" required id="announcement_items" multiple>
                <option value="" disabled selected>Επιλέξτε Είδη</option>
        <!-- Options will be dynamically loaded here -->
    </select>
            </div>
<br>
            <button type="submit" class="btn btn-primary">Δημιουργία Ανακοίνωσης</button>
        </form>
    </div>
</div>
<br>
<br>
<h2>ΠΡΟΒΟΛΗ ΚΑΤΑΣΤΑΣΗ ΑΠΟΘΗΚΗΣ</h2>
<br>

<script>
  // Καλεί το PHP αρχείο και παίρνει τα δεδομένα με JSON
fetch('apothiki_admin.php')
    .then(response => response.json())
    .then(data => {
        // Εδώ μπορείτε να χειριστείτε τα δεδομένα που έχετε πάρει
        displayData(data);
    })
    .catch(error => console.error('Error:', error));

function displayData(data) {
    // Εμφανίστε τα δεδομένα στην ιστοσελίδα σας, π.χ. με τη χρήση του DOM
    const itemsTable = document.getElementById('itemsTable');
    const diasostiTable = document.getElementById('diasostiTable');

    // Παράδειγμα για τον πίνακα items
    data.items.forEach(item => {
        const row = itemsTable.insertRow();
        const idCell = row.insertCell(0);
        const nameCell = row.insertCell(1);
        const categoryCell = row.insertCell(2);
        const detailnameCell=row.insertCell(3);
        const detailvalueCell=row.insertCell(4);
        // Προσαρμόστε ανάλογα με τα πεδία που έχετε στον πίνακα
        idCell.textContent = item.id;
        nameCell.textContent = item.name;
        categoryCell.textContent = item.category;
        detailnameCell.textContent = item.detail_name;
        detailvalueCell.textContent = item.detail_value;
    });

    // Παράδειγμα για τον πίνακα item_diasosti
    data.diasosti.forEach(diasosti => {
        const row = diasostiTable.insertRow();
        const onomaItemCell = row.insertCell(0);
        const quantityCell = row.insertCell(1);
        const onomaXristiCell = row.insertCell(2);
        // Προσαρμόστε ανάλογα με τα πεδία που έχετε στον πίνακα
        onomaItemCell.textContent = diasosti.onoma_item;
        quantityCell.textContent = diasosti.quantity;
        onomaXristiCell.textContent = diasosti.onoma_xristi;
    });
}






</script>
<table id="itemsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Detail_name</th>
            <th>Detail_value</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<table id="diasostiTable">
    <thead>
        <tr>
            <h2>ΠΡΟΒΟΛΗ ΚΑΤΑΣΤΑΣΗΣ ΟΧΗΜΑΤΩΝ ΔΙΑΣΩΣΤΩΝ</h2>
            <th>Onoma Item</th>
            <th>Quantity</th>
            <th>Onoma Xristi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>


</body>
</html>