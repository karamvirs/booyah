<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Booyah</title>  <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<link href="<?php echo base_url(); ?>templates/frontend/css/style.css" type="text/css" rel="stylesheet" />
    <!--script type="text/javascript" src="<?php echo base_url(); ?>templates/frontend/popup/modalPopLite.min.js"></script>
    <link href="<?php echo base_url(); ?>templates/frontend/popup/modalPopLite.css" rel="stylesheet" type="text/css" /-->
    <link href="<?php echo base_url(); ?>templates/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>templates/admin/css/metro.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>templates/admin/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <script type='text/javascript' src='<?php echo base_url(); ?>templates/frontend/js/jquery.validate.js'></script>
    <script src="http://jquery.bassistance.de/validate/additional-methods.js"></script>
       
    </head>
    <script type="text/javascript">

        $(document).ready(function() {

          //  $('#popup-wrapper').modalPopLite({openButton: '#clicker', closeButton: '#close-btn'});

          //  $('#popup-wrapper1').modalPopLite({openButton: '.click_poup', closeButton: '#close-btn1'});

            $(".clickers").click(function() {
                $(".popup").show();
            });
            $("#clicker_reg").click(function() {
                $("#clicker").trigger("click");
                $("#logins").hide();
                $("#register").show();
            });

            $("#account").click(function(e) {
                e.stopPropagation();
                $("#myaccount").toggle("slow");

                $(document).click(function() {
                    var $el = $("#myaccount");
                    if ($el.is(":visible")) {
                        $el.hide("drop");
                    }
                });
            });


            $("#register_form").validate({
                errorClass: 'regerrors',
                rules: {
                    reg_password: {
                        required: true,
                        minlength: 6
                    },
                    con_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#con_password"
                    }
                },
                submitHandler: function(form) {
                    check_register();
                    return false;
                }
            });
        });
        function check_register()
        {
            var name = $("#name").val();
            var reg_email = $("#reg_email").val();
            var password = $("#reg_password").val();
            var re_password = $("#re_password").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>login/email_exists",
                data: {reg_email: reg_email},
                success: function(response)
                { //alert(response);
                    if (response == 'sucess') {
                        $("#error_msg").html('Email Already Exists.').show();
                        return false;
                    }
                    if (response == 'failed') {
                        $("#error_msg").hide();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('login/registration_active'); ?>",
                            data: {name: name, reg_email: reg_email, password: password},
                            success: function(response)
                            {

                                if (response == 'success')
                                {
                                    $("#register").hide();
                                    // $("#error_msg").html('Please Check your email to activate.').show();

                                    $("#logins").show();
                                    $("#after_reg").html('Please Check your email to activate.').show();
                                    //window.location='<?php echo base_url(); ?>login';

                                }
                            }
                        });
                        return false;
                    }
                }
            });
        }


        $(document).ready(function() {

            function check_forgot_email()
            {
                var email = $("#fgt_email").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/login/forgot_password'); ?>",
                    data: {email: email},
                    success: function(response)
                    {
                        if (response == 'fail') {
                            $("#fgt_message").html('Email Does not Exists.').show();
                            return false;
                        }
                        if (response == 'success') {
                            $("#fgt_message").html('Your change password request has been sent. Please check your email.').show();
                            // $("#forgotpassword").hide();
                            // $("#recovery_div").show();

                        }
                    }

                });
            }

            $('#fgt_pswd_form').validate({
                errorElement: 'label', //default input error message container
                errorClass: 'regerrors', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    fgt_email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    fgt_email: {
                        required: "Email is required."
                    }
                },
                invalidHandler: function(event, validator) { //display error alert on form submit   

                },
                highlight: function(element) { // hightlight error inputs
                    $(element).closest('.control-group').addClass('error'); // set error class to the control group
                },
                success: function(label) {
                    label.closest('.control-group').removeClass('error');
                    label.remove();
                },
                errorPlacement: function(error, element) {
                    error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
                },
                submitHandler: function(form) {
                    check_forgot_email();
                    return false;
                }
            });


        });




    </script>
    <body>
       

        <!-------header starts here------>
        <div class="header">
            <div class="wrapper">
				<a class="" href="<?php echo base_url();?>"><h1>THUMBFound App</h1></a>
                <div class="heder_right">
                    
                                   
                    <script type="text/javascript">
                        $(document).ready(function() {

                            $("#register-btn").click(function() {

                                $("#logins").hide();
                                $("#forgotpassword").hide();
                                //$("#activations").hide();
                                $("#recovery_div").hide();
                                $("#register").show();

                            })

                            $("#forgot-btn").click(function() {

                                $("#logins").hide();
                                $("#register").hide()
                                $("#forgotpassword").show();
                                $("#recovery_div").hide();
                                //$("#activations").hide();
                            })
                            $("#cancel_btn").click(function() {

                                $("#forgotpassword").hide();
                                $("#logins").show();

                            })

                            $("#cancel_btn_sigin").click(function() {

                                $("#register").hide();
                                $("#logins").show();


                            })



                        });
                    </script>

                   
                </div>

                <?php
               /* $directory = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
                $active = array();
                $directories = array("index", "begin", "contact", "about"); // set home as 'index', but can be changed based of the home uri
                foreach ($directories as $folder) {

                    // $active[$folder] = ($directory[1] == $folder) ? "active" : "";
                    if (($directory[1] == $folder)) {
                        $active[$folder] = 'active';
                        $class = '';
                    } else if ($directory[1] == '') {
                        $class = "active";
                        $active[$folder] = '';
                    } else {
                        $active[$folder] = '';
                        $class = '';
                    }
                }
                $activeclass = '';
                $url_names = array("begin", "customization", "delivery", "payment");
                $uri = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
                foreach ($url_names as $url_name) {
                    if (in_array($url_name, $uri)) {
                        $activeclass = 'active';
                    }
                }*/
                ?>          
                <div class="topnav">
                   
                </div>
            </div>
        </div> 


            

        
