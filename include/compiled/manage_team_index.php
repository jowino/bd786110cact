<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_team($selector); ?></ul>
	</div>
    <div id="content" class="coupons-box clr mainwide">
		<div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>Deal Item</h2>
				</div>
                <div class="sect">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="500">Deal</th><th width="120" nowrap>City/Category</th><th width="100">Date</th><th width="50">Done</th><th width="60" nowrap>Current Price</th><th width="140">Operation</th></tr>
					<?php if(is_array($teams)){foreach($teams AS $index=>$one) { ?>
					<?php $one['state'] = team_state($one); ?>
					<tr <?php echo $index%2?'':'class="alt"'; ?> id="team-list-id-<?php echo $one['id']; ?>">
						<td style="text-align:left;"><a class="deal-title" href="/team.php?id=<?php echo $one['id']; ?>" target="_blank"><?php echo $one['title']; ?></a></td>
						<td><?php echo $cities[$one['city_id']]['name']; ?><br/><?php echo $groups[$one['group_id']]['name']; ?></td>
						<td><?php echo date('Y-m-d',$one['begin_time']); ?><br/><?php echo date('Y-m-d',$one['end_time']); ?></td>
						<td><?php echo $one['now_number']; ?>/<?php echo $one['min_number']; ?></td>
						<td><span class="money"><?php echo $currency; ?></span><?php echo moneyit($one['team_price']); ?><br/><span class="money"><?php echo $currency; ?></span><?php echo moneyit($one['market_price']); ?></td>
						<td class="op" nowrap><a href="/ajax/manage.php?action=teamdetail&id=<?php echo $one['id']; ?>" class="ajaxlink">Detail</a><?php if($one['state']=='none'){?>｜<a href="/manage/team/edit.php?id=<?php echo $one['id']; ?>">Edit</a><?php if($one['now_number']==0){?>｜<a href="/ajax/manage.php?action=teamremove&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Delete this item, are you sure?" >Delete</a><?php }?><?php } else if(in_array($one['state'],array('success','soldout'))) { ?>｜<a href="/manage/team/down.php?id=<?php echo $one['id']; ?>" target="_blank">Download</a><?php } else if($one['state']=='failure') { ?>｜<a href="/ajax/manage.php?action=teamrefund&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Refund, are you sure?">Refund</a><?php } else { ?>Already Refund<?php }?></td>
					</tr>
					<?php }}?>
					<tr><td colspan="6"><?php echo $pagestring; ?></tr>
                    </table>
				</div>
            </div>
            <div class="box-bottom"></div>
        </div>
    </div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
