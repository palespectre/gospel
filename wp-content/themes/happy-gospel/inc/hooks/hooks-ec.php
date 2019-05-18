<?php

add_action( 'pre_get_posts', 'pre_get_cpt_taxonomy_url_childpage', 1 );
function pre_get_cpt_taxonomy_url_childpage( $query ) {

    if ( is_admin() || !$query->is_main_query() ) {
        return;
    }
    
    if($query->is_page){
    	
    	$ctp_name = false;

    	// Si la page a le slug du slug archives par défaut
		if(post_type_exists($query->pagename)){
			$cpt_name = $query->pagename;
		}else{
	    	$cpts = get_post_types([
	    		'_builtin' => false,
	    		'rewrite' => true,
	    	]);
	    	foreach($cpts as $c){
	    		$cpt_object = get_post_type_object($c);
	    		if($cpt_object->rewrite == $query->query_vars['pagename'] || $cpt_object->rewrite['slug'] == $query->query_vars['pagename']){
	    			$cpt_name = $c;
	    			break;
	    		}
	    	}
		}

		if($cpt_name){
			$query->set( 'post_type', $cpt_name );
			$query->is_post_type_archive = true;
			$query->is_archive = true;
			add_filter( 'wp', 'page_meta_for_archive', 10, 4 );
		}

    }elseif($query->is_tax){


		$taxonomy_name = $query->tax_query->queries[0]['taxonomy'];

		if(taxonomy_exists($taxonomy_name)){

			$taxonomy = get_taxonomy( $taxonomy_name );

			$rewrite_root = $taxonomy->rewrite['slug'] ? $taxonomy->rewrite['slug'].'/' : null;
			$page_path = $rewrite_root.$query->query[$taxonomy_name];

			if(get_page_by_path($page_path)){

			    // query dedicated page instead of archive
			    $query->set( 'post_type', 'page' );
			    $query->set( 'pagename', $page_path );
			    $query->is_archive = false;
			    $query->is_post_type_archive = false;
			    $query->is_page = true;
			    $query->is_singular = true;
			    $query->is_tax = false;
			}
		}

	}elseif($query->is_singular && !empty($query->query_vars['post_type']) && !in_array($query->query_vars['post_type'], ['post','page','attachment']) ){

		$cpt = get_post_type_object( $query->query['post_type'] );

		if($cpt && !empty($cpt->rewrite['slug']) ){

			preg_match('/%(.*?)%/', $cpt->rewrite['slug'], $taxonomy_replaced_in_url);

			if($taxonomy_replaced_in_url){

		          $rewrite_root = str_replace( $taxonomy_replaced_in_url[0] ,$query->query[$taxonomy_replaced_in_url[1]], $cpt->rewrite['slug'] ).'/';

		     }
	  	}

		$page_path = $rewrite_root.$query->query['name'];

		if(get_page_by_path($page_path)){

		    // query dedicated page instead of archive
		    $query->set( 'post_type', 'page' );
		    $query->set( 'pagename', $page_path );
		    $query->is_archive = false;
		    $query->is_post_type_archive = false;
		    $query->is_page = true;
		    $query->is_singular = true;
		    $query->is_tax = false;
		}
	}
}

function page_meta_for_archive( ){

	global $wp_query;
	$GLOBALS['post'] = $wp_query->queried_object->ID;

}