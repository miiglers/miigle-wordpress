<?php
/*
Plugin Name: Super Socializer
Plugin URI: http://super-socializer-wordpress.heateor.com
Description: A complete 360 degree solution to provide all the social features like Social Login, Social Commenting, Social Sharing and more.
Version: 7.8.6
Author: Team Heateor
Author URI: https://www.heateor.com
Text Domain: Super-Socializer
Domain Path: /languages
License: GPL2+
*/
defined('ABSPATH') or die("Cheating........Uh!!");
define('THE_CHAMP_SS_VERSION', '7.8.6');

require 'helper.php';

$theChampLoginOptions = get_option('the_champ_login');
if(the_champ_social_login_enabled()){
	if(isset($theChampLoginOptions['providers']) && in_array('twitter', $theChampLoginOptions['providers'])){
		require 'library/twitteroauth.php';
	}
	if(isset($theChampLoginOptions['providers']) && in_array('xing', $theChampLoginOptions['providers'])){
		$theChampOauthConfigurationFile = plugins_url('library/oauth_configuration.json', __FILE__);
		require 'library/http.php';
		require 'library/oauth_client.php';
	}
	if(isset($theChampLoginOptions['providers']) && in_array('steam', $theChampLoginOptions['providers'])){
		require 'library/SteamLogin/SteamLogin.php';
		$theChampSteamLogin = new SteamLogin();
	}
}

$theChampFacebookOptions = get_option('the_champ_facebook');
$theChampSharingOptions = get_option('the_champ_sharing');
$theChampCounterOptions = get_option('the_champ_counter');
$theChampGeneralOptions = get_option('the_champ_general');

$theChampIsBpActive = false;

// include social login functions
require 'inc/social_login.php';

// include social sharing functions
if(the_champ_social_sharing_enabled() || the_champ_social_counter_enabled()){
	require 'inc/social_sharing_networks.php';
	require 'inc/social_sharing.php';
}
//include widget class
require 'inc/widget.php';
//include shortcode
require 'inc/shortcode.php';

/**
 * Hook the plugin function on 'init' event.
 */
function the_champ_init(){
	add_action('wp_enqueue_scripts', 'the_champ_load_event');
	add_action('wp_enqueue_scripts', 'the_champ_frontend_scripts');
	add_action('wp_enqueue_scripts', 'the_champ_frontend_styles');
	add_action('login_enqueue_scripts', 'the_champ_load_event');
	add_action('login_enqueue_scripts', 'the_champ_frontend_scripts');
	add_action('login_enqueue_scripts', 'the_champ_frontend_styles');
	add_action('parse_request', 'the_champ_connect');
	load_plugin_textdomain('Super-Socializer', false, dirname(plugin_basename(__FILE__)).'/languages/');
	if(the_champ_ss_woocom_is_active()){
		add_action('the_champ_user_successfully_created', 'the_champ_sync_woocom_profile', 10, 3);
	}
}
add_action('init', 'the_champ_init');

/**
 * Sync social profile data with WooCommerce billing and shipping address
 */
function the_champ_sync_woocom_profile($userId, $userdata, $profileData){
	$billingFirstName = get_user_meta($userId, 'billing_first_name', true);
	$billingLastName = get_user_meta($userId, 'billing_last_name', true);
	$billingEmail = get_user_meta($userId, 'billing_email', true);
	
	$shippingFirstName = get_user_meta($userId, 'shipping_first_name', true);
	$shippingLastName = get_user_meta($userId, 'shipping_last_name', true);
	$shippingEmail = get_user_meta($userId, 'shipping_email', true);

	if(!empty($profileData['first_name'])){
		if(!$billingFirstName){
			update_user_meta($userId, 'billing_first_name', $profileData['first_name']);
		}
		if(!$shippingFirstName){
			update_user_meta($userId, 'shipping_first_name', $profileData['first_name']);
		}
	}
	if(!empty($profileData['last_name'])){
		if(!$billingLastName){
			update_user_meta($userId, 'billing_last_name', $profileData['last_name']);
		}
		if(!$shippingLastName){
			update_user_meta($userId, 'shipping_last_name', $profileData['last_name']);
		}
	}
	if(!empty($profileData['email'])){
		if(!$billingEmail){
			update_user_meta($userId, 'billing_email', $profileData['email']);
		}
		if(!$shippingEmail){
			update_user_meta($userId, 'shipping_email', $profileData['email']);
		}
	}
}

function the_champ_load_event(){
	?>
	<script>function theChampLoadEvent(e){var t=window.onload;if(typeof window.onload!="function"){window.onload=e}else{window.onload=function(){t();e()}}}</script>
	<?php
}

/**
 * Check querystring variables
 */
