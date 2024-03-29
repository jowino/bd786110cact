<?php include template("header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="help">
	<div class="dashboard" id="dashboard">
		<ul><?php echo current_help('faqs'); ?></ul>
	</div>
	<div id="content" class="faq clear">
        <div class="box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"><h2>FAQ</h2></div>
                <div class="sect">
                    <ol class="faqlist">
                        <li>
                            <h4>What is <?php echo $INI['system']['sitename']; ?>?</h4>
                            <p><?php echo $INI['system']['sitename']; ?>. Each day, Groupon features an unbeatable deal on
                              the best stuff to do, see, eat, and buy in your
                              city. By promising businesses a minimum number
                              of customers, we get discounts you won't find anywhere
                              else.</p>

                        </li>
                        <li class="alt">
                            <h4>I like today's deal - how do I get it?</h4>
                            <p>Just click "BUY" before the offer ends at midnight. If the minimum number of people sign up, we'll charge your card and send you a link to print your Groupon. If not enough people join, no one gets it (and you won't be charged), so invite your friends to make sure you get the deal!</p>
                        </li>

                        <li>
                            <h4>How can I pay for <?php echo $INI['system']['sitename']; ?>?</h4>
                            <p>Support following payment: </p>
                            <div class="paytype">
							<?php if($INI['paypal']['mid']){?>
                                <p class="paypal">PayPal for international users.</p>
							<?php }?>							
							<?php if($INI['alipay']['mid']){?>
                                <p class="alipay">Alipay for taotao users.</p>
							<?php }?>
							<?php if($INI['chinabank']['mid']){?>
                                <p class="chinabank">Chinabank for internet banking in China.</p>
							<?php }?>
                            </div>
                        </li>

                        <li class="alt">
                        <h4>I bought a Groupon - how do I use it?</h4>
                        <p>Once you're charged, you'll receive an email with a link to sign in and print your Groupon. The Groupon has redemption instructions and a map right on it! </p>
                        </li>

                        <li>
                            <h4>What happens if the Groupon doesn't reach its required minimum number of purchasers?</h4>
                            <p>If not enough people sign up, then <?php echo $INI['system']['sitename']; ?> and you won't be charged. Better luck next time! So if you really want the Groupon, be sure to either beg or threaten your friends .</p>
                        </li>

                        <li class="alt">
                            <h4>What is <?php echo $INI['system']['couponname']; ?>? How to use?</h4>
                            <p><?php echo $INI['system']['couponname']; ?>Once you're charged, you'll receive an email with a link to sign in and print your Groupon. The Groupon has redemption instructions and a map right on it! <?php echo $INI['system']['couponname']; ?></p>
                        </li>

                    

                    </ol>

                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
	</div>
    <div id="sidebar">
        <div class="sbox-white">
            <div class="sbox-top"></div>
            <div class="sbox-content">
                <div class="side-tip-help">
                    <p>
                        <a href="/learn"><img src="/static/img/faq-how-it-works1.gif"></a>
                        <span>A. Get a deal everyday!</span>
                    </p>
                    <p>
                        <a href="/learn"><img src="/static/img/faq-how-it-works2.gif"></a>
                        <span>B. You can get the deal only if there are enough people sign up, refer your friends...</span>
                    </p>
                    <p>
                        <a href="/learn"><img src="/static/img/faq-how-it-works3.gif"></a>
                        <span>C. Come back tomorrow, will be suprised!</span>
                    </p>
                </div>
            </div>
            <div class="sbox-bottom"></div>
        </div>
    </div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<?php include template("footer");?>
