<?php
//MISE A JOUR AUTOMATIQUE
// Activation des màj autos majeures
add_filter( 'allow_major_auto_core_updates', '__return_true' );
// Activation des màj autos des plugins
add_filter( 'auto_update_plugin', '__return_true' );

//supp version wordpress dans le head
remove_action('wp_head', 'wp_generator');

//AJOUT MENU APPARENCE ROLE EDITEUR
function add_theme_caps() {
    $role = get_role( 'editor' );
    $role->add_cap( 'edit_theme_options' );
}
add_action( 'admin_init', 'add_theme_caps');
//Remove top level admin menus
add_action( 'admin_menu', 'remove_admin_menus' );
add_action( 'admin_menu', 'remove_admin_submenus' );

function remove_admin_menus() {
    global $current_user;
    $current_user = wp_get_current_user();
    if($current_user->user_level < 10){
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'link-manager.php' );
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'plugins.php' );
        //remove_menu_page( 'users.php' );
        remove_menu_page( 'options-general.php' );
        //remove_menu_page( 'upload.php' );
        remove_menu_page( 'edit.php' );
        //remove_menu_page( 'edit.php?post_type=page' );
        //remove_menu_page( 'themes.php' );
    }
}

//Remove sub level admin menus
function remove_admin_submenus() {
    global $current_user;
    wp_get_current_user();
    if($current_user->user_level < 10){
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'themes.php', 'themes.php' );
    //remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
    //remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
    //remove_submenu_page( 'edit.php', 'post-new.php' );
    //remove_submenu_page( 'themes.php', 'nav-menus.php' );
    remove_submenu_page( 'themes.php', 'widgets.php' );
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
    remove_submenu_page( 'plugins.php', 'plugin-install.php' );
    //remove_submenu_page( 'users.php', 'users.php' );
    remove_submenu_page( 'users.php', 'user-new.php' );
    //remove_submenu_page( 'upload.php', 'media-new.php' );
    remove_submenu_page( 'options-general.php', 'options-writing.php' );
    remove_submenu_page( 'options-general.php', 'options-discussion.php' );
    remove_submenu_page( 'options-general.php', 'options-reading.php' );
    remove_submenu_page( 'options-general.php', 'options-discussion.php' );
    remove_submenu_page( 'options-general.php', 'options-media.php' );
    remove_submenu_page( 'options-general.php', 'options-privacy.php' );
    remove_submenu_page( 'options-general.php', 'options-permalinks.php' );
    remove_submenu_page( 'index.php', 'update-core.php' );
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
}
}



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