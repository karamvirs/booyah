<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Spotonmedia Support</title>
    </head>

    <body style="margin:0; padding:0;">

        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#f6f6f6">
            <tr>
                <td align="center">

                    <table width="700" border="0" cellspacing="0" cellpadding="0" style="background:#ffffff; min-height: 400px; margin: 10px auto; font-family:'Lucida Sans','Lucida Sans Unicode','Lucida Grande', Arial; color: #666666; font-size: 12px;">
                        <tr>
                            <td style=" border-bottom:1px solid #595959;" align="center">
                                <table width="93%" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:'Lucida Sans','Lucida Sans Unicode','Lucida Grande', Arial; color: #666666; font-size: 12px;">
                                    <tr>
                                        <td align="left" valign="middle"><a href="<?php echo base_url(); ?>" title="spotonmedia"><img src="<?php echo base_url(); ?>templates/frontend/images/logo.png" alt="SpotOnMedia" border="0" /></a></td>
                                        <td align="right" valign="middle">
                                            <span style="color:#999999;">Confirmation Email</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 30px 25px;" align="left">
                                <strong>Hello  <?php echo $name; ?></strong>,<br><br>

                                Thanks For using Spotonmedia.
                                <br /><br />

                                Your transaction id is <?php echo $txn_id;?> <br><br>
                                Amount <?php echo $amount;?> <br><br>
                                Front Flyer: <?php echo $front_complete;?> <br><br>
                                Back Flyer:<?php echo $back_complete;?> <br><br>
                                
                             



                                <div style="float:left; width:100%;border-top:1px solid #595959;font-size:17px;  padding: 10px 0;"></div>
                                    


                                    <div style="text-align:center">COPYRIGHT &copy; 2014 Spotonmedia<br>All Rights Reserved. 
                                    </div>

                            </td>
                        </tr>

                    </table>



                </td>
            </tr>
        </table>


    </body>
</html>
