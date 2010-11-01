<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="user">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_user(null); ?><li class="current"><a href="/manage/user/managegroup.php?id=<?php echo $group['id']; ?>">Edit Group</a><span></span></li></ul>
	</div>
	<div id="content" class="clr mainwide">
        <div class="clr box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2><?php echo $title; ?></h2></div>
                <div class="sect">
                    <form id="login-user-form" method="post" action="/manage/user/managegroup.php?id=<?php echo $group['id']; ?>">
					<input type="hidden" name="id" value="<?php echo $group['id']; ?>" />
						<div class="wholetip clr"><h3>User Group Name</h3></div>
					  	<div class="field">
					  		<input type="text" size="30" name="name" id="user-create-usergroup" class="f-input" value="<?php echo $group['name']; ?>" require="true" datatype="require" />
					  	</div>
						<div class="wholetip clr"><h3>Access Permission</h3></div>
                        <div class="field">
				            <div class="scrollbox" id='scrollbox_0'>
				              <?php $class = 'odd'; ?>
				              <?php foreach ($accesspermissions as $permission) { ?>
				              <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
				              <div class="<?php echo $class; ?>">
				                <?php if (in_array($permission, $access)) { ?>
				                <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" checked="checked" />
				                <?php echo $permission; ?>
				                <?php } else { ?>
				                <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" />
				                <?php echo $permission; ?>
				                <?php } ?>
				              </div>
				              <?php } ?>
				            </div>
				            <span><a onclick="$('#scrollbox_0 :checkbox').attr('checked', 'checked');"><u>Select All</u></a> / <a onclick="$('#scrollbox_0 :checkbox').attr('checked', '');"><u>Unselect All</u></a></span>
						</div>
						<div class="wholetip clr"><h3>Modify Permission</h3></div>
                        <div class="field">
							  <div class="scrollbox" id='scrollbox_1'>
				              <?php $class = 'odd'; ?>
				              <?php foreach ($modifypermissions as $permission) { ?>
				              <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
				              <div class="<?php echo $class; ?>">
				                <?php if (in_array($permission, $modify)) { ?>
				                <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" checked="checked" />
				                <?php echo $permission; ?>
				                <?php } else { ?>
				                <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" />
				                <?php echo $permission; ?>
				                <?php } ?>
				              </div>
				              <?php } ?>
				            </div>
				            <span><a onclick="$('#scrollbox_1 :checkbox').attr('checked', 'checked');"><u>Select All</u></a> / <a onclick="$('#scrollbox_1 :checkbox').attr('checked', '');"><u>Unselect All</u></a></span>
                        </div>
                        <div class="act">
                            <input type="submit" value="Save" name="commit" id="user-submit" class="formbutton"/>
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
