<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/receptinfo.php");
require_once("lib/ingredient.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$usr = new user($db->getConnection());
$keukentype = new keukentype($db->getConnection());
$receptinfo = new receptinfo($db->getConnection());
$ingredient = new ingredient($db->getConnection());


/// VERWERK 
$data =  $ingredient -> selecteerIngredient(3);


              
/// RETURN
echo "<pre>";
var_dump($data);

