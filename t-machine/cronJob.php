<?php
include("include.php");

$rssToTwitter = new RsstoTweeter($feedurl,$message,$twitter['username'],$twitter['password']);
$rssToTwitter->getNewest();

?>