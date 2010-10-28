<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');


if ( isset($_POST['email'])) 
{

	


	if ( ! Utility::ValidEmail($_POST['email'], true) ) {
		Session::Set('error', 'Email is not a valid email address');
		Utility::Redirect( WEB_ROOT . '/account/signup_twitteremail.php');
	}
    


	$user_details = $_SESSION['TWITTER_USER_LOGIN'];
	$user_details['email'] = $_POST['email'];
	$user_details['username'] = $_POST['username'];
	$user_details['password'] = $_POST['password'];
	$user_details['twitter_userid'] = $_SESSION['TWITTER_USER_LOGIN']['twitter_userid'];
	
	 unset($_SESSION['TWITTER_USER_LOGIN']);
	 


	//$login_TWuserDetails = ZUser::GetTWUserByEmail($user_details['email'],$user_details['twitter_userid']);
//	$login_userEmailCheck =ZUser::GetUserByEmail($user_details['email']);
//	
//	var_dump($login_TWuserDetails);
//	
//	var_dump($login_userEmailCheck);
//	
//	 if($login_TWuserDetails['id']!=''){
//	      ZLogin::Login($login_TWuserDetails['id']);
//		 // setcookie('_twitter_sess','1');
//		  Utility::Redirect( WEB_ROOT . '/index.php');
// 	 }
	 


	 
		 //if($login_userEmailCheck!='')
//		 {
//				  $sql = "update user set twitter_userid = '".$user_details['twitter_userid']."'  where id ='".$login_userEmailCheck['id']."'";
//				   mysql_query($sql);
//				   ZLogin::Login($login_userEmailCheck['id']);
//				   Utility::Redirect( WEB_ROOT . '/index.php');
//		}
//		else
//		{		
//				if($user_id = ZUser::Create($user_details))
//				{
//					ZLogin::Login($user_id);
//					Utility::Redirect( WEB_ROOT . '/index.php');
//				}
//		}
		
		if($user_id = ZUser::Create($user_details))
		{
			ZLogin::Login($user_id);
			Utility::Redirect( WEB_ROOT . '/index.php');
		}

 }	
 
	
include template('signup_twitteremail');

?>

