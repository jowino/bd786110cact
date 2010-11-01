<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="leader">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_team(null); ?></ul>
	</div>
	<div id="content" class="clr mainwide">
        <div class="clr box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Edit</h2><span class="headtip">（<?php echo $team['title']; ?>）</span></div>
                <div class="sect">
				<form id="-user-form" method="post" action="/manage/team/edit.php?id=<?php echo $team['id']; ?>" enctype="multipart/form-data" class="validator">
					<input type="hidden" name="id" value="<?php echo $team['id']; ?>" />
					<div class="wholetip clr"><h3>1. Basic</h3></div>
					<div class="field">
						<label>City&Category</label>
						<select name="city_id" class="f-input" style="width:200px;"><?php echo Utility::Option($cities, $team['city_id']); ?></select><select name="group_id" class="f-input" style="width:200px;"><?php echo Utility::Option($groups, $team['group_id']); ?></select>
					</div>
					<div class="field">
						<label>Title of Deal</label>
						<input type="text" size="30" name="title" id="team-create-title" class="f-input" value="<?php echo $team['title']; ?>" datatype="require" require="true" />
					</div>
					<div class="field">
						<label>Value</label>
						<input type="text" size="10" name="market_price" id="team-create-market-price" class="number" value="<?php echo moneyit($team['market_price']); ?>" datatype="money" require="true" />
						<label>Deal's Price</label>
						<input type="text" size="10" name="team_price" id="team-create-team-price" class="number" value="<?php echo moneyit($team['team_price']); ?>" datatype="money" require="true" />
						<span class="inputtip">Deals must lower than normal price</span>
					</div>
					<div class="field">
						<label>Min.</label>
						<input type="text" size="10" name="min_number" id="team-create-min-number" class="number" value="<?php echo intval($team['min_number']); ?>" maxLength="6" datatype="number" require="true" />
						<label>Max.</label>
						<input type="text" size="10" name="max_number" id="team-create-max-number" class="number" value="<?php echo intval($team['max_number']); ?>" maxLength="6" datatype="number" require="true" />
						<label>Max. for each</label>
						<input type="text" size="10" name="per_number" id="team-create-per-number" class="number" value="<?php echo intval($team['per_number']); ?>" maxLength="6" datatype="number" require="true" />
						<span class="hint">Bigger than 0, 0 means no limit.</span>
					</div>
					<div class="field">
						<label>Start date</label>
						<input type="text" size="10" name="begin_time" id="team-create-begin-time" class="date" value="<?php echo date('Y-m-d', $team['begin_time']); ?>" maxLength="10" />
						<label>End date</label>
						<input type="text" size="10" name="end_time" id="team-create-end-time" class="date" value="<?php echo date('Y-m-d', $team['end_time']); ?>" maxLength="10" />
						<label>Valid till</label>
						<input type="text" size="10" name="expire_time" id="team-create-expire-time" class="date" value="<?php echo date('Y-m-d', $team['expire_time']); ?>" maxLength="10" />
						<span class="hint">Starts at start date 00:00:00, ends at end date 00:00:00</span>
					</div>
					<div class="field">
						<label>Charity</label>
						<input type="hidden" name="deal_charity_id" value="<?php echo $charity['id']; ?>" />
						<select name="charity_id" class="f-input" style="width:200px;"><?php echo Utility::Option($charities,$charity['charity_id']); ?></select>
						<label style="width:125px">Charity Amount(%)</label>
						<input type="text" size="10" name="charityvalue" id="deal-charity-value" value="<?php echo $charityvalue; ?>" class="number" datatype="number"  />
					</div>
					<div class="field">
						<label>Brief Introduction</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="summary" id="team-create-summary" class="xheditor-simple"><?php echo htmlspecialchars($team['summary']); ?></textarea></div>
					</div>
					<div class="field">
						<label>Special Hint</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="notice" id="team-create-notice" class="xheditor-simple"><?php echo $team['notice']; ?></textarea></div>
						<span class="hint">Detailed information and valid date of this deal</span>
					</div>
					<input type="hidden" name="guarantee" value="Y" />
					<input type="hidden" name="system" value="Y" />
					<div class="wholetip clr"><h3>2. Information About This Deal</h3></div>
					<div class="field">
						<label>Partner</label>
						<select name="partner_id" datatype="require" require="true"><?php echo Utility::Option($partners, $team['partner_id'], '------ Choose Partner ------'); ?></select>
					</div>
					<div class="field">
						<label></label>
						<input type="text" size="30" name="product" id="team-create-product" class="f-input" value="<?php echo $team['product']; ?>" datatype="require" require="true" />
					</div>
					<div class="field">
						<label>Product Picture</label>
						<input type="file" size="30" name="upload_image" id="team-create-image" class="f-input" />
						<?php if($team['image']){?><span class="hint"><?php echo team_image($team['image']); ?></span><?php }?>
					</div>
					<div class="field">
						<label>Picture 1</label>
						<input type="file" size="30" name="upload_image1" id="team-create-image1" class="f-input" />
						<?php if($team['image1']){?><span class="hint"><?php echo team_image($team['image1']); ?></span><?php }?>
					</div>
					<div class="field">
						<label>Picture 2</label>
						<input type="file" size="30" name="upload_image2" id="team-create-image2" class="f-input" />
						<?php if($team['image2']){?><span class="hint"><?php echo team_image($team['image2']); ?></span><?php }?>
					</div>
					<div class="field">
						<label>FLV Video</label>
						<input type="text" size="30" name="flv" id="team-create-flv" class="f-input" value="<?php echo $team['flv']; ?>" />
						<span class="hint">Format Should Be Like This: http://.../video.flv</span>
					</div>
					<div class="field">
						<label>Deal details</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="detail" id="team-create-detail" class="xheditor-simple"><?php echo htmlspecialchars($team['detail']); ?></textarea></div>
					</div>
					<div class="field">
						<label>Comments</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="userreview" id="team-create-userreview" class="noclass"><?php echo htmlspecialchars($team['userreview']); ?></textarea></div>
						<span class="hint">Format: "That's great! |Rose|http://ww....|XXX Website" one comment each line</span>
					</div>
					<div class="field">
						<label><?php echo $INI['system']['abbreviation']; ?> Abbreviation</label>
						<div style="float:left;"><textarea cols="45" rows="5" name="systemreview" id="team-create-systemreview" class="xheditor-simple"><?php echo htmlspecialchars($team['systemreview']); ?></textarea></div>
					</div>
					<div class="wholetip clr"><h3>3. Delivery Information</h3></div>
					<div class="field">
						<label>Delivery</label>
						<div style="margin-top:5px;" id="express-zone-div"><input type="radio" name="delivery" value="coupon" <?php echo $team['delivery']=='coupon'?'checked':''; ?> />&nbsp;<?php echo $INI['system']['couponname']; ?>&nbsp;<input type="radio" name="delivery" value='express' <?php echo $team['delivery']=='express'?'checked':''; ?> />&nbsp;Express Delivery&nbsp;<input type="radio" name="delivery" value='pickup' <?php echo $team['delivery']=='pickup'?'checked':''; ?> />&nbsp;Self Withdraw</div>
					</div>
					<div id="express-zone-coupon" style="display:<?php echo $team['delivery']=='coupon'?'block':'none'; ?>;">
						<div class="field">
							<label>Rebate</label>
							<input type="text" size="10" name="credit" id="team-create-credit" class="number" value="<?php echo moneyit($team['credit']); ?>" datatype="money" require="true" />
							<span class="inputtip">Pay <?php echo $INI['system']['couponname']; ?>Get Rebate</span>
						</div>
					</div>
					<div id="express-zone-pickup" style="display:<?php echo $team['delivery']=='pickup'?'block':'none'; ?>;">
						<div class="field">
							<label>Tel.</label>
							<input type="text" size="10" name="mobile" id="team-create-mobile" class="f-input" value="<?php echo $team['mobile']; ?>" />
						</div>
						<div class="field">
							<label>Deliver address</label>
							<input type="text" size="10" name="address" id="team-create-address" class="f-input" value="<?php echo $team['address']; ?>" />
						</div>
					</div>
					<div id="express-zone-express" style="display:<?php echo $team['delivery']=='express'?'block':'none'; ?>;">
						<div class="field">
							<label>Delivery fee</label>
							<input type="text" size="10" name="fare" id="team-create-fare" class="number" value="<?php echo intval($team['fare']); ?>" maxLength="6" datatype="money" require="true" />
							<span class="inputtip">Delivery fee</span>
						</div>
						<div class="field">
							<label>Delivery Info</label>
							<div style="float:left;"><textarea cols="45" rows="5" name="express" id="team-create-express"><?php echo $team['express']; ?></textarea></div>
						</div>
					</div>
					<input type="submit" value="OK, Submit" name="commit" id="leader-submit" class="formbutton" style="margin:10px 0 0 120px;"/>
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
