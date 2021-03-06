<?php
$this->load->view('admin/admin_header');
?>
<link href="<?php echo base_url(); ?>templates/admin/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<style>
    .center { text-align:center!important }
    .bigfont {  font-size: 14px; font-weight: bold; padding: 5px;text-transform: capitalize; }
</style>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
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
                        All Users
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/users"">Users</a>
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
                            <h4><i class="icon-globe"></i>All Users</h4>
                            <div class="tools">
                                <a href="javascript:;" class="reload"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a  href="<?php echo base_url(); ?>admin/users/add_user">
                                        <button id="sample_editable_1_new" class="btn green">
                                            Add New <i class="icon-plus"></i>
                                        </button>
                                    </a>
                                </div>
                                <!-- <div class="btn-group pull-right">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                                <li><a href="#">Print</a></li>
                                                <li><a href="#">Save as PDF</a></li>
                                                <li><a href="#">Export to Excel</a></li>
                                        </ul>
                                </div>  -->
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>

                                        <th class="hidden-480">User Type</th>
                                        <th class="hidden-480">Name</th>
                                        <th class="hidden-480">Email</th>
                                        <th class="hidden-480">Address</th>
                                        <th class="hidden-480">City</th>
										<th class="hidden-480">Zip</th>
										<th class="hidden-480">Status</th>
                                        <th class="hidden-480">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
								<?php  foreach ($allusers as $alluser) { ?>
                                    
                                        <tr class="odd gradeX">
                                            <td><input type="checkbox" class="checkboxes" value="1" /></td>                                            
                                            <td class="center">	
                                                        <span class="label label-success bigfont">  
														<?php echo $alluser['type'] ?>														
                                                        </span>
                                            </td>
                                            <td class="center"><?php echo $alluser['name'] ?></td>
                                            <td class="hidden-480"> <?php echo $alluser['email'] ?> </td>											
                                            <td class="hidden-480"> <?php echo $alluser['address1'] ?>,<?php echo $alluser['address2'] ?> </td>
											<td class="hidden-480"> <?php echo $alluser['city'] ?>,<?php echo $alluser['province'] ?> </td>
											<td class="hidden-480"> <?php echo $alluser['zip'] ?> </td>
											<td class="hidden-480"> <?php if ($alluser['status']=='1') { ?><span class="label label-warning bigfont">Active</span>
                                           <?php } else { ?><span class="label label-inverse bigfont">Inactive</span><?php } ?>
                                            <th class="hidden-480">		
											<a href="<?php echo base_url(); ?>admin/users/edit/<?php echo $alluser['id'] ?>">Edit</a>  | 									
											<a onClick="return confirm('Do you want to delete the artwork?');" href="<?php echo base_url(); ?>admin/users/delete/<?php echo $alluser['id'] ?>">Delete</a></th>

                                        </tr>
										
										<?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div></div>



    </div></div>
<div class="footer">
    2013 &copy; Admin, spotonmedia.com
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
