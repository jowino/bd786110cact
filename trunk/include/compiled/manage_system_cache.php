<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="partner">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_system('cache'); ?></ul>
	</div>
	<div id="content" class="clr mainwide">
        <div class="clr box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Cache Setting (Support Memcache）</h2></div>
                <div class="sect">
                    <form method="post">
						<div class="wholetip clr">
							<h3>Format 127.0.0.1:11211:100, Leave blank if no memcache support</h3>
						</div>
						<div style="margin:0 20px;">
							<p>127.0.0.1 is Memcache's Host IP</p>
							<p>11211 is Memcache's Port Number</p>
							<p>100 Privilege Should Be Greater Than 0</p>
						</div>
						<div class="wholetip clr"><h3>1. Cache Host</h3></div>
                        <div class="field">
                            <label>Host 1</label>
                            <input type="text" size="30" name="memcache[]" class="f-input" value="<?php echo $INI['memcache'][0]; ?>"/>
                        </div>
                        <div class="field">
                            <label>Host 2</label>
                            <input type="text" size="30" name="memcache[]" class="f-input" value="<?php echo $INI['memcache'][1]; ?>"/>
                        </div>
                        <div class="field">
                            <label>Host 3</label>
                            <input type="text" size="30" name="memcache[]" class="f-input" value="<?php echo $INI['memcache'][2]; ?>"/>
                        </div>
                        <div class="field">
                            <label>Host 4</label>
                            <input type="text" size="30" name="memcache[]" class="f-input" value="<?php echo $INI['memcache'][3]; ?>"/>
                        </div>

                        <div class="act">
                            <input type="submit" value="Save" name="commit" class="formbutton"/>
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
