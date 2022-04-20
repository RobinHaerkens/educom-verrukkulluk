<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/receptinfo.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$usr = new user($db->getConnection());
$keukentype = new keukentype($db->getConnection());
$receptinfo = new receptinfo($db->getConnection());


/// VERWERK 
$data =  $receptinfo -> selecteerReceptinfo(3,"R");


              
/// RETURN
echo "<pre>";
var_dump($data);

