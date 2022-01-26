<?php
/**
 * kia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kia
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'kia_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kia_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on kia, use a find and replace
		 * to change 'kia' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kia', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'kia' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'kia_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'kia_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kia_content_width', 640 );
}
add_action( 'after_setup_theme', 'kia_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kia_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'kia' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'kia' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'kia_widgets_init' );

/**
 * Register Menus
 */
add_action( 'after_setup_theme', 'theme_register_nav_menu' );
function theme_register_nav_menu() {
	register_nav_menu( 'footer-menu-1', 'Footer Menu 1' );
	register_nav_menu( 'footer-menu-2', 'Footer Menu 2' );
	register_nav_menu( 'footer-menu-3', 'Footer Menu 3' );
	register_nav_menu( 'footer-menu-4', 'Footer Menu 4' );
}

add_filter( 'nav_menu_css_class', 'add_my_class_to_nav_menu', 10, 2 );
function add_my_class_to_nav_menu( $classes, $item ){
	/* $classes содержит
	Array(
		[1] => menu-item
		[2] => menu-item-type-post_type
		[3] => menu-item-object-page
		[4] => menu-item-284
	)
	*/
	$classes[] = 'underlined';

	return $classes;
}

/**
 * Enqueue scripts and styles.
 */

function kia_scripts() {
	wp_enqueue_style( 'kia-style', get_template_directory_uri() . '/dist/css/style.min.css', array(), _S_VERSION );
	
	wp_enqueue_script( 'kia-scripts', get_template_directory_uri() . '/dist/js/app.min.js', [], _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'kia_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * KIA Gutenberg blocks.
 */
require get_template_directory() . '/blocks/block-registration.php';

/**
 * KIA Menu blocks.
 */
require get_template_directory() . '/menu/menu.php';

/**
 * Dalacode functions.
 */
require get_template_directory() . '/inc/dalacode-functions.php';

/**
 * Kama Breadcrumbs
 */
require get_template_directory() . '/inc/kama-breadcrumbs.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * dalacode custom routes for REST API
 */
require get_template_directory() . '/inc/rest-api-routes.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// SVG Support
add_filter( 'upload_mimes', 'svg_upload_allow' );
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}
add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	else
		$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if( $dosvg ){

		// разрешим
		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		// запретим
		else {
			$data['ext'] = $type_and_ext['type'] = false;
		}

	}

	return $data;
}
// SVG Support

// Admin bar bottom
function lwp_4056_bottom_admin_bar() { ?>
<style>
	div#wpadminbar {
		top: auto;
		bottom: 0;
		position: fixed;
	}
	.ab-sub-wrapper {
		bottom: 32px;
	}
	html[lang] {
		margin-top: 0 !important;
		margin-bottom: 32px !important;
	}
	@media screen and (max-width: 782px){
		.ab-sub-wrapper {
			bottom: 46px;
		}
		html[lang] {
			margin-bottom: 46px !important;
		}
	}
</style>
<?php }
function lwp_4056_check_username() {
	if(is_admin()) return;
	$user = wp_get_current_user();
	if($user && isset($user->user_login)) {
		// Remove extra conditions after $user from above to apply for everyone
		add_action('wp_head', 'lwp_4056_bottom_admin_bar', 100);
	}
}
add_action('init', 'lwp_4056_check_username');
// Admin bar bottom

// Add Options Page
add_action('acf/init', 'acf_theme_options');
function acf_theme_options() {
	if( function_exists('acf_add_options_page') ) {
		
		$general_settings = acf_add_options_page([
			'page_title' => 'Настройки сайта',
			'menu_title' => 'Настройки сайта',
			'menu_slug' => 'theme-options',
			'redirect' => false
		]);
		
		$header_settings = acf_add_options_page([
			'page_title' => 'Настройка шапки',
			'menu_title' => 'Настройка шапки',
			'menu_slug' => 'theme-header',
			'parent_slug' => $general_settings['menu_slug']
		]);
		
		$main_slider_settings = acf_add_options_page([
			'page_title' => 'Главная страница',
			'menu_title' => 'Главная страница',
			'menu_slug' => 'main-page',
			'parent_slug' => $general_settings['menu_slug']
		]);
		
	}
}
// Add Options Page

// CF7 Filters
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});
// CF7 Filters

// Columns for configs list
// создаем новую колонку
add_filter( 'manage_'.'configs'.'_posts_columns', 'add_views_column', 4 );
function add_views_column( $columns ){
	$num = 2; // после какой по счету колонки вставлять новые

	$new_columns = array(
		'model' => 'Модель',
	);

	return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}
add_action('manage_'.'configs'.'_posts_custom_column', 'fill_views_column', 5, 2 );
function fill_views_column( $colname, $post_id ){
	if( $colname === 'model' ){
		$model_names = wp_get_post_terms($post_id, 'model');

		foreach ($model_names as $name) {
			echo $name->name;
		}
	}
}
add_filter( 'manage_'.'edit-configs'.'_sortable_columns', 'add_views_sortable_column' );
function add_views_sortable_column( $sortable_columns ){
	$sortable_columns['model'] = [ 'model_model', false ]; 
											   // false = asc (по умолчанию)
											   // true  = desc

	return $sortable_columns;
}
// Columns for configs list

// Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter( 'get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){

	return '
	<nav class="navigation mt-60 %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

add_filter( 'pre_get_document_title', function( $title ) {
	if (isset($_GET['current_model'])) {
		$model = new WP_Query([
			'post_type' => 'models',
			'post_parent' => 0,
			'name' => $_GET['current_model']
		]);
		
		$current_model = $model->posts[0];
		
		$title = 'Kia' . ' ' . $current_model->post_title . ' ' . $title;
	}
    return $title;
}, 999, 1 );

// function wp_maintenance_mode() {
// 	if (!current_user_can('edit_themes') || !is_user_logged_in()) {
// 		wp_die('<h1>На обслуживании</h1><br />Сайт находится на плановом обслуживании. Пожалуйста, зайдите позже.');
// 	}
// }
// add_action('get_header', 'wp_maintenance_mode');
