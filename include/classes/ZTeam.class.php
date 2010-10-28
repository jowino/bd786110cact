<?php
class ZTeam
{
	static public function GetById($id=1) {
		if (is_array($id)) {
		}
	}

	static public function GetByIds() {
	}

	static public function BuyOne($order) {
		$order = Table::FetchForce('order', $order['id']);
		$team = Table::FetchForce('team', $order['team_id']);
		$team['now_number'] += $order['quantity'];
		if ( $team['max_number']>0 
				&& $team['now_number'] >= $team['max_number'] ) {
			$team['state'] = 'soldout';
			$team['close_time'] = time();
		}
		$table = new Table('team', $team);
		$table->update(array( 'end_time', 'state', 'now_number',));

		ZFlow::CreateFromOrder($order);
		ZCoupon::CheckOrder($order);
		ZInvite::CheckInvite($order);
	}
	
	/* only for cron */
	static public function SetState($team) {
		if ( $team['now_number'] >= $team['max_number'] ) {
			$team['state'] = 'soldout';
		}
		else if ( $team['now_number'] >= $team['min_number'] ) {
			$team['state'] = 'success';
		} else {
			$team['state'] = 'failuer';
		}
		$team['close_time'] = $team['close_time'] ?
			$team['close_time'] : strtotime(date('Y-m-d'));
		$table = new Table('team', $team);
		$table->update(array( 'close_time', 'state',));
		self::SetOrderState($team);
	}

	/* only for cron */
	static public function SetOrderState($team) {
		if ($team->close_time == 0) return;
		$c = array(
			'team_id' => $team['id'],
			'state' => 'unpay',
		);
		$os = DB::LimitQuery('order', array(
			'condition' => $condition,
		));
		$ids = Utility::GetColumn($os, 'id');
		foreach( $ids AS $id ) {
			Table::UpdateCache('order', $id, array('state' => 'expire'));
		}
	}
}
?>
