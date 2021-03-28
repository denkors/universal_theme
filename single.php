<?php get_header('post') ?>

	<main class="site-main">

		<?php
        //запускаем цикл,проверяем есть ли посты
		while ( have_posts() ) :
            //если пост есть выводим 
			the_post();

            //находим шаблон поста в папке template parts
			get_template_part( 'template-parts/content', get_post_type() );

            //выводим ссылки на следующий и предыдищ посты

			// Если комменты открыты то выводим их
			if ( comments_open() || get_comments_number() ) :
                //находим файл comments php и выводим его
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->


<?php get_footer() ?>