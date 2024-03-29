var WEB_ROOT = WEB_ROOT || '';
window.x_init_hook_validator = function() {
	 jQuery('form.validator').checkForm();
};
window.x_init_hook_click = function() {
	jQuery("div:not(#guides-city-change)").click(function(){
		jQuery('#guides-city-list').css('display', 'none');
	});
	jQuery('#guides-city-change').click(function(){
		return !jQuery('#guides-city-list').toggle();
	});
	jQuery('#sysmsg-guide-close').click(function(){
		jQuery('#sysmsg-guide').remove();
		return !X.get( WEB_ROOT + '/ajax/newbie.php');
	});
	jQuery('#sysmsg-error span.close').click(function(){
		return !jQuery('#sysmsg-error').remove();
	});
	jQuery('#sysmsg-success span.close').click(function(){
		return !jQuery('#sysmsg-success').remove();
	});
	jQuery('#deal-share-im').click(function(){
		return !jQuery('#deal-share-im-c').toggle();
	});
	jQuery('a.ajaxlink').click(function() {
		if (jQuery(this).attr('no') == 'yes')
			return false;
		var link = jQuery(this).attr('href');
		var ask = jQuery(this).attr('ask');
		if (link.indexOf('/delete')>0 &&!confirm('Sure to delete this item?')) { 
			return false;
		} else if (ask && !confirm(ask)) {
			return false;
		}
		X.get(jQuery(this).attr('href'));
		return false;
    });
	jQuery('a.remove').click(function(){
		var u = jQuery(this).attr('href');
		if (confirm('Sure to delete this item?')){X.get(u);}
		return false;
	});
	jQuery('.remove-record').click(function(){
		return confirm('Sure to delete this item?');
	});
	jQuery('a.delay').click(function(){
		var u = jQuery(this).attr('href');
		if (confirm('Sure to postpond this deal for 1 day?')) {
			return !X.get(u) && false;
		}
		return false;
	});
	jQuery('#consult-add-form input[name="commit"]').click(function(){
		jQuery('#consult-add-form').ajaxSubmit({
			'success' : function() { X.team.consultation_again(); }
		});
		return false;
	});
	jQuery('#consult-add-more').click(X.team.consultation_again);
	jQuery('#express-zone-div input').click(function(){
		var v = jQuery(this).attr('value');
		if ( v == 'express' ) {
			jQuery('#express-zone-express').css('display', 'block');
			jQuery('#express-zone-pickup').css('display', 'none');
			jQuery('#express-zone-coupon').css('display', 'none');
		} else if ( v == 'pickup' ) {
			jQuery('#express-zone-pickup').css('display', 'block');
			jQuery('#express-zone-express').css('display', 'none');
			jQuery('#express-zone-coupon').css('display', 'none');
		} else if (v == 'coupon') {
			jQuery('#express-zone-coupon').css('display', 'block');
			jQuery('#express-zone-pickup').css('display', 'none');
			jQuery('#express-zone-express').css('display', 'none');
		}
	});
	jQuery('#mail-zone-div input').click(function(){
		var v = jQuery(this).attr('value');
		if ( v == 'smtp' ) {
			jQuery('#mail-zone-smtp').css('display', 'block');
		} else {
			jQuery('#mail-zone-smtp').css('display', 'none');
		}
	});
	jQuery('#share-copy-text').click(function(){jQuery(this).select();});
	jQuery('#verify-coupon-id').click(function(){
		X.get( WEB_ROOT + '/ajax/coupon.php?action=dialog');
	});
	jQuery('#deal-subscribe-form').submit(function(){
		var v =jQuery('#deal-subscribe-form-email').attr('value');
		return /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(v);
	});
	jQuery('input[xtip$="."]').each(X.misc.inputblur);
	jQuery('input[xtip$="."]').focus(X.misc.inputclick);
	jQuery('input[xtip$="."]').blur(X.misc.inputblur);
};

window.x_init_hook_imagerotate = function() {
	var imgListCurr = 0;
	var imgListCount = jQuery('#img_list a').size();
	if(imgListCount < 2) return;
	var imagesRun = function() { var imgListNext = imgListCurr + 1; if (imgListCurr == imgListCount - 1) imgListNext = 0; imagesPlay(imgListNext); imgListCurr++; if (imgListCurr > imgListCount - 1) { imgListCurr = 0; imgListNext = imgListCurr + 1; } };
	jQuery('#team_images').everyTime(3000, 'imagerotate', imagesRun);
	jQuery('#team_images li,#img_list a').hover(function(){ jQuery('#team_images').stopTime('imagerotate'); },function(){ jQuery('#team_images').everyTime(3000, 'imagerotate', imagesRun); }); 
	jQuery('#img_list a').click(function(){ var index = jQuery('#img_list a').index(this); if (imgListCurr != index){ imagesPlay(index); imgListCurr = index; }; return false; });
	var imagesPlay = function(next) { jQuery('#team_images li').eq(imgListCurr).css({'opacity':'0.5'}).animate({'left':'-440px','opacity':'1'},'slow',function(){ jQuery(this).css({'left':'440px' }); }).end().eq(next).animate({'left':'0px','opacity':'1'},'slow',function(){ jQuery('#img_list a').siblings('a').removeClass('active').end().eq(next).addClass('active'); }); };
};

