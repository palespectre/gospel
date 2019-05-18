<?php

function barba_get_header(){

	global $post;

	if( empty($_SERVER['HTTP_X_BARBA'])/* || $_SERVER['HTTP_REFERER'] == get_permalink($post->ID)*/){
	  get_header();
	  echo '<div class="'.join( ' ',get_body_class('barba-container')).'" >';
	}else{

		echo'<title>';
		wp_title();
		echo '</title><body><div class="'.join( ' ',get_body_class('barba-container')).'">';

	}

}

function barba_get_footer(){

	global $post;

	if( empty($_SERVER['HTTP_X_BARBA'])/* || $_SERVER['HTTP_REFERER'] == get_permalink($post->ID)*/ ){
		echo '</div>';
	  get_footer();
	}else{
		$html = '</div></body>';

		echo $html;
	}

}