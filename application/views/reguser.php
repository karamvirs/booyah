<?php 
$this->load->view('header'); 
//$user_id = $this->session->userdata('booyah_user_id'); 
?>

<div class="content">
		<div class="wrapper">

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
							
                         
                            
                            
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a class="btn green" href="<?php echo base_url('reguser/addgif'); ?>">
                                       Upload Gif<i class="icon-listing"></i></a>										
                                </div>
                                <div class="btn-group">
                                    <a class="btn green" href="<?php echo base_url('login/logout'); ?>">
                                       Logout <i class="icon-listing"></i></a>										
                                </div>
                               
                            </div>
                            <?php if(!empty($usersgif)){?>
							
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th class="hidden-480">Sr No</th>
                                        <th class="hidden-480">Gif Url</th>
                                        <th class="hidden-480">Tag</th>
                                        <th class="hidden-480">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i=1;
                                       foreach ($usersgif as $data) { 
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['gifurl']; ?></td>   
                                            <td class="center hidden-480"><?php echo $data['tag']; ?></td>
                                            <th class="hidden-480">		
											<a onClick="return confirm('Do you want to delete the Gif?');" href="<?php echo base_url('reguser/deletegif/')."/".$data['id'] ?>">Delete</a></th>

                                        </tr>
								    <?php $i++; } ?>


                                </tbody>
                            </table>
                           <?php }?>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
		</div>
<!-------content ends here------>
<!-------footer starts here------>
<?php $this->load->view('footer');  ?>
<!-------footer ends here------>


 
