<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Διαχείριση Προϊόντων</title>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/twitter/-bootstrap/5.1.1/css/bootstrap.min.css' />

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   
    <script>
var ajax = new XMLHttpRequest(); // Δημιουργία ενός νέου αντικειμένου XMLHttpRequest
    ajax.open("GET", "data_categories.php", true); /* Καθορισμός του τύπου του αιτήματος (GET), 
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
                var category = data[a].category_name; // Εξαγωγή του 'category_name' από κάθε στοιχείο
 
                html += "<option value='" + category + "'>" + category + "</option>"; // Δημιουργία μιας συμβολοσειράς HTML που περιέχει ένα στοιχείο <option> για κάθε κατηγορία
            }
            document.getElementById("category").innerHTML += html; // Προσθήκη του δημιουργημένου HTML στο στοιχείο με το id "category"
        }
    };
</script>

<title>Display Map with Markers</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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

#map{  
  position: fixed;
  top: 105px; /* Adjust the top distance from the top of the page */
  left:750px;
  right: 70px; /* Adjust the right distance from the right of the page */
  width: 1000px; /* Set the width of the map container */
  height: 800px; /* Set the height of the map container */
  z-index: 1000; /* Set the z-index to ensure it appears above other content if needed */
}

label {
            margin-top: 10px;
        }

@media only screen and (max-width: 600px) {
    /* Προσαρμογή στη μικρή οθόνη του κινητού τηλεφώνου */
    body {
        font-size: 14px;
    }
}

       
 
</style>
            
</head>
<h1>Welcome admin</h1>
<body class = "bg-dark">
    <div class = "container">
    <div class = "row my-4">
    <div class = "col-lg-10 mx-auto">
    <div class = "card shadow">
    <div class ="card-header">
    <h4>Φόρμα Διαχείρισης Προϊόντων</h4>
    </div>
    <div class = "card-body p-4">
        <div id="show_alert"></div>
    <form action = "#" method="POST" id="add_form">
        <div id = "show_item">
            <div class = "row">
                <div class = "col-md-4 mb-3">
                    <input type="text" name="item_id[]" class = "form-control"
                    placeholder="Item id" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="text" name="item_name[]" class = "form-control"
                    placeholder="Item name" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="number" name="item_category[]" class = "form-control"
                    placeholder="Item category" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="text" name="item_detail_name[]" class = "form-control"
                    placeholder="Item detail name" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="text" name="item_detail_value[]" class = "form-control"
                    placeholder="Item detail value" required> 
                </div>

                <div class = "col-md-2 mb-3 d-grid">
                    
                <button class = "btn btn-success add_item_btn">Προσθέστε περισσότερα</button>
                </div>
            </div>    
         </div>
         <br>
    <div>
        <input type="submit" value="Προσθήκη item στην βάση" class="btn btn-primary w-25" id="add_btn">
    </div> 
   <br>
</form>
    </div>
    </div>
    </div>
    </div>
    </div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<form action = "delete_data.php" method="POST" id="delete_form">
        <div id = "show_item">
            <div class = "row">
                <div class = "col-md-4 mb-3">
                    <input type="text" name="item_id[]" class = "form-control"
                    placeholder="Item id" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="text" name="item_name[]" class = "form-control"
                    placeholder="Item name" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="number" name="item_category[]" class = "form-control"
                    placeholder="Item category" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="text" name="item_detail_name[]" class = "form-control"
                    placeholder="Item detail name" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="text" name="item_detail_value[]" class = "form-control"
                    placeholder="Item detail value" required> 
                </div>

                
            </div>    
         </div>
         <br>
   
    <input type="submit" value="Αφαίρεση item στην βάση" class="btn btn-primary w-25" id="remove_btn">
       <br>
</form>

<script>
    $(document).ready(function(){
        $(".add_item_btn").click(function(e){
            e.preventDefault();
            $("#show_item").prepend(`<div class = "row append_item">
                <div class = "col-md-4 mb-3">
                    <input type="text" name="item_id[]" class = "form-control"
                    placeholder="Item id" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="text" name="item_name[]" class = "form-control"
                    placeholder="Item name" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="number" name="item_category[]" class = "form-control"
                    placeholder="Item category" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="text" name="item_detail_name[]" class = "form-control"
                    placeholder="Item detail name" required>
                </div>

                <div class = "col-md-3 mb-3">
                    <input type="text" name="item_detail_value[]" class = "form-control"
                    placeholder="Item detail value" required> 
                </div>

                <div class = "col-md-2 mb-3 d-grid">
                <button class = "btn btn-danger remomve_item_btn">Αφαίρεση</button>
                </div>
            </div>  `);
        });

        $(document).on('click', '.remove_item_btn', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });

        //ajax request to insert all form data
        $("#add_form").submit(function(e){
            e.preventDefault();
            $("#add_btn").val('Adding...');
            $.ajax({
                url: 'action.php',
                method: 'post',
                data: $(this).serialize(),
                success: function(response){
                $("#add_btn").val('Προσθήκη');
                $("#add_form")[0].reset();
                $(".append_item").remove();
                $("#show_alert").html(`${response}</div>`);
                 }
            });
        });
    });
    
    </script>

<h4>Φόρτωση JSON File</h4>
<ol>
    <li>
        <form action="upload_json.php" method="post" enctype="multipart/form-data">
            <label for="jsonFile">Επέλεξε αρχείο json:</label>
            <input type="file" name="jsonFile" id="jsonFile" accept=".json" />
            <button type="submit">Upload</button>
        </form>
    </li>
    <li>
        <a href="json's data to db.php">URL Φόρτωση του JSON στη βάση δεδομένων</a>
    </li>
</ol>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> <!--imports the Leaflet library into your HTML document-->
    <script src="map.js"></script>

  <style>
    /* Στυλ για τον ευκρινή εμφανισμό των κουμπιών */
    .pagination {
      display: flex;
      list-style: none;
      padding: 0;
    }

    .pagination li {
      margin-right: 5px;
    }
  </style>


  <!-- Περιεχόμενο της σελίδας -->

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
      window.location.href = "admin.php";
    } else {
      // Πηγαίνουμε στη σελίδα που αντιστοιχεί στον αριθμό του κουμπιού
      window.location.href = `page${i}.php`; // Αλλάξτε το όνομα του αρχείου ανάλογα με τις σελίδες σας
    }
  });

      // Προσθήκη του κουμπιού στον κόμβο "pagination"
      paginationContainer.appendChild(button);
    }
  </script>

<a href="logout.php">Αποσύνδεση</a>
</body>
<br>


</html>