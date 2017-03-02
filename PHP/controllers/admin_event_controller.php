<?php
    require_once ('controllers/function_controller.php');

    if (!isset($error)) {
        $error = "";
    }
    if (!isset($message)) {
        $message = "";
    }

    if (isset($_GET['id'])) {
        $event = getEventById($_GET['id'], $_SESSION['user']);
    }


?>