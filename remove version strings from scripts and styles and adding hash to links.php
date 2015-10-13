<?php

	/* Hide WP version strings from scripts and styles and adding hash to links
		
		* @param {string} $src 
		* @return {string} $src
		* @filter script_loader_src
		* @filter style_loader_src
	
	*/
	
	function remove_wp_version_strings_and_hash_it( $src ) {
	
		if ( ( strpos( $src, 'api-maps.yandex.ru' ) == false ) && ( strpos( $src, 'fonts.googleapis.com' ) == false ) ) { //if yandex maps or google fonts, don't parse url
    
			parse_str( parse_url( $src, PHP_URL_QUERY), $query );
	
			if ( !empty( $query['ver'] ) ) {
	
				$src = remove_query_arg( 'ver', $src );
				
			}
				
			$hash = md5( @file_get_contents( $src ) );
			$src = $src . '?vhid=' . $hash;			
		
		}
     
		return $src;
	
	}

	add_filter( 'script_loader_src', 'remove_wp_version_strings_and_hash_it' );
	add_filter( 'style_loader_src', 'remove_wp_version_strings_and_hash_it' );
	
?>