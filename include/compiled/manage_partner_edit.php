<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="partner">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_partner(null); ?></ul>
	</div>
	<div id="content" class="clr mainwide">
        <div class="clr box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Edit Partners</h2><b style="margin-left:20px;font-size:16px;">（<?php echo $partner['title']; ?>）</b></div>
                <div class="sect">
                    <form id="login-user-form" method="post" action="/manage/partner/edit.php?id=<?php echo $partner['id']; ?>">
					<input type="hidden" name="id" value="<?php echo $partner['id']; ?>" />
						<div class="wholetip clr"><h3>1. Login Info</h3></div>
                        <div class="field">
                            <label>Username</label>
                            <input type="text" size="30" name="username" id="partner-create-username" class="f-input" value="<?php echo $partner['username']; ?>" require="true" datatype="require" />
                        </div>
                        <div class="field password">
                            <label>Password</label>
                            <input type="text" size="30" name="password" id="settings-password" class="f-input" />
                            <span class="hint">Keep blank if you don't want to change password</span>
                        </div>
						<div class="wholetip clr"><h3>2. Basic Info</h3></div>
                        <div class="field">
                            <label>Name</label>
                            <input type="text" size="30" name="title" id="partner-create-title" class="f-input" value="<?php echo $partner['title']; ?>"/>
                        </div>
                        <div class="field">
                            <label>Website</label>
                            <input type="text" size="30" name="homepage" id="partner-create-homepage" class="f-input" value="<?php echo $partner['homepage']; ?>"/>
                        </div>
                        <div class="field">
                            <label>Contacts</label>
                            <input type="text" size="30" name="contact" id="partner-create-contact" class="f-input" value="<?php echo $partner['contact']; ?>"/>
						</div>
                        <div class="field">
                            <label>Tel.</label>
                            <input type="text" size="30" name="phone" id="partner-create-phone" class="f-input" value="<?php echo $partner['phone']; ?>" maxLength="12"/>
						</div>
                        <div class="field">
                            <label>Handphone</label>
                            <input type="text" size="30" name="mobile" id="partner-create-mobile" class="f-input" value="<?php echo $partner['mobile']; ?>" maxLength="11" />
						</div>
                        <div class="field">
                            <label>Location</label>
                            <div style="float:left;"><textarea cols="45" rows="5" name="location" id="partner-create-location" class="xheditor-simple"><?php echo htmlspecialchars($partner['location']); ?></textarea></div>
						</div>
                        <div class="field">
                            <label>Other Info</label>
                            <div style="float:left;"><textarea cols="45" rows="5" name="other" id="partner-create-other" class="xheditor-simple"><?php echo htmlspecialchars($partner['other']); ?></textarea></div>
						</div>
						<div class="wholetip clr"><h3>3. Bank Account Info</h3></div>
                        <div class="field">
                            <label>Bank Name</label>
                            <input type="text" size="30" name="bank_name" id="partner-create-bankname" class="f-input" value="<?php echo $partner['bank_name']; ?>"/>
                        </div>
                        <div class="field">
                            <label>Name on the account</label>
                            <input type="text" size="30" name="bank_user" id="partner-create-bankuser" class="f-input" value="<?php echo $partner['bank_user']; ?>"/>
                        </div>
                        <div class="field">
                            <label>Account No.</label>
                            <input type="text" size="30" name="bank_no" id="partner-create-bankno" class="f-input" value="<?php echo $partner['bank_no']; ?>"/>
                        </div>
                        <div class="act">
                            <input type="submit" value="Edit" name="commit" id="partner-submit" class="formbutton"/>
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
