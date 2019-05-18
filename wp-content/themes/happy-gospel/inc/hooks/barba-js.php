<?php

add_action('init', 'barba_dontcache');
function barba_dontcache(){

	define('DONOTCACHEPAGE', false);//Super Cacche

	if( !empty($_SERVER['HTTP_X_BARBA']))
		define('DONOTCACHEPAGE', true);//Super Cacche

}
