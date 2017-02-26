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

?>