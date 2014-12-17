<html>

<head>

<title>Email</title>

</head>

<body style="font-family:arial; color:#595959;">

<div style="width:700px; margin:0 auto;border-top: 0px solid #595959;">

	<div style="float:left; width:100%; border-bottom:1px solid #595959;padding: 10px 0;">

		<div style="float:left; margin-left: 30px;"> <a href="<?php echo site_url();?>"> <img src="<?php echo return_theme_path(); ?>images/logo.png"> </a> </div>	
        
        <div style="float:right; margin:70px 0 0 0;">VERIFY THIS EMAIL ADDRESS</div>	

	</div>

	<div style="float:left; padding: 0 15px;line-height: 28px;">

		<p>Hi <?php echo $name; ?>,</p>
		

		<p>Welcome to <a href="<?php echo site_url();?>">REALFANTASYWRESTLING.COM</a>, a revolutionary and interactive online fantasy wrestling site on the planet! You are one step away to join and complete your registration by confirming and verifying your e-mail address with us by following this link:<br /><br />
       <a href="<?php echo site_url().'registration/verify/'.$code; ?>"><?php echo site_url().'registration/verify/'.$code; ?></a>
        </p>
		
        <p>(If you have trouble clicking on this link, please copy and paste the entire link into your web browser.)</p>
        
        <p><a href="<?php echo site_url();?>" style="font-weight:bold; text-decoration:none;">How To Play? </a></p>
        <p><b>Questions or Comments?</b><br>
If you still have questions about our website, don't hesitate to contact our support by writing us at: <a href="mailto:support@realfantasywrestling.com" style="font-weight:bold"> support@realfantasywrestling.com </a></p>


		<p>Sincerely,<br/>

		REALFANTASYWRESTLING.COM </p>
        
	

	</div>
    
    <div style="text-align:center">COPYRIGHT &copy; 2013 RFW PARTNERS, LLC <br>All Rights Reserved. <br> <a href="<?php echo site_url('home/terms_conditions');?>" target="_blank"> Terms of Service</a> | <a href="<?php echo site_url('home/privacy_policy');?>" target="_blank">Privacy Policy</a>
</div>



<div style="clear:both;"></div>

</div>

<div style="clear:both;"></div>

</body>

</html>