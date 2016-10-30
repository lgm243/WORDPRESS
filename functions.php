<?php

/* APPEL FUNCTION*/
    require(TEMPLATEPATH . '/librairie/acf.php');
    require(TEMPLATEPATH . '/librairie/gestion-admin.php');
    require(TEMPLATEPATH . '/librairie/contact/contact.php');


/*define('DISALLOW_FILE_EDIT',true);*/

/*Masque les erreurs de connexion*/
add_filter('login_errors',create_function('$a', "return 'Erreur';"));

// 3) Masque les erreurs de connexion
add_filter('login_errors',create_function('$a', "return 'Erreur';"));
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head');        
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);   
add_filter('the_generator', '__return_false');         
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* JQUERY CSS*/
function wpEnqueueScripts(){
    wp_deregister_script('jquery');
    wp_register_script('lgm_js', get_template_directory_uri() . '/main.min.js','','1',true);
    wp_enqueue_script('lgm_js');
    if(is_page_template( 'page-contact.php' ) ){
    wp_enqueue_script('Google maps','http://maps.googleapis.com/maps/api/js?key=AIzaSyAkOS5wPh_4SYyfpZV5NxkT3FOVeY-iHXM','','',true);
    }
}
add_action('wp_enqueue_scripts', 'wpEnqueueScripts');


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

/*editeur par default*/
add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );

/*lire la suite*/
function wpdocs_excerpt_more( $more ) {
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Lire la suite ...', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/* AJOUT TAILLE IMAGE*/
add_theme_support( 'post-thumbnails' );
if (function_exists('add_image_size')){
    /*add_image_size( 'bandeau', 9999,  600, true );*/
}

/*REMOVE STYLE GALLERY WORDPRESS*/
add_filter( 'use_default_gallery_style', '__return_false' );

/*SUPPRIME LES COMMENTAIRES**/
add_filter('comments_open', 'wpc_comments_closed', 10, 2);
function wpc_comments_closed( $open, $post_id ) {
    $post = get_post( $post_id );
    $open = false;
    return $open;
}

/*PAGINATION*/
function custom_pagination($numpages = '', $pagerange = '', $paged='') {
  if (empty($pagerange)) {
    $pagerange = 2;
  }
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('Previous'),
    'next_text'       => __('Next'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
      echo "<div class='pagination'>";
      echo "<span class='pages'>Page " . $paged . " sur " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</div>";
  }
}
