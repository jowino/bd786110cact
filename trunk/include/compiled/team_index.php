<?php include template("header");?>


<div class="clr"></div>

  <div id="inner-content">

  	<div class="inner-content-top"></div>

	<div class="inner-content-middle">

	<div class="past-deals-heading">

		<div class="heading-past-deals"><h1 class="past-deals">Sign Up</h1><h2 class="past-deals">For our daily email so you never miss another Groupon!</h2></div><div class="input-pasrt-deals">

		<form action="/subscribe.php" method="post">

		<input type="text" name="email" /><input class="past-deals-submit" type="submit" value="Submit" /></form></div>
		</div>

		<div class="clr"></div>

		<div id="past-deals-content">
<?php if(is_array($teams)){foreach($teams AS $index=>$one) { ?>
		<div class="past-deals-box">

		<p><?php echo date('m.d.Y', $one['end_time']); ?></p>

		<div class="products-details-box">

		<h3><p><a style="height:32px;float:left;overflow:hidden;" href="/team.php?id=<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a></p></h3>

		<div class="products-details-box-left">

		<div class="value-button">

		<div class="moo-bought"><?php echo $one['now_number']; ?><br /><span class="moo">Moo Bought</span></div>

                <span class="value-arrow">

				<span>Price: <?php echo moneyit($one['team_price']); ?></span>

				</span>

                <div class="clr"></div>

              <div class="show-value">

			  <p>Value: <?php echo moneyit($one['market_price']); ?> </p>

			  <p>Savings: <?php echo moneyit($one['market_price']-$one['team_price']); ?></p>

			  </div>

            </div>

		</div>

		<div class="products-details-box-right">

		<a title="<?php echo $one['title']; ?>" href="/team.php?id=<?php echo $one['id']; ?>"><img alt="<?php echo $one['title']; ?>" src="<?php echo team_image($one['image']); ?>" width="190" height="105"></a>

		</div>

		</div>

		</div>

<?php }}?>
<div class="clr"></div>
					<div><?php echo $pagestring; ?></div>

		</div>

		<div class="clr"></div>

	</div>

	<div class="inner-content-bottom"></div>  

  </div>


<?php include template("footer");?>
