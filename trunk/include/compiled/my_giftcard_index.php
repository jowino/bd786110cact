<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons">
	<div class="dashboard" id="dashboard">
		<ul><?php echo current_account('/my/gift_cards/index.php'); ?></ul>
	</div>
    <div id="content" class="coupons-box clr">
		<div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>My Gifts</h2>
				</div>
                <div class="sect">
					<div style="float:right;margin-right:20px;"></div>
				
					<?php if($selector=='index'&&!$gift_cards){?>
					<div class="notice">There is no Gifts</div>
					<?php }?>
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
						<tr><th width="100">To</th><th width="100" nowrap>What</th><th width="160" nowrap>Purchase Date</th><th width="100" nowrap>Status</th></tr>
					<?php if(is_array($gift_cards)){foreach($gift_cards AS $index=>$one) { ?>
						<tr <?php echo $index%2?'':'class="alt"'; ?>>
							<td><?php echo $one['to']; ?></td>
							<td><?php echo $one['message']; ?></td>
							<td><?php echo date('Y-m-d', $one['create_time']); ?></td>
							<td><?php echo $one['status']; ?></td>
						</tr>	
					<?php }}?>
						<tr><td colspan="5"><?php echo $pagestring; ?></td></tr>
                    </table>
				</div>
            </div>
            <div class="box-bottom"></div>
        </div>
    </div>
    <div id="sidebar">
		<?php include template("block_side_aboutgiftcard");?>
    </div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
