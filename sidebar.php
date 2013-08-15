		<!--BEGIN #sidebar .aside-->
		<div id="sidebar" class="aside">
        
        	<!-- BEGIN #logo -->
			<div id="logo">
				<?php /*
				If "plain text logo" is set in theme options then use text
				if a logo url has been set in theme options then use that
				if none of the above then use the default logo.png */
				if (get_option('tz_plain_logo') == 'true') { ?>
				<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php } elseif (get_option('tz_logo')) { ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('tz_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
				<?php } else { ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php } ?>
                
                <?php $tagline = get_option('tz_tagline'); ?>
                <?php if($tagline != '') : ?>
                
                <p id="tagline"><?php echo stripslashes($tagline); ?></p>
                
                <?php endif; ?>
                
			<!-- END #logo -->
			</div>
            
            <div class="seperator clearfix">
            	<div class="line"></div>
            </div>
			
            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Portfolio Sidebar') ) ?>
            
            <!-- BEGIN #back-to-top -->
            <div id="back-to-top">
            	<a href="#">
                	<span class="icon"><span class="arrow"></span></span>
                    <span class="text"><?php _e('Back to Top', 'framework'); ?></span>
                </a>
            <!-- END #back-to-top -->
            </div>
		
		<!--END #sidebar .aside-->
		</div>