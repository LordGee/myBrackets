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
            if ($_s == null) {
                $result = $_d->findOne($_w);
            } else {
                $result = $_d->findOne($_w, $_s);
            }
            return $result;
        }

        public function readFind($_d, $_w, $_s = null) {
            if ($_s == null) {
                $result = $_d->find($_w);
            } else {
                $result = $_d->find($_w, $_s);
            }
            return $result;
        }

        public function readFindOrdered ($_d, $_w, $_s = null) {
            $result = $_d->find($_w, $_s)->sort(array("last_update" => -1));
            return $result;
        }

        public function updateUpdate($_d, $_w, $_u) {
            $_d->findAndModify($_w, $_u);
        }
    }

    class Users extends CRUD {

        public function createNewUser($_e, $_p, $_n) {
            $check = $this->checkIfEmailExists($_e);
            if (!$check) {
                $d = $this->db->users;
                $i = array(
                    "name" => $_n,
                    "email" => $_e,
                    "pw" => $_p
                );
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
            $s = array('_id', 'name');
            $result = $this->readFindOne($d, $w, $s);
            return $result;
        }

        public function getAllUserNames() {
            $d = $this->db->users;
            $w = array();
            $s = array('name');
            $result = $this->readFind($d, $w, $s);
            return $result;
        }

        public function getUserByName($_n) {
            $d = $this->db->users;
            $w = array('name' => $_n);
            $s = array('_id');
            $result = $this->readFindOne($d, $w, $s);
            return $result;
        }

        public function getUserById($_id) {
            $d = $this->db->users;
            $w = array('_id' => new MongoId($_id));
            $s = array();
            $result = $this->readFindOne($d, $w, $s);
            return $result;
        }

        public function updateUserProfile($_id, $_n, $_e, $_p, $_pw) {
            $d = $this->db->users;
            $w = array('_id' => new MongoId($_id));
            $u = array(
                '$set' => array(
                    'name' => $_n,
                    'email' => $_e,
                    'picture' => $_p,
                    'pw' => $_pw
                )
            );
            $result = $this->updateUpdate($d, $w, $u);
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

        public function updateNewAdmin($_eID, $_aID) {
            $d = $this->db->events;
            $ref = $this->db->createDBRef('users', $_aID);
            $w = array('_id' => new MongoId($_eID));
            $u = array('$push' =>
                array("administrator" => $ref)
            );
            $game = $this->updateUpdate($d, $w, $u);
            return $game;
        }

        public function updateDate($_id) {
            $d = $this->db->events;
            $w = array('_id' => new MongoId($_id));
            $u = array(
                '$set' => array(
                    "last_update" => date("Y-m-d H:i:s")
                )
            );
            $game = $this->updateUpdate($d, $w, $u);
            return $game;
        }

        public function getEventById($_id, $_u) {
            $d = $this->db->events;
            $w = array('_id' => new MongoId($_id),
                'administrator' => array('$elemMatch' => ['$id' => new MongoId($_u)]));
            $s = array();
            $result = $this->readFindOne($d, $w, $s);
            return $result;
        }

        public function getEventByEventId($_id) {
            $d = $this->db->events;
            $w = array('_id' => new MongoId($_id));
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

        public function getGameByIdRoundAndGame($_id, $_gid) {
            $d = $this->db->events;
            $w = array('_id' => new MongoId($_id),
                'games.id' => new MongoId($_gid));
            $result = $this->readFindOne($d, $w);
            return $result;
        }

        public function getRecentlyUpdatedEvents() {
            $d = $this->db->events;
            $w = array();
            $s = array('_id', 'event_name', 'event_description', 'bracket_size', 'last_update');
            $result = $this->readFindOrdered($d, $w, $s);
            $result->limit(6);
            return $result;
        }

        public function updateGameNewEvent($_id, $_r, $_g, $_p1, $_p2, $_e1, $_e2, $_m) {
            $s1 = 0;
            $s2 = 0;
            if ($_p1 == "BYE") {
                $s2 = 1;
            } elseif ($_p2 == "BYE") {
                $s1 = 1;
            }
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
                    "score1" => $s1,
                    "score2" => $s2
                )
            ));
            $w = array("_id" => $_id);
            $this->updateUpdate($d, $w, $u);
        }

        public function updateScoreByIdRoundAndGame($_id, $_gid, $_p1, $_s1, $_p2, $_s2) {
            $d = $this->db->events;
            $w = array('_id' => new MongoId($_id),
                'games.id' => new MongoId($_gid));
            $u = array(
                '$set' => array(
                    'games.$.score1' => (int)$_s1,
                    'games.$.score2' => (int)$_s2,
                    'games.$.player1' => $_p1,
                    'games.$.player2' => $_p2
                )
            );
            $game = $this->updateUpdate($d, $w, $u);
            return $game;
        }

        public function updateWinnerToNextRound($_id, $_ngId, $_p1 = null, $_p2 = null) {
            $d = $this->db->events;
            $w = array('_id' => new MongoId($_id),
                'games.id' => new MongoId($_ngId));
            if ($_p1 != null) {
                $u = array(
                    '$set' => array(
                        'games.$.player1' => $_p1
                    )
                );
            } elseif ($_p2 != null) {
                $u = array(
                    '$set' => array(
                        'games.$.player2' => $_p2
                    )
                );
            } else {
                return false;
            }
            $game = $this->updateUpdate($d, $w, $u);
            return $game;
        }

        public function getAllEventsForSearch($_val) {
            $d = $this->db->events;
            $v = "/" . $_val . "/i";
            $w = array('event_name' => array('$regex' => new MongoRegex($v)));
            $result = $this->readFind($d, $w);
            return $result;
        }
    }

?>