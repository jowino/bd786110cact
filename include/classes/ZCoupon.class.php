<?php
class ZCoupon
{
	static public function Consume($coupon) {
		if ( !$coupon['consume']=='N' ) return false;
		$u = array(
			'ip' => Utility::GetRemoteIp(),
			'consume_time' => time(),
			'consume' => 'Y',
		);
		Table::UpdateCache('coupon', $coupon['id'], $u);
		ZFlow::CreateFromCoupon($coupon);
		return true;
	}

	static public function CheckOrder($order) {
		$team = Table::FetchForce('team', $order['team_id']);
		if ( $team['now_number'] >= $team['min_number'] ) {
			//init coupon create;
			if($team['now_number'] == $team['min_number'])
			{
				self::TipSuccess($order);
			}
			if ($team['now_number']-$team['min_number']<5) {
				$orders = DB::LimitQuery('order', array(
					'condition' => array(
						'team_id' => $order['team_id'],
						'state' => 'pay',
					),
				));
				foreach($orders AS $order) {
					self::Create($order);
				}
			}
			else{
				self::Create($order);
			}
		}
	}

	static public function Create($order) {
		if($order['state']=='unpay')
			return;
		$team = Table::Fetch('team', $order['team_id']);
		$partner = Table::Fetch('partner', $order['partner_id']);
		$ccon = array('order_id' => $order['id']);
		$count = Table::Count('coupon', $ccon);

		while($count<$order['quantity']) {
			$id = Utility::GenSecret(12, Utility::CHAR_NUM);
			$cv = Table::Fetch('coupon', $id);
			$coupon = array(
					'id' => Utility::GenSecret(12, Utility::CHAR_NUM),
					'user_id' => $order['user_id'],
					'partner_id' => $team['partner_id'],
					'order_id' => $order['id'],
					'credit' => $team['credit'],
					'team_id' => $order['team_id'],
					'secret' => Utility::GenSecret(8, Utility::CHAR_WORD),
					'expire_time' => $team['expire_time'],
					'create_time' => time(),
					);
			DB::Insert('coupon', $coupon);
			$count = Table::Count('coupon', $ccon);
			$user=Table::Fetch('user',$order['user_id']);
			mail_coupon($team, $partner, $order, $user, $coupon);
		}
	}
	
	static public function TipSuccess($order)
	{
		$orders = DB::LimitQuery('order', array(
					'condition' => array(
						'team_id' => $order['team_id'],
						'state' => 'pay',
					),
				));
	foreach($orders AS $order) {
					$team=Table::Fetch('team',$order['team_id']);
					$user=Table::Fetch('user',$order['user_id']);
					mail_tipped($team, $order, $user);
				}
	}
}
