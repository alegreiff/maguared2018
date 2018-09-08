<?php
get_template_part( 'loop', 'archive' );



add_filter( 'sidebars_widgets', 'my_sidebar_widgets_filter', 9 );
function my_sidebar_widgets_filter( $widgets ) {
    if ( ! function_exists( 'Genesis_Simple_Sidebars' ) ) return $widgets;
    /*if ( is_post_type_archive( 'myposttype' ) || is_singular( 'myposttype' ) ) {*/
        $sidebars = array(
            'sidebar'      => 'sidebar-noticias',
        );
        $widgets = Genesis_Simple_Sidebars()->core->swap_widgets( $widgets, $sidebars );
    /*}*/
    return $widgets;
}

genesis();