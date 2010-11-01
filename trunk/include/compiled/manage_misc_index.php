<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="help">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_misc('index'); ?></ul>
	</div>
    <div id="content" class="coupons-box clr mainwide">
		<div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>Home</h2>
				</div>
                <div class="sect">
					<div class="wholetip clr"><h3>Today's Data</h3></div>
					<div style="margin:0 20px;">
						<p>New Registered: <?php echo $user_today_count; ?></p>
						<p>Today's Order: <?php echo $order_today_count; ?></p>
					</div>
					<div class="wholetip clr"><h3>Statistics</h3></div>
					<div style="margin:0 20px;">
						<p>Deals: <?php echo $team_count; ?></p>
						<p>Registered: <?php echo $user_count; ?></p>
						<p>Order: <?php echo $order_count; ?></p>
						<p>Subscriber: <?php echo $subscribe_count; ?></p>
					</div>
				</div>
			</div>
            <div class="box-bottom"></div>
        </div>
    </div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
