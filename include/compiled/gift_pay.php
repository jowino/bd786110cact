<?php include template("header");?>
<?php if(is_get()){?>
<div class="sysmsgw" id="sysmsg-error"><div class="sysmsg"><p>This order is not paid yet, please pay it again.</p><span class="close">Close</span></div></div>
<?php }?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="order-pay">
    <div id="content">
        <div id="deal-buy" class="box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>You Should Pay: <strong class="total-money"><?php echo moneyit($total_money); ?></strong> USD</h2>
                </div>
                <div class="sect">
                    <div style="text-align:left;">
<?php if($order['paytype']=='credit'){?>
<form id="order-pay-credit-form" method="post" sid="<?php echo $order_id; ?>">
	<input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
	<input type="hidden" name="service" value="credit" />
	<input type="submit" class="formbutton gotopay" value="Use account balance" />
</form>
<?php } else if($order['paytype']=='cash') { ?>
<form id="order-pay-form" method="post" sid="<?php echo $order['id']; ?>">
	<input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
	<input type="hidden" name="service" value="cash" />
	<label>Cash on Delivery:</label><textarea cols="45" rows="5" name="remark"></textarea><br>
	<input type="submit" name="cod" class="formbutton gotopay" value="Confirm Order" />
</form>
<br />
<?php } else if($order['paytype']=='paypal') { ?>
<form id="order-pay-form" method="post" action="https://www.paypal.com/cgi-bin/webscr" target="_blank" sid="<?php echo $order['id']; ?>">
	<input type="hidden" name="rm" value="2" />
	<input type="hidden" name="cmd" value="_xclick" />
	<input type="hidden" name="business" value="<?php echo $seller_acc; ?>" />
	<input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>" />
	<input type="hidden" name="return" value="<?php echo $return_url; ?>" />
	<input type="hidden" name="transaction_subject" value="Wroupon transcation - test" />
	<input type="hidden" name="item_name" value="<?php echo $subject; ?>" />
	<input type="hidden" name="item_number" value="<?php echo $out_trade_no; ?>" />
	<input type="hidden" name="currency_code" value="USD" />
	<input type="hidden" name="amount" value="<?php echo $total_money; ?>" />
	<img src="/static/css/i/paypal_logo.gif" /><br /><input type="submit" name="confirm" class="formbutton gotopay" value="Goto PayPal" />
</form>
<br />

<?php } else if($order['paytype']=='alipay') { ?>
<form id="order-pay-form" method="post" action="https://www.alipay.com/cooperate/gateway.do?_input_charset=<?php echo $_input_charset; ?>" target="_blank" sid="<?php echo $order['id']; ?>">
	<input type="hidden" name="body" value="<?php echo $body; ?>" />
	<input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>" />
	<input type="hidden" name="out_trade_no" value="<?php echo $out_trade_no; ?>" />
	<input type="hidden" name="partner" value="<?php echo $partner; ?>" />
	<input type="hidden" name="payment_type" value="1" />
	<input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
	<input type="hidden" name="seller_email" value="<?php echo $seller_email; ?>" />
	<input type="hidden" name="service" value="<?php echo $service; ?>" />
	<input type="hidden" name="show_url" value="<?php echo $show_url; ?>" />
	<input type="hidden" name="subject" value="<?php echo $subject; ?>" />
	<input type="hidden" name="total_fee" value="<?php echo $total_money; ?>" />
	<input type="hidden" name="sign_type" value="<?php echo $sign_type; ?>" />
	<input type="hidden" name="sign" value="<?php echo $sign; ?>" />
	<img src="/static/css/i/alipay.png" /><br /><input type="submit" class="formbutton gotopay" value="Goto Alipay" />
</form>
<?php }?>
						<div class="back-to-check"><a href="/gift_cards/index">&raquo; Go back to choose other payment</a></div>
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
