<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lesser
 */

get_header();
?>

<div class="container">
        <h1 class="category-title">
            <?php single_term_title('Видеоуроки по теме: '); ?></h1>
            <div class="posts-list">
                <?php while ( have_posts() ){ the_post(); ?>
                    <div class="posts-card">
                    <a class="posts-list" href="<?php echo get_the_permalink() ?>">
                        <img src="<?php 
            //должно находится внутри цикла
            if( has_post_thumbnail() ) {
              echo get_the_post_thumbnail_url();
            }
            else {
              echo get_template_directory_uri( ) . '/assets/images/img-default.png';
            }
            ?>" alt="" class="posts-card-thumb">
                        <div class="posts-card-text">
                            <h2 class="posts-card-title">
                            <?php echo mb_strimwidth(get_the_title(), 0, 30, '...') ?>
                            </h2>
                        <p><?php echo mb_strimwidth(get_the_excerpt(), 0, 90, '...') ?></p>
                         <div class="author">
                            <?php $author_id = get_the_author_meta('ID'); ?>
                            <img src="<?php echo get_avatar_url($author_id) ?>" alt="" class="author-avatar">
                            <div class="author-info">
                                <span class="author-name"><strong><?php the_author()?></strong></span>
                                <span class="date"><?php the_time( 'j F' );?></span>
                                <div class="comments">
                                <svg width="19" height="15" fill="#fff" class="icon comments-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                              </svg>
                                  <span class="comments-counter"><?php comments_number('0', '1', '%') ?></span>
                                </div>
                                <div class="likes">
                                   <svg width="19" height="15" fill="#fff" class="icon like-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                              </svg>
                                  <span class="likes-counter"><?php comments_number('0', '1', '%') ?></span>
                                </div>
                            </div>
                          </div>
                    </div>
                    </a>
                        </div>
                    <!-- author -->
                <?php } ?>
                <?php if ( ! have_posts() ){ ?>
                    Записей нет.
                <?php } ?>
                 <div class="posts-pagination">
                     <?php 
                    $args = array(
                        'prev_text'    => __('&larr; Назад'),
	                    'next_text'    => __('Вперед &rarr; '),
                    );
                    the_posts_pagination( $args ) ?>
                    </div>
                    <!-- pagination-posts -->
            </div>
            <!-- post card -->
            </div>
            <!-- posts-list -->
    </div>

<?php
get_footer();
