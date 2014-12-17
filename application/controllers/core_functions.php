<?php

//initialize the globals 
@ini_set('display_errors', 0);
include_once('../../../wp-load.php');

/*Fucntion to calculate*/
####### DO NOT EDIT <;-)

function calcuInscr(){
		global $wpdb;
		$sql = $wpdb->get_results("SELECT COUNT(DISTINCT submit_time) as totins FROM wp_cf7dbplugin_submits");
		return $sql[0]->totins;
}

function calcValsCount($which, $what){
		global $wpdb;
		$query = "SELECT COUNT(DISTINCT submit_time) as recordcount FROM wp_cf7dbplugin_submits WHERE field_name = '".$which."' and field_value = '".$what."'";
		$sql = $wpdb->get_results($query);
		return $sql[0]->recordcount;
}

function calcDistParm($name){
		global $wpdb;
		$sql = $wpdb->get_results("SELECT COUNT(DISTINCT submit_time) as distvalrec FROM wp_cf7dbplugin_submits WHERE field_name = '".$name."'");
		return $sql[0]->distvalrec;
}

function calcKMCount(){
		global $wpdb;
		$sql = $wpdb->get_results("SELECT count(DISTINCT submit_time) as kmc FROM `wp_cf7dbplugin_submits`");
		return $sql[0]->kmc;
}


function calcKMrecordCount(){
		global $wpdb;
		$sql = $wpdb->get_results("SELECT COUNT(DISTINCT wps.user_id) as cnt FROM  wp_sm_stepscount as wps INNER JOIN wp_users as wpu ON wps.user_id = wpu.id INNER JOIN wp_cf7dbplugin_submits as wpcs ON wpu.user_email = wpcs.field_value  GROUP BY wps.user_id");
		return $sql[0]->cnt;
}

##calculate count of users form param like Homme
function calcKMparamCount($pam){
	global $wpdb;
	$query = "SELECT COUNT(DISTINCT wps.user_id) as parmcou FROM  wp_sm_stepscount as wps INNER JOIN wp_users as wpu ON wps.user_id = wpu.id INNER JOIN wp_cf7dbplugin_submits as wpcs ON wpu.user_email = wpcs.field_value INNER JOIN wp_cf7dbplugin_submits as wpcs2 ON wpcs.submit_time = wpcs2.submit_time AND wpcs2.field_value = '".$pam."' GROUP BY wps.user_id";
	//echo $query;
	$sql = $wpdb->get_results($query);
	return $sql[0]->parmcou;
}
#
function number_of_departments(){
	global $wpdb;
	$query = $wpdb->get_results("SELECT DISTINCT wps.user_id FROM wp_sm_stepscount as wps INNER JOIN wp_users as wpu ON wps.user_id = wpu.id INNER JOIN wp_cf7dbplugin_submits as wpcs ON wpu.user_email = wpcs.field_value INNER JOIN wp_cf7dbplugin_submits as wpcs2 ON wpcs.submit_time = wpcs2.submit_time AND wpcs2.field_name = 'departement' GROUP BY wps.user_id");
	$rowCount = $wpdb->num_rows;
	return $rowCount;
	//$sql = $wpdb->get_results($query);
	//return $sql[0]->parmcou;
}

# show department names which are selected
function getDepartmentNames(){
	global $wpdb;
	$query = $wpdb->get_results("SELECT DISTINCT(wpcs2.field_value) FROM  wp_sm_stepscount as wps  JOIN wp_users as wpu ON wps.user_id = wpu.id JOIN wp_cf7dbplugin_submits as wpcs ON wpu.user_email = wpcs.field_value JOIN wp_cf7dbplugin_submits as wpcs2 ON wpcs.submit_time = wpcs2.submit_time AND wpcs2.field_name = 'departement' GROUP BY wps.user_id");
	$result='';
	foreach($query as $res){
		$result = $result." ".$res->field_value.",";
	}
	return $result;
}

