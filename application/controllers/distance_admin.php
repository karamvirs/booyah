<?php

function distance_statistics(){
	echo "<div id='icon-upload' class='icon32'></div>";
	echo __('<h2>Distance Statistics</h2>');
	stats_tables();
}



function stats_tables(){ 
	?>
	
	<style type="text/css">
			table {border-collapse: collapse;width: 60%;}
			td {width: 95%;padding: 0.5rem;text-align: left;/*text-transform: capitalize;*/}
			tr {border-bottom: none; }
			thead b{color: #F4795A;font-size: 20px;}
			tbody tr:last-child	{ border-bottom: 2px solid #AAC135;}
	</style>

		<table>
			<thead>
				<tr><td><b>Inscriptions total</b></td><td></td><td></td></tr>
			</thead>
			<tbody>
				<tr><td>Nombre d'inscriptions total </td><td>:</td><td><?php echo calcuInscr();?></td></tr>
				<tr><td>Hommes </td><td>:</td><td><?php echo calcValsCount('sexe', 'Homme'); ?></td></tr>
				<tr><td>Femmes </td><td>:</td><td><?php echo calcValsCount('sexe', 'Femme'); ?></td></tr>
				<tr><td>Étudiant  </td><td>:</td><td><?php echo calcValsCount('statut', 'Étudiant ou étudiante'); ?></td></tr>
				<tr><td>Professeur  </td><td>:</td><td><?php echo calcValsCount('statut', 'Employé ou employée'); ?></td></tr>
				<tr><td>nombre de départements représentés</td><td>:</td><td><?php echo calcDistParm('departement'); ?></td></tr>
				<tr><td>nom des départements représentés  </td><td>:</td><td><?php echo getDepartmentNames();?></td></tr>
			</tbody>
		</table>

		<table>
			<thead>
				<tr><td><b>Ayant saisi des km </b></td><td></td><td></td></tr>
			</thead>
			<tbody>
				<tr><td>Nombre d'inscriptions total </td><td>:</td><td><?php echo calcKMCount(); ?></td></tr>
				<tr><td>Hommes </td><td>:</td><td><?php echo calcKMparamCount('Homme'); ?></td></tr>
				<tr><td>Femmes </td><td>:</td><td><?php echo calcKMparamCount('Femme'); ?></td></tr>
				<tr><td>Étudiant  </td><td>:</td><td><?php echo calcKMparamCount('Étudiant ou étudiante'); ?></td></tr>
				<tr><td>Professeur  </td><td>:</td><td><?php echo calcKMparamCount('Employé ou employée'); ?></td></tr>
				<tr><td>Nombre de départements représentés </td><td>:</td><td><?php echo number_of_departments(); ?></td></tr>
				<tr><td>Nom des départements représentés  </td><td>:</td><td><?php echo getDepartmentNames();?></td></tr>
				<tr><td>Mobilisation aux activités</td><td>:</td><td><?php echo total_activity_count(); ?></td></tr>
			</tbody>
		</table>

		<table>
			<thead>
				<tr><td><b>Total par activité par établissement </b></td><td></td><td></td></tr>
			</thead>
			<tbody>
				<tr><td>Université du Québec à Trois-Rivières</td><td>:</td><td><?php echo calcValsCount('etablissement','Université du Québec à Trois-Rivières');?></td></tr>
				<tr><td>Université de Rimouski</td><td>:</td><td><?php echo calcValsCount('etablissement','Université de Rimouski');?></td></tr>
				<tr><td>Cégep de Baie-Comeau</td><td>:</td><td><?php echo calcValsCount('etablissement','Cégep de Baie-Comeau');?></td></tr>
				<tr><td>Cégep Garneau</td><td>:</td><td><?php echo calcValsCount('etablissement','Cégep Garneau');?></td></tr>
				<tr><td>Cégep de Rimouski</td><td>:</td><td><?php echo calcValsCount('etablissement','Cégep de Rimouski');?></td></tr>
			</tbody>
		</table>

		<table>
			<thead>
				<tr><td><b>Distances parcourues</b></td><td></td><td></td></tr>
			</thead>

			<tbody>
				<tr><td>Km parcourus rééel (sans bouton pluie activé) </td><td>:</td><td><?php echo get_distance_count();?></td></tr>
				<tr><td>Km parcourus (avec bouton pluie activé) </td><td>:</td><td><?php echo get_rain_distance_count('yes');?></td></tr>
				<tr><td>Km total (incluant la participation aux activités) </td><td>:</td><td><?php echo total_distance_covered_alluser(); ?></td></tr>
				<tr><td>Km parcourus par les hommes (avec et sans pluie) </td><td>:</td><td><?php echo calculate_distance_by_type('Homme');?></td></tr>
				<tr><td>Km parcourus par les femmes (avec et sans pluie)</td><td>:</td><td><?php echo calculate_distance_by_type('Femme');?></td></tr>
				<tr><td>Km parcourus par les étudiants (avec et sans pluie)</td><td>:</td><td><?php echo calculate_distance_by_type('Étudiant ou étudiante'); ?></td></tr>
				<tr><td>Km parcourus par les professeurs (avec et sans pluie) </td><td>:</td><td><?php echo calculate_distance_by_type('Employé ou employée');?></td></tr>
				
			</tbody>
		</table>

		<table>
			<thead>
				<tr><td><b>Km parcourus par établissement</b></td><td></td><td></td></tr>
			</thead>
			<tbody>		
				<tr><td>Université du Québec à Trois-Rivières</td><td>:</td><td><?php echo calculate_distance_by_type('Université du Québec à Trois-Rivières');?></td></tr>
				<tr><td>Université de Rimouski</td><td>:</td><td><?php echo calculate_distance_by_type('Université de Rimouski');?></td></tr>
				<tr><td>Cégep Garneau</td><td>:</td><td><?php echo calculate_distance_by_type('Cégep Garneau');?></td></tr>
				<tr><td>Cégep de Rimouski</td><td>:</td><td><?php echo calculate_distance_by_type('Cégep Rimouski');?></td></tr>
				<tr><td>Cégep de Baie-Comeau</td><td>:</td><td><?php echo calculate_distance_by_type('Cégep de Baie-Comeau');?></td></tr>
			</tbody>
		</table>



		<table>
			<thead>
				<tr><td><b>Déplacements effectués</b></td><td></td><td></td></tr>
			</thead>
			<tbody>
				<tr><td>Nombre de déplacements total enregistrés </td><td>:</td><td><?php echo tripCount(); ?></td></tr>
				<tr><td>Nombre de déplacements total réalisés sous la pluie </td><td>:</td><td><?php echo tripCountType('rain', 'yes');?></td></tr>
				<tr><td>Nombre de déplacements total pour les femmes </td><td>:</td><td><?php echo tripAttCountType('Femme');?></td></tr>
				<tr><td>Nombre de déplacements total pour les hommes</td><td>:</td><td><?php echo tripAttCountType('Homme');?></td></tr>
				<tr><td>Nombre de déplacements total pour les étudiants </td><td>:</td><td><?php echo tripAttCountType('Étudiant ou étudiante');?></td></tr>
				<tr><td>Nombre de déplacements total pour els professeurs  </td><td>:</td><td><?php echo tripAttCountType('Employé ou employée');?></td></tr>
				<tr><td>Nombre de déplacement moyen par homme </td><td>:</td><td><?php echo tripAttAvegType('Homme');?></td></tr>
				<tr><td>Nombre de déplacement moyen par femme</td><td>:</td><td><?php echo tripAttAvegType('Femme');?></td></tr>
				<tr><td>Nombre de déplacement moyen par étudiant </td><td>:</td><td><?php echo tripAttAvegType('Étudiant ou étudiante');?></td></tr>
				<tr><td>Nombre de déplacement moyen par professeur </td><td>:</td><td><?php echo tripAttAvegType('Employé ou employée');?></td></tr>
				<tr><td></td><td></td></tr>
				<tr><td></td><td></td></tr>
				<tr><td>km moyen parcouru par déplacement pour les homme (sans bouton pluie)</td><td>:</td><td><?php echo tripAttAvegRainType('Homme', 'no');?></td></tr>
				<tr><td>km moyen parcouru par déplacement pour les femmes (sans bouton pluie) </td><td>:</td><td><?php echo tripAttAvegRainType('Femme', 'no');?></td></tr>
				<tr><td>km moyen parcouru par déplacement pour les étudiants (sans bouton pluie) </td><td>:</td><td><?php echo tripAttAvegRainType('Étudiant ou étudiante', 'no');?></td></tr>
				<tr><td>km moyen parcouru par déplacement pour les professeurs (sans bouton pluie) </td><td>:</td><td><?php echo tripAttAvegRainType('Employé ou employée', 'no');?></td></tr>
			</tbody>
		</table>

	<?php
}



function list_distance_activities(){
	global $wpdb;
	echo "<div id='icon-upload' class='icon32'></div>";
	echo __('<h2>List Activities</h2>');
		
	//check if has any action
		if($_GET['action'] == "delete"){
				//delete records from records table
				activity_delete_record($_GET['id']);
		}

	$sqls = $wpdb->get_results("SELECT * FROM wp_steps_events");
	?>
	<table class="widefat">
					<thead>
						<tr>
							<th class="check-column" scope="row"><input  name="names[]" class="one" type="checkbox" value=""></th>
							<th></th>
							<th>Date</th>
							<th>Place</th>
							<th>Activity</th>
							<th>Distance</th>
							<th>Group</th>
							<th>Status</th>
							<th>Action </th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th class="check-column" scope="row"><input  name="names[]" class="one" type="checkbox" value=""></th>
							<th></th>
							<th>Date</th>
							<th>Place</th>
							<th>Activity</th>
							<th>Distance</th>
							<th>Group</th>
							<th>Status</th>
							<th>Action </th>
						</tr>
					</tfoot>
					<tbody>
				<?php foreach ($sqls as $sql): ?>
				<?php ?>
					   <tr>
						<th class="check-column" scope="row"><input  name="names[]" class="one" type="checkbox" value="<?php echo $sql->id; ?>"></th>
						 <th></th>
						 <th><?php echo $sql->activity_date;?></th>
						 <th><?php echo $sql->activity_place; ?></th>
						 <th><?php echo $sql->activity_title; ?></th>
						 <th><?php echo $sql->activity_distance; ?> KM</th>
						 <th><?php echo $sql->group; ?></th>
						 <th><?php echo ucfirst($sql->status); ?></th>
						 <th><a href="admin.php?page=addactivity&action=edit&id=<?php echo $sql->id;?>">Edit</a> | <a href="admin.php?page=listactivity&action=delete&id=<?php echo $sql->id;?>">Delete</a> </th>
					   </tr>
				<?php endforeach; ?>
					</tbody>
			</table>
	<?php
}


function new_distance_activities(){
	global $wpdb;
	echo "<div id='icon-upload' class='icon32'></div>";
	echo __('<h2>Activity</h2>');
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$message	 = "";
	$id 		= "";
	$title 		= "";
	$desc 	 	= "";
	$date 		= "";
	$place 		= "";
	$distance 	= "";
	$group 		= "";
	$status 	= "publish";
	$submit		= "submit";
	if(isset($_POST['submit'])){
		$sql = "INSERT INTO wp_steps_events (`activity_title`, `activity_description`, `activity_date`, `activity_place`, `activity_distance`, `group`, `status`) VALUES ('".$_POST['activity_title']."', '".$_POST['activity_description']."', '".$_POST['activity_date']."', '".$_POST['activity_place']."', '".$_POST['activity_distance']."', '".$_POST['group']."', '".$_POST['status']."');";
		dbDelta($sql);
		$message = "Activity ".$_POST['activity_title']." added!";
	}elseif(isset($_POST['update'])){
		$sql = "UPDATE wp_steps_events SET `activity_title` = '".$_POST['activity_title']."',
				`activity_description` = '".$_POST['activity_description']."',
				`activity_date` = '".$_POST['activity_date']."', 
				`activity_place` = '".$_POST['activity_place']."',
				`activity_distance` = '".$_POST['activity_distance']."',
				`status` = '".$_POST['status']."',
				`group` =  '".$_POST['group']."' WHERE id =".$_POST['id'];		
		dbDelta($sql);
		$message = "Activity ".$_POST['activity_title']." updated!";
	}elseif(isset($_POST['cancel'])){
	#do nothing
		$message = "You hit cancel!";
	}
	if($_GET['action'] == "edit"){
				$editsql = $wpdb->get_results("SELECT * FROM wp_steps_events WHERE id = ".$_GET['id']); 
				$id 		= $editsql[0]->id;
				$title 		= $editsql[0]->activity_title;
				$desc 	 	= $editsql[0]->activity_description;
				$date 		= $editsql[0]->activity_date;
				$place 		= $editsql[0]->activity_place;
				$distance 	= $editsql[0]->activity_distance;
				$group 		= $editsql[0]->group;
				$status 	= $editsql[0]->status;
				$submit		= "update";
	}
	if($message) echo "<span>".$message."</span>";
	$unis = array("Université du Québec à Trois-Rivières", "Cégep Garneau", "Cégep Rimouski", "Université de Rimouski", "Cégep de Baie-Comeau");

	?>
	  <form id="posts-filter" method="post" name="add_activity" action="">
         <table style="width:70%;" class="wp-list-table widefat fixed tags" cellspacing="0">
        	<tr>
        		<td>
        			<label for="tag-name">Add Title</label>
    			</td>
    			<td width="20px">:</td>
    			<td>
    				<input placeholder="Activité" type="text" name="activity_title" value="<?php echo $title; ?>" />
		        	<?php if($id){?> <input type="hidden" name="id" value="<?php echo $id; ?>" /><?php }?>
        		</td>
        	</tr>
        	<tr>
        		<td></td>
        		<td></td>
        		<td>
        			<textarea placeholder="Sub Heading" type="text" name="activity_description"><?php echo $desc; ?></textarea>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<label for="tag-date">Choose Date</label>
    			</td>
        		<td>:</td>
        		<td>
        			<input placeholder="Date" type="text" name="activity_date" value="<?php echo $date; ?>" />
    			</td>
			</tr>
        	<tr>
        		<td>
        			<label for="tag-place">Select Endroit</label>
    			</td>
				<td>:</td>
				<td>
					<input placeholder="Endroit" type="text" name="activity_place" value="<?php echo $place; ?>" />
				</td>
			</tr>
        	<tr>
        		<td>
        			<label for="tag-distance">Add Distance</label>
    			</td>
    			<td>:</td>
    			<td>
    				<input placeholder="Km Bonus" type="text" name="activity_distance"  value="<?php echo $distance; ?>" /> KM <em>Add Integer only</em>
				</td>
			</tr>
        	<tr>
        		<td>
        			<label for="tag-distance">Select Group</label>
    			</td>
				<td>:</td>
				<td>
        			<select name="group">
        				<?php foreach ($unis as $university) {
        					?>
        					<option <?php if($group == $university) echo "selected"; ?> value="<?php echo $university;?>"><?php echo $university; ?></option>
        					<?php
        				}?>        				
					</select>
				</td>
			</tr>
			<tr>
        		<td>
        			<label for="tag-status">Status</label>
    			</td>
				<td>:</td>
				<td>
        			<select name="status">        				
							<option <?php if($status == "publish") echo "selected"; ?> value="publish">Publish</option>
							<option <?php if($status == "draft") echo "selected"; ?> value="draft">Draft</option> 
					</select>
				</td>
			</tr>
        	<tr>
        		<td>
        			<input type="submit" name="<?php echo $submit; ?>" value="<?php echo ucfirst($submit); ?>"/> &nbsp;<input type="submit" name="cancel" value="Cancel"/>
        		</td>
        	</tr>
         </table>
       </form>


	<?php

}

#delete activity function
function activity_delete_record($id){
		global $wpdb;
		$where = array( 'id' => $id);
		$wpdb->delete('wp_steps_events',$where);	
}

?>
