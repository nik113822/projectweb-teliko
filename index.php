<?php
 session_start();
 
   
    include("connect.php");
    include("leitourgikotita.php");

    $user_data = check_login($conn);

    if($_SERVER['REQUEST_METHOD'] == "POST")
  {
      $Name = $_POST['Onomaxristi'];
      $topothesia = $_POST['topothesia'];
     

      if(!empty($Name) && !empty($topothesia))
      {
          //save to database
          $query = "insert into location_politi (onoma_politi,topothesia)
          values ('$Name', '$topothesia')";

          mysqli_query($conn,$query);
          echo"Η διεύθυνση σας καταχωρήθηκε με επιτυχία!";

      }else
      {
          echo "Βάλτε σωστά στοιχεία!";
      }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arxikh</title>
    <style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #7c7ba6;/* very light green */
  color: #333;
}

h1 {
  text-align: center;
  color: blue;
}

.navbar ul {
  list-style-type:disc;/*disc:Default. Uses filled circles as the list marker. */
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: red;
}

.navbar li {
  float: left;
}

.navbar li a {
  display: block;
  padding: 12px 16px;
  text-decoration: none;
  color: white;
}

.navbar li a:hover {
  background-color: lightseagreen;
}

/* Στυλιστική διαμόρφωση για το κείμενο και τους συνδέσμους */
a {
  color: red;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
      </style>
</head>
<body>

<h1>Καλώς ήρθατε στην σελίδα μας</h1>
<nav class="navbar"> 

<ul>
  <li><a href="Αιτήματα.php" target=_blank title="Διαχείριση Αιτημάτων"> Αιτήματα</a></li>
  <li><a href="Ανακ_προσφ.php" target=_blank title="Ανακοινώσεις-Προσφορές"> Ανακοινώσεις-Προσφορές</a></li>
</ul>
</nav>
    

   
  
     Hello <?php echo $user_data['onoma_xristi']; ?>
     <br>
     <br>
     <form method="post" action="">

     <label for="Onomaxristi">Όνομα χρήστη: </label>
     <input type="text" id="Onomaxristi" placeholder="Εισάγετε όνομα χρήστη" name="Onomaxristi">

     <label for="topothesia">Τοποθεσία: </label>
     <input type="text" id="topothesia" placeholder="Εισάγετε θέση στον χάρτη" name="topothesia">

     <button type="submit">Υποβολή</button>
     </form>
     <br>
     <br>
     <br>
     <a href="logout.php">Αποσύνδεση</a>


</body>
</html>