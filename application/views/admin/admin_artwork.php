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
                        All Artworks
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/artwork"">Artworks</a>
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
                            <h4><i class="icon-globe"></i>All Art Works</h4>
                            <div class="tools">
                                <a href="javascript:;" class="reload"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a  href="<?php echo base_url(); ?>admin/artwork/add_artwork">
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

                                        <th class="hidden-480">Name</th>
                                        <th class="hidden-480">MediaTypes</th>
                                        <th class="hidden-480">Categories</th>
                                        <th class="hidden-480">Front Image</th>									
                                        <th class="hidden-480">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($art as $artwork) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                            <td class="center"><?php echo $artwork['name'] ?></td>
                                            <td class="center">		

                                                <?php
                                                if ($artwork['media_id']) {
                                                    $media_ids = json_decode($artwork['media_id']);												
                                                    foreach ($media_ids as $media_id) {
                                                     
														$medianame_temp = $this->art_work->media_name($media_id);
														if($medianame_temp){ ?>
															<span class="label label-success bigfont">
															<?php echo $medianame_temp[0]->name; ?>	 </span>

                                                    <?php } }  } ?>

                                            </td>
                                            <td class="center">		

                                                <?php
                                                if ($artwork['cat_id']) {
                                                    $category_ids = json_decode($artwork['cat_id']);
                                                    foreach ($category_ids as $category_id) {
                                                        ?> 
                                                        <span class="label label-warning bigfont">
                                                            <?php
                                                            $temp = mysql_result(mysql_query("select cat_name from artwork_categories where cat_id = $category_id"), 0);
															if($temp) 
															{ echo $temp; }
                                                            ?>
                                                        </span>
														<?php }
													} ?></td>

                                            <td class="hidden-480">
                                                <a href="<?php echo base_url('templates/artwork_images') . '/' . $artwork['front_image']; ?>" title="Photo" data-rel="fancybox-button" class="fancybox-button">
                                                    <div class="zoom">
                                                        <img alt="Photo" style="height: 100px;width: 150px" src="<?php echo base_url('templates/artwork_images') . '/' . $artwork['front_image']; ?>">							

                                                    </div>
                                                </a>
                                            </td>

                                           <!-- <td class="hidden-480">
                                                <a href="<!?php echo base_url('templates/artwork_images') . '/' . $artwork['back_image']; ?>" title="Photo" data-rel="fancybox-button" class="fancybox-button">
                                                    <div class="zoom">
                                                        <img alt="Photo" style="height:100px;" src="<!?php echo base_url('templates/artwork_images') . '/' . $artwork['back_image']; ?>">							

                                                    </div>
                                                </a>
                                            </td>  -->

                                            <!--td class="hidden-480">
                                            <!--?php 
                                            if($artwork['deals_images']!= "null") {
                                            $img=json_decode($artwork['deals_images']);
                                            $count=intval(count($img));
                                            
                                            foreach($img as $images) {
                                            ?>
                                            
                                                    <a href="<!--?php echo base_url('templates/artwork_images').'/'.$images;?>" title="Photo" data-rel="fancybox-button" class="fancybox-button">
                                                    <div class="zoom" style="width:47%; margin:2px;height:80px; float:left;">
                                                            <img alt="Photo" style="width:100%;height:80px;" src="<!--?php echo base_url('templates/artwork_images').'/'.$images;?>">							
                                                            
                                                    </div>
                                            </a>
                                            
                                            <!--?php } } ?>
                                            </td--> 
                                            <th class="hidden-480">				
											<a href="<?php echo base_url(); ?>admin/artwork/edit_artwork/<?php echo $artwork['artwork_id'] ?>">Edit</a>  
											| 										
											<a onClick="return confirm('Do you want to delete the artwork?');" href="<?php echo base_url(); ?>admin/artwork/delete/<?php echo $artwork['artwork_id'] ?>">Delete</a></th>

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
