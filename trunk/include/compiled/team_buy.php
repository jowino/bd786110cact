<?php include template("header");?>
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="content">
    <form name="team-main-form" action="/team/buy.php?id=<?php echo $team['id']; ?>" method="post" class="validator">
	<input id="deal-per-number" value="<?php echo $team['per_number']; ?>" type="hidden" />
    <div id="deal-buy" class="box">
        <div class="box-top"></div>
        <div class="box-content">
            <div class="head"><h2>Submit Order</h2></div>
            <div class="sect">
            <table class="order-table">
                <tr>
                    <th class="deal-buy-desc">Item</th>
                    <th class="deal-buy-quantity">Amount</th>
                    <th class="deal-buy-multi"></th>
                    <th class="deal-buy-price">Price</th>
                    <th class="deal-buy-equal"></th>
                    <th class="deal-buy-total">Total</th>
                </tr>
                <tr>
                    <td class="deal-buy-desc"><?php echo $team['title']; ?></td>
                    <td class="deal-buy-quantity"><input type="text" class="input-text f-input" maxlength="4" name="quantity" value="<?php echo $order['quantity']; ?>" id="deal-buy-quantity-input" <?php echo $team['per_number']==1?'readonly':''; ?> /><br /><span style="font-size:12px;color:gray;">at most <?php echo $team['per_number']; ?> unit</span></td>
                    <td class="deal-buy-multi">x</td>
                    <td class="deal-buy-price"><span class="money"><?php echo $currency; ?></span><span id="deal-buy-price"><?php echo $team['team_price']; ?></span></td>
                    <td class="deal-buy-equal">=</td>
                    <td class="deal-buy-total"><span class="money"><?php echo $currency; ?></span><span id="deal-buy-total"><?php echo $order['quantity']*$team['team_price']; ?></span></td>
                </tr>
				<?php if($team['delivery']=='express'){?>
                <tr>
                    <td class="deal-buy-desc">Express Delivery</td>
                    <td class="deal-buy-quantity"></td>
                    <td class="deal-buy-multi"></td>
                    <td class="deal-buy-price"><span class="money"><?php echo $currency; ?></span><span id="deal-express-price"><?php echo $team['fare']; ?></span></td>
                    <td class="deal-buy-equal">=</td>
                    <td class="deal-buy-total"><span class="money"><?php echo $currency; ?></span><span id="deal-express-total"><?php echo $team['fare']; ?></span></td>
                </tr>
				<?php }?>

				<tr class="order-total">
                    <td class="deal-buy-desc"><strong>Total Amount: </strong></td>
                    <td class="deal-buy-quantity"></td>
                    <td class="deal-buy-multi"></td>
                    <td class="deal-buy-price"></td>
                    <td class="deal-buy-equal">=</td>
                    <td class="deal-buy-total"><span class="money"><?php echo $currency; ?></span><strong id="deal-buy-total-t"><?php echo $order['origin']; ?></strong></td>
                </tr>
            </table>
			<?php if($team['delivery']=='express'){?>
			<div class="wholetip clear"><h3>Receiver Info</h3></div>
			<div class="field username">
				<label>Receptant</label>
				<input type="text" size="30" name="realname" id="settings-realname" class="f-input" value="<?php echo $login_user['realname']; ?>" require="true" datatype="require" />
			</div>
			<div class="field mobile">
				<label>Handphone</label>
				<input type="text" size="30" name="mobile" id="settings-mobile" class="number" value="<?php echo $login_user['mobile']; ?>" require="true" datatype="mobile" maxLength="11" />
				<span class="hint">Handphone is very important to us.</span>
			</div>
			<div class="field mobile">
				<label>Post code</label>
				<input type="text" size="30" name="zipcode" id="settings-mobile" class="number" value="<?php echo $login_user['zipcode']; ?>" require="true" datatype="zip" maxLength="6" />
			</div>
			<div class="field username">
				<label>Receptant Address</label>
				<input type="text" size="30" name="address" id="settings-address" class="f-input" value="<?php echo $login_user['address']; ?>" require="true" datatype="require" />
				<span class="hint">Address format should be like this: -----------</span>
			</div>
			<?php }?>
            <input id="deal-buy-cardcode" type="hidden" name="cardcode" maxlength="8" value="" />
            <input type="hidden" name="id" value="<?php echo $order['id']; ?>" />
			<div class="form-submit"><input type="submit" class="formbutton" name="buy" value="Confirm and buy"/></div>
            </div>
        </div>
        <div class="box-bottom"></div>
    </div>
    </form>
</div>
<div id="sidebar">
	<?php include template("block_side_credit");?>
	<?php include template("block_side_redemptions");?>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
