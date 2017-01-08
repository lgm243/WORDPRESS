<?php
/*
Template Name: page-accueil
*/
?>
<?php get_header(); ?>
<?php if( has_post_thumbnail()) {
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(),'large');
}
?>
<?php if ( $large_image_url ) : ?>
<div class="fond" style="background-image:url(<?php  echo $large_image_url[0] ?>);">
    
<?php get_footer(); ?>
