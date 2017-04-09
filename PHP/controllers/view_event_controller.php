<?php
require_once ('controllers/function_controller.php');

if (!isset($error)) {
    $error = "";
}
if (!isset($message)) {
    $message = "";
}

    if (isset($_GET['eid']) && $_GET['eid'] != "") {
        $event = $eventObject->getEventByEventId($_GET['eid']);
    }

?>