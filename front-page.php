<?php get_header();?>
<main class="front-page-header">
  <div class="container">
    <div class="hero">
      <div class="left">
          <?php
          //обьявляем глобальную переменную
          global $post;

          $myposts = get_posts([ 
            'numberposts' => 1,
			'offset' =>1,
			'category_name' => 'java-script',
          ]);
            //проверяем есть ли посты
          if( $myposts ){
            //если есть то запускаем цикл
            foreach( $myposts as $post ){
              setup_postdata( $post );
              ?>
              <!-- Вывода постов, функции цикла: the_title() и т.д. -->
        <img src="<?php the_post_thumbnail_url() ?>" alt="" class="post-thumb">
        <?php $author_id = get_the_author_meta('ID'); ?>
        <a href="<?php echo get_author_posts_url($author_id) ?>" class="author">
          <img src="<?php echo get_avatar_url($author_id) ?>" alt="" class="avatar">
          <div class="author-bio">
            <span class="author-name"><?php the_author() ?></span>
            <span class="author-rank">Должность</span>
          </div>
        </a>
        <div class="post-text">
          <?php 
		  	foreach ( get_the_category() as $category ) {
				  printf(
					  '<a href="%s" class="category-link %s">%s</a>',
					  esc_url(get_category_link( $category )),
					  esc_html( $category -> slug ),
					  esc_html( $category -> name ),

				  );
			  }
		  ?>
          <h2 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h2>
          <a href="<?php echo get_the_permalink() ?>" class="more">Читать далее</a>      
        </div>
                    <?php 
          }
        } else {
          // Постов не найдено
          ?>
           <p>Записей нет</p> 
          <?php
        }

        wp_reset_postdata(); // Сбрасываем $post
        ?>

      </div>
      <div class="right">
        <h3 class="recommend">Рекомендуем</h3>
        <ul class="posts-list">
          <?php
          //обьявляем глобальную переменную
          global $post;

          $myposts = get_posts([ 
            'numberposts' => 5,
            'category_name' => 'web-design,css,html',
            
          ]);
            //проверяем есть ли посты
          if( $myposts ){
            //если есть то запускаем цикл
            foreach( $myposts as $post ){
              setup_postdata( $post );
              ?>
              <!-- Вывода постов, функции цикла: the_title() и т.д. -->
          <li class="post">
            <?php 
				foreach ( get_the_category() as $category ) {
					printf(
						'<a href="%s" class="category-link %s">%s</a>',
						esc_url(get_category_link( $category )),
						esc_html( $category -> slug ),
						esc_html( $category -> name ),

					);
				}
		   ?>
            <a class="post-permalink" href="<?php echo get_the_permalink() ?>">
              <h4 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...') ?></h4>
            </a>
          </li>
          <?php 
          }
        } else {
          // Постов не найдено
          ?>
           <p>Записей нет</p> 
          <?php
        }

        wp_reset_postdata(); // Сбрасываем $post
        ?>
        </ul>
      </div>
      </div>

    
  </div>
