<?php
/**
 * Template Name: Plantilla secciones MaguaRED
 * Description: Plantilla que permite mostrar cada una de las secciones principales de MaguaRED
 */
// Add our custom loop
$categorias_paginas = array
(
    array('pagina' => 14333, 'nombre' => 'Lenguajes expresivos', 'categoria' => 1709),
    array('pagina' => 14337, 'nombre' => 'Derechos culturales', 'categoria' => 1710),
    array('pagina' => 14340, 'nombre' => 'Recursos Maguaré', 'categoria' => 1712),
    array('pagina' => 14339, 'nombre' => 'Crianza', 'categoria' => 1711),
    array('pagina' => 15060, 'nombre' => 'Recomendados', 'categoria' => 1713),
    array('pagina' => 14323, 'nombre' => 'Noticias', 'categoria' => 1708)
);

function busca_pagina_id($id, $array) {
    foreach ($array as $key => $val) {
        if ($val['pagina'] === $id) {
            return $array[$key];
        }
    }
    return null;
}
$page_id = get_queried_object_id();
$id = busca_pagina_id($page_id, $categorias_paginas);
$categoria = $id['categoria'];
$nombre_seccion = $id['nombre'];
add_action('genesis_entry_header', 'titulo_seccion', 4);
function titulo_seccion(){
    global $nombre_seccion;
    echo '<h2>'.$nombre_seccion.'</h2>';

}


add_action( 'genesis_before_entry_content', 'escribe_subcategorias', 5 );
function escribe_subcategorias() {
    global $categoria;
    if ( ! is_singular('page')){
        return;
    }else{
        $categories=get_categories(
            array( 'parent' => $categoria)
        );
        echo '<ul class="seccion-lista-subcategorias">';
        $url = get_option( 'siteurl' );
        d($url);
        foreach ($categories as $c) {
            d($c);
            echo '<li>'.'<a href="'.get_category_link( $c->term_id ).'" title="'.$c->description.'">'.$c->cat_name.'</li>';
            //echo '<li>'.'<a href="'.$url.'/'.$c->slug.'" title="'.$c->description.'">'.$c->cat_name.'</li>';
        }
        echo '</ul>';
    }
}

genesis();