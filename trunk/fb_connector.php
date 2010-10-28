<?php
require 'facebook_conn.php';

  $appId = '146856232017000';
  $apisecret = '4688c44c0b99da8a9f0d92310badfea7';

// Create our Application instance.
	$facebook = new Facebook(array(
  	'appId' => $appId,
  	'secret' => $apisecret,
  	'cookie' => true,
	));

// We may or may not have this data based on a $_GET or $_COOKIE based session.
//
// If we get a session here, it means we found a correctly signed session using
// the Application Secret only Facebook and the Application know. We dont know
// if it is still valid until we make an API call using the session. A session
// can become invalid if it has already expired (should not be getting the
// session back in this case) or if the user logged out of Facebook.
	$session = $facebook->getSession();

		$me = null;
		// Session based API call.
		if ($session) {
		  try {
			$uid = $facebook->getUser();
			$me = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
			error_log($e);
		  }
		}

// login or logout url will be needed depending on current user state.
		if ($me) {
		 	 $logoutUrl = $facebook->getLogoutUrl();
		     $_SESSION['FB_LOGOUT_URL'] = $logoutUrl;
		} else {
		 	 $loginUrl = $facebook->getLoginUrl();
		}

?>
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
FB.init({
appId : '<?php echo $facebook->getAppId(); ?>',
session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
status : true, // check login status
cookie : true, // enable cookies to allow the server to access the session
xfbml : true // parse XFBML
});
/* FB.login(function(response) {
    Log.info('FB.login callback', response);
    if (response.session) {
      Log.info('User is logged in');
    } else {
      Log.info('User is logged out');
    }
  });
*/
// whenever the user logs in, we refresh the page
FB.Event.subscribe('auth.login', function() {
window.location.reload();
//window.open("http://www.facebook.com");

});
};

(function() {
var e = document.createElement('script');
e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
e.async = true;
document.getElementById('fb-root').appendChild(e);
}());
</script>
<?php require_once(dirname(__FILE__) . '/app.php'); ?>


<?php
          // $det = ZLogin::GetLoginId();
if(!$_SESSION['user_id']) {
	if($me) {
	   	$login_user = ZUser::GetUserByFB_IdMail($me['id'],$me['email']);
		if($login_user) {
			if(!$login_user['fb_userid']) {
				//update
				  $sql = "update user set fb_userid = '".$me['id']."',fl_facebook='new'  where id ='".$login_user['id']."'";
		          mysql_query($sql);
				//login
					Session::Set('user_id', $login_user['id']);
					ZLogin::Remember($login_user);
					($goto = Session::Get('loginpage', true)) || ($goto = WEB_ROOT.'/index.php');
					Utility::Redirect($goto);
			} else {
					Session::Set('user_id', $login_user['id']);
					ZLogin::Remember($login_user);
					($goto = Session::Get('loginpage', true)) || ($goto = WEB_ROOT.'/index.php');
					Utility::Redirect($goto);
			}
		} else {
			$username = preg_replace("/[^a-z0-9]/i","",strtolower( $me['name']));
			$u['email'] = $me['email'];
			$u['username'] = $username;
			$u['realname'] = $me['first_name']." ".$me['last_name'];
			$u['password'] = "fb".rand(1000,2000);
			$u['fb_userid'] = $me['id'];
			$u['fl_facebook'] = 'new';
			$_SESSION['FB_USER_LOGIN'] = $u;
			Utility::Redirect( WEB_ROOT . '/account/signupemail.php');
		}
	}
?>
<fb:login-button onlogin="Groupon.FacebookConnect.onConnect()" perms="publish_stream,email,user_birthday">Connect</fb:login-button>
<!--<fb:login-button></fb:login-button>-->

<?php } ?>

