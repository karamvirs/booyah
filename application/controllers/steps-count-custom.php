<?php
/*
Plugin Name: Steps Count Custom
Description: Caractéristiques Distance statistiques de comptage. Besoin Formulaire de contact 7 et formulaire de contact 7 DB extension pour base de données. Très grande partie dépend des réglages de la forme de contact. Merci
Version: 1.0
Author: Sachin Mishra
Author URI: http://60degree.com
License: GPL2
*/

//define plugin path and url
define( 'STEPSCOUNT_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'STEPSCOUNT_PLUGIN_URL', plugin_dir_url(__FILE__) );
	
//include other files here
require_once STEPSCOUNT_PLUGIN_PATH.'/distance_admin.php';	
require_once STEPSCOUNT_PLUGIN_PATH.'/core_functions.php';	

//function to register menu in admin
add_action( 'admin_menu', 'register_stepscount_menu_page' );
//
function register_stepscount_menu_page(){
	add_menu_page("steps_count_option", "Distance Stats", 0, "distance_statistics", "distance_statistics");	
	add_submenu_page("distance_statistics", "List Activity", "List Activities", 0, "listactivity", "list_distance_activities");
	add_submenu_page("distance_statistics", "Add Activity", "New Activity", 0, "addactivity", "new_distance_activities");
}

function distance_calulation_form(){
	global $wp, $current_user, $wpdb;

	$steps_table = $wpdb->prefix."sm_stepscount";
	//$user_id = 0;
	if(is_user_logged_in()) {
    	get_currentuserinfo();
	    $user_id = $current_user->ID;  ## Get loggedin user id here
	}

	//$user_id = 4; # for now static

if(isset($_POST['submit'])=='Submit'){
		$distance 	= $_POST['distanceparc'];
		$date 		= $_POST['date'];
		$time 		= $_POST['heure'];
		$transtype 	= $_POST['depl'];
		$rain 	= $_POST['israin'];
	
		$insert_record = $wpdb->insert($steps_table, array('user_id'=>$user_id, 'distance_covered'=>$distance,'date'=>$date,'time'=>$time,'movmethod'=>$transtype, 'rain'=>$rain));
		
		if($insert_record){
			//echo $distance; //echo $wpdb->insert_id;
		}
	}

	$latest_activity_ar = $wpdb->get_results("SELECT * FROM ".$steps_table." WHERE user_id = '".$user_id."' ORDER BY sc_id DESC LIMIT 5");
	?>
		<script>
		jQuery(function($) {
			$("#rain").click(function() {                  
			    $('#diatc').val($('#diatc').val() * 2);
			    $("#isitrain").val("yes");
			    $(this).prop('disabled',true);
			    return false;
			});
			/*Re-enable the rain button*/
			$("#diatc").click(function() {
					$("#rain").prop('disabled', false);
					$("#isitrain").val("no");
			});

			/*Disable characters*/
			$('#diatc').live('keydown', function (event) { 

				if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && (event.keyCode != 8)) { 
				    event.preventDefault(); 
				} 

			}); 

		});

		</script>

		<form action="" method ="post" name="distancesubmission">
		<h3 class="seisi-inner-heading" id="seisi-inner-heading">Distance parcourue en kilomètres</h3>
		<div class="main-area">
			<div class="distance-table">
				<div class="row-1">
					<div class="td-full">Pour saisir des kilomètres, indique la date du déplacement, puis utilise la méthode de saisie suivante, soit la distance parcourue permettant de comptabiliser tes kilomètres. Les kilomètres accumulés lors des jours pluvieux seront doublés en cliquant sur le bouton «Pluie».</div>
				</div>
				<div class="row-2">
					<div class="tr-area first-tr-area">
						<h3 class="row-2-h3">Distance parcourue (kilomètres)</h3>
						<input type="text" id="diatc" name = "distanceparc" class="dist-input"/>
						<input type="hidden" id= "isitrain" name="israin" value="no" />
						<input type="submit" id ="rain"  name="raintoggle" class="dist-submit"/>
					</div>
					<div class="tr-area second-tr-area">
						<h3 class="row-2-h3">Date</h3>
						<input type="text" name="date" class="dist-input"/>
					</div>
					<div class="tr-area third-tr-area">
						<h3 class="row-2-h3">Heure</h3>
						<input type="text" name="heure" class="dist-input"/>
					</div>
					<div class="tr-area fourth-tr-area">
						<h3 class="row-2-h3">Moyen de déplacement</h3>
						<input class="radio-button" type="radio" name="depl" value="apied"/>À pied<br>
						<input class="radio-button"  type="radio" name="depl" value="avelo"/>À vélo
					</div>
				</div>
				<div class="row-3">Dernières activités<br/>
				<table>
					<?php
					foreach($latest_activity_ar as $data){
						if($data->movmethod == 'apied' ){ $method = 'À pieds'; }
						elseif($data->movmethod == 'avelo' ){ $method = 'À vélo'; }
							$actv =  "<tr><td>";
							$actv .= $data->distance_covered;
							$actv .= ' KM |</td><td>';
							$actv .= $data->date;
							$actv .= ' |</td><td>';
							$actv .= $data->time;
							$actv .= ' |</td><td>';
							$actv .= $method;
							$actv .= "</td></tr>";
						echo $actv;
					}
					#2 km  |  09-09-2014 | 15:30 | Vélo
					?>
					</table>
				</div>
				</div>
			</div>
			<div class="sauveg-input"><input type="submit" name="submit" class="sauveg-submit"/></div>
			</form>
		<?php

}


