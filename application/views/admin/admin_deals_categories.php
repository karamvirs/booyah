<?php 
$this->load->view('admin/admin_header'); 
?>

	<style>
	.center { text-align:center!important; }	#sample_1 thead tr th {text-align:center!important;}	#sample_1 tbody tr td {text-align:center!important;}
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
							All Deals Categories
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>admin/deals_categories">All Deals Categories</a>
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
								<h4><i class="icon-globe"></i>All Deals categories</h4>
								<div class="tools">
									<a href="javascript:;" class="reload"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="clearfix">
									<div class="btn-group">
									<a  href="<?php echo base_url();?>admin/artwork_categories/add_category">
										<button id="sample_editable_1_new" class="btn green">
										Add New <i class="icon-plus"></i>
										</button>
									</a>
									</div>
								
								</div>								<?php if($deals_cat) { ?>
								<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
																					
											<th class="hidden-480">Category Name</th>										
											<th class="hidden-480">Action</th>	
										</tr>
									</thead>
									<tbody>
									<?php foreach($deals_cat as $deals_cat)	{ ?>
										<tr class="odd gradeX">
											<td class="center" title="<?php  echo $deals_cat['cat_id'] ?>"><?php  echo $deals_cat['cat_name'] ?></td>
											<td class="hidden-480">											<a href="<?php echo base_url('admin/deals_categories/edit/').'/'.$deals_cat['cat_id'];?>">Edit</a> | 											<a onClick="return confirm('Do you want to delete the Category?');" href="<?php echo base_url('admin/deals_categories/delete/').'/'.$deals_cat['cat_id'];?>">Delete</a>																						</td>
										</tr>
										<?php }  ?>
										
									</tbody>
								</table>								<?php } else echo "<center>No categories are there.</center>"; ?>
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
