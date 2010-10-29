<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="leader">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_team('create'); ?></ul>
	</div>
	<div id="content" class="clear mainwide">
        <div class="clear box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>New Deal</h2></b></div>
                <div class="sect">
				<form id="login-user-form" method="post" action="/manage/team/create.php" enctype="multipart/form-data" class="validator">
					<div class="wholetip clear"><h3>1. Basic</h3></div>
					<div class="field">
						<label>City&Category</label>
						<select name="city_id" class="f-input" style="width:200px;"><?php echo Utility::Option($cities, $team['city_id']); ?></select><select name="group_id" class="f-input" style="width:200px;"><?php echo Utility::Option($groups, $team['group_id']); ?></select>
					</div>
					<div class="field">
						<label>Title of Deal</label>
						<input type="text" size="30" name="title" id="team-create-title" class="f-input" value="<?php echo $team['title']; ?>" require="true" datatype="require"/>
					</div>
					<div class="field">
						<label>Value</label>
						<input type="text" size="10" name="market_price" id="team-create-market-price" class="number" value="<?php echo moneyit($team['market_price']); ?>" datatype="money" require="true" />
						<label>Deal's Price</label>
						<input type="text" size="10" name="team_price" id="team-create-team-price" class="number" value="<?php echo moneyit($team['team_price']); ?>" datatype="money" require="true" />
						<span class="inputtip">Deals must lower than normal price</span>
					</div>
					<div class="field">
						<label>Min</label>
						<input type="text" size="10" name="min_number" id="team-create-min-number" class="number" value="<?php echo intval($team['min_number']); ?>" maxLength="6" datatype="number" require="true" />
						<label>Max.</label>
						<input type="text" size="10" name="max_number" id="team-create-max-number" class="number" value="<?php echo intval($team['max_number']); ?>" maxLength="6" datatype="number" require="true" />
						<label>Max. each person</label>
						<input type="text" size="10" name="per_number" id="team-create-per-number" class="number" value="<?php echo intval($team['per_number']); ?>" maxLength="6" datatype="number" require="true" />
						<span class="hint">Min. must be bigger than 0, set max. limit to 0 means no limit.</span>
					</div>
					<div class="field">
						<label>Start Date</label>
						<input type="text" size="10" name="begin_time" id="team-create-begin-time" class="date" value="<?php echo date('Y-m-d', $team['begin_time']); ?>" maxLength="10" readonly />
						<label>End Date</label>
						<input type="text" size="10" name="end_time" id="team-create-end-time" class="date" value="<?php echo date('Y-m-d', $team['end_time']); ?>" maxLength="10" />
						<label>Valid Till</label>
						<input type="text" size="10" name="expire_time" id="team-create-expire-time" class="date" value="<?php echo date('Y-m-d', $team['expire_time']); ?>" maxLength="10" />
						<span class="hint">Starts at start date 00:00:00, ends at end date 00:00:00</span>
					</div>
					<div class="field">
						<label>Brief Introduction</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="summary" id="team-create-summary" class="xheditor-simple"></textarea></div>
					</div>
					<div class="field">
						<label>Special Hint</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="notice" id="team-create-notice" class="xheditor-simple"><?php echo $team['notice']; ?></textarea></div>
						<span class="hint">Detailed information and valid date of this deal</span>
					</div>
					<input type="hidden" name="guarantee" value="Y" />
					<input type="hidden" name="system" value="Y" />
					<div class="wholetip clear"><h3>2. Information About This Deal</h3></div>
					<div class="field">
						<label>Partner</label>
						<select name="partner_id" datatype="require" require="true"><?php echo Utility::Option($partners, $team['partner_id'], '------ Choose Partner ------'); ?></select>
					</div>
					<div class="field">
						<label>Item's Name</label>
						<input type="text" size="30" name="product" id="team-create-product" class="f-input" value="<?php echo $team['product']; ?>" datatype="require" require="true" />
					</div>
					<div class="field">
						<label>Product Picture</label>
						<input type="file" size="30" name="upload_image" id="team-create-image" class="f-input" />
						<span class="hint">At least one picture.</span>
					</div>
					<div class="field">
						<label>Picture 1</label>
						<input type="file" size="30" name="upload_image1" id="team-create-image1" class="f-input" />
					</div>
					<div class="field">
						<label>Picture 2</label>
						<input type="file" size="30" name="upload_image2" id="team-create-image2" class="f-input" />
					</div>
					<div class="field">
						<label>FLV Video</label>
						<input type="text" size="30" name="flv" id="team-create-flv" class="f-input" />
						<span class="hint">Format: http://.../video.flv</span>
					</div>
					<div class="field">
						<label>Order Details</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="detail" id="team-create-detail" class="xheditor-simple"></textarea></div>
					</div>
					<div class="field">
						<label>Comments</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="userreview" id="team-create-userreview" class="noclass"><?php echo htmlspecialchars($team['userreview']); ?></textarea></div>
						<span class="hint">Format: "That's great! |Rose|http://ww....|XXX Website" One comment each line.</span>
					</div>
					<div class="field">
						<label><?php echo $INI['system']['abbreviation']; ?> abbreviation</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="systemreview" id="team-create-systemreview" class="xheditor-simple"></textarea></div>
					</div>
					<div class="wholetip clear"><h3>3. Delivery Information</h3></div>
					<div class="field">
						<label>Delivery</label>
						<div style="margin-top:5px;" id="express-zone-div"><input type="radio" name="delivery" value="coupon" checked>&nbsp;<?php echo $INI['system']['couponname']; ?>&nbsp;<input type="radio" name="delivery" value='express' />&nbsp;Express delivery&nbsp;<input type="radio" name="delivery" value='pickup' />&nbsp;Self withdraw</div>
					</div>
					<div id="express-zone-coupon" style="display:<?php echo $team['delivery']=='coupon'?'block':'none'; ?>;">
						<div class="field">
							<label>Rebate</label>
							<input type="text" size="10" name="credit" id="team-create-credit" class="number" value="<?php echo moneyit($team['credit']); ?>" />
							<span class="inputtip" require="true" datatype="money">Pay <?php echo $INI['system']['couponname']; ?>Get Rebate</span>
						</div>
					</div>
					<div id="express-zone-pickup" style="display:<?php echo $team['delivery']=='pickup'?'block':'none'; ?>;">
						<div class="field">
							<label>Tel.</label>
							<input type="text" size="10" name="mobile" id="team-create-mobile" class="f-input" value="<?php echo $login_manager['mobile']; ?>" />
						</div>
						<div class="field">
							<label>Withdraw address</label>
							<input type="text" size="10" name="address" id="team-create-address" class="f-input" value="<?php echo $login_manager['address']; ?>" />
						</div>
					</div>
					<div id="express-zone-express" style="display:<?php echo $team['delivery']=='express'?'block':'none'; ?>;">
						<div class="field">
							<label>Delivery fee</label>
							<input type="text" size="10" name="fare" id="team-create-fare" class="number" value="<?php echo intval($team['fare']); ?>" maxLength="6" datatype="money" require="true" />
							<span class="inputtip">Free delivery</span>
						</div>
						<div class="field">
							<label>Deliver address</label>
							<div style="float:left;"><textarea cols="45" rows="5" name="express" id="team-create-express" class="xheditor-simple"><?php echo $team['express']; ?></textarea></div>
						</div>
					</div>
					<div class="act">
						<input type="submit" value="OK, Submit" name="commit" id="leader-submit" class="formbutton"/>
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