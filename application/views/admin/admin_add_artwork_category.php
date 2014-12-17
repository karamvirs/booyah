<?php $this->load->view('admin/admin_header'); ?>
	
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
	<?php $this->load->view('admin/admin_sidebar'); ?>
	<div class="page-content">
	<div class="container-fluid">
	<div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN STYLE CUSTOMIZER -->
                
                  <!-- END BEGIN STYLE CUSTOMIZER -->     
                  <h3 class="page-title">
                    Add an artwork category
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo base_url('admin'); ?>">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Add a category</a>
                     </li>
                    
                  </ul>
               </div>
            </div>
	<div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN VALIDATION STATES-->
                  <div class="portlet box green">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Add a category</h4>
                        
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                       <?php echo form_open('admin/artwork_categories/add_category', array('class' => 'form-horizontal', 'id'=>'add_artwork_category')); ?>
                           <div class="alert alert-error hide">
                              <button class="close" data-dismiss="alert"></button>
                              You have some form errors. Please check below.
                           </div>
                           <div class="alert alert-success hide">
                              <button class="close" data-dismiss="alert"></button>
                              Your form validation is successful!
                           </div>
                           <div class="control-group">
                              <label class="control-label">Catgory Name:<span class="required">*</span></label>
                              <div class="controls">
                                 <input type="text" name="cat_name" class="span6 m-wrap" required/>
                              </div>
                           </div>
                          <div class="control-group">
                           <label class="control-label">Category Type<span class="required">*</span></label>
								 <div class="controls">
                                 <label class="radio">
                                 <div class="radio" id="uniform-undefined"><span>
								 <input type="radio" value="artwork_categories" name="cat_type" style="opacity: 0;" required></span></div>
                                 Artwork
                                 </label>
                                 <label class="radio">
                                 <div class="radio" id="uniform-undefined">
								 <input type="radio" value="deals_categories" name="cat_type" style="opacity: 0;" required></div>
                                 Deals
                                 </label>  
                                 
                              </div> 
							</div>
                          
                           <div class="form-actions">
                              <button type="submit" class="btn green">Submit</button>
                              <button type="button" class="btn">Cancel</button>
                           </div>
                        </form>
                        <!-- END FORM-->
                     </div>
                  </div>
                  <!-- END VALIDATION STATES-->
               </div>
            </div>
			</div></div></div>
			
			<div class="footer">
      2013 &copy; Metronic by keenthemes.
      <div class="span pull-right">
         <span class="go-top"><i class="icon-angle-up"></i></span>
      </div>
   </div>
   <!-- END FOOTER -->
   <!-- BEGIN JAVASCRIPTS -->    
   <!-- Load javascripts at bottom, this will reduce page load time -->
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
        $("#add_artwork_category").validate({
            rules: {
                cat_name: {required: true},
				cat_type: {required: true}
				
            }
        });
    });
</script>   
 
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
		<!-- END SIDEBAR -->