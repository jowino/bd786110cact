<?php if($team['flv']){?>
<div class="sbox">
	<div id="team_<?php echo $team['id']; ?>_player" style="height:173px;width:230px;"><img src="<?php echo team_image($team['image']); ?>" height="173" width="230" /></div>
</div>
<script>
window.x_init_hook_player = function() {
	var fo = new SWFObject("/static/img/player.swf", "flv_player", "100%", "100%", 7, "#FFFFFF");
	fo.addParam("wmode","transparent");
	fo.addParam("allowscriptaccess","always");
	fo.addParam("allowfullscreen","true");
	fo.addParam("quality","high");
	fo.addParam("flashvars", "file=<?php echo $team['flv']; ?>&amp;stretching=fill&amp;image=<?php echo team_image($team['image']); ?>");
	fo.write("team_<?php echo $team['id']; ?>_player");
}
</script>
<?php }?>
