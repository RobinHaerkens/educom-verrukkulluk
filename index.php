<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/receptinfo.php");
require_once("lib/ingredient.php");
require_once("lib/recept.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$usr = new user($db->getConnection());
$keukentype = new keukentype($db->getConnection());
$receptinfo = new receptinfo($db->getConnection());
$ingredient = new ingredient($db->getConnection());
$recept = new recept($db->getConnection());

/// VERWERK 
$data =  $recept -> selecteerRecept(3);


              
/// RETURN
echo "<pre>";
var_dump($data);

