<?php
header("Content-Type: text/xml;charset=utf-8");

include_once('../classes/generic.class.php');
include_once('../config/config.php');
require_once('../twitter_api_exchange/TwitterAPIExchange.php');

//include_once(dirname(dirname(__FILE__)).'/classes/configuracio.class.php');

// print_r($g_array_settings_twitter_api);


$l_mode = null;
if (!isset($_POST['p_mode'])) $obj_generic->GEXR("ERROR","Parameter 'pmode' not found!");

$l_mode = $_POST['p_mode'];

if ($l_mode == "GET-CONFIG")
{
	$obj_generic->GEXR("OK","Correct", null, null, array('username' => $g_twitter_username));
}

if ($l_mode == "GET-HTML-TWEETS")
{
	header("Content-Type: text/html;charset=utf-8");
	$l_url 		= 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$l_params 	= '?screen_name='.$g_twitter_username.'&count=200&include_rts=false';
	
	if (isset($_POST['p_strid_last_tweet']))
	{
		if (strlen($_POST['p_strid_last_tweet']) > 0)
		{
			 $l_params .= "&max_id=".$_POST['p_strid_last_tweet'];
		}
	}
	
	$l_requestMethod = 'GET';
	$l_api_twitter = new TwitterAPIExchange($g_array_settings_twitter_api);
	$jsonraw = $l_api_twitter->setGetfield($l_params)
				 ->buildOauth($l_url, $l_requestMethod)
				 ->performRequest();
				 
	
	$l_array_tweets = json_decode($jsonraw, true);
	$l_num_tweets 	= sizeof($l_array_tweets);
	
	$l_str_id_last = "";
	
	
	//print_r($l_array_tweets);
	
	?>
	<div class="container-fluid">
		<div class="row">
		
		<table class="table table-sm  table-bordered">
			<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col">ID</th>
					<th scope="col">Date</th>
					<th scope="col">text</th>
				</tr>
			</thead>
			<tbody>
		<?php
			echo  $l_params;
			$l_iterador = 0;
			foreach ($l_array_tweets as $l_tweet) 
			{
				$l_iterador++;
				
				$l_str_id_last = $l_tweet['id_str'];
		?>
			<tr>
				<td><?php echo $l_iterador;?></td>
				<td><a href="https://twitter.com/<?php echo $g_twitter_username;?>/status/<?php echo $l_str_id_last;?>" ><?php echo $l_str_id_last;?></a></td>
				<td><?php echo $l_tweet['created_at'];?></td>
				<td><?php echo $l_tweet['text'];?></td>
			</tr>
		<?php
			}
		?>
			</tbody>
		</table>
		
		
		
		</div>
	</div>
	<script>
		_set_last_strid('<?php echo $l_str_id_last;?>');
		
	</script>
	

	<?php
	
	exit;
	//$obj_generic->GEXR("OK","Correct", null, null, array('username' => $g_twitter_username));
}




$obj_generic->GEXR("ERROR","Invalid Mode!");



//$obj_generic->GEXR("ERROR","Sesión no iniciada!");


// include_once(dirname(dirname(__FILE__)).'/classes/manteniment.class.php');
// include_once(dirname(dirname(__FILE__)).'/classes/impdent_doctors.class.php');

// $VALOR_MODE = null;
// if (isset($_POST['p_mode'])) $VALOR_MODE = $obj_check->Generic_Netejar($_POST['p_mode']);

// if ($VALOR_MODE == "MANTENIMENT")
// {
	// MODE_Manteniment();
	// exit;
// }

// if ($VALOR_MODE == "HTML-MANT-DOCTOR-CLINIQUES")
// {	
	// MODE_Html_manteniment_doctor_cliniques();
	// exit;	
// }

// if ($VALOR_MODE == "taula_html_vacances_doctor")
// {	
	// MODE_taula_html_vacances_doctor();
	// exit;	
// }

// if ($VALOR_MODE == "MANT-VACANCES-DOCTOR")
// {
	// MODE_Man_Vacances_Doctor();
	// exit;
// }

