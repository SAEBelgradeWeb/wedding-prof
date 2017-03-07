<!-- FOOTER -->
        <footer id="footer">

            <!-- FOOTER SIDEBAR -->
            <div id="outerfootersidebar">
                <div class="container">
                    <div id="footersidebar" class="row">
                        <?php dynamic_sidebar('footer') ?>

                        <div class="clear"></div>
                 
                    </div>
                </div>
            </div>
            <!-- END FOOTER SIDEBAR -->
            
        </footer>
        <!-- END FOOTER -->
        <div class="clear"></div><!-- clear float --> 
	</div><!-- end outercontainer -->
</div><!-- end bodychild -->

<!-- COPYRIGHT -->
<div id="outercopyright">
    <div class="container">
        <div id="copyright">
            Copyright © <?= date('Y') ?> Michael&amp;Miranda.
        </div>
    </div>
</div>
<!-- END COPYRIGHT -->



<?php wp_footer(); ?>

<script type="text/javascript">
jQuery(window).load(function() {
    jQuery('.flexslider').flexslider({
          animation: "fade",              //String: Select your animation type, "fade" or "slide"
		  directionNav: true, //Boolean: Create navigation for previous/next navigation? (true/false)
		  controlNav: false  //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        });
		
});
</script>

</body>
</html>
