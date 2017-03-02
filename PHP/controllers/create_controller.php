<?php

require_once ('controllers/function_controller.php');

if (!isset($error)) {
    $error = "";
}
if (!isset($message)) {
    $message = "";
}

if (isset($_POST['code'])) {
    if ($_POST['code'] == "addBasic"){
        $_SESSION['e_name'] = $_POST['e_name'];
        $_SESSION['e_description'] = $_POST['e_description'];
        $_SESSION['e_step'] = 2;
    } elseif ($_POST['btn'] == "Confirm Players" && $_POST['code'] == "addParticipants") {
        $_SESSION['e_pcount'] = count($_POST['e_pname']);
        $_SESSION['e_bsize'] = bracketSizeRequire($_SESSION['e_pcount']);
        $_SESSION['e_nrounds'] = howManyRounds($_SESSION['e_bsize']);
        if ($_SESSION['e_bsize'] != 0) {
            $_SESSION['e_step'] = 3;
            $_SESSION['e_pname'] = $_POST['e_pname'];
            $_SESSION['e_email'] = $_POST['e_email'];
            $_SESSION['e_byes'] = $_SESSION['e_bsize'] - $_SESSION['e_pcount'];
            for ($i = 0; $i < $_SESSION['e_byes']; $i++) {
                array_push($_SESSION['e_pname'], "BYE");
                array_push($_SESSION['e_email'], "");
            }
        } else {
            $error = "Not enough players entered";
        }
    } elseif ($_POST['btn'] == "Cancel" && $_SESSION['e_step'] == 2) {
        $_SESSION['e_step'] = 1;
    } elseif ($_POST['code'] == "generate" && $_SESSION['e_step'] == 3) {
        $_SESSION['e_order'] = $_POST['e_order'];
        $_SESSION['e_pname'] = changePlayerOrder($_SESSION['e_order'], $_SESSION['e_pname']);
        $_SESSION['e_email'] = changeEmailOrder($_SESSION['e_order'], $_SESSION['e_email']);
        unset($_SESSION['e_order']);
        $_SESSION['e_id'] = createNewEvent($_SESSION['e_name'], $_SESSION['e_description'], $_SESSION['e_pcount'], $_SESSION['e_bsize'], $_SESSION['e_nrounds'], $_SESSION['user']);
        generateGames($_SESSION['e_bsize'], $_SESSION['e_nrounds'], $_SESSION['e_pname'], $_SESSION['e_email'], $_SESSION['e_id']);
        cleanup();
        header("location: admin_event.php?id={$_SESSION['e_id']}");
    }
}
?>