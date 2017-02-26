<?php
    function createNewUser($_e, $_p) {
        global $db;
        $check = checkIfEmailExists($_e);
        if (!$check) {
            $_u = $db->users;
            $_u->insert(
                [
                    "email" => $_e,
                    "pw" => $_p
                ]
            );
            return true;
        } else {
            return false;
        }

    }
?>