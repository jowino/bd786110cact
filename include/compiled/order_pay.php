<?php include template("header");?>
<?php if(is_get()){?>
<div class="sysmsgw" id="sysmsg-error"><div class="sysmsg"><p>This order is not paid yet, please pay it again.</p><span class="close">Close</span></div></div>
<?php }?>



  <div class="clr"></div>

  <div id="inner-content">

  	<div class="inner-content-top"></div>

	<div class="inner-content-middle">

		<div id="daily-deals-left">
		<h2>Order Review:</h2>

		<table width="743" border="0" cellpadding="0" cellspacing="0" id="cart">
			<tr>
				<td>
					<table width="741" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
						<th class="cart-left-bg" style="width:125px;">&nbsp;</th>
						<th style="width:338px;">Product Name</th>
						<th style="width:95px;">Unit Price</th>
						<th style="width:75px;">Qty</th>
						<th class="cart-right-bg" style="width:106px;">Subtotal</th>
					  </tr>
					  <tr valign="top">
						<td><img src="<?php echo team_image($team['image']); ?>" width="110px" /></td>
						<td><p><?php echo $team['title']; ?></p></td>
						<td align="center" valign="middle"><p><?php echo $team['team_price']; ?></p></td>
						<td align="center" valign="middle"><p><?php echo $order['quantity']; ?></p>
						</td>
						<td class="cart-last" align="center" valign="middle"><p><?php echo $team['team_price']*$order['quantity']; ?></p></td>
					  </tr>
				  </table>
				</td>
			</tr>
		</table>

<div style="text-align:right;font-weight:bold;margin:10px;font-size:12px;">Your Balance: <strong class="total-money"><?php echo moneyit($login_user['money']); ?></strong></div>
		<div style="text-align:right;font-weight:bold;margin:10px;font-size:16px;">Grand Total: <strong class="total-money"><?php echo moneyit($total_money); ?></strong></div>

		<div class="clr"></div>

	<div id="container-dailydeals-5">

			<ul>

				<li>1 Checkout Method</li>

				<li>2 Buy For Friend</li>

				<li>3 Billing Information</li>

				<li>4 Payment Information</li>

				<li class="white">5 Order Review</li>

			</ul>

			<div id="tab-2">
				
				<div style="text-align:left;">
