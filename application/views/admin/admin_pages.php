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
                        All Pages
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/pages">Pages</a>
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
                            <h4><i class="icon-globe"></i>All Pages</h4>
                            <div class="tools">
                                <a href="javascript:;" class="reload"></a>
                            </div>
                        </div> 

                        
                        <div class="portlet-body">
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
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a  href="<?php echo base_url(); ?>admin/pages/add_page">
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
                                        <th class="hidden-480">Page Name</th>
                                        <th class="hidden-480">Page data</th>											
                                        <th class="hidden-480">Status</th>
                                        <th class="hidden-480">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($pages)) {
                                        foreach ($pages as $page) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                                <td class="center"><?php echo $page['page_title'] ?></td>
                                                <td class="center"><?php echo substr(strip_tags($page['page_data']), '0','200'); ?></td>
                                                <td class="center"><?php if($page['status']== '0'){echo 'De-activated';} else {echo 'Activated';} ?></td>

                                                <th class="hidden-480"><a href="<?php echo base_url(); ?>admin/pages/edit_page/<?php echo $page['page_id']; ?>"> Edit </a>| <a href="<?php echo base_url(); ?>admin/pages/delete_page/<?php echo $page['page_id']; ?>"> Delete </a></th>

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