<?php $this->load->view('admin/admin_header'); ?>
<link href="<?php echo base_url(); ?>templates/admin/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<style>
    .center { 
        text-align:center !important;
    }
	
</style>
<div class="page-container row-fluid">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('admin/admin_sidebar'); ?>
    <!-- END SIDEBAR -->
    <!-- BEGIN PAGE -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">

                    <h3 class="page-title">
                        All Media Types
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/mediatype"">Media Types</a>
                            <i class="icon-angle-right"></i>
                        </li>

                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box light-grey">
                        <div class="portlet-title">
                            <h4><i class="icon-globe"></i>All Media Types</h4>
                            <div class="tools">

                                <a href="javascript:;" class="reload"></a>

                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a class="btn green" href="<?php echo base_url('admin/add_mediatype') ?>">
                                        Add New <i class="icon-plus"></i></a>
										
                                </div>
                                <!-- <div class="btn-group pull-right">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                                <li><a href="#">Print</a></li>
                                                <li><a href="#">Save as PDF</a></li>
                                                <li><a href="#">Export to Excel</a></li>
                                        </ul>
                                </div> -->
                            </div>
							
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                        <th>Name</th>
                                        <th class="hidden-480">Width</th>
                                        <th class="hidden-480">Height</th>
                                        <th class="hidden-480">Allow deals</th>
                                        <th class="hidden-480">Custom Image</th>
                                        <th class="hidden-480">Allow text input</th>
                                        <th class="hidden-480">Image</th>
                                        <th class="hidden-480">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($media_data as $allmediatype) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                            <td><?php echo $allmediatype['name'] ?></td>
                                            <td class="center hidden-480"><?php echo $allmediatype['width'] ?></td>
                                            <td class="center hidden-480"><?php echo $allmediatype['height'] ?></td>
                                            <td class="center hidden-480"><?php echo $allmediatype['allow_deals'] ?></td>
                                            <td class="center hidden-480"><?php echo $allmediatype['custom_image'] ?></td>
                                            <td class="center hidden-480"><?php echo $allmediatype['allow_text_input'] ?></span></td>
                                            <td class="hidden-480" >
                                                <a href="<?php echo base_url('templates/mediatype_images') . '/' . $allmediatype['image'] ?>" title="Photo" data-rel="fancybox-button" class="fancybox-button">
                                                    <div class="zoom">
                                                        <img alt="Photo" style="width:100px" src="<?php echo base_url('templates/mediatype_images') . '/' . $allmediatype['image'] ?>">							

                                                    </div>
                                                </a>

                                            </td>
                                            <td class="hidden-480"><a href="<?php echo base_url(); ?>admin/edit_mediatype?id=<?php echo $allmediatype['media_id'] ?>">Edit </a> | 
											<a onClick="return confirm('Do you want to delete the mediatype?');" href="<?php echo base_url(); ?>admin/mediatype/delete/<?php echo $allmediatype['media_id'] ?>">Delete</a></td>

                                        </tr>
										<?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
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
<script src="<?php echo base_url(); ?>templates/admin/js/jquery.blockui.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/jquery.cookie.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>templates/admin/js/excanvas.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/respond.js"></script>
<![endif]-->	
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/app.js"></script>		
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.setPage("table_managed");
        App.init();
    });
</script>

</body>
<!-- END BODY -->
</html>
