<?php
//Tweet Machine 2.1
$twitter['username'] = 'someusername';
$twitter['password'] = 'somepassword';
$feedurl = "http://groupon.wroupon.com/feed.php";
$message = "Get a new deal '{title}'. {permalink}"; // Only {title} and {permalink} is allowed

require_once 'simplepie.inc';
include("tweetmachine.class.php");

?>