<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="partner">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_system('page'); ?></ul>
	</div>
	<div id="content" class="clr mainwide">
        <div class="clr box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>Edit Page</h2></div>
                <div class="sect">
                    <form method="post">
						<div class="field">
							<label>Page Option</label>
							<select name="id" id="manage_system_page_id" class="f-input" onchange="X.manage.loadpage(this.options[this.selectedIndex].value);"><?php echo Utility::Option($pages, $id, '-'); ?></select>
						</div>
					<?php if($content||$id){?>
						<div class="field">
							<label>Page Content</label>
							<div style="float:left;"><textarea cols="100" rows="25" class="editor" name="value"><?php echo htmlspecialchars($value); ?></textarea></div>
						</div>
					<?php }?>
                        <div class="act">
                            <input type="submit" value="Save" name="commit" class="formbutton"/>
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
