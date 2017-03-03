<?php
    require_once ('controllers/function_controller.php');

    if (!isset($error)) {
        $error = "";
    }
    if (!isset($message)) {
        $message = "";
    }

    if (isset($_SESSION['user'])) {
        if (isset($_GET['r']) && isset($_GET['g'])) {
            $game = getGameByIdRoundAndGame($_GET['id'], $_GET['r'], $_GET['g'], $_SESSION['user']);
        } elseif (isset($_GET['id'])) {
            $event = getEventById($_GET['id'], $_SESSION['user']);
        } else {
            $events = getAllEventsByUserId($_SESSION['user']);
        }
    } else {
        header("location: index.php");
    }




?>