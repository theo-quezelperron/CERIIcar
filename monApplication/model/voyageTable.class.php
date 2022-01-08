<?php

require_once "voyage.class.php";

class voyageTable {

  public static function getVoyagesByTrajet( $trajet ) 
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$voyageRepository = $em->getRepository('voyage');
	$voyage = $voyageRepository->findBy(array('trajet' => $trajet ));	
	
    if ($voyage == false){
		$voyage = []; 
			   }
    
	return $voyage; 
	}
    
	public static function getCorrespondances( $vdep, $varr, $nbp, $nbc )
    {
        $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;

        $query_str = 'select * from getCorrespondances(\''.$vdep.'\', \''.$varr.'\', '.$nbp.', '.$nbc.');';
        $query = $em->prepare($query_str);

        // echo $query_str ;

        $bool = $query->execute();
        if ($bool == false)
        {
            return NULL;
        }
        if (empty($query))
        {
            return null;
        }
        return $query->fetchAll();
    }

	public static function getCorrespondancesInfo()
    {
        $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;

        $query_str = 'select * from getCorresInfo() order by depart;';
        $query = $em->prepare($query_str);

        // echo '<br>'. $query_str ;

        $bool = $query->execute();
        if ($bool == false)
        {
            return NULL;
        }
        if (empty($query))
        {
            return null;
        }
        return $query->fetchAll(); // retourne un tableau d'enregistrements (tableau de tableaux de valeurs)

    }

	public static function checkCorresDispo( $id, $nbp )
    {
        $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;

        $query_str = "select * from checkCorresDispo( $id, $nbp );";
        $query = $em->prepare($query_str);

        $bool = $query->execute();
        if ($bool == false)
        {
            return NULL;
        }
        if (empty($query))
        {
            return null;
        }
        return $query->fetchAll();
    }

	public static function getVoyageByCorresId( $id_corres )
    {
        $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;

        $query_str = "select * from tmp_correspondance where id_corres = $id_corres;";
        $query = $em->prepare($query_str);

        $bool = $query->execute();
        if ($bool == false)
        {
            return NULL;
        }
        if (empty($query))
        {
            return null;
        }
        return $query->fetchAll();
    }
}