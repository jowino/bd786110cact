<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<?php if(is_newbie()){?><div id="sysmsg-guide"><div class="link"><a href="/help/tour.php"></a></div><a id="sysmsg-guide-close" href="javascript:void(0);" class="close">Close</a></div><?php }?>

<?php if(in_array($team['state'],array('success','soldout'))){?>
<div id="sysmsg-tip" class="sysmsg-tip-deal-close"><div class="sysmsg-tip-top"></div><div class="sysmsg-tip-content"><div class="deal-close"><div class="focus">Sorry, you are late, <br /> this deal is over.</div><div id="tip-deal-subscribe-body" class="body"><form id="tip-deal-subscribe-form" method="post" action="/subscribe.php" class="validator"><table><tr><td>Don't miss other deals, subscribe our daily deal news now:&nbsp;</td><td><input type="text" name="email" class="f-text" value="" require="true" datatype="email" /></td><td>&nbsp;<input class="commit" type="submit" value="Subscribe" /></td></tr></table></form></div></div><span id="sysmsg-tip-close" class="sysmsg-tip-close">Close</span></div><div class="sysmsg-tip-bottom"></div></div>
<?php }?>

<?php if($order){?>
<div id="sysmsg-tip" ><div class="sysmsg-tip-top"></div><div class="sysmsg-tip-content">You have ordered, not paid yet.<a href="/order/check.php?id=<?php echo $order['id']; ?>">Check order and make a payment</a><span id="sysmsg-tip-close" class="sysmsg-tip-close">Close</span></div><div class="sysmsg-tip-bottom"></div></div><div id="deal-default"> 
<?php }?>

	<div id="deal-default">
		<?php include template("block_team_share");?>
		<div id="content">
			<div id="deal-intro" class="cf">
                <h1><?php if($team['state']=='none'){?><a class="deal-today-link" href="/team.php?id=<?php echo $team['id']; ?>">Today's Deal:</a><?php }?><?php echo $team['title']; ?></h1>
                <div class="main">
                    <div class="deal-buy">
                        <div class="deal-price-tag"></div>
						<?php if(($team['state']=='soldout')){?>
                        <p class="deal-price"><strong><?php echo $currency; ?><?php echo $team['team_price']; ?></strong><span class="deal-price-soldout"></span></p>
						<?php } else if($team['state']=='none') { ?>
                        <p class="deal-price"><strong><?php echo $currency; ?><?php echo $team['team_price']; ?></strong><span><a href="/team/buy.php?id=<?php echo $team['id']; ?>"><img src="/static/css/i/button-deal-buy.png" /></a></span></p>
						<?php } else { ?>
                        <p class="deal-price"><strong><?php echo $currency; ?><?php echo $team['team_price']; ?></strong><span class="deal-price-expire"></span></p>
						<?php }?>
                    </div>
                    <table class="deal-discount">
                        <tr>
                            <th>Value</th>
                            <th>Discount</th>
                            <th>You Save</th>
                        </tr>
                        <tr>
                            <td><?php echo $currency; ?><?php echo $team['market_price']; ?></td>
                            <td><?php echo moneyit(100-$discount_rate); ?>% off</td>
                            <td><?php echo $currency; ?><?php echo $discount_price; ?></td>
                        </tr>
                    </table>
					<?php if($team['state']=='none'){?>
                    <div class="deal-box deal-timeleft deal-on" id="deal-timeleft" curtime="<?php echo $now; ?>000" diff="<?php echo $diff_time; ?>000">
						<h3>Time Left To Buy</h3>
						<div class="limitdate"><ul id="counter"><li><span><?php echo $left_hour; ?></span>hours</li><li><span><?php echo $left_minute; ?></span>minutes</li><li><span><?php echo $left_time; ?></span>seconds</li></ul></div>
					</div>
					<?php } else { ?>
                    <div class="deal-box deal-timeleft deal-off" id="deal-timeleft" curtime="<?php echo $now; ?>000" diff="<?php echo $diff_time; ?>000">
						<h3>Deal will is over at: </h3>
						<div class="limitdate"><p class="deal-buy-ended"><?php echo date('Y-m-d', $team['close_time']); ?><br><?php echo date('H:i:s', $team['close_time']); ?></p></div>
					</div>
					<?php }?>

				<?php if($team['state']=='none'){?>
					<?php if($team['now_number']<$team['min_number']){?>
					<div class="deal-box deal-status" id="deal-status">
						<p class="deal-buy-tip-top"><strong><?php echo $team['now_number']; ?></strong> bought </p>
						<div class="progress-pointer" style="padding-left:<?php echo $bar_size-$bar_offset; ?>px;"><span></span></div>
						<div class="progress-bar"><div class="progress-left" style="width:<?php echo $bar_size-$bar_offset; ?>px;"></div><div class="progress-right "></div></div>
						<div class="cf"><div class="min">0</div><div class="max"><?php echo $team['min_number']; ?></div></div>
						<p class="deal-buy-tip-btm">This Deal Has <strong><?php echo $team['min_number']-$team['now_number']; ?></strong> Left To Be On</p>
					</div>
					<?php } else { ?>
					<div class="deal-box deal-status deal-status-open" id="deal-status">
						<p class="deal-buy-tip-top"><strong><?php echo $team['now_number']; ?></strong> bought </p>
						<p class="deal-buy-on" style="line-height:200%;"><img src="/static/css/i/deal-buy-succ.gif"/> The deal is tipped! <?php if($team['max_number']>$team['now_number']||$team['max_number']==0){?><br/>You can buy it now. <?php }?></p>
					</div>
					<?php }?>
				<?php } else { ?>
					<div class="deal-box deal-status deal-status-<?php echo $team['state']; ?>" id="deal-status"><div class="deal-buy-<?php echo $team['state']; ?>"></div><p class="deal-buy-tip-total">Totally <strong><?php echo $team['now_number']; ?></strong> bought </p></div> 
				<?php }?>
				</div>
                <div class="side">
                    <div class="deal-buy-cover-img" id="team_images">
						<div class="mid">
							<ul>
								<li class="first"><img src="<?php echo team_image($team['image']); ?>"/></li>
							<?php if($team['image1']){?>
								<li><img src="<?php echo team_image($team['image1']); ?>"/></li>
							<?php }?>
							<?php if($team['image2']){?>
								<li><img src="<?php echo team_image($team['image2']); ?>"/></li>
							<?php }?>
							</ul>
							<div id="img_list">
								<a ref="1" class="active">1</a>
							<?php $imageindex=1;; ?>
							<?php if($team['image1']){?>
								<a ref="<?php echo ++$imageindex; ?>" ><?php echo $imageindex; ?></a>
							<?php }?>
							<?php if($team['image2']){?>
								<a ref="<?php echo ++$imageindex; ?>" ><?php echo $imageindex; ?></a>
							<?php }?>
							</div> 
						</div>
					</div>
                    <div class="digest"><?php echo $team['summary']; ?></div>
                </div>
            </div>
            <div id="deal-stuff" class="cf">
                <div class="clear box box-split">
                    <div class="box-top"></div>
                    <div class="box-content cf">
                        <div class="main">
                            <h2 id="detail">Details of the deal</h2>
							<div class="blk detail"><?php echo $team['detail']; ?></div>
							<div class="deal-detail-intro cf">
								<h2>Notice</h2><?php echo $team['notice']; ?>
							</div>

							<h2 id="userreview">User's Review</h2>
							<div class="blk review"><?php echo userreview($team['userreview']); ?></div>
							<h2 id="systemreview"><?php echo $INI['system']['abbreviation']; ?>Says</h2>
							<div class="blk review"><?php echo $team['systemreview']; ?></div>
						</div>
                        <div class="side">
                            <div id="side-business">
								<h2><?php echo $partner['title']; ?></h2>
								<div style="margin-top:10px;"><?php echo $partner['location']; ?></div>
								<div style="margin-top:10px;"><a href="<?php echo $partner['homepage']; ?>" target="_blank"><?php echo domainit($partner['homepage']); ?></a></div>
							</div>
						</div>
                        <div class="clear"></div>
                    </div>
                    <div class="box-bottom"></div>
                </div>
            </div>
    </div>
    <div id="sidebar">
		<?php include template("block_side_invite");?>
		<?php include template("block_side_bulletin");?>
		<?php include template("block_side_charity");?>
		<?php include template("block_side_flv");?>
		<?php include template("block_side_ask");?>
		<?php include template("block_side_others");?>
		<?php include template("block_side_business");?>
		<?php include template("block_side_subscribe");?>
	</div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
