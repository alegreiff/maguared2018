<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
//include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
//include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
//include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 128,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

/** MODIFICACIONES */


//* Enqueue sticky menu script
add_action('wp_enqueue_scripts', 'sp_enqueue_script');
function sp_enqueue_script() {
    wp_enqueue_script('sample-sticky-menu', get_bloginfo('stylesheet_directory') . '/assets/js/sticky-menu.js', array('jquery'), '1.0.0');
}
//* Reposition the secondary navigation menu
//remove_action('genesis_after_header', 'genesis_do_subnav');
//add_action('genesis_before_header', 'genesis_do_subnav');


//QUITAR TÍTULO EN PÁGINAS
add_action( 'genesis_before_entry', 'custom_remove_titles' );
/**
 * Remove entry header on static Pages.
 */
function custom_remove_titles() {
    // if we are not on a static Page, abort.
    if ( ! is_page() ) {
        return;
    }

    remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
}


//remove_action( 'genesis_after_header', 'genesis_do_nav' );
//add_action( 'genesis_before_header', 'genesis_do_nav' );


//Desregistrar layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//Quitar widget secondary sidebar
unregister_sidebar( 'sidebar-alt' );


    //Agregar widget areas
//include_once( get_stylesheet_directory() . '/includes/widget-areas.php');

/** ENSAYO */
	/*add_action('genesis_meta', 'config_home_page_setup');

	function config_home_page_setup(){
		$inicio_sidebars = array(
			'bienvenida' => is_active_sidebar( 'bienvenida' ),
		);

		if ( ! in_array ( true, $inicio_sidebars ) ) {
			return;
		}

		if ( $inicio_sidebars['bienvenida']){
			add_action ('genesis_before_header', 'config_agrega_home_bienvenida');
		}
	}*/

/**
 * Muestra el widget bienvenida en la página
 */
	/*function config_agrega_home_bienvenida(){
		genesis_widget_area ( 'bienvenida', array(
			'before' => '<div class="bienvenida"><div class="interno">',
			'after' => '</div></div>',
		));
	}*/

//* Remove site header elements

//remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
//remove_action( 'genesis_header', 'genesis_do_header' );
//remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

/** FIN ENSAYO */

/* QUITAR LOGO HEADER */
//remove_action( 'genesis_site_title', 'genesis_seo_site_title' );


/** Register Utility Bar Widget Areas. */

/*
genesis_register_sidebar( array(
	'id' => 'utility-bar-left',
	'name' => __( 'Utility Bar Left', 'theme-prefix' ),
	'description' => __( 'This is the left utility bar above the header.', 'theme-prefix' ),
   ) );
   genesis_register_sidebar( array(
	'id' => 'utility-bar-right',
	'name' => __( 'Utility Bar Right', 'theme-prefix' ),
	'description' => __( 'This is the right utility bar above the header.', 'theme-prefix' ),
   ) );

   add_action( 'genesis_before_header', 'utility_bar' );
   function utility_bar() {
	
	echo '<div class="utility-bar"><div class="wrap">';
	
	genesis_widget_area( 'utility-bar-left', array(
	'before' => '<div class="utility-bar-left">',
	'after' => '</div>',
	) );
	
	genesis_widget_area( 'utility-bar-right', array(
	'before' => '<div class="utility-bar-right">',
	'after' => '</div>',
	) );
	
	echo '</div></div>';
	
   }
   */


/**
 * @author Brad Dalton WP Sites
 * @example http://wp.me/p1lTu0-9VA
 */
/*
genesis_register_sidebar( array(
    'id'              		=> 'header-left',
    'name'         	 	=> __( 'Header Left', 'wpsites' ),
    'description'  	=> __( 'Header left widget area', 'wpsites' ),
) );

add_action( 'genesis_before_header', 'wpsites_left_header_widget', 11 );
	function wpsites_left_header_widget() {
	if (is_active_sidebar( 'header-left' ) ) {
 	genesis_widget_area( 'header-left', array(
		'before' => '<div class="header-left">',
		'after'  => '</div>',
	) );
}}

*/

function the_category_filter($thelist,$separator='') {
	if(!defined(‘WP_ADMIN’)) {
		//Category IDs to exclude
		$exclude = array(28);

		$exclude2 = array();
		foreach($exclude as $c) {
			$exclude2[] = get_cat_name($c);
		}

		$cats = explode($separator,$thelist);
		$newlist = array();
		foreach($cats as $cat) {
			$catname = trim(strip_tags($cat));
			if(!in_array($catname,$exclude2))
				$newlist[] = $cat;
		}
		return implode($separator,$newlist);
	} else {
		return $thelist;
	}
}
add_filter('the_category','the_category_filter', 10, 2);


remove_action('genesis_site_description', 'genesis_seo_site_description');
remove_action('genesis_site_title', 'genesis_seo_site_title');



//* Customize search form input box text
add_filter( 'genesis_search_text', 'mash_search_text' );
function mash_search_text( $text ) {
    return esc_attr( 'Buscar en MaguaRED' );
}




/*BÚSQUEDA*/
add_action( 'wp_enqueue_scripts', 'b3m_enqueue_dashicons' );
function b3m_enqueue_dashicons() {
    wp_enqueue_style( 'dashicons' );
}

add_filter( 'genesis_search_button_text', 'b3m_search_button_dashicon' );
function b3m_search_button_dashicon( $text ) {
    return esc_attr( '&#xf179;' );

}


add_filter( 'wp_nav_menu_items', 'theme_menu_extras', 10, 2 );
/**
 * Filter menu items, appending either a search form or today's date.
 *
 * @param string   $menu HTML string of list items.
 * @param stdClass $args Menu arguments.
 *
 * @return string Amended HTML string of list items.
 */
function theme_menu_extras( $menu, $args ) {
    //* Change 'primary' to 'secondary' to add extras to the secondary navigation menu
    if ( 'secondary' !== $args->theme_location )
        return $menu;
    //* Uncomment this block to add a search form to the navigation menu

    ob_start();
    get_search_form();
    $search = ob_get_clean();
    $menu  .= '<li class="right search">' . $search . '</li>';

    //* Uncomment this block to add the date to the navigation menu

    $menu .= '<li class="right date">' . date_i18n( get_option( 'date_format' ) ) . '</li>';

    return $menu;
}