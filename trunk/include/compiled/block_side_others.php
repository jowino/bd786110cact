<?php if($others){?>
<div class="sbox side-others">
	<div class="sbox-top"></div>
	<div class="sbox-content">
		<div class="tip">
		<h2>Today's side deal</h2>
		<?php if(is_array($others)){foreach($others AS $one) { ?>
			<b><?php echo ++$index; ?>. <?php echo $one['title']; ?></b>
			<p><a href="/team.php?=<?php echo $one['id']; ?>"><img src="<?php echo team_image($one['image']); ?>" width="195" height="148" border="0" /></a><br/><a href="/team.php?id=<?php echo $one['id']; ?>">&raquo;&nbsp;Check Detail</a></p>
			<hr />
		<?php }}?>
		</div>
	</div>
	<div class="sbox-bottom"></div>
</div>
<?php }?>
