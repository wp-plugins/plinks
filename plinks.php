<?php
/*
Plugin Name: Powie's pLinks
Plugin URI: http://www.powie.de/plinks
Description: Link directory pageview with pagepeeker preview
Version: 0.9.3
License: GPLv2
Author: Thomas Ehrhardt
Author URI: http://www.powie.de
*/

//Define some stuff
define( 'PL_PLUGIN_DIR', dirname( plugin_basename( __FILE__ ) ) );
load_plugin_textdomain( 'plinks', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

//create custom plugin settings menu
add_action('admin_menu', 'plinks_create_menu');
add_action('admin_init', 'plinks_register_settings' );
//add_action('wp_head', 'plinks_websnapr_header');
//Shortcode
add_shortcode('plinks', 'plinks_show');
add_shortcode('pagepeeker', 'plinks_pagepeeker');
//Hook for Activation
register_activation_hook( __FILE__, 'plinks_activate' );
//Hook for Deactivation
register_deactivation_hook( __FILE__, 'plinks_deactivate' );


function plinks_create_menu() {
	// or create options menu page
	add_options_page(__('pLinks Setup'),__('pLinks Setup'), 9, PL_PLUGIN_DIR.'/plinks_settings.php');
}

function plinks_register_settings() {
	//register settings
	//register_setting( 'plinks-settings', 'websnapr-key' );
	register_setting( 'plinks-settings', 'websnapr-show' );
	register_setting( 'plinks-settings', 'websnapr-size' );
	//register_setting( 'plinks-settings', 'option_etc' );
}

function plinks_pagepeeker( $atts ){
	//var_Dump($atts);
	/*
	   extract( shortcode_atts( array(
	   'foo' => 'something',
	   'bar' => 'something else',
	   ), $atts ) );
	   return "Hallo -> foo = {$foo}";
	*/
	$url = $atts['url'];
	$size = $atts['size'];
	if ($size == '') { $size = get_option('websnapr-size'); }
	$sc = '<!-- pLinks Plugin PagePeeker Output -->';
	$sc.=sprintf( '<img src="http://pagepeeker.com/thumbs.php?size=%s&url=%s" border="0" alt="preview" />',$size,  $url);
	$sc.='<!-- /pLinks Plugin PagePeeker Output -->';
	return $sc;
}

function plinks_show( $atts ) {
	//var_Dump($atts);
	/*
	extract( shortcode_atts( array(
		'foo' => 'something',
		'bar' => 'something else',
	), $atts ) );
	return "Hallo -> foo = {$foo}";
	*/
	$bookmarks = get_bookmarks( array(
				'orderby'        => 'name',
				'order'          => 'ASC',
				'category_name'  => $atts['category_name']  ));
	$websnapr_key = get_option('websnapr-key');
	$websnapr_show = get_option('websnapr-show');
	$websnapr_size = get_option('websnapr-size');
	$sc = '<!-- pLinks Plugin Output -->';
	// Loop through each bookmark and print formatted output
	foreach ( $bookmarks as $bm ) {
		$sc.=sprintf( '<div class="post">');
		$sc.=sprintf( '<h2><a class="relatedlink" href="%s" target="%s">%s</a></h2>', $bm->link_url,$bm->link_target, __($bm->link_name) );
		if($websnapr_show == 1) {
			$sc.=sprintf( ' <div style="float:left; padding-right:0.5em; padding-bottom:0.5em;">
                            <img src="http://pagepeeker.com/thumbs.php?size=%s&url=%s" border="0">
                            </div> ',$websnapr_size,  $bm->link_url );
		}
		$sc.='<div class="postentry"><p>';
		$sc.=sprintf ('%s<br />%s',$bm->link_description, nl2br($bm->link_notes));
		//var_dump($bm);
		$sc.= '</p></div></div>';
	}
	$sc.='<!-- /pLinks Plugin Output -->';
	return $sc;
}

//Activate
function plinks_activate() {
	// do not generate any output here
}

//Deactivate
function plinks_deactivate() {
	// do not generate any output here
}

/*
function plinks_websnapr_header() {
	if (get_option('websnapr-show') == 1) {
		$addhead = "\n<!-- pLinks Plugin -->\n";
		$addhead.= '<script type="text/javascript" src="http://www.websnapr.com/js/websnapr.js"></script>';
		$addhead.= "\n<!-- /pLinks Plugin -->\n";
		print($addhead);
	}
}*/
?>