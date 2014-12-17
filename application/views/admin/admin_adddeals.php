<?php $this->load->view('admin/admin_header'); ?>
<link href="<?php echo base_url(); ?>templates/admin/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>templates/admin/gritter/css/jquery.gritter.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>templates/admin/chosen-bootstrap/chosen/chosen.css" />

<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('admin/admin_sidebar'); ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">

                    <!-- END BEGIN STYLE CUSTOMIZER -->     
                    <h3 class="page-title">
                        Add a Deal
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="<?php echo base_url(); ?>">Home</a> 
                            <span class="icon-angle-right"></span>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/addnetwork">Add Art Work</a>

                        </li>

                    </ul>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <h4><i class="icon-reorder"></i>Add Art Work</h4>

                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->

                            <form action="<?php echo base_url(); ?>admin/add_deals/insert_deals" id="insert_mediatype" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                                        <input type="text" name="name" data-required="1" class="span6 m-wrap"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Media Type</label>
                                    <div class="controls">
                                        <select data-placeholder="Choose media Types"  name="media_id[]" class="chosen span6" multiple="multiple" tabindex="6">
                                            <option value=""></option>
                                            <?php
                                            foreach ($all_medtpye as $allmediatype) {
                                                ?>
                                                <option value="<?php echo $allmediatype['media_id'] ?>"><?php echo $allmediatype['name'] ?></option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Categories</label>
                                    <div class="controls">
                                        <?php
                                        foreach ($all_deals_cats as $all_deals_cat) {
                                            ?>

                                            <label class="checkbox">
                                                <div class="checker" id="uniform-undefined"><span>
                                                        <input type="checkbox" value="<?php echo $all_deals_cat['cat_id'] ?>" name="categories[]" style="opacity: 0;"></span></div> <?php echo $all_deals_cat['cat_name'] ?>
                                            </label>
    <?php
}
?>

                                    </div>
                                </div>



                                <!--div class="control-group">
      <label class="control-label">Front Image</label>
      <div class="controls">
         <div data-provides="fileupload" class="fileupload fileupload-new">
            <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
               <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
            </div>
            <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
            <div>
               <span class="btn btn-file"><span class="fileupload-new">Select Image</span>
               <span class="fileupload-exists">Change</span>
               <input type="file" name="front" class="default"></span>
               <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
            </div>
         </div>
         
      </div>
   </div>
                           
                           <div class="control-group">
      <label class="control-label">Back Image</label>
      <div class="controls">
         <div data-provides="fileupload" class="fileupload fileupload-new">
            <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
               <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
            </div>
            <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
            <div>
               <span class="btn btn-file"><span class="fileupload-new">Select Image</span>
               <span class="fileupload-exists">Change</span>
               <input type="file"name="back" class="default"></span>
               <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
            </div>
         </div>
         
      </div>
   </div-->

                                <div class="control-group">
                                    <label class="control-label">Deals Images<br><small>(Multiple Images)</small></label>
                                    <div class="controls">
                                        <div data-provides="fileupload" class="fileupload fileupload-new">
                                            <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
                                                <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                                            </div>
                                            <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select Image</span>
                                                    <span class="fileupload-exists">Change</span>
                                                    <input type="file" name="deal[]" multiple="true" class="default"></span>
                                                <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                            </div>
                                        </div>


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
<!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
<!-- END SIDEBAR -->