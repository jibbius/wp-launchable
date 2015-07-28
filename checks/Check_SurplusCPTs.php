<?php

class Check_SurplusCPTs extends Launchable_LaunchCheck{

	function get_unused_custom_posts(){
		global $wp_post_types;
		$unused_custom_posts = array();
		foreach ($wp_post_types as $post_type => $post_type_data){

			// Generally, we don't want to disable any of the default post types
			$default_post_types = array('post','page','revision','attachment','nav_menu_item');

			// Additional exclusions
			$default_post_types[] = 'flamingo_inbound';
			$default_post_types[] = 'flamingo_outbound';

			if( !in_array($post_type, $default_post_types )){
				// For custom post types (often introduced by premium themes), it may be a good idea
				// to hide any that are not in use.
				$post_count = wp_count_posts($post_type);
				if( 0 == intval($post_count->publish)
				         + intval($post_count->private)
				         + intval($post_count->future)
				         + intval($post_count->pending)
				){
					$unused_custom_posts[] = $post_type;
				}
			}
		}
		return $unused_custom_posts;
	}

	public function runCheck() {
		$unused_custom_post_types = $this->get_unused_custom_posts();
		if ( ! empty( $unused_custom_post_types ) ) {
			$message =
				'You are not using the following post types:'.
				'<strong>' . implode( '</strong>, <strong>', $unused_custom_post_types ) . '</strong>.'.
				'<br />Perhaps you wish to disable them?';
			$alert = new Launchable_AlertMessage($message);

			$codefix = <<<CODEFIX
	add_action('init', function(){
		global \$wp_post_types;
		/*
		 * List all post types to be disabled
		 */

		 \$unused_custom_post_types = Array();
CODEFIX;
			foreach ($unused_custom_post_types as $post_type){
				$codefix .= "
		\$unused_custom_post_types[] = ('$post_type');";
			}

			$codefix .= <<<CODEFIX

		foreach($unused_custom_post_types as $post_type){
			if( isset(\$wp_post_types[\$post_type]) ){
				unset (\$wp_post_types[\$post_type]);
			}
		}
	}, 20);
CODEFIX;
			$codefix = esc_html($codefix);
			$alert->suggestFix_CodeSnippet('Show snippet',$codefix, 'Add the content below to your functions.php file:');

			$this->queueAlert($alert);
		}
	}
}