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
                        <li><a href="#">Add an User</a></li> 
                    </ul>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="portlet box green">								
						<div class="portlet-title">								
							<h4><i class="icon-reorder"></i>Add an User</h4>				
						</div>
                        <div class="portlet-body form">							
						  <?php echo form_open("admin/users/edit/".$user_data[0]->id, array('class' => 'form-horizontal','id' => 'add_user','method'=>'post')); 	
						   if (validation_errors() != '') { ?>
								<div class="alert alert-error hide" style="display: block;">
								<button data-dismiss="alert" class="close"></button>
									<?php echo validation_errors(); ?>
									</div>	
									<?php } ?>
									
                                    <h3 class="form-section">Person Info</h3>
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label">Name</label>
                                             <div class="controls">
                                                <input type="text" class="m-wrap span12" name="name" placeholder="Enter User Name" value="<?php echo $user_data[0]->name; ?>">                                                
                                             </div>
                                          </div>
                                       </div>
                                       <!--/span-->                                       
									   
									   <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label">User Type</label>
                                             <div class="controls">                                                
                                                <label class="radio">
                                                <input type="radio" name="type" value="pro" <?php if($user_data[0]->type == "pro") { echo "checked='checked'";}?> />
                                                Premium
                                                </label>
                                                <label class="radio">
                                                <input type="radio" name="type" value="regular" <?php if($user_data[0]->type == "regular") { echo "checked='checked'";}?> />
                                                Regular
                                                </label>  
                                             </div>
                                          </div>
                                       </div>
                                       <!--/span-->
                                    </div>
                                    <!--/row-->
                                   
                                    <!--/row-->        
                                    <div class="row-fluid">
										<div class="span6 valid">
                                          <div class="control-group">
                                             <label class="control-label">Your Email</label>
                                             <div class="controls">
                                                <input type="email"  name="email" class="m-wrap span12" placeholder="Enter User Email" value="<?php echo $user_data[0]->email; ?>" value="<?php echo set_value('email'); ?>">
												<input type="hidden" name="email_cofirm"  value="<?php echo $user_data[0]->email; ?>">
												<input type="hidden" name="user_id"  value="<?php echo $user_data[0]->id; ?>">
                                             </div>
                                          </div>
                                       </div>	
									  
                                    </div>
									
                                    <!--/row-->                               
                                    <h3 class="form-section">Address</h3>
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label">Address1</label>
                                             <div class="controls">
                                                <input type="text" name="address1" class="m-wrap span12" value="<?php echo $user_data[0]->address1; ?>"> 
												<span><?php echo form_error('address1'); ?></span>
                                             </div>
                                          </div>
                                       </div>
									   
									   <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label">Address2</label>
                                             <div class="controls">
                                                <input type="text" class="m-wrap span12" name="address2" value="<?php echo $user_data[0]->address2; ?>"> 
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label">City</label>
                                             <div class="controls">
                                                <input type="text" name="city" class="m-wrap span12" value="<?php echo $user_data[0]->city; ?>"> 
                                             </div>
                                          </div>
                                       </div>
                                       <!--/span-->
                                       <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label" >Province</label>
                                             <div class="controls">
                                                <input type="text" name="province"  class="m-wrap span12" value="<?php echo $user_data[0]->province; ?>"> 
                                             </div>
                                          </div>
                                       </div>
                                       <!--/span-->
                                    </div>
                                    <!--/row-->           
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label">Zip</label>
                                             <div class="controls">
                                                <input type="text" name="zip" class="m-wrap span12" value="<?php echo $user_data[0]->zip; ?>"> 
                                             </div>
                                          </div>
                                       </div>
                                       <!--/span-->
                                      
                                       <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="form-actions">
									<input type="submit" class="btn blue" Value="Save">
									<button type="button" class="btn">Cancel</button>
                                    </div>
                                 </form>
						


						
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>
        </div></div></div>

<div class="footer"> 2013 &copy; Spotonmedia.com		
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
