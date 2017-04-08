<?php
require_once ('controllers/function_controller.php');

if (!isset($error)) {
    $error = "";
}
if (!isset($message)) {
    $message = "";
}

if (isset($_SESSION['user'])) {

} else {
    header("location: index.php");
}

?>