<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_login();

$action = strval($_GET['action']);
$id = $order_id = abs(intval($_GET['id']));

if (!$order_id) {
	json('Order is not exist', 'alert');
}

if ( $action == 'dialog' ) {
	$html = render('ajax_dialog_order');
	json($html, 'dialog');
}
?>
