<div id="ftw">
	<div id="ft">
		<p class="contact"><a href="/feedback/suggest.php">Feedback</a></p>
		<ul class="cf">
			<li class="col">
				<h3>Help</h3>
				<ul class="sub-list">
					<li><a href="/help/tour.php">Tour <?php echo $INI['system']['abbreviation']; ?></a></li>
					<li><a href="/help/faqs.php">FAQ</a></li>
				</ul>
			</li>
			<li class="col">
				<h3>Follow Us</h3>
				<ul class="sub-list">
					<li><a href="/subscribe.php?ename=<?php echo $city['ename']; ?>">Subscribe Email</a></li>
					<li><a href="/feed.php?ename=<?php echo $city['ename']; ?>">Subscribe RSS</a></li>
				</ul>
			</li>
			<li class="col">
				<h3>Contact&Info</h3>
				<ul class="sub-list">
					<li><a href="/feedback/seller.php">Business</a></li>
					<li><a href="/feedback/suggest.php">Suggestions</a></li>
					<li><a href="/about/contact.php">Contact</a></li>
				</ul>
			</li>
			<li class="col">
				<h3>Company</h3>
				<ul class="sub-list">
					<li><a href="/about/us.php">About <?php echo $INI['system']['abbreviation']; ?></a></li>
					<li><a href="/about/job.php">Job Oportunity</a></li>
					<li><a href="/about/terms.php">Terms&Conditions </a></li>
					<li><a href="/about/privacy.php">Privacy</a></li>
				</ul>
			</li>
			<li class="col end">
					<div class="logo-footer">
						<a href="/"><img src="/static/css/i/logo-footer.gif" /></a>
					</div>
			</li>
		</ul>
		<div class="copyright">
		<p>&copy;<span>2010</span>&nbsp;<?php echo $INI['system']['sitename']; ?>. All Rigght Reserved&nbsp;<a href="/about/terms.php">Read
		    <?php echo $INI['system']['abbreviation']; ?> before use </a>&nbsp;</p>
		</div>
	</div>
</div>
<?php include template("html_footer");?>
