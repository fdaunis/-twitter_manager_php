<?php
error_reporting(E_ALL);
//date_default_timezone_set('Europe/Madrid');
session_start();

// function Preparar_Sessio() 
// {
	// include(dirname(__FILE__).'/../configuracio/config_ampliat.php');	
	
	// $l_num_segons_sessio = 3600;
	// if (isset($G_num_segons_sessio))  $l_num_segons_sessio = $G_num_segons_sessio;			
	// ini_set('session.gc_maxlifetime', $l_num_segons_sessio);
	// ini_set('session.cookie_lifetime',$l_num_segons_sessio);
	// session_set_cookie_params($l_num_segons_sessio);
	
	// session_start();
	
	// if (isset($G_codi_projecte))
	// {
		// if (!defined('K_Projecte')) define( 'K_Projecte', $G_codi_projecte);   //sge_app		
	// }
	// else
	// {
		// echo "Falta variable config ampliat K_Projecte";
		// exit;
	// }
	
	
	// if (isset($G_servidor_test))
	// {
		// if (!defined('K_sw_server_test')) define( 'K_sw_server_test', $G_servidor_test);   // true false		
	// }
	// else
	// {
		// echo "Falta variable config ampliat K_sw_server_test";
		// exit;
	// }
	
	// if (isset($G_codi_doctor_generic))
	// {
		// if (!defined('K_ID_DOCTOR_GENERIC')) define( 'K_ID_DOCTOR_GENERIC', $G_codi_doctor_generic);
	// }
	// else
	// {
		// echo "Falta variable config ampliat K_ID_DOCTOR_GENERIC";
		// exit;
	// }
	
	// if (isset($G_codi_client_generic))
	// {
		// if (!defined('K_ID_CLIENT_GENERIC')) define( 'K_ID_CLIENT_GENERIC', $G_codi_client_generic);
	// }
	// else
	// {
		// echo "Falta variable config ampliat K_ID_CLIENT_GENERIC";
		// exit;
	// }
	// // if (isset($G_carpeta_fitxers))
	// // {
		// // if (!defined('K_carpeta_fitxers')) define( 'K_carpeta_fitxers', $G_carpeta_fitxers);    
	// // }
	// // else
	// // {
		// // echo "Falta variable config ampliat K_carpeta_fitxers";
		// // exit;
	// // }
	
	// if (isset($G_fullpath_fitxers))
	// {
		// if (!defined('K_fullpath_fitxers')) define( 'K_fullpath_fitxers', $G_fullpath_fitxers);    
	// }
	// else
	// {
		// echo "Falta variable config ampliat K_fullpath_fitxers";
		// exit;
	// }

// }



class cls_generic_gestio  
{
	function __construct() 
	{
	}
 
	
	
	public function GEXR(
		$p_resultat, 
		$p_desc, 
		$p_nou_id = null, 
		$p_accio = null, 
		$p_array_codi_valor = null, 
		$p_subaccio = null)
	{
		$this->Generic_Escriure_Xml_Resposta($p_resultat, $p_desc, $p_nou_id, $p_accio, $p_array_codi_valor, $p_subaccio);
	}
	
	public function Generic_Escriure_Xml_Resposta(
		$p_resultat, 
		$p_desc, 
		$p_nou_id = null, 
		$p_accio = null, 
		$p_array_codi_valor = null, 
		$p_subaccio = null )
	{
		$l_atribut_nouid = "";
		if (!is_null($p_nou_id)) $l_atribut_nouid = ' nouid = "'.$p_nou_id.'" ';	
		
		$l_atribut_accio = "";
		if (!is_null($p_accio)) $l_atribut_accio = ' accio = "'.$p_accio.'" ';			
		
		$l_atribut_subaccio = "";
		if (!is_null($p_subaccio)) $l_atribut_subaccio = ' subaccio = "'.$p_subaccio.'" ';		
		
		$l_altres_atributs = "";
		if (!is_null($p_array_codi_valor))
		{
			if (is_array($p_array_codi_valor) || is_object($p_array_codi_valor))
			{
				foreach ($p_array_codi_valor as $key => $value) 
				{
					$l_altres_atributs .= ' '.$key.'="'.$value.'" ';
				}
			}
		}
		
		echo '<response resultat="'.$p_resultat.'"  desc="'.$p_desc.'" '. $l_atribut_nouid.' '.$l_atribut_accio .' '.$l_altres_atributs.' '.$l_atribut_subaccio.'  />';
		exit;
	}
	
	
	
}


$obj_generic = new cls_generic_gestio();


?>