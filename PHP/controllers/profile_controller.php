<?php
require_once ('controllers/function_controller.php');

if (!isset($error)) {
    $error = "";
}
if (!isset($message)) {
    $message = "";
}

    if (isset($_SESSION['user'])) {
        if (isset($_POST['iCode']) && $_POST['iCode'] == 'saveProfile') {
            $encryptPw = encryptPassword($_SESSION['email'], $_POST['pw']);
            $checkPassword = $userObject->loginUser($_SESSION['email'], $encryptPw);
            if ($checkPassword && $_POST['email'] != "") {
                $picture = '';
                if ($_FILES['picture']['error'] != UPLOAD_ERR_NO_FILE) {
                    $picture = uploadPicture();
                } else {
                    $picture = $_POST["currentPic"];
                }
                $newEncryptPw = encryptPassword($_POST['email'], $_POST['pw']);
                $profile = $userObject->updateUserProfile($_SESSION['user'], $_POST['name'], $_POST['email'], $picture, $newEncryptPw);
                if ($profile) {
                    $message = "Profile Updated";
                }
            } else {
                $error = "Incorrect Password or Email Address Invalid  - Please try again";
            }
        }
        $user = $userObject->getUserById($_SESSION['user']);
        $admin = $eventObject->getAllEventsByUserId($_SESSION['user']);
        if (isset($_POST['iCode']) && $_POST['iCode'] == 'edit') {
            $_SESSION['email'] = $user['email'];
        }
    } else {
        header("location: index.php");
    }

?>