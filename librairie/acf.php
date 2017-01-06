<?php
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'ADMINISTRATION',
        'menu_title'    => 'ADMINISTRATION',
        'menu_slug'     => 'parametre-acf',
        'capability'    => 'edit_posts',
        'position'      => '62',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'INFOS ENTREPRISE',
        'menu_title'    => 'INFOS',
        'parent_slug'   => 'parametre-acf',
    ));
}
