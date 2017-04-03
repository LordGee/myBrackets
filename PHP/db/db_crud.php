<?php
    class CRUD extends DBConnection {

        protected $db;

        public function __construct() {
            parent::__construct();
            $this->db = $this->getDB();
        }

        public function createInsert($_d, $_i) {
            $result = $_d->insert($_i);
            return $result;
        }

        public function readFindOne($_d, $_w, $_s = null) {
            if ($_s != null) {
                $result = $_d->findOne($_w);
            } else {
                $result = $_d->findOne($_w, $_s);
            }
            return $result;
        }

        public function readFind($_d, $_w, $_s = null) {
            if ($_s != null) {
                $result = $_d->find($_w);
            } else {
                $result = $_d->find($_w, $_s);
            }
            return $result;
        }

        public function updateUpdate($_d, $_w, $_u) {
            $_d->update($_w, $_u);
        }
    }

    class Users extends CRUD {

        public function createNewUser($_e, $_p, $_n) {
            $check = $this->checkIfEmailExists($_e);
            if (!$check) {
                $d = $this->db->users;
                $i = array([
                    "name" => $_n,
                    "email" => $_e,
                    "pw" => $_p
                ]);
                $this->createInsert($d, $i);
                return true;
            } else {
                return false;
            }
        }

        public function checkIfEmailExists ($_e) {
            $d = $this->db->users;
            $w = array('email' => $_e);
            $result = $this->readFindOne($d, $w);
            if ($result != null) { return true; }
            else { return false; }
        }

        public function loginUser($_e, $_p) {
            $d = $this->db->users;
            $w = array('email' => $_e, 'pw' => $_p);
            $s = array('_id');
            $result = $this->readFindOne($d, $w, $s);
            return $result;
        }

    }

    class Events extends CRUD {

        function createNewEvent($_name, $_description, $_players, $_size, $_rounds, $_admin) {
            $d = $this->db->events;
            $ref = $this->db->createDBRef('users', $_admin);
            $i = array(
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
            $d->insert($i);
            return $i['_id'];
        }

        public function getEventById($_id, $_u) {
            $d = $this->db->events;
            $w = array('_id' => new MongoId($_id),
                'administrator' => array('$elemMatch' => ['$id' => new MongoId($_u)]));
            $s = array();
            $result = $this->readFindOne($d, $w, $s);
            return $result;
        }

        public function getAllEventsByUserId($_u) {
            $d = $this->db->events;
            $w = array('administrator' => array('$elemMatch' => ['$id' => new MongoId($_u)]));
            $s = array();
            $result = $this->readFind($d, $w, $s);
            return $result;
        }

        function getGameByIdRoundAndGame($_id, $_r, $_g) {
            $d = $this->db->events;
            $w = array('_id' => new MongoId($_id));
            $s = array('games' => array(
                '$elemMatch' => ['round' => (int)$_r, 'game' => (int)$_g]));
            $result = $this->readFindOne($d, $w, $s);
            return $result;
        }

        function updateGameNewEvent($_id, $_r, $_g, $_p1, $_p2, $_e1, $_e2, $_m) {
            $d = $this->db->events;
            $u = array('$push' => array(
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
            ));
            $w = array("_id" => $_id);
            $this->updateUpdate($d, $w, $u);
        }

        function updateScoreByIdRoundAndGame($_id, $_gid, $_s1, $_s2) {
            $d = $this->db->events;
            $w = array('_id' => new MongoId($_id),
                'games.id' => new MongoId($_gid));
            $u = array(
                '$set' => array(
                    'games.$.score1' => (int)$_s1,
                    'games.$.score2' => (int)$_s2
                )
            );
            $game = $this->updateUpdate($d, $w, $u);
            return $game;
        }

    }



//function createNewUser($_e, $_p, $_n) {
//    global $db;
//    $check = checkIfEmailExists($_e);
//    if (!$check) {
//        $user = $db->users;
//        $user->insert(
//            [
//                "name" => $_n,
//                "email" => $_e,
//                "pw" => $_p
//            ]
//        );
//        return true;
//    } else {
//        return false;
//    }
//}

//function createNewEvent($_name, $_description, $_players, $_size, $_rounds, $_admin) {
//    global $db;
//    $event = $db->events;
//    $ref = $db->createDBRef('users', $_admin);
//    $newEvent = array(
//        "event_name" => $_name,
//        "event_description" => $_description,
//        "no_player" => $_players,
//        "bracket_size" => $_size,
//        "no_rounds" => $_rounds,
//        "last_update" => date("Y-m-d H:i:s"),
//        "administrator" => [
//            $ref
//        ]
//    );
//    $event->insert($newEvent);
//    return $newEvent['_id'];
//}

//function addGameNewEvent($_id, $_r, $_g, $_p1, $_p2, $_e1, $_e2, $_m) {
//    global $db;
//    $event = $db->events;
//    $newGame = array('$push' => array(
//        "games" => array(
//            "id" => new MongoId(),
//            "round" => $_r,
//            "round_name" => $_m,
//            "game" => $_g,
//            "player1" => $_p1,
//            "email1" => $_e1,
//            "player2" => $_p2,
//            "email2" => $_e2,
//            "score1" => 0,
//            "score2" => 0
//        )
//    )
//    );
//    $where = array(
//        "_id" => $_id
//    );
////        var_dump($newGame);
//    $event->update($where, $newGame);
//}

//    function checkIfEmailExists($_e) {
//        global $db;
//        $users = $db->users;
//        $where = array('email' => $_e);
//        $user = $users->findOne($where);
//        if ($user != null) {
//            return true;
//        } else {
//            return false;
//        }
//    }

//    function loginUser($_e, $_p) {
//        global $db;
//        $users = $db->users;
//        $where = array('email' => $_e, 'pw' => $_p);
//        $select = array('_id');
//        $user = $users->findOne($where, $select);
//        return $user;
//    }

//    function getEventById($_id, $_user) {
//        global $db;
//        $e = $db->events;
//        $where = array('_id' => new MongoId($_id),
//            'administrator' => array('$elemMatch' => ['$id' => new MongoId($_user)]));
//        $select = array();
////        var_dump($e->find($where));
//        $event = $e->findOne($where, $select);
//        return $event;
//    }

//    function getAllEventsByUserId($_user) {
//        global $db;
//        $e = $db->events;
//        $where = array('administrator' => array('$elemMatch' => ['$id' => new MongoId($_user)]));
//        $select = array();
//        $event = $e->find($where, $select);
//        return $event;
//    }

//    function getGameByIdRoundAndGame($_id, $_r, $_g) {
//        global $db;
//        $e = $db->events;
//        $where = array('_id' => new MongoId($_id));
//        $select = array('games' => array(
//            '$elemMatch' => ['round' => (int)$_r, 'game' => (int)$_g]));
//        $game = $e->findOne($where, $select);
//        return $game;
//    }

?>