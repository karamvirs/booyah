
<div class="footer">
    <div class="wrapper">
             <div class="footer_links">
                   <ul class="footer_nav">
                         <li><a href="#">Home</a></li>
                         <li><a href="#">About Us</a></li>
                         <li><a href="#">Contact Us</a></li>
                         
                   </ul>
                   
                   
             </div>
             <div class="copyright">
                        Copyright 2013. All rights reserved.
                        <ul class="policy">
                           <?php $user_id = $this->session->userdata('booyah_user_id');
							if(empty($user_id)){ // this link is for pro user only
							?><li><a href="<?php echo base_url('login')?>">Login</a></li>
							<?php } else {?>
								<li><a href="<?php echo base_url('login/logout')?>">Logout</a></li>
							<?php } ?>
                           <li><a href="#">Privacy Policy</a></li>
                           <li><a href="#">Terms of Use.</a></li>
                        </ul>   
             </div>
    </div>
</div>
<script src="http://mfvs.cc/booyah/templates/admin/breakpoints/breakpoints.js"></script>  
<script src="http://mfvs.cc/booyah/templates/admin/bootstrap/js/bootstrap.min.js"></script> 
<script src="http://mfvs.cc/booyah/templates/admin/js/jquery.cookie.js"></script>
<script type="text/javascript" src="http://mfvs.cc/booyah/templates/admin/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="http://mfvs.cc/booyah/templates/admin/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://mfvs.cc/booyah/templates/admin/data-tables/DT_bootstrap.js"></script>
<script src="http://mfvs.cc/booyah/templates/admin/js/app.js"></script>   
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.setPage("table_managed");
        App.init();
    });
</script>
<!-------footer ends here------>
</body>
</html>
