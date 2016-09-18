<?php

add_action( 'wp_ajax_contact', '_ajax_contact' );
add_action( 'wp_ajax_nopriv_contact', '_ajax_contact' );


function _ajax_contact() {

	/*-----------------------------------------------------------------------------------*/
	/*	On vérifie le nonce de sécurité
	/*-----------------------------------------------------------------------------------*/

	check_ajax_referer( 'ajax_contact_nonce', 'security' );


	/*-----------------------------------------------------------------------------------*/
	/*	Protection ndes variables
	/*-----------------------------------------------------------------------------------*/

	$sender = wp_strip_all_tags( $_POST['email'] );
	$messagecontact = nl2br( stripslashes( wp_kses( $_POST['message'], $GLOBALS['allowedtags'] ) ) );
	$telcontact = wp_strip_all_tags( $_POST['tel'] );
	$nomcontact = wp_strip_all_tags( $_POST['nom'] );
	$societe= wp_strip_all_tags( $_POST['societe'] );
	$objet = wp_strip_all_tags( $_POST['objet'] );


	/*-----------------------------------------------------------------------------------*/
	/*	Gestion des headers
	/*-----------------------------------------------------------------------------------*/

	$headers = array();
	$headers [] = 'MIME-Version: 1.0\r\n';
	$headers [] = 'Content-Type: text/html; charset=UTF-8\r\n';
	$headers[] = 'FROM : ' . $sender .'' . "\r\n";
	$headers[] =  'Reply-to: ' . $nomcontact .' <' . $sender .'>' . "\r\n" ;
	

// Change default WordPress email address
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
function new_mail_from($email) {
return get_field('infos_email','option');
}
function new_mail_from_name($name) {
return "Contact site";
}

	/*-----------------------------------------------------------------------------------*/
	/*	Gestion du message
	/*-----------------------------------------------------------------------------------*/

	ob_start();
	include( TEMPLATEPATH . '/librairie/contact/tpl_contact.php' );
	$mail = ob_get_contents();
	ob_end_clean();


	/*-----------------------------------------------------------------------------------*/
	/*	Envoie de l'e-mail
	/*-----------------------------------------------------------------------------------*/


	// Support d'un contenu HTML dans l'email get_option('infos_email')
	add_filter( 'wp_mail_content_type', create_function('', 'return "text/html";') );

	if( wp_mail( get_field('infos_email','option'), $objet , $mail, $headers ) ) {

		// Tout est ok, on avertit l'utilisateur
		wp_send_json( 'success' );

	}
	else {
		// Il y a une erreur avec le mail, on avertit l'utilisateur
		wp_send_json( 'error' );
	}

}