function the_champ_connect(){
	global $theChampLoginOptions;
	// verify email
	if(isset($_GET['SuperSocializerKey']) && ($verificationKey = trim(esc_attr($_GET['SuperSocializerKey']))) != ''){
		$users = get_users('meta_key=thechamp_key&meta_value='.$verificationKey);
		if(count($users) > 0 && isset($users[0] -> ID)){
			delete_user_meta($users[0] -> ID, 'thechamp_key');
			wp_redirect(home_url().'?SuperSocializerVerified=1');
			die;
		}
	}
	
	// Instagram auth
	if(isset($_GET['SuperSocializerInstaToken']) && $_GET['SuperSocializerInstaToken'] != ''){
		$instaAuthUrl = 'https://api.instagram.com/v1/users/self?access_token=' . trim(esc_attr($_GET['SuperSocializerInstaToken']));
		$response = wp_remote_get( $instaAuthUrl,  array( 'timeout' => 15 ) );
		if( ! is_wp_error( $response ) && isset( $response['response']['code'] ) && 200 === $response['response']['code'] ){
			$body = json_decode(wp_remote_retrieve_body( $response ));
			if(is_object($body -> data) && isset($body -> data) && isset($body -> data -> id)){
				$redirection = isset($_GET['super_socializer_redirect_to']) && $_GET['super_socializer_redirect_to'] != '' ? esc_attr($_GET['super_socializer_redirect_to']) : '';
				$response = the_champ_user_auth($body -> data, 'instagram', $redirection);
				if(is_array($response) && isset($response['message']) && $response['message'] == 'register' && (!isset($response['url']) || $response['url'] == '')){
					$redirectTo = esc_attr(the_champ_get_login_redirection_url($redirection, true));
				}elseif(isset($response['message']) && $response['message'] == 'linked'){
					$redirectTo = $redirection . (strpos($redirection, '?') !== false ? '&' : '?') . 'linked=1';
				}elseif(isset($response['message']) && $response['message'] == 'not linked'){
					$redirectTo = $redirection . (strpos($redirection, '?') !== false ? '&' : '?') . 'linked=0';
				}elseif(isset($response['url']) && $response['url'] != ''){
					$redirectTo = $response['url'];
				}else{
					$redirectTo = esc_attr(the_champ_get_login_redirection_url($redirection));
				}
				the_champ_close_login_popup($redirectTo);
			}
		}
	}

	// Twitch auth
	if((isset($_GET['SuperSocializerAuth']) && $_GET['SuperSocializerAuth'] == 'Twitch')){
		if(isset($_GET['SuperSocializerData'])){
			$body = explode('&&', urldecode($_GET['SuperSocializerData']));
			$profileData = array();
			foreach($body as $dataField){
				$keyValue = explode('=', $dataField);
				$profileData[$keyValue[0]] = $keyValue[1];
			}
			if(isset($profileData['_id']) && $profileData['_id'] != ''){
				$redirection = isset($_GET['super_socializer_redirect_to']) && $_GET['super_socializer_redirect_to'] != '' ? esc_attr($_GET['super_socializer_redirect_to']) : '';
				$response = the_champ_user_auth($profileData, 'twitch', $redirection);
				if(is_array($response) && isset($response['message']) && $response['message'] == 'register' && (!isset($response['url']) || $response['url'] == '')){
					$redirectTo = esc_attr(the_champ_get_login_redirection_url($redirection, true));
				}elseif(isset($response['message']) && $response['message'] == 'linked'){
					$redirectTo = $redirection . (strpos($redirection, '?') !== false ? '&' : '?') . 'linked=1';
				}elseif(isset($response['message']) && $response['message'] == 'not linked'){
					$redirectTo = $redirection . (strpos($redirection, '?') !== false ? '&' : '?') . 'linked=0';
				}elseif(isset($response['url']) && $response['url'] != ''){
					$redirectTo = $response['url'];
				}else{
					$redirectTo = esc_attr(the_champ_get_login_redirection_url($redirection));
				}
				the_champ_close_login_popup($redirectTo);
			}
		} elseif(isset($theChampLoginOptions['twitch_client_id']) && $theChampLoginOptions['twitch_client_id'] != '') {
			?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	  		<script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>
	  		<script>
	  			theChampSerialize = function(obj, prefix) {
				  var str = [];
				  for(var p in obj) {
				    if (obj.hasOwnProperty(p)) {
				      var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
				      str.push(typeof v == "object" ?
				        theChampSerialize(v, k) :
				        encodeURIComponent(k) + "=" + encodeURIComponent(v));
				    }
				  }
				  return str.join("&&");
				}
			    jQuery(function(){
			      Twitch.init({clientId: '<?php echo $theChampLoginOptions['twitch_client_id'] ?>'}, function(error, status) {
			        // the sdk is now loaded
			        console.log(error);
			        console.log(status);
			        if( !status.authenticated ){
				        Twitch.login({
					        scope: ['user_read']
					      });
			    	} else {
			    		Twitch.api({method: 'user'}, function(error, user) {
			              if(user._id && user._id != null){
			              	window.opener.theChampAjaxUserAuth(user, 'twitch');
			              	window.opener.location.href = '<?php echo home_url() ?>?SuperSocializerAuth=Twitch&super_socializer_redirect_to='+window.opener.theChampTwitterRedirect+'&SuperSocializerData=' + encodeURIComponent(theChampSerialize(user));
			              	window.close();
			              }
			            });
			    	}
			      });
			    });
			</script> 
			<?php
		}
		die;
	}

	// Steam auth
	if(isset($_GET['SuperSocializerSteamAuth']) && $_GET['SuperSocializerSteamAuth'] != ''){
		global $theChampSteamLogin;
		$theChampSteamId = $theChampSteamLogin->validate();
	    $result = wp_remote_get( "http://steamcommunity.com/profiles/$theChampSteamId/?xml=1",  array( 'timeout' => 15 ) );
		if( ! is_wp_error( $result ) && isset( $result['response']['code'] ) && 200 === $result['response']['code'] ){
			$body = wp_remote_retrieve_body( $result );
		    $xml = simplexml_load_string( $body, null, LIBXML_NOCDATA );
		    if( $xml && isset( $xml->steamID64 ) && $xml->steamID64 ) {
				$steamRedirect = esc_url($_GET['SuperSocializerSteamAuth']);
				$response = the_champ_user_auth($xml, 'steam', $steamRedirect);
				if(is_array($response) && isset($response['message']) && $response['message'] == 'register' && (!isset($response['url']) || $response['url'] == '')){
					$redirectTo = esc_attr(the_champ_get_login_redirection_url($steamRedirect, true));
				}elseif(isset($response['message']) && $response['message'] == 'linked'){
					$redirectTo = $steamRedirect . (strpos($steamRedirect, '?') !== false ? '&' : '?') . 'linked=1';
				}elseif(isset($response['message']) && $response['message'] == 'not linked'){
					$redirectTo = $steamRedirect . (strpos($steamRedirect, '?') !== false ? '&' : '?') . 'linked=0';
				}elseif(isset($response['url']) && $response['url'] != ''){
					$redirectTo = $response['url'];
				}else{
					$redirectTo = esc_attr(the_champ_get_login_redirection_url($steamRedirect));
				}
				the_champ_close_login_popup($redirectTo);
		    }
		}
		die;
	}
	
	// send request to Xing
	if((isset($_GET['SuperSocializerAuth']) && $_GET['SuperSocializerAuth'] == 'Xing')){
		session_start();
		if(!isset($_GET['oauth_token']) && isset($_SESSION['OAUTH_ACCESS_TOKEN'])){
			Unset($_SESSION['OAUTH_ACCESS_TOKEN']);
		}
		if(isset($theChampLoginOptions['xing_ck']) && $theChampLoginOptions['xing_ck'] != '' && isset($theChampLoginOptions['xing_cs']) && $theChampLoginOptions['xing_cs'] != ''){
			$xingClient = new oauth_client_class;
			$xingClient->debug = 0;
			$xingClient->debug_http = 1;
			$xingClient->server = 'XING';
			$xingClient->redirect_uri = home_url() . '/index.php?SuperSocializerAuth=Xing&super_socializer_redirect_to=' . esc_attr(str_replace(array('http://', 'https://'), '', urldecode($_GET['super_socializer_redirect_to'])));
			$xingClient->client_id = $theChampLoginOptions['xing_ck'];
			$xingClient->client_secret = $theChampLoginOptions['xing_cs'];
			if(($success = $xingClient->Initialize())){
				if(($success = $xingClient->Process())){
					if(strlen($xingClient->access_token)){
						$success = $xingClient->CallAPI(
							'https://api.xing.com/v1/users/me', 
							'GET', array(), array('FailOnAccessError'=>true), $xingResponse);
					}
				}
				$success = $xingClient->Finalize($success);
			}
			if($xingClient->exit) die('exit');
			if($success){
				if(isset($xingResponse -> users) && is_array($xingResponse -> users) && isset($xingResponse -> users[0] -> id)){
					$xingRedirect = the_champ_get_http() . esc_attr($_GET['super_socializer_redirect_to']);
					$response = the_champ_user_auth($xingResponse -> users[0], 'xing', $xingRedirect);
					if(is_array($response) && isset($response['message']) && $response['message'] == 'register' && (!isset($response['url']) || $response['url'] == '')){
						$redirectTo = esc_attr(the_champ_get_login_redirection_url($xingRedirect, true));
					}elseif(isset($response['message']) && $response['message'] == 'linked'){
						$redirectTo = $xingRedirect . (strpos($xingRedirect, '?') !== false ? '&' : '?') . 'linked=1';
					}elseif(isset($response['message']) && $response['message'] == 'not linked'){
						$redirectTo = $xingRedirect . (strpos($xingRedirect, '?') !== false ? '&' : '?') . 'linked=0';
					}elseif(isset($response['url']) && $response['url'] != ''){
						$redirectTo = $response['url'];
					}else{
						$redirectTo = esc_attr(the_champ_get_login_redirection_url($xingRedirect));
					}
					the_champ_close_login_popup($redirectTo);
				}
			}else{
				echo 'Error:' . $xingClient->error;
				die;
			}
		}
	}
	
	// send request to twitter
	if(isset($_GET['SuperSocializerAuth']) && $_GET['SuperSocializerAuth'] == 'Twitter'){
		if(isset($theChampLoginOptions['twitter_key']) && $theChampLoginOptions['twitter_key'] != '' && isset($theChampLoginOptions['twitter_secret']) && $theChampLoginOptions['twitter_secret'] != ''){
			/* Build TwitterOAuth object with client credentials. */
			$connection = new TwitterOAuth($theChampLoginOptions['twitter_key'], $theChampLoginOptions['twitter_secret']);
			/* Get temporary credentials. */
			$requestToken = $connection->getRequestToken(home_url().'/index.php');
			if($connection->http_code == 200){
				// generate unique ID
				$uniqueId = mt_rand();
				// save oauth token and secret in db temporarily
				update_user_meta($uniqueId, 'thechamp_twitter_oauthtoken', $requestToken['oauth_token']);
				update_user_meta($uniqueId, 'thechamp_twitter_oauthtokensecret', $requestToken['oauth_token_secret']);
				if(isset($_GET['super_socializer_redirect_to']) && $_GET['super_socializer_redirect_to'] != ''){
					update_user_meta($uniqueId, 'thechamp_twitter_redirect', esc_attr($_GET['super_socializer_redirect_to']));
				}
				wp_redirect($connection->getAuthorizeURL($requestToken['oauth_token']));
				die;
			}else{
				?>
				<div style="width: 500px; margin: 0 auto">
					<ol>
					<li><?php echo sprintf(__('Enter exactly the following url in <strong>Website</strong> and <strong>Callback Url</strong> options in your Twitter app (see step 3 %s)', 'Super-Socializer'), '<a target="_blank" href="http://support.heateor.com/how-to-get-twitter-api-key-and-secret/">here</a>') ?><br/>
					<?php echo home_url() ?>
					</li>
					<li><?php _e('Make sure cURL is enabled at your website server. You may need to contact the server administrator of your website to verify this', 'Super-Socializer') ?></li>
					</ol>
				</div>
				<?php
				die;
			}
		}
	}
	// twitter authentication
	if(isset($_REQUEST['oauth_token'])){
		global $wpdb;
		$uniqueId = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'thechamp_twitter_oauthtoken' and meta_value = %s", $_REQUEST['oauth_token']));
		$oauthTokenSecret = get_user_meta($uniqueId, 'thechamp_twitter_oauthtokensecret', true);
		// twitter redirect url
		$twitterRedirectUrl = get_user_meta($uniqueId, 'thechamp_twitter_redirect', true);
		if(empty($uniqueId) || $oauthTokenSecret == ''){
			// invalid request
			wp_redirect(home_url());
			die;
		}
		$connection = new TwitterOAuth($theChampLoginOptions['twitter_key'], $theChampLoginOptions['twitter_secret'], $_REQUEST['oauth_token'], $oauthTokenSecret);
		/* Request access tokens from twitter */
		$accessToken = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		/* Create a TwitterOauth object with consumer/user tokens. */
		$connection = new TwitterOAuth($theChampLoginOptions['twitter_key'], $theChampLoginOptions['twitter_secret'], $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
		$content = $connection->get('account/verify_credentials');
		// delete temporary data
		delete_user_meta($uniqueId, 'thechamp_twitter_oauthtokensecret');
		delete_user_meta($uniqueId, 'thechamp_twitter_oauthtoken');
		delete_user_meta($uniqueId, 'thechamp_twitter_redirect');
		if(is_object($content) && isset($content -> id)){
			$response = the_champ_user_auth($content, 'twitter', $twitterRedirectUrl);
			if(is_array($response) && isset($response['message']) && $response['message'] == 'register' && (!isset($response['url']) || $response['url'] == '')){
				$redirectTo = esc_attr(the_champ_get_login_redirection_url($twitterRedirectUrl, true));
			}elseif(isset($response['message']) && $response['message'] == 'linked'){
				$redirectTo = $twitterRedirectUrl . (strpos($twitterRedirectUrl, '?') !== false ? '&' : '?') . 'linked=1';
			}elseif(isset($response['message']) && $response['message'] == 'not linked'){
				$redirectTo = $twitterRedirectUrl . (strpos($twitterRedirectUrl, '?') !== false ? '&' : '?') . 'linked=0';
			}elseif(isset($response['url']) && $response['url'] != ''){
				$redirectTo = $response['url'];
			}else{
				$redirectTo = esc_attr(the_champ_get_login_redirection_url($twitterRedirectUrl));
			}
			the_champ_close_login_popup($redirectTo);
		}
	}
}

function the_champ_close_login_popup($redirectionUrl){
	?>
	<script>
	if(window.opener){
		window.opener.location.href="<?php echo $redirectionUrl; ?>";
		window.close();
	}else{
		window.location.href="<?php echo $redirectionUrl; ?>";
	}
	</script>
	<?php
	die;
}

/**
 * Validate url
 */
function the_champ_validate_url($url){
	$expression = "/^(http:\/\/|https:\/\/|ftp:\/\/|ftps:\/\/|)?[a-z0-9_\-]+[a-z0-9_\-\.]+\.[a-z]{2,4}(\/+[a-z0-9_\.\-\/]*)?$/i";
    return (bool)preg_match($expression, $url);
}

/**
 * Get http/https protocol at the website
 */
function the_champ_get_http(){
	if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
		return "https://";
	}else{
		return "http://";
	}
}

