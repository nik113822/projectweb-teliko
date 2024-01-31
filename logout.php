<?php

session_start();


if(isset($_SESSION['onoma_xristi']))
{
    unset($_SESSION['onoma_xristi']);
}

header("Location: Σύνδεση.php");
die;

?>