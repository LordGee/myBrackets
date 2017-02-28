<?php

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
    } elseif ($_POST['code'] == "addParticipants") {
        $_SESSION['e_pname'] = $_POST['e_pname'];
        $_SESSION['e_email'] = $_POST['e_email'];
    }
}
?>