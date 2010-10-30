<?php 
	$ask_con = array('team_id='.$team['id']);
	$ask_count = Table::Count('ask', $ask_con);
	$asks = DB::LimitQuery('ask', array('condition'=>$ask_con, 'size'=>3, 'order'=>'ORDER BY id DESC'));
; ?>
<div class="deal-consult sbox">
	<div class="sbox-bubble"></div>
	<div class="sbox-top"></div>
	<div class="sbox-content">
		<div class="deal-consult-tip">
			<h2>Discussion of this order</h2>
			<p class="nav"><a href="/team/ask.php?id=<?php echo $team['id']; ?>">Check all(<?php echo $ask_count; ?>)</a> | <a href="/team/ask.php?id=<?php echo $team['id']; ?>#post">Join the Discussion</a></p>
			<ul class="list">
			<?php if(is_array($asks)){foreach($asks AS $one) { ?>
				<li><a href="/team/ask.php?id=<?php echo $team['id']; ?>#ask-entry-<?php echo $one['id']; ?>" target="_blank"><?php echo htmlspecialchars(mb_substr($one['content'],0,30,'UTF-8')); ?>...</a></li>
			<?php }}?>
			</ul>
			<div class="custom-service"><p class="im"><a id="service-msn-help" href="msnim:chat?contact=<?php echo $INI['system']['kefumsn']; ?>"><img src="/static/css/i/button-custom-msn.gif" /></a>&nbsp;<a href="tencent://message/?uin=<?php echo $INI['system']['kefuqq']; ?>&Site=<?php echo $INI['system']['sitename']; ?>&Menu=yes"><img SRC="/static/css/i/button-custom-qq.gif" alt=""></a></p><p class="time">Monday to Saturday 9:00-18:00</p></div>
		</div>
	</div>
	<div class="sbox-bottom"></div>
</div>
