<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="partner">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_system('index'); ?></ul>
	</div>
	<div id="content" class="clear mainwide">
        <div class="clear box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Basic Setting</h2></div>
                <div class="sect">
                    <form method="post">
						<div class="wholetip clear"><h3>1. Basic</h3></div>
                        <div class="field">
                            <label>Website Name</label>
                            <input type="text" size="30" name="system[sitename]" class="f-input" value="<?php echo $INI['system']['sitename']; ?>"/>
                        </div>
                        <div class="field">
                            <label>Abbreviation</label>
                            <input type="text" size="30" name="system[abbreviation]" class="f-input" value="<?php echo $INI['system']['abbreviation']; ?>"/>
                        </div>
                        <div class="field">
                            <label>Coupon Name</label>
                            <input type="text" size="30" name="system[couponname]" class="f-input" value="<?php echo $INI['system']['couponname']; ?>"/>
                        </div>
                        <div class="field">
                            <label>Currency</label>
                            <input type="text" size="30" name="system[currency]" class="number" value="<?php echo $INI['system']['currency']; ?>"/>
						</div>
                        <div class="field">
                            <label>Invitation Rebate</label>
                            <input type="text" size="30" name="system[invitecredit]" class="number" value="<?php echo $INI['system']['invitecredit']; ?>"/>
							<span class="inputtip">Unit: Dollar</span>
						</div>
                        <div class="field">
                            <label>Verify Email</label>
                             <?php if((isset($INI['system']['emailverify']))){?>
                            <input type="checkbox" size="30" name="system[emailverify]" class="number" checked/>
                            <?php } else { ?>
                            <input type="checkbox" size="30" name="system[emailverify]" class="number"/>
                            <?php }?>
							<span class="inputtip"></span>
						</div>
                        <div class="field">
                            <label>Side Bar Deal?</label>
                            <input type="text" size="30" name="system[sideteam]" class="number" value="<?php echo $INI['system']['sideteam']; ?>"/>
							<span class="inputtip">1 Yes, 0 No</span>
							<span class="hint">Display other deals information at side bar?</span>
						</div>
                        <div class="field">
                            <label>QQ</label>
                            <input type="text" size="30" name="system[kefuqq]" class="f-input" value="<?php echo $INI['system']['kefuqq']; ?>"/>
						</div>
                        <div class="field">
                            <label>MSN</label>
                            <input type="text" size="30" name="system[kefumsn]" class="f-input" value="<?php echo $INI['system']['kefumsn']; ?>"/>
						</div>
                        <div class="field">
                            <label>Business No.</label>
                            <input type="text" size="30" name="system[icpno]" class="f-input" value="<?php echo $INI['system']['icpno']; ?>"/>
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
