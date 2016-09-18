<?php get_header();?>
<h1><?php single_cat_title( '', true ); ?></h1>
<?php echo category_description();?>
 <?php
  if(have_posts()) : while(have_posts()) : the_post();
?>
<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
<?php echo wp_trim_excerpt(); ?>
<time datetime="<?php the_time('c'); ?>" itemprop="datePublished">Publié le <?php echo the_time('d/m/Y'); ?></time>
<?php
foreach (get_the_category() as $category){
$cat = $category->cat_name;
$idcat = $category->cat_ID;
if($idcat != 1){?>
<a href="<?php echo get_category_link($idcat); ?>"><?php echo $cat ?></a>
 <?php }} ?>
 <?php endwhile; endif;?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>