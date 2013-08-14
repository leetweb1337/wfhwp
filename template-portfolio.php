<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
            
            <?php 
			
			query_posts( array(
							'post_type' => 'portfolio',
							'posts_per_page' => -1
				)
			);
			
			?>
            	<!--BEGIN #masonry-->
            	<div id="masonry-portfolio">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
                    <!--BEGIN .hentry -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        
                        <?php 
                        
                        
                        $lightbox = get_post_meta(get_the_ID(), 'tz_portfolio_lightbox', TRUE); 
                        $thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
                        
						$embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE);
						
						$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                        
                        if($lightbox == 'no')
                            $lightbox = FALSE;
                        
                        if($thumb == '')
                            $thumb = FALSE;

                         $large_image = $large_image[0];
                            
                        ?>
                        
                        <div class="post-thumb clearfix">
                        
                            <?php if($lightbox) : ?>
                                <a class="lightbox" title="<?php the_title(); ?>" href="<?php echo $large_image; ?>">
                                    <span class="overlay">
                                        <span class="icon"></span>
                                    </span>
                                    
                                    <?php if($thumb) : ?>
                                    <img src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
                                    <?php else: ?>
                                    <?php the_post_thumbnail('portfolio-thumb'); ?>
                                    <?php endif; ?>
                                </a>
                            <?php else: ?>
                            
                                <?php if($thumb) : ?>
                                	<img src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
                                <?php else: ?>
                                <?php the_post_thumbnail('portfolio-thumb'); ?>
                                <?php endif; ?>                            
		

                            <?php endif; ?>
                            
                        </div>
                        
                        <div class="arrow"></div>	
                        
			<?php echo get_post_meta($post->ID, 'gogo_select_portfolio_cat', true); ?>
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                        <div class="like-count">
			<?php tz_printLikes(get_the_ID()); ?>
			</div>

			<div class="entry-excerpt">
			<?php echo get_post_meta($post->ID, 'portfolio-gueltig-von', true); ?>
			<?php echo "bis"; ?>
			<?php echo get_post_meta($post->ID, 'portfolio-gueltig-bis', true); ?>
			</div>
                        
                    <!--END .hentry-->  
                    </div>

                <?php endwhile; endif; ?>
                </div>
                <!--END #masonry-->
                
			<!--END #primary .hfeed-->
			</div>

<?php get_footer(); ?>