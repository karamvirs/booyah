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
                        Orders
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/">Ordres</a>
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
                            <h4><i class="icon-globe"></i>All orders</h4>
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
                            <?php
                        }
                        if ($failure) {
                            ?>
                            <div class="alert alert-error show">
                                <?php echo $failure; ?>                              
                            </div>
                        <?php } ?>
                        <div class="portlet-body">
                            <!--div class="clearfix">
                                <div class="btn-group">
                                    <a  href="<?php echo base_url(); ?>admin/pricepack/add_pricepack">
                                        <button id="sample_editable_1_new" class="btn green">
                                            Add New <i class="icon-plus"></i>
                                        </button>
                                    </a>
                                </div>

                            </div-->
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                        <th class="hidden-480">Products</th>
                                        <th class="hidden-480">Delivery Zone</th>											
                                        <th class="hidden-480">Pricepack</th>
                                        <th class="hidden-480">User</th>
                                        <th class="hidden-480">status</th>
                                        <th class="hidden-480">Transaction Id</th>
                                        <th class="hidden-480">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($all_orders)) {
//echo "<pre>";print_r($all_orders);die;
                                        foreach ($all_orders as $all_order) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                                <td class="center">
                                                    <?php //echo $all_order['product'] ?>
                                                    <?php
                                                    if (!empty($all_order['final_product'])) {
                                                        $final_product = json_decode($all_order['final_product']);
                                                        $count = intval(count($final_product));

                                                        foreach ($final_product as $images) { 
                                                            ?>

                                                            <a href="<?php echo $images; ?>" title="Photo" data-rel="fancybox-button" class="fancybox-button">
                                                                <div class="zoom" style="width:47%; margin:2px;height:80px; float:left;">
                                                                    <img alt="Photo" style="width:100%;height:80px;" src="<?php echo  $images; ?>">							

                                                                </div>
                                                            </a>

                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </td>
                                                <td class="center"><?php echo $all_order['delivery_zone']; ?></td>
                                                <td class="center"><?php echo $all_order['pricepack'] ?></td>
                                                <td class="center"><?php echo $all_order['name'] ?></td>                                                
                                                <td class="center"><?php echo $all_order['status'] ?></td>
                                                <td class="center"><?php echo $all_order['transaction_id']; ?></td>

                                                <th class="hidden-480"><a href="<?php echo base_url(); ?>admin/orders/view_order/<?php echo $all_order['product_id']; ?>"> View </a>| <a href="<?php echo base_url(); ?>admin/orders/delete_order/<?php echo $all_order['product_id']; ?>"> Delete </a></th>

                                            </tr><?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>



    </div></div>
<?php
$this->load->view('admin/admin_footer_new');
//echo "<pre>";print_r($zone);echo "</pre>";
?>