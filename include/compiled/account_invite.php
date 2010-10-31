<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="referrals">
    <div id="content" class="refers">
        <div class="box clr">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Invitation Rebate</h2></div>
                <div class="sect islogin">
					<?php if($money){?>
					<p class="notice-total">You have invited <strong><?php echo $count; ?></strong>  people, get <strong><span class="money"><?php echo $currency; ?> </span><?php echo $count*$INI['system']['invitecredit']; ?></strong> rebate in your account. <a href="/account/refer.php">Check</a>.</p>
					<?php }?>
					<p class="intro">Your friend has accepted your invitation, <?php echo $INI['system']['sitename']; ?>. System will pay you back <?php echo $INI['system']['invitecredit']; ?> dollars to <?php echo $INI['system']['sitename']; ?> account. You can pay your deal by it after that. The more friends you invited, the more dollars you earn in your account.</p>
					<div class="share-links">
						<ul class="share-list cf">
							<li class="site">
								<a class="logo" href="javascript:void 0" id="referrals-share-others-link"><img src="/static/css/i/logo_msn.png" /></a>
								<p class="im">This is your exempt invitation, please send it by MSN or QQ: <input id="share-copy-text" type="text" value="<?php echo $INI['system']['wwwprefix']; ?>/r.php?r=<?php echo $login_user_id; ?>" size="35" class="f-input" onfocus="this.select()" /></p>
							</li>
						</ul>
						<div class="refer-box">
							<div class="refer-box-top"></div>
							<div class="refer-box-content">
								<table class="deal-info">
									<td class="pic"><a href="/team.php?id=<?php echo $team['id']; ?>" target="_blank"><img src="<?php echo team_image($team['image']); ?>" width="150" height="90" /></a></td>
									<td class="deal-title"><?php echo $team['title']; ?></td>
								</table>
								<ul class="share-list">
		<li><a class="logo" href="<?php echo share_facebook($team); ?>" target="_blank" title="Share this deal with your friends.<?php echo $INI['system']['invitecredit']; ?>"><img src="/static/css/i/logo_facebook.png" /></a><p class="link"><a href="<?php echo share_facebook($team); ?>" target="_blank" title="Invite your friends here.<?php echo $INI['system']['invitecredit']; ?>">Facebook</a></p></li>
									<li><a class="logo" href="<?php echo share_twitter($team); ?>" target="_blank" title="Share this deal with your friends.<?php echo $INI['system']['invitecredit']; ?> "><img src="/static/css/i/logo_twitter.jpg" /></a><p class="link"><a href="<?php echo share_twitter($team); ?>" target="_blank" title="Invite your friends here.<?php echo $INI['system']['invitecredit']; ?> ">Twitter</a></p></li>								
									
							
								</ul>
								<div class="clear"></div>
							</div>
							<div class="refer-box-bottom"></div>
						</div>
					</div>
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
