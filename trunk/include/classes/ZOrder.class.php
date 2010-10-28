<?php
class ZOrder {
	static public function CashIt($order) {
		if (! $order['state']=='pay' ) return 0;

		//update user money;
		$user = Table::Fetch('user', $order['user_id']);
		Table::UpdateCache('user', $order['user_id'], array(
			'money' => moneyit($user['money'] - $order['credit']),
		));

		//update order
		Table::UpdateCache('order', $order['id'], array(
			'state' => 'pay',
			'service' => 'cash',
			'money' => $order['origin'],
		));

		$order = Table::FetchForce('order', $order['id']);
		ZTeam::BuyOne($order);
	}
}
?>
