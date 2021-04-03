<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universal_example
 */
?>

<div class="footer-posts-wrapper">
        <div class="footer-posts container">
                    <?php 
                                                
                                               $category = get_the_category($post->ID);
                                                $current_cat_id = $category[0]->cat_ID;
                                                $current_cat_name = $category[0]->name;
                                                $posts = get_posts( array(
                                    'numberposts' => '4',
                                    'category'    => $current_cat_id,
                                    'orderby'     => 'date',
                                    'include'     => array(),
                                    'exclude'     => '$id_post',
                                    'post_type'   => 'post',

                                ) );

                                foreach( $posts as $post ){
                                    setup_postdata($post); ?>
                                    
                                    <a href="<?php the_permalink() ?>" class="footer-posts-link">
                                        <img src="<?php 
                                        if( has_post_thumbnail() ) {
                                        echo get_the_post_thumbnail_url();
                                        }
                                        else {
                                        echo get_template_directory_uri( ) . '/assets/images/img-default.png';
                                        }
                                        ?>"class="footer-posts-image">
                                        <h4 class="footer-posts-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h4>
                                        <div class="footer-posts-info">
                                            <svg width="15" height="15" class="icon eye-icon">
                                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#eye"></use>
                                            </svg>
                                            <span class="eyes-counter"><?php comments_number('0', '1', '%') ?></span>
                                                <svg width="15" height="15" fill="#BCBFC2" class="icon comments-icon">
                                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                                                </svg>
                                                <span class="comments-counter"><?php comments_number('0', '1', '%') ?></span>
                                        </div>
                                    
                                    </a>
                <?php

                                }

                                wp_reset_postdata();
                                ?>
           </div>                     
</div><!-- #secondary -->