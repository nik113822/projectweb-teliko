<?php
// Σύνδεση με τη βάση δεδομένων
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emergency_items";

$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
}

// Έλεγχος αν η φόρμα έχει υποβληθεί
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Παίρνουμε τα δεδομένα από τη φόρμα
    $firstName = $_POST['onoma'];
    $lastName = $_POST['eponimo'];
    $phone = $_POST['tilefono'];
    $email = $_POST['email'];
    $username = $_POST['onoma_xristi'];
    $password = $_POST['kodikos'];
    $admin = '2';


    // Εισαγωγή νέου χρήστη στη βάση δεδομένων
    $sql = "INSERT INTO users (onoma, eponimo, tilefono, email, onoma_xristi, kodikos, admin)
    values ('$firstName', '$lastName', '$phone', '$email', '$username', '$password','2')";

    if ($conn->query($sql) === TRUE) {
        echo "Επιτυχής εισαγωγή νέου χρήστη.";
    } else {
        echo "Σφάλμα κατά την εισαγωγή νέου χρήστη: " . $conn->error;
    }
}

// Κλείσιμο σύνδεσης με τη βάση δεδομένων
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Δημιουργία Λογαριασμού Διασώστη</title>
    <style type="text/css">
       body {
      background-color: #041029;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    #box {
      background-color: grey;
      margin:auto;
      width: 300px;
      padding: 20px;
    }

    #text, #button {
      margin-top: 10px;
    }

    #button {
      padding: 10px;
      width: 100px;
      color: white;
      background-color: lightblue;
      border: none;
    }
  </style>
</head>
<body>
    <div id="box">
       
        <form action="page2.php" method="POST">
            <h1>Δημιουργία Λογαριασμού Διασώστη</h1>
              
          <!--form control: It's a class defined by Bootstrap. All textual <input> , <textarea> , 
          and <select> elements with . form-control are set to width: 100%; by default-->
      
      
                  <!-- Bootstrap Form Group for Name (The . form-group class is the easiest way to add some structure to forms)-->
                 
                  <div class="form-group">
                    <label for="name">Όνομα:</label>
                    <input type="text" class="form-control" id="name" placeholder="Εισάγετε το όνομα σας" name="onoma">
                  </div>
      
                  <!-- Bootstrap Form Group for last name -->
                  <div class="form-group">
                      <label for="last name">Επώνυμο:</label>
                      <input type="text" class="form-control" id="last name" placeholder="Εισάγετε το επώνυμο σας" name="eponimo">
                    </div>
      
                    <!-- Bootstrap Form Group for phone -->
                  <div class="form-group">
                      <label for="phone">Τηλέφωνο επικοινωνίας:</label>
                      <input type="text" class="form-control" id="phone" placeholder="Εισάγετε το τηλέφωνο σας" name="tilefono">
                    </div>
              
                  <!-- Bootstrap Form Group for Email -->
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Εισάγετε το e-mail σας" name="email">
                  </div>
                  <!-- Bootstrap Form Group for username -->
                  <div class="form-group">
                      <label for="username">Όνομα χρήστη:</label>
                      <input type="text" class="form-control" id="username" placeholder="Εισάγετε το όνομα χρήστη σας" name="onoma_xristi">
      
                    </div>
      
                  <!-- Bootstrap Form Group for Password -->
                  <div class="form-group">
                    <label for="password">Κωδικός:</label>
                    <input type="password" class="form-control" id="password" placeholder="Εισάγετε τον κωδικό σας" name="kodikos">
      
                  </div>

                  <form action="Σύνδεση.php">
            <!-- Bootstrap Form Group for Submit Button -->
            <button type="submit" class="btn btn-warning">Εγγραφή</button> <!--warning:κιτρινο κουμπί-->
        </form>
</div>
</body>
</html>
