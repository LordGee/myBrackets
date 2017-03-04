<?php

    function updateScoreByIdRoundAndGame($_id, $_gid, $_s1, $_s2) {
        global $db;
        $e = $db->events;
        $where = array('_id' => new MongoId($_id),
            'games.id' => new MongoId($_gid));
        $update = array(
            '$set' => array(
                'games.$.score1' => (int)$_s1,
                'games.$.score2' => (int)$_s2
            )
        );
        $game = $e->update($where, $update);
        return $game;
    }

?>