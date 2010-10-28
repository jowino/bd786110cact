<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="signup">
    <div id="content" class="signup-box">
        <div class="box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Register </h2><span>&nbsp;or <a href="/account/login.php">Login</a></span></div>
                <div class="sect">
                    <form id="signup-user-form" method="post" action="/account/signup.php" class="validator">
                        <div class="field email">
                            <label for="signup-email-address">Email</label>
                            <input type="text" size="30" name="email" id="signup-email-address" class="f-input" value="<?php echo $_POST['email']; ?>" require="true" datatype="email" />
                            <span class="f-input-tip">Please key in a valid Email address.</span> 
                            <span class="hint">For login and password reset use, will not public.</span>
                        </div>
                        <div class="field username">
                            <label for="signup-username">Username</label>
                            <input type="text" size="30" name="username" id="signup-username" class="f-input" value="<?php echo $_POST['username']; ?>" datatype="limit" require="true" min="2" max="16" maxLength="16" />
                            <span class="hint">4-16 characters only</span>
                        </div>
                        <div class="field password">
                            <label for="signup-password">Password</label>
                            <input type="password" size="30" name="password" id="signup-password" class="f-input" require="true" datatype="require" />
                            <span class="hint">At least 4 characters</span>
                        </div>
                        <div class="field password">
                            <label for="signup-password-confirm">Confirm password</label>
                            <input type="password" size="30" name="password2" id="signup-password-confirm" class="f-input" require="true" datatype="compare" compare="signup-password" />
                        </div>
						<div class="field subscribe">
                            <input tabindex="3" type="checkbox" value="1" name="subscribe" id="subscribe" class="f-check" checked="checked" />
                            <label for="subscribe">Subscribe <b><?php echo $city['name']; ?></b> daily deal information.</label>
						</div>
                        <div class="act">
                            <input type="submit" value="Register " name="commit" id="signup-submit" class="formbutton"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
    </div>
    <div id="sidebar">
        <div class="sbox">
            <div class="sbox-top"></div>
            <div class="sbox-content">
                <div class="side-tip">
                    <h2>Have <?php echo $INI['system']['abbreviation']; ?> account? </h2>
                    <p><a href="/account/login.php">Login</a> please. </p>
                </div>
            </div>
            <div class="sbox-bottom"></div>
        </div>
    </div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