// if ($VALOR_MODE == "borrar_vacances_doctor")
// {
	// MODE_borrar_vacances_doctor();
	// exit;
// }


// if ($VALOR_MODE == "MANT-HORARIS-CLINIQUES-DOCTOR")
// {	
	// MODE_manteniment_horaris_cliniques_doctor();
	// exit;	
// }

// if ($VALOR_MODE == "fitxer_xml_setmana")
// {	
	// MODE_fitxer_xml_setmana();
	// exit;
// }


// if ($VALOR_MODE == "JSON_VALORS_DOCTOR_PER_SELECT")
// {
	// JSON_VALORS_DOCTOR_PER_SELECT();
	// exit;
// }



// $obj_check->GEXR("ERROR","Modo no válido!",null,null);








// function MODE_Manteniment()
// {
	// $obj_generic_manteniment = new cls_manteniment_gestio();
	// $obj_doctor = new CLASSE_DOCTOR();
	// global $obj_check;


	// //if (!isset($_POST['p_accio'])) $obj_check->GEXR("ERROR","Acción no definida!",null,null);
	
	// $l_id = intval($obj_doctor->Generic_Get_Value($_POST, 'tx_id_dc'),10);
	
	// $VALOR_ACCIO = $obj_generic_manteniment->obtenir_codi_accio($l_id, $obj_doctor->Generic_Get_Value($_POST, 'tx_borrar'));
	// if (is_null($VALOR_ACCIO)) $obj_doctor->GEXR("ERROR",'FALTA CÓDIGO ACCIÓN!', null, $VALOR_ACCIO);
	
	// $obj_check->Check_Expulsar_Si_No_Permis_Accio("IMPDENT-M-DOCTORES", $VALOR_ACCIO);
	
	// //$VALOR_ACCIO = $obj_doctor->Generic_Get_Value($_POST,'p_accio');   //ADD

	// //print_r($VALOR_ACCIO);
	
	// //$obj_check->Check_Expulsar_Si_No_Permis_Accio("IMPDENT-M-CLINIQUES",	$VALOR_ACCIO);
	
	// if ($VALOR_ACCIO == $obj_generic_manteniment->K_DELETE)
	// {
		// $resultat = $obj_doctor->Delete_Doctor($l_id);
		// if ($resultat == 1) $obj_doctor->GEXR("OK",'Doctor borrado!',null,$VALOR_ACCIO);
		// else $obj_doctor->GEXR("ERROR",'ERROR BORRANDO DOCTOR!', null, $VALOR_ACCIO);
	// }
	// else
	// {
		
		// $valor_retorn = $obj_doctor->Asignar_Valors_Doctor(
			// $VALOR_ACCIO, $l_id, 
			// $obj_doctor->Generic_Get_Value($_POST, 'tx_nom'), 			$obj_doctor->Generic_Get_Value($_POST, 'tx_nom_curt'), 	$obj_doctor->Generic_Get_Value($_POST, 'tx_dir'),
			// $obj_doctor->Generic_Get_Value($_POST, 'tx_pob')    ,		$obj_doctor->Generic_Get_Value($_POST, 'tx_prov') , 	$obj_doctor->Generic_Get_Value($_POST, 'tx_telf'),
			// $obj_doctor->Generic_Get_Value($_POST, 'tx_mob')   , 		$obj_doctor->Generic_Get_Value($_POST, 'tx_email'), 	$obj_doctor->Generic_Get_Value($_POST,'tx_comentari'),
			// $obj_doctor->Generic_Get_Value($_POST, 'tx_cate')  ,		$obj_doctor->Generic_Get_Value($_POST, 'tx_coleg'),		$obj_doctor->Generic_Get_Value($_POST, 'tx_nif'),
			// $obj_doctor->Generic_Get_Value($_POST, 'tx_porce'),			$obj_doctor->Generic_Get_Value($_POST, 'id_chk_habi'),  $obj_doctor->Generic_Get_Value($_POST, 'id_chk_tractaments'), 
			// $obj_doctor->Generic_Get_Value($_POST, 'tx_cp') 
			// );
		
		// if ($valor_retorn[0] == "OK")
		// {
			
			// //$resultat = $obj_doctor->Delete_Cliniques_de_Doctor($l_id);
			// // $l_cadena_ids_cliniques = $obj_doctor->Generic_Get_Value($_POST, 'llista_ids_cliniques');
			// // $l_array_ids_cliniques = explode ("," , $l_cadena_ids_cliniques);
			// // $MIDA_ARRAY_CLINIQUES = sizeof($l_array_ids_cliniques);
			
			// // foreach ($l_array_ids_cliniques as $id_clinica)
			// // {
				// // $obj_doctor->Crear_relacio_Doctor_Clinica($l_id ,$id_clinica);
			// // }
			

			// if ($VALOR_ACCIO == $obj_generic_manteniment->K_ADD)
			// {
				// $resultat = $obj_doctor->Crear_Doctor();
				// if ($resultat > 0) 
				// {
					// guardar_canvis_doctor_cliniques($resultat, $obj_doctor->Generic_Get_Value($_POST, 'llista_ids_cliniques'));
					
					// $obj_doctor->GEXR("OK",'OK ID '.$resultat.' ('.htmlentities('<a href="impdent_m_doctors.php?p_id_dc='.$resultat.' " >RECARGAR</a>').')', $resultat, $VALOR_ACCIO);
				// }
				// else $obj_doctor->GEXR("ERROR",'ERROR CREANDO DOCTOR!', null, $VALOR_ACCIO);
			// }
			// if ($VALOR_ACCIO == $obj_generic_manteniment->K_UPDATE)
			// {
				// $resultat = $obj_doctor->Update_Doctor($l_id);
				// if ($resultat == 1) 
				// {
					// guardar_canvis_doctor_cliniques($l_id, $obj_doctor->Generic_Get_Value($_POST, 'llista_ids_cliniques'));
					
					// $obj_doctor->GEXR("OK",'OK ('.htmlentities('<a href="impdent_m_doctors.php?p_id_dc='.$l_id.' " >RECARGAR</a>').')',$l_id,$VALOR_ACCIO);
				// }
				// else $obj_doctor->GEXR("ERROR",'ERROR ACTUALIZANDO DOCTOR!', null, $VALOR_ACCIO);
			// }
		// }
		// else $obj_doctor->GEXR("ERROR",$valor_retorn[1] ,null, $VALOR_ACCIO);
	// }


	// $obj_doctor->GEXR("ERROR",'ERROR ACCIÓN', null, $VALOR_ACCIO);

