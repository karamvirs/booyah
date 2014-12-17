<html>

<head>

<title>Email</title>



</head>

<body style="font-family:arial; color:#595959;">

<div style="width:700px; margin:0 auto;border-top: 0px solid #595959;">

	<div style="float:left; width:100%; border-bottom:1px solid #595959;padding: 10px 0;">

		<div style="float:left; margin-left: 30px;"> <a href="<?php echo site_url();?>"> <img src="<?php echo return_theme_path(); ?>images/logo.png"> </a> </div>		

	</div>

	<div style="float:left; padding: 0 15px;line-height: 28px;">

		<p>Hello <?php echo $user_data['user_name']; ?>,</p>
		

		<p>This email is regarding your withdraw request is declined by admin.</p>

		

		<p>The Real Fantasy Wrestling.</p>

	</div>

	<div style="float:left; width:100%;border-top:1px solid #595959;font-size:17px;  padding: 10px 0;">


		<div style="float:right;margin-right: 10px;">© <?php echo date("Y-m-d");?> Real Fantasy Wrestling.. All rights reserved</div>



	</div>

<div style="clear:both;"></div>

</div>

<div style="clear:both;"></div>

</body>

</html>