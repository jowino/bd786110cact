<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'order/pay');
}

$condition = array(
	'state' => 'pay',
);
if($_GET&&$_GET['mysubmit']=="Filter")
{

		$uemail = strval($_GET['uemail']);
		if ($uemail) {
			$uuser = Table::Fetch('user', $uemail, 'email');
			if($uuser) $condition['user_id'] = $uuser['id'];
			else $uemail = null;
			}

}

$count = Table::Count('order', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$orders = DB::LimitQuery('order', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

$pay_ids = Utility::GetColumn($orders, 'pay_id');
$pays = Table::Fetch('pay', $pay_ids);

$user_ids = Utility::GetColumn($orders, 'user_id');
$users = Table::Fetch('user', $user_ids);

$team_ids = Utility::GetColumn($orders, 'team_id');
$teams = Table::Fetch('team', $team_ids);
if($_GET&&$_GET['mysubmit']=="Export")
{
			$file_name   =   "Deal-buyer "; 
			$file_extend   =   "csv ";  
			
			header( "Content-Type:   text/csv "); 
			header( "Content-Disposition:   attachment;   filename=$file_name.$file_extend "); 
			header( "Pragma:   no-cache "); 
			header( "Expires:   0 "); 
			echo "UserName,Email\r\n";
			foreach ($users as $user)
			{
				echo $user['username'].','.$user['email']."\r\n";
			}
			return ;
}


include template('manage_order_pay');
