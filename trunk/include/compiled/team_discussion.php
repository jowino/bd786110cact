 <h1>Questions About the Deal</h1>
<?php if(is_array($asks)){foreach($asks AS $one) { ?>
          <div class="comment">

            <p class="green"><?php echo $users[$one['user_id']]['username']; ?></p>

            <p>(<?php echo Utility::HumanTime($one['create_time']); ?>)</p>

            <div class="comment-box">

              <div class="comment-top"></div>

              <div class="comment-middle">

                <p><?php echo $one['content']; ?> </p>
				<?php if($one['comment']!=""){?>
				<p style="color:red;">Reply:<?php echo $one['comment']; ?></p>
				<?php }?>
              </div>

              <div class="comment-bottom"></div>

            </div>

          </div>
          <?php }}?>
          