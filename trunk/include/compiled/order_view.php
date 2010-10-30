<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="order-detail">
	<div class="dashboard" id="dashboard">
		<ul><?php echo current_account(null); ?></ul>
	</div>
    <div id="content">
		<div class="box clear">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>Order Detail</h2>
                </div>
                <div class="sect">

<table cellspacing="0" cellpadding="0" border="0" class="data-table">
    <tr>
        <th>Order Number: </th>
        <td class="orderid"><strong><?php echo $order['id']; ?></strong></td>
        <th>Order Time:</th>
        <td><span><?php echo date('m.d.Y:i',$order['create_time']); ?></span></td>
    </tr>
</table>

<table cellspacing="0" cellpadding="0" border="0" class="info-table">
    <tr>
        <th class="left" width="auto">Deal Item</th>
        <th width="35">Value</th>
        <th width="10"></th>
        <th width="45">Quantity</th>
        <th width="10"></th>
        <th width="45">Total amount</th>
        <th width="45">Payment Method</th>
        <th width="150">Status</th>
    </tr>
    <tr>
        <td class="left"><a class="deal-title" href="/team.php?id=<?php echo $order['team_id']; ?>" target="_blank"><?php echo $team['title']; ?></a></td>
        <td><span class="money"><?php echo $currency; ?></span><?php echo moneyit($team['team_price']); ?></td>
        <td>x</td>
        <td><?php echo $order['quantity']; ?></td>
        <td>=</td>
        <td class="total"><span class="money"><?php echo $currency; ?></span><?php echo moneyit($team['team_price']*$order['quantity']); ?></td>
        <td><?php echo $order['service']=='cash'?"Cash on Delivery":$order['service']; ?></td>
        <td class="status"><?php if($order['state']=='unpay'){?>Pending<?php } else if(!$express) { ?>Done<?php } else { ?>-<?php }?></td>
    </tr>

<?php if($express){?>
    <tr>
        <td class="left">Express Delivery</td>
        <td><?php echo moneyit($team['fare']); ?></td>
        <td>x</td>
        <td>1</td>
        <td>=</td>
        <td class="total"><span class="money"><?php echo $currency; ?></span><?php echo moneyit($team['fare']); ?></td>
        <td class="status">-</td>
    </tr>
    <tr>
        <td class="left"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="total"><span class="money"><?php echo $currency; ?></span><?php echo moneyit($order['origin']); ?></td>
        <td class="status">Done</td>
    </tr>
<?php }?>

</table>

<?php if($team['delivery']=='coupon'){?>
<table cellspacing="0" cellpadding="0" border="0" class="data-table">
    <tr>
        <th><?php echo $INI['system']['couponname']; ?>：</th>
        <td class="other-coupon"><?php if(empty($coupons)){?><?php echo $INI['system']['couponname']; ?>System will send it when the deal is on.<?php }?><?php if(is_array($coupons)){foreach($coupons AS $one) { ?><p><?php echo $one['id']; ?> - <?php echo $one['secret']; ?></p><?php }}?></td>
    </tr>
    <tr>
        <th>How To Use: </th>
        <td>Please show <?php echo $INI['system']['couponname']; ?> when you are using this coupon. Be cooperative when your coupon and password is confirmed.</td>
    </tr>
</table>
<?php } else if($team['delivery']=='express') { ?>
<table cellspacing="0" cellpadding="0" border="0" class="data-table">
    <tr>
        <th>Delivery: </th>
        <td class="other-coupon"></td>
    </tr>
    <tr>
        <th>Recieptant: </th>
        <td><?php echo $order['realname']; ?></td>
    </tr>
    <tr>
        <th>Order Address: </th>
        <td><?php echo $order['address']; ?></td>
    </tr>
    <tr>
        <th>Handphone:  </th>
        <td><?php echo $order['mobile']; ?></td>
    </tr>
</table>
<?php } else if($team['delivery']=='pickup') { ?>
<table cellspacing="0" cellpadding="0" border="0" class="data-table">
    <tr>
        <th>Self Withdraw: </th>
        <td class="other-coupon"></td>
    </tr>
    <tr>
        <th>Withdraw Address: </th>
        <td><?php echo $team['address']; ?></td>
    </tr>
    <tr>
        <th>Handphone: </th>
        <td><?php echo $team['mobile']; ?></td>
    </tr>
</table>
<?php }?>
                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
    </div>
    <div id="sidebar">
    </div>
</div>

</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
