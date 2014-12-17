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
                            <h4><i class="icon-globe"></i>Search Reddit</h4>
                            <div class="tools">

                                <a href="javascript:;" class="reload"></a>

                            </div>
                        </div>
                        <div class="portlet-body">
							<div class="clearfix"><form name="redit_form1" method="POST" action="<?php echo base_url('admin/fetch_reddit/search_reddit') ?>">
                                <div class="btn-group">
                                   
									   <input type="text" placeholder="" name="subreddit" value='<?php if(!empty($subreddit)){ echo $subreddit;}?>' style="margin-bottom:0px;">
									   <input class="btn green"  value="Reddit" type="submit" name='submit'>
									
                                </div>
                               </form>
                            </div>
                            <?php  if(!empty($json_object)){ //echo "<pre>";print_r($json_object);?>
                            
                            
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a class="btn green" href="javascript:;">
                                        Listing <i class="icon-listing"></i></a>										
                                </div>
                               
                            </div>
                            
							
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                        <th>Title</th>
                                        <th class="hidden-480">URL</th>
                                        <th class="hidden-480">Permalink</th>
                                        <th class="hidden-480">Score</th>
                                        <th class="hidden-480">Ups</th>
                                        <th class="hidden-480">Downs</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($json_object->data->children as $data) { 
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                            <td><?php echo $data->data->title;?></td>
                                            <td class="center hidden-480"><?php echo $data->data->url;?></td>
                                            <td class="center hidden-480"><?php echo $data->data->permalink;?></td>
                                            <td class="center hidden-480"><?php echo $data->data->score;?></td>
                                            <td class="center hidden-480"><?php echo $data->data->ups;?></td>
                                            <td class="center hidden-480"><?php echo $data->data->downs;?></td>
                                           
                                            
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

