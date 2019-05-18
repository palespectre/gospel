<?php

/**
	Génération du header
*/
function dh_get_header(){
	if(HAS_BARBA)
		barba_get_header();
	else
		get_header();
}

/**
	Génération du footer
*/
function dh_get_footer(){
	if(HAS_BARBA)
		barba_get_footer();
	else
		get_footer();

}

/**
	H1
*/
function get_the_h1(){

	global $wp_query ;
	global $post;
	$title = '';

	if(!$post) $post = $wp_query->queried_object;
	$archive = is_archive() ? get_queried_object()->name : false;

	if($post->post_title){
    	$title = $post->post_title;
    }elseif(is_tax()){

    	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    	$title = $term->name;

    }elseif(is_post_type_archive() && !$wp_query->queried_object){  
        $title = post_type_archive_title();
    }elseif(is_post_type_archive() && $wp_query->queried_object){  
        $title = $wp_query->queried_object->post_title;
    }elseif($archive){         
        $title = get_the_archive_title();
    }elseif(is_home()){//Si c'est la page principal du Blog
    	$title = get_the_title( get_option('page_for_posts', true) );
    }elseif(is_404()){
    	$title = __('Page introuvable');
    }

	return $title;
}

function get_the_intro(){

	global $post;
	$intro = '';

	$archive = is_archive() ? get_queried_object()->name : false;

    if(is_tax()){

    	$intro = apply_filters('the_content', term_description() );

    }elseif(is_home() && rwmb_meta('ap-intro', [], get_option('page_for_posts', true) )){
    	$intro = rwmb_meta('ap-intro', [], get_option('page_for_posts', true) );
    }elseif(is_404()){
    	$intro = __('Erreur 404 : Page introuvable. La page que vous essayez d\'afficher n\'existe plus ou a été déplacée.');
    }elseif(rwmb_meta('ap-intro', [], $post->ID)){
    	$intro = rwmb_meta('ap-intro', [], $post->ID);
    }elseif ( 'post' === get_post_type() && is_single()){
    	$intro = get_the_date_link();
    }

	return $intro;
}

function get_bg_id(){

	global $post;

	if(is_tax()){
  		$id = rwmb_meta( 'ap-hero_image', array( 'object_type' => 'term', 'limit' => 1 ), get_queried_object_id() )[0]['ID'];
	}elseif(rwmb_meta('ap-bg_hero',array(),$post->ID))
		$id = array_keys(rwmb_meta('ap-bg_hero',array(),$post->ID))[0];
	elseif(is_home())
		$id = get_post_thumbnail_id(get_option('page_for_posts', true));	
	elseif(get_post_thumbnail_id($post->ID))
		$id = get_post_thumbnail_id($post->ID);
	else{
		$settings = get_option( 'theme_options' );
		$id = $settings['default-visuel'][0];
	}

	return $id;
}

function get_logo(){

	$logo = '<a href="'.get_home_url().'" title="'.get_bloginfo('name').'">';

	$settings = get_option( 'theme_options' );

	if(!empty($settings['logo'])){
		$logo .= wp_get_attachment_image($settings['logo'][0], [150, 150]);
	}else
		$logo .= get_bloginfo('name');

	return $logo.'</a>';
}

function get_the_date_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);
	// Wrap the time string in a link, and preface it with 'Posted on'.
	return '<div class="date-link"><span class="screen-reader-text">' . _x( 'Posté le', 'post date', 'ap' ) . '</span>&nbsp;' . $time_string.'</div>';
}