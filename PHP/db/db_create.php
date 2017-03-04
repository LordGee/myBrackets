<?php
    function createNewUser($_e, $_p, $_n) {
        global $db;
        $check = checkIfEmailExists($_e);
        if (!$check) {
            $user = $db->users;
            $user->insert(
                [
                    "name" => $_n,
                    "email" => $_e,
                    "pw" => $_p
                ]
            );
            return true;
        } else {
            return false;
        }
    }

    function createNewEvent($_name, $_description, $_players, $_size, $_rounds, $_admin) {
        global $db;
        $event = $db->events;
        $ref = $db->createDBRef('users', $_admin);
        $newEvent = array(
            "event_name" => $_name,
            "event_description" => $_description,
            "no_player" => $_players,
            "bracket_size" => $_size,
            "no_rounds" => $_rounds,
            "last_update" => date("Y-m-d H:i:s"),
            "administrator" => [
                $ref
            ]
        );
        $event->insert($newEvent);
        return $newEvent['_id'];
    }

    function addGameNewEvent($_id, $_r, $_g, $_p1, $_p2, $_e1, $_e2, $_m) {
        global $db;
        $event = $db->events;
        $newGame = array('$push' => array(
            "games" => array(
                "id" => new MongoId(),
                "round" => $_r,
                "round_name" => $_m,
                "game" => $_g,
                "player1" => $_p1,
                "email1" => $_e1,
                "player2" => $_p2,
                "email2" => $_e2,
                "score1" => 0,
                "score2" => 0
            )
        )
        );
        $where = array(
            "_id" => $_id
        );
//        var_dump($newGame);
        $event->update($where, $newGame);
    }
?>