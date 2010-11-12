<?php include template("header");
//var_dump($_SESSION['FB_USER_LOGIN']);
?>
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="maillist">
	<div id="content">
        <div class="box">
            <div class="box-top"></div>
            <div class="box-content welcome">
				<div class="head">
					 <h2>Register Your  Email</h2>
				</div>
                <div class="sect">
					<div class="lead"><h4>Sign up Using your Face book Email!</h4></div>
					<div class="enter-address">
						
						<div class="enter-address-c">
						<form id="enter-address-form" action="/account/signupemail.php" method="post" class="validator">
						<div class="field email">
							<label for="signup-email">Email address: </label>
							<input id="enter-address-mail" name="email" class="f-input f-mail" type="text" value="<?php echo $_SESSION['FB_USER_LOGIN']['email']; ?>" size="20" require="true" datatype="email" />
							<span class="hint">(Don't worry, your email is safe with us!)</span>
						</div>
						<div class="field username">
                            <label for="signup-username">Username</label>
                            <input type="text" size="30" name="username" id="signup-username" class="f-input" value="<?php echo $_SESSION['FB_USER_LOGIN']['username']; ?>" datatype="limit" require="true" min="2" max="16" maxLength="16" />
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
						<div class="city">
							<label>&nbsp;</label>
							<input id="enter-address-commit" type="submit" class="formbutton" value="Submit" />
						</div>
						</form>
					</div>
					<div class="clear" style="background-image: none;"></div>
				</div>
				<div class="intro">
					<p>Our daily deals consist of:</p>
					<p>Massages, Restaurants, Hotels, Spas, Theaters, and a whole lot more...</p>
				</div>
			</div>
		</div>
		<div class="box-bottom"></div>
	</div>
</div>
<div id="sidebar">
	<div class="side-pic">
	   <p><img src="/static/img/subscribe-pic1.jpg" /></p> 
	   <p><img src="/static/img/subscribe-pic2.jpg" /></p> 
	   <p><img src="/static/img/subscribe-pic3.jpg" /></p> 
	</div>
</div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
