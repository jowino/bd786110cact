<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="feedback">
    <div id="content" class="clr">
        <div class="box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Deal Suggestion</h2></div>
                <div class="sect">
					<p class="notice">Welcome to offer us deal Suggestion.</p>
                    <form id="feedback-user-form" method="post" action="/feedback/seller.php" class="validator">
                        <div class="field fullname">
                            <label for="feedback-fullname">Your Name</label>
                            <input type="text" size="30" name="title" id="feedback-fullname" class="f-input" value="<?php echo $login_user['username']; ?>" require="true" datatype="require" />
                        </div>
                        <div class="field email">
                            <label for="feedback-email-address">Email</label>
                            <input type="text" size="30" name="contact" id="feedback-email-address" class="f-input" value="<?php echo $login_user['email']; ?>" require="true" datatype="require" />
                            <span class="hint">Please leave your email or cellphone number here, so that we can get in touch with you.</span>
                        </div>
                        <div class="field suggest">
                            <label for="feedback-suggest">Suggestion Info</label>
                            <textarea cols="30" rows="5" name="content" id="feedback-suggest" class="xheditor-simple" require="true" datatype="require"></textarea>
                        </div>
                        <div class="clr"></div>
                        <div class="act">
                            <input type="submit" value="Submit" name="commit" id="feedback-submit" class="formbutton"/>
                        </div>
                    </form>
				</div>
            </div>
            <div class="box-bottom"></div>
        </div>
	</div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
