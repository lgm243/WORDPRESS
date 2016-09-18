<?php get_header(); ?>
<?php $term = get_term_by('slug',get_query_var('term'),get_query_var('taxonomy')); ?>
<?php if(have_posts()) : while(have_posts()) : the_post();
$terms =  get_the_terms( $post->ID, 'categorie_ref' );
if ( !empty( $terms ) ) {
      $term_class =   array();
      foreach ( $terms as $term ) {
      $term_class[] = $term->name;
      }
      $termfolio = join( " ", $term_class);
}
?>
<a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" >
<?php echo get_the_post_thumbnail( $post->ID, 'galery', array('class' => ''));;  ?>
<span><?php the_title(); ?></span>
<span><?= $termfolio; ?></span>     
<?php endwhile; endif; wp_reset_query(); ?>
<?php get_footer(); ?>