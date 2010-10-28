<?php
class ZInvite
{
	static public function Create($ruser, $newuser) {
		$invite = array(
			'user_id' => $ruser['id'],
			'user_ip' => $ruser['ip'],
			'other_user_id' => $newuser['id'],
			'other_user_ip' => $newuser['ip'],
			'create_time' => time(),
		);
		cookieset('_rid', null, -1);
		return DB::Insert('invite', $invite);
	}

	static public function CheckInvite($order) {
		if ( $order['state'] == 'unpay' ) return;
		global $INI;
		$invitecredit = abs(intval($INI['system']['invitecredit']));
		if (!$invitecredit) return;
		$user = Table::Fetch('user', $order['user_id']);
		if ( !$user || $user['newbie'] != 'Y' ) return;
		$invite = Table::Fetch('invite', $order['user_id'], 'other_user_id');
		if (!$invite || $invite['credit']>0 || $invite['pay']!='N' ) return;

		Table::UpdateCache('invite', $invite['id'], array(
			'credit' => $invitecredit,
			'team_id' => $order['team_id'],
			'buy_time' => time(),
		));
		Table::UpdateCache('user', $order['user_id'], array(
			'newbie' => 'N',
		));
		return true;
	}
}
