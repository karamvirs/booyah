<?php 
$this->load->view('header'); 
//$user_id = $this->session->userdata('booyah_user_id'); 
?>

<!-------banner starts here------>

<!-------banner ends here------>

<!-------content starts here------>
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
                      
                        <?php if ($this->session->flashdata('message')) { ?>
							<div class="alert alert-success show"><?php echo $this->session->flashdata('message'); ?></div>
						<?php } ?>
                        
                        <div class="portlet-body">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a class="btn green" href="<?php echo base_url('user'); ?>">
                                       Upload Gif <i class="icon-listing"></i></a>										
                                </div>
                                <div class="btn-group">
                                    <a class="btn green" href="<?php echo base_url('login/logout'); ?>">
                                       Logout <i class="icon-listing"></i></a>										
                                </div>
                               
                            </div>
                            <br>
							<?php if(!empty($usersgif)){?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th class="hidden-480">ID</th>
                                        <th class="hidden-480">Urls</th>
										<?php $user_type = $this->session->userdata('booyah_user_type');
											if($user_type =='pro'){ // this link is for pro user only
										?>
                                        <th class="hidden-480">Linkout</th>
                                        <?php } ?>
                                        <th class="hidden-480">Tags</th>
                                        <th class="hidden-480">Action	</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i=1;
                                       foreach ($usersgif as $data) { 
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td class="center hidden-480">
												<strong>Gif URL:</strong><?php echo $data['gifurl']; ?><br>
												<strong>webm URL:</strong><?php echo $data['webmUrl']; ?><br>
											</td>
											<?php $user_type = $this->session->userdata('booyah_user_type');
												if($user_type =='pro'){ // this link is for pro user only
											?>
												<td class="center hidden-480"><?php echo $data['linkout']; ?></td>
											<?php } ?>
											
                                            <td class="center hidden-480"><?php echo $data['tags']; ?></td>
                                            <th class="hidden-480">		
											<a onClick="return confirm('Do you want to delete the Gif?');" href="<?php echo base_url('user/deletegif/')."/".$data['id'] ?>">Delete</a></th>

                                        </tr>
								    <?php $i++; } ?>


                                </tbody>
                            </table>
                         <?php } ?>
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


 
