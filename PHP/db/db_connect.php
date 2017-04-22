<?php

    class DBConnection {
        private $mdb_server = "localhost";
        private $mdb_port = "27017";
        private $mdb_name = "mybrackets";
        private $options = array("connectTimeoutMS" => 30000,);

        protected $dbConn;

        public function __construct() {
            $m = new MongoClient("mongodb://{$this->mdb_server}:{$this->mdb_port}", $this->options);
            $this->dbConn = $m->selectDB($this->mdb_name);
        }

        public function getDB() {
            return $this->dbConn;
        }
    }

    require_once ('db/db_crud.php');

    $userObject = new Users();
    $eventObject = new Events();

    /* Live Variables */
    //    $mdb_user = "wwbc_user";
    //    $mdb_pw = "westDon";
    //    $mdb_server = "ds157819.mlab.com";
    //    $mdb_port = "57819";
    //    $mdb_name = "mybrackets";

    //      $m = new MongoClient("mongodb://{$mdb_user}:{$mdb_pw}@{$mdb_server}:{$mdb_port}", $options);

    /* Local Variables */

?>
