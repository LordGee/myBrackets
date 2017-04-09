<?php
require_once ('controllers/function_controller.php');

if (!isset($error)) {
    $error = "";
}
if (!isset($message)) {
    $message = "";
}

    if (isset($_GET['search']) && $_GET['search'] != "") {
        $result = $eventObject->getAllEventsForSearch($_GET['search']);
    } else {

    }

?>