/**
 * Return valid redirection url.
 */
function the_champ_get_valid_url($url){
	$url = urldecode($url);
	if(html_entity_decode(esc_url(remove_query_arg(array('ss_message', 'SuperSocializerVerified', 'SuperSocializerUnverified'), $url))) == wp_login_url() || $url == home_url().'/wp-login.php?action=register' || $url == home_url().'/wp-login.php?loggedout=true'){ 
		$url = home_url().'/';
	}elseif(isset($_GET['redirect_to'])){
		if(urldecode($_GET['redirect_to']) == admin_url()){
			$url = home_url().'/';
		}elseif(the_champ_validate_url(urldecode($_GET['redirect_to'])) && (strpos(urldecode($_GET['redirect_to']), 'http://') !== false || strpos(urldecode($_GET['redirect_to']), 'https://') !== false)){
			$url = esc_attr($_GET['redirect_to']);
		}else{
			$url = home_url().'/';
		}
	}
	return $url;
}

/**
 * Return webpage url to redirect after login.
 */
function the_champ_get_login_redirection_url($twitterRedirect = '', $register = false){
	global $theChampLoginOptions, $user_ID;
	if($register){
		$option = 'register';
	}else{
		$option = 'login';
	}
	if(isset($theChampLoginOptions[$option.'_redirection'])){
		if($theChampLoginOptions[$option.'_redirection'] == 'same'){
			$http = the_champ_get_http();
			if($twitterRedirect != ''){
				$url = $twitterRedirect;
			}else{
				$url = html_entity_decode(esc_url($http.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));
			}
			return the_champ_get_valid_url($url);
		}elseif($theChampLoginOptions[$option.'_redirection'] == 'homepage'){
			return home_url();
		}elseif($theChampLoginOptions[$option.'_redirection'] == 'account'){
			return admin_url();
		}elseif($theChampLoginOptions[$option.'_redirection'] == 'custom' && $theChampLoginOptions[$option.'_redirection_url'] != ''){
			return $theChampLoginOptions[$option.'_redirection_url'];
		}elseif($theChampLoginOptions[$option.'_redirection'] == 'bp_profile' && $user_ID != 0){
			return function_exists('bp_core_get_user_domain') ? bp_core_get_user_domain($user_ID) : admin_url();
		}else{
			return home_url();
		}
	}else{
		return home_url();
	}
}

/**
 * The javascript to loaded at front end.
 */
