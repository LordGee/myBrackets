<?php
//    $options = array(
//        'replicaSet' => false,
//        'connect' => false
//    );
//    if(!class_exists('MongoClient')){
//        $options['persist'] = false;
//    }

$options = array(
    "connectTimeoutMS" => 30000,
//    "replicaSet" => "replicaSetName"
);

    $mdb_server = "localhost";
    $mdb_port = "27017";
    $mdb_name = "mybrackets";

    $m = new MongoClient("mongodb://{$mdb_server}:{$mdb_port}", $options);

//    $mdb_user = "wwbc_user";
//    $mdb_pw = "westDon";
//    $mdb_server = "ds157819.mlab.com";
//    $mdb_port = "57819";
//    $mdb_name = "mybrackets";
//
//    $m = new MongoClient("mongodb://{$mdb_user}:{$mdb_pw}@{$mdb_server}:{$mdb_port}", $options);

    $db = $m->selectDB($mdb_name);

    require_once ('db/db_create.php');
    require_once ('db/db_read.php');

?>