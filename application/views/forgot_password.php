<?php $this->load->view('header'); ?>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
<script>
    function checkPassword() {


        var password = $('#passwords').val();
        var c_password = $('#confirm_password').val();
        //alert(password);
        //alert(c_password);
        if (!password && !c_password) {
            $('#dialog').attr("title", 'Error').html("<p>Please fill both password fields</p>").dialog({
                modal: true,
                buttons: {
                    Ok: function() {
                        $(this).dialog("close");
                    }
                }
            });
            return false;
        }
        if (password != c_password) {
            $('#dialog').attr("title", 'Error').html("<p>Password and Confirm password does not match.</p>").dialog({
                modal: true,
                buttons: {
                    Ok: function() {
                        $(this).dialog("close");
                    }
                }
            });
            return false;
        } else {
            $('#password_div').html('Please wait..').css({'color': 'orange'});
            $.ajax({
                url: "<?php echo base_url(); ?>login/forgotPassword/" + $('#secret').val(),
                data: {password: password, secret: $('#secret').val(), action: 'change_password'},
                type: "POST",
                success: function(data) {
                    if (data == 'true') {
                        // $('#buttons, #passwords, #confirm_password').hide();
                        $('#password_div').html('Your password has been changed successfully.').css({'color': 'green'});
                        window.location='<?php echo base_url('login');?>';
                    } else {
                        $('#password_div').html('Something going wrong, either you have changed your password already or this request has been expried.').css({'color': 'red'});
                    }
                }
            })
        }


    }
</script>
<div class="content">
    <div class="wrapper">
        <div id='dialog'></div>
        <div id="logins" class="fgt_div">
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="notification"><?php echo $this->session->flashdata('message'); ?></div>
            <?php } ?>
            <h1 class="forgot_title">Change your password</h1>
            <form name="forgot_password" method="POST" id="forgot_password"  class="login_form" action="<?php echo base_url(); ?>login/forgotPassword">

                <span>
                    <label class="fgt_label">New Password</label>
                    <input type="password" placeholder="New Password" class="field m-wrap placeholder-no-fix" id="passwords" name="passwords" />
                </span>	
                <span>	
                    <label class="fgt_label">Confirm Password</label>
                    <input type="password" placeholder="Confirm Password" class="field m-wrap placeholder-no-fix"  id="confirm_password" name="confirm_password">
                </span>	
                <span id='password_div'></span>

                <span class="right">
                    <input type='hidden' name='action' value='change_password'>  
                    <input type='hidden' name='secret' id='secret' value='<?php echo $secret; ?>'>  
                    <input type="button" name="submit" class='btn green' value='Update Password' id='check_email' onclick='return checkPassword();'>
                </span>
            </form>
        </div>

    </div>
</div>
<?php
$this->load->view('footer');

?>

