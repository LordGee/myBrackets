<?php
    require_once ('controllers/function_controller.php');

    if (!isset($error)) {
        $error = "";
    }
    if (!isset($message)) {
        $message = "";
    }

    if (isset($_POST['code'])) {
        if ($_POST['code'] == "registration"){
            if ($_POST['pass1'] === $_POST['pass2']) {
                $encryptPw = encryptPassword($_POST['email'], $_POST['pass1']);
                createNewUser($_POST['email'], $encryptPw);
                $message = "Well Done";
            } else {
                $error = "Your passwords do not match, please try again.";
            }
        }
    }
?>