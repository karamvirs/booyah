
<html>

<head>

<title>Deposit By Paypal</title>



</head>

<body style="font-family:arial; color:#595959;">

<div style="width:700px; margin:0 auto;border-top: 0px solid #595959;">

	<div style="float:left; width:100%; border-bottom:1px solid #595959;padding: 10px 0;">

		<div style="float:left; margin-left: 30px;"> <a href="<?php echo site_url();?>"> <img src="<?php echo return_theme_path(); ?>images/logo.png"> </a> </div>		
		
        <div style="float:right; margin:70px 0 0 0;">Deposit By Paypal</div>
	</div>

	<div style="float:left; padding: 0 15px;line-height: 28px;">

		<p>Hi <?php echo $user_data['user_name']; ?>,Your email is <?php echo $user_data['email']; ?>.</p>
		<p>You have successfully deposited $<?php echo $amt;?> by paypal on Real Fantasy Wrestling.</p>
		<p>Your transaction is successfully processed on Paypal with Unique Transaction ID #<?php echo $transaction_id; ?></p>
		<!--<p>Your Transaction sucessfully occured at paypal.Your Transaction id is <?php echo $transaction_id; ?>.You request for amount $ <?php echo $amt;?>.</p>
		
		<p>Your Transaction successfully occured at paypal!</p>-->
		
        <p><a href="<?php echo site_url();?>" style="font-weight:bold; text-decoration:none;">How To Play? </a>
        <p><b>Questions or Comments?</b><br>
If you still have questions about our website, don't hesitate to contact our support by writing us at: <a href="mailto:support@realfantasywrestling.com" style="font-weight:bold"> support@realfantasywrestling.com </a></p>


		<p>Sincerely,<br/>

		REALFANTASYWRESTLING.COM </p>

	</div>

	<div style="float:left; width:100%;border-top:1px solid #595959;font-size:17px;  padding: 10px 0;">

		<!--<div style="float:left;margin-left: 15px;">We are here to help! <a style="color:#000080; text-decoration:none;" href="<?php //echo site_url('home/contact');?>">Contact us.</a></div>-->

		<div style="text-align:center">COPYRIGHT &copy; 2013 RFW PARTNERS, LLC <br>All Rights Reserved. <br> <a href="<?php echo site_url('home/terms_conditions');?>" target="_blank"> Terms of Service</a> | <a href="<?php echo site_url('home/privacy_policy');?>" target="_blank">Privacy Policy</a>
</div>



	</div>

<div style="clear:both;"></div>

</div>

<div style="clear:both;"></div>

</body>

</html>