// }

// function guardar_canvis_doctor_cliniques($p_id_doctor, $p_cadena_ids_cliniques)
// {
	// $obj_doctor = new CLASSE_DOCTOR();
	
	// $resultat = $obj_doctor->Delete_Cliniques_de_Doctor($p_id_doctor);
	
	// $l_array_ids_cliniques = explode ("," , $p_cadena_ids_cliniques);
	// $MIDA_ARRAY_CLINIQUES = sizeof($l_array_ids_cliniques);
	
	// foreach ($l_array_ids_cliniques as $id_clinica)
	// {
		// $obj_doctor->Crear_relacio_Doctor_Clinica($p_id_doctor ,$id_clinica);
	// }
// }


// function MODE_Html_manteniment_doctor_cliniques()
// {
	// header("Content-Type: text/html;charset=utf-8");
	// $obj_doctor = new CLASSE_DOCTOR();
	// global $obj_check;
	
	// $l_id_doctor = intval($obj_doctor->Generic_Get_Value($_POST, 'p_id_doctor'),10);

	// // $obj_clinica->Carrega_Classe_Dades($l_id_doctor, false, false);
	
	// // if ($obj_clinica->Generic_Get_Field('id_cla') != $l_id_doctor)
	// // {
		// // echo "<div class='alert alert-danger'>Falta id classe</div>";	
		// // exit;
	// // }
	// $l_td_separador  = '<td style="width:20px;" ></td>';
	// $l_html_tr = "";
	// $l_query = $obj_doctor->Obtenir_Rows_Cliniques_Per_Asignar_a_Doctor($l_id_doctor, false);
	// while ($row = $l_query->fetch(PDO::FETCH_ASSOC))
	// {
		
		// $l_check = "";
		// $l_td_estil =  "";
		// if (intval($row['clinica_id_cd'],10) > 0) 
		// {
			// $l_check = " checked ";
			// $l_td_estil = " style=\"background-color:#90ff90;\" ";
		// }
		
		
		// $l_td1 = '<td '.$l_td_estil .' ><input type="checkbox" data1="'.$row['id_cli'].'" '.$l_check.' /></td><td '.$l_td_estil .' >'.$row['nom_cli'].'</td>';
		// $l_td2  = $l_td_separador.'<td></td>';
		// if ($row2 = $l_query->fetch(PDO::FETCH_ASSOC))
		// {
			// $l_check = "";
			// $l_td_estil =  "";
			// if (intval($row2['clinica_id_cd'],10) > 0) 
			// {
				// $l_check = " checked ";
				// $l_td_estil = " style=\"background-color:#90ff90;\" ";
			// }
		
			// $l_td2 = $l_td_separador.'<td '.$l_td_estil .'  ><input type="checkbox" data1="'.$row2['id_cli'].'" '.$l_check.' /></td><td '.$l_td_estil .'  >'.$row2['nom_cli'].'</td>';
		// }
		
		// $l_html_tr .=  '<tr>'.
							// $l_td1.$l_td2.
						// '</tr>' ;
	// }
	
	// $l_html_taula = '
					// <table class="table table-sm " id="id_taula_cliniques_seleccionar">
					// <tbody>'.$l_html_tr.'
					// </tbody>
					// </table>';

	// echo  $l_html_taula;
