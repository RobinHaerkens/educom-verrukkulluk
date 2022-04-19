<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$usr = new user($db->getConnection());

/// VERWERK 
$data =array( "artikel" -> $art -> selecteerArtikel(8),
              "user"    -> $usr -> selecteerUser(2));


/// RETURN
var_dump($data);