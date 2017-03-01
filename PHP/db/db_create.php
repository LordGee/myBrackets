<?php
    function createNewUser($_e, $_p) {
        global $db;
        $check = checkIfEmailExists($_e);
        if (!$check) {
            $user = $db->users;
            $user->insert(
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

    function createNewEvent($_ename, $_edescrip, $_eplayer, $_esize, $_pname) {
        global $db;
        $event = $db->events;
        $event->insert(
            [
                "event_name" => $_ename,
                "event_description" => $_edescrip,
                "no_player" => $_eplayer,
                "backet_size" => $_esize,
                "round" => [
                    "1" => [
                        "game" => [
                            "1" => [
                                "players" => [
                                    "1" => $_pname,
                                    "2" => $_pname
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );
    }
?>