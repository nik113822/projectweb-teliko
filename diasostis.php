<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emergency_items";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$item_diasosti = array();  // Ορισμός του $item_diasosti ως κενός πίνακας

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

$items = array();
while ($row = $result->fetch_assoc()) {
    $items[$row['name']] = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'category' => $row['category'],
        'detail_value' => $row['detail_value']
    );
}
    class diasostis {
        public $name;
        public $inventory = array();

        public function loadItems(&$items, $item_diasosti, $selectedItem, $quantity, $conn) {
            if (isset($items[$selectedItem])) {
                $onoma_item = $items[$selectedItem]['name'];
        
                // Έλεγχος αν υπάρχει αρκετή ποσότητα για το επιλεγμένο αντικείμενο
                if ($items[$selectedItem]['detail_value'] >= $quantity) {
                    $onoma_diasosti = isset($_POST['onoma_diasosti']) ? $_POST['onoma_diasosti'] : '';
        
                    // Έλεγχος αν η εγγραφή υπάρχει ήδη
                    $sql_check_existence = "SELECT * FROM item_diasosti WHERE onoma_item = ? AND onoma_xristi = ?";
                    $stmt_check_existence = $conn->prepare($sql_check_existence);
                    $stmt_check_existence->bind_param("ss", $onoma_item, $onoma_diasosti);
                    $stmt_check_existence->execute();
                    $result_check_existence = $stmt_check_existence->get_result();
        
                    if ($result_check_existence->num_rows > 0) {
                        // Η εγγραφή υπάρχει, επομένως ενημερώνουμε την υπάρχουσα εγγραφή
                        $row = $result_check_existence->fetch_assoc();
                        $new_quantity = $row['quantity'] + $quantity;
        
                        $sql_update = "UPDATE item_diasosti SET quantity = ? WHERE onoma_item = ? AND onoma_xristi = ?";
                        $stmt_update = $conn->prepare($sql_update);
                        $stmt_update->bind_param("iss", $new_quantity, $onoma_item, $onoma_diasosti);
                        $stmt_update->execute();
                        $stmt_update->close();
                    } else {
                        // Η εγγραφή δεν υπάρχει (προστίθεται νέα εγγραφή)
                        $sql_insert = "INSERT INTO item_diasosti (onoma_item, quantity, onoma_xristi) VALUES (?, ?, ?)";
                        $stmt_insert = $conn->prepare($sql_insert);
                        $stmt_insert->bind_param("sis", $onoma_item, $quantity, $onoma_diasosti);
                        $stmt_insert->execute();
                        $stmt_insert->close();
                    }
        
                    // Ενημέρωση του αποθέματος
                    $items[$selectedItem]['detail_value'] -= $quantity;
        
                    $this->inventory[] = array($onoma_item => $quantity);
                    echo "{$this->name} loaded {$quantity} {$onoma_item}<br>";
        
                    // Ενημέρωση του αποθέματος στη βάση δεδομένων
                    $sql_update_items = "UPDATE items SET detail_value = detail_value - ? WHERE name = ?";
                    $stmt_update_items = $conn->prepare($sql_update_items);
                    $stmt_update_items->bind_param("is", $quantity, $onoma_item);
                    $stmt_update_items->execute();
                    $stmt_update_items->close();
                } else {
                    echo "Not enough quantity available for {$onoma_item}<br>";
                }
            } else {
                echo "Selected item not found<br>";
            }
        }
        
        public function unloadItems(&$items, $item_diasosti, $conn) {
            $onoma_diasosti = isset($_POST['onoma_diasosti']) ? $_POST['onoma_diasosti'] : ''; //Εάν υπάρχουν δεδομένα με το όνομα onoma_diasosti που έχουν υποβληθεί μέσω της μεθόδου POST, τότε η μεταβλητή $onoma_diasosti λαμβάνει την αντίστοιχη τιμή. Αν δεν υπάρχουν δεδομένα για το onoma_diasosti στο POST, τότε η μεταβλητή $onoma_diasosti ορίζεται σε μια κενή συμβολοσειρά.
            $selectedItem = isset($_POST['selectedItem']) ? $_POST['selectedItem'] : '';
            $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
        
            if (isset($items[$selectedItem])) {
                $onoma_item = $items[$selectedItem]['name'];
        
                // Έλεγχος αν υπάρχει αρκετή ποσότητα για το επιλεγμένο αντικείμενο στο item_diasosti
                $sql_check_existence = "SELECT * FROM item_diasosti WHERE onoma_item = ? AND onoma_xristi = ?";
                $stmt_check_existence = $conn->prepare($sql_check_existence);
                $stmt_check_existence->bind_param("ss", $onoma_item, $onoma_diasosti);
                $stmt_check_existence->execute();
                $result_check_existence = $stmt_check_existence->get_result();
        
                if ($result_check_existence->num_rows > 0) {
                    // Η εγγραφή υπάρχει, επομένως ενημερώστε την υπάρχουσα εγγραφή
                    $row = $result_check_existence->fetch_assoc(); //ανακτηση της πρώτης σειράς αποτελεσμάτων από το αντικείμενο
                    $existing_quantity = $row['quantity'];
        
                    if ($existing_quantity >= $quantity) {
                        // Υπάρχει αρκετή ποσότητα για unload
                        $new_quantity = $existing_quantity - $quantity;
        
                        // Ενημέρωση του αποθέματος στο item_diasosti
                        $sql_update_item_diasosti = "UPDATE item_diasosti SET quantity = ? WHERE onoma_item = ? AND onoma_xristi = ?";
                        $stmt_update_item_diasosti = $conn->prepare($sql_update_item_diasosti);
                        $stmt_update_item_diasosti->bind_param("iss", $new_quantity, $onoma_item, $onoma_diasosti);
                        $stmt_update_item_diasosti->execute();
                        $stmt_update_item_diasosti->close();
        
                        // Ενημέρωση του αποθέματος στο base inventory (items)
                        $items[$selectedItem]['detail_value'] += $quantity;
        
                        echo "{$this->name} unloaded {$quantity} {$onoma_item}<br>";
                    } else {
                        echo "Not enough quantity available for unload of {$onoma_item}<br>";
                    }
                } else {
                    echo "Selected item not found in user's inventory<br>";
                }
            } else {
                echo "Selected item not found in base inventory<br>";
            }
        }
        
     }
    
    $rescuer = new diasostis();
    $rescuer->name = "diasostis";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Έλεγχος για την υποβολή φόρμας
        if (isset($_POST['loadItems'])) { // λαμβάνει τις τιμές απτο post και καλει την loadItems
            $selectedItem = $_POST['selectedItem'];
            $quantity = $_POST['quantity'];
            $onoma_diasosti = $_POST['onoma_diasosti'];
            $rescuer->loadItems($items, $item_diasosti, $selectedItem, $quantity,$conn);
        } elseif (isset($_POST['unloadItems'])) { 
            $rescuer->unloadItems($items, $item_diasosti,$conn);
        }
    }
    $conn->close();
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
 
            var html = "";// Δημιουργία μιας κενής συμβολοσειράς για να αποθηκεύσει τον HTML κώδικα
            for(var a = 0; a < data.length; a++) {
                var eidos = data[a].name; // Εξαγωγή του 'category_name' από κάθε στοιχείο
 
                html += "<option value='" + eidos + "'>" + eidos + "</option>"; // Δημιουργία μιας συμβολοσειράς HTML που περιέχει ένα στοιχείο <option> για κάθε κατηγορία
            }
            document.getElementById("selectedItem").innerHTML += html; // Προσθήκη του δημιουργημένου HTML στο στοιχείο με το id "category"
        }
    };
