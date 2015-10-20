<?php

/**
	* L_RemoteFileExists - check file exist via http or https connection
	* @param string $url 
	* @param bool $usehttps / default = true
	* @return bool 
	**/
 
	function L_RemoteFileExists($url, $usehttps = true) {

		$curl = curl_init($url);

		//don't fetch the actual page, you only want to check the connection is ok
		if ($usehttps)
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		
		curl_setopt($curl, CURLOPT_NOBODY, true);
		
		//do request
		$result = curl_exec($curl);
		$ret = false;

		//if request did not fail
		if ($result !== false) {
			
			//if request was ok, check response code
			$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  

			if ($statusCode == 200) {
				$ret = true;   
			}
		}

		curl_close($curl);

		return $ret;
	
	}
	
	/*
	//enqueue jquery from google cdn if available
	//example use
	
	function example_scripts_and_styles() {
	
		if (!is_admin()) {
	
			$exists = L_RemoteFileExists('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js');
		
				if ($exists) {
			
					wp_deregister_script( 'jquery' );
					wp_register_script( 'jquery', ( 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js' ), false, null, true );
					wp_enqueue_script( 'jquery' );
		
				} else {
			
					wp_enqueue_script( 'jquery' );
			
				}
			
		}
		
	}
		
	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'example_scripts_and_styles', 999 );
	*/
	
?>