function activities_calulation_form(){
	global $wpdb, $current_user;
	get_currentuserinfo();
	$userid = $current_user->ID;
	if(isset($_POST['activitysave'])){
		$tbl_attend = $wpdb->prefix."step_attend";
		
		foreach($_POST['attend'] as $atids){
			 $x[] = "($userid, $atids)";
		}
		$chksql = $wpdb->get_results("DELETE FROM wp_step_attend WHERE user = $userid");
		$att_sql = $wpdb->query("INSERT INTO wp_step_attend (`user`,`activity_id`) VALUES ".implode(',', $x));
		?>
		<script>window.location = "<?php bloginfo('url');?>/saisie-km-mels/";</script>
		<?php
	} 

	$ugroup = get_user_steps_group();
	//$sql = $wpdb->get_results("SELECT * FROM wp_steps_events WHERE `group` = '".$ugroup."' AND `status` = 'publish' ORDER BY id DESC LIMIT 20");
	$sql = $wpdb->get_results("SELECT se.*, sa.id as attid, sa.user FROM wp_steps_events as se LEFT JOIN wp_step_attend as sa ON se.id = sa.activity_id WHERE se.group = '".$ugroup."' AND se.status = 'publish' ORDER BY se.id DESC");
?>
<form action="" method="post" name="activityform">
<h3 class="seisi-inner-heading" id="seisi-inner-heading">Activités</h3>
<div class="main-area">
	<div class="activi-table">
		<div class="row-activ-1">Pour accumuler des kilomètres additionnels, coche les activités oû tu étais présent dans la grille ci-dessous.</div>
		<div class="row-activ">
			<div class="row-activ-tr first-tr-area">
				<h3 class="row-activ-tr-h3">Présent</h3>
			</div>
			<div class="row-activ-tr second-tr-area">
				<h3 class="row-activ-tr-h3">Activité</h3>
			</div>
			<div class="row-activ-tr third-tr-area">
				<h3 class="row-activ-tr-h3">Date</h3>
			</div>
			<div class="row-activ-tr fourth-tr-area">
				<h3 class="row-activ-tr-h3">Endroit</h3>
			</div>
			<div class="row-activ-tr fifth-tr-area">
				<h3 class="row-activ-tr-h3">Km Bonus</h3>
			</div>
		</div>
		<?php 
		foreach($sql as $result){ ?>
		<div class="activity-row row-<?php echo $result->id; ?>" style="clear:both">
			<div class="row-activ-tr first-tr-area">
				<div class="area-col-2 input-a">
					<input class="radio-button" <?php if($userid == $result->user) echo "checked";?> type="checkbox" name="attend[]" value="<?php echo $result->id; ?>"/>
				</div>
			</div>
			<div class="row-activ-tr second-tr-area">
				<div class="area-col-2">
					<b><?php echo $result->activity_title; ?></b><br/>
					<?php echo $result->activity_description; ?>
				</div>
			</div>
			<div class="row-activ-tr third-tr-area">
				<div class="area-col-2">
					<?php echo $result->activity_date; ?>
				</div>
			</div>
			<div class="row-activ-tr fourth-tr-area">
				<div class="area-col-2">
					<?php echo $result->activity_place; ?>
				</div>
			</div>
			<div class="row-activ-tr fifth-tr-area">
				<div class="area-col-2">
					<?php echo $result->activity_distance; ?> KM
				</div>
			</div>
		</div>
	<?php }?>
	</div>
	<div class="sauveg-input"><input type="submit" name="activitysave" class="sauveg-submit"/></div>
</div>
</form>
<?php
}






