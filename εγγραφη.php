<?php
  session_start();

  include("connect.php");
  include("leitourgikotita.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
      $firstName = $_POST['onoma'];
      $lastName = $_POST['eponimo'];
      $phone = $_POST['tilefono'];
      $email = $_POST['email'];
      $username = $_POST['onoma_xristi'];
      $password = $_POST['kodikos'];

      if(!empty($firstName) && !empty($lastName) && !empty($phone) && !empty($email) && !empty($username) && !empty($password)  && !is_numeric($username))
      {
          $query = "insert into users (onoma, eponimo, tilefono, email, onoma_xristi, kodikos)
          values ('$firstName', '$lastName', '$phone', '$email', '$username', '$password')";

          mysqli_query($conn,$query);

          header("Location: Σύνδεση.php");
          die; // Εξασφαλίζει οτι το σκριπτ σταματάει να εκτελείται μετα την ανακατεύθνση
      }else
      {
          echo "Βάλτε έγκυρα στοιχεία!";
      }
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Χρήση των στυλ στο Bootstrap framework -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!--Λινκ για το style.css"-->   
        <link rel="stylesheet" href="style.css">

    <!--jQuery, Popper.js, and Bootstrap JavaScript libraries-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
        <!-- jQuery: AJAX requests, DOM manipulation-->
        <!-- Popper.js: A library for positioning and aligning -->
        <!-- Bootstrap: Simplifies and accelerates the process of building responsive and visually appealing web applications-->     
        
    <title>Πλατφόρμα συντονισμού εθελοντών</title>
</head>
<body>
  <style type="text/css">
    body {
            background-color: #041029; /* Set your desired background color */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
    #text{
     
       height: 25px;
       border-radius: 5px;
       padding: 4px;
       border: solid thin #aaa;
      }

   #button{
       
      padding:10px;
      width:100px;
      color:white;
      background-color: lightblue;
      border: none;
  }
  #box{
     background-color: grey;
     margin:auto;
     width:300px;
     padding:20px;

  }
</style>
<div id="box">
  <form method="post" action="">
        
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
            <button type="submit" class="btn btn-warning">Εγγραφείτε</button> <!--warning:κιτρινο κουμπί-->

        </form>
    </form>

    <!--provide a link for existing users to log in-->
    <p>Έχετε ήδη λογαριασμό; <a href="Σύνδεση.php">Συνδεθείτε</a></p>

    <p id="mikos"></p>

</div>
</div>
   
</html>