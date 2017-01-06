<?php
/*Activation des màj autos majeures*/
add_filter( 'allow_major_auto_core_updates', '__return_true' );

/*Activation des màj autos des plugins*/
add_filter( 'auto_update_plugin', '__return_true' );

/*EDITEUR par default*/
add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );

/*REMOVE STYLE GALLERY WORDPRESS*/
add_filter( 'use_default_gallery_style', '__return_false' );

/* suppression de la colonne "commentaires" sur la liste des pages */
function lgm_remove_commentspage_column($defaults) {
    unset($defaults['comments']);
    return $defaults;
}
add_filter( 'manage_pages_columns', 'lgm_remove_commentspage_column');

/*SUPPRIME LES COMMENTAIRES**/
function wpc_comments_closed( $open, $post_id ) {
    $post = get_post( $post_id );
    $open = false;
    return $open;
}
add_filter('comments_open', 'wpc_comments_closed', 10, 2);
/* suppression de la colonne "commentaires" sur la liste des articles */
function lgm_remove_commentsart_column($defaults) {
    unset($defaults['comments']);
    return $defaults;
}
add_filter( 'manage_posts_columns', 'lgm_remove_commentsart_column');


/*RETIRER LES ETIQUETTES ARTICLES*/
/* suppression de la metabox des tags et des formats sur la page d'ajout/edition de posts */
function lgm_remove_tags_metabox() {
    remove_meta_box('tagsdiv-post_tag', 'post', 'side');
}
add_action('admin_menu', 'lgm_remove_tags_metabox');
/* suppression de la colonne "Mots-clefs" sur la liste des articles */
function lgm_remove_tags_column($defaults) {
    unset($defaults['tags']);
    return $defaults;
}
add_filter( 'manage_posts_columns', 'lgm_remove_tags_column');
/* suppression du menu "Mots-clefs" */
function lgm_remove_tags_menu() {
    global $submenu;
    unset($submenu['edit.php'][16]);
}
add_action('admin_head', 'lgm_remove_tags_menu');


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

/* GESTION get_header()*/
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
