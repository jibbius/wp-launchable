<?php

class Check_BlockedRobots extends Launchable_LaunchCheck {

	public function runCheck(){
		add_action("wp_ajax_unblock_robots", array(&$this, 'unblock_robots'));
		//Is robots.txt blocked?
		$robots_blocked = get_option('blog_public')<>1;

		if ($robots_blocked){
			$priority = 10;
			$alert = new Launchable_AlertMessage('<strong>Huge SEO Issue:</strong> You\'re blocking access to robots.txt');
			$alert->suggestFix_Link('View page',admin_url('options-reading.php'));
			$alert->suggestFix_PHPFunction('Unblock it for me', array( &$this , 'unblock_robots'),'unblock_robots');
			$this->queueAlert($alert,$priority);
		}
		add_action('admin_footer',array(&$this, 'client_ajax_handler' ));
	}

	public function unblock_robots(){
		if ( !wp_verify_nonce( $_REQUEST['nonce'], 'unblock_robots_nonce')) {
			exit('Request not authorised');
		}
		update_option('blog_public','1');
		$result['type'] = 'success';

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$result = json_encode($result);
			echo $result;
		}
	else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
		die();
	}

	public function client_ajax_handler(){
		$action='unblock_robots';
		$button_class=".$action"; // TODO: Convert to ID
		$alert_container_class=".$action"; // TODO: Assign ID, and handle success message in UI
$script =
'<script>
jQuery(document).ready( function() {

   jQuery("'.$button_class.'").click( function(event) {
   	  event.preventDefault();
   	  nonce = jQuery(this).attr("data-nonce")

      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : "'.admin_url( 'admin-ajax.php' ).'",
         data : {action: "'.$action.'", nonce: nonce},
         success: function(response) {
            if(response.type == "success") {
//                jQuery("'.$alert_container_class.'").innerhtml(response.type)
                  alert("success")
            }
            else {
               alert("failed")
            }
         }
      })   

   })

})
</script>';
		echo $script;
	}

}