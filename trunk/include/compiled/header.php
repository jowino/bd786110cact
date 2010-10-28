
<?php include template("html_header");?>

<div id="hdw">
	<div id="hd">
		<div id="logo"><a href="/index.php" class="link"><img src="/static/css/i/logo.png" /></a></div>
		<div class="guides">
			<div class="city">
				<h2><?php echo $city['name']; ?></h2>
			</div>
			<?php if(count($INI['hotcity'])>1||!in_array($city['ename'], array_keys($INI['hotcity']))){?>
			<div id="guides-city-change" class="change">Change</div>
			<div id="guides-city-list" class="city-list">
				<ul><?php echo current_city($city['ename'], $INI['hotcity']); ?></ul>
			</div>
			<?php }?>
			<?php if(is_manager()){?>
			<li><a href="/manage/index.php">Manage <?php echo $INI['system']['abbreviation']; ?></a></li>
			<?php }?>
		</div>
		<ul class="nav cf"><?php echo current_frontend(); ?></ul>
		<div class="refer">&raquo;&nbsp;<a href="/subscribe.php">Subscribe</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;<a
            href="/account/invite.php">Invite</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;<a id="verify-coupon-id"
            href="javascript:;"><?php echo $INI['system']['couponname']; ?>Verify&Claim</a>
		</div>
		<?php if($login_user){?>
		<div class="logins">
			<ul id="account">
				<li class="username">Welcome, <?php echo $login_user['username']; ?>!</li>
				<li class="account"><a href="/order/index.php" id="myaccount" class="account">My <?php echo $INI['system']['abbreviation']; ?></a></li>
				<li class="logout"><a href="/account/logout.php">Exit</a></li>
			</ul>
			<div class="line islogin"></div>
		</div>
		<ul id="myaccount-menu">
			<li><a href="/order/index.php">My Order</a></li>
			<li><a href="/coupon/index.php">My <?php echo $INI['system']['couponname']; ?></a></li>
			<li><a href="/account/settings.php">Setting</a></li>
		</ul>
		<?php } else { ?>
		<div class="logins">
			<ul id="account">
				<li class="login"><a href="/account/login.php">Login</a></li>
				<li class="signup"><a href="/account/signup.php">Register </a></li>				</ul>
			<div class="line "></div>
		</div>
		<div style=" position:absolute; right:150pt;;top:80px"">
					<?php if ($_SESSION['user_id']=='') { include "fb_connector.php"; }?>
				</div>

				<div style=" position:absolute; right:300px;top:80px">
				<?php if ($_SESSION['user_id']=='') { ?>
				<a href="/redirect.php"><img src="/tw_connect/images/lighter.png" alt="Sign in with Twitter"/>
				<?php }?>
				</a>
		</div>
		<?php }?>
	</div>
</div>

<?php if($session_notice=Session::Get('notice',true)){?>
<div class="sysmsgw" id="sysmsg-success"><div class="sysmsg"><p><?php echo $session_notice; ?></p><span class="close">Close</span></div></div>
<?php }?>
<?php if($session_notice=Session::Get('error',true)){?>
<div class="sysmsgw" id="sysmsg-error"><div class="sysmsg"><p><?php echo $session_notice; ?></p><span class="close">Close</span></div></div>
<?php }?>
