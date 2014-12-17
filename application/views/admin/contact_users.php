<?php
$this->load->view('admin/admin_header');
//echo "<pre>";
//print_r($this->session->all_userdata()); 
?>
<link href="<?php echo base_url(); ?>templates/admin/fancybox/source/jquery.fancybox.css" rel="stylesheet" />

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
                        All Users contacted
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/contactus">Contact</a>
                            <i class="icon-angle-right"></i>
                        </li>

                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <h4><i class="icon-globe"></i>All contacted users</h4>
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
                            <div class="clearfix">
                                <!--div class="btn-group">
                                    <a  href="<?php echo base_url(); ?>admin/contactus">
                                        <button id="sample_editable_1_new" class="btn green">
                                            Add New <i class="icon-plus"></i>
                                        </button>
                                    </a>
                                </div-->

                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                        <th class="hidden-480">Name</th>
										<th class="hidden-480">Email</th>										
                                        <th class="hidden-480">Message</th>
										<th class="hidden-480">Phone</th>
                                        <th class="hidden-480">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($all_users_contact)) {
                                        foreach ($all_users_contact as $pricepack) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                                <td class="center"><?php echo $pricepack['name'] ?></td>
												<td class="center"><a href="mailto:<?php echo $pricepack['contact_email'] ?>?Subject=Spotonmedia Support" target="_top"><?php echo $pricepack['contact_email']; ?></a></td>
												<td class="center"><?php echo $pricepack['message'] ?></td>                                                
												<td class="center"><?php echo $pricepack['phone'] ?></td>
                                                <th class="hidden-480"><a href="<?php base_url(); ?>/contactus/display/<?php echo $pricepack['contact_id'] ?>">Display</a></th>
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
            </div></div>



    </div></div>
<?php
$this->load->view('admin/admin_footer_new');
//echo "<pre>";print_r($zone);echo "</pre>";
?>