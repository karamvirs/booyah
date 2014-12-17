<?php 
$this->load->view('header'); 
//$user_id = $this->session->userdata('booyah_user_id'); 
?>
<script>/*
$(function(){
	$('#showupload').click(function(){
		$('.form2').hide('slow');
		$('.form1').show('slow');
	});
	$('#hideupload').click(function(){  
		$('.form1').hide('slow');
		$('.form2').show('slow');
	});
});*/
</script>
<!-------banner starts here------>

<!-------banner ends here------>

<!-------content starts here------>
<div class="content">
		<div class="wrapper">

		 <div class="row-fluid background">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box light-grey">
                        <div class="portlet-title">
                           <!-- <h4><i class="icon-globe"></i>Search Reddit</h4>-->
                            <div class="tools">

                                <a href="javascript:;" class="reload"></a>

                            </div>
                        </div>
                        <div class="portlet-body form1">
							<?php echo $this->session->flashdata('message');?>
                            <form action="<?php echo base_url();?>prouser/uploadgif" accept-charset="utf-8" enctype="multipart/form-data" 
                            class="form-horizontal" id="add_user" method="post" novalidate="novalidate">                  
                                    <div class="row-fluid">
                                       <div class="span10	">
                                          <div class="control-group">
                                             <label class="control-label">Title</label>
                                             <div class="controls">
                                                <input type="text" class="m-wrap span8" name="title" placeholder="Enter title for Gif" value="">                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row-fluid">
                                       <div class="span10	">
                                          <div class="control-group">
                                             <label class="control-label">Link</label>
                                             <div class="controls">
                                                <input type="text" class="m-wrap span8" name="link" placeholder="Enter link" value="">                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row-fluid">
                                       <div class="span10	">
                                          <div class="control-group">
                                             <label class="control-label">Tags</label>
                                             <div class="controls">
                                                <input type="text" class="m-wrap span8" name="tags" placeholder="Enter Tags for the gifs like #tag1, #tag2" value="">                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>                                    
                                    <hr>
                                    <div class="row-fluid">
                                       <div class="span10	">
                                          <div class="control-group">
                                             <label class="control-label">Browse Gif</label>
                                             <div class="controls">
                                                <input type="file" class="m-wrap span8" name="giffile" placeholder="Enter Gif url" value="">                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>
									<div class="row-fluid">
                                       <div class="span8 subcenter">
                                          OR
                                       </div>
                                    </div>
                                    <div class="row-fluid">
                                       <div class="span10">
                                          <div class="control-group">
                                             <label class="control-label">Enter Gif URL</label>
                                             <div class="controls">
                                                <input type="text" class="m-wrap span8" name="gifurl" placeholder="Enter Gif url" value="">                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row-fluid">
										<div class="subcenter">
											<input type="submit" class="btn blue" name="submit" value="Save">			
											<!--a href="javascript:;" id="hideupload" > Or Enter Gif Url</a-->		
										</div>
                                    </div>
                              </form>	
                         
                        </div>
                          <!--div class="portlet-body form2" style="display:none;">
                            <form action="<?php echo base_url();?>prouser/addgif" accept-charset="utf-8" class="form-horizontal" id="add_user" method="post" novalidate="novalidate">                  
                                    <div class="row-fluid">
                                       <div class="span10	">
                                          <div class="control-group">
                                             <label class="control-label">Enter Gif URL</label>
                                             <div class="controls">
                                                <input type="text" class="m-wrap span12" name="gifurl" placeholder="Enter Gif url" value="">                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                      <div class="row-fluid">
                                       <div class="span10	">
                                          <div class="control-group">
                                             <label class="control-label">Tags</label>
                                             <div class="controls">
                                                <input type="text" class="m-wrap span12" name="tags" placeholder="Enter Tags for the gifs like #tag1, #tag2" value="">                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>
									
									<div class="row-fluid">
										<div class="subcenter">
											<input type="submit" class="btn blue" name="submit" value="Save">																			
											<a href="javascript:;" id="showupload" > Or Upload Gif from your folder</a>										
										</div>
                                    </div>
                              </form>	
                         
                        </div-->
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
		</div>
<!-------content ends here------>
<!-------footer starts here------>
<?php $this->load->view('footer');  ?>
<!-------footer ends here------>
