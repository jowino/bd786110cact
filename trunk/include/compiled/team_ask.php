<?php include template("header");?>
<div class="clr"></div>
<div id="main-content">
  <div id="left">
    <div class="left-1">
		<div class="left-content-top"></div>
		<div class="left-content-middle" style="height:150px;"><p style="margin-left:20px;"><a href="/team.php?id=<?php echo $team['id']; ?>">&raquo;&nbsp;Back to deal</a>
                  </p><h1 style="float:left;"><?php echo $team['title']; ?></h1>
                  <?php if($team['state']=='none'){?>
                  <a href="/team/buy.php?id=<?php echo $team['id']; ?>"><div class="deal-buy" style="float:left;margin-left:25px;">

		</div></a>
                  <?php }?>
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
	<div class="left-3">
		<div class="left-content-top"></div>
		<div class="left-content-middle">
		 <h1 style="margin-left:20px;">Comment</h1>
		 <div style="margin-left:20px;">
		 <?php if(is_login()){?>
						<form id="consult-add-form1" method="post" action="/ajax/team.php?action=ask&id=<?php echo $team['id']; ?>">
						<input type="hidden" id="parent_id" value="<?php echo $parent_id; ?>"/>
						<textarea class="xheditor-simple" cols="60" rows="5" name="content" id="consult-content1"></textarea>
						<p class="commit">
							<input type="hidden" name="team_id" value="<?php echo $team['id']; ?>" />
							<input type="submit" value="OK, Submit" name="commit" class="submit"/>
						</p>
						</form>
                        <div id="consult-add-succ1" class="succ"><p><a href="/team.php?id=<?php echo $team['id']; ?>">Go back to this deal</a></p></div>
					<?php } else { ?>
						Please <a href="/account/login.php?r=<?php echo $currefer; ?>">Login</a> or <a href="/account/signup.php">Register</a> first before asking.
					<?php }?>
          </div></div>
          <div class="left-content-bottom"></div>
	</div>
  </div>
   <div id="right">
     <?php include template("block_side_invite");?>
    </div>
</div>


<?php include template("footer");?>
