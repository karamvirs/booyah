<?php
$this->load->view('admin/admin_header');
//echo "<pre>";
//print_r($this->session->all_userdata()); 
?>
<link href="<?php echo base_url(); ?>templates/admin/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<style>
    .center { text-align:center!important }
    .bigfont {  font-size: 14px; font-weight: bold; padding: 5px; }
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
                        All Delivery Zone
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/add_delivery">Delivery Zone</a>
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
                            <h4><i class="icon-globe"></i>All Delivery Zone</h4>
                            <div class="tools">
                                <a href="javascript:;" class="reload"></a>
                            </div>
                        </div> 

<?php
$success = $this->session->flashdata('success');
$failure = $this->session->flashdata('failure');
if ($success) {
    ?>	
                            <div class="alert alert-success show">
                                <?php echo $success; ?>
                            </div>
                        <?php }
                        if ($failure) {
                            ?>
                            <div class="alert alert-error show">
                                <?php echo $failure; ?>                              
                            </div>
                        <?php } ?>
                        <div class="portlet-body">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a  href="<?php echo base_url(); ?>admin/add_delivery">
                                        <button id="sample_editable_1_new" class="btn green">
                                            Add New <i class="icon-plus"></i>
                                        </button>
                                    </a>
                                </div>

                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                        <th class="hidden-480">Location</th>
                                        <th class="hidden-480">Postcode</th>											
                                        <th class="hidden-480">Map</th>
                                        <th class="hidden-480">Letter Boxes</th>
                                        <th class="hidden-480">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($all_deliveryzone as $deliveryzone) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                            <td class="center"><?php echo $deliveryzone['location_name'] ?></td>
                                            <td class="center"><?php echo $deliveryzone['post_code'] ?></td>
                                            <td class="center"><?php echo $deliveryzone['map'] ?></td>
                                            <td class="center"><?php echo $deliveryzone['letter_boxes'] ?></td>
                                            <th class="hidden-480"><a href="<?php echo base_url(); ?>admin/deliveryzone/edit_zone/<?php echo $deliveryzone['delivery_zone_id'] ?>"> Edit </a>| <a href="<?php echo base_url(); ?>admin/deliveryzone/delete_zone/<?php echo $deliveryzone['delivery_zone_id'] ?>"> Delete </a></th>

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
