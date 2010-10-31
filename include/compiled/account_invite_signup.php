<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="referrals">
    <div id="content">
        <div class="box clr">
                    <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Invitation Rebate</h2></div>
                <div class="sect">
                <p class="intro">Once you friend accept this invitation and buy a deal on <?php echo $INI['system']['sitename']; ?> successfully, you will get <?php echo $INI['system']['invitecredit']; ?> rebate on your <?php echo $INI['system']['sitename']; ?> account credit. You can pay by you accouont credit next time you buy a deal.</p>
                            <p class="login">Please <a href="/account/login.php?r=<?php echo $currefer; ?>">Login</a> or <a href="/account/signup.php">Register </a> and get your invitation link.</p>
        				                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
    </div>
    <div id="sidebar">
		<?php include template("block_side_invitetip");?>
    </div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
