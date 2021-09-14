<script>
    
    $(document).ready(function() {
        $(".show_hide_confirm_password a").on('click', function(event) {
            event.preventDefault();
            var parentInput = $(this).parent().parent();
            if ($(this).parent().parent().find('input').attr('type') == "text") {
                $(this).parent().parent().find('input').attr('type', 'password');
                $(this).parent().parent().find('i').addClass("fa-eye-slash");
                $(this).parent().parent().find('i').removeClass("fa-eye");
            } else {
                $(this).parent().parent().find('input').attr('type', 'text');
                $(this).parent().parent().find('i').removeClass("fa-eye-slash");
                $(this).parent().parent().find('i').addClass("fa-eye");
            }
        });
    });
</script>
<footer id="footer" style="background-image: url(assets/image/footer-bg.png);">
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer_contact">
                <img src="<?php echo base_url(); ?>assets/image/logotransparent.png" alt="">
                <p>32 Dora Creek, tuntable creek, New South Wales 2480, Australia</p>
                <ul class="footer-contact_icons">
                    <li><i class="fa fa-phone"></i><a href="tel:+088 234 432 15565">+088 234 432 15565</a></li>
                    <li><i class="fa fa-envelope-o"></i><a href="mailto:sample@yourdomain.com">sample@yourdomain.com</a></li>
                    <li><i class="fa fa-globe"></i><a href="www.domainname.com">www.domainname.com</a></li>
                </ul>
                <ul class="social-icons">
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="col-md-2 footer_service">
                <h3 class="footer_heading">Services</h3>
                <ul class="footer_service_menu">
                    <li><a href="#">Crane lifting</a></li>
                    <li><a href="#">Mining Construction</a></li>
                    <li><a href="#">Earth-moving Solutions</a></li>
                    <li><a href="#">Road Machinery</a></li>
                    <li><a href="#">Concrete Equipment</a></li>
                    <li><a href="#">Tunnel and Underground</a></li>
                    <li><a href="#">Space Construction</a></li>
                </ul>
            </div>
            <div class="col-md-2 footer_useful_links">
                <h3 class="footer_heading">Quick Links</h3>
                <ul class="footer_service_menu quick_links">
                    <li><a href="#">Company Profile</a></li>
                    <li><a href="#">History</a></li>
                    <li><a href="#">Brand</a></li>
                    <li><a href="#">Global XCMG</a></li>
                    <li><a href="#">Social Responsibility</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-4 footer_newsletter">
                <h3 class="footer_heading">Newsletter</h3>
                <p>Seamlessly visualize quality intellectual capital without superior collaboration and idea sharing listically</p>
                <form>
                    <div class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <button type="submit" class="btn simple_btn"><i class="far fa-paper-plane"></i>Submit Now</button>
                </form>
            </div>
        </div>

    </div>
    <div class="footer_bottom text-center container">
        <p>Copyright © <?php echo date("Y")?> | All rights reserved</p>
    </div>

</footer>
<script>
       var toastAlert = Swal.mixin({
            toast: true,
            icon: 'success',
            title: 'General Title',
            animation: false,
            position: 'top-left',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

</script>
<script src="<?php echo base_url(); ?>assets/js/slick.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</body>

</html>