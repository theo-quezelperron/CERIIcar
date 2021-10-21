<?php

define ('HOST', 'pedagoc.univ-avignon.fr') ;
define ('USER', 'uapv1801268'  ) ;
define ('PASS', 'BP6qFPv6Ade2zE2' ) ;
define ('DB', 'etd' ) ;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class dbconnection{

private static $instance=null,$entityManager;
private $error=null ;

private function __construct(){
	$config = Setup::createAnnotationMetadataConfiguration(array("../../monApplication/model/"), true);

	$param = array(
	'dbname' => 'cericar',
	'user'	=> 'root',
	'password' => '',
	'host'	=> 'localhost',
	'driver' => 'pdo_mysql');
	


	/*self::$connection = \Doctrine\DBAL\DriverManager::getConnection($param, $config);
	echo "is connected : ".self::$connection->getDatabase();*/

	
//	self::$entityManager = \Doctrine\ORM\EntityManager::create($param, $config);
	self::$entityManager = EntityManager::create($param, $config);

	echo "is connected : ".self::$entityManager->getConnection()->getDatabase();

}	

public static function getInstance(){
	if(self::$instance == null){
		self::$instance = new dbconnection();
	}
	return self::$instance;
}

public function closeConnection(){
	self::$instance=null;
}

public function getEntityManager(){
	if(!empty(self::$entityManager)) return self::$entityManager;
	else return NULL;
}


public function __clone(){
	
}

public function getError(){
	return $this->error;
}

}
