<?php




//// Allereerst zorgen dat de "Autoloader" uit vendor opgenomen wordt:
require_once("./vendor/autoload.php");
require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/receptinfo.php");
require_once("lib/ingredient.php");
require_once("lib/recept.php");
require_once("lib/boodschappenlijst.php");

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

/// Twig koppelen:
$loader = new \Twig\Loader\FilesystemLoader("./templates");
/// VOOR PRODUCTIE:
/// $twig = new \Twig\Environment($loader), ["cache" => "./cache/cc"]);

/// VOOR DEVELOPMENT:
$twig = new \Twig\Environment($loader, ["debug" => true ]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

/******************************/

/// Next step, iets met je data doen. Ophalen of zo
$db = new database();
$recept = new recept($db->getConnection());
$ingredient = new ingredient($db->getConnection());
$boodschappen = new boodschappen($db->getConnection());
$waardering = new receptinfo($db->getConnection());

/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/

$recept_id = isset($_GET["recept_id"]) ? $_GET["recept_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";


switch($action) {

        case "homepage": {
            $data = $recept->selecteerRecept();
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        case "detail": {
            $id = $_GET["recept_id"];
            $data = $recept->selecteerRecept($id)[0];
            $template = 'detail.html.twig';
            //$template = 'test.html.twig';
            $title = "detail pagina";
            break;
        }

        case "boodschappen":{
            $id = $_GET["recept_id"];
            $data = $boodschappen->selecteerBoodschappen($id); 
            $template = 'boodschappen.html.twig';
            $title = "boodschappenlijst pagina";
            break;

        }

        case "waardering":{

            header('Content-Type: application/json; charset=utf-8');
            $id = $_GET["recept_id"];
            $value =$_POST["rating"];
            $data = $waardering->ratingOpsturen($id, $value);
            echo json_encode($data);
            
            die();

        }

        case "search": {

            $key = $_POST["keyword"];
            $data = $recept->zoekRecept($key);
            $template = 'homepage.html.twig';
            $title = "home pagina";
            break;
        }
        /// etc


}

/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data]);

