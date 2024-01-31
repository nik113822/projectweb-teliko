<?php
session_start();

    include("connect.php");
    include("leitourgikotita.php");
    

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        $username = $_POST['onoma_xristi'];
        $password = $_POST['kodikos'];

        if(!empty($username) && !empty($password) && !is_numeric($username))
        {
            //read from database
            $query = "select * from users where onoma_xristi = '$username' limit 1";
            //$query2 = "insert into citizen_data(username_politi,login_time,request_id) VALUES ('$username', NOW(), '0')";
            $result = mysqli_query($conn,$query);
           //$result2 = mysqli_query($conn,$query2);
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    
                    if($user_data['kodikos'] === $password)
                    {
                        $_SESSION['onoma_xristi'] = $user_data['onoma_xristi'];
                        if ($user_data['admin'] == 1) {
                            // Είναι admin, οδηγούμε στη σελίδα admin.php
                            header("Location: admin.php");
                            die;
                        }elseif($user_data['admin'] == 2){
                            // Είναι διασώστης, οδηγούμε στη σελίδα diasostis.php
                            header("Location: diasostis.php");
                        }
                         else {
                           
                        header("Location: index.php");
                        die;
                    }
                    
                }
            }
            echo "Λάθος κωδικός ή όνομα";

            
        }else
        {
            echo "Βάλτε έγκυρα στοιχεία!";
        }
    }
}
  
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Including this link in our HTML document allows us to use the styles defined in the Bootstrap framework -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!--A link to our external stylesheet file (style.css)"-->   
        <link rel="stylesheet" href="style.css">

    <!--include jQuery, Popper.js, and Bootstrap JavaScript libraries-->
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
    <form method="post">
        <div style="font-size:20px;margin:10px;color: white;">Συνδεθείτε</div>
        <!-- Bootstrap Form Group for username -->
        <div class="form-group">
            <label for="username">Όνομα χρήστη:</label>
            <input type="text" class="form-control" id="username" placeholder="Εισάγετε το όνομα χρήστη σας" name="onoma_xristi">

          </div>

        <!-- Bootstrap Form Group for Password -->
        <div class="form-group">
          <label for="password">Κωδικός:</label>
          <input type="password" class="form-control" id="password" placeholder="Εισάγετε τον κωδικό σας" name="kodikos">
            
          <!--Bootstrap Form Group for log in Button-->
          <button type="submit" class="btn btn-dark"  onclick="check_login() , login()">Συνδεθείτε</button>
          <p class="exist">Δεν έχετε λογαριασμό; <a href="εγγραφη.php">Εγγραφή</a></p>
        </div>
    </form> 
    
</div>

</body>
</html>