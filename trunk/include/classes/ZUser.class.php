<?php
class ZUser
{
	const SECRET_KEY = '@4!@#$%@';

	static public function GenPassword($p) {
		return md5($p . self::SECRET_KEY);
	}

	static public function Create($user_row) {
		$user_row['password'] = self::GenPassword($user_row['password']);
		$user_row['create_time'] = $user_row['login_time'] = time();
		$user_row['ip'] = Utility::GetRemoteIp();
		$user_row['secret'] = md5(Utility::GenSecret(12));
		$user_row['id'] = DB::Insert('user', $user_row);
		if ($_COOKIE['_rid']) {
			$r_user = Table::Fetch('user', $_COOKIE['_rid']);
			if ( $r_user ) ZInvite::Create($r_user, $user_row);
		}
		if ( $user_row['id'] == 1 ) {
			Table::UpdateCache('user', $user_row['id'], array(
						'manager'=>'Y',
						'secret' => '',
						));
		}
		return $user_row['id'];
	}

	static public function GetUser($user_id) {
		if (!$user_id) return array();
		return DB::GetTableRow('user', array('id' => $user_id));
	}

	static public function GetLoginCookie($cname='ru') {
		if(isset($_COOKIE[$cname])) {
			$zone = base64_decode($_COOKIE[$cname]);
			$p = explode('@', $zone, 2);
			return DB::GetTableRow('user', array(
				'id' => $p[0],
				'password' => $p[1],
			));
		}
		return Array();
	}

	static public function GetLogin($email, $password, $en=true) {
		if($en) $password = self::GenPassword($password);
		return DB::GetTableRow('user', array(
					'email' => $email,
					'password' => $password,
		));
	}
	
	// Custom functions for facebook connect

	static public function GetUserByFB_Id($fb_userid) {
		if (!$fb_userid) return array();
		return DB::GetTableRow('user', array('fb_userid' => $fb_userid));
	}
	static public function GetUserByEmail($email) {
		if (!$email)return array();
 		   return DB::GetTableRow('user', array('email' => $email));
		
	}
	
	static public function GetUserByFB_IdMail($fb_userid,$email) {
		if ($email!=''){ 
		     return DB::GetTableRow('user', array('email' => $email));
		}else{
		     return DB::GetTableRow('user', array('fb_userid' => $fb_userid));
		}
	}
	
	static public function GetTWUserByEmail($email,$twitter_userid) {
		if (!$email) return array();
		return DB::GetTableRow('user', array('email' => $email,'twitter_userid'=>$twitter_userid));
	}
  
  // Custom functions for twitter connect
	static public function GetUserByTwitter_Id($twitter_userid) {
	   	if (!$twitter_userid) return array();
		return DB::GetTableRow('user', array('twitter_userid' => $twitter_userid));
	}
	static public function PostNewComments($details) 
	{
	    $added_date = date('Y-m-d :H:m:s');
		$user_id = $details['user_id'];
		$team_id = $details['team_id'];
		$comments = $details['comments'];
		
		
		$table = new Table('comments', array(
					'user_id' => $user_id,
					'team_id' => $team_id,
					'comments' => $comments,
					'added_date' =>$added_date,
					'status' =>'active',
					));
		$table->insert(array('user_id', 'team_id', 'comments','added_date','status'));
	}
}
