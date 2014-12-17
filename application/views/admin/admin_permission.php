<?php $this->load->view('admin/admin_header'); ?>
<link href="<?php echo base_url(); ?>templates/admin/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>templates/admin/gritter/css/jquery.gritter.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>templates/admin/chosen-bootstrap/chosen/chosen.css" />

<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">	
    <?php $this->load->view('admin/admin_sidebar'); ?>
    <div class="page-content">
        <div class="container-fluid">	
            <div class="row-fluid">
                <div class="span12">  						
					<h3 class="page-title">Add an User</h3>					
					<ul class="breadcrumb">
                        <li><i class="icon-home"></i>
                            <a href="<?php echo base_url(); ?>">Home</a> 
                            <span class="icon-angle-right"></span>
                        </li>
                        <li><a href="#">Permissions</a></li> 
                    </ul>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="portlet box green">								
						<div class="portlet-title">								
							<h4><i class="icon-reorder"></i>Add Permisssions to Role</h4>				
						</div>
                        <div class="portlet-body form">							
                        <form class="permisssion" method="POST" name="permisssion">
						  <?php 
						   if(validation_errors() != '') { ?>
								<div class="alert alert-error hide" style="display: block;">
								<button data-dismiss="alert" class="close"></button>
									<?php echo validation_errors(); ?>
								</div>	
							<?php } ?>
									
                                    <h3 class="form-section">Update Permissions</h3>
                                  
                                    
								<table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th class="hidden-480">Modules</th>
                                        <th class="hidden-480">Regular</th>
                                        <th class="hidden-480">Premium</th>
                                        

                                    </tr>
                                </thead>
                                <tbody>
									<?php //echo "<pre>";print_r($reg_data);echo "</pre>";
									$pro_sel = array();
									$reg_sel = array();
									if(!empty($reg_data['modules'])){
										$reg_sel = explode(',',$reg_data['modules']);
									} 
									if(!empty($reg_data['modules'])){									
										$pro_sel = explode(',',$pro_data['modules']);
									} 
									//die("wait here");?>
									<tr class="odd gradeX">                                                                                       
										<td class="center"><span class="label label-success bigfont"> Advertisement</span></td>
										<td class="center"><input type="checkbox" name="reg[]" value="advertisement" <?php if(in_array('advertisement', $reg_sel)) echo( 'checked'); ?> /></td>
										<td class="center"><input type="checkbox" name="pro[]" value="advertisement" <?php if(in_array('advertisement', $pro_sel)) echo( 'checked'); ?> /></td>											
																				 
									</tr>
									<tr class="odd gradeX">                                                                                       
										<td class="center"><span class="label label-success bigfont"> Comments</span></td>										
										<td class="hidden-480"><input type="checkbox" name="reg[]" value="comments" <?php if(in_array('comments', $reg_sel)) echo( 'checked'); ?> /></td>		
										<td class="hidden-480"><input type="checkbox" name="pro[]" value="comments" <?php if(in_array('comments', $pro_sel)) echo( 'checked'); ?> /></td>		
									</tr>
                                </tbody>
                            </table>
                        </div>
                   
									
									 
                                    <!--/row-->                               
                                    
                                   
                                    <!--/row-->
                                    <div class="form-actions">
									<input type="submit" name="persave" class="btn blue" Value="Save">
									<button type="button" class="btn">Cancel</button>
                                    </div>
                                 </form>
						


						
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>
        </div></div></div>

<div class="footer"> 2013 &copy; Booyah
				<div class="span pull-right">
				<span class="go-top"><i class="icon-angle-up"></i></span>		
				</div>				
				</div>

<script src="<?php echo base_url(); ?>templates/admin/js/jquery-1.8.3.min.js"></script>    
<script src="<?php echo base_url(); ?>templates/admin/breakpoints/breakpoints.js"></script>      
<script src="<?php echo base_url(); ?>templates/admin/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/jquery.blockui.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/jquery.cookie.js"></script>

<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>templates/admin/js/excanvas.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/respond.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/bootstrap-daterangepicker/daterangepicker.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/app.js"></script>     
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.setPage("form_validation");
        App.init();
    });
</script>
<script>  
    jQuery(document).ready(function() {


        $("#add_user").validate({
            rules: {
				name: {required: true},
                email: {required: true, email: true}, 
				type: {required: true},
				password: "required",
				repassword: {
				equalTo: "#password"
				}               
            },  
			ignore: "",
            success: function() {
                $('label .error').hide();
            },
			errorPlacement: function(){
						return false;
					},			
            
			//debug: true,
			errorClass:'error',
			validClass:'success',			
			highlight: function (element, errorClass, validClass) 
			{ 
				$(element).parents("div.control-group")
						  .addClass(errorClass)
						  .removeClass(validClass); 

			}, 
			unhighlight: function (element, errorClass, validClass)
			{
				$(element).parents(".error")
						  .removeClass(errorClass)
						  .addClass(validClass); 
			}		
			


        });
    });
</script>
<!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
<!-- END SIDEBAR -->
