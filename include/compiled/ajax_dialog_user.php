<div id="order-pay-dialog" class="order-pay-dialog-c" style="width:380px;">
	<h3><span id="order-pay-dialog-close" class="close" onclick="return X.boxClose();">Close</span></h3>
	<div style="overflow-x:hidden;padding:10px;">
	<table width="96%" class="coupons-table">
		<tr><td width="80"><b>Email: </b></td><td><?php echo $user['email']; ?></td></tr>
		<tr><td><b>UserName: </b></td><td><?php echo $user['username']; ?></td></tr>
		<tr><td><b>RealName: </b></td><td><?php echo $user['realname']; ?></td></tr>
		<tr><td><b>HandPhone: </b></td><td><?php echo $user['mobile']; ?></td></tr>
		<tr><td><b>Balance: </b></td><td><b><?php echo moneyit($user['money']); ?></b> dollars</td></tr>
		<tr><td><b>PostCode: </b></td><td><?php echo $user['zipcode']; ?></td></tr>
		<tr><td><b>Address: </b></td><td><?php echo $user['address']; ?></td></tr>
		<tr><td><b>Register IP: </b></td><td><?php echo $user['ip']; ?></td></tr>
		<tr><td colspan="2"><hr /></td></tr>
		<tr><td><b>Topup Credit: </b></td><td><input type="text" name="in" id="user-dialog-input-id" value="0" size="6" maxLength="6" require="true" datatype="number" class="number" uid="<?php echo $user['id']; ?>" ask="Are you sure to topup? " />&nbsp;&nbsp;<input type="submit" value="Confirm" onclick="return X.manage.usermoney();"/></td></tr>
	</table>
	</div>
</div>
