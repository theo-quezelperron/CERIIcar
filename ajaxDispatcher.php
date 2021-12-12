<?php
//nom de l'application
$nameApp = "monApplication";

//action par défaut
$action = "index";

if(key_exists("action", $_REQUEST))
$action =  $_REQUEST['action'];

require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';


foreach(glob($nameApp.'/model/*.class.php') as $model)
	include_once $model ;   

$context = context::getInstance();
$context->init($nameApp);

$view=$context->executeAction($action, $_REQUEST);

//traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($view===false)
{
	echo "Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}
//inclusion du layout qui va lui meme inclure le template view
elseif($view!=context::NONE)
{
    //$context->alerts = [];
    //var_dump($context->alerts);
    // include($nameApp."/view/bandeau.php");
	// include($nameApp."/view/".$action.$view.".php");
    $response_array = [];
    $response_array['bandeau'] = file_get_contents($nameApp."/view/".$action.$view.".php");
    $response_array['corps'] = file_get_contents($nameApp."/view/bandeau.php");
    var_dump($response_array);
    echo json_encode($response_array);
}

?>