##calculate total distance covered for all users
function get_distance_count(){
	global $wpdb;
		$sql = $wpdb->get_results("SELECT * FROM wp_sm_stepscount");
		$total_distance = '';
		foreach ($sql as $records) {
				if($records->rain =='yes'){
					$adis = $records->distance_covered/2;
			}else{
				$adis =  $records->distance_covered;
			}
			$total_distance = $total_distance + $adis;
		}
		return $total_distance;
}


##calculate distance from param  rain yes or no
function get_rain_distance_count($rainv){
	global $wpdb;
		$sql = $wpdb->get_results("SELECT SUM(distance_covered) as dsums FROM wp_sm_stepscount WHERE rain = '$rainv'");
			if($rainv =='yes'){
				$total  =  $sql[0]->dsums;
			}else{
				$total = $sql[0]->dsums/2;
			}
		return $total;
}

##calculate total distance from param like Homme
function calculate_distance_by_type($type){
	global $wpdb;
		$sql = $wpdb->get_results("SELECT SUM(distance_covered) as getsum FROM  wp_sm_stepscount as wps INNER JOIN wp_users as wpu ON wps.user_id = wpu.id INNER JOIN wp_cf7dbplugin_submits as wpcs ON wpu.user_email = wpcs.field_value INNER JOIN wp_cf7dbplugin_submits as wpcs2 ON wpcs.submit_time = wpcs2.submit_time AND wpcs2.field_value = '".$type."'");
		return $sql[0]->getsum;
}


