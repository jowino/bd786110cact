<?php include template("html_header");?>
<div id="main-wrapper">

  <div id="header">

    <div class="logo"><img src="/static/images/logo.jpg" title="Moosavings" alt="Moosavings"/></div>

    <div class="header-box-2">

    <!--  <ul class="button">

        <li class="button-left"></li>

        <li>Visit More Cities<a class="button-arrow" href="#"></a></li>

        <li class="button-right"></li>
        <li>Current City :<?php echo $city['name']; ?></li>

      </ul> --> 
			<?php if(count($INI['hotcity'])>1||!in_array($city['ename'], array_keys($INI['hotcity']))){?>
		
			<div class="button-left"></div>
			<div id="guides-city-change" class="change">Visit More Cities</div>
			<div class="button-right"></div>
			<div id="guides-city-list" class="city-list">
				<ul><?php echo current_city($city['ename'], $INI['hotcity']); ?></ul>
			</div>
			<?php }?>
			<span style="font-size:15px;color:#78A22F;font-weight:bold;">Current City :<?php echo $city['name']; ?></span>
    </div>

    <div class="header-box-3">

      <ul class="button">

        <li class="button-left"></li>

        <li><a  href="/account/invite.php">Refer Friends, Get <?php echo $currency; ?> <?php echo $INI['system']['invitecredit']; ?></a></li>

        <li class="button-right"></li>

      </ul>

      <div class="clr"></div>

      <p class="telephone">+971 4 2831911</p>

      <p class="mailto"><a href="mailto:info@moosavings.com">info@moosavings.com</a></p>

      <div class="social-button"> <a href="#"><img src="/static/images/fb-icon.jpg" alt="Facebook" border="0" title="Facebook" /></a> <a href="#"><img src="/static/images/twitter-icon.jpg" alt="Twitter" border="0" title="Twitter" /></a> </div>
			<?php if((is_manager()||!is_customer())){?>
			<div><a href="/manage/index.php">Manage <?php echo $INI['system']['abbreviation']; ?></a></div>
			<?php }?>
    </div>

  </div>
    <div class="clr"></div>

  <div id="header-menu">

    <div class="main-menu">

      <ul><?php current_frontend(); ?>

        <li><a href="/index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('daily-deals','','<?php echo $ajax_root; ?>/static/images/daily-deals-hvr.jpg',1)"><img src="/static/images/daily-deals.jpg" alt="daily-deals" name="daily-deals" width="167" height="38" border="0" id="daily-deals" /></a></li>

        <li><a href="/team/index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('past-deals','','<?php echo $ajax_root; ?>/static/images/past-deals-hvr.jpg',1)"><img src="/static/images/past-deals.jpg" alt="past-deals" name="past-deals" width="150" height="38" border="0" id="past-deals" /></a></li>

        <li><a href="/help/tour.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('how-moosavings-works','','<?php echo $ajax_root; ?>/static/images/how-moosavings-works-hvr.jpg',1)"><img src="/static/images/how-moosavings-works.jpg" alt="how-moosavings-works" name="how-moosavings-works" width="270" height="38" border="0" id="how-moosavings-works" /></a></li>

        <li><a href="/team/ask.php?id=<?php echo $team['id']; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('discussion','','<?php echo $ajax_root; ?>/static/images/discussion-hvr.jpg',1)"><img src="/static/images/discussion.jpg" alt="discussion" name="discussion" width="131" height="38" border="0" id="discussion" /></a></li>

      </ul>

    </div>
<?php if($login_user){?>
		<div class="logins">
			<ul id="account">
				<li class="username">Hi, <?php echo $login_user['username']; ?>!</li>
				<li class="account"><a href="/order/index.php" id="myaccount" class="account">My Stuff</a></li>
				<li class="logout"><a href="/account/logout.php">Exit</a></li>
			</ul>
			<div class="line islogin"></div>
		</div>
		<?php } else { ?>
		    <div class="fb-connect"><a href="fb_connector.php"><img src="/static/images/fb-connect.jpg" alt="Facebook Connect" border="0" title="Facebook Connect" /></a></div>
    		<div class="sign-in"><a href="/account/login.php"><img src="/static/images/sign-in.jpg" alt="Sign In" border="0" title="Sign In" /></a></div>
		<?php }?>
  </div>

<?php if($session_notice=Session::Get('notice',true)){?>
<div class="sysmsgw" id="sysmsg-success"><div class="sysmsg"><p><?php echo $session_notice; ?></p><span class="close">Close</span></div></div>
<?php }?>
<?php if($session_notice=Session::Get('error',true)){?>
<div class="sysmsgw" id="sysmsg-error"><div class="sysmsg"><p><?php echo $session_notice; ?></p><span class="close">Close</span></div></div>
<?php }?>