</main>
<!-- /container -->
<div class="container">
        <ul class="article-list">
            <?php
            //обьявляем глобальную переменную
            global $post;

            $myposts = get_posts([ 
              'numberposts' => 4,
              'category_name' => 'articles',
            
              
            ]);
              //проверяем есть ли посты
            if( $myposts ){
              //если есть то запускаем цикл
              foreach( $myposts as $post ){
                setup_postdata( $post );
                ?>
              <!-- Вывода постов, функции цикла: the_title() и т.д. -->
            <li class="article-item">
                  <a class="article-permalink" href="<?php echo get_the_permalink() ?>">
                    <h4 class="article-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h4>
                  </a>
                  <img width="65" height="65" src="<?php echo get_the_post_thumbnail_url( null, 'homepage-thumb')?> " alt="" class="">
            </li>
              <?php 
              }
            } else {
              // Постов не найдено
              ?>
              <p>Записей нет</p> 
              <?php
            }

            wp_reset_postdata(); // Сбрасываем $post
            ?>
        </ul>
        <!-- article list -->
        <div class="main-grid">
            <ul class="article-grid">
          <?php		
            global $post;
              //формируем запрос в БД
            $query = new WP_Query( [
              //получаем 7 постов
              'posts_per_page' => 7,
			  'category__not_in' => 23,
         'category__not_in' => 29,
              
            ] );

            if ( $query->have_posts() ) {
              //создаем переменную-счетчик постов
              $cnt = 0;
              //пока есть посты выводим их
              while ( $query->have_posts() ) {
                $query->the_post();
                //увеличиваем счетчик постов
                $cnt++;
                switch ($cnt) {
                  //вывод первого поста
                  case '1':
                  ?> 
                      <li class="article-grid-item article-grid-item-1">
                        <a href="<?php the_permalink() ?>" class="article-grid-permalink">
                        <span class="category-name"> <?php $category = get_the_category(); echo $category [0]->name ?> </span>
                        <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...') ?></h4>
                        <p class="article-grid-excerpt">
                        <?php echo mb_strimwidth(get_the_excerpt(), 0, 120, '...') ?>
                        </p>
                        <div class="article-grid-info">
                          <div class="author">
                            <?php $author_id = get_the_author_meta('ID'); ?>
                            <img src="<?php echo get_avatar_url($author_id) ?>" alt="" class="author-avatar">
                            <span class="author-name"><strong><?php the_author()?></strong> : <?php the_author_meta('description') ?></span>
                          </div>
                            <div class="comments">
                              <svg width="19" height="15" fill="#BCBFC2" class="icon comments-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                              </svg>
                              <span class="comments-counter"><?php comments_number('0', '1', '%') ?></span>
                            </div>
                        </div>
                        </a>
                      </li>
                      
                  <?php
                    break;
                    //выводим второй пост
                  case '2':?>
                      <li class="article-grid-item article-grid-item-2">
                        <img src="<?php echo get_the_post_thumbnail_url()?>" alt="" class="article-grid-thumb"> 
                        <a href="<?php the_permalink() ?>" class="article-grid-permalink">
                        <span class="tag">
                          <?php
                            $posttags = get_the_tags();
                            if ( $posttags ) {
                              echo $posttags[0]->name . ' ';
                            } ?>
                        </span>
                        <span class="category-name"> <?php $category = get_the_category(); echo $category [0]->name ?> </span>
                        <h4 class="article-grid-title"><?php the_title() ?></h4>
                        <div class="article-grid-info">
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
                      </li>
                    <?php
                    break;

                    //выводим третий пост
                    case '3' : ?>
                      <li class="article-grid-item article-grid-item-3">
                        <a href="<?php the_permalink() ?>" class="article-grid-permalink">
                          <img src="<?php echo get_the_post_thumbnail_url()?>" alt="" class="article-thumb">
                          <h4 class="article-grid-title"><?php  echo the_title() ?></h4>
                        </a>
                      </li>
                    <?php

                    break;
                  //вывод остальеых постов
                  default:?>
                  <li class="article-grid-item article-grid-item-default">
                    <a href="<?php the_permalink() ?>" class="article-grid-permalink">
                      <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 38, '...') ?></h4>
                      <p class="article-grid-excerpt">
                        <?php echo mb_strimwidth(get_the_excerpt(), 0, 90, '...') ?>
                        </p>
                      <span class="article-date"><?php the_time( 'j F' );?></span>
                    </a>
                  </li>
                  <?php
                    
                    break;
                }
                ?>
                <!-- Вывода постов, функции цикла: the_title() и т.д. -->
                <?php 
              }
            } else {
              // Постов не найдено
            }

            wp_reset_postdata(); // Сбрасываем $post
            ?>
        </ul>
        <!-- article list -->
        <!-- Подключаем сайдбар -->
        <?php get_sidebar('home-top');?>
        
        </div>
</div>
<!-- /container -->
<?php		
	global $post;

	$query = new WP_Query( [
		'posts_per_page' => 1,
		'category_name' => 'investigation',
	] );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			?>
			<!-- Вывода постов, функции цикла: the_title() и т.д. -->
			<section class="investigation" style="background: linear-gradient(0deg, rgba(64, 48, 61, 0.35), rgba(64, 48, 61, 0.35)), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center">
				<div class="container">
					<h2 class="investigation-title"><?php the_title(); ?></h2>
					<a href="<?php echo get_the_permalink() ?>" class="more">Читать статью</a>
				</div>
			</section>

			<?php 
		}
	} else {
		// Постов не найдено
	}

	wp_reset_postdata(); // Сбрасываем $post
?>
<!-- investigation -->

<div class="post-list container">
	<ul class="post-list-item">
            <?php
            //обьявляем глобальную переменную
            global $post;

            $myposts = get_posts([ 
              'numberposts' => 6,
              'category__not_in' => 26,
            
              
            ]);
              //проверяем есть ли посты
            if( $myposts ){
              //если есть то запускаем цикл
              foreach( $myposts as $post ){
                setup_postdata( $post );
                ?>
              <!-- Вывода постов, функции цикла: the_title() и т.д. -->
            <li class="post-list-unit">
				 <img width="336" height="195" src="<?php 
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
                    <h4 class="post-list-title"><?php echo mb_strimwidth(get_the_title(), 0, 75, '...') ?></h4>
                  </a>
				   <p class="post-list-excerpt">
                        <?php echo mb_strimwidth(get_the_excerpt(), 0, 165, '...') ?>
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
              <?php 
              }
            } else {
              // Постов не найдено
              ?>
              <p>Записей нет</p> 
              <?php
            }

            wp_reset_postdata(); // Сбрасываем $post
            ?>
        </ul>
