<div id="order-pay-dialog" class="order-pay-dialog-c" style="width:380px;">
	<h3><span id="order-pay-dialog-close" class="close" onclick="return X.boxClose();">Close</span></h3>
	<p class="info">Please complete your payment in the new open tab.</p>
	<p class="notice">Do not close this window before your paymant is finished.<br> Click the link bellow if payment is finished: </p>
	<p class="act"><input id="order-pay-dialog-succ" class="formbutton" value="Already paid" type="submit" onclick="location.href=WEB_ROOT + '/order/pay.php?id=<?php echo $order_id; ?>';" />&nbsp;&nbsp;&nbsp;<input id="order-pay-dialog-fail" class="formbutton" value="Payment issue" type="submit" onclick="location.href=WEB_ROOT + '/order/pay.php?id=<?php echo $order_id; ?>';" /></p>
	<p class="retry"><a href="/order/check.php?id=<?php echo $order_id; ?>">&raquo;Return back to check other payments</a></p>
</div>