</script>

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
</head>
<body>

    <h1>Καλώς ήρθες διασώστη</h1>

    <a href="logout.php">Αποσύνδεση</a>

    <ul class="pagination" id="pagination">
    <!-- Τα κουμπιά θα προστεθούν δυναμικά με JavaScript -->
  </ul>

  <script>
    // Πολλαπλασιαστής: Πόσες σελίδες έχει η σελίδα σας;
    const totalPages = 3;

    // Επιλέγουμε τον κόμβο με το ID "pagination"
    const paginationContainer = document.getElementById("pagination");

    // Δημιουργούμε δυναμικά τα κουμπιά για κάθε σελίδα
    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement("button");
      button.innerText = i;

      // Προσθήκη ακροατή γεγονότος για το κλικ
      button.addEventListener("click", function() {
        // Έλεγχος αν ο αριθμός της σελίδας είναι 1
    if (i === 1) {
      // Πηγαίνουμε στην διαφορετική σελίδα (π.χ., admin.php)
      window.location.href = "diasostis.php";
    } else {
      // Πηγαίνουμε στη σελίδα που αντιστοιχεί στον αριθμό του κουμπιού
      window.location.href =  `diasostis${i}.php`;
    }
  });

      // Προσθήκη του κουμπιού στον κόμβο "pagination"
      paginationContainer.appendChild(button);
    }
  </script> 



    <form method="post">
        <label for="selectedItem">Select Item:</label>
        <select name="selectedItem" id="selectedItem" required>
            <?php foreach ($items as $key => $item) : ?>
                <option value="<?php echo $key; ?>"><?php echo $item['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="onoma_diasosti">Username διασώστη:</label>
        <input type="text" name="onoma_diasosti" id="onoma_diasosti" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>

        <button type="submit" name="loadItems">Load Items</button>
        <button type="submit" name="unloadItems">Unload Items</button>
    </form>
    <br>
        <br>
        <form id="myForm">

        <label for="usernam"> Δώστε το όνομα χρήστη σας:</label>
        <input type="text" name="usernam" id="usernam" required>

        <button type="submit" name="showitem" >Δείτε τι έχει το όχημα σας</button>

    </form>
    <div id="result"></div>   <!-- pairno apotelesma tou ajax gia emfanisi tou pinaka item_diasosti sthn istoselida -->         
    <script>
        $(document).ready(function() {
    $('#myForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var username = $('#usernam').val(); // Get the username from the input field

        $.ajax({
            type: 'POST',
            url: 'oxima.php', 
            data: { usernam: username }, // Send username as POST data to the PHP file
            success: function(response) {
                $('#result').html(response); // Display the response in the 'result' div
            }
        });
    });
});

    </script>


    <p>Updated base inventory:</p>
    <pre><?php print_r($items); ?></pre>

 
</body>
</html>



