 <?php 
	$this->load->view('templates/layouts/'.$main_content['banner_content']);
	
	
	?>
    <!-- Content area start here -->
    <div class="wrapper">
			<?php 
				$this->load->view('templates/layouts/'.$main_content['left_column_content']);
			?>
        <div class="right_col">
        	<?php echo form_open('login/ResetPassword', array('id' => 'frmResetPass','class'=>'block-content form update_profile')); ?>
 			
			
		<div id="pageWidth">
         
         <div class="clear-10"></div>
         
		<!-- full Column -->
        <div class="full-column">
				<!-- Signup -->
		<div class="signup-box">
		<?php echo @$page_data['submit_message']; ?>
		<?php echo display_flash('submit_message'); ?>
		<h2>Reset Password</h2>
		
            <div class="field" style="padding-left:0px;">
               <p>Your Password Link is Expired .</p> 
            </div>
           

			</div>
        </div>
        </div></div>
      		<?php echo form_close(); ?>   
        
        </div><!-- End Rightcol -->
    </div>