// }







// function MODE_taula_html_vacances_doctor()
// {
	// header("Content-Type: text/html;charset=utf-8");
	
	// $obj_doctor = new CLASSE_DOCTOR();
	// global $obj_check;
	
	// $l_id = intval($obj_doctor->Generic_Get_Value($_POST, 'p_id_doctor'),10);
	
	// $l_query = $obj_doctor->Obtenir_Rows_dades_doctors_vacances($l_id, null, null);
	
	// if ($l_query->rowCount() > 0) 
	// {

		// ?>
		// <table class="table table-sm table-striped cls_taula_border_gris" >
			// <thead class="thead-inverse" >
				// <tr>
					// <th>Fecha Inicio</th>
					// <th>Fecha Final</th>	
					// <th>Comentario</th>
					// <th></th>
				// </tr>
			// </thead>
		// <?php
		// while ($row = $l_query->fetch(PDO::FETCH_ASSOC))
		// {
			// //$row['monitor_id_clamo']
			
			// $valor_data_formatat1 = $obj_doctor->obj_funcions_comuns->FNC_STRSQL_STRFORMAT($row['dh_inici_docvac'], null, true, null, "d/m/Y");	
			// $valor_data_formatat2 = $obj_doctor->obj_funcions_comuns->FNC_STRSQL_STRFORMAT($row['dh_final_docvac'], null, true, null, "d/m/Y");	
		// ?>
		// <tr>
			// <td><?php echo $valor_data_formatat1;?></td>
			// <td><?php echo $valor_data_formatat2;?></td>
			// <td><?php echo $row['comentari_docvac'];?></td>
			// <td style="text-align:center;">
			// <?php
				// $array_permisos = $obj_check->Check_Obtenir_Array_Permisos("IMPDENT-M-DOCTORES");
				// if ($array_permisos[4] == 1) //modificar
				// {
			// ?>
				// <button type="button" class="btn btn-warning btn-sm" onclick="event_click_bt_borrar_vacances(<?php echo intval($row['id_docvac'],10);?>);" >Borrar</button>
			// <?php
				// }
			// ?>
			// </td>
			
		// </tr>	
		// <?php
		// }
		// ?>
		// </table>
		// <?php
	// }
	// else
	// {
		
		// $l_html = "<div class='alert alert-danger'>Sin datos de vacaciones!</div>";	
		// echo $l_html ;
	// }
	
	// exit;
	
// }


