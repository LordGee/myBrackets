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
                $success = $userObject->createNewUser($_POST['email'], $encryptPw, $_POST['name']);
                if ($success) {
                    $user = $userObject->loginUser($_POST['email'], $encryptPw);
                    if ($user) {
                        $_SESSION['user'] = $user['_id'];
                        $_SESSION['name'] = $user['name'];
                    }
                    $message = "Well Done, you have successfully registered";
                    header("location: index.php");
                } else {
                    $error = "Your email address is already registered with us";
                }
            } else {
                $error = "Your passwords do not match, please try again.";
            }
        } elseif ($_POST['code'] == "login") {
            $encryptPw = encryptPassword($_POST['email'], $_POST['pass']);
            $user = $userObject->loginUser($_POST['email'], $encryptPw);
            if ($user) {
                $_SESSION['user'] = $user['_id'];
                $_SESSION['name'] = $user['name'];
                $message = "Success!!!";
                header("location: index.php");
            } else {
                $error = "This user can not be found, please check your credentials and try again";
            }
        }
    }
?>