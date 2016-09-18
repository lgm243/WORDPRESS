<?php
/*
Template Name: page-contact
*/
?>
<?php get_header(); ?>
<div class="site-content">
<div class="box">
    <div class="left_col">
        <div class="the_content wp1">
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; endif; wp_reset_query(); ?>
                <div class="infos_contact">
                <span id="infos_nom"><?= get_field('infos_nom','option');  ?></span>
                <span id="infos_adresse"><?= get_field('infos_adresse','option');  ?></span>
                <span  id="infos_codepostal"><?= get_field('infos_codepostal','option');  ?> <?= get_field('infos_ville','option');   ?></span>
                <span>Tél : <?= get_field('infos_telephone','option'); ?></span>
                <span>Fax : <?= get_field('infos_fax','option'); ?></span>
                <span>Email : <?= antispambot(get_field('infos_email','option')); ?></span>
                </div>
       </div>
            <fieldset>
                <form action="" method="post" class="" id="form_contact">
                        <div class="field">
                          <label for="societe" class="field-label">Société</label>
                          <input type="text" id="societe" name="societe" class="field-input">
                      </div>
                      <div class="field">
                          <label for="nom" class="field-label">Nom prénom</label>
                          <input type="text" id="nom" name="nom" class="field-input" required>
                      </div>
                      <div class="field">
                          <label for="email" class="field-label">Email</label>
                          <input type="text" id="email" name="email" class="field-input" required>
                      </div>
                      <div class="field">
                          <label for="tel" class="field-label">Téléphone</label>
                          <input type="text" id="tel" name="tel" class="field-input" required>
                      </div>
                      <div class="field">
                          <label for="objet" class="field-label">Objet de votre message</label>
                          <input type="text" id="objet" name="objet" class="field-input" required>
                      </div>
                      <textarea name="message"  placeholder="Votre message" id="message"></textarea>
                      <input type="submit" value="envoyer" id="send-contact"/>
                      <div id="noty" class="noty"></div>
                    <input type="hidden" name="action" value="contact" />
                    <?php wp_nonce_field( 'ajax_contact_nonce', 'security' ); ?>
                </form>
            </fieldset>
            <span class="loi">Conformément à la loi Informatique et Libertés du 6 janvier 1978, vous disposez d'un droit d'accès, de rectification et de suppression des données qui vous concernent en nous écrivant à l'adresse postale et/ou mail indiquée ci dessus. Seule notre société ou association est destinataire des informations que vous lui communiquez.</span>
    </div>
        <div class="right_col">
          <div id="map-canvas"></div>
        </div>
</div>
<?php get_footer(); ?>
<script type="text/javascript">
    if( (document.getElementById("infos_adresse"))&&(document.getElementById("infos_codepostal")))
{
var geocoder;
var map;
 var adresse = document.getElementById("infos_adresse").innerHTML;
  var codepostal = document.getElementById("infos_codepostal").innerHTML;
  var nom = document.getElementById("infos_nom").innerHTML;
 var contentString ='<div><strong>'+nom+'</strong><br>'+adresse+'<br>'+codepostal+'</div>';
function initialize() {
    // Create an array of styles.
  var styles = [
 {
      stylers: [
        { hue: "#0091FF" },
        { saturation: -13 },
        {lightness:29},
        {gamma:0.77},
        {weight:1.4}
      ]
    },
    {
      featureType: "all",
      elementType: "geometry",
      stylers: [
        { visibility: "simplified" }
      ]
    }
  ];

//Create a new StyledMapType object, passing it the array of styles,
  // as well as the name to be displayed on the map type control.
  var styledMap = new google.maps.StyledMapType(styles,
    {name: "Styled Map"});


  geocoder = new google.maps.Geocoder();
  geocoder.geocode( {
    address: adresse + codepostal +',FRANCE',}
    , function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
           //var myMarkerImage = new google.maps.MarkerImage('<?php bloginfo("template_directory"); ?>/images/ico-map.png');
           var marker = new google.maps.Marker({
              map: map,
              draggable:false, //set marker draggable
              //icon: myMarkerImage,
            animation: google.maps.Animation.DROP, //bounce animation
              position: results[0].geometry.location
          });
        var infowindow = new google.maps.InfoWindow({
        content: contentString,
        maxWidth: 350
            });
        infowindow.open(map,marker);

        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
    });
  var mapOptions = {
    zoom: 15,
    panControl: false, //enable pan Control
    scrollwheel: false,
    zoomControl: true, //enable zoom control
    scaleControl: true, // enable scale control
    disableDefaultUI: true
      }
var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
map.mapTypes.set('map_style', styledMap);
  map.setMapTypeId('map_style');


}
google.maps.event.addDomListener(window, 'resize', initialize);
google.maps.event.addDomListener(window, 'load', initialize);
}
</script>