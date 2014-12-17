<?php
$this->load->view('admin/admin_header');
//echo "<pre>";print_r($zone);echo "</pre>";
?>
<style>
    .order_anchor.fancybox-button {
        float: left !important;
        width: 50% !important;
    }
    .zoom > span {
        float: left;
        text-align: center;
        width: 100%;
    }
    .gen_table .order_anchor.fancybox-button {
        display: table;
        float: none !important;
        margin: 0 auto;
        width: auto;
    }
    .gen_table td:first-child, .gen_table th:first-child, .raws_table th:first-child, .raws_table td:first-child {
        border-right: 1px solid #DDDDDD;
        width: 500px;
    }
    .gen_table th, .gen_table td, .raws_table th, .raws_table td {
        padding: 0 10px;
    }
</style>
<link href="<?php echo base_url(); ?>templates/admin/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
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
                        View Order
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/">View Order</a>
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
                            <h4><i class="icon-reorder"></i>View order</h4>

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

                            <div class="control-group">
                                <label class="control-label">Genrated Product</label>



                                <table width="100%" class="gen_table">

                                    <tbody>
                                        <tr>
                                            <th>Genrated Front</th>
                                            <th>Genrated Back</th>
                                        </tr>
                                        <tr class="odd gradeX">

                                            <?php
                                            if (!empty($view_order['final_product'])) {
                                                $final_product = json_decode($view_order['final_product']);
                                                ?>
                                                <td class="center">
                                                    <a href="<?php echo $final_product->front_complete; ?>" title="Photo" data-rel="fancybox-button" class="order_anchor fancybox-button">
                                                        <div class="zoom" style="float: left; height: 175px; margin: 2px; width: 99%;">
                                                            <img alt="Photo" style="width: 100%;height:100%;" src="<?php echo $final_product->front_complete; ?>">							
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="center">
                                                    <a href="<?php echo $final_product->back_complete; ?>" title="Photo" data-rel="fancybox-button" class="fancybox-button order_anchor">
                                                        <div class="zoom" style="float: left;height: 175px;margin: 2px;width: 99%;">
                                                            <img alt="Photo" style="width: 100%;height:100%;" src="<?php echo $final_product->back_complete; ?>">							
                                                        </div>
                                                    </a>
                                                </td>

                                                <?php
                                            }
                                            ?>


                                        </tr>

                                    </tbody>
                                </table>


                                <table class="raws_table">

                                    <tbody>
                                        <tr>
                                            <th>Front Images used</th>
                                            <th>Back Images used</th>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td class="center">

                                                <?php
                                                if (!empty($view_order['raw_product'])) {
                                                    $front_all = array();
                                                    $raw_products = json_decode($view_order['raw_product']);
                                                    if (!empty($raw_products->front_all)) {
                                                        $front_all = explode(',', $raw_products->front_all);
                                                        foreach ($front_all as $key => $front) {
                                                            ?>

                                                            <a href="<?php echo $front; ?>" title="Photo" data-rel="fancybox-button" class="order_anchor fancybox-button">
                                                                <div class="zoom" style="float: left; height: 175px; margin: 2px; width: 99%;">
                                                                    <img alt="Photo" style="width: 100%;height:100%;" src="<?php echo $front; ?>">							
                                                                </div>
                                                            </a>


                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>

                                            </td>
                                            <td class="center">

                                                <?php
                                                if (!empty($view_order['raw_product'])) {
                                                    $back_all = array();
                                                    $raw_products = json_decode($view_order['raw_product']);
                                                    if (!empty($raw_products->back_all)) {
                                                        $back_all = explode(',', $raw_products->back_all);
                                                        foreach ($back_all as $key => $back) {
                                                            ?>

                                                            <a href="<?php echo $back; ?>" title="Photo" data-rel="fancybox-button" class="order_anchor fancybox-button">
                                                                <div class="zoom" style="float: left; height: 175px; margin: 2px; width: 99%;">
                                                                    <img alt="Photo" style="width: 100%;height:100%;" src="<?php echo $back; ?>">							
                                                                </div>
                                                            </a>


                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>






                            </div>



                            <div class="control-group">
                                <label class="control-label">Delivery Zone</label>
                                <div class="controls">
                                    <input type="text" name="quantity" disabled="disabled" data-required="1" value="<?php echo $view_order['delivery_zone']; ?>"  class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Pricepack</label>
                                <div class="controls">
                                    <input type="text" name="price" disabled="disabled" data-required="1" value="<?php echo $view_order['pricepack'] ?>"  class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">User</label>
                                <div class="controls">
                                    <input type="text" name="price" disabled="disabled" data-required="1" value="<?php echo $view_order['uname'] ?>"  class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Transaction Id</label>
                                <div class="controls">
                                    <input type="text" name="price" disabled="disabled" data-required="1" value="<?php echo $view_order['transaction_id']; ?>"  class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="text" name="price" disabled="disabled" data-required="1" value="<?php echo $view_order['email']; ?>"  class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address</label>
                                <div class="controls">
                                    <input type="text" name="price" disabled="disabled" data-required="1" value="<?php echo $view_order['address1'] . " " . $view_order['address2'] . " " . $view_order['city'] . " " . $view_order['province'] . " " . $view_order['zip'] . " " . $view_order['country']; ?>"  class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Date</label>
                                <div class="controls">
                                    <input type="text" name="price" disabled="disabled" data-required="1" value="<?php echo $view_order['created_at']; ?>"  class="span6 m-wrap"/>
                                </div>
                            </div>



                            <div class="form-actions">
                                <button type="button" class="btn" type="cancel" onclick="window.location = '<?php echo base_url() ?>admin/orders'">Back</button>

                            </div>




                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>
        </div></div></div>
<?php
$this->load->view('admin/admin_footer_new');
//echo "<pre>";print_r($zone);echo "</pre>";
?>