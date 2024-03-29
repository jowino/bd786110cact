<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="feedback">
    <div id="content" class="clr">
        <div class="box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Gift Card</h2></div>
                <div class="sect">
					<p>Customize Your Gift Card.</p>
                    <form id="feedback-user-form" method="post" action="/gift_cards/giftpay.php" class="validator">
                        <div class="field from">
                            <label for="feedback-fullname">From</label>
                            <input type="text" size="30" name="from" id="feedback-fullname" class="f-input" value="<?php echo $login_user['username']; ?>" require="true" datatype="require" />
                        </div>
                        <div class="field to">
                            <label for="feedback-email-address">To</label>
                            <input type="text" size="30" name="to" id="gift_card_to" class="f-input" require="true" datatype="require" />
                        </div>
                        <div class="field message">
                            <label for="feedback-suggest">Personal Message: <span>(Optional)</span></label>
                            <textarea cols="30" rows="5" name="message" id="gift_card_message" class="xheditor-simple" require="true" datatype="require"></textarea>
                        </div>
                        <div class="field amount">
                            <label for="feedback-suggest">Amount:</label>
                           <input type="text" value="25" size="4" name="amount" maxlength="4" id="gift_card_value">
                      .00
                        </div>
                        <div class="field">
                        	<label for="gift_card_Delivery:">Delivery:</label>
		                    <span>
		                      <input type="radio" value="email" name="gift_card[delivery]" id="gift_card_delivery_method_email" class="radio" checked="checked">
		                      Email it to
		                      <input type="text" title="Enter email here" size="30" name="gift_card[delivery][email_address]" id="gift_card_delivery_email_address" class="prompting_field prompting input" autocomplete="off"><br/>
		                      <input type="radio" value="print" name="gift_card[delivery]" id="gift_card_delivery_method_print" class="radio">
		                      I'll print it myself
		                    
		                    </span>
                        </div>
                        <div class="clr"></div>
                        <div class="paytype">
				<div class="order-check-form "> 
					<ul class="typelist">
					<?php if($INI['paypal']['mid']){?>
						<li><input id="check-paypal" type="radio" name="paytype" value="paypal" <?php echo $ordercheck['paypal']; ?> /><label for="check-paypal" class="paypal">PayPal</label></li>
					<?php }?>					
					<?php if($INI['alipay']['mid']){?>
						<li><input id="check-alipay" type="radio" name="paytype" value="alipay" <?php echo $ordercheck['alipay']; ?> /><label for="check-alipay" class="alipay">Apipay payment for taobao users</label></li>
					<?php }?>
					<?php if($INI['chinabank']['mid']){?>
						<li><input id="check-chinabank" type="radio" name="paytype" value="chinabank" <?php echo $ordercheck['chinabank']; ?> /><label for="check-chinabank" class="chinabank">Support many banks..</label></li>
					<?php }?>
					<li><input id="check-alipay" type="radio" name="paytype" value="cash" <?php echo $ordercheck['alipay']; ?> /><label>Cash on Delivery</label></li>
					</ul>
					<div class="clr"></div>
					<p class="check-act">
					<input type="submit" name="giftpay" value="Confirm and pay the order" class="formbutton" />
					</p>
				</div>
				</div>
                    </form>
				</div>
            </div>
            <div class="box-bottom"></div>
        </div>
	</div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
