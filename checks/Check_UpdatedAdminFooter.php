<?php

class Check_UpdatedAdminFooter extends Launchable_LaunchCheck{
//TODO: Implement Check_UpdatedLoginLogo
	function runCheck(){
		if(!has_filter('admin_footer_text')){

	//			New alert
			$message = 'You haven\'t customised the admin footer; perhaps you\'d like to?';
			$alert = new Launchable_AlertMessage($message);

	//			Alert is now ready to be added to the queue
			$this->queueAlert($alert);

			$codefix = <<<CODEFIX
// Define Custom Footer
function custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://my_awesome_agency.net" target="_blank">My Awesome Agency</a>';
}
// Add it to the admin area
add_filter('admin_footer_text', 'custom_admin_footer');
CODEFIX;
			$codefix = esc_html($codefix);
			$alert->suggestFix_CodeSnippet('Show snippet',$codefix, 'Add the content below to your functions.php file:');

			$this->queueAlert($alert);


		}

	}

}