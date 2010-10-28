<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="learn">
	<div class="dashboard" id="dashboard">
		<ul><?php echo current_help('tour'); ?></ul>
	</div>
	<div id="content" class="about clear">
        <div class="box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Tour <?php echo $INI['system']['abbreviation']; ?></h2></div>
                <div class="sect guide">
					<ul class="guide-steps">
                        <li>
                            <h3 class="step1">Check Today's Deal</h3>
                            <p class="text"><?php echo $INI['system']['sitename']; ?>Get your deal everyday, including SPA, restaurant, tickets ...</p>
                        </li>
                        <li>
                            <h3 class="step2">Buy</h3>
                            <p class="text">
                                If you like this deal, just click BUY.
                                <img src="/static/img/learn-guide-buy.gif" style="margin-left:-9px;" />
                            </p>
                            <div class="bubble">
                                <div class="bubble-top">
                                    <ol class="buy">
                                        <li>Deal is only limited today, click and get it at once.</li>
                                        <li>Not enough people signing up, refer to your friends?</li>
                                        <li class="last">Refund all the money if nubmer of buyers is still not enough.</li>
                                    </ol>
                                </div>
                                <div class="bubble-bottom"></div>
                            </div>
                        </li>
                        <li>
                            <h3 class="step3">Get <?php echo $INI['system']['couponname']; ?></h3>
                            <p class="text"> Buy and get your coupon -- <?php echo $INI['system']['couponname']; ?> </p>
                            <div class="bubble">
                                <div class="bubble-top">
                                    Get <?php echo $INI['system']['couponname']; ?> in 3 differnt ways:
                                    <ol class="coupon">
                                        <li><strong>Print</strong><br>
                                            <p>You can print it directly<?php echo $INI['system']['couponname']; ?></p>
                                        </li>
                                        <li><strong>Record</strong>
                                            <p>Use bookmard </p>
                                        </li>
                                        <li><strong>Send SMS</strong>
                                            <p>Will send password of <?php echo $INI['system']['couponname']; ?> to your handphone.
                                            </p>
                                        </li>
                                    </ol>
                                </div>
                                <div class="bubble-bottom"></div>
                            </div>
                        </li>
                        <li>
                            <h3 class="step4">Go to Merchants</h3>
                            <p class="text">
                                Bring the SMS or printed voucher <?php echo $INI['system']['couponname']; ?> to merchants, enjoy it!
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
	</div>
	<div id="sidebar">
		<?php include template("block_side_business");?>
		<?php include template("block_side_subscribe");?>
	</div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
