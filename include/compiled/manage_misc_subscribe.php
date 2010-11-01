<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_misc('subscribe'); ?></ul>
	</div>
    <div id="content" class="coupons-box clr mainwide">
		<div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>Email Subscribed List</h2>
					<ul class="filter">
						<li><form action="/manage/misc/subscribe.php" method="get">City: <input type="text" name="cs" value="<?php echo htmlspecialchars($cs); ?>" class="h-input" />&nbsp;Email: <input type="text" name="like" value="<?php echo htmlspecialchars($like); ?>" class="h-input" />&nbsp;<input type="submit" value="Filter" class="formbutton"  style="padding:1px 6px;"/><form></li>
					</ul>
				</div>
                <div class="sect">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="350">Email</th><th width="80">City</th><th width="350">Security key</th><th width="80">Operation</th></tr>
					<?php if(is_array($subscribes)){foreach($subscribes AS $index=>$one) { ?>
					<tr <?php echo $index%2?'':'class="alt"'; ?> id="team-list-id-<?php echo $one['id']; ?>">
						<td><?php echo $one['email']; ?></td>
						<td><?php echo $cities[$one['city_id']]['name']; ?></td>
						<td><?php echo $one['secret']; ?></td>
						<td class="op"><a ask="Delete or not?" href="/ajax/manage.php?action=subscriberemove&id=<?php echo $one['id']; ?>" class="ajaxlink">Delete</a></td>
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
