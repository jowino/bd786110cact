<?php include template("header");?>
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="content">
    <div id="order-pay-return" class="box">
        <div class="box-top"></div>
        <div class="box-content">
			<div class="success"><h2>Successful Payment</h2> </div>
            <div class="sect">
                <p class="error-tip">Check the <a href="/order/view.php?id=<?php echo $order_id; ?>">detailed information</a>&nbsp;of your deal&nbsp;<a href="/team.php?id=<?php echo $order['team_id']; ?>"><?php echo $team['title']; ?></a>&nbsp;&nbsp;</p>
            </div>
		</div>
		<div class="box-bottom"></div>
	</div>
</div>
<div id="side">
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
