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

$context->isLogged = false;
if (!empty($_SESSION["id"])){$context->isLogged = true;}
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
    // include($nameApp."/view/bandeau.php");
	// include($nameApp."/view/".$action.$view.".php");
    $response_array = [];
    if (!function_exists('array_key_first')) {
        function array_key_first(array $arr) {
            foreach($arr as $key => $unused) {
                return $key;
            }
            return NULL;
        }
    }
    if($context->alerts){
        $response_array['bandeau'] = [
            'class' => array_key_first($context->alerts),
            'value' => $context->alerts[array_key_first($context->alerts)]
        ];
        }
    ob_start();
    include($nameApp."/view/".$action.$view.".php");
    $response_array['corps'] = ob_get_contents();
    ob_clean();
    echo json_encode($response_array);
}

?>