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
    
<div class="banniere">
    <div class="grid">
        <img src="<?php bloginfo("template_directory"); ?>/images/agexia.png" alt="<?php bloginfo("name"); ?>" width="199" height="174">
        <div class="nav_rap">
            <?php
                if( have_rows('lien_page_rapide') ): ?>
            <ul>
            <?php 
            while( have_rows('lien_page_rapide') ): the_row();
            // vars
                $titre = get_sub_field('titre_menu');
                $link = get_sub_field('lien_page_menu');
                ?>
                <li>
                    <a href="<?php echo $link; ?>" title=" <?php echo $titre; ?>" ><?php echo $titre; ?></a>
                </li>
            <?php endwhile; ?>
            </ul>
            <?php endif; ?>
         </div>
    </div>
</div>
</div>
<?php endif; ?>

<div class="site-content">
    <div class="grid">
        <div class="bloc_violet">
            <div class="trait">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h1><?php echo the_title(); ?></h1>
                <?php echo the_content(); ?>
            <?php endwhile; endif;?>
            </div> 
        </div>
        <h2 class="center under">Notre métier</h2>
    </div>
<div class="full">
    <div class="half agexia_f">
        <div class="content right">
            <h2>Informations</h2>
            <p>Agexia vous fait bénéficier de ses conseils de professionnel et de son expérience</p>
            <span class="sep_trait"></span>
            <ul>
                <li>Dans quelles conditions un administrateur provisoire doit-il être désigné ?</li>
                <li>Comment les tantièmes sont-ils définis ?</li>
                <li>Comment la réglementation définit-elle les prestations du syndic ?</li>
                <li>Les étapes d’une démission de syndic</li>
                <li>Comment les tantièmes sont-ils définis ?</li>
                <li>Faut-il donner quitus au syndic ?</li>
                <li>Les copropriétaires peuvent-ils décider la révocation du syndic ?</li>
                <li>Qui compose le syndic ?</li>
            </ul>
        </div>
    </div>
    <div class="half">
        <div class="content left">
            <h2>Informations</h2>
            <p>Agexia vous fait bénéficier de ses conseils de professionnel et de son expérience</p>
            <ul>
                <li>Dans quelles conditions un administrateur provisoire doit-il être désigné ?</li>
                <li>Comment les tantièmes sont-ils définis ?</li>
                <li>Comment la réglementation définit-elle les prestations du syndic ?</li>
                <li>Les étapes d’une démission de syndic</li>
                <li>Comment les tantièmes sont-ils définis ?</li>
                <li>Faut-il donner quitus au syndic ?</li>
                <li>Les copropriétaires peuvent-ils décider la révocation du syndic ?</li>
                <li>Qui compose le syndic ?</li>
            </ul>
        </div>
    </div>
</div>       
</div> 
<?php get_footer(); ?>