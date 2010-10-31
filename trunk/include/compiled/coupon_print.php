<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">	
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head> 
<body onclick="window.print();"> 
		<?php if(is_array($coupons)){foreach($coupons AS $index=>$one) { ?>
		<div style="border-bottom:#000000 1px solid;border-left:#000000 1px solid;padding-bottom:10px;margin:0px auto;padding-left:10px;width:600px;padding-right:10px;font-size:14px;border-top:#000000 1px solid;border-right:#000000 1px solid;padding-top:10px;">
		<table class="dataEdit" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
					<td width="57%"><img border="0" alt="" src="/static/images/logo.jpg" /></td> 
					<td style="font-family:verdana;font-size:22px;font-weight:bolder;" width="43%"><?php echo $one['id']; ?><br><?php echo $one['secret']; ?></br></td> 
				</tr> 
				<tr><td height="8" colspan="2"><br /> 
				</td> 
				</tr> 
				<tr><td bgcolor="#000000" height="1" colspan="2"></td> 
				</tr> 
				<tr><td height="8" colspan="2"><br /> 
				</td> 
				</tr> 
				<tr><td style="padding-bottom:5px;padding-left:5px;padding-right:5px;font-family:Arial;height:50px;font-size:28px;font-weight:bolder;padding-top:5px;" colspan="2">
					<?php echo $one['title']; ?></td> 
				</tr> 
				<tr><td colspan="2">&nbsp;</td> 
				</tr> 
				<tr><td style="line-height:22px;padding-right:20px;" width="400">User:
				<?php echo $one['username']; ?><br /> 
				Expire time:<?php echo date('Y-m-d', $one['expire_time']); ?><br /> 
				Company：<?php echo $one['contact']; ?><br /> 
				Location:<?php echo $one['location']; ?>
				</td> 
				<td><div style="width:255px;height:255px;" id="map_canvas"></div> 
				<br /> 
				</td> 
				</tr> 
				<tr><td style="line-height:22px;"><br /> 
				</td> 
				<td align="middle">
				</td> 
				</tr> 
		</tbody> 
	</table> 
</div> 
	<?php }}?>
	
</body> 
</html>