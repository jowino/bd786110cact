<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_partner('index'); ?></ul>
	</div>
    <div id="content" class="coupons-box clr mainwide">
		<div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>Partner</h2>
				</div>
                <div class="sect">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="350">Name</th><th width="120">Contacts</th><th width="130">Contact Number</th><th width="100">Date</th><th width="80">Operation</th></tr>
					<?php if(is_array($partners)){foreach($partners AS $index=>$one) { ?>
					<tr <?php echo $index%2?'':'class="alt"'; ?> id="team-list-id-<?php echo $one['id']; ?>">
						<td style="text-align:left;"><a class="deal-title" href="/manage/partner/edit.php?id=<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a></td>
						<td style="text-align:left;"><?php echo $one['contact']; ?></td>
						<td><?php echo $one['phone']; ?><br/><?php echo $one['mobile']; ?></td>
						<td><?php echo date('Y-m-d',$one['create_time']); ?></td>
						<td class="op"><a href="/manage/partner/edit.php?id=<?php echo $one['id']; ?>">Edit</a>|<a href="/ajax/manage.php?action=partnerremove&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Sure to delete this partner?">Delete</a></td>
					</tr>
					<?php }}?>
					<tr><td colspan="5"><?php echo $pagestring; ?></td></tr>
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
