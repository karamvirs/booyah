<html>

<head>

<title>Email</title>



</head>

<body style="font-family:arial; color:#595959;">

<div style="width:700px; margin:0 auto;border-top: 0px solid #595959;">

	<div style="float:left; width:100%; border-bottom:1px solid #595959;padding: 10px 0;">

		<div style="float:left; margin-left: 30px;"> <a href="<?php echo site_url();?>"> <img src="<?php echo return_theme_path(); ?>images/logo.png"> </a> </div>		
		 <div style="float:right; margin:70px 0 0 0;">CONTACT REPLY EMAIL</div>
	</div>

	<div style="float:left; padding: 0 15px;line-height: 28px;">

		<p><?php echo $name; ?>,</p>
		<p><?php echo $query;?></p>
		<p>Reply : <?php echo $message; ?></p>
		

		<p>Sincerely,<br/>
		REALFANTASYWRESTLING.COM </p>

	</div>
	
		<hr />
	<div style="text-align:center">COPYRIGHT &copy; <?PHP echo date('Y');?> RFW PARTNERS, LLC <br>All Rights Reserved. <br> <a href="<?php echo site_url('home/terms_conditions');?>" target="_blank"> Terms of Service</a> | <a href="<?php echo site_url('home/privacy_policy');?>" target="_blank">Privacy Policy</a></div>

<div style="clear:both;"></div>

</div>

<div style="clear:both;"></div>

</body>

</html>