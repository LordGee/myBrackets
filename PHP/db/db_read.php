<?php

    function checkIfEmailExists($_e) {
        global $db;
        $users = $db->users;
        $where = array('email' => $_e);
        $user = $users->findOne($where);
        if ($user != null) {
            return true;
        } else {
            return false;
        }
    }

    function loginUser($_e, $_p) {
        global $db;
        $users = $db->users;
        $where = array('email' => $_e, 'pw' => $_p);
        $select = array('_id');
        $user = $users->findOne($where, $select);
        return $user;
    }

    function getEventById($_id, $_user) {
        global $db;
        $e = $db->events;
        $where = array('_id' => new MongoId($_id),
            'administrator' => array('$elemMatch' => ['$id' => new MongoId($_user)]));
        $select = array();
//        var_dump($e->find($where));
        $event = $e->findOne($where, $select);
        return $event;
    }

?>