<?php

/* APPEL FUNCTION*/
    require(TEMPLATEPATH . '/librairie/acf.php');
    require(TEMPLATEPATH . '/librairie/gestion-admin.php');
    require(TEMPLATEPATH . '/librairie/core-wordpress.php');
    require(TEMPLATEPATH . '/librairie/contact/contact.php');

/* JQUERY CSS*/
function wpEnqueueScripts(){
    wp_deregister_script('jquery');
    wp_register_script('lgm_js', get_template_directory_uri() . '/main.min.js','','1',true);
    wp_enqueue_script('lgm_js');
    if(is_page_template( 'page-contact.php' ) ){
    wp_enqueue_script('Google maps','http://maps.googleapis.com/maps/api/js?key=AIzaSyAkOS5wPh_4SYyfpZV5NxkT3FOVeY-iHXM','','',true);
    }
    wp_register_style('style', get_bloginfo( 'stylesheet_directory' ) . '/style.min.css','',false,'screen');
    wp_enqueue_style( 'style' );
}
add_action('wp_enqueue_scripts', 'wpEnqueueScripts');

/*ajout balise title dans header*/
function wpc_theme_support() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'wpc_theme_support' );

/*Retire version script*/
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );


/*MENU*/
register_nav_menus(array(
'main-menu' => 'Menu Principal',

));

/* AJOUT TAILLE IMAGE*/
add_theme_support( 'post-thumbnails' );
if (function_exists('add_image_size')){
    /*add_image_size( 'bandeau', 9999,  600, true );*/
}



