<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="system">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_system('bulletin'); ?></ul>
	</div>
	<div id="content" class="clr mainwide">
        <div class="clr box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Bulletin</h2></div>
                <div class="sect">
                    <form id="login-user-form" method="post" action="/manage/system/bulletin.php">
					<input type="hidden" name="id" value="<?php echo $system['id']; ?>" />
						<div class="wholetip clr"><h3>1. Whole Site Bulletin</h3></div>
                        <div class="field">
                            <label>Whole Site Bulletin</label>
                            <div style="float:left;"><textarea cols="45" rows="5" name="bulletin[0]" id="system-create-location" class="xheditor-simple"><?php echo htmlspecialchars($INI['bulletin'][0]); ?></textarea></div>
                        </div>
						<div class="wholetip clr"><h3>2. City's Bulletin</h3></div>
					<?php if(is_array($INI['hotcity'])){foreach($INI['hotcity'] AS $ename=>$one) { ?>
                        <div class="field">
                            <label><?php echo $one; ?></label>
                            <div style="float:left;"><textarea cols="45" rows="5" name="bulletin[<?php echo $ename; ?>]" id="system-create-location" class="xheditor-simple"><?php echo htmlspecialchars($INI['bulletin'][$ename]); ?></textarea></div>
						</div>
					<?php }}?>
                        <div class="act">
                            <input type="submit" value="Post" name="commit" id="system-submit" class="formbutton"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
	</div>

<div id="sidebar">
</div>

</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
