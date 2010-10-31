<div id="order-pay-dialog" class="order-pay-dialog-c" style="width:450px;">

	<h3><span id="order-pay-dialog-close" class="close" onclick="return X.boxClose();">Close</span><?php echo $charity?'Edit':'New'; ?></h3>

	<div style="overflow-x:hidden;padding:10px;">

<form method="post" action="<?php echo $ajax_root; ?>/manage/charity/charityedit.php" enctype="multipart/form-data" class="validator">

	<input type="hidden" name="id" value="<?php echo $charity['id']; ?>" />

	<table width="96%" class="coupons-table">

		<tr><td width="80" nowrap><b>Name: </b></td><td><input type="text" name="name" value="<?php echo $charity['name']; ?>" require="true" datatype="require" class="f-input" /></td></tr>

		<tr><td nowrap><b>Description:</b></td><td><textarea cols="45" rows="5" name="description" id="team-create-userreview" class="noclass"><?php echo htmlspecialchars($charity['description']); ?></textarea></td></tr>

		<tr><td nowrap><b>Image: </b></td><td><input type="file" size="30" name="upload_image" id="team-create-image1" class="f-input" />

						<?php if($charity['image']){?><span class="hint"><img alt="" src="<?php echo team_image($charity['image']); ?>"></span><?php }?></td></tr>

		<tr><td colspan="2" height="10">&nbsp;</td></tr>

		<tr><td></td><td><input type="submit" value="Submit" class="formbutton" /></td></tr>

	</table>

</form>

	</div>

</div>

