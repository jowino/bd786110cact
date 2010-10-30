<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="user">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_user(null); ?><li class="current"><a href="/manage/user/edit.php?id=<?php echo $user['id']; ?>">Edit User</a><span></span></li></ul>
	</div>
	<div id="content" class="clear mainwide">
        <div class="clear box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Edit User</h2><b style="margin-left:20px;font-size:16px;">（<?php echo $user['email']; ?>/<?php echo $user['username']; ?>）</b></div>
                <div class="sect">
                    <form id="login-user-form" method="post" action="/manage/user/edit.php?id=<?php echo $user['id']; ?>">
					<input type="hidden" name="id" value="<?php echo $user['id']; ?>" />
						<div class="wholetip clear"><h3>1. Identification</h3></div>
                        <div class="field">
                            <label>User's Email</label>
                            <input type="text" size="30" name="email" id="user-edit-email" class="f-input" value="<?php echo $user['email']; ?>" readonly />
						</div>
						<div class="field">
                            <label>Username</label>
                            <input type="text" size="30" name="username" id="user-edit-username" class="f-input" value="<?php echo $user['username']; ?>" readonly />
                        </div>
						<div class="field">
                            <label>Real Name</label>
                            <input type="text" size="30" name="realname" id="user-edit-realname" class="f-input" value="<?php echo $user['realname']; ?>" />
                        </div>
                        <div class="field password">
                            <label>Password</label>
                            <input type="text" size="30" name="password" id="settings-password" class="f-input" />
                            <span class="hint">Leave blank if don't want to change.</span>
                        </div>
                        <div class="field">
                            <label>User Group</label>
				            <select name="user_group_id">
				            <?php if(is_array($user_groups)){foreach($user_groups AS $index=>$user_group) { ?>
				            <?php if($user_group['id'] == $user_group_id){?>
				              <option value="<?php echo $user_group['id']; ?>" selected="selected"><?php echo $user_group['name']; ?></option>
				              <?php } else { ?>
				              <option value="<?php echo $user_group['id']; ?>"><?php echo $user_group['name']; ?></option>
				              <?php }?>
				              <?php }}?>
				            </select>
                        </div>
						<div class="wholetip clear"><h3>2. Basic Info</h3></div>
                        <div class="field">
                            <label>Post Code</label>
                            <input type="text" size="30" name="zipcode" id="user-edit-zipcode" class="f-input" value="<?php echo $user['zipcode']; ?>"/>
                        </div>
                        <div class="field">
                            <label>Address</label>
                            <input type="text" size="30" name="address" id="user-edit-address" class="f-input" value="<?php echo $user['address']; ?>"/>
						</div>
                        <div class="field">
                            <label>HP number</label>
                            <input type="text" size="30" name="mobile" id="user-edit-mobile" class="f-input" value="<?php echo $user['mobile']; ?>" maxLength="11" />
						</div>
                        <div class="act">
                            <input type="submit" value="Edit" name="commit" id="user-submit" class="formbutton"/>
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
