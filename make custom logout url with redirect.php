<?php

	/* Make custom logout url with redirect
		
		* @filter logout_url
		* @filter wp_loaded

	*/
	
	add_filter( 'logout_url', 'leonite_custom_logout_url');
	add_action( 'wp_loaded', 'leonite_custom_logout_action' );
	
	/*
	* Replace default log-out URL.
	*
	* @wp-hook logout_url
	* @return string
	*/

	function leonite_custom_logout_url() {
		
		global $wp;
		
		if ( is_admin() ) {
		
			$redirect = urlencode( home_url ( '/' ) );
		
		} else {
		
			$redirect = urlencode( trailingslashit( home_url( $wp->request ) ) );
		
		}
		
		$url = add_query_arg( array( 'dologout' => '1' ),  home_url( '/' ) );
		$url = add_query_arg( array( 'redirect' => $redirect ), $url );
		
		return $url;
	
	}
	
	/*
	* Log the user out.
	*
	* @wp-hook wp_loaded
	* @return void
	*/

	function leonite_custom_logout_action() {
		
		if ( isset ( $_GET['dologout'] ) ) {
			
			wp_logout();
			
			if ( isset ( $_GET['redirect'] ) ) {
			
				wp_redirect( $_GET['redirect'] );
			
			}
			
			exit;
		
		} else {
	
			return;
	
		}

	}
	
?>