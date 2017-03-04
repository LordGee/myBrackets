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
            $game = getGameByIdRoundAndGame($_GET['id'], $_GET['r'], $_GET['g']);
        } elseif (isset($_GET['id'])) {
            $event = getEventById($_GET['id'], $_SESSION['user']);
        } elseif (isset($_POST['code']) && $_POST['code'] == 'updateScore') {
            if (getEventById($_POST['id'], $_SESSION['user'])) {
                $update = updateScoreByIdRoundAndGame($_POST['id'], $_POST['gid'], $_POST['score1'], $_POST['score2']);
            }
            header("location: admin_event.php?id={$_POST['id']}");
        } else {
            $events = getAllEventsByUserId($_SESSION['user']);
        }
    } else {
        header("location: index.php");
    }




?>