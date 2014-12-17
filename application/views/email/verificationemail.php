<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Deatil Message</title>
    </head>
    <style>
        img{border:none;}
    </style>
    <body>
		
        <div style="width:700px; height:auto; margin:auto;">
            <div style="width:696px; height:auto; float:left; border:1px solid #292929; padding:2px;">
                <div style="width:686px; height:auto; float:left; background:#000; padding:5px 0 5px 10px; border-bottom: 1px solid #FFFFFF;"><img src="<?php echo base_url(); ?>'css/img/logo.png" alt="#" /></div>
                <div style="width:690px; height:auto; float:left; background-color:#000000;">
                    <div style="width:676px; height:auto; float:left; margin:0; padding:10px; background:#000; ">
                        <h3 style="color:#FFFFFF; font-family:Verdana, Geneva, sans-serif;font-size: 27px;font-weight: bolder;text-decoration: none; margin:0; padding:0;"> Dear <?php echo $name; ?></h3>
                        <p style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff!important; text-align:justify; margin:10px 0 0 0; padding:0; line-height:20px;">Spotonmedia needs to verify your Account email address.<br /> 
                            				
                        <p style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff !important; text-align:justify; margin:10px 0 0 0; padding:0; line-height:20px;">Your login cridentials are: <br/>
                            Email Id :<?php echo $email; ?><br/>Password :XXXXXXXXXXX<?php echo substr($password, -4); ?></p>

                        <p style="color:#ccc !important;">You can follow this link for activation  
                            <a style='color:#fff ! important;padding:3px;' href='<?php echo $activation_link; ?>'>Click here to activate</a>.Use above activation code for activation.   
                            <em>Do not reply to this message. This e-mail message has been sent from an unmonitored e-mail address. We are unable to respond to any replies sent to this e-mail address. </em>
                        </p>  
                    </div>

                </div>   
            </div> 
        </div>
    </body>
</html>