function the_champ_frontend_scripts(){
	global $theChampFacebookOptions, $theChampLoginOptions, $theChampSharingOptions, $theChampGeneralOptions;
	$inFooter = isset($theChampGeneralOptions['footer_script']) ? true : false;
	$combinedScript = isset($theChampGeneralOptions['combined_script']) ? true : false;
	if(!$combinedScript){
		wp_enqueue_script('the_champ_ss_general_scripts', plugins_url('js/front/social_login/general.js', __FILE__), false, THE_CHAMP_SS_VERSION, $inFooter);
	}
	$websiteUrl = home_url();
	$fbKey = isset($theChampLoginOptions["fb_key"]) && $theChampLoginOptions["fb_key"] != "" ? $theChampLoginOptions["fb_key"] : "";
	$userVerified = false;
	$emailPopup = false;
	?>
	<script> var theChampSiteUrl = '<?php echo $websiteUrl ?>', theChampVerified = <?php echo intval($userVerified) ?>, theChampEmailPopup = <?php echo intval($emailPopup); ?>; </script>
	<?php
	// scripts used for common Social Login functionality
	if(the_champ_social_login_enabled() && !is_user_logged_in()){
		$loadingImagePath = plugins_url('images/ajax_loader.gif', __FILE__);
		$theChampAjaxUrl = get_admin_url().'admin-ajax.php';
		$redirectionUrl = esc_attr(the_champ_get_login_redirection_url());
		$regRedirectionUrl = esc_attr(the_champ_get_login_redirection_url('', true));
		?>
		<script> var theChampLoadingImgPath = '<?php echo $loadingImagePath ?>'; var theChampAjaxUrl = '<?php echo $theChampAjaxUrl ?>'; var theChampRedirectionUrl = '<?php echo $redirectionUrl ?>'; var theChampRegRedirectionUrl = '<?php echo $regRedirectionUrl ?>'; </script>
		<?php
		$ajaxUrl = 'admin-ajax.php';
		$notification = '';
		if(isset($_GET['SuperSocializerVerified']) || isset($_GET['SuperSocializerUnverified'])){
			$userVerified = true;
			$ajaxUrl = esc_url(add_query_arg( 
				array(
					'height' => 60,
					'width' => 300,
					'action' => 'the_champ_notify',
					'message' => urlencode(isset($_GET['SuperSocializerUnverified']) ? __('Please verify your email address to login.', 'Super-Socializer') : __('Your email has been verified. Now you can login to your account', 'Super-Socializer'))
				), 
				'admin-ajax.php'
			));
			$notification = __('Notification', 'Super-Socializer');
		}
		
		$emailAjaxUrl = 'admin-ajax.php';
		$emailPopupTitle = '';
		$emailPopupErrorMessage = '';
		$emailPopupUniqueId = '';
		$emailPopupVerifyMessage = '';
		if(isset($_GET['SuperSocializerEmail']) && isset($_GET['par']) && trim($_GET['par']) != ''){
			$emailPopup = true;
			$emailAjaxUrl = esc_url(add_query_arg( 
				array(
					'height' => isset($theChampLoginOptions['popup_height']) && $theChampLoginOptions['popup_height'] != '' ? esc_attr( $theChampLoginOptions['popup_height'] ) : 210,
					'width' => 300,
					'action' => 'the_champ_ask_email'
				), 
				'admin-ajax.php'
			));
			$emailPopupTitle = __('Email required', 'Super-Socializer');
			$emailPopupErrorMessage = isset($theChampLoginOptions["email_error_message"]) ? $theChampLoginOptions["email_error_message"] : "";
			$emailPopupUniqueId = isset($_GET['par']) ? trim(esc_attr($_GET['par'])) : '';
			$emailPopupVerifyMessage = __('Please check your email inbox to complete the registration.', 'Super-Socializer');
		}
		global $theChampSteamLogin;
		$twitterRedirect = urlencode(the_champ_get_valid_url(html_entity_decode(esc_url(the_champ_get_http().$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]))));
		?>
		<script> var theChampFacebookScope = 'public_profile,email', theChampFBKey = '<?php echo $fbKey ?>', theChampVerified = <?php echo intval($userVerified) ?>; var theChampAjaxUrl = '<?php echo html_entity_decode(admin_url().$ajaxUrl) ?>'; var theChampPopupTitle = '<?php echo $notification; ?>'; var theChampEmailPopup = <?php echo intval($emailPopup); ?>; var theChampEmailAjaxUrl = '<?php echo html_entity_decode(admin_url().$emailAjaxUrl); ?>'; var theChampEmailPopupTitle = '<?php echo $emailPopupTitle; ?>'; var theChampEmailPopupErrorMsg = '<?php echo htmlspecialchars($emailPopupErrorMessage, ENT_QUOTES); ?>'; var theChampEmailPopupUniqueId = '<?php echo $emailPopupUniqueId; ?>'; var theChampEmailPopupVerifyMessage = '<?php echo $emailPopupVerifyMessage; ?>'; var theChampSteamAuthUrl = "<?php echo $theChampSteamLogin ? $theChampSteamLogin->url( home_url() . '?SuperSocializerSteamAuth=' . $twitterRedirect ) : ''; ?>"; var theChampTwitterRedirect = '<?php echo $twitterRedirect ?>'; <?php echo isset($theChampLoginOptions['disable_reg']) && isset($theChampLoginOptions['disable_reg_redirect']) && $theChampLoginOptions['disable_reg_redirect'] != '' ? 'var theChampDisableRegRedirect = "' . html_entity_decode(esc_url($theChampLoginOptions['disable_reg_redirect'])) . '";' : '' ?> </script>
		<?php
		if(!$combinedScript){
			wp_enqueue_script('the_champ_sl_common', plugins_url('js/front/social_login/common.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION, $inFooter);
		}
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
	}
	// Google+ scripts
	if(the_champ_social_login_provider_enabled('google') && !is_user_logged_in()){
		$googleKey = isset($theChampLoginOptions['google_key']) ? $theChampLoginOptions['google_key'] : '';
		?>
		<script>var theChampGoogleKey = '<?php echo $googleKey ?>'; var theChampGoogleErrorMessage = '<?php echo htmlspecialchars(__('Follow steps 11 and 12 at GooglePlus app configuration page, about to open', 'Super-Socializer'), ENT_QUOTES); ?>' </script>
		<?php
		if(!$combinedScript){
			wp_enqueue_script('the_champ_sl_google', plugins_url('js/front/social_login/google.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION, $inFooter);
		}
	}
	// Linkedin scripts
	if(the_champ_social_login_provider_enabled('linkedin') && !is_user_logged_in()){
		?>
		<script type="text/javascript" src="//platform.linkedin.com/in.js">
		  api_key: <?php echo isset($theChampLoginOptions['li_key']) ? $theChampLoginOptions['li_key'] : '' ?>
		  
		  onLoad: theChampLinkedInOnLoad
		</script>
		<?php
		if(!$combinedScript){
			wp_enqueue_script('the_champ_sl_linkedin', plugins_url('js/front/social_login/linkedin.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION, $inFooter);
		}
	}
	// Vkontakte scripts
	if(the_champ_social_login_provider_enabled('vkontakte') && !is_user_logged_in()){
		?>
		<script> var theChampVkKey = '<?php echo (isset($theChampLoginOptions["vk_key"]) && $theChampLoginOptions["vk_key"] != "") ? $theChampLoginOptions["vk_key"] : 0 ?>' </script>
		<?php
		if(!$combinedScript){
			wp_enqueue_script('the_champ_sl_vkontakte', plugins_url('js/front/social_login/vkontakte.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION, $inFooter);
		}
	}
	// Instagram scripts
	if(the_champ_social_login_provider_enabled('instagram')){
		?>
		<script> var theChampInstaId = '<?php echo (isset($theChampLoginOptions["insta_id"]) && $theChampLoginOptions["insta_id"] != "") ? $theChampLoginOptions["insta_id"] : 0 ?>'; var theChampTwitterRedirect = '<?php echo urlencode(the_champ_get_valid_url(html_entity_decode(esc_url(the_champ_get_http().$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"])))); ?>'; </script>
		<?php
		if(!$combinedScript){
			wp_enqueue_script('the_champ_sl_instagram', plugins_url('js/front/social_login/instagram.js', __FILE__), false, THE_CHAMP_SS_VERSION, $inFooter);
		}
	}
	// Facebook scripts
	if(the_champ_facebook_plugin_enabled()){
		global $heateor_fcn_options;
		?>
		<script> var theChampFBKey = '<?php echo $fbKey ?>', theChampFBLang = '<?php echo (isset($theChampFacebookOptions["comment_lang"]) && $theChampFacebookOptions["comment_lang"] != '') ? $theChampFacebookOptions["comment_lang"] : "en_US" ?>', theChampFbLikeMycred = <?php echo defined( 'HEATEOR_SOCIAL_SHARE_MYCRED_INTEGRATION_VERSION' ) && the_champ_facebook_like_rec_enabled() ? 1 : 0 ?>, theChampSsga = <?php echo defined( 'HEATEOR_SHARING_GOOGLE_ANALYTICS_VERSION' ) ? 1 : 0 ?>, theChampCommentNotification = <?php echo isset($heateor_fcn_options) || function_exists('heateor_ss_check_querystring') || function_exists('the_champ_check_querystring') ? 1 : 0; ?>, theChampFbIosLogin = <?php echo !is_user_logged_in() && isset($_GET['code']) && esc_attr($_GET['code']) != '' ? 1 : 0; ?>; </script>
		<?php
		add_action('wp_footer', 'the_champ_fb_root_div');
		if(!$combinedScript){
			wp_enqueue_script('the_champ_fb_sdk', plugins_url('js/front/facebook/sdk.js', __FILE__), false, THE_CHAMP_SS_VERSION, $inFooter);
		}
	}
	if(the_champ_social_login_provider_enabled('facebook') && !is_user_logged_in()){
		if(!$combinedScript){
			wp_enqueue_script('the_champ_sl_facebook', plugins_url('js/front/social_login/facebook.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION, $inFooter);
		}
	}
	// Social commenting
	if(the_champ_social_commenting_enabled()){
		global $post;
		if($post){
			$postMeta = get_post_meta($post -> ID, '_the_champ_meta', true);
			if(isset($theChampFacebookOptions['enable_' . $post->post_type]) && !(isset($postMeta) && isset($postMeta['fb_comments']) && $postMeta['fb_comments'] == 1)){
				if(isset($theChampFacebookOptions['urlToComment']) && $theChampFacebookOptions['urlToComment'] != ''){
					$commentUrl = $theChampFacebookOptions['urlToComment'];
				}elseif(isset($post -> ID) && $post -> ID){
					$commentUrl = get_permalink($post -> ID);
				}else{
					$commentUrl = html_entity_decode(esc_url(the_champ_get_http().$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));
				}

				$commentingTabsOrder = ($theChampFacebookOptions['commenting_order'] != '' ? $theChampFacebookOptions['commenting_order'] : 'wordpress,facebook,googleplus,disqus');
				$commentingTabsOrder = explode(',', str_replace('facebook', 'fb', $commentingTabsOrder));
				$enabledTabs = array();
				foreach($commentingTabsOrder as $tab){
					$tab = trim($tab);
					if($tab == 'wordpress'){
						$enabledTabs[] = 'wordpress';
					}elseif(isset($theChampFacebookOptions['enable_'. $tab .'comments'])){
						$enabledTabs[] = $tab;
					}
				}
				$labels = array();
				$labels['wordpress'] = $theChampFacebookOptions['label_wordpress_comments'] != '' ? htmlspecialchars($theChampFacebookOptions['label_wordpress_comments'], ENT_QUOTES) : 'Default Comments';
				$commentsCount = wp_count_comments($post->ID);
				$labels['wordpress'] .= ' ('. ($commentsCount && isset($commentsCount -> approved) ? $commentsCount -> approved : '') .')';
				$labels['fb'] = $theChampFacebookOptions['label_facebook_comments'] != '' ? htmlspecialchars($theChampFacebookOptions['label_facebook_comments'], ENT_QUOTES) : 'Facebook Comments';
				$labels['fb'] .= ' (<fb:comments-count href='. $commentUrl .'></fb:comments-count>)';
				$labels['googleplus'] = $theChampFacebookOptions['label_googleplus_comments'] != '' ? htmlspecialchars($theChampFacebookOptions['label_googleplus_comments'], ENT_QUOTES) : 'GooglePlus Comments';
				$labels['disqus'] = $theChampFacebookOptions['label_disqus_comments'] != '' ? htmlspecialchars($theChampFacebookOptions['label_disqus_comments'], ENT_QUOTES) : 'Disqus Comments';
				?>
				<script>var theChampFBCommentUrl = '<?php echo $commentUrl ?>'; var theChampFBCommentColor = '<?php echo (isset($theChampFacebookOptions['comment_color']) && $theChampFacebookOptions['comment_color'] != '') ? $theChampFacebookOptions["comment_color"] : ''; ?>'; var theChampFBCommentNumPosts = '<?php echo (isset($theChampFacebookOptions['comment_numposts']) && $theChampFacebookOptions['comment_numposts'] != '') ? $theChampFacebookOptions["comment_numposts"] : ''; ?>'; var theChampFBCommentWidth = '<?php echo (isset($theChampFacebookOptions['comment_width']) && $theChampFacebookOptions['comment_width'] != '') ? $theChampFacebookOptions["comment_width"] : '100%'; ?>'; var theChampFBCommentOrderby = '<?php echo (isset($theChampFacebookOptions['comment_orderby']) && $theChampFacebookOptions['comment_orderby'] != '') ? $theChampFacebookOptions["comment_orderby"] : ''; ?>'; var theChampCommentingTabs = "<?php echo isset($theChampFacebookOptions['commenting_order']) ? $theChampFacebookOptions['commenting_order'] : ''; ?>", theChampGpCommentsUrl = '<?php echo isset($theChampFacebookOptions['gpcomments_url']) && $theChampFacebookOptions['gpcomments_url'] != '' ? $theChampFacebookOptions['gpcomments_url'] : $commentUrl; ?>', theChampDisqusShortname = '<?php echo isset($theChampFacebookOptions['dq_shortname']) ? $theChampFacebookOptions['dq_shortname'] : ''; ?>', theChampScEnabledTabs = '<?php echo implode(',', $enabledTabs) ?>', theChampScLabel = '<?php echo $theChampFacebookOptions['commenting_label'] != '' ? htmlspecialchars($theChampFacebookOptions['commenting_label'], ENT_QUOTES) : __('Leave a reply', 'Super-Socializer'); ?>', theChampScTabLabels = <?php echo json_encode($labels) ?>, theChampGpCommentsWidth = <?php echo isset($theChampFacebookOptions['gpcomments_width']) && $theChampFacebookOptions['gpcomments_width'] != '' ? $theChampFacebookOptions['gpcomments_width'] : 0; ?>, theChampCommentingId = '<?php echo isset($theChampFacebookOptions['commenting_id']) && $theChampFacebookOptions['commenting_id'] != '' ? $theChampFacebookOptions['commenting_id'] : 'respond' ?>'</script>
				<?php
				if(!$combinedScript){
					wp_enqueue_script('the_champ_fb_commenting', plugins_url('js/front/facebook/commenting.js', __FILE__), false, THE_CHAMP_SS_VERSION, $inFooter);
				}
			}
		}
	}
	// sharing script
	if(the_champ_social_sharing_enabled() || (the_champ_social_counter_enabled() && the_champ_vertical_social_counter_enabled())){
		global $theChampSharingOptions, $theChampCounterOptions, $post;
		?>
		<script> var theChampSharingAjaxUrl = '<?php echo get_admin_url() ?>admin-ajax.php', heateorSsUrlCountFetched = [], heateorSsSharesText = '<?php echo htmlspecialchars(__('Shares', 'Super-Socializer'), ENT_QUOTES); ?>', heateorSsShareText = '<?php echo htmlspecialchars(__('Share', 'Super-Socializer'), ENT_QUOTES); ?>', theChampCloseIconPath = '<?php echo plugins_url('images/close.png', __FILE__) ?>', theChampPluginIconPath = '<?php echo plugins_url('images/logo.png', __FILE__) ?>', theChampHorizontalSharingCountEnable = <?php echo isset($theChampSharingOptions['enable']) && isset($theChampSharingOptions['hor_enable']) && ( isset($theChampSharingOptions['horizontal_counts']) || isset($theChampSharingOptions['horizontal_total_shares']) ) ? 1 : 0 ?>, theChampVerticalSharingCountEnable = <?php echo isset($theChampSharingOptions['enable']) && isset($theChampSharingOptions['vertical_enable']) && ( isset($theChampSharingOptions['vertical_counts']) || isset($theChampSharingOptions['vertical_total_shares']) ) ? 1 : 0 ?>, theChampSharingOffset = <?php echo (isset($theChampSharingOptions['alignment']) && $theChampSharingOptions['alignment'] != '' && isset($theChampSharingOptions[$theChampSharingOptions['alignment'].'_offset']) && $theChampSharingOptions[$theChampSharingOptions['alignment'].'_offset'] != '' ? $theChampSharingOptions[$theChampSharingOptions['alignment'].'_offset'] : 0) ?>, theChampCounterOffset = <?php echo (isset($theChampCounterOptions['alignment']) && $theChampCounterOptions['alignment'] != '' && isset($theChampCounterOptions[$theChampCounterOptions['alignment'].'_offset']) && $theChampCounterOptions[$theChampCounterOptions['alignment'].'_offset'] != '' ? $theChampCounterOptions[$theChampCounterOptions['alignment'].'_offset'] : 0) ?>;
		<?php
		if ( isset( $theChampSharingOptions['horizontal_counts'] ) && isset( $theChampSharingOptions['horizontal_counter_position'] ) ) {
			echo in_array( $theChampSharingOptions['horizontal_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var theChampReduceHorizontalSvgWidth = true;' : '';
			echo in_array( $theChampSharingOptions['horizontal_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var theChampReduceHorizontalSvgHeight = true;' : '';
		}
		if ( isset( $theChampSharingOptions['vertical_counts'] ) ) {
			echo isset( $theChampSharingOptions['vertical_counter_position'] ) && in_array( $theChampSharingOptions['vertical_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var theChampReduceVerticalSvgWidth = true;' : '';
			echo ! isset( $theChampSharingOptions['vertical_counter_position'] ) || in_array( $theChampSharingOptions['vertical_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var theChampReduceVerticalSvgHeight = true;' : '';
		}
		?>
		</script>
		<?php
		if(!$combinedScript){
			wp_enqueue_script('the_champ_share_counts', plugins_url('js/front/sharing/sharing.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION, $inFooter);
		}
	}

	if($combinedScript){
		wp_enqueue_script('the_champ_combined_script', plugins_url('js/front/combined.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION, $inFooter);
	}
}

/**
 * Stylesheets to load at front end.
 */
function the_champ_frontend_styles(){
	global $theChampSharingOptions, $theChampGeneralOptions;
	?>
	<style type="text/css">
	.the_champ_horizontal_sharing .theChampSharing{
		<?php if ( $theChampSharingOptions['horizontal_bg_color_default'] != '' ) { ?>
			background-color: <?php echo $theChampSharingOptions['horizontal_bg_color_default'] ?>;
		<?php  } ?>
			color: <?php echo $theChampSharingOptions['horizontal_font_color_default'] ? $theChampSharingOptions['horizontal_font_color_default'] : '#fff' ?>;
		<?php
		$border_width = 0;
		if ( $theChampSharingOptions['horizontal_border_width_default'] != '' ) {
			$border_width = $theChampSharingOptions['horizontal_border_width_default'];
		} elseif ( $theChampSharingOptions['horizontal_border_width_hover'] != '' ) {
			$border_width = $theChampSharingOptions['horizontal_border_width_hover'];
		}
		?>
		border-width: <?php echo $border_width ?>px;
		border-style: solid;
		border-color: <?php echo $theChampSharingOptions['horizontal_border_color_default'] != '' ? $theChampSharingOptions['horizontal_border_color_default'] : 'transparent'; ?>;
	}
	<?php if ( $theChampSharingOptions['horizontal_font_color_default'] == '' ) { ?>
	.the_champ_horizontal_sharing .theChampTCBackground{
		color:#666;
	}
	<?php } ?>
	.the_champ_horizontal_sharing .theChampSharing:hover{
		<?php if ( $theChampSharingOptions['horizontal_bg_color_hover'] != '' ) { ?>
			background-color: <?php echo $theChampSharingOptions['horizontal_bg_color_hover'] ?>;
		<?php }
		if ( $theChampSharingOptions['horizontal_font_color_hover'] != '' ) { ?>
			color: <?php echo $theChampSharingOptions['horizontal_font_color_hover'] ?>;
		<?php  } ?>
		border-color: <?php echo $theChampSharingOptions['horizontal_border_color_hover'] != '' ? $theChampSharingOptions['horizontal_border_color_hover'] : 'transparent'; ?>;
	}
	.the_champ_vertical_sharing .theChampSharing{
		<?php if ( $theChampSharingOptions['vertical_bg_color_default'] != '' ) { ?>
			background-color: <?php echo $theChampSharingOptions['vertical_bg_color_default'] ?>;
		<?php } ?>
			color: <?php echo $theChampSharingOptions['vertical_font_color_default'] ? $theChampSharingOptions['vertical_font_color_default'] : '#fff' ?>;
		<?php
		$verticalBorderWidth = 0;
		if ( $theChampSharingOptions['vertical_border_width_default'] != '' ) {
			$verticalBorderWidth = $theChampSharingOptions['vertical_border_width_default'];
		} elseif ( $theChampSharingOptions['vertical_border_width_hover'] != '' ) {
			$verticalBorderWidth = $theChampSharingOptions['vertical_border_width_hover'];
		}
		?>
		border-width: <?php echo $verticalBorderWidth ?>px;
		border-style: solid;
		border-color: <?php echo $theChampSharingOptions['vertical_border_color_default'] != '' ? $theChampSharingOptions['vertical_border_color_default'] : 'transparent'; ?>;
	}
	<?php if ( $theChampSharingOptions['horizontal_font_color_default'] == '' ) { ?>
	.the_champ_vertical_sharing .theChampTCBackground{
		color:#666;
	}
	<?php } ?>
	.the_champ_vertical_sharing .theChampSharing:hover{
		<?php if ( $theChampSharingOptions['vertical_bg_color_hover'] != '' ) { ?>
			background-color: <?php echo $theChampSharingOptions['vertical_bg_color_hover'] ?>;
		<?php }
		if ( $theChampSharingOptions['vertical_font_color_hover'] != '' ) { ?>
			color: <?php echo $theChampSharingOptions['vertical_font_color_hover'] ?>;
		<?php  } ?>
		border-color: <?php echo $theChampSharingOptions['vertical_border_color_hover'] != '' ? $theChampSharingOptions['vertical_border_color_hover'] : 'transparent'; ?>;
	}
	<?php
	if ( isset( $theChampSharingOptions['horizontal_counts'] ) ) {
		$svg_height = $theChampSharingOptions['horizontal_sharing_shape'] == 'rectangle' ? $theChampSharingOptions['horizontal_sharing_height'] : $theChampSharingOptions['horizontal_sharing_size'];
		if ( isset( $theChampSharingOptions['horizontal_counter_position'] ) && in_array( $theChampSharingOptions['horizontal_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ) {
			$line_height_percent = $theChampSharingOptions['horizontal_counter_position'] == 'inner_top' ? 38 : 19;
			?>
			div.the_champ_horizontal_sharing .theChampSharingSvg{height:70%;margin-top:<?php echo $svg_height*15/100 ?>px}div.the_champ_horizontal_sharing .the_champ_square_count{line-height:<?php echo $svg_height*$line_height_percent/100 ?>px;}
			<?php
		} elseif ( isset( $theChampSharingOptions['horizontal_counter_position'] ) && in_array( $theChampSharingOptions['horizontal_counter_position'], array( 'inner_left', 'inner_right' ) ) ) { ?>
			div.the_champ_horizontal_sharing .theChampSharingSvg{width:50%;margin:auto;}div.the_champ_horizontal_sharing .the_champ_square_count{float:left;width:50%;line-height:<?php echo $svg_height; ?>px;}
			<?php
		} elseif ( isset( $theChampSharingOptions['horizontal_counter_position'] ) && in_array( $theChampSharingOptions['horizontal_counter_position'], array( 'left', 'right' ) ) ) { ?>
			div.the_champ_horizontal_sharing .the_champ_square_count{float:<?php echo $theChampSharingOptions['horizontal_counter_position'] ?>;margin:0 8px;line-height:<?php echo $svg_height + 2 * $border_width; ?>px;}
			<?php
		} elseif ( ! isset( $theChampSharingOptions['horizontal_counter_position'] ) || $theChampSharingOptions['horizontal_counter_position'] == 'top' ) { ?>
			div.the_champ_horizontal_sharing .the_champ_square_count{display: block}
			<?php
		}

	}
	if ( isset( $theChampSharingOptions['vertical_counts'] ) ) {
		$vertical_svg_height = $theChampSharingOptions['vertical_sharing_shape'] == 'rectangle' ? $theChampSharingOptions['vertical_sharing_height'] : $theChampSharingOptions['vertical_sharing_size'];
		$vertical_svg_width = $theChampSharingOptions['vertical_sharing_shape'] == 'rectangle' ? $theChampSharingOptions['vertical_sharing_width'] : $theChampSharingOptions['vertical_sharing_size'];
		if ( ( isset( $theChampSharingOptions['vertical_counter_position'] ) && in_array( $theChampSharingOptions['vertical_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ) || ! isset( $theChampSharingOptions['vertical_counter_position'] ) ) {
			$vertical_line_height_percent = ! isset( $theChampSharingOptions['vertical_counter_position'] ) || $theChampSharingOptions['vertical_counter_position'] == 'inner_top' ? 38 : 19;
			?>
			div.the_champ_vertical_sharing .theChampSharingSvg{height:70%;margin-top:<?php echo $vertical_svg_height*15/100 ?>px}div.the_champ_vertical_sharing .the_champ_square_count{line-height:<?php echo $vertical_svg_height*$vertical_line_height_percent/100; ?>px;}
			<?php
		} elseif ( isset( $theChampSharingOptions['vertical_counter_position'] ) && in_array( $theChampSharingOptions['vertical_counter_position'], array( 'inner_left', 'inner_right' ) ) ) { ?>
			div.the_champ_vertical_sharing .theChampSharingSvg{width:50%;margin:auto;}div.the_champ_vertical_sharing .the_champ_square_count{float:left;width:50%;line-height:<?php echo $vertical_svg_height; ?>px;}
			<?php
		}  elseif ( isset( $theChampSharingOptions['vertical_counter_position'] ) && in_array( $theChampSharingOptions['vertical_counter_position'], array( 'left', 'right' ) ) ) { ?>
			div.the_champ_vertical_sharing .the_champ_square_count{float:<?php echo $theChampSharingOptions['vertical_counter_position'] ?>;margin:0 8px;line-height:<?php echo $vertical_svg_height; ?>px; <?php echo $theChampSharingOptions['vertical_counter_position'] == 'left' ? 'min-width:' . $vertical_svg_width*30/100 . 'px;display: block' : '';?>}
			<?php
		} elseif ( isset( $theChampSharingOptions['vertical_counter_position'] ) && $theChampSharingOptions['vertical_counter_position'] == 'top' ) { ?>
			div.the_champ_vertical_sharing .the_champ_square_count{display: block}
			<?php
		}
	}
	echo isset( $theChampSharingOptions['hide_mobile_sharing'] ) && $theChampSharingOptions['vertical_screen_width'] != '' ? '@media screen and (max-width:' . $theChampSharingOptions['vertical_screen_width'] . 'px){.the_champ_vertical_sharing{display:none!important}}' : '';
	$bottom_sharing_postion_inverse = $theChampSharingOptions['bottom_sharing_alignment'] == 'left' ? 'right' : 'left';
	echo isset( $theChampSharingOptions['bottom_mobile_sharing'] ) && $theChampSharingOptions['horizontal_screen_width'] != '' ? '@media screen and (max-width:' . $theChampSharingOptions['horizontal_screen_width'] . 'px){.the_champ_bottom_sharing{' . ( $theChampSharingOptions['bottom_sharing_position'] != '' ? $theChampSharingOptions['bottom_sharing_alignment'] . ':' . $theChampSharingOptions['bottom_sharing_position'] . 'px!important;' . $bottom_sharing_postion_inverse . ':auto!important;' : '' ) . 'display:block!important;width: auto!important;bottom: -10px!important;top: auto!important;}.the_champ_bottom_sharing .the_champ_square_count{line-height: inherit;}.the_champ_bottom_sharing .theChampSharingArrow{display:none;}.the_champ_bottom_sharing .theChampTCBackground{margin-right: 1.1em !important}}' : '';
	echo $theChampGeneralOptions['custom_css'];
	?>
	</style>
	<?php
	wp_enqueue_style( 'the_champ_frontend_css', plugins_url( 'css/front.css', __FILE__ ), false, THE_CHAMP_SS_VERSION );
	$default_svg = false;
	if ( isset( $theChampSharingOptions['hor_enable'] ) ) {
		if ( isset( $theChampSharingOptions['horizontal_more'] ) ) {
			$default_svg = true;
		}
		if ( $theChampSharingOptions['horizontal_font_color_default'] != '' ) {
			wp_enqueue_style( 'the_champ_sharing_svg', plugins_url( 'css/share-default-svg-horizontal.css', __FILE__ ), false, THE_CHAMP_SS_VERSION );
		} else {
			$default_svg = true;
		}
		if ( $theChampSharingOptions['horizontal_font_color_hover'] != '' ) {
			wp_enqueue_style( 'the_champ_sharing_svg_hover', plugins_url( 'css/share-hover-svg-horizontal.css', __FILE__ ), false, THE_CHAMP_SS_VERSION );
		}
	}
	if ( isset( $theChampSharingOptions['vertical_enable'] ) ) {
		if ( isset( $theChampSharingOptions['vertical_more'] ) ) {
			$default_svg = true;
		}
		if ( $theChampSharingOptions['vertical_font_color_default'] != '' ) {
			wp_enqueue_style( 'the_champ_vertical_sharing_svg', plugins_url( 'css/share-default-svg-vertical.css', __FILE__ ), false, THE_CHAMP_SS_VERSION );
		} else {
			$default_svg = true;
		}
		if ( $theChampSharingOptions['vertical_font_color_hover'] != '' ) {
			wp_enqueue_style( 'the_champ_vertical_sharing_svg_hover', plugins_url( 'css/share-hover-svg-vertical.css', __FILE__ ), false, THE_CHAMP_SS_VERSION );
		}
	}
	if ( $default_svg ) {
		wp_enqueue_style( 'the_champ_sharing_default_svg', plugins_url( 'css/share-svg.css', __FILE__ ), false, THE_CHAMP_SS_VERSION );
	}
}

/**
 * Create plugin menu in admin.
 */	
function the_champ_create_admin_menu(){
	$page = add_menu_page('Super Socializer by Heateor', 'Super Socializer', 'manage_options', 'heateor-ss-general-options', 'the_champ_general_options_page', plugins_url('images/logo.png', __FILE__));
	// general options page
	$generalOptionsPage = add_submenu_page( 'heateor-ss-general-options', __( "Super Socializer - General Options", 'Super-Socializer' ), __( "General Options", 'Super-Socializer' ), 'manage_options', 'heateor-ss-general-options', 'the_champ_general_options_page' );
	// facebook page
	$facebookPage = add_submenu_page('heateor-ss-general-options', 'Super Socializer - Social Commenting', 'Social Commenting', 'manage_options', 'heateor-social-commenting', 'the_champ_facebook_page');
	// social login page
	$loginPage = add_submenu_page('heateor-ss-general-options', 'Super Socializer - Social Login', 'Social Login', 'manage_options', 'heateor-social-login', 'the_champ_social_login_page');
	// social sharing page
	$sharingPage = add_submenu_page('heateor-ss-general-options', 'Super Socializer - Social Sharing', 'Social Sharing', 'manage_options', 'heateor-social-sharing', 'the_champ_social_sharing_page');
	// like buttons page
	$counterPage = add_submenu_page('heateor-ss-general-options', 'Super Socializer - Like Buttons', 'Like Buttons', 'manage_options', 'heateor-like-buttons', 'the_champ_like_buttons_page');
	add_action('admin_print_scripts-' . $page, 'the_champ_admin_scripts');
	add_action('admin_print_scripts-' . $page, 'the_champ_admin_style');
	add_action('admin_print_scripts-' . $page, 'the_champ_fb_sdk_script');
	add_action('admin_print_scripts-' . $generalOptionsPage, 'the_champ_admin_scripts');
	add_action('admin_print_scripts-' . $generalOptionsPage, 'the_champ_fb_sdk_script');
	add_action('admin_print_styles-' . $generalOptionsPage, 'the_champ_admin_style');
	add_action('admin_print_scripts-' . $facebookPage, 'the_champ_admin_scripts');
	add_action('admin_print_scripts-' . $facebookPage, 'the_champ_fb_sdk_script');
	add_action('admin_print_styles-' . $facebookPage, 'the_champ_admin_style');
	add_action('admin_print_scripts-' . $loginPage, 'the_champ_admin_scripts');
	add_action('admin_print_scripts-' . $loginPage, 'the_champ_fb_sdk_script');
	add_action('admin_print_styles-' . $loginPage, 'the_champ_admin_style');
	add_action('admin_print_scripts-' . $sharingPage, 'the_champ_admin_scripts');
	add_action('admin_print_scripts-' . $sharingPage, 'the_champ_fb_sdk_script');
	add_action('admin_print_scripts-' . $sharingPage, 'the_champ_admin_sharing_scripts');
	add_action('admin_print_styles-' . $sharingPage, 'the_champ_admin_style');
	add_action('admin_print_styles-' . $sharingPage, 'the_champ_admin_sharing_style');
	add_action('admin_print_scripts-' . $counterPage, 'the_champ_admin_scripts');
	add_action('admin_print_scripts-' . $counterPage, 'the_champ_fb_sdk_script');
	add_action('admin_print_scripts-' . $counterPage, 'the_champ_admin_counter_scripts');
	add_action('admin_print_styles-' . $counterPage, 'the_champ_admin_style');
}
add_action('admin_menu', 'the_champ_create_admin_menu');

/** 
 * Auto-approve comments made by social login users
 */ 
function the_champ_auto_approve_comment($approved){
	global $theChampLoginOptions; 
	if(empty($approved)){
		if(isset($theChampLoginOptions['autoApproveComment'])){ 
			$userId = get_current_user_id(); 
			if(is_numeric($userId)){
				$commentUser = get_user_meta($userId, 'thechamp_social_id', true); 
				if($commentUser !== false){ 
					$approved = 1; 
				} 
			} 
		} 
	} 
	return $approved;
}
add_action('pre_comment_approved', 'the_champ_auto_approve_comment');

function the_champ_fb_root_div(){
	?>
	<div id="fb-root"></div>
	<?php
}

function the_champ_show_avatar_option( $user ) {
	global $user_ID, $theChampLoginOptions;
	if ( isset( $theChampLoginOptions['enable'] ) ) {
		$dontUpdateAvatar = get_user_meta($user_ID, 'thechamp_dontupdate_avatar', true);
		?>
		<h3><?php _e( 'Social Avatar', 'Super-Socializer' ) ?></h3>
		<table class="form-table">
	        <tr>
	            <th><label for="ss_small_avatar"><?php _e( 'Small Avatar Url', 'Super-Socializer' ) ?></label></th>
	            <td><input id="ss_small_avatar" type="text" name="the_champ_small_avatar" value="<?php echo esc_attr(get_user_meta( $user->ID, 'thechamp_avatar', true )); ?>" class="regular-text" /></td>
	        </tr>
	        <tr>
	            <th><label for="ss_large_avatar"><?php _e( 'Large Avatar Url', 'Super-Socializer' ) ?></label></th>
	            <td><input id="ss_large_avatar" type="text" name="the_champ_large_avatar" value="<?php echo esc_attr(get_user_meta( $user->ID, 'thechamp_large_avatar', true )); ?>" class="regular-text" /></td>
	        </tr>
	        <tr>
	            <th><label for="ss_dontupdate_avatar_1"><?php _e( 'Do not fetch and update social avatar from my profile, next time I Social Login', 'Super-Socializer' ) ?></label></th>
	            <td><input id="ss_dontupdate_avatar_1" style="margin-right:5px" type="radio" name="ss_dontupdate_avatar" value="1" <?php echo $dontUpdateAvatar ? 'checked' : '' ?> /></td>
	        </tr>
	        <tr>
	            <th><label for="ss_dontupdate_avatar_0"><?php _e( 'Update social avatar, next time I Social Login', 'Super-Socializer' ) ?></label></th>
	            <td><input id="ss_dontupdate_avatar_0" style="margin-right:5px" type="radio" name="ss_dontupdate_avatar" value="0" <?php echo ! $dontUpdateAvatar ? 'checked' : '' ?> /></td>
	        </tr>
	    </table>
		<?php
	}
}
add_action( 'edit_user_profile', 'the_champ_show_avatar_option' );
add_action( 'show_user_profile', 'the_champ_show_avatar_option' );

function the_champ_save_avatar( $user_id ) { 	
 	if ( ! current_user_can( 'edit_user', $user_id ) ) {
 		return false;
 	}
 	if ( isset( $_POST['the_champ_small_avatar'] ) ) {
 		update_user_meta( $user_id, 'thechamp_avatar', esc_attr( trim( $_POST['the_champ_small_avatar'] ) ) );
 	}
 	if ( isset( $_POST['the_champ_large_avatar'] ) ) {
 		update_user_meta( $user_id, 'thechamp_large_avatar', esc_attr( trim( $_POST['the_champ_large_avatar'] ) ) );
 	}
	if ( isset( $_POST['ss_dontupdate_avatar'] ) ) {
		update_user_meta( $user_id, 'thechamp_dontupdate_avatar', esc_attr( trim( $_POST['ss_dontupdate_avatar'] ) ) );
	}
}
add_action( 'personal_options_update', 'the_champ_save_avatar' );
add_action( 'edit_user_profile_update', 'the_champ_save_avatar' );

/**
 * Check if WooCommerce is active
 */
function the_champ_ss_woocom_is_active(){
	return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}

if(!function_exists('array_replace')){
	/**
	 * Custom 'array_replace' function for PHP version < 5.3
	 */
	function array_replace($array, $value, $replacement){ 
		foreach($array as $key => $val){
	        if($val == $value){
	            $array[$key] = $replacement;
	            break;
	        }
	    }
	    return $array; 
	}
}

/**
 * Replace a value in array
 */
function the_champ_replace_array_value($array, $value, $replacement){
	return array_replace($array,
	    array_fill_keys(
	        array_keys($array, $value),
	        $replacement
	    )
	);
}

/**
 * Default options when plugin is installed
 */
function the_champ_save_default_options(){
	// general options
	add_option('the_champ_general', array(
	   'footer_script' => '1',
	   'delete_options' => '1',
	   'custom_css' => ''
	));

	// login options
	add_option('the_champ_login', array(
	   'title' => __('Login with your Social ID', 'Super-Socializer'),
	   'email_error_message' => __('Email you entered is already registered or invalid', 'Super-Socializer'),
	   'avatar' => 1,
	   'email_required' => 1,
	   'password_email' => 1,
	   'new_user_admin_email' => 1,
	   'email_popup_text' => __('Please enter a valid email address. You might be required to verify it', 'Super-Socializer'),
	   'enableAtLogin' => 1,
	   'enableAtRegister' => 1,
	   'enableAtComment' => 1
	));
	
	// social commenting options
	add_option('the_champ_facebook', array(
	   'enable_commenting' => '1',
	   'enable_fbcomments' => '1',
	   'enable_page' => '1',
	   'enable_post' => '1',
	   'comment_lang' => get_locale(),
	   'commenting_order' => 'wordpress,facebook,googleplus,disqus',
	   'commenting_label' => 'Leave a reply',
	   'label_wordpress_comments' => 'Default Comments',
	   'label_facebook_comments' => 'Facebook Comments',
	   'label_googleplus_comments' => 'G+ Comments',
	   'label_disqus_comments' => 'Disqus Comments',
	));
	
	// sharing options
	add_option('the_champ_sharing', array(
	   'enable' => '1',
	   'horizontal_sharing_shape' => 'round',
	   'horizontal_sharing_size' => '35',
	   'horizontal_sharing_width' => '70',
	   'horizontal_sharing_height' => '35',
	   'horizontal_border_radius' => '',
	   'horizontal_font_color_default' => '',
	   'horizontal_sharing_replace_color' => '#fff',
	   'horizontal_font_color_hover' => '',
	   'horizontal_sharing_replace_color_hover' => '#fff',
	   'horizontal_bg_color_default' => '',
	   'horizontal_bg_color_hover' => '',
	   'horizontal_border_width_default' => '',
	   'horizontal_border_color_default' => '',
	   'horizontal_border_width_hover' => '',
	   'horizontal_border_color_hover' => '',
	   'vertical_sharing_shape' => 'square',
	   'vertical_sharing_size' => '40',
	   'vertical_sharing_width' => '80',
	   'vertical_sharing_height' => '40',
	   'vertical_border_radius' => '',
	   'vertical_font_color_default' => '',
	   'vertical_sharing_replace_color' => '#fff',
	   'vertical_font_color_hover' => '',
	   'vertical_sharing_replace_color_hover' => '#fff',
	   'vertical_bg_color_default' => '',
	   'vertical_bg_color_hover' => '',
	   'vertical_border_width_default' => '',
	   'vertical_border_color_default' => '',
	   'vertical_border_width_hover' => '',
	   'vertical_border_color_hover' => '',
	   'hor_enable' => '1',
	   'horizontal_target_url' => 'default',
	   'horizontal_target_url_custom' => '',
	   'title' => 'Spread the love',
	   'instagram_username' => '',
	   'horizontal_re_providers' => array( 'facebook', 'twitter', 'google_plus', 'linkedin', 'pinterest', 'reddit', 'delicious', 'stumbleupon', 'whatsapp' ),
	   'hor_sharing_alignment' => 'left',
	   'top' => '1',
	   'post' => '1',
	   'page' => '1',
	   'horizontal_more' => '1',
	   'vertical_enable' => '1',
	   'vertical_target_url' => 'default',
	   'vertical_target_url_custom' => '',
	   'vertical_instagram_username' => '',
	   'vertical_re_providers' => array( 'facebook', 'twitter', 'google_plus', 'linkedin', 'pinterest', 'reddit', 'delicious', 'stumbleupon', 'whatsapp' ),
	   'vertical_bg' => '',
	   'alignment' => 'left',
	   'left_offset' => '-10',
	   'right_offset' => '-10',
	   'top_offset' => '100',
	   'vertical_post' => '1',
	   'vertical_page' => '1',
	   'vertical_home' => '1',
	   'vertical_more' => '1',
	   'hide_mobile_sharing' => '1',
	   'vertical_screen_width' => '783',
	   'bottom_mobile_sharing' => '1',
	   'horizontal_screen_width' => '783',
	   'bottom_sharing_position' => '0',
	   'bottom_sharing_alignment' => 'left',
	   'bitly_username' => '',
	   'bitly_key' => '',
	   'share_count_cache_refresh_count' => '10',
	   'share_count_cache_refresh_unit' => 'minutes',
	   'language' => get_locale(),
	   'twitter_username' => '',
	   'buffer_username' => '',
	   'tweet_count_service' => 'newsharecounts'
	));

	// counter options
	add_option('the_champ_counter', array(
	   'left_offset' => '-10',
	   'right_offset' => '-10',
	   'top_offset' => '100',
	   'alignment' => 'left',
	));

	add_option('the_champ_ss_version', THE_CHAMP_SS_VERSION);
}

/**
 * Plugin activation function
 */
function the_champ_activate_plugin($networkWide){
	global $wpdb;
	if(function_exists('is_multisite') && is_multisite()){
		//check if it is network activation if so run the activation function for each id
		if($networkWide){
			$oldBlog =  $wpdb->blogid;
			//Get all blog ids
			$blogIds =  $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

			foreach($blogIds as $blogId){
				switch_to_blog($blogId);
				the_champ_save_default_options();
			}
			switch_to_blog($oldBlog);
			return;
		}
	}
	the_champ_save_default_options();
}
register_activation_hook(__FILE__, 'the_champ_activate_plugin');

/**
 * Save default options for the new subsite created
 */
function the_champ_new_subsite_default_options($blogId, $userId, $domain, $path, $siteId, $meta){
    if(is_plugin_active_for_network('super-socializer/super_socializer.php')){ 
        switch_to_blog($blogId);
        the_champ_save_default_options();
        restore_current_blog();
    }
}
add_action('wpmu_new_blog', 'the_champ_new_subsite_default_options', 10, 6);

/**
 * Show notification related to add-on update
 */
function the_champ_addon_update_notification(){
	if(current_user_can('manage_options')){
		if(defined('HEATEOR_SOCIAL_SHARE_MYCRED_INTEGRATION_VERSION') && version_compare('1.3.3', HEATEOR_SOCIAL_SHARE_MYCRED_INTEGRATION_VERSION) > 0){
			?>
			<div class="error notice">
				<h3>Social Sharing - myCRED Integration</h3>
				<p>Update "Social Sharing myCRED Integration" add-on for maximum compatibility with current version of Super Socialzer</p>
			</div>
			<?php
		}

		if(defined('HEATEOR_SOCIAL_LOGIN_MYCRED_INTEGRATION_VERSION') && version_compare('1.2.1', HEATEOR_SOCIAL_LOGIN_MYCRED_INTEGRATION_VERSION) > 0){
			?>
			<div class="error notice">
				<h3>Social Login - myCRED Integration</h3>
				<p>Update "Social Login myCRED Integration" add-on for maximum compatibility with current version of Super Socialzer</p>
			</div>
			<?php
		}
	}
}
add_action('admin_notices', 'the_champ_addon_update_notification');

function the_champ_update_db_check(){
	$currentVersion = get_option('the_champ_ss_version');

	if($currentVersion && $currentVersion != THE_CHAMP_SS_VERSION){

		if(version_compare("7.7", $currentVersion) > 0){
			global $theChampSharingOptions;
			$theChampSharingOptions['instagram_username'] = '';
			$theChampSharingOptions['vertical_instagram_username'] = '';
			update_option('the_champ_sharing', $theChampSharingOptions);
		}
		
		if(version_compare("7.6", $currentVersion) > 0){
			global $theChampLoginOptions;
			$theChampLoginOptions['new_user_admin_email'] = '1';
			update_option('the_champ_login', $theChampLoginOptions);
		}

		if(version_compare("6.0", $currentVersion) > 0){
			global $theChampFacebookOptions;
			$theChampFacebookOptions['enable_post'] = '1';
			$theChampFacebookOptions['enable_page'] = '1';
			update_option('the_champ_facebook', $theChampFacebookOptions);
		}

		if(version_compare('7.0', $currentVersion) > 0){
			global $theChampSharingOptions, $theChampLoginOptions, $theChampGeneralOptions;
			
			$theChampSharingOptions['horizontal_re_providers'] = the_champ_replace_array_value($theChampSharingOptions['horizontal_re_providers'], 'google', 'google_plus');
			$theChampSharingOptions['vertical_re_providers'] = the_champ_replace_array_value($theChampSharingOptions['vertical_re_providers'], 'google', 'google_plus');

			// general options
			if(isset($theChampLoginOptions['footer_script'])){
				$theChampGeneralOptions['footer_script'] = '1';
			}
			if(isset($theChampSharingOptions['delete_options'])){
				$theChampGeneralOptions['delete_options'] = '1';
			}

			$theChampSharingOptions['horizontal_sharing_width'] = '70';
			$theChampSharingOptions['horizontal_sharing_height'] = '35';
			$theChampSharingOptions['horizontal_sharing_height'] = '35';
			$theChampSharingOptions['horizontal_border_radius'] = '';
		    $theChampSharingOptions['horizontal_font_color_default'] = '';
		    $theChampSharingOptions['horizontal_sharing_replace_color'] = '#fff';
		    $theChampSharingOptions['horizontal_font_color_hover'] = '';
		    $theChampSharingOptions['horizontal_sharing_replace_color_hover'] = '#fff';
		    $theChampSharingOptions['horizontal_bg_color_default'] = '';
		    $theChampSharingOptions['horizontal_bg_color_hover'] = '';
		    $theChampSharingOptions['horizontal_border_width_default'] = '';
		    $theChampSharingOptions['horizontal_border_color_default'] = '';
		    $theChampSharingOptions['horizontal_border_width_hover'] = '';
		    $theChampSharingOptions['horizontal_border_color_hover'] = '';
		    $theChampSharingOptions['vertical_sharing_width'] = '80';
			$theChampSharingOptions['vertical_sharing_height'] = '40';
			$theChampSharingOptions['vertical_border_radius'] = '';
			$theChampSharingOptions['vertical_font_color_default'] = '';
			$theChampSharingOptions['vertical_sharing_replace_color'] = '#fff';
			$theChampSharingOptions['vertical_font_color_hover'] = '';
			$theChampSharingOptions['vertical_sharing_replace_color_hover'] = '#fff';
			$theChampSharingOptions['vertical_bg_color_default'] = '';
			$theChampSharingOptions['vertical_bg_color_hover'] = '';
			$theChampSharingOptions['vertical_border_width_default'] = '';
			$theChampSharingOptions['vertical_border_color_default'] = '';
			$theChampSharingOptions['vertical_border_width_hover'] = '';
			$theChampSharingOptions['vertical_border_color_hover'] = '';
			$theChampSharingOptions['vertical_screen_width'] = '783';
			$theChampSharingOptions['horizontal_screen_width'] = '783';
			$theChampSharingOptions['bottom_sharing_position'] = '0';
			$theChampSharingOptions['bottom_sharing_alignment'] = 'left';
			$theChampSharingOptions['buffer_username'] = '';
			$theChampSharingOptions['language'] = get_locale();
			$theChampSharingOptions['tweet_count_service'] = 'newsharecounts';

			$customCss = '';
			if(isset($theChampSharingOptions['horizontal_counts'])){
				$theChampSharingOptions['horizontal_counter_position'] = 'top';
				$customCss .= '.the_champ_horizontal_sharing .the_champ_square_count{
			display:block;
			text-indent:0!important;
			visibility:hidden;
			background-color:#58B8F8!important;
			width:auto;
			height:auto;
			text-align:center;
			min-width:8px!important;
			padding:1px 4px!important;
			color:#fff!important;
			font-family:\'Open Sans\',arial,sans-serif!important;
			font-size:10px!important;
			font-weight:600!important;
			-webkit-border-radius:15px!important;
			border-radius:15px!important;
			-webkit-box-shadow:0 2px 2px rgba(0,0,0,.4);
			box-shadow:0 2px 2px rgba(0,0,0,.4);
			text-shadow:0 -1px 0 rgba(0,0,0,.2);
			line-height:14px!important;
			border:2px solid #fff!important;
			z-index:1;
			margin:2px auto!important;
			box-sizing:content-box!important
		}';
			}
			if(isset($theChampSharingOptions['vertical_counts'])){
				if(!isset($theChampSharingOptions['vertical_sharing_shape']) || $theChampSharingOptions['vertical_sharing_shape'] == 'square'){
					$theChampSharingOptions['vertical_counter_position'] = 'inner_top';
				}elseif($theChampSharingOptions['vertical_sharing_shape'] == 'round'){
					$theChampSharingOptions['vertical_counter_position'] = 'top';
					$customCss .= '.the_champ_vertical_sharing .the_champ_square_count{
			display:block;
			text-indent:0!important;
			visibility:hidden;
			background-color:#58B8F8!important;
			width:auto;
			height:auto;
			text-align:center;
			min-width:8px!important;
			padding:1px 4px!important;
			color:#fff!important;
			font-family:\'Open Sans\',arial,sans-serif!important;
			font-size:10px!important;
			font-weight:600!important;
			-webkit-border-radius:15px!important;
			border-radius:15px!important;
			-webkit-box-shadow:0 2px 2px rgba(0,0,0,.4);
			box-shadow:0 2px 2px rgba(0,0,0,.4);
			text-shadow:0 -1px 0 rgba(0,0,0,.2);
			line-height:14px!important;
			border:2px solid #fff!important;
			z-index:1;
			margin:2px auto!important;
			box-sizing:content-box!important
		}';
				}
			}
			$theChampGeneralOptions['custom_css'] = $customCss;

			update_option('the_champ_sharing', $theChampSharingOptions);
			update_option('the_champ_general', $theChampGeneralOptions);
		}

		if(version_compare($currentVersion, '6.9') > 0){
			global $theChampSharingOptions;
			if ( $theChampSharingOptions['horizontal_sharing_replace_color'] != '#fff' ) {
				the_champ_update_svg_css( $theChampSharingOptions['horizontal_sharing_replace_color'], 'share-default-svg-horizontal' );
			}
			if ( $theChampSharingOptions['horizontal_sharing_replace_color_hover'] != '#fff' ) {
				the_champ_update_svg_css( $theChampSharingOptions['horizontal_sharing_replace_color_hover'], 'share-hover-svg-horizontal' );
			}
			if ( $theChampSharingOptions['vertical_sharing_replace_color'] != '#fff' ) {
				the_champ_update_svg_css( $theChampSharingOptions['vertical_sharing_replace_color'], 'share-default-svg-vertical' );
			}
			if ( $theChampSharingOptions['vertical_sharing_replace_color_hover'] != '#fff' ) {
				the_champ_update_svg_css( $theChampSharingOptions['vertical_sharing_replace_color_hover'], 'share-hover-svg-vertical' );
			}
		}

		if(version_compare('7.2', $currentVersion) > 0){
			$theChampSharingOptions['share_count_cache_refresh_count'] = '10';
			$theChampSharingOptions['share_count_cache_refresh_unit'] = 'minutes';
			update_option('the_champ_sharing', $theChampSharingOptions);
		}

		update_option('the_champ_ss_version', THE_CHAMP_SS_VERSION);
	}
}
add_action('plugins_loaded', 'the_champ_update_db_check');

/**
 * Updates SVG CSS file according to chosen logo color
 */
function the_champ_update_svg_css( $colorToBeReplaced, $cssFile ) {
	$path = plugin_dir_url( __FILE__ ) . 'css/' . $cssFile . '.css';
	$content = file( $path );
	if ( $content !== false ) {
		$handle = fopen( dirname( __FILE__ ) . '/css/' . $cssFile . '.css','w' );
		if ( $handle !== false ) {
			foreach ( $content as $value ) {
			    fwrite( $handle, str_replace( '%23fff', str_replace( '#', '%23', $colorToBeReplaced ), $value ) );
			}
			fclose( $handle );
		}
	}
}