<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_charity('charity'); ?></ul>
	</div>
    <div id="content" class="coupons-box clr mainwide">
		<div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2>Charities</h2>
					<ul class="filter">
						<li><a href="/ajax/manage.php?action=charityedit" class="ajaxlink">New Charity</a></li>
					</ul>
				</div>
                <div class="sect">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="50">ID</th><th width="250">Charity</th><th width="200">Operation</th></tr>
					<?php if(is_array($charities)){foreach($charities AS $index=>$one) { ?>
					<tr <?php echo $index%2?'':'class="alt"'; ?>>
						<td><?php echo $one['id']; ?></td>
						<td><?php echo $one['name']; ?></td>
						<td class="op"><a href="/ajax/manage.php?action=charityedit&id=<?php echo $one['id']; ?>" class="ajaxlink">Edit</a>|<a href="/ajax/manage.php?action=charityremove&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Delete this charity?">Delete</a>
							|<a href="/ajax/manage.php?action=charityreport&id=<?php echo $one['id']; ?>" class="ajaxlink">View Report</a>
						</td>
					</tr>
					<?php }}?>
					<tr><td colspan="6"><?php echo $pagestring; ?></td></tr>
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
