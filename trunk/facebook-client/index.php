<?
echo '<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>';
//
// this file includes FB_API_KEY and FB_SECRET constants and the ConnectDB function
// to connect to your mysql database.
define("FB_API_KEY" , "148451281843294");
define("FB_SECRET" , "69de471eb988025ca0b7a23a4bf632fc");

function ConnectDB() {
	$host="localhost"; // Host name.
	$db_user="root"; // MySQL username.
	$db_password="root"; // MySQL password.
	$database="wroupon"; // Database name.
	if (mysql_connect( $host, $db_user, $db_password ) && mysql_select_db($database)) return 1;	else return 0;
}

//
// the php facebook api downloaded at step 3
include("facebook-client/facebook.php");

if(!ConnectDB()) die;

//
// start facebook api with the codes defined in step 1.
$fb=new Facebook( FB_API_KEY , FB_SECRET );
$fb_user=$fb->get_loggedin_user();
$out="";

if($fb_user) {
	// if we already have a user ID cookie than we link
	// in the database this user with his facebook account
	// using the fb_userid field.
	// this code assumes that when a user login in your
	// community you set up a value in a cookie called "myid".
	// this cookie is the one that you use when you want
	// to remember the user:
	if ($_COOKIES["myid"]) {
		$rs = mysql_query( "select * from user where id <>'".$_COOKIES["myid"]."' and fb_userid='".$fb_user."'" );
		$r = mysql_fetch_array($rs);
		mysql_query("update user set fb_userid='{$fb_user}' where id='".$_COOKIES["myid"]."'");
	}
	//
	// with the user id from facebook retrived with the API,
	// search for a user already registered with this process:
	$rs = mysql_query( "select * from user where fb_userid='$fb_user'" );
	if (@mysql_num_rows($rs)) $u = mysql_fetch_array($rs); else $u="";
	if (is_array($u)) {
		//
		// this is a user connected with facebook
		// and already existing on your community.
		// So, log in automatically with user and password of
		// your community. These lens print a form and submit it
		// to your real login page:
		// (change the address in the action to match your normal login page)
		$out.="log in...";
		$out.="<form id='loginform' method='post' action=\"/account/login.php\">";
		$out.="<input type='hidden' name='email' value=\"".$u['username']."\"/>";
		$out.="<input type='hidden' name='password' value=\"".$u['password']."\"/>";
		$out.="</form>";
		$out.="<script type=\"text/javascript\">document.getElementById('loginform').submit();</script>";

	} else {
		//
		// this is a user logged in on facebook
		// but it doesn't exists on your community,
		// it's new!
		// So let's create automatically the user and log in!
		$out = '<fb:profile-pic class="fb_profile_pic_rendered FB_ElementReady"' .
		'facebook-logo="true" size="square" uid="' . $fb_user . '"></fb:profile-pic>';
		//
		// get some user details from facebook api
		$user_details = $fb->api_client->users_getInfo($fb_user, array('last_name','first_name'));
		//
		// write out some message to welcome the new user:
		$out.= $user_details[0]['first_name']." ".$user_details[0]['last_name'].", welcome on your-site-url.com<br/>";
		$out.= "creating your account on your-site-url.com... wait...";
		$tempuser = preg_replace("/[^a-z0-9]/i","",strtolower( $user_details[0]['first_name'].$user_details[0]['last_name'] ));
		$found = false;
		$i=0;
		while (!$found) {
			//
			// search for a valid username
			// not already used in your community
			// this username is created with first name and last name
			// from facebook and with a counter:
			$user = $tempuser.($i==0?"":$i);
			$rs = mysql_query("select count(*) from user where username='$user'");
			$c = mysql_fetch_row($rs);
			if ( $c[0] >0 ) $i++; else $found = true;
		}
		//
		// generate random password for new user:
		$pass = "fb".rand(1000,2000);
		//
		// empty email:
		$email = "";
		//create the user on your table
		$sql = "INSERT INTO user (" ."username, password, realname, email, fb_userid, fl_facebook".") VALUES ('{$user}','{$pass}','".addslashes($user_details[0]['first_name'])."','".$email."','".$fb_user."','new')";
		
		
		//mysql_query($sql);

		// new user created, log him in:
		$out.="log in...";
		$out.="<form id='loginform' method='post' action=\"/getEmail.php\">";
		$out.="<input type='hidden' name='email' value=\"".$user."\"/>";
		$out.="<input type='hidden' name='password' value=\"".$pass."\"/>";
		$out.="</form>";
		$out.="<script type=\"text/javascript\">document.getElementById('loginform').submit();</script>";
	}
} else {
	//
	// the user probably isn't logged in on facebook, put out
	// the facebook button and clicking on it it will open a pop uo
	// that requires the login on facebook to proceed.
	// the "onlogin" command refresh the page.
	$out = '
	<div"><fb:login-button size="medium" onlogin="document.location.href=document.location.href;"></fb:login-button><br/>
	</div>';
}
?>
<?=$out?>
<?php echo '<script type="text/javascript">  FB.init("<?=FB_API_KEY?>"); </script>'; ?>