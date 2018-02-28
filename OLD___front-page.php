<?php
/**
 * Front Page template
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */
add_action('genesis_meta', 'config_home_page_setup');

function config_home_page_setup(){
    $inicio_sidebars = array(
        'bienvenida' => is_active_sidebar( 'bienvenida' ),
        //'call-to-action' => is_active_sidebar( 'call-to-action' ),
    );

    if ( ! in_array ( true, $inicio_sidebars ) ) {
        return;
    }
    
    if ( $inicio_sidebars['bienvenida']){
        add_action ('genesis_before_header', 'config_agrega_home_bienvenida');
    }
    /*if ( $inicio_sidebars['call-to-action']){
        add_action ('genesis_after_header', 'config_agrega_home_call');
    }*/
}

/**
 * Muestra el widget bienvenida en la página
 */
function config_agrega_home_bienvenida(){
    genesis_widget_area ( 'bienvenida', array(
        'before' => '<div class="bienvenida"><div class="interno">',
        'after' => '</div></div>',
    ));
}

/*function config_agrega_home_call(){
    genesis_widget_area ( 'call-to-action', array(
        'before' => '<div class="call-to-action"><div class="wrap">',
        'after' => '</div></div>',
    ));
}*/

//* Remove site header elements
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

genesis();