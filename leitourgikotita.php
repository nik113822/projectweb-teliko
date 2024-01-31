<?php
 function check_login($conn){


   if(isset($_SESSION['onoma_xristi']))
   {
        $username = $_SESSION['onoma_xristi'];
        $query = "select * from users where onoma_xristi = '$username' limit 1";
     
        $result = mysqli_query($conn,$query);
        if($result && mysqli_num_rows($result) > 0)
        {

            $user_data= mysqli_fetch_assoc($result);
            return $user_data;
         }

   }

   header("Location: index.php");
   die;
 }
?>