<?php
echo "Τρέχοντα αιτήματα πολιτών";
include("current_requests.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <ul id="currentRequests">
       <!--Εδώ θα εμφανίζονται τα τρέχοντα αιτήματα -->
  </ul> 



<h2>Διαχείριση Κατάστασης Αιτημάτων</h2>

<ul id="adminRequests">
    <!-- Εδώ θα εμφανίζονται τα αιτήματα με επιλογή για αλλαγή κατάστασης -->
</ul>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // Φορτώνει τα αιτήματα που χρειάζονται επεξεργασία από τον διαχειριστή
    $('#adminRequests').load('admin_requests.php');
</script>

<script>
    // Συνάρτηση για την αλλαγή της κατάστασης αιτήματος από τον διαχειριστή
    function changeAdminRequestStatus(requestTime) {
        var newStatus = prompt("Εισάγετε τη νέα κατάσταση (Ολοκληρωμένο, Αποδεκτό, Ακυρωμένο):");

        if (newStatus !== null && newStatus !== "") {
            // Κάνετε AJAX κλήση για να ενημερώσετε την κατάσταση στον διακομιστή
            $.ajax({
                type: 'POST',
                url: 'update_request_status.php',
                data: {
                    requestTime: requestTime,
                    newStatus: newStatus
                },
                success: function(response) {
                    // Ανανέωση της λίστας των αιτημάτων που χρειάζονται επεξεργασία από τον διαχειριστή
                    $('#adminRequests').load('admin_requests.php');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }
</script>

</body>
</html>