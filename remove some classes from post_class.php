<?php

	/* L_RemoveFromPostClass - remove some classes from post_class.
		
		* @filter post_class

	*/
	
	function L_RemoveFromPostClass( $classes ) {
		
		if (is_home()) { //remove only if is home page for example
		
			$class_key = array_search( 'hentry', $classes );
 
			if ( false !== $class_key ) {
				
				unset( $classes[ $class_key ] );
			
			}
 
		}
		
		return $classes;
	
	}

	add_filter( 'post_class', 'L_RemoveFromPostClass' );
	
?>