<div id="order-pay-dialog" class="order-pay-dialog-c" style="width:450px;">
	<h3><span id="order-pay-dialog-close" class="close" onclick="return X.boxClose();">Close</span>Charity Report</h3>
	<div style="overflow-x:hidden;padding:10px;">
	<input type="hidden" name="id" value="<?php echo $charityreport['id']; ?>" />
		<!-- <b>Name: </b></td><td><?php echo $charity['name']; ?> -->
		<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="100">Deal ID</th><th width="250">Deal Amount</th><th width="200">Charity Amount</th></tr>
					<?php if(is_array($charityreport)){foreach($charityreport AS $index=>$one) { ?>
					<tr <?php echo $index%2?'':'class="alt"'; ?>>
						<td><?php echo $one['deal_id']; ?></td>
						<td><?php echo moneyit($one['dealamount']); ?></td>
						<td>
							<?php echo moneyit($one['value']*$one['dealamount']/100); ?>
						</td>
					</tr>
					<?php }}?>
					<tr><td colspan="6"><?php echo $pagestring; ?></td></tr>
       </table>
	</div>
</div>
