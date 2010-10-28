<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="partner">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_system('city'); ?></ul>
	</div>
	<div id="content" class="clear mainwide">
        <div class="clear box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>City</h2></div>
                <div class="sect">
                    <form method="post">
						<div class="wholetip clear"><h3>1. Basic</h3></div>
                        <div class="field">
                            <label>City</label>
							<div style="float:left;"><textarea cols="45" rows="5" name="hotcity" class="xheditor-simple"><?php echo $hotcity; ?></textarea></div>
							<span class="hint">Use comma to seperate different cities, for more cities please visit <a href="/city.php" target="_blank">Cities List</a> to acquire</span>
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
