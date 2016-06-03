<?php
//if uninstall not called from WordPress, exit
if( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}
$theChampGeneralOptions = get_option('the_champ_general');
if(isset($theChampGeneralOptions['delete_options'])){
	global $wpdb;
	$theChampOptions = array(
						'the_champ_login',
						'the_champ_facebook',
						'the_champ_sharing',
						'the_champ_counter',
						'the_champ_general',
						'the_champ_ss_version',
						'the_champ_feedback_submitted',
						'widget_thechamplogin',
						'widget_thechamphorizontalsharing',
						'widget_thechampverticalsharing',
						'widget_thechamphorizontalcounter',
						'widget_thechampverticalcounter'
					);
	// For Single site
	if( !is_multisite() ){
		foreach($theChampOptions as $option){
			delete_option( $option );
		}
		$wpdb->query("DELETE FROM $wpdb->usermeta WHERE meta_key LIKE 'thechamp%'");
		$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key LIKE '_the_champ%'");
		$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_heateor_ss_%'");
	}else{
		// For Multisite
		$theChampBlogIds = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
		$theChampOriginalBlogId = get_current_blog_id();
		foreach ( $theChampBlogIds as $blogId ){
			switch_to_blog( $blogId );
			foreach($theChampOptions as $option){
				delete_site_option($option);
			}
		}
		switch_to_blog( $theChampOriginalBlogId );
	}
}