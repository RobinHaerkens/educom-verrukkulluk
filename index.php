<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/receptinfo.php");
require_once("lib/ingredient.php");
require_once("lib/recept.php");
require_once("lib/boodschappenlijst.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$usr = new user($db->getConnection());
$keukentype = new keukentype($db->getConnection());
$receptinfo = new receptinfo($db->getConnection());
$ingredient = new ingredient($db->getConnection());
$recept = new recept($db->getConnection());
$boodschappen = new boodschappen($db->getConnection());

/// VERWERK 
$data =  $recept -> selecteerRecept(1);
$boodschappen_data = $boodschappen -> selecteerBoodschappen(1);

              
/// RETURN
echo "<pre>";
var_dump($boodschappen_data);

