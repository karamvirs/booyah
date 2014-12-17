<?php $this->load->view('admin/admin_header'); ?>
	<link href="<?php echo base_url(); ?>templates/admin/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
	
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
                    Add a Media-Type
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo base_url('admin'); ?>">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="<?php echo base_url(); ?>admin/add_mediatype">Add Mediatype</a>
                     </li>
                    
                  </ul>
               </div>
            </div>
	<div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN VALIDATION STATES-->
                  <div class="portlet box green">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Add a MediaType</h4>
                        
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                       
                        <form action="<?php echo base_url(); ?>admin/add_mediatype/insert_mediatype" id="insert_mediatype" method="post" class="form-horizontal" enctype="multipart/form-data">
                           <div class="alert alert-error hide">
                              <button class="close" data-dismiss="alert"></button>
                              You have some form errors. Please check below.
                           </div>
                           <div class="alert alert-success hide">
                              <button class="close" data-dismiss="alert"></button>
                              Your form validation is successful!
                           </div>
                           <div class="control-group">
                              <label class="control-label">Name:<span class="required">*</span></label>
                              <div class="controls">
                                 <input type="text" name="name" class="span6 m-wrap" required/>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Width:<span class="required">*</span></label>
                              <div class="controls">
                                 <input name="width" type="text" class="span6 m-wrap" required/>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Height:<span class="required">*</label>
                              <div class="controls">
                                 <input name="height" type="text" class="span6 m-wrap" required/>
                              </div>
                           </div>
						   <div class="control-group">
                           <label class="control-label">Allow Deals<span class="required">*</span></label>
								 <div class="controls">
                                 <label class="radio">
                                 <div class="radio" id="uniform-undefined"><span>
								 <input type="radio" value="yes" name="allow_deals" style="opacity: 0;"></span></div>
                                 Yes
                                 </label>
                                 <label class="radio">
                                 <div class="radio" id="uniform-undefined"><span class="checked">
								 <input type="radio" checked="" value="no" name="allow_deals" style="opacity: 0;"></span></div>
                                 No
                                 </label>  
                                 
                              </div> 
							</div>
						  
						   <!--div class="control-group">
                              <label class="control-label">Max Deals&nbsp;&nbsp;</label>
                              <div class="controls">
                                 <input name="max_deals" type="text" class="span6 m-wrap"/>
                              </div>
                           </div-->
						   
						   <div class="control-group">
                           <label class="control-label">Allow Custom Image upload<span class="required">*</span></label>
								 <div class="controls">
                                 <label class="radio">
                                 <div class="radio" id="uniform-undefined"><span>
								 <input type="radio" value="yes" name="allow_image" style="opacity: 0;"></span></div>
                                 Yes
                                 </label>
                                 <label class="radio">
                                 <div class="radio" id="uniform-undefined"><span class="checked">
								 <input type="radio" checked="" value="no" name="allow_image" style="opacity: 0;"></span></div>
                                 NO
                                 </label>  
                             
                              </div> 
							</div>
							
							
                            <div class="control-group">
                              <label class="control-label">Image Types</label>
                              <div class="controls">
                                 <label class="checkbox">
                                 <div class="checker" id="uniform-undefined"><span>
								 <input type="checkbox" value="front" name="image_types[]" style="opacity: 0;"></span></div> Front
                                 </label>
                                 <label class="checkbox">
                                 <div class="checker" id="uniform-undefined"><span>
								 <input type="checkbox" value="back" name="image_types[]" style="opacity: 0;"></span></div> Back
                                 </label> 
								 <label class="checkbox">
                                 <div class="checker" id="uniform-undefined"><span>
								 <input type="checkbox" value="deals" name="image_types[]" style="opacity: 0;"></span></div> Deals
                                 </label>
                              </div>
                           </div>
                         
						   <div class="control-group">
                           <label class="control-label">Allow Text Input<span class="required">*</span></label>
								 <div class="controls">
                                 <label class="radio">
                                 <div class="radio" id="uniform-undefined"><span>
								 <input type="radio" value="yes" name="allow_text_input" style="opacity: 0;"></span></div>
                                 Yes
                                 </label>
                                 <label class="radio">
                                 <div class="radio" id="uniform-undefined"><span class="checked">
								 <input type="radio" checked="" value="no" name="allow_text_input" style="opacity: 0;"></span></div>
                                 NO
                                 </label>  
                             
                              </div> 
							</div>
							
							<div class="control-group">
                              <label class="control-label">Image Upload</label>
                              <div class="controls">
                                 <div data-provides="fileupload" class="fileupload fileupload-new">
                                    <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
                                       <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                                    </div>
                                    <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                    <div>
                                       <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" class="default" name="uploaded_image"></span>
                                       <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                    </div>
                                 </div>
                                 
                              </div>
                           </div>

                           <div class="control-group">
                                    <label class="control-label">Custom Fields</label>
                                    <input type='button' id='addmore_btn' value='add fields' class='default'> 
                                    <div class="controls" id='custom_fields'>
                                    <?php 
                                    if(!empty($mediatype['custom_fields'])){
                                      $fields = json_decode($mediatype['custom_fields']);
                                      $i = 1;
                                      foreach($fields as $field){
                                        echo '<div><input type="text" name="custom_fields[]" id="field_'.$i.'" value="'.$field.'" /><a href="javascript:void(0)" class="removeclass">&times;</a></div>';
                                        $i++;
                                      }

                                    }

                                    ?>
                                        
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
   <script type="text/javascript">
  $(function(){
      var MaxInputs       = 8; //maximum input boxes allowed
      var InputsWrapper   = $("#custom_fields"); //Input boxes wrapper ID
      var AddButton       = $("#addmore_btn"); //Add button ID

      var x = InputsWrapper.length; //initlal text box count
      var FieldCount=1; //to keep track of text box added

      $(AddButton).click(function (e)  //on add input button click
      {
              if(x <= MaxInputs) //max input box allowed
              {
                  FieldCount++; //text box added increment
                  //add input box
                  $(InputsWrapper).append('<div><input type="text" name="custom_fields[]" id="field_'+ FieldCount +'" /><a href="javascript:void(0)" class="removeclass">&times;</a></div>');
                  x++; //text box increment
              }
      return false;
      });

      $(document).on('click', '.removeclass', function(e) { 
         $(this).parent('div').remove(); //remove text box
      })

  });
</script>
   <script>
	 jQuery(document).ready(function() {    
	jQuery('#insert_mediatype').validate({
	
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                name: {
                    minlength: 2,
                    required: true
                },
                width: {
                    required: true,
                    
                },
                height: {
                    required: true,
                }
                
            },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.help-inline').removeClass('ok'); // display OK icon
                $(element)
                    .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change dony by hightlight
                $(element)
                    .closest('.control-group').removeClass('error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
            }

           
        });
		});
	</script>  
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
		<!-- END SIDEBAR -->