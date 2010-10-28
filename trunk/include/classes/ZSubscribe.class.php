<?php
class ZSubscribe
{
	static public function Create($email, $city_id) 
	{
		if (!Utility::ValidEmail($email, true)) return;
		$secret = md5($email . $city_id);
		$table = new Table('subscribe', array(
					'email' => $email,
					'city_id' => $city_id,
					'secret' => $secret,
					));
		Table::Delete('subscribe', $email, 'email');
		$table->insert(array('email', 'city_id', 'secret'));
		
		/* notice */
		/*
		$host = $_SERVER['HTTP_HOST'];
		$u = "http://notice.zuitu.com/subscribe.php?email={$email}&city_id={$city_id}&secret={$secret}&host={$host}";
		Utility::HttpRequest($u);
		*/
	}

	static public function Unsubscribe($subscribe) {
		Table::Delete('subscribe', $subscribe['email'], 'email');

		/* notice */
		$host = $_SERVER['HTTP_HOST'];
		/*
		$u = "http://notice.zuitu.com/unsubscribe.php?email={$subscribe['email']}&secret={$subscribe['secret']}&host={$host}";
		Utility::HttpRequest($u);
		*/
	}
}
