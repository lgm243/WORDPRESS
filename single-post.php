<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<article  id="post-<?php the_ID(); ?>"  itemscope itemtype="http://schema.org/NewsArticle">

<div class="site-content">
<div class="box">
    <div class="left_col">
        <div class="wp1">
            <meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>
            <a class="back" href="actu">
                <svg version="1.1" baseProfile="tiny" id="Calque_1"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 55.7 57"
     xml:space="preserve">
<rect x="0.1" y="0.1"  stroke-miterlimit="10" width="24.3" height="24.8"/>
<rect x="31.3" y="0.1"  stroke-miterlimit="10" width="24.3" height="24.8"/>
<rect x="0.1" y="32.1"  stroke-miterlimit="10" width="24.3" height="24.8"/>
<rect x="31.3" y="32.1"  stroke-miterlimit="10" width="24.3" height="24.8"/>
</svg>
retour aux articles
           </a>
            <h1 itemprop="headline"><?php the_title(); ?></h1>
            <div itemprop="the_content articleBody">
                <?php the_content(); ?>
            </div>
            <div class="infos_article">
                <time datetime="<?php the_time('c'); ?>" itemprop="datePublished">Publié le <?php echo the_time('d/m/Y'); ?></time>
                <?php if (get_the_modified_time() != get_the_time()) { ?>
                <time datetime="<?php the_modified_time('c'); ?>" itemprop="dateModified"></time>
                <?php } ?>
                <span class="cat">
                Catégorie :
                   <?php
                    foreach (get_the_category() as $category){
                    $cat = $category->cat_name;
                    $idcat = $category->cat_ID;
                ?><a itemprop="about" href="<?php echo get_category_link($idcat); ?>"><?php echo $cat ?></a>
                <?php } ?>
                </span>

        </div>
<?php //TAGS WORDPESS
            $post_tags = get_the_tags();  if($post_tags) { ?>
                <div class="tag">
                Tag :
                <?php foreach ( $post_tags as $tags){
                        $tag= $tags->name;
                        $idtag= $tags->term_id;
                         ?>
                         <a rel="tag" itemprop="keywords" href="<?php echo esc_url(get_tag_link($idtag)); ?>"><?php echo $tag ?></a>
                <?php } ?>
                     </div>
            <?php }?>
    </div>
</div>
        <?php if( has_post_thumbnail()) {
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
        }
        ?>
        <div class="right_col">
        <div class="wp1">
        <?php   // si auteur définie
            if ( get_the_author_meta( 'description' ) ) { ?>
                    <div class="auteur" itemprop="author" itemscope itemtype="http://schema.org/Person">
                        <div class="avatar">
                        <?php echo wp_get_attachment_image(get_field('photo_de_profil','option')); ?>
                        </div><!-- #author-avatar -->
                        <div class="auteur-description">
                            <h2><a href="<?= home_url(); ?>" itemprop="url"><span itemprop="name"><?php echo get_the_author(); ?></span></a></h2>
                            <p itemprop="description"><?php echo nl2br(the_author_meta('description'));?></p>
                        </div>

                     </div>
            <?php  } ?>
        </div>
        <a href="<?= home_url(); ?>/contacter-avocat-paris" class="rens">Besoin d'un renseignement<br>CONTACTEZ MOI</a>
        </span>
        </div>
        </article>
<?php endwhile; endif; wp_reset_query(); ?>
<?php get_footer(); ?>