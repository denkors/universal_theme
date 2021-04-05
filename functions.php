<?php
//добавление расширенных возможностей
if ( ! function_exists( 'universal_theme_setup' ) ) :
  
  function universal_theme_setup(){
    //добавление тега title 
    add_theme_support( 'title-tag' );

    //добвление миниатюр
    add_theme_support( 'post-thumbnails', array( 'post','lesson') ); 

    //логотип 
    add_theme_support( 'custom-logo', [
	'width'       => 163,
	'flex-height' => true,
	'header-text' => 'Universal',
	'unlink-homepage-logo' => false, // WP 5.5
  ] );
  //регистрация меню
	  register_nav_menus( [
		  'header_menu' => 'Меню в шапке',
		  'footer_menu' => 'Меню в подвале'
    ]);
  

add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type( 'lesson', [
		'label'  => null,
		'labels' => [
			'name'               => 'Уроки', // основное название для типа записи
			'singular_name'      => 'Урок', // название для одной записи этого типа
			'add_new'            => 'Добавить урок', // для добавления новой записи
			'add_new_item'       => 'Добавление урока', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование урока', // для редактирования типа записи
			'new_item'           => 'Новый урок', // текст новой записи
			'view_item'          => 'Смотреть урок', // для просмотра записи этого типа.
			'search_items'       => 'Искать уроки', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Уроки', // название меню
		],
		'description'         => 'Раздел с видеоуроками',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => true, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-learn-more',
		'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

// хук, через который подключается функция
// регистрирующая новые таксономии (create_lesson_taxonomies)
add_action( 'init', 'create_lesson_taxonomies' );

// функция, создающая 2 новые таксономии "genres" и "authors" для постов типа "lesson"
function create_lesson_taxonomies(){

	// Добавляем древовидную таксономию 'genre' (как категории)
	register_taxonomy('genre', array('lesson'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => _x( 'Genres', 'taxonomy general name' ),
			'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
			'search_items'      =>  __( 'Search Genres' ),
			'all_items'         => __( 'All Genres' ),
			'parent_item'       => __( 'Parent Genre' ),
			'parent_item_colon' => __( 'Parent Genre:' ),
			'edit_item'         => __( 'Edit Genre' ),
			'update_item'       => __( 'Update Genre' ),
			'add_new_item'      => __( 'Add New Genre' ),
			'new_item_name'     => __( 'New Genre Name' ),
			'menu_name'         => __( 'Genre' ),
		),
		'show_ui'       => true,
		'query_var'     => true,
		'rewrite'       => array( 'slug' => 'the_genre' ), // свой слаг в URL
	));

	// Добавляем НЕ древовидную таксономию 'teacher' (как метки)
	register_taxonomy('teacher', 'lesson',array(
		'hierarchical'  => false,
		'labels'        => array(
			'name'                        => _x( 'teachers', 'taxonomy general name' ),
			'singular_name'               => _x( 'teacher', 'taxonomy singular name' ),
			'search_items'                =>  __( 'Search teachers' ),
			'popular_items'               => __( 'Popular teachers' ),
			'all_items'                   => __( 'All teachers' ),
			'parent_item'                 => null,
			'parent_item_colon'           => null,
			'edit_item'                   => __( 'Edit teacher' ),
			'update_item'                 => __( 'Update teacher' ),
			'add_new_item'                => __( 'Add New teacher' ),
			'new_item_name'               => __( 'New teacher Name' ),
			'separate_items_with_commas'  => __( 'Separate teachers with commas' ),
			'add_or_remove_items'         => __( 'Add or remove teachers' ),
			'choose_from_most_used'       => __( 'Choose from the most used teachers' ),
			'menu_name'                   => __( 'teachers' ),
		),
		'show_ui'       => true,
		'query_var'     => true,
		'rewrite'       => array( 'slug' => 'the_teacher' ), // свой слаг в URL
	));
}

}
endif;
add_action( 'after_setup_theme', 'universal_theme_setup' );


/**
 * Подключение сайдбара
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function universal_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар на главной сверху', 'universal_example' ),
			'id'            => 'main-sidebar-top',
			'description'   => esc_html__( 'Добавьте виджеты сюда.', 'universal_example' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар на главной снизу', 'universal_example' ),
			'id'            => 'main-sidebar-bottom',
			'description'   => esc_html__( 'Добавьте виджеты сюда.', 'universal_example' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Меню в подвале', 'universal_example' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Добавьте меню сюда.', 'universal_example' ),
			'before_widget' => '<section id="%1$s" class="footer-menu %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-menu-title">',
			'after_title'   => '</h2>',
		)
	);
		register_sidebar(
		array(
			'name'          => esc_html__( 'Текст в подвале', 'universal_example' ),
			'id'            => 'sidebar-footer-text',
			'description'   => esc_html__( 'Добавьте Текст сюда.', 'universal_example' ),
			'before_widget' => '<section id="%1$s" class="footer-text %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
			register_sidebar(
				array(
				'name'          => esc_html__( 'Записи в подвале поста', 'universal_example' ),
				'id'            => 'sidebar-footer-posts',
				'description'   => esc_html__( 'Добавьте сюда виджет свежих записейы', 'universal_example' ),
				'before_widget' => '<section id="%1$s" class="sidebar-footer-posts %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '',
				'after_title'   => '',
		)
	);
}
add_action( 'widgets_init', 'universal_theme_widgets_init' );



/**
 * Добавление нового виджета Downloader_Widget.
 */
class Downloader_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'downloader_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: downloader_widget
			'Полезные файлы',
			array( 'description' => 'Файлы для скачивания', 'classname' => 'widget-downloader', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_downloader_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_downloader_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$description = $instance['description'];
		$link = $instance['link'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( ! empty( $description ) ) {
			echo '<p>' . $description . '</p>';
		}
		if ( ! empty( $link ) ) {
			echo '<a class="widget-link" href=">' . $link . '">
			<img class="widget-link-icon" src=" ' . get_template_directory_uri(). '/assets/images/download.svg" >
			Скачать</a>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Полезные файлы';
		$description = @ $instance['description'] ?: 'Описание';
		$link = @ $instance['link'] ?: 'http://...';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Описание:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Ссылка на файл:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_downloader_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_downloader_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Downloader_Widget

// регистрация Downloader_Widget в WordPress
function register_downloader_widget() {
	register_widget( 'Downloader_Widget' );
}
add_action( 'widgets_init', 'register_downloader_widget' );


/**
 * Добавление нового виджета Social_Widget.
 */
class Social_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'social_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: social_widget
			'Социальные сети',
			array( 'description' => 'Добавление соцсетей', 'classname' => 'widget-social', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_social_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_social_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$vkontakte = @ $instance['vkontakte'];
		$instagram = @ $instance['instagram'];
		$facebook = @ $instance['facebook'];
		$twitter = @ $instance['twitter'];
		$youtube = @ $instance['youtube'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( ! empty( $title )) {
			echo '<div class="social-link-tag">';
		}
		if ( ! empty( $vkontakte ) ) {
			echo '<a class="social-widget-link" href=">' . $vkontakte . '">
			<img class="social-widget-link-icon" src=" ' . get_template_directory_uri(). '/assets/images/vk.svg" >
			</a>';
		}
		if ( ! empty( $instagram ) ) {
			echo '<a class="social-widget-link" href=">' . $instagram . '">
			<img class="social-widget-link-icon" src=" ' . get_template_directory_uri(). '/assets/images/instagram.svg" >
			</a>';
		}
		if ( ! empty( $facebook ) ) {
			echo '<a class="social-widget-link" href=">' . $facebook . '">
			<img class="social-widget-link-icon" src=" ' . get_template_directory_uri(). '/assets/images/facebook.svg" >
			</a>';
		}
		if ( ! empty( $twitter ) ) {
			echo '<a class="social-widget-link" href=">' . $twitter . '">
			<img class="social-widget-link-icon" src=" ' . get_template_directory_uri(). '/assets/images/twitter.svg" >
			</a>';
		}
		if ( ! empty( $youtube ) ) {
			echo '<a class="social-widget-link" href=">' . $youtube . '">
			<img class="social-widget-link-icon" src=" ' . get_template_directory_uri(). '/assets/images/youtube.svg" >
			</a></div>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Наши соцсети';
		$vkontakte = @ $instance['vkontakte'] ?: 'http://...';
		$instagram = @ $instance['instagram'] ?: 'http://...';
		$facebook = @ $instance['facebook'] ?: 'http://...';
		$twitter = @ $instance['twitter'] ?: 'http://...';
		$youtube = @ $instance['youtube'] ?: 'http://...';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte' ); ?>"><?php _e( 'Ссылка Вконтакте:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'vkontakte' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte' ); ?>" type="text" value="<?php echo esc_attr( $vkontakte ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'Ссылка instagram' ); ?>"><?php _e( 'Instagram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Ссылка на Facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Ссылка на Twitter:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Ссылка на Youtube:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		$instance['vkontakte'] = ( ! empty( $new_instance['vkontakte'] ) ) ? strip_tags( $new_instance['vkontakte'] ) : '';

		$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';

		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';

		$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';

		$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_social_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_social_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Social_Widget

// регистрация Social_Widget в WordPress
function register_social_widget() {
	register_widget( 'Social_Widget' );
}
add_action( 'widgets_init', 'register_social_widget' );


/**
 * Добавление нового виджета Recent_Posts_Widget.
 */
class Recent_Posts_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'recent_posts_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: downloader_widget
			'Недавно опубликовано',
			array( 'description' => 'Последние посты', 'classname' => 'widget-recent-posts', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_recent_posts_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_recent_posts_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$count = $instance['count'];

		echo $args['before_widget'];

		
		if ( ! empty( $count ) ) {
			if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo '<div class="widget-recent-posts-wrapper">';
		global $post;
			$postslist = get_posts( array( 'posts_per_page' => $count, 'order'=> 'ASC', 'orderby' => 'title' ) );
			foreach ( $postslist as $post ){
				setup_postdata($post);
			?>
			<a href="<?php the_permalink( ) ?>" class="recent-post-link">
			<img src="<?php 
            //должно находится внутри цикла
            if( has_post_thumbnail() ) {
              echo get_the_post_thumbnail_url(null, 'homepage-thumb');
            }
            else {
              echo get_template_directory_uri( ) . '/assets/images/img-default.png';
            }
            ?>" alt="">
				<div class="recent-post-info">
					<h4><?php echo mb_strimwidth(get_the_title(), 0, 35, '...'); ?></h4>
					<span class="recent-post-time">
						<?php 
					$time_diff = human_time_diff( get_post_time('U'), current_time('timestamp') );
					echo "$time_diff назад";
					?>
					</span>
				</div>
	   		</a>
	<?php
}
wp_reset_postdata();
		}
		echo '</div>';
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Недавно опубликовано';
		$count = @ $instance['count'] ?: '7';
		$link = @ $instance['link'] ?: 'http://...';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Кол-во постов:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_recent_posts_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_recent_posts_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Recent_Posts_Widget

// регистрация Recent_Posts_Widget в WordPress
function register_recent_posts_widget() {
	register_widget( 'Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'register_recent_posts_widget' );




//подключение стилей и скриптов
function enqueue_universal_style() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
   wp_enqueue_style( 'swiper-slider', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', 'style', time());
  wp_enqueue_style( 'universal_theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style' );
  wp_enqueue_style( 'Roboto Slab', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap');

	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//code.jquery.com/jquery-3.6.0.min.js');
	wp_enqueue_script( 'jquery' );

   wp_enqueue_script( 'swiper',  get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', null, time(),true);
    wp_enqueue_script( 'scripts',  get_template_directory_uri() . '/assets/js/scripts.js', 'swiper', time(),true);
}
add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );


// Подключаем локализацию в самом конце подключаемых к выводу скриптов, чтобы скрипт
// 'twentyfifteen-script', к которому мы подключаемся, точно был добавлен в очередь на вывод.
// Заметка: код можно вставить в любое место functions.php темы
add_action( 'wp_enqueue_scripts', 'adminAjax_data', 99 );
function adminAjax_data(){

	// Первый параметр 'twentyfifteen-script' означает, что код будет прикреплен к скрипту с ID 'twentyfifteen-script'
	// 'twentyfifteen-script' должен быть добавлен в очередь на вывод, иначе WP не поймет куда вставлять код локализации
	// Заметка: обычно этот код нужно добавлять в functions.php в том месте где подключаются скрипты, после указанного скрипта
	wp_localize_script( 'jquery', 'adminAjax',
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);

}

add_action( 'wp_ajax_contacts_form', 'ajax_form' );
add_action( 'wp_ajax_nopriv_contacts_form', 'ajax_form' );
function ajax_form() {
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];
	$contact_comment = $_POST['contact_comment'];
	$message = 'Пользователь оставил' . $contact_name;
	
	$headers = 'From: Denis Korsukov <denoff.01@gmail.com>' . "\r\n";

	$send_message = wp_mail('drugdendiller@gmail.com', 'Новая заявка', $message, $headers,);
	if ($send_message) {
		echo 'OK';
	} else {
		echo 'NOT';
	}

	// выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
	wp_die();
}


//с помощью фильтра изменили настройки облака тегов
add_filter( 'widget_tag_cloud_args','edit_widget_tag_cloud_args');
function edit_widget_tag_cloud_args($args) {
	$args['unit'] = 'px';
	$args['smallest'] = '14';
	$args['largest'] = '14';
	$args['number'] = '12';
	return $args;
}

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}
if ( function_exists( 'add_image_size' ) ) {
	// add_image_size( 'category-thumb', 300, 9999 ); // 300 в ширину и без ограничения в высоту
	add_image_size( 'homepage-thumb', 65, 65, true ); // Кадрирование изображения
}
// меняем ... в отрывке
add_filter('excerpt_more', function($more) {
	return '...';
});
//склонение слов после чисел
function plural_form($number, $after) {
	$cases = array (2, 0, 1, 1, 1, 2);
	echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}