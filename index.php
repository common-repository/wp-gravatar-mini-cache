<?
/*
Plugin Name: WP Gravatar Mini Cache
Plugin URI: http://www.evlos.org/2010/01/24/my-first-plugin-mini_gravatar_cache
Description: Cache gravatars for you to speed up the loading. It works perfectly.
Author: 邪罗刹.Evlos
Version: 1.0.6
Author URI: http://www.imevlos.com/
*/

function get_cavatar($source) {
	$time = 1209600; //The time of cache(seconds)
	preg_match('/avatar\/([a-z0-9]+)\?s=(\d+)/',$source,$tmp);
	$abs = ABSPATH.'wp-content/plugins/wp-gravatar-mini-cache/iava/'.$tmp[1].'.jpg';
	$url = get_bloginfo('wpurl').'/wp-content/plugins/wp-gravatar-mini-cache/iava/'.$tmp[1].'.jpg';
	$default = get_bloginfo('wpurl').'/wp-content/plugins/wp-gravatar-mini-cache/iava/'.'default.png';
	if (!is_file($abs)||(time()-filemtime($abs))>$time){
		copy('http://www.gravatar.com/avatar/'.$tmp[1].'?s=64&d='.$default.'&r=G',$abs);
	}
	if (filesize($abs)<500) { copy($default,$abs); }
	return '<img alt="" src="'.$url.'" class="avatar avatar-'.$tmp[2].'" width="'.$tmp[2].'" height="'.$tmp[2].'" />';
}
add_filter('get_avatar','get_cavatar');
?>