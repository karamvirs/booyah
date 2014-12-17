<?php 
$this->load->view('header'); 

?>

<!-------banner starts here------>

<!-------banner ends here------>

<!-------content starts here------>
<div class="content">
      <div class="wrapper">
			<div class="leftpanel">                    
				<div class="upgrade">                    
					<a href="<?php echo base_url('/upgrade');?>"><h1 class=="title">Upgrade To Pro Account</h1></a>
				</div>
            </div>
			<div class="rightpanel">
			<div id="logins">
                <?php if ($this->session->flashdata('message')) { ?>
                    <div class="notification"><?php echo $this->session->flashdata('message'); ?></div>
                <?php } ?>
                <span id="after_reg"></span>
                <h1 class="forgot_title">Login</h1>
                <form action="<?php echo base_url('login/login_check'); ?>" id="login1" name="login1" method="post" class="login_form">
                    <span>
                        <label>Email</label>
                        <input type="text" placeholder="Email" class="" required id="email" name="email"/>
                    </span>
                    <span>
                        <label>Password</label>
                        <input type="password" placeholder="Password" required class="" id="password" name="password"/>
                    </span>
                    <span class="left fo    rgotp">
                        <a id="forgot-btn" href="javascript:;">Forgot Password</a>
                        <!--br>
                            Don't have an account yet? 
                            <a id="register-btn" href="javascript:;">Create an account</a-->
                    </span>
                    <span class="right">
                        <input type="submit" id="sub" name="sub" value="Login"/>
                    </span>
                </form>

            </div>

            <div id="forgotpassword" style="display:none;">
                <h1 class="forgot_title">Forgot Password</h1>
                <form action="#" style="" id="fgt_pswd_form" method="POST" name="fgt_pswd_form" class="login_form">

                    <span>
                        <label>Email</label>
                        <input type="text" placeholder="Email" class="" id="fgt_email" name="fgt_email"/>

                    </span>
                    <span id="fgt_message"></span>  
                    <span id="buttons" class="right">
                        <input type="submit" id="check_fgt_email" value="Submit" class="btn green" name="submit"/>
                        <input type="button" id="cancel_btn" value="Cancel" class="btn green" name="cancel"/>

                    </span>

                </form>
            </div>

            <div id="register" style="display:none;">
                <h1 class="forgot_title">Signin</h1>
                <form action="#" style="" id="register_form" method="POST" name="register_form" class="login_form">

                    <span>
                        <label>Name</label>
                        <input type="text" placeholder="Name" class="required" id="name" name="name" required/>
                    </span>
                    <span>
                        <label>Email</label>
                        <input type="text" placeholder="Email" class="required email" id="reg_email" name="reg_email"/>
                    </span>
                    <span>
                        <label>Password</label>
                        <input type="password" placeholder="Password" class="required" id="reg_password" name="reg_password" />
                    </span>
                    <span>
                        <label>Re-Password</label>
                        <input type="password" placeholder="Re-Password" class="required" id="re_password" name="re_password"/>
                    </span>

                    <span id="buttons" class="right">
                        <input type="submit" id="check_email" value="Submit" class="btn green" name="submit"/>
                        <input type="button" id="cancel_btn_sigin" value="Cancel" class="btn green" name="cancel"/>
                    </span>

                </form>
                <span id="error_msg"></span>
            </div>

            <div style="display:none;" id="recovery_div">
                <form class="form-vertical password_recovery" id="password_recovery" method="post" action="<?php echo base_url(); ?>admin/login/password_recovery">

                    <h1 class="forgot_title">Confirm Code?</h1>

                    <p>Check your email to get the confirmation code.</p>

                    <div class="control-group">
                        <div class="controls">
                            <div class="input-icon left">
                                <i class="icon-envelope"></i>
                                <input class="m-wrap placeholder-no-fix" type="text" placeholder="confirmcode" name="confirmcode" />
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="back-btn1" class="btn">
                            <i class="m-icon-swapleft"></i> Back
                        </button>
                        <button type="submit" class="btn green pull-right">
                            Submit <i class="m-icon-swapright m-icon-white"></i>
                        </button>            
                    </div>
                </form>

            </div>

            <?php /* ?>  <div style="display:none;" id="activations">
              <h1 class="forgot_title">Please Verify Your Email</h1>
              <form action="<?php echo base_url(); ?>login/activation" id="activation" class="login_form" method="POST" name="activation">
              <span>
              <label>Enter Activation Code</label>
              <input type="text" id="activeform" class="required" name="act"/>
              <span id="error_message1"></span>
              </span>
              <!--[<a title="This code is related with activation your profile."  href="#">?</a>]
              <span id="linkconfirm"></span>
              <span> <span style="color: #19B2EB;   cursor: pointer;  text-decoration: underline;" class ="resend_activation" >Resend activation code</span>&nbsp;[<a title="A 5 digit activation code has been sent to your email. Please copy and paste into this box." id="tool1" href="#">?</a>]</span-->

              <span id="buttons" class="right">
              <input type="button" onClick="return activation_fun()" value="activate" class="btn green"  name="sub"/>
              </span>
              </form>

              </div>
              <?php ** */ ?> 
			</div>
			
		  
            
            
      </div>
</div>
<!-------content ends here------>
<!-------footer starts here------>


<!-------footer ends here------>
</body>
</html>
  <?php $this->load->view('footer');  ?>
 