// function MODE_manteniment_horaris_cliniques_doctor()
// {
	// $obj_generic_manteniment = new cls_manteniment_gestio();
	// $obj_doctor = new CLASSE_DOCTOR();
	// global $obj_check;
	
	// $VALOR_ACCIO = $obj_generic_manteniment->K_UPDATE;
	
	// $obj_check->Check_Expulsar_Si_No_Permis_Accio("IMPDENT-M-DOCTORES", $VALOR_ACCIO);
	
	// $l_id_doctor = intval($obj_doctor->Generic_Get_Value($_POST, 'p_id_doc'),10);
	// if ($l_id_doctor < 1 )  $obj_doctor->GEXR("ERROR",'Falta id doctor!', null, $VALOR_ACCIO);
	
	// $l_resultat_validar = tractar_horari_setmanal(false, $l_id_doctor, $obj_doctor->Generic_Get_Value($_POST, 'p_dades'));
	// if ($l_resultat_validar[0] != "OK")
	// {
		// $obj_doctor->GEXR("ERROR",'Error '.$l_resultat_validar[1].' !', null, $VALOR_ACCIO);
	// }
	
	// $obj_doctor->Delete_Horaris_Setmana_Totes_Cliniques_Doctor($l_id_doctor);
	
	// $l_resultat_crear = tractar_horari_setmanal(true, $l_id_doctor, $obj_doctor->Generic_Get_Value($_POST, 'p_dades'));
	
	// if ($l_resultat_crear[0] == "OK") 
	// {
		// $obj_doctor->GEXR("OK",'Datos actualizados!', null, $VALOR_ACCIO);
	// }
	// else 
	// {
		// $obj_doctor->GEXR("ERROR",'Error '.$l_resultat_crear[1].' !', null, $VALOR_ACCIO);
	// }
// }

// function tractar_horari_setmanal($p_bool_crear_dades, $p_id_doctor, $p_cadena_dades)
// {
	// $obj_doctor2 = new CLASSE_DOCTOR();
	// $l_array_dades_cliniques = explode("|", $p_cadena_dades);
	// foreach ($l_array_dades_cliniques as $cadena_dades_clinica)
	// {
		// $l_array_dades_clinica = explode("@",$cadena_dades_clinica);
		// //print_r($l_array_dades_clinica);
		// if (sizeof($l_array_dades_clinica) == 2)
		// {
			// $l_id_clinica = intval($l_array_dades_clinica[0],10);
			// $l_cadena_hores_clinica = $l_array_dades_clinica[1];
			// $l_array_dades_hores_clinica = explode("-",$l_cadena_hores_clinica);
			// // 12 (6 inici i 6 final) inputs mati + 12 (6 inici i 6 final)  inputs tarda
			// if (sizeof($l_array_dades_hores_clinica) == 24)
			// {
				// //print_r($l_array_dades_hores_clinica);
				// for ($i = 0; $i <= 23; $i = $i+2) 
				// {
					// $l_index_seguent = $i + 1;
					// $l_array_dades_hores_clinica[$i] 				= $obj_doctor2->obj_funcions_comuns->FNC_Obtenir_str_hora($l_array_dades_hores_clinica[$i]);
					// $l_array_dades_hores_clinica[$l_index_seguent] 	= $obj_doctor2->obj_funcions_comuns->FNC_Obtenir_str_hora($l_array_dades_hores_clinica[$l_index_seguent]);
					
					// $l_array_resultat_hora = $obj_doctor2->obj_funcions_comuns->FNC_Validar_hores_inici_fi(
						// $l_array_dades_hores_clinica[$i], 
						// $l_array_dades_hores_clinica[$l_index_seguent]
					// );
					// if ($l_array_resultat_hora[0] != "OK") return($l_array_resultat_hora);
				// }
				// //print_r($l_array_dades_hores_clinica);
			// }
		// }

		// if ($p_bool_crear_dades)
		// {
			// $l_resultat = $obj_doctor2->Crear_Horari_Setmana_Doctor_Clinica($p_id_doctor, $l_id_clinica, $l_array_dades_hores_clinica);
		// }
	// }
	
	// return(array("OK",""));
