<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="settings">
	<div class="dashboard" id="dashboard">
		<ul><?php echo current_account('/account/settings.php'); ?></ul>
	</div>
    <div id="content" class="clr settings-box">
		<div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Setting</h2></div>
                <div class="sect">
                    <form id="settings-form" method="post" action="/account/settings.php" enctype="multipart/form-data" class="validator">
						<div class="wholetip clr"><h3>1. Basic Info</h3></div>
                        <div class="field email">
                            <label>Email</label>
                            <input type="text" size="30" name="email" id="settings-email-address" class="f-input readonly" readonly="readonly" value="<?php echo $login_user['email']; ?>" />
                        </div>
                        <div class="field">
                            <label>Head Picture</label>
							<?php if($login_user['avatar']){?>
							<img src="<?php echo user_image($login_user['avatar']); ?>" style="float:left;margin-top:-10px;margin-right:10px;"/>
							<?php }?>
                            <input type="file" size="30" name="upload_image" id="settings-avatar" class="f-input" />
                            <span class="hint">Please upload picture smaller than 512K.</span>
                        </div>
                        <div class="field username">
                            <label>User Name</label>
                            <input type="text" size="30" name="username" id="settings-username" class="f-input" value="<?php echo $login_user['username']; ?>" require="true" datatype="limit" min="2" max="16" maxLength="16"/>
                        </div>
                        <div class="field password">
                            <label>New Password</label>
                            <input type="password" size="30" name="password" id="settings-password" class="f-input" />
                            <span class="hint">Keep blank if you don't want to change password</span>
                        </div>
                        <div class="field password">
                            <label>Confirm New Password</label>
                            <input type="password" size="30" name="password2" id="settings-password-confirm" class="f-input" />
                        </div>
						<div class="wholetip clr"><h3>2. Delivery Info </h3></div>
                        <div class="field mobile">
                            <label>Handphone</label>
                            <input type="text" size="30" name="mobile" id="settings-mobile" class="f-input" value="<?php echo $login_user['mobile']; ?>" />
                            <span class="hint">Handpone number is the most important contact way for us.</span>
                        </div>
                        <div class="field username">
                            <label>Real Name</label>
                            <input type="text" size="30" name="realname" id="settings-realname" class="f-input" value="<?php echo $login_user['realname']; ?>" />
                        </div>
                        <div class="field">
                            <label>Post Code</label>
                            <input type="text" maxLength=6 size="10" name="zipcode" id="settings-zipcode" class="f-input number" value="<?php echo $login_user['zipcode']; ?>" />
                        </div>
                        <div class="field username">
                            <label>Delivery Address</label>
                            <input type="text" size="30" name="address" id="settings-address" class="f-input" value="<?php echo $login_user['address']; ?>" />
                            <span class="hint">Address should be in "BLK xxx, xxxx Street xxx, #xx-xxx"</span>
                        </div>
                        <div class="clr"></div>
                        <div class="act">
                            <input type="submit" value="Change" name="commit" id="settings-submit" class="formbutton"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
    </div>
    <div id="sidebar" class="rail">
		<?php include template("block_side_credit");?>
		<div class="clr"></div>
		<?php include template("block_side_credittip");?>
    </div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
