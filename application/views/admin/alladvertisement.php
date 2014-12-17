<?php $this->load->view('admin/admin_header');
//print_r($advertisement);die;
?>
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
                       Latest GIFs from Reddit
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/fetch_reddit">Search Reddit</a>
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
                           <!-- <h4><i class="icon-globe"></i>Search Reddit</h4>-->
                            <div class="tools">

                                <a href="javascript:;" class="reload"></a>

                            </div>
                        </div>
                        <div class="portlet-body">
							
                            <?php  if(!empty($advertisement)){ //echo "<pre>";print_r($json_object);?>
                            
                            
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a class="btn green" href="javascript:;">
                                        Listing <i class="icon-listing"></i></a>										
                                </div>
                               
                            </div>
                            
							
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="hidden-480">Profile</th>
                                        <th class="hidden-480">Url</th>
                                        <th class="hidden-480">Text</th>
                                        <th class="hidden-480">Keywords</th>
                                        <th class="hidden-480">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($advertisement as $data) { 
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['profile'];?></td>
                                            <td class="center hidden-480"><?php echo $data['url']; ?></td>
                                            <td class="center hidden-480"><?php echo $data['text']; ?></td>
                                            <td class="center hidden-480"><?php echo $data['keywords']; ?></td>
                                            <td class="center hidden-480"><a href="<?php echo base_url();?>admin/advertisements/add_advertisement/<?php echo $data['id']?>">Edit</a> | <a href="<?php echo base_url();?>admin/advertisements/delete_advertisement/<?php echo $data['id']?>">Delete</a></td>
                                          
                                           
                                            
                                        </tr>
										<?php } ?>


                                </tbody>
                            </table>
                            <?php }?>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>



        </div></div></div>
        	
<div class="footer">
    2013 &copy; Booyah
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