// }



// function MODE_Man_Vacances_Doctor()
// {
	// $obj_generic_manteniment = new cls_manteniment_gestio();
	// $obj_doctor = new CLASSE_DOCTOR();
	// global $obj_check;
	
	// $VALOR_ACCIO = $obj_generic_manteniment->K_UPDATE;
	// $obj_check->Check_Expulsar_Si_No_Permis_Accio("IMPDENT-M-DOCTORES", $VALOR_ACCIO);
	
	// $l_id = intval($obj_doctor->Generic_Get_Value($_POST, 'tx_id_dc'),10);
	// if ($l_id < 1 )  $obj_doctor->GEXR("ERROR",'Falta id doctor!', null, $VALOR_ACCIO);

	// $l_data_sql_1 = $obj_doctor->obj_funcions_comuns->FNC_get_STR_Date($_POST['tx_data1'],"d/m/Y",'Y-m-d');
	// if (is_null($l_data_sql_1)) $obj_doctor->GEXR("ERROR","Fecha inicial incorrecta" ,null, null);
	
	// $l_data_sql_2 = $obj_doctor->obj_funcions_comuns->FNC_get_STR_Date($_POST['tx_data2'],"d/m/Y",'Y-m-d');
	// if (is_null($l_data_sql_2)) $obj_doctor->GEXR("ERROR","Fecha final incorrecta" ,null, null);
	
	// if ($l_data_sql_1 > $l_data_sql_2) $obj_doctor->GEXR("ERROR","Fecha inicial posterior a la fecha final!" ,null, null);
	
	// $resultat = $obj_doctor->Crear_Doctor_Vacances($l_id, $l_data_sql_1." 00:00:00", $l_data_sql_2." 23:59:59", $_POST['tx_comentari']);
	
	// if ($resultat > 0) 	$obj_doctor->GEXR("OK",'Datos actualizados!', $resultat, $VALOR_ACCIO);
	// else 				$obj_doctor->GEXR("ERROR",'ERROR CREANDO doctor - vacaciones!', null, $VALOR_ACCIO);
// }





// function MODE_borrar_vacances_doctor()
// {
	// $obj_generic_manteniment = new cls_manteniment_gestio();
	// $obj_doctor = new CLASSE_DOCTOR();
	// global $obj_check;
	
	// $VALOR_ACCIO = $obj_generic_manteniment->K_DELETE;
	// $obj_check->Check_Expulsar_Si_No_Permis_Accio("IMPDENT-M-DOCTORES", $VALOR_ACCIO);
	
	// $l_id_doctor = intval($obj_doctor->Generic_Get_Value($_POST, 'p_id_doc'),10);
	// $l_id_docvac = intval($obj_doctor->Generic_Get_Value($_POST, 'p_id_docvac'),10);
	// if ($l_id_docvac < 1 )  $obj_doctor->GEXR("ERROR",'Falta id doctor-vacaciones!', null, $VALOR_ACCIO);

	
	
	// $resultat = $obj_doctor->Borrar_Doctor_Vacances($l_id_doctor, $l_id_docvac);
	// if ($resultat == 1) 
	// {
		// $obj_doctor->GEXR("OK",'OK', $resultat, $VALOR_ACCIO);
	// }
	// else $obj_doctor->GEXR("ERROR",'ERROR BORRANDO doctor - vacaciones!', null, $VALOR_ACCIO);
	
	
// }

