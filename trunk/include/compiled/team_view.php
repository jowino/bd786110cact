<?php include template("header");?>


<?php if(is_newbie()){?><div id="sysmsg-guide"><div class="link"><a href="/help/tour.php"></a></div><a id="sysmsg-guide-close" href="javascript:void(0);" class="close">Close</a></div><?php }?>

<?php if(in_array($team['state'],array('success','soldout'))){?>
<div id="sysmsg-tip" class="sysmsg-tip-deal-close"><div class="sysmsg-tip-top"></div><div class="sysmsg-tip-content"><div class="deal-close"><div class="focus">Sorry, you are late, <br /> this deal is over.</div><div id="tip-deal-subscribe-body" class="body"><form id="tip-deal-subscribe-form1" name="tip_sbuscribe1" method="post" action="/subscribe.php" class="validator"><table><tr><td>Don't miss other deals, subscribe our daily deal news now:&nbsp;</td><td><input type="text" name="email" class="f-text" value="" require="true" datatype="email" /></td><td>&nbsp;<input class="commit" type="submit" value="Subscribe" /></td></tr></table></form></div></div><span id="sysmsg-tip-close" class="sysmsg-tip-close">Close</span></div><div class="sysmsg-tip-bottom"></div></div>
<?php }?>

<?php if($order){?>
<div id="sysmsg-tip" ><div class="sysmsg-tip-top"></div><div class="sysmsg-tip-content">You have ordered, not paid yet.<a href="/order/check.php?id=<?php echo $order['id']; ?>">Check order and make a payment</a><span id="sysmsg-tip-close" class="sysmsg-tip-close">Close</span></div><div class="sysmsg-tip-bottom"></div></div>
<div id="deal-default"> 
<?php }?>

	<div class="clr"></div>

  <div id="main-content">

    <div id="left">

      <div class="left-1">

        <div class="left-content-top"></div>

        <div class="left-content-middle">

		<h1><?php if($team['state']=='none'){?><span class="green">Today's Deal</span><?php }?> <?php echo $team['title']; ?> </h1>

		<div class="clr"></div>

		<div class="left-1-left">
	
	<?php if(($team['state']=='soldout')){?>
		<div class="main-deal-soldout">
			<h1><?php echo $currency; ?><?php echo $team['team_price']; ?></h1>
		</div>
	<?php } else if($team['state']=='none') { ?>
	<a href="/team/buy.php?id=<?php echo $team['id']; ?>">
		<div class="main-deal-buy">
			<h1><?php echo $currency; ?><?php echo $team['team_price']; ?></h1>
		</div></a>
		<?php } else { ?>
		<div class="main-deal-expired">
			<h1><?php echo $currency; ?><?php echo $team['team_price']; ?></h1>
		</div>
		<?php }?>
		<div class="count-down">

		<p>Value<br /><?php echo $currency; ?><?php echo $team['market_price']; ?><br />
		</p>
		<p>Discount<br />
		<?php echo moneyit(100-$discount_rate); ?>%
		</p>
		<p>You Save<br />
		<?php echo $currency; ?><?php echo $discount_price; ?>
		</p>

<div class="clr"></div>

<h1>Time Left to Buy</h1>
<?php if($team['state']=='none'){?>
<div class="input-field"><input value="<?php echo $left_hour; ?>" type="text" /><input value="<?php echo $left_minute; ?>" type="text" /><input value="<?php echo $left_time; ?>" type="text" /></div><div class="clr"></div>
<?php } else { ?>
<div class="input-field"><input value="00" type="text" /><input value="00" type="text" /><input value="00" type="text" /></div><div class="clr"></div>
<?php }?>
<p class="hrs">hrs</p><p class="min">min</p><p class="sec">sec</p>

		</div>
<?php if($team['state']=='none'){?>
			<?php if($team['now_number']<$team['min_number']){?>
					<div class="bought">
			
					<h1><?php echo $team['now_number']; ?> bought</h1>
			
					<img src="images/progress.jpg" />
			
					<p><?php echo $team['min_number']-$team['now_number']; ?> more need to be bought for the 
			
			deal to tip. <a href="#">Learn more</a><br /></p>
			
					</div>
		<?php } else { ?>
			<div class="bought">
			
					<h1><?php echo $team['now_number']; ?> bought</h1>
			
					<img src="images/progress.jpg" />
					<p>The deal is tipped!
					<?php if($team['max_number']>$team['now_number']||$team['max_number']==0){?><br/>You can buy it now. <?php }?></p>
			
					</div>
					<?php }?>
<?php } else { ?>
		<div class="bought">
			<h1>Deal is closed!</h1>
					<p><?php echo $team['now_number']; ?> bought</p>
					
					</div>
	<?php }?>
		<div class="buy-friend">

		<p><a href="#">Buy it for a friend!</a></p>

		</div>

		</div>

		<div class="left-1-right">

		<?php include template("block_team_share");?>


			<div class="main-deal-img">
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

			<div class="discuss">

			<ul>

			<li class="discuss-left"></li>

			<li><a href="/team/ask.php?id=<?php echo $team['id']; ?>">Discuss the deal</a></li>

			<li class="discuss-right"></li>

			</ul>

			</div>

			<div class="clr"></div>

			<div class="the-fine-print green-break">

			<?php echo $team['summary']; ?>

			</div>

			<div class="highlights">

			<<?php echo $team['notice']; ?>

			</div>

		</div>

		<div class="clr"></div>

		</div>

        <div class="left-content-bottom"></div>

      </div>

      <div class="left-2">

        <div class="left-content-top"></div>

        <div class="left-content-middle">

          <div class="left-2-left break">
			<?php echo $team['detail']; ?>
          </div>

          <div class="left-2-right">

            <h1>Business Info</h1>

            <p><?php echo $partner['title']; ?>

             <br />
			<?php echo $partner['location']; ?>
              <br />
              <a href="<?php echo $partner['homepage']; ?>" target="_blank"><?php echo domainit($partner['homepage']); ?></a></p>

          </div>

          <div class="clr"></div>

        </div>

        <div class="left-content-bottom"></div>

      </div>

      <div class="left-3">

        <div class="left-content-top"></div>

        <div class="left-content-middle">

         <?php include template("team_discussion");?>


        </div>

        <div class="left-content-bottom"></div>

      </div>

    </div>

    <div id="right">

      <div class="side-bar-1">
	<?php include template("block_side_subscribe");?>
      </div>

      <div class="side-bar-2">
	<?php include template("block_side_others");?>

      </div>

      <div class="side-bar-3">
	<?php include template("block_side_giftcard");?>
      </div>

      <div class="side-bar-4">

        <div class="side-bar-inner"> <img src="/static/images/side-bar-fb.jpg" /> </div>

      </div>

    </div>

  </div>


<?php include template("footer");?>
