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
        $_SESSION['e_step'] = 3;
        $_SESSION['e_pname'] = $_POST['e_pname'];
        $_SESSION['e_email'] = $_POST['e_email'];
        $_SESSION['e_pcount'] = count($_SESSION['e_pname']);
        $_SESSION['e_bsize'] = bracketSizeRequire($_SESSION['e_pcount']);
        $_SESSION['e_byes'] = $_SESSION['e_bsize'] - $_SESSION['e_pcount'];
        for ($i = 0; $i < $_SESSION['e_byes']; $i++) {
            array_push($_SESSION['e_pname'], "BYE");
            array_push($_SESSION['e_email'], "");
        }
    } elseif ($_POST['btn'] == "Cancel" && $_SESSION['e_step'] == 2) {
        $_SESSION['e_step'] = 1;
    } elseif ($_SESSION['code'] == "generate" && $_SESSION['e_step'] == 3) {
        $_SESSION['e_order'] = $_POST['e_order'];
        unset($_SESSION['e_step']);
        generateBracket();
    }
}
?>