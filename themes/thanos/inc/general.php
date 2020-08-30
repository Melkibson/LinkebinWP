<?php
if ( ! function_exists( 'thanos_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thanos_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thanos, use a find and replace
		 * to change 'thanos' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'thanos', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'thanos' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'thanos_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'thanos_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thanos_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'thanos_content_width', 640 );
}
add_action( 'after_setup_theme', 'thanos_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

// SMTP Authentication

add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host       = SMTP_HOST;
	$phpmailer->SMTPAuth   = SMTP_AUTH;
	$phpmailer->Port       = SMTP_PORT;
	$phpmailer->Username   = SMTP_USER;
	$phpmailer->Password   = SMTP_PASS;
	$phpmailer->SMTPSecure = SMTP_SECURE;
	$phpmailer->From       = SMTP_FROM;
	$phpmailer->FromName   = SMTP_NAME;
}

function strip_and_trim($string){
	return strip_tags(trim($string));
}

// Set Content Type

add_filter('wp_mail_content_type', 'set_content_type');
function set_content_type(){
	return "text/html";
}

// Rewrite rule for nicer url
add_action('init', 'change_profile_url');
function change_profile_url(){
	global $wp_rewrite;
	$wp_rewrite->author_base = 'profile';
	$wp_rewrite->flush_rules();
}

add_filter('query_vars', 'profile_query_vars');
function profile_query_vars($vars) {
	// add lid to the valid list of variables
	$new_vars = array('profile');
	$vars = $new_vars + $vars;
	return $vars;
}

add_filter('generate_rewrite_rules','profile_rewrite_rules');
function profile_rewrite_rules( $wp_rewrite ) {
	$new_rules = array();
	$new_rules['profile/(\d*)$'] = 'index.php?author=$matches[1]';
	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('init', 'add_city');
function add_city(){
	$city_name = get_post_meta(get_the_ID(), '_data_name', true);
	$city_region = get_post_meta(get_the_ID(), '_data_region', true);
	$city_county = get_post_meta(get_the_ID(), '_data_county', true);


	$url = 'http://localhost:8000/addCity';
	wp_remote_post($url, array(
		'method' => 'POST',
		'headers'     => array(),
		'body'        => array(
			'name' => $city_name,
			'region' => $city_region,
			'departement' => $city_county
		),

	));
}

add_action('admin_footer', 'add_bin_button');
function add_bin_button(){
	echo '<script>
		$(function () {
            $("body.post-type-ville.wrap.h1").append(\'<label for="add_bin">Mettre a jour les poubelles</label><input type="submit" id="add_bin" name="add_bin">\');
        });
	</script>';
}

/**
 * Enqueue scripts and styles.
 */
function thanos_scripts() {
	// //Main JS
	// wp_register_script( 'main-js', get_template_directory_uri() . '/assets/js/script.js', false, NULL, true);
	// wp_enqueue_script( 'main-js');

	//Mapbox
	wp_enqueue_style( 'mapbox-css', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css' );
	wp_enqueue_style( 'mapbox-gl-css', 'https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css' );
	//wp_enqueue_style('mapbox-gl-directions-css', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.css');


	wp_enqueue_style( 'thanos-style', get_template_directory_uri() . '/assets/css/home.min.css' );
}

add_action( 'wp_enqueue_scripts', 'thanos_scripts' );

//function damaged($idbin, $iduser){
//    $damaged = true;
//    $url = 'http://localhost:8000/AddReportHistoric/' . $idbin . '/' . $iduser . '/' . $damaged;
//    wp_remote_get($url);
//}
//
//add_action("init", "damaged");

/**
 * Enqueue admin scripts and styles
 */