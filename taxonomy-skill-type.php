<?php get_header(); ?>
			
            <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
            
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
                
                <!-- the search form -->
                <?php get_search_form(); ?>
            	<!--BEGIN #masonry-->
            	<div id="masonry-portfolio">
              	<?php 
				query_posts(array( 
						'post_type' => 'portfolio', 
						'skill-type' => $term->slug,
						'posts_per_page' => -1
					)
				); 
				?>
                
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php
            
                    // gültig von und bis in php timestamps verwandeln
                    $start_ts = DateTime::createFromFormat('dmY', get_field('portfolio-gueltig-von'));
                    $end_ts = DateTime::createFromFormat('dmY', get_field('portfolio-gueltig-bis'));
                    $tss = date('dmY');
                    $ts = DateTime::createFromFormat('dmY', $tss);

                    if (($ts >= $start_ts) && ($ts <= $end_ts)) {
                ?>
				
                    <!--BEGIN .hentry -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    
                        <?php /* if the post has a WP 2.9+ Thumbnail */
                        
                        $lightbox = get_post_meta(get_the_ID(), 'tz_portfolio_lightbox', TRUE); 
                        $thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
                        
						$embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE);
						
                        $image  = get_post_meta(get_the_ID(), 'tz_portfolio_image', TRUE); 
                        $image2 = get_post_meta(get_the_ID(), 'tz_portfolio_image2', TRUE); 
                        $image3 = get_post_meta(get_the_ID(), 'tz_portfolio_image3', TRUE); 
                        $image4 = get_post_meta(get_the_ID(), 'tz_portfolio_image4', TRUE); 
                        $image5 = get_post_meta(get_the_ID(), 'tz_portfolio_image5', TRUE);
                        
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

                        <?php 
                            // get info if link is not empty
                            $linkinfo;
                            $linkinfo = "";
                            $linkinfo = get_field('externer_link');
                            $openhref = "";
                            $closehref = "";
                            //$linkinfo = get_field('externer_link');
                            if ($linkinfo != ""){
                                $openhref="<a target=\"_blank\" href=\"".$linkinfo."\">";
                                $closehref="</a>";
                            }
                        ?>

                        <?php 
                            // get the skill-types and add space in between
                            $terms = get_the_term_list( $post->ID, __( 'skill-type' ), '', ', ','' );
                            // remove link on skill-types
                            $terms = strip_tags( $terms );
                            // massive hack ;-) ... just keep second category in string (Kategorie2) ... 
                            $splitTerms = explode(',', $terms, 3);
                        ?>
                        <h2 class="entry-title skill-types"><?php echo $openhref.$splitTerms[1].$closehref; // display skill-types ?></h2>
                        <h2 class="entry-title"><?php echo $openhref; the_title(); echo $closehref; ?></h2>
                        <div class="entry-excerpt">
                            <?php
                            $start_ft = DateTime::createFromFormat('dmY', get_field('portfolio-gueltig-von'));
                            $end_ft = DateTime::createFromFormat('dmY', get_field('portfolio-gueltig-bis'));
                            echo $openhref;
                            echo $start_ft->format('d.m.y');
                            echo " bis ";
                            echo $end_ft->format('d.m.y');
                            echo $closehref;
                            ?>
                        </div>
                        <div class="like-count">
                            <?php tz_printLikes(get_the_ID()); ?>
                        </div>

                        
                    <!--END .hentry-->  
                    </div>
                <!-- END daterange -->
                <?php } ?>
                <?php endwhile; endif; ?>
                </div>
                <!--END #masonry-->
                
			<!--END #primary .hfeed-->
			</div>

<?php get_footer(); ?>