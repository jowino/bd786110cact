<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="credit">
	<div class="dashboard" id="dashboard">
		<ul><?php echo current_account('/credit/index.php'); ?></ul>
	</div>
    <div id="content">
		<div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>Balance</h2>
                </div>
                <div class="sect">
					<h3 class="credit-title">Your Current Balance Is:  <strong><?php echo moneyit($login_user['money']); ?></strong> Dollars</h3>
					<table id="order-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
						<tr><th width="120">Time</th><th width="auto">Detail</th><th width="50">Pay and Receive</th><th width="70">Total Amount</th></tr>
						<?php if(is_array($flows)){foreach($flows AS $index=>$one) { ?>
						<tr <?php echo $index%2?'':'class="alt"'; ?>><td style="text-align:left;"><?php echo date('Y-m-d H:i',
                        $one['create_time']); ?></td><td><?php echo $action[$one['action']]; ?>&nbsp;-&nbsp;<?php if($one['action']=='coupon'){?><?php echo $INI['system']['couponname']; ?>Rebate<?php } else if($one['action']=='invite') { ?>Friends:
                        <?php echo $users[$one['detail_id']]['username']; ?><?php } else if($one['action']=='buy') { ?><a href="/team.php?id=<?php echo $one['detail_id']; ?>"><?php echo $teams[$one['detail_id']]['product']; ?></a><?php } else if($one['action']=='refund') { ?><a href="/team.php?id=<?php echo $one['detail_id']; ?>"><?php echo $teams[$one['detail_id']]['product']; ?></a><?php } else if($one['action']=='store') { ?>Topup<?php }?></td><td class="<?php echo $one['direction']; ?>"><?php echo $one['direction']=='income'?'Receive':'Pay'; ?></td><td><?php echo moneyit($one['money']); ?></td></tr>
						<?php }}?>
                    </table>
				</div>
            </div>
            <div class="box-bottom"></div>
        </div>
    </div>
    <div id="sidebar">
		<?php include template("block_side_credit");?>
    </div>
</div>

</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
