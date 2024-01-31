<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="style.css">
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
    
    <h2>Εισάγετε νέο αίτημα:</h2>
    <form id="requestForm" method="POST">
        <label for="Διαθέσιμα είδη">Διαθέσιμα είδη:</label>
        <select id="requestType" name="requestType" required> <!--create a dropdown menu or a list of options.
             The "required" attribute indicates that the user must select a value before
              submitting a form to ensure that a valid choice is made.-->

              
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
                      document.getElementById("requestType").innerHTML += html; // Προσθήκη του δημιουργημένου HTML στο στοιχείο με το id "category"
                  }
              };
          </script>

            <!-- Add more options as needed -->
        </select>

        <label for="numberOfPeople">Πλήθος ατόμων:</label>
        <input type="number" id="numberOfPeople" name="numberOfPeople" required>

        <label for="g_platos">Γεωγραφικό πλάτος:</label>
        <input type="text" id="g_platos" name="g_platos" required>
        
        <label for="g_mikos">Γεωγραφικό μήκος:</label>
        <input type="text" id="g_mikos" name="g_mikos" required>
        
        <label for="onomatep">Όνοματεπώνυμο χρήστη:</label>
        <input type="text" id="onomatep" name="onomatep" required>

        <label for="til">Τηλέφωνο:</label>
        <input type="text" id="til" name="til" required>
        
        <button type="button" onclick="submitRequest()">Υποβολή αιτήματος</button>
    </form>

    <h5> Συμβουλή: Για να εντοπίσετε το γεωγραφικό μήκος και πλάτος κανετε τα εξης: <br>
            1.Πηγαίνετε στη σελίδα του Google Maps. <a href= "https://www.google.com/maps"> Πατήστε πάνω στο λινκ </a> <br>
            2.Κάντε κλικ στην αναζήτηση και εισάγετε τη διεύθυνσή σας. <br>
            3.Αναζητήστε τη διεύθυνση. <br>
            4.Κάντε δεξί κλικ στον χάρτη όπου εμφανίζεται η διεύθυνσή σας. <br>
            5.Επιλέξτε "Συντεταγμένες". </h5>

    <h2>Τρέχοντα Αιτήματα(1:ολοκληρωμένο, 2:αποδεκτό, 3:ακυρωμένο)</h2>
  <ul id="currentRequests">
    <!-- Εδώ θα εμφανίζονται τα τρέχοντα αιτήματα -->
  </ul>
    <script>
        $('#currentRequests').load('current_requests.php');
        function submitRequest() {
          const itemType = document.getElementById('requestType').value;
          const numberOfPeople = document.getElementById('numberOfPeople').value;
          const glatitude = document.getElementById('g_platos').value;
          const glongitude = document.getElementById('g_mikos').value;
          const onomatepp = document.getElementById('onomatep').value;
          const till = document.getElementById('til').value;
          
          // Εδώ μπορείτε να κάνετε οτιδήποτε χρειάζεται για την υποβολή του αιτήματος
          // Για παράδειγμα, μπορείτε να καταχωρήσετε τα δεδομένα σε μια βάση δεδομένων ή να τα αποστείλετε σε έναν server.
    
          // Ένα παράδειγμα για να προσθέσετε το αίτημα στη λίστα των τρεχόντων αιτημάτων:
          //const currentRequests = document.getElementById('currentRequests');
          //const newRequest = document.createElement('li');
          //newRequest.textContent = Είδος: ${itemType}, Πλήθος Ατόμων: ${numberOfPeople};
          //currentRequests.appendChild(newRequest);
           // AJAX κλήση προς το αρχείο PHP για αποθήκευση δεδομένων
    $.ajax({
        type: 'POST',
        url: 'save_request.php',
        data: {
            requestType: itemType,
            numberOfPeople: numberOfPeople,
            g_mikos: glatitude,
            g_platos: glongitude,
            onomatep: onomatepp,
            til: till

        },
        success: function(response) {
            // Ανανέωση της λίστας των τρεχόντων αιτημάτων με τα νέα δεδομένα από τον server
            $('#currentRequests').load('current_requests.php');
        },
        error: function(error) {
            console.log(error);
        }
    });
        }
      </script>

    
</body>
</html>