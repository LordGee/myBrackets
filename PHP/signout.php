<?php

    session_start();
    unset($_SESSION["user"]);
    session_destroy();
    $message = "You have successfully logged out.";
    include "signin.php";

?>