// function MODE_fitxer_xml_setmana()
// {
	// $obj_doctor = new CLASSE_DOCTOR();
	// global $obj_check;
	// $l_id_clinica	 = intval($obj_doctor->Generic_Get_Value($_POST, 'p_id_clinica'),10);
	// $l_id_doctor 	= intval($obj_doctor->Generic_Get_Value($_POST, 'p_id_doctor'),10);

	// $l_query_horari = $obj_doctor->Obtenir_Rows_Horari_Setmanal($l_id_doctor, $l_id_clinica);
	
	// $l_array_dies_amb_dades = array(0,0,0,0,0,0,0);
	// $l_elements_xml = "";
	// while ($row = $l_query_horari->fetch(PDO::FETCH_ASSOC))
	// {
		// for ($i = 1; $i <= 6; $i++) 
		// {
			// $l_camp1 = "hora_d".$i."_mi_dch";
			// $l_camp2 = "hora_d".$i."_mf_dch";
			// $l_camp3 = "hora_d".$i."_ti_dch";
			// $l_camp4 = "hora_d".$i."_tf_dch";
			
			// $l_hora_mi = substr($row[$l_camp1],0,5);
			// if (strlen($l_hora_mi) == 5) 
			// {
				// $l_hora_mf = substr($row[$l_camp2],0,5);
				// $l_element_xml = '<h dia="'.$i.'" h1="'.$l_hora_mi.'" h2="'.$l_hora_mf.'" />';
				// $l_elements_xml .= $l_element_xml;
				
				// $l_array_dies_amb_dades[($i-1)] = 1;
			// }
			// $l_hora_ti = substr($row[$l_camp3],0,5);
			// if (strlen($l_hora_ti) == 5) 
			// {
				// $l_hora_tf = substr($row[$l_camp4],0,5);
				// $l_element_xml = '<h dia="'.$i.'" h1="'.$l_hora_ti.'" h2="'.$l_hora_tf.'" />';
				// $l_elements_xml .= $l_element_xml;
			// }
		// }
	// }
	
	// echo '<response resultat="OK"  desc="" cadena_dies_ok="'.implode(",",$l_array_dies_amb_dades).'" >'.$l_elements_xml.'</response>';
// }


// function JSON_VALORS_DOCTOR_PER_SELECT()
// {
	// header('Content-Type: application/json');
	
	// $obj_generic_manteniment = new cls_manteniment_gestio();
	// $obj_doctor = new CLASSE_DOCTOR();
	// global $obj_check;
	
	// $l_id_clinica = intval($obj_doctor->Generic_Get_Value($_POST, 'p_id_clinica'),10);
	
	// $l_mostrar_tots_si_no_clinica = false;
	// if (isset($_POST['p_yn_tots_no_clinica'])) 
	// {
		// $l_mostrar_tots_si_no_clinica = ($_POST['p_yn_tots_no_clinica'] == "SI");
	// }
	
	// $l_mostrar_generic_si_no = true;
	// if (isset($_POST['p_yn_generic'])) 
	// {
		// $l_mostrar_generic_si_no = ($_POST['p_yn_generic'] == "SI");
	// }
	
	
	// $l_array_array_valors = array();
		
	// if ($l_id_clinica > 0)
	// {
		// $l_query = $obj_doctor->Obtenir_Rows_Doctors_De_Clinica($l_id_clinica);
		// while ($row = $l_query->fetch(PDO::FETCH_ASSOC))
		// {
			// $l_valid = true;
			// if ($l_mostrar_generic_si_no == false)
			// {
				// if (intval($row['id_dc'],10) == K_ID_DOCTOR_GENERIC) $l_valid = false;
			// }
			// if ($l_valid) $l_array_array_valors[] = array("id_dc" => $row['id_dc'], "nom_curt_dc" => $row['nom_curt_dc']);
		// }
	// }
	// else
	// {
		// if ($l_mostrar_tots_si_no_clinica)
		// {
			// $l_query_doctors = $obj_doctor->Obtenir_Rows_Generic_dades_doctors(false, null, K_Projecte, 
																			// null, null,
																			// false, true,
																			// null);
			// while ($row = $l_query_doctors->fetch(PDO::FETCH_ASSOC))
			// {
				// $l_valid = true;
				// if ($l_mostrar_generic_si_no == false)
				// {
					// if (intval($row['id_dc'],10) == K_ID_DOCTOR_GENERIC) $l_valid = false;
				// }
				// if ($l_valid) $l_array_array_valors[] = array("id_dc" => $row['id_dc'], "nom_curt_dc" => $row['nom_curt_dc']);
			// }
		// }
	// }
	
	
	// echo json_encode($l_array_array_valors);
	
// }
