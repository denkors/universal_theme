<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- шапка поста -->
    <header class="entry-header <?php echo get_post_type();?>-header" style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75));">
		<div class="container">
       
			<div class="post-header-wrapper">
				<div class="post-header-nav">
						
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

				</div><!-- post header nav -->
						<div class="video">
							<?php 
                                $tmp = explode('?v=', get_field('video_link'));
								$ttp = end ($tmp);
								$video_link = get_field('video_link');
								$linked = 'youtube';
								$pos = strpos($video_link,$linked);
								if ($pos = true) {
									echo
									'<iframe width="100%" height="550px" src="https://www.youtube.com/embed/' . $ttp . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
								} else {
									echo 'dont work';
								}

							?>
						</div>
				<div class="lesson-header-title-wrapper">
					<?php

						//проверяем точно ли мы на страгиц поста
						if ( is_singular() ) :
							the_title( '<h1 class="lesson-title">', '</h1>' );
						else :
							the_title( '<h2 class="lesson-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif;
					?>
				</div>
				<!-- post header title wrapper -->
					<div class="post-header-info">
								 <svg width="15" height="15" fill="#BCBFC2" class="icon clock-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#clock"></use>
                              </svg>
                             <span class="post-header-date"><?php the_time( 'j F H:i' );?></span>							 
					 </div>
			</div>		
			<!-- post header wrapper -->
        </div>
		<!-- containeer -->
	</header><!-- .entry-header -->
    <div class="lesson-content container">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'universal_example' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'universal_example' ),
				'after'  => '</div>',
			)
		);
		?>
		<?php
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'universal_example' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Теги: %1$s', 'universal_theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} ?>
	</div><!-- .entry-content -->
    <footer class="entry-footer container">
			<!-- ссылки на соц сети -->
			<?php meks_ess_share();?>
			
	</footer><!-- .entry-footer -->
</article>