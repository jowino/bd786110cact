<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_category($zone); ?></ul>
	</div>
    <div id="content" class="coupons-box clear mainwide">
		<div class="box clear">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head">
                    <h2><?php echo $cates[$zone]; ?></h2>
					<ul class="filter">
						<li><a href="/ajax/manage.php?action=categoryedit&zone=<?php echo $zone; ?>" class="ajaxlink">New <?php echo $cates[$zone]; ?></a></li>
					</ul>
				</div>
                <div class="sect">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="50">ID</th><th width="250">Full Name</th><th width="250">Short Name</th><th width="60">Character</th><th width="150">Category</th><th width="100">Operation</th></tr>
					<?php if(is_array($categories)){foreach($categories AS $index=>$one) { ?>
					<tr <?php echo $index%2?'':'class="alt"'; ?>>
						<td><?php echo $one['id']; ?></td>
						<td><?php echo $one['name']; ?></td>
						<td><?php echo $one['ename']; ?></td>
						<td><?php echo strtoupper($one['letter']); ?></td>
						<td><?php echo $one['czone']; ?></td>
						<td class="op"><a href="/ajax/manage.php?action=categoryedit&id=<?php echo $one['id']; ?>" class="ajaxlink">Edit</a>｜<a href="/ajax/manage.php?action=categoryremove&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Delete this category?">Delete</a></td>
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
