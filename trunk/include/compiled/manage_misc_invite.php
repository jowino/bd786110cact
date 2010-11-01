<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_misc('invite'); ?></ul>
	</div>
    <div id="content" class="coupons-box clr mainwide">
		<div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>Invitation Rebate Process</h2>
					<ul class="filter">
						<li><form action="/manage/misc/invite.php"method="get">Invitor's Email：<input type="text"name="memail" value="<?php echo htmlspecialchars($memail); ?>" class="h-input" />&nbsp;Invited Email：<input type="text" name="oemail"value="<?php echo htmlspecialchars($oemail); ?>" class="h-input" />&nbsp; <input type="submit" value="Filter" class="formbutton"  style="padding:1px 6px;"/><form> </li>
					</ul>
				</div>
                <div class="sect">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="350">Item</th><th width="150">Initiative User</th><th width="150">User Invited</th><th width="120">Invitation Time</th><th width="80">Operation</th></tr>
					<?php if(is_array($invites)){foreach($invites AS $index=>$one) { ?>
					<tr <?php echo $index%2?'':'class="alt"'; ?> id="order-list-id-<?php echo $one['id']; ?>">
						<td><a class="deal-title" href="/team.php?id=<?php echo $one['team_id']; ?>" target="_blank"><?php echo $teams[$one['team_id']]['title']; ?></a></td>
						<td><a class="ajaxlink" href="/ajax/manage/userview.php?id=<?php echo $one['user_id']; ?>"><?php echo $users[$one['user_id']]['email']; ?></a><br/><?php echo $users[$one['user_id']]['username']; ?><br/><?php echo $one['user_ip']; ?></td>
						<td><a class="ajaxlink" href="/ajax/manage/userview.php?id=<?php echo $one['other_user_id']; ?>"><?php echo $users[$one['other_user_id']]['email']; ?></a><br/><?php echo $users[$one['other_user_id']]['username']; ?><br/><?php echo $one['other_user_ip']; ?></td>
						<td><?php echo date('Y-m-d H:i', $one['create_time']); ?><br/><?php echo date('Y-m-d H:i', $one['buy_time']); ?></td>
						<td class="op"><a href="/ajax/manage.php?action=inviteok&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Confirm Invitation Rebate Successful?">Confirm</a>｜<a href="/ajax/manage.php?action=inviteremove&id=<?php echo $one['id']; ?>" class="ajaxlink remove">Delete</a></td>
					</tr>
					<?php }}?>
					<tr><td colspan="8"><?php echo $pagestring; ?></tr>
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
