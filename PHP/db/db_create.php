<?php
    function createNewUser($_e, $_p) {
        global $db;
        $_u = $db->users;
        echo "We got here";
        $_u->insert(
            [
                "email" => $_e,
                "pw" => $_p
            ]
        );
    }
?>