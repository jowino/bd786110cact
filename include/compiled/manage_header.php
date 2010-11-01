<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="<?php echo $INI['sn']['sn']; ?>">
<head>
	<meta http-equiv=content-type content="text/html; charset=UTF-8">
<?php if(!$pagetitle||$request_uri=='index'){?>
	<title><?php echo $INI['system']['sitename']; ?> - Buy Deals Everyday|<?php echo $city['name']; ?>|Shopping|Voucher|Discount</title>
<?php } else { ?>
	<title><?php echo $pagetitle; ?> | <?php echo $INI['system']['sitename']; ?> - Buy Deals Everyday |<?php echo $city['name']; ?> Shopping |<?php echo $city['name']; ?> Voucher |<?php echo $city['name']; ?>Discount<?php echo $INI['system']['subtitle']; ?></title>
<?php }?>
	<meta name="description" content="Buy Deals Everyday|<?php echo $city['name']; ?> Shopping |<?php echo $city['name']; ?> Voucher |<?php echo $city['name']; ?>Discount" />
	<meta name="keywords" content="<?php echo $INI['system']['sitename']; ?>, <?php echo $city['name']; ?>, <?php echo $city['name']; ?><?php echo $INI['system']['sitename']; ?>, <?php echo $city['name']; ?> Shopping, <?php echo $city['name']; ?> Voucher, <?php echo $city['name']; ?>Discount, Voucher, Discount, Shopping, groupon, Collective Buying, Team buy, Group buy" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link href="<?php echo $INI['system']['wwwprefix']; ?>/feed.php" rel="alternate" title="Subscribe" type="application/rss+xml" />
	<link rel="shortcut icon" href="/static/icon/favicon.ico" />
<link rel="stylesheet" href="/static/styles/style.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/static/css/index.css" type="text/css" media="screen" charset="utf-8" />
	
	<script type="text/javascript">var WEB_ROOT = '<?php echo WEB_ROOT; ?>';</script>
	<script src="/static/js/index.js" type="text/javascript"></script>
</head>
<body class="<?php echo $request_uri=='index'?'bg-alt':'newbie'; ?>">
<div id="pagemasker"></div><div id="dialog"></div>
<div id="main-wrapper">

<script type="text/javascript" src="/static/js/xheditor/xheditor.js"></script>
<script type="text/javascript" src="/static/js/xheditor/jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/static/js/util.js"></script>

<div id="header">

    <div class="logo"><a href="/index.php" class="link" target="_blank"><img src="/static/images/logo.jpg" title="Moosavings" alt="Moosavings"/></a></div>
    </div>
    <div class="clr"></div>
        <div id="header-menu"><div id="hd">
    <ul class="nav cf"><?php echo current_backend('super'); ?></ul>
    </div></div>

<?php if($session_notice=Session::Get('notice',true)){?>
<div class="sysmsgw" id="sysmsg-success"><div class="sysmsg"><p><?php echo $session_notice; ?></p><span class="close">Close</span></div></div>
<?php }?>
<?php if($session_notice=Session::Get('error',true)){?>
<div class="sysmsgw" id="sysmsg-error"><div class="sysmsg"><p><?php echo $session_notice; ?></p><span class="close">Close</span></div></div>
<?php }?>
