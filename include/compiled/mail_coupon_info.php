<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<meta name="robots" content="noindex, nofollow">
</head>
<body bgcolor="#ffffff" style='padding:10px; width:720px; margin:auto;'>
<style type='text/css'>
body {font-family:Helvetica, Arial, sans-serif; color:#000;}
a { color: #399; text-decoration:none;}
a:hover { color: #399; text-decoration:none; }
p { line-height: 1.5em; }
</style>


<!-- content -->
<div style='width:670px; margin:5px 0; padding: 20px 20px 20px 20px; background-color:#a3dcef;background-image: url(<?php echo $INI['system']['wwwprefix']; ?>/static/css/i/bg-deal.jpg);background-repeat: no-repeat;background-position: center top; border-width:5px; border-style: solid; border-color:#deedcc;-moz-border-radius:10px;-webkit-border-radius:10px;'>

<table cellpadding='0' cellspacing='0' style='background-color:#fff; -moz-border-radius-topright:8px; -moz-border-radius-topleft:8px; -webkit-border-top-right-radius:8px; -webkit-border-top-left-radius:8px;' width='100%'>
<!--Content header-->
<tr>
    <td colspan='2'>
        <div id='mail-header' style='height:104px; margin: 0; -moz-border-radius-topright:8px; -moz-border-radius-topleft:8px; -webkit-border-top-right-radius:8px; -webkit-border-top-left-radius:8px; border-bottom:4px solid #338888;'>
            <table bgcolor='#2d2d2d' cellpadding='0' cellspacing='0' height='104px' width='670px'>
                <tr>
                    <td width="110" style='height:37px; padding:25px 0 0 20px;' valign='top'><a href="<?php echo $INI['system']['wwwprefix']; ?>/index.php" title="<?php echo $INI['system']['sitename']; ?>"><img alt="<?php echo $INI['system']['sitename']; ?>" src="<?php echo $INI['system']['wwwprefix']; ?>/static/img/mail-tpl-logo.gif" style="border: 0px; margin: 0px;" /></a></td>
                    <td>Coupon information </td>
                    <td width="220" align='right' style='padding-right:20px; padding-top:43px;' valign='top'>
                        <table cellpadding='0' cellspacing='0' width='225px;'>
                            <tr>
                                <td align='right' style='margin:0; color:#fff; font-size:12px; font-family: Helvetica, Arial, sans-serif;;'><?php echo $today; ?></td> </tr>
                            <tr>
                                <td align='right' style='padding-top:15px;'></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </td>
</tr>
<!--Content header end-->
<!--Content content-->
<tr>
<td style='padding:20px 0 25px 0; border-top:10px solid #44ABAF;' valign='top'>
<table cellpadding='0' cellspacing='0' width='100%'>
    <!-- TR 1 -->
    <tr>
        <td colspan='2' style="padding: 0 20px 20px 20px;">
            <h1 style='margin:0; padding:0; line-height:1.2; '>
            Coupon: <?php echo $coupon['id']; ?>-----<?php echo $coupon['secret']; ?>
            </h1>
        </td>
    </tr>
    <!-- TR 2 -->
    <tr>
        <td style='padding:0 15px 0 4px; width:233px;' valign='top'>
            <table background='<?php echo $INI['system']['wwwprefix']; ?>/static/img/mail-tpl-tag.gif' bgcolor='#4BC1DD' cellpadding='0' cellspacing='0' height='60px' width='233px'>
                <tr>
                    <td style='padding-left:35px; font-size:28px; color:#fff; font-weight:700; font-family: Helvetica, Arial, sans-serif;;'>order total: $<?php echo $order['origin']; ?></td>
                </tr>
            </table>
                        <div style='padding-left:17px;'>
                <table cellpadding='0' cellspacing='0' width='216px'>
                    <tr style='background-color:#d0eef6;'>
                        <td width='72' align='center' style='margin:0; padding:0; font-size:14px; color:#000; font-family: Helvetica, Arial, sans-serif;border-left:1px solid #4bc1dd; font-size:12px; padding:10px 0 5px 0;'>Value</td>
                        <td width='72' align='center' style='margin:0; padding:0; font-size:14px; color:#000; font-family: Helvetica, Arial, sans-serif;font-size:12px; padding:10px 0 5px 0;'>Discount</td> 
                        <td width='72' align='center' style='margin:0; padding:0; font-size:14px; color:#000; font-family: Helvetica, Arial, sans-serif;border-right:1px solid #4bc1dd; font-size:12px; padding:10px 0 5px 0;'>You save</td> </tr>
                    <tr style='background-color:#d0eef6;'>
                        <td width='72' align='center' style='border-left:1px solid #4bc1dd; border-bottom:1px solid #4bc1dd; font-size:14px; font-weight:700; color:#000; font-family: Helvetica, Arial, sans-serif;; margin:0; padding:0 0 5px 0;'>$<?php echo $team['market_price']; ?></td>
                        <td width='72' align='center' style='border-bottom:1px solid #4bc1dd; font-size:14px; font-weight:700; color:#000; font-family:Helvetica, Arial, sans-serif;; margin:0; padding:0 0 5px 0;'><?php echo moneyit(100*($team['market_price']-$team['team_price'])/$team['market_price']); ?>% off</td>
                        <td width='72' align='center' style='border-right:1px solid #4bc1dd; border-bottom:1px solid #4bc1dd; font-size:14px; font-weight:700; color:#000; font-family: Helvetica, Arial, sans-serif;; margin:0; padding:0 0 5px 0;'>$<?php echo $team['market_price']-$team['team_price']; ?></td>
                    </tr>
                </table>
            </div>
                                    <div style='padding:8px 0 0 17px;'>
                <table cellpadding='0' cellspacing='0' width='216px'>
                    <tr>
                        <td style='border:1px solid #e8e8e8; width:217px; height:116px; padding:0 5px 10px 15px;'>
                            <table cellpadding='0' cellspacing='0'>
                                <tr><td style='margin:0; padding:0; font-size:14px; color:#000; font-family: Helvetica, Arial, sans-serif;padding:10px 0 7px 0; font-size:16px; font-weight:bold; '><?php echo $partner['title']; ?></td></tr>
                                <tr>
                                    <td style='margin:0; padding:0; font-size:14px; color:#000; font-family: Helvetica, Arial, sans-serif;vetical-align:top; font-size:12px; '>
                                        <div style="margin:0; padding:0; font-size:14px; color:#000; font-family: Helvetica, Arial, sans-serif;; font-size:12px; "><?php echo $partner['location']; ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='font-size:12px; color:#000; font-family: Helvetica, Arial, sans-serif;; margin:0; padding:0;'></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
                    </td>
        <td valign='top'>
            <a href="<?php echo $INI['system']['wwwprefix']; ?>/team.php?id=<?php echo $team['id']; ?>" title="<?php echo $team['title']; ?>"><img alt="<?php echo $team['title']; ?>" src="<?php echo team_image($team['image']); ?>" style="border:none;" title="<?php echo $team['title']; ?>" width="398" /></a>
        </td>
    </tr>
</table>
</td>
</tr>
<!--Content content end-->
</table>

<table style='background-color:#deedcc; margin-top:2px; -moz-border-radius-bottomleft:8px; -moz-border-radius-bottomright:8px; -webkit-border-bottom-left-radius:8px; -webkit-border-bottom-right-radius:8px;' width='100%'>
    <tr>
        <td style='font-family: Helvetica, Arial, sans-serif; color:#545454; font-size:12px; text-align:center; line-height:16px; padding:10px;'>Email: <a href="mailto:<?php echo $help_email; ?>" style="" title=""><?php echo $help_email; ?></a>&nbsp;&nbsp;&nbsp; Customer Contact: <?php echo $help_mobile; ?>&nbsp;&nbsp;<span style='font-weight:normal; font-size:12px;'>Monday to Saturday 9:00-18:00</span></td>
    </tr>
</table>

</div>

<table cellpadding='0' cellspacing='0' width='720px'>
    <tr>
        <td align='center'>
            <p style='font-size:12px; font-family: Helvetica, Arial, sans-serif; color:#929292; margin:3px; padding-bottom:5px;'>You get this email because you purchased a deal from <?php echo $INI['system']['sitename']; ?>.</p>
        </td>
    </tr>
</table>

</body>
</html>
