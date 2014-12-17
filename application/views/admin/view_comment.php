<?php $this->load->view('admin/admin_header'); ?>
<link href="<?php echo base_url(); ?>templates/admin/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>templates/admin/gritter/css/jquery.gritter.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>templates/admin/chosen-bootstrap/chosen/chosen.css" />

<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">  
    <?php $this->load->view('admin/admin_sidebar'); ?>
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row-fluid">
                <div class="span12">              
          <h3 class="page-title">View Comment Gifs</h3>         
          <ul class="breadcrumb">
                        <li><i class="icon-home"></i>
                            <a href="<?php echo base_url(); ?>">Home</a> 
                            <span class="icon-angle-right"></span>
                        </li>
                        <li><a href="<?php echo base_url('admin/comments/addComment'); ?>">Add Comment</a></li> 
                    </ul>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="portlet box green">               
            <div class="portlet-title">               
              <h4><i class="icon-reorder"></i>View </h4>        
            </div>
                        <div class="portlet-body form">             
                                    <div class="row-fluid">
									<div class="span6 valid">
                                          <div class="control-group">
                                             <label class="control-label">Comment Url</label>
                                             <div class="controls">
                                                <input type="text" class="m-wrap span12" placeholder="Enter Content Url" readonly value="<?php if (isset($result['comment_url'])) { echo $result['comment_url']; } ?>" />
                                             </div>
                                          </div>
                                       </div> 
                    
                                    </div>
									<div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label">Tags</label>
                                             <div class="controls">
                                                <textarea  name="comment_tags" placeholder="Enter Post Text" readonly class="m-wrap span12" > <?php if (isset($result['comment_tags'])) { echo $result['comment_tags']; } ?></textarea>
                                             </div>
                                          </div>
                                       </div>                    
                     
                                    </div>
                            
                                   
                                      <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label">Start Time</label>
                                            
                                             <div class="controls date" >
                                                <input type="text" id="start_time" placeholder="Enter Start Time" readonly class="m-wrap span12" value="<?php if (isset($result['starttime'])) { echo $result['starttime']; } ?>"> 
                                             </div>
                                          </div>
                                       </div>
                                       
                                 
                                      
                                       <!--/span-->
                                    </div>
                                     <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                             <label class="control-label">Stop Time</label>
                                             <div class="controls date" >
                                                <input type="text" id="stop_time" placeholder="Enter Stop Time" readonly class="m-wrap span12" value="<?php if (isset($result['stoptime'])) { echo $result['stoptime']; } ?>"> 
                                             </div>
                                          </div>
                                       </div>
                                       <!--/span-->
                                      
                                       <!--/span-->
                                    </div>
            
                        </div>
                    
                     <div class="portlet box light-grey">
                        <div class="portlet-title">
                           <!-- <h4><i class="icon-globe"></i>Search Reddit</h4>-->
                            <div class="tools">

                                <a href="javascript:;" class="reload"></a>

                            </div>
                        </div>
                        <div class="portlet-body">
							
                            <?php  if(!empty($comments)){ //echo "<pre>";print_r($json_object);?>
                            
                            
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a class="btn green" href="javascript:;">
                                        Listing <i class="icon-listing"></i></a>										
                                </div>
                               
                            </div>
                            
							
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        
                                        <th class="hidden-480">URLs</th>
                                        <th class="hidden-480">Author</th>
                                       <th class="hidden-480">Score</th>
                                        <th class="hidden-480">Comment Text</th>
                                        <!--th class="hidden-480">Downs</th-->
                                        <th class="hidden-480">Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($comments as $data) { 
                                        ?>
                                        <tr class="odd gradeX">
                                            
                                            <td class="center hidden-480">
												<strong>Reddit URL:</strong> <?php echo $data->comment_gif."<br />";?>
												<strong>webm URL:</strong> <?php echo $data->webmUrl."<br />";?>
												<strong>mp4 URL:</strong> <?php echo $data->mp4url."<br />";?>
												<strong>gifUrl URL:</strong> <?php echo $data->gifUrl."<br />";?>
												<strong>gfyname URL:</strong> <?php echo $data->gfyname."<br />";?>
                                            
                                            </td>
                                            <td class="center hidden-480"><?php echo $data->author;?></td>
                                            <td class="center hidden-480"><?php echo $data->score;?></td>
                                            <td class="center hidden-480"><?php echo $data->comment_text;?></td>
                                            <!--td class="center hidden-480"><?php echo $data->downs;?></td-->
                                            <td class="center hidden-480"><?php echo $data->created;?></td>
                                           
                                        </tr>
										<?php } ?>


                                </tbody>
                            </table> 
                            <?php }?>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                    <!-- END VALIDATION STATES-->
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

