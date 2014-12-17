<?php
$this->load->view('admin/admin_header');
//echo "<pre>";print_r($zone);echo "</pre>";
?>
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

                    <h3 class="page-title">
                        Edit Page
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="<?php echo base_url(); ?>">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/pages/add_page">Page</a>
                            <i class="icon-angle-right"></i>
                        </li>

                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <h4><i class="icon-reorder"></i>Edit Page</h4>

                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->

                            <form action="<?php echo base_url(); ?>admin/pages/update_page" id="insert_mediatype" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="alert alert-error hide">
                                    <button class="close" data-dismiss="alert"></button>
                                    You have some form errors. Please check below.
                                </div>
                                <div class="alert alert-success hide">
                                    <button class="close" data-dismiss="alert"></button>
                                    Your form validation is successful!
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Page Title:<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="page_title" data-required="1" value="<?php echo $page['page_title']; ?>" class="span6 m-wrap"/>
                                    </div>
                                </div>
                               
                                <div class="control-group">
                                    <label class="control-label">Page Content</label>
                                    <div class="controls">
                                        <textarea class="span12 ckeditor m-wrap" name="page_data" rows="6"><?php echo $page['page_data']; ?></textarea>
                                    </div>
                                </div>
                                 
                                <div class="control-group">
                                    <label class="control-label">Activate</label>
                                    <div class="controls">
                                        <input type="radio" name="activate" <?php if($page['status']== '1'){echo 'checked="checked"';}; ?> data-required="1" value="1"  class="span6 m-wrap"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">De-activate</label>
                                    <div class="controls">
                                        <input type="radio" name="activate" <?php if($page['status']== '0'){echo 'checked="checked"';}; ?> data-required="1" value="0"  class="span6 m-wrap"/>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="page_id" value="<?php echo $page['page_id']; ?>"/>
                                    <button type="submit" class="btn green">Submit</button>
                                    <button type="button" class="btn" type="cancel" onclick="window.location = '<?php echo base_url() ?>admin/pages'">Cancel</button>

                                </div>
                            </form>



                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>
        </div></div></div>

<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS -->    
<!-- Load javascripts at bottom, this will reduce page load time -->
<?php
$this->load->view('admin/admin_footer');
?>