<?php if($order['service']=='credit'){?>
<form id="order-pay-credit-form" method="post" sid="<?php echo $order_id; ?>">
	<input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
	<input type="hidden" name="service" value="credit" />
	<input type="submit" class="formbutton gotopay" value="Use account balance" />
</form>
<?php } else if($order['service']=='cash') { ?>
<form id="order-pay-form" method="post" sid="<?php echo $order['id']; ?>">
	<input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
	<input type="hidden" name="service" value="cash" />
	<label>Cash on Delivery:</label><textarea cols="45" rows="5" name="remark"></textarea><br>
	<input type="submit" name="cod" class="formbutton gotopay" value="Confirm Order" />
</form>
<br />
<?php } else if($order['service']=='paypal') { ?>
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
	<img src="/static/css/i/paypal_logo.gif" /><br /><input type="submit" class="formbutton gotopay" value="Goto PayPal" />
</form>
<br />

<?php } else if($order['service']=='alipay') { ?>
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
<?php } else if($order['service']=='chinabank') { ?>
<form id="order-pay-form" method="post" action="https://pay3.chinabank.com.cn/PayGate" target="_blank" sid="<?php echo $order['id']; ?>">
	<input type="hidden" name="v_mid" value="<?php echo $v_mid; ?>" />
	<input type="hidden" name="v_oid" value="<?php echo $v_oid; ?>" />
	<input type="hidden" name="v_amount" value="<?php echo $total_money; ?>" />
	<input type="hidden" name="v_moneytype" value="<?php echo $v_moneytype; ?>" />
	<input type="hidden" name="v_url" value="<?php echo $v_url; ?>" />
	<input type="hidden" name="v_md5info" value="<?php echo $v_md5info; ?>" />
	<img src="/static/css/i/chinabank.png" /><br/><input type="submit" class="formbutton gotopay" value="Internet banking pay" style="vertical-align:middle;"/>
</form>
<?php } else if($order['service']=='migs') { ?>

<form id="order-pay-form" method="post" action="/migsvpcphp/vpc_php_serverhost_do.php" target="_blank" sid="<?php echo $order['id']; ?>">
	<input type="hidden" name="Title" value="PHP VPC 3-Party">
	<input type="hidden" name="virtualPaymentClientURL" value="https://migs.mastercard.com.au/vpcpay" maxlength="250">
	<input type="hidden" name="vpc_Version" value="<?php echo $version;?>" size="20" maxlength="8">
	<input type="hidden" name="vpc_Command" value="<?php echo $type;?>" size="20" maxlength="16">
	<input type="hidden" name="vpc_AccessCode" value="<?php echo $accesscode;?>" size="20" maxlength="8">
	<input type="hidden" name="vpc_MerchTxnRef" value="<?php echo $order['id']; ?>" size="20" maxlength="40">
	<input type="hidden" name="vpc_Merchant" value="<?php echo $mid;?>" size="20" maxlength="16">
	<input type="hidden" name="vpc_OrderInfo" value="" size="20" maxlength="34">
	<input type="hidden" name="vpc_Amount" value="<?php echo $total_money*100;?>" size="20" maxlength="10">
	<input type="hidden" name="vpc_Locale" value="<?php echo $locale;?>" size="20" maxlength="5">
	<input type="hidden" name="vpc_ReturnURL" size="63" value="<?php echo $returnURL;?>" maxlength="250">
	<br/><input type="submit" name="SubButL" class="formbutton gotopay" value="MIGS payment" style="vertical-align:middle;"/>
</form>
<?php }?>
						<div class="back-to-check"><a href="/order/check.php?id=<?php echo $order_id; ?>">&raquo; Go back to choose other payment</a></div>
                    </div>				

			</div>

		</div>

		</div>

		<div id="daily-deals-right">

		<div class="daily-deals-right-top"></div>

		<div class="daily-deals-right-middle">

		<h2>Your Checkout Progress<br />

		  <br />

		</h2>

		<p>Billing Address<br />Payment Method</p>

		</div>

		<div class="daily-deals-right-bottom"></div>

		<div class="daily-deals-right-top"></div>

		<div class="daily-deals-right-middle">

		<h2>Online Payment & Security<br />

		  <br />

		</h2>

		<h3>Questions about payment?</h3>

		<p>Billing Address<br />Payment Method<br />

		  <br />

		</p>

		<h2>Call: +971-4-2831911</h2>

		<p>email: support@moosavings.com<br />

		  <br />

		</p>

		<h3>How secure is buying here?</h3>

		<p>Extremely secure. We don't store payment info on our servers. We use eBay-owned PayPal to process credit card and PayPal payments, and we use VeriSign's highest level of SSL encryption (click the logo below; check for the green address bar).

          <br />

		  <br />

		</p>

		<h3>Am I charged right away?

</h3>

		<p>f the deal hasn't tipped yet, no. We first authorize your credit card. When the deal tips, we charge your card and send you a receipt. If the deal doesn't tip we cancel this card authorization, and you're not charged.<br />

		  <br />

		</p>

		<h3>What's happens after tipping/buying?

</h3>

		<p>You'll get your receipt right away. You'll get your Nabit voucher the next business day after the deal closes.

          <br />

		  <br />

		</p>

<h3>Do you give refunds?</h3>

<p>We handle all refund enquiries ourselves, not the local business. More info here.</p>

		</div>

		<div class="daily-deals-right-bottom"></div>

		</div>

		<div class="clr"></div>

	</div>

	<div class="inner-content-bottom"></div>  

  </div>






<?php include template("footer");?>
