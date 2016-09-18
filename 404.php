<?php get_header(); ?>
<div class="site-content">
<div class="box">
    <div class="left_col">
        <div class="the_content wp1">
            <h1> Erreur cette page n'existe pas</h1>
            </div>
        </div>
        <?php if( has_post_thumbnail()) {
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
        }else{
          $large_image_url = wp_get_attachment_image_src( get_field('image_par_defaut','option'), 'large' );
        }
        ?>
        <div class="right_col" style="background-image:url(<?php echo $large_image_url[0]; ?>)" >
        <svg version="1.1" baseProfile="tiny"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 81.4 81.4"
                 xml:space="preserve">
                <polygon data-start="20" data-duration="50" data-async id="j2" stroke-miterlimit="10" stroke-width="0.4" points="69.2,24.1 66.9,17.9 50.5,17.9 45,17.9 44.4,17.9 44.4,64.7
                    50.5,61.3 50.5,24.1     "/>
                <path  data-async  data-start="20" data-duration="50" id="t2" stroke-miterlimit="10" stroke-width="0.4" d="M35.5,17.9v30.7h0c0,5.5-4.5,10-10,10s-10-4.5-10-10H9.4
                    c0,1.9,0.3,3.7,0.9,5.4c2.2,6.3,8.2,10.7,15.2,10.7c8.9,0,16.1-7.2,16.1-16.1h0V17.9H35.5z"/>
            </svg>
        </div>
<?php get_footer(); ?>