function avarage_distance_in_type($type){
	global $wpdb;
	$user_sql ="SELECT ss.field_value AS est, u.ID FROM wp_cf7dbplugin_submits AS s JOIN wp_users AS u ON u.user_email = s.field_value JOIN  wp_cf7dbplugin_submits AS ss ON ss.submit_time = s.submit_time WHERE ss.field_name =  '".$type."'";
	$que = $wpdb->get_results($user_sql);
	$j =0;
	foreach ($que as $v) {
		$x[$v->ID] = $v->est;
		$j++;
	}
	$mainquery = mysql_query("SELECT * FROM wp_sm_stepscount");
	$items = array();
	while($item = mysql_fetch_object($mainquery)){
		$item->est = $x[$item->user_id];
		$items[] = $item;
	}
	//pr($items);
	$totalre ='';
	foreach ($items as $r){
		$totalre = $totalre + $r->distance_covered;
	}
	$estiav = $totalre/$j;
	return round($estiav,2);

	}


	function tripCount(){
		global $wpdb;
		$sql = $wpdb->get_results("SELECT * FROM wp_sm_stepscount");
	 	$rowCount = $wpdb->num_rows;
	 	return $rowCount;
	}

	function tripCountType($what, $which){
		global $wpdb;
		$sql = $wpdb->get_results("SELECT * FROM wp_sm_stepscount WHERE $what = '".$which."'");
	 	$rowCount = $wpdb->num_rows;
	 	return $rowCount;
	}
	function tripAttCountType($what){
		global $wpdb;
		$sql =$wpdb->get_results("SELECT wps.user_id, wps.distance_covered, wps.rain FROM  wp_sm_stepscount as wps INNER JOIN wp_users as wpu ON wps.user_id = wpu.id INNER JOIN wp_cf7dbplugin_submits as wpcs ON wpu.user_email = wpcs.field_value INNER JOIN wp_cf7dbplugin_submits as wpcs2 ON wpcs.submit_time = wpcs2.submit_time AND wpcs2.field_value = '".$what."'");
		$rowCount = $wpdb->num_rows;
	 	return round($rowCount, 2);
	}

	function tripAttAvegType($what){
		global $wpdb;
		$sql =$wpdb->get_results("SELECT  COUNT(DISTINCT wps.user_id) as pcount, COUNT( wps.distance_covered ) as totaldistance  FROM  wp_sm_stepscount as wps INNER JOIN wp_users as wpu ON wps.user_id = wpu.id INNER JOIN wp_cf7dbplugin_submits as wpcs ON wpu.user_email = wpcs.field_value INNER JOIN wp_cf7dbplugin_submits as wpcs2 ON wpcs.submit_time = wpcs2.submit_time AND wpcs2.field_value = '".$what."' GROUP BY wps.user_id");
		$rowCount = $wpdb->num_rows;
		$totalKM = '';

		/*foreach ($sql as $value) {
			$totalKM = $totalKM + $value->totaldistance;
		}*/
		$totalKM = $sql[0]->totaldistance;
		$totalper = $sql[0]->pcount;
		$aveg = $totalKM/$totalper;
		return round($aveg, 2);
	}

	function tripAttAvegRainType($what, $rain){
		global $wpdb;
		$sql =$wpdb->get_results("SELECT wps.user_id, SUM(wps.distance_covered) as totaldistance, wps.rain FROM  wp_sm_stepscount as wps INNER JOIN wp_users as wpu ON wps.user_id = wpu.id INNER JOIN wp_cf7dbplugin_submits as wpcs ON wpu.user_email = wpcs.field_value INNER JOIN wp_cf7dbplugin_submits as wpcs2 ON wpcs.submit_time = wpcs2.submit_time AND wpcs2.field_value = '".$what."' WHERE wps.rain = '".$rain."' GROUP BY wps.user_id");
		$rowCount = $wpdb->num_rows;
		$totalKM = '';
		foreach ($sql as $value) {
			$totalKM = $totalKM + $value->totaldistance;
		}		
		$aveg = $totalKM/$rowCount;
		return round($aveg, 2);
	}

	function averageActivityDeprt(){
		global $wpdb;
		$sql = $wpdb->get_results("SELECT ss.field_value AS est, st.user_id, COUNT(st.user_id) as acnt
				FROM wp_cf7dbplugin_submits AS s
				JOIN wp_users AS u ON u.user_email = s.field_value
				JOIN wp_cf7dbplugin_submits AS ss ON ss.submit_time = s.submit_time
				JOIN wp_sm_stepscount as st ON st.user_id = u.ID
				WHERE ss.field_name =  'departement' GROUP BY st.user_id");
		$rowCount = $wpdb->num_rows;
		$total = '';
		foreach ($sql as $value) {
			$total = $total + $value->acnt;
		}
		$result =  round($total/$rowCount, 2);
		return $result;

	}
	
	function get_user_steps_group(){
		global $wpdb, $current_user;
		get_currentuserinfo();
	    $email = $current_user->user_email;
		$sql = $wpdb->get_results("SELECT DISTINCT(tb2.field_value) as unig FROM wp_cf7dbplugin_submits as tb1 JOIN wp_cf7dbplugin_submits as tb2 ON tb2.submit_time = tb1.submit_time WHERE tb1.field_value = '".$email."' AND tb2.field_name = 'etablissement'");
		$return = $sql[0]->unig;
		return $return;
	}

	function university_acivity_total($univ){
		global $wpdb;
		$sql = $wpdb->get_results("SELECT SUM(DISTINCT wse.activity_distance) as gsum FROM wp_steps_events as wse
				JOIN wp_step_attend as wsa on wse.id = wsa.activity_id
				JOIN wp_users as wu ON wsa.user = wu.ID
				JOIN wp_cf7dbplugin_submits as wss ON wu.user_email = wss.field_value
				JOIN wp_cf7dbplugin_submits as wss2 ON wss.submit_time = wss2.submit_time
				WHERE wss2.field_name = 'etablissement' AND wss2.field_value = '".$univ."'");
		$result = $sql[0]->gsum;
		return $result;
	}

	function total_activity_count(){
		global $wpdb;
		$sql = $wpdb->get_results("SELECT COUNT(*) as totalact FROM wp_step_attend");
		return $sql[0]->totalact;
	}

	function total_distance_covered_alluser(){
		global $wpdb;
		$sql1 = $wpdb->get_results("SELECT SUM(distance_covered) as steps_total FROM wp_sm_stepscount");
		$stepstotal = $sql1[0]->steps_total;
		$sql2 = $wpdb->get_results("SELECT SUM(wpe.activity_distance) as activity_sum FROM wp_steps_events as wpe JOIN wp_step_attend as wsa ON wsa.activity_id = wpe.id");
		$activitytotal = $sql2[0]->activity_sum;
		$total = $stepstotal + $activitytotal;
		return $total;
	}