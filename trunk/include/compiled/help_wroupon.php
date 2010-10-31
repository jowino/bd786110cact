<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="learn">
	<div class="dashboard" id="dashboard">
		<ul><?php echo current_help('wropon'); ?></ul>
	</div>
	<div id="content" class="about clear">
        <div class="box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2><?php echo $INI['system']['abbreviation']; ?> Abbreviation</h2></div>
                <div class="sect">
					<p class="step first"><img src="/static/img/how-it-works1.gif" /></p>
                    <p class="step"><img src="/static/img/how-it-works2.gif" /></p>
                    <p class="step"><img src="/static/img/how-it-works3.gif" /></p>
                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
	</div>
	<div id="sidebar">
		<?php include template("block_side_business");?>
		<div class="side-bar-1">
		<?php include template("block_side_subscribe");?>
		</div>
	</div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