# register plugin hook
# create database if not available
function register_plugin_steps_count(){
	global $wpdb;	
	$steps_table = $wpdb->prefix."sm_stepscount";
	$steps_events = $wpdb->prefix."steps_events";
	$steps_attend = $wpdb->prefix."step_attend";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	// this if statement makes sure that the table doe not exist already
	if($wpdb->get_var("show tables like ".$steps_table) != $steps_table) 
	{
		$sql = "CREATE TABLE IF NOT EXISTS ".$steps_table."(
				sc_id mediumint(9) NOT NULL AUTO_INCREMENT,
				user_id mediumint(9) NOT NULL,
				distance_covered VARCHAR(255) NOT NULL,
				date VARCHAR(255) NOT NULL,
				time VARCHAR(255) NOT NULL,
				movmethod VARCHAR(255) NOT NULL,
				rain enum('y','n') NOT NULL,
				UNIQUE KEY id (sc_id)
		);";
		dbDelta($sql);
	}
	if($wpdb->get_var("show tables like ".$steps_events) != $steps_events) 
	{
		$sql = "CREATE TABLE IF NOT EXISTS ".$steps_events." (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  activity_title varchar(255) NOT NULL,
			  activity_description varchar(255) NOT NULL,
			  activity_date varchar(255) NOT NULL,
			  activity_place varchar(255) NOT NULL,
			  activity_distance varchar(255) NOT NULL,
			  status varchar(255) NOT NULL,
			  PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
	dbDelta($sql);		
	}
	if($wpdb->get_var("show tables like ".$steps_attend) != $steps_attend) 
		{
		$sql = "CREATE TABLE IF NOT EXISTS ".$steps_attend." (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `user` int(11) NOT NULL,
			  `activity_id` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
		dbDelta($sql);		
		}

}

register_activation_hook( __FILE__, 'register_plugin_steps_count');



function total_distance_bya_user(){
	global $wpdb, $current_user;
	$steps_table = $wpdb->prefix."sm_stepscount";
	if(is_user_logged_in()) {
    	get_currentuserinfo();
	    $user_id = $current_user->ID;  ## Get loggedin user id here
	    $user_email = $current_user->user_email;  ## Get loggedin user email here
	}
	
	//$user_id = 4;
	//$user_email = 'sachin.mishra@60degree.com';

	$latest_activity_ar = $wpdb->get_results("SELECT distance_covered FROM ".$steps_table." WHERE user_id = '".$user_id."'");

	$get_objective = $wpdb->get_results("SELECT field_value FROM `wp_cf7dbplugin_submits` where submit_time = (SELECT submit_time FROM wp_cf7dbplugin_submits WHERE  field_name = 'courriel' AND field_value = '".$user_email."') AND field_name = 'objectif-personnel'");
	$activity_dist_sql = $wpdb->get_results("SELECT SUM(wse.activity_distance)  as activity_dis FROM wp_steps_events as wse JOIN wp_step_attend as wsa ON wse.id = wsa.activity_id WHERE wsa.user=$user_id");
	$totaldistance = '';
	if($activity_dist_sql){
		$totaldistance += $activity_dist_sql[0]->activity_dis;
	}

	foreach ($latest_activity_ar as $result) {
		$totaldistance =$totaldistance + $result->distance_covered;
	}
	
	$dist = $totaldistance.' / '.$get_objective[0]->field_value;

	return $dist;

}

add_shortcode('getu_count', 'total_distance_bya_user');

##
#  Get total distance by user's school
##
function total_distance_user_school(){
	global $wpdb;
	$user_group = get_user_steps_group();
	$total_distance = calculate_distance_by_type($user_group);

	return $total_distance;
}
add_shortcode('total_distance_byschool', 'total_distance_user_school');

## Get total distance by user's school working on live :)

function etabliss_distance(){
	global $wpdb, $current_user;
		get_currentuserinfo();
		$email = $current_user->user_email;
		$user_group = get_user_steps_group();
		$query = "SELECT SUM(st.distance_covered) as sme
				FROM wp_cf7dbplugin_submits AS wpcs1
				INNER JOIN wp_cf7dbplugin_submits AS wpcs2 ON wpcs1.submit_time = wpcs2.submit_time
				INNER JOIN wp_users AS u ON wpcs2.field_value = u.user_email
				INNER JOIN wp_sm_stepscount AS st ON st.user_id = u.ID
				WHERE wpcs1.field_value = (SELECT tbl2.field_value FROM wp_cf7dbplugin_submits as tbl1 
				JOIN wp_cf7dbplugin_submits as tbl2 ON tbl1.submit_time = tbl2.submit_time
				WHERE tbl2.field_name =  'etablissement' AND tbl1.field_value = '$email')
				AND wpcs2.field_name = 'courriel'";
		//echo $query; die;
		$sql = $wpdb->get_results($query);
		$dist_trav = $sql[0]->sme;
		$dist_acivity = university_acivity_total($user_group);
		//echo "asdas".$dist_trav; 
		//echo "iuioyui".$dist_acivity; die; 
		$total = $dist_trav + $dist_acivity;
		return $total;

}
add_shortcode('school_count', 'etabliss_distance');


# register user here

function wpcf7_before_action($cfdata) {
	$formtitle = $cfdata->title;
	if ( $formtitle == 'Inscription') {
         //do action for this form
		wp_create_user($cfdata->posted_data['courriel'], $cfdata->posted_data['mot-de-passe'],$cfdata->posted_data['courriel'] );
	}
}
add_action('wpcf7_before_send_mail', 'wpcf7_before_action',1);



function pr($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}