window.x_init_hook_clock = function() {
	var a = parseInt(jQuery('div.deal-timeleft').attr('diff'));
	var b = (new Date()).getTime();	
	var e = function() {
		var c = (new Date()).getTime();
		var ls = a + b - c;
		if ( ls > 0 ) {
			var lh = parseInt(ls/3600000) ; ls = ls % 3600000;
			var lm = parseInt(ls/60000) ; ls = parseInt(Math.round(ls%60000)/1000);
			var html = '<li><span>'+lh+'</span>hours</li><li><span>'+lm+'</span>minutes</li><li><span>'+ls+'</span>seconds</li>';
			jQuery('ul#counter').html(html);
		} else {
			jQuery("ul#counter").stopTime('counter');
			jQuery('ul#counter').html('end');
		}
	};
	jQuery("ul#counter").everyTime(996, 'counter', e);
};

window.x_init_hook_team = function() {
	jQuery('#deal-buy-quantity-input').bind("keyup", function(){
		var n = parseInt(jQuery(this).attr('value'),10);
		var per = parseInt(jQuery('#deal-per-number').attr('value'),10);
		if (n>per && per>0) { n = per; }
		n = isNaN(n) ? '' : n; jQuery(this).attr('value', n);
		var p = parseInt(jQuery('#deal-buy-price').html(),10);
		p = isNaN(p) ? 0 : p; n = isNaN(n) ? 0 : n; var t = n * p;
		jQuery('#deal-buy-total').html(t);
		X.team.dealbuy_totalprice();
	});
};

window.x_init_hook_order = function() {
	jQuery('form[id="order-pay-form"]').bind('submit', function() {
		X.get( WEB_ROOT + '/ajax/order.php?action=dialog&id=' + jQuery(this).attr('sid'));
	});
};
/*
window.x_init_hook_editor = function() { jQuery('textarea.editor').xheditor({upLinkUrl:"upload.php",upLinkExt:"zip,rar,txt",upImgUrl:"upload.php",upImgExt:"jpg,jpeg,gif,png",upFlashUrl:"upload.php",upFlashExt:"swf",upMediaUrl:"upload.php",upMediaExt:"wmv,avi,wma,mp3,mid",shortcuts:{'ctrl+enter':submitForm}}); }; */

/* X.misc Zone */
X.misc = {};
X.misc.copyToCB = function(maintext) {
   if (window.clipboardData) {
      return (window.clipboardData.setData("Text", maintext));
   }
   else if (window.netscape) {
      netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
      var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
      if (!clip) return;
      var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
      if (!trans) return;
      trans.addDataFlavor('text/unicode');
      var str = new Object();
      var len = new Object();
      var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
      var copytext=maintext;
      str.data=copytext;
      trans.setTransferData("text/unicode",str,copytext.length*2);
      var clipid=Components.interfaces.nsIClipboard;
      if (!clip) return false;
      clip.setData(trans,null,clipid.kGlobalClipboard);
      return true;
   }
   return false;
};
X.misc.inputblur = function() {
	var v =jQuery(this).attr('value');
	var t =jQuery(this).attr('xtip');
	if( v == t || !v ) {
		jQuery(this).attr('value', t);
		jQuery(this).css('color', '#999');
	}
};
X.misc.inputclick = function() {
	var v =jQuery(this).attr('value');
	var t =jQuery(this).attr('xtip');
	if( v == t ) {
		jQuery(this).attr('value', '');
	}
	jQuery(this).css('color', '#333');
};
X.misc.noticenext = function(tid, nid) {
	jQuery('#dialog_subscribe_count_id').html(nid);
	return X.get('/ajax/manage.php?action=noticesubscribe&id='+tid+'&nid='+nid);
};

/* X.team Zone */
X.team = {};
X.team.consultation_again = function() {
	jQuery('#consult-content').val('');
	jQuery('#consult-add-form').toggle();
	jQuery('#consult-add-succ').toggle();
};
X.team.dealbuy_totalprice = function() {
		var n = parseFloat(jQuery('#deal-buy-total').html(),10);
		n = isNaN(n) ? 0 : n;
		var p = parseFloat(jQuery('#deal-express-total').html(),10);
		p = isNaN(p) ? 0 : p;
		var t = n + p;
		jQuery('#deal-buy-total-t').html(t);
};

/* X.coupon */
X.coupon = {};
X.coupon.dialogquery = function() {
	var id = jQuery('#coupon-dialog-input-id').attr('value');
	if (id) return !X.get(WEB_ROOT + '/ajax/coupon.php?action=query&id='+encodeURIComponent(id));
};
X.coupon.dialogconsume = function() {
	var id = jQuery('#coupon-dialog-input-id').attr('value');
	var secret = jQuery('#coupon-dialog-input-secret').attr('value');
	if (id && secret) { 
		var ask = jQuery('#coupon-dialog-consume').attr('ask');
		return confirm(ask) && !X.get(WEB_ROOT + '/ajax/coupon.php?action=consume&id='+encodeURIComponent(id)+'&secret='+encodeURIComponent(secret)); 
	}
};
X.coupon.dialoginputkeyup = function(o) {jQuery(o).attr('value', jQuery(o).attr('value').toUpperCase())};

/* X.manage */
X.manage = {};
X.manage.loadtemplate = function(id) {
	window.location.href = WEB_ROOT + '/manage/system/template.php?id='+id;
};
X.manage.loadpage = function(id) {
	window.location.href = WEB_ROOT + '/manage/system/page.php?id='+id;
};
X.manage.usermoney = function() {
	var money = parseInt(jQuery('#user-dialog-input-id').attr('value'));
	var uid = jQuery('#user-dialog-input-id').attr('uid');
	var ask = jQuery('#user-dialog-input-id').attr('ask');
	if (uid&&money&&(!ask||confirm(ask))) return !X.get(WEB_ROOT + '/ajax/manage.php?action=usermoney&id='+uid+'&money='+encodeURIComponent(money));
};
