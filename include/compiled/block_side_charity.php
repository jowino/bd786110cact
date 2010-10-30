<?php if($charities){?>
<div class="sbox side-others">
	<div class="sbox-top"></div>
	<div class="sbox-content">
		<div class="tip">
		<h2>Charity of the Deal</h2>
		<?php if(is_array($charities)){foreach($charities AS $one) { ?>
			<b><?php echo ++$index; ?>. <?php echo $one['name']; ?></b>
			<p><img src="<?php echo team_image($one['image']); ?>" width="195" height="60" border="0" /></p>
			<hr />
		<?php }}?>
		</div>
	</div>
	<div class="sbox-bottom"></div>
</div>
<?php }?>