<?php

class Check_BlockedRobots extends Launchable_LaunchCheck {

	public function runCheck(){

		//Is robots.txt blocked?
		$robots_blocked = get_option('blog_public')<>1;

		if ($robots_blocked){
			$priority = 10;
			$alert = new Launchable_AlertMessage('<strong>Huge SEO Issue:</strong> You\'re blocking access to robots.txt');
			$alert->suggestFix_Link('View page',admin_url('options-reading.php'));
			$alert->suggestFix_PHPFunction('Unblock it for me', array( get_class($this) , 'unblock_robots'));
			$this->queueAlert($alert,$priority);
			$this->unblock_robots_client();
		}

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

	public function unblock_robots_client(){
		// $nonce = wp_create_nonce($function.'_nonce');
?>
<script>
jQuery(document).ready( function() {

   jQuery(".unblock_robots").click( function(event) {
   	  event.preventDefault();
   	  nonce = jQuery(this).attr("data-nonce")

      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : <?php echo admin_url( 'admin-ajax.php' ) ?>,
         data : {action: "unblock_robots", nonce: nonce},
         success: function(response) {
            if(response.type == "success") {
               // jQuery("#unblock_robots").html(response.type)
               alert("success")
            }
            else {
               alert("failed")
            }
         }
      })   

   })

})
</script>
<?php
	}

}
