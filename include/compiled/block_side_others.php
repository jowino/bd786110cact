
<?php if($others){?>
       <div class="side-bar-heading">
          <h2>
          Side Deal
          </h2>
        </div>
        <?php if(is_array($others)){foreach($others AS $one) { ?>
        <div class="side-bar-inner">
          <p><?php echo ++$index; ?>. <?php echo $one['title']; ?></p>
          <a href="/team.php?=<?php echo $one['id']; ?>"><img src="<?php echo team_image($one['image']); ?>" width="195" height="148" border="0" /></a>
          <div class="valued">
            <a href="/team.php?id=<?php echo $one['id']; ?>">&raquo;&nbsp;Check Detail</a>
          </div>
        </div>
        <?php }}?>
  <?php }?>