<?php
/*
Plugin Name: Limit min keyword length
Plugin URI: https://github.com/gehwissenlos/yourls-limit-keyword-length/
Description: This plugin limits the number of minimal characters for the custom keyword. An error is then returned if the keyword is too short.
Version: 1.0
Author: gehwissenlos
*/

// Hook our custom function into the 'shunt_add_new_link' filter
yourls_add_filter( 'shunt_add_new_link', 'limit_min_keyword_length' );

// Check the keyword length and return an error if too short
function limit_min_keyword_length( $too_short, $url, $keyword ) {
	$min_keyword_length = 7;
	$keyword_length = strlen($keyword);

	if ( $keyword_length < $min_keyword_length && $keyword_length > 0) {
		$return['status']   = 'fail';
		$return['code']     = 'error:keyword';
		$return['message']  = "Sorry, the keyword is too short. It needs to have at least " . $min_keyword_length . " characters.";
		return yourls_apply_filter( 'add_new_link_keyword_too_short', $return );
	}

	return false;
}
