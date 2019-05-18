<?php

function select_cas_client() {

    $cas_clients = get_posts(array('post_type' => 'client', 'post_status' => 'publish'));
    $random = rand(0, count($cas_clients)-1);

	  	$title_cas_client = get_the_title($cas_clients[$random]);
        $resume_cas_client = rwmb_meta('resume_cas_client', ' ', $cas_clients[$random]->ID);
        $image_id = rwmb_meta('image_client', ' ', $cas_clients[$random]->ID);
        $image_path = $image_id['full_url'];
        
      $html =   '<div class="bloc-content">
                    <div class="organic-profile-image">
                        <img src="' . $image_path . '">
                        <div class="colored-div"></div>
                    </div>
                    <div class="organic-profile-content">
                        <h3>Nos cas client</h3>
                        <h4 class="nom-client">' . $title_cas_client . '</h4>
                        <p>' . $resume_cas_client . '</p>
                        <a class="cta-button">Voir tous nos cas clients</a>
                        <a class="redirection-client-button">En savoir plus</a>
                    </div>
                </div>';
    
	return $html;
}
add_shortcode( 'cas-client', 'select_cas_client' );