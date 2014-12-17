<?php
$this->load->view('header');
?>


<!-------banner starts here------>
<div class="banner">
    <div class="wrapper">
        
    </div>      
</div>
<!-------banner ends here------>
<script>
            $(document).ready(function() {
		$('#subscribe').validate({
                
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Email is required."
                    }
                },
                /*invalidHandler: function(event, validator) { //display error alert on form submit   
                    alert("email is required");
                },*/
                /*highlight: function(element) { // hightlight error inputs
            alert(element);
                    $(element).closest('.control-group').addClass('error'); // set error class to the control group
                },
                success: function(label) {
                    label.closest('.control-group').removeClass('error');
                    label.remove();
                },
                errorPlacement: function(error, element) {
                    error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
                },*/
                submitHandler: function(form) {
                    form.submit();
                    return true;
                }
            });
        });
</script>
<style>
    .error {
    color: #FF0000;
}
</style>
<!-------content starts here------>
<div class="content">
    <div class="wrapper">
        
        

          

    </div>
</div>
<!-------content ends here------>
<!-------footer starts here------>
<div class="footer">
    <div class="wrapper">
        <div class="footer_links">
            

        </div>
        <div class="copyright">
            Copyright 2014. All rights reserved.
            <ul class="policy">
				 <li><a href="<?php echo base_url('login')?>">Login</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Use.</a></li>
            </ul>   
        </div>
    </div>
</div>


</body>
</html>
