

(function($){


hauteur_accueil();


function hauteur_accueil(){
var body= $(window).height();
console.log(body);
fond_accueil = body - 40;
h_banniere = body / 2;
document.querySelector(".fond").style.height = fond_accueil +'px';

document.querySelector(".banniere").style.height = h_banniere +'px';
document.querySelector(".banniere").style.marginTop = '-' + h_banniere / 2 +'px';

}
$(window).resize(function() {
hauteur_accueil();
});




})(jQuery);