<!-- Подключаем сайдбар -->
<?php get_sidebar('home-bottom');?>
</div>
<div class="special">
    <div class="container">
            <div class="special-grid">
                <?php		
                    global $post;

                    $query = new WP_Query( [
                      'posts_per_page' => 1,
                      'category_name' => 'photo-report',
                    ] );

                    if ( $query->have_posts() ) {
                      while ( $query->have_posts() ) {
                        $query->the_post();
                        ?>
                        <div class="photo-report">
                          <!-- Slider main container -->
                          <div class="swiper-container photo-report-slider">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                              <!-- Slides -->
                              <?php $images = get_attached_media( 'image'); 
                                foreach ($images as $image ) {
                                  echo '<div class="swiper-slide"><img src=" ';
                                  print_r($image -> guid);
                                  echo '"></div>';
                                }
                             ?>
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>
                          </div>
                            <div class="photo-report-content">
                                 <?php 
                            foreach ( get_the_category() as $category ) {
                              printf(
                                '<a href="%s" class="category-link">%s</a>',
                                esc_url(get_category_link( $category )),
                                esc_html( $category -> name ),

                              );
                            }
				                    ?>
                            <?php $author_id = get_the_author_meta('ID'); ?>
                            <a href="<?php echo get_author_posts_url($author_id) ?>" class="author">
                              <img src="<?php echo get_avatar_url($author_id) ?>" alt="" class="author-avatar">
                              <div class="author-bio">
                                <span class="author-name"><?php the_author() ?></span>
                                <span class="author-rank">Должность</span>
                              </div>
                              </a>
                            <!-- author -->
                            <h3 class="photo-report-title"><?php the_title() ?></h3>
                              <a href="<?php echo get_the_permalink() ?>" class="button photo-report-button">
                              <svg width="19" height="15" class="icon photo-report-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#images"></use>
                              </svg>
                              View photo
                              <span class="photo-report-counter"><?php echo count($images); ?></span>
                              </a>
                            </div>
                        </div>
              <!-- photo-report -->
                        <?php 
                      }
                    } else {
                      // Постов не найдено
                    }

                    wp_reset_postdata(); // Сбрасываем $post
                  ?>
              <div class="other">
                <div class="career-post">
                  <?php
                    //обьявляем глобальную переменную
                    global $post;

                    $myposts = get_posts([ 
                      'numberposts' => 1,
                      'category_name' => 'career',                     
                    ]);
                      //проверяем есть ли посты
                    if( $myposts ){
                      //если есть то запускаем цикл
                      foreach( $myposts as $post ){
                        setup_postdata( $post );
                        ?>
                      <!-- Вывода постов, функции цикла: the_title() и т.д. -->
                     <?php foreach ( get_the_category() as $category ) {
                              printf(
                                '<a href="%s" class="category-link">%s</a>',
                                esc_url(get_category_link( $category )),
                                esc_html( $category -> name ),

                              );
                            }
                            ?>
                    <h3 class="career-post-title"><?php the_title() ?></h3>
                    <p class="career-post-excerpt">
                      <?php echo mb_strimwidth(get_the_excerpt(), 0, 90, '...') ?>
                    </p>
                    <a href="<?php echo get_the_permalink() ?>" class="more">Читать далее</a>
                      <?php 
                      }
                    } else {
                      // Постов не найдено
                      ?>
                      <p>Записей нет</p> 
                      <?php
                    }

                    wp_reset_postdata(); // Сбрасываем $post
                    ?>
                </div>
                <!-- /.career-post -->
                <div class="other-posts">
                  <?php
                    //обьявляем глобальную переменную
                    global $post;

                    $myposts = get_posts([ 
                      'numberposts' => 2,
                      'category__not_in' => 26,
                      'category__not_in' => 29,                   
                    ]);
                      //проверяем есть ли посты
                    if( $myposts ){
                      //если есть то запускаем цикл
                      foreach( $myposts as $post ){
                        setup_postdata( $post );
                        ?>
                      <!-- Вывода постов, функции цикла: the_title() и т.д. -->
                    <a href="<?php echo get_the_permalink() ?>" class="other-post other-post-default">
                      <h4 class="other-post-title"><?php echo mb_strimwidth(get_the_title(), 0, 24, '...') ?></h4>
                      <p class="other-post-excerpt"><?php echo mb_strimwidth(get_the_excerpt(), 0, 70, '...') ?></p>
                      <span class="other-post-date"><?php the_time( 'j F Y' );?></span>
                    </a>
                      <?php 
                      }
                    } else {
                      // Постов не найдено
                      ?>
                      <p>Записей нет</p> 
                      <?php
                    }

                    wp_reset_postdata(); // Сбрасываем $post
                    ?>
                </div>
              <!-- /.other-posts -->
              </div>
              <!-- other -->
            </div>
            <!-- special-grid -->
    </div>
    <!-- container -->
</div>
<!-- special -->
<?php get_footer(); ?>