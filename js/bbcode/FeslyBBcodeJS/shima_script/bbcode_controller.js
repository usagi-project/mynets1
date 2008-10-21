/*
 * Type     : JavaScript
 * Name     : BBCode Input Support Controller
 * Author   : Naoya Shimada
 * Version  : 0.4.1
 * Date     : 2007/12/26
 * License  : http://www.php.net/license/3_01.txt PHP License 3.01
 * Note     : Designed for OpenPNE 2.8.
 */

/*@cc_on _d=document;eval('var document=_d');@*/

// BBCode$BF~NO;Y1gMQDj?t(B
function BBCodeConst(navigator){
	// $B%V%i%&%6H=Dj(B
	this.ua		= navigator.userAgent.toLowerCase();
	this.naviver= parseInt(navigator.appVersion);
	this.is		= function(t){ return this.ua.indexOf(t) != -1; };
	this.is_win	= (this.is('win')||this.is("16bit"));
	this.is_mac	= this.is('mac');
	this.is_lnx	= (this.is('X11')||this.is('linux'));
	this.is_ie	= (this.is('msie')||this.is('opera'));
	this.is_ope	= this.is('opera');
	this.is_nav	= (this.is('mozilla') && !this.is('spoofer') && !this.is('compatible') && !this.is('opera') && !this.is('webtv') && !this.is('hotjava'));
	this.is_moz	= (this.is('gecko/')||this.is('mozilla/'));
	this.is_saf	= (this.is('applewebkit/'));
	// $BFH<+%?%0$r;HMQ$9$k$+H]$+(B
	this.pnetag_mode = false;
	// textarea.onfocus$B$N@_Dj>uBV(B
	this.is_set_onfocus_color = false;
	this.is_set_onfocus_select = false;
};
var BBCode = new BBCodeConst(navigator);

//$B%F%-%9%H%(%j%"<hF@(B
function bbgetbodyobj(formObj) {
	if (typeof(formObj.body) != 'undefined' && formObj.body != null) {
		return formObj.body;
	}
	else if (typeof(formObj.info) != 'undefined' && formObj.info != null) {
		return formObj.info;
	}
	else if (typeof(formObj.detail) != 'undefined' && formObj.detail != null) {
		return formObj.detail;
	}
	else {
		return null;
	}
}

