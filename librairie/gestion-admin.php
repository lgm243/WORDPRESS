<?php
/**
* Rôle éditeur
*Gestion Capacité Eduteur
**/
 
 /*Gestion Capacité Eduteur*/
    function wpcodex_set_editor_capabilities() {
        if (current_user_can('editor')) {
            $editor = get_role( 'editor' );
            // liste des capacités a ajouter.

            // liste des capacités a retirer.
            $caps = array(
            
                'manage_links'
               
            );

            foreach ( $caps as $cap ) {
            
                // sup.
                $editor->remove_cap( $cap );
            }
        }
    }
    add_action( 'init', 'wpcodex_set_editor_capabilities' );

    /*Suppression menu et sous menu*/
    function wpcodex_edit_editor_menu() {
        if( current_user_can('editor')) {
            /*MENU*/
            remove_menu_page( 'tools.php' );
            remove_menu_page( 'themes.php' );
            remove_menu_page( 'edit-comments.php' );
            /*SOUSMENU*/

            /*AJOUT NOUVEAU BOUTON MENU*/
            add_menu_page( 'Menu', 'Menu', 'edit_pages', 'nav-menus.php', '', 'dashicons-menu', 61);
        }
    }
    add_action( 'admin_menu', 'wpcodex_edit_editor_menu' );
    /*Suppression icone admin*/
    function wpcodex_edit_adminbar() {
        if (current_user_can('editor')) {
            global $wp_admin_bar;
            $wp_admin_bar->remove_node('customize');
            $wp_admin_bar->remove_node('comments');
            $wp_admin_bar->remove_menu('wp-logo');
        }
    }
    add_action( 'wp_before_admin_bar_render', 'wpcodex_edit_adminbar' );




//supprimer dashbord article ... + logo wordpress
function sf_admin_head() {
    $blog_url = get_bloginfo('url');
    $templ_url = get_bloginfo('template_url');
    echo '<link rel="shortcut icon" href="'.$blog_url.'/favicon.ico" />';
    echo '<link rel="apple-touch-icon" href="'.$blog_url.'/apple-touch-icon.png"/>';
    echo '<style type="text/css">#wp-admin-bar-wp-logo,#wp-admin-bar-comments,
    #wp-admin-bar-new-content,#wp-admin-bar-wpseo-menu,
    .versions,.table_discussion,.b.b-posts,.t.posts,.b.b-cats,.t.cats,.b.b-tags,.t.tags{display:none;}
.inside {overflow: hidden;}
    </style>';
}
add_action('admin_head', 'sf_admin_head');



//supprimer fonction dashboard
function disable_default_dashboard_widgets() {
    //remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_activity', 'dashboard', 'core');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    remove_meta_box('dashboard_primary', 'dashboard', 'core');          // Autres news WordPress
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');            // News WordPress
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

//AJOUT TABLEAU LGMCREATION
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'LIENS UTILES', 'custom_dashboard_help');
}

function custom_dashboard_help() {
echo '<p>
Statistiques google analytics :
<a href="https://www.google.com/analytics/web/?hl=fr&pli=1#dashboard/4TbOl2kGTWmAjtRq3Mqw7A/a72173537w109804849p114487561/" target="_blank">Stats</a>
</p>';
}

?>
