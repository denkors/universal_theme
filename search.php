<?php get_header(); ?>
    <div class="container">
        <h1 class="search-title">Результаты поиска по запросу:</h1>
        <div class="post-list">
            <div class="post-list-wrapper">
                                    <ul class="post-list-item">
                        <?php while ( have_posts() ){ the_post(); ?>
                            <li class="post-list-unit">
                    <img src="<?php 
                //должно находится внутри цикла
                if( has_post_thumbnail() ) {
                echo get_the_post_thumbnail_url();
                }
                else {
                echo get_template_directory_uri( ) . '/assets/images/img-default.png';
                }
                ?>"class="post-list-image">
                <div class="post-list-info">
                    <!-- $category = get_the_category(); echo 	$category [0]->name -->
                    <span class="category-name"> <?php 
                    foreach ( get_the_category() as $category ) {
                        printf(
                            '<a href="%s" class="category-link %s">%s</a>',
                            esc_url(get_category_link( $category )),
                            esc_html( $category -> slug ),
                            esc_html( $category -> name ),

                        );
                    }
                    ?> </span>
                    <a class="post-list-permalink" href="<?php echo get_the_permalink() ?>">
                        <h4 class="post-list-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...') ?></h4>
                    </a>
                    <p class="post-list-excerpt">
                            <?php echo mb_strimwidth(get_the_excerpt(), 0, 120, '...') ?>
                    </p>
                    <div class="author-info">
                                <span class="date"><?php the_time( 'j F' );?></span>
                                <div class="comments">
                                    <svg width="19" height="15" fill="#BCBFC2" class="icon comments-icon">
                                    <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                                </svg>
                                    <span class="comments-counter"><?php comments_number('0', '1', '%') ?></span>
                                </div>
                                <div class="likes">
                                    <svg width="19" height="15" fill="#BCBFC2" class="icon like-icon">
                                    <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                                </svg>
                                    <span class="likes-counter"><?php comments_number('0', '1', '%') ?></span>
                                </div>
                    </div>
                </div>
            </li>
                        <?php } ?>
                        <?php if ( ! have_posts() ){ ?>
                            Записей нет.
                        <?php } ?>
                    </ul>
                    <?php 
                    $args = array(
                        'prev_text'    => __('&larr; Назад'),
	                    'next_text'    => __('Вперед &rarr; '),
                    );
                    the_posts_pagination( $args ) ?>
            </div>

                    <!-- Подключаем сайдбар -->
                    <?php get_sidebar('home-bottom');?>
        </div>
        <!-- post-list -->
    </div>
    <!-- container -->
<?php get_footer(); ?>