//$B%?%0A^F~(B
var default_convert=function(v){return v;}
function insertBBCode(formObj, bbtag, value) {
	var txtarea = bbgetbodyobj(formObj);
	if (txtarea == null){ return false; }

	if(typeof(BBCodeTags[bbtag])=='undefined'||typeof(BBCodeTags[bbtag].tag)=='undefined'){
		txtarea.focus();
		return false;
	}
	
	var bbt = BBCodeTags[bbtag];

	txtarea.focus();
	var theselection = null;
	if (BBCode.is_win && BBCode.is_ie && BBCode.naviver >= 4) {
		var range = document.selection.createRange();
		theselection = range.text;
		if (typeof(theselection)!='undefined'&&theselection!=null&&theselection.length>0) {
			var ins = "";
			if(bbt.prompt_with_select){
				// In this pattern, 'value' is disregarded.
				var check = bbt.prompt_options.checker;
				var parse = bbt.parse_value;
				var i_val = ( BBCode.is_ie && !BBCode.is_ope && check(parse(clipboardData.getData("Text"))) ) ? parse(clipboardData.getData("Text")) : bbt.prompt_options.init;
				var ret   = parse(prompt(bbt.prompt_options.text,i_val));
				var convert_value  = bbt.prompt_options.convert_value;
				var convert_return = bbt.prompt_options.convert_return;
				if(ret!=null&&check(ret)){
					// [list]$B$N>l9g$@$1FC<l(B
					if(bbt.tag=='list'){
						bbinsert(txtarea,bbt,bbt.open_tag(convert_return(ret,false))+convert_value(value),bbt.close_tag(),theselection);
					}else{
						bbinsert(txtarea,bbt,bbt.open_tag(convert_return(ret,false)),bbt.close_tag(),convert_value(theselection));
					}
				}else{
					txtarea.focus();
					return false;
				}
			}else{
				bbinsert(txtarea,bbt,bbt.open_tag(value),bbt.close_tag(),theselection);
			}
			txtarea.focus();
			return false;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		var wtag = bbt.open_tag(value);
		var convert_value  = default_convert;
		var convert_return = default_convert;
		if(bbt.prompt_with_select){
			var parse = bbt.parse_value;
			var ret = parse(prompt(bbt.prompt_options.text,bbt.prompt_options.init));
			var check = bbt.prompt_options.checker;
			convert_value  = bbt.prompt_options.convert_value;
			convert_return = bbt.prompt_options.convert_return;
			if(ret!=null&&check(ret)){
				wtag = bbt.open_tag(convert_return(ret,false));
			}
		}
		mozWrap(txtarea, bbt, wtag, bbt.close_tag(), '', convert_value);
		txtarea.focus();
		return false;
	}

	//$BA*BrHO0O$J$7(B
	if(bbt.need_prompt){
		var check = bbt.prompt_options.checker;
		var parse = bbt.parse_value;
		var i_val = ( BBCode.is_ie && !BBCode.is_ope && check(parse(clipboardData.getData("Text"))) ) ? parse(clipboardData.getData("Text")) : bbt.prompt_options.init;
		var ret   = parse(prompt(bbt.prompt_options.text,i_val));
		convert_value  = bbt.prompt_options.convert_value;
		convert_return = bbt.prompt_options.convert_return;
		if(ret!=null&&check(ret)){
			// [list]$B$N>l9g$@$1FC<l(B
			if(bbt.tag=='list'){
				bbinsert(txtarea,bbt,bbt.open_tag(convert_return(ret,true))+convert_value(value),bbt.close_tag(),'');
			}else{
				bbinsert(txtarea,bbt,bbt.open_tag(value,ret),bbt.close_tag(value,ret),convert_return(ret,true));
			}
		}
	}
	else {
		bbinsert(txtarea,bbt,bbt.open_tag(value),bbt.close_tag(),'');
	}
	txtarea.focus();
	return false;
}

//$B%?%0A^F~(B
function bbinsert(txtarea,bbt,bbopen,bbclose,value){
	if (BBCode.is_win && BBCode.is_ie && BBCode.naviver >= 4 ){
		var range = document.selection.createRange();
		var theselection = range.text;
		var sel_len = theselection.length;
		var sel_nl  = theselection.match(/\r\n|\r|\n/g);
		var sel_nl_len = (sel_nl!=null)?sel_nl.length:0;
		//if (sel_nl!=null) { sel_len -= sel_nl.length; }
		range.text = bbopen + value + bbclose;
		range.moveStart("character",-(value+bbclose).length+sel_nl_len);
		range.moveEnd("character",-bbclose.length);
		range.select();
	}
	else if (typeof(txtarea.selectionEnd)!='undefined')
	{
		mozWrap(txtarea,bbt,bbopen,bbclose,value,default_convert);
	}
	else {
		txtarea.value += bbopen + value + bbclose;
	}
	txtarea.focus();
	return;
}

// Based on http://www.massless.org/mozedit/
function mozWrap(txtarea, bbt, lft, rgt, val, conv)
{
	var top = txtarea.scrollTop;
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = conv((txtarea.value).substring(selStart, selEnd));
	var s3 = (txtarea.value).substring(selEnd, selLength);
	txtarea.value = s1 + lft + val + s2 + rgt + s3;
	txtarea.scrollTop = top;
	txtarea.selectionStart = (s1 + lft).length;
	txtarea.selectionEnd   = (s1 + lft + val + s2).length;
	return;
}

// anything from here offsetLeft,offsetTop,offsetWidth$B$=$7$F(BoffsetHeight$B(!(!@EE*G[CVMWAG$N@dBP0LCV$r3N<B$K<hF@$9$kJ}K!$K$D$$$F(B
// http://hkom.blog1.fc2.com/blog-entry-503.html
//$BMWAG$N%9%?%$%kB0@-$r<hF@$9$k4X?t(B
function getElementStyle(targetElm,IEStyleProp,CSSStyleProp) {
	var elem = targetElm;
	if (elem.currentStyle) {
		return elem.currentStyle[IEStyleProp];
	} else if (window.getComputedStyle) {
		var compStyle = window.getComputedStyle(elem,"");
		return compStyle.getPropertyValue(CSSStyleProp);
	}
}
function getPosition(that) {
	var targetEle = that;			//that$B$O0LCV$r<hF@$7$?$$MWAG(BObject
	var pos = new function(){ this.x = 0; this.y = 0; }
	while( targetEle ){
		pos.x += targetEle.offsetLeft; 
		pos.y += targetEle.offsetTop; 
		targetEle = targetEle.offsetParent;
		//IE$B$NJd@5!'>e5-7W;;$GL5;k$5$l$F$7$^$&3F?FMWAG$N(Bborder$BI}$r2C;;(B
		if ((targetEle) && (BBCode.is_ie)) {
			pos.x += (parseInt(getElementStyle(targetEle,"borderLeftWidth","border-left-width")) || 0);
			pos.y += (parseInt(getElementStyle(targetEle,"borderTopWidth","border-top-width")) || 0);
		}
	}
	//gecko$B$NJd@5!'%+%&%s%H$7$J$$(Bbody$BIt(Bborder$BI}$r%^%$%J%9$7$F$7$^$&$N$G#2G\$7$F2C;;(B
	if (BBCode.is_moz) {
			//$B0J2<$NItJ,$G(Bbody$BIt$r<hF@$7!"(Bborder$B$N8:;;$rJd@5$9$k!#(B
		var bd = document.getElementsByTagName("BODY")[0];		//body$BIt$r<hF@(B
		pos.x += 2*(parseInt(getElementStyle(bd,"borderLeftWidth","border-left-width")) || 0);
		pos.y += 2*(parseInt(getElementStyle(bd,"borderTopWidth","border-top-width")) || 0);
	}
	return pos;
}

// Copyright (c) 2007 Naoya Shimada
