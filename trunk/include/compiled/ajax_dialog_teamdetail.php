<div id="order-pay-dialog" class="order-pay-dialog-c" style="width:480px;">
	<h3><span id="order-pay-dialog-close" class="close" onclick="return X.boxClose();">Close</span></h3>
	<div style="overflow-x:hidden;padding:10px;">
	<table width="96%" align="center" class="coupons-table">
		<tr><td width="80"><b>Item: </b></td><td><b><?php echo $team['title']; ?></b></td></tr>
		<tr><td><b>Deal Open Time: </b></td><td>Start: <b><?php echo date('Y-m-d',$team['begin_time']); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End: <b><?php echo date('Y-m-d',$team['end_time']); ?></b></td></tr>

		<tr><td><b>Curret Status: </b></td><td><span style="color:#F00;font-weight:bold;"><?php echo state_explain($team['state']); ?></span></td></tr>
		<tr><td><b>Amount Limited: </b></td><td>Minumum: <?php echo $team['min_number']; ?>&nbsp;&nbsp;&nbsp;&nbsp;Maximum: <?php echo $team['max_number']==0?'No limits':$team['max_number']; ?></td></tr>
		<tr><td><b>Item Price: </b></td><td>Normal Price: <b><?php echo moneyit($team['market_price']); ?></b>&nbsp;Dollars&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deal Price：<b><?php echo moneyit($team['team_price']); ?></b>&nbsp;Dollars</td></tr>
		<tr><th colspan="2"><hr/></th></td>
		<tr><td><b>Order Number: </b></td><td><?php echo $team['now_number']; ?>&nbsp;&nbsp;&nbsp;(Caution Cheat)</td></tr>
		<tr><td><b>Acctual Number: </b></td><td><?php echo $nowcount; ?>&nbsp;&nbsp;&nbsp;( will buy)</td></tr>
		<tr><td><b>Online Payment: </b></td><td><b><?php echo moneyit($onlinepay); ?></b>&nbsp;Dollars</td></tr>
		<tr><td><b>Account Credit Pay: </b></td><td><b><?php echo moneyit($creditpay); ?></b>&nbsp;dollars</td></tr>
		<tr><td><b>Total Amount: </b></td><td><b><?php echo moneyit($onlinepay+$creditpay); ?></b>&nbsp;dollars</td></tr>
	<?php if(abs(time()-$team['begin_time'])<86400){?>
		<tr><th colspan="2"><hr/></th></td>
		<tr><td><b>Subscription: </b></td><td>Send/Subscribe - (<span id="dialog_subscribe_count_id">0</span>/<?php echo $subcount; ?>)&nbsp;&nbsp;<input type="button" id="dialog_subscribe_button_id" value="Send This Notice" onclick="if(confirm('Sending email, please be patient? ')){this.disabled=true;return X.misc.noticenext(<?php echo $team['id']; ?>,0);}"/></td></tr>
	<?php }?>
	</table>
	</div>
</div>
