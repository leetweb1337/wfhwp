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
							'order' => 'ASC',
							'orderby' => 'title',
							'post_type' => 'portfolio',
							'posts_per_page' => -1
				)
			);

			
			?>   
                <!-- the search form -->
                <?php get_search_form(); ?>

            	<!--BEGIN #masonry-->
            	<div id="masonry-portfolio">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php
            
                    // gültig von und bis in php timestamps verwandeln
                    $start_ts = DateTime::createFromFormat('dmY', get_field('portfolio-gueltig-von'));
                    $end_ts = DateTime::createFromFormat('dmY', get_field('portfolio-gueltig-bis'));
                    $tss = date('dmY');
                    $ts = DateTime::createFromFormat('dmY', $tss);

                    ?>
                    </div>
                    <?php

                    if (($start_ts <= $ts) && ($end_ts >= $ts) || ($start_ts == $ts) && ($end_ts == $ts)) {
                ?>

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
                            $terms = get_the_term_list( $post->ID,'skill-type', '', ', ','' );
                            // remove link on skill-types
                            $terms = strip_tags( $terms );
                            // massive hack ;-) ... just keep second category in string (Kategorie2) ... 
                            // EDIT here
                            $splitTerms = explode(',', $terms, 2);
                        ?>
                        <?php
                        foreach(get_the_category($post->ID) as $cat) {
                           if(!$cat->parent) : //check if top cat
                           echo $cat->term_id.' '.$cat->name.' (skill-type)<br/>'; //top cat
                           $sub_cats = get_categories('parent='.$cat->term_id);
                           if($sub_cats) foreach($sub_cats as $sub_cat) {
                           echo $sub_cat->term_id.' '.$sub_cat->name.'<br/>'; //sub cat(s)
                           }
                           endif;
                        }
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
                <!-- END timerange -->
                <?php } ?>
                <?php endwhile; endif; ?>
                </div>
                <!--END #masonry-->
                
			<!--END #primary .hfeed-->
			</div>

<?php get_footer(); ?>