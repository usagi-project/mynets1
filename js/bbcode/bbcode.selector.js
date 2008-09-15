/*
 * Type    : JavaScript
 * Name    : Simple Selector
 * Author  : Naoya Shimada
 * Version : 0.2.1
 * Date    : 2008/06/08
 * License : http://www.php.net/license/3_01.txt PHP License 3.01
 * Note    : Designed for OpenPNE 2.8.
 */

/*@cc_on _d=document;eval('var document=_d');@*/

// SimpleSelector //
var SimpleSelector = {
	"window_id"  : "",
	"form"  : "",
	"tag" : "",
	"x" : 0,
	"y" : 0,
	"initial" : "",
	create : function(window,form,tag){
		this.window_id  = window;
		this.form = form;
		this.tag = tag;
	}
};
SimpleSelector.fontsize = {
	"xx-small"	:	[ false,	"最小",		"60%"	],
	"x-small"	:	[ false,	"小",		"75%"	],
	"small"		:	[ false,	"やや小",	"88.8%"	],
	"medium"	:	[ true,		"中(標準)",	"100%"	],
	"large"		:	[ false,	"やや大",	"120%"	],
	"x-large"	:	[ false,	"大",		"150%"	],
	"xx-large"	:	[ false,	"最大",		"200%"	]
};
SimpleSelector.fontsize_pt = {
	"7pt" :		[ false, "7pt" ],
	"9pt" :		[ false, "9pt" ],
	"10.5pt" :	[ false, "10.5pt" ],
	"12pt" :	[ true , "12pt(標準)" ],
	"15pt" :	[ false, "15pt" ],
	"18pt" :	[ false, "18pt" ],
	"24pt" :	[ false, "24pt" ],
	"36pt" :	[ false, "36pt" ]
};
SimpleSelector.marquee = {
	"left"		:	[ true,		"左へ(標準)" ],
	"right"		:	[ false,	"右へ" ],
	"up"		:	[ false,	"上へ" ],
	"down"		:	[ false,	"下へ" ],
	"alternate"	:	[ false,	"往復" ]
};
SimpleSelector.fontname = {
	"ＭＳ Ｐゴシック"		:	[ true,		"ＭＳ Ｐゴシック(標準)" ],
	"ＭＳ Ｐ明朝"			:	[ false,	"ＭＳ Ｐ明朝" ],
	"ＭＳ ゴシック"			:	[ false,	"ＭＳ ゴシック" ],
	"MS 明朝"				:	[ false,	"MS 明朝" ],
	"メイリオ"				:	[ false,	"メイリオ" ],
	"Osaka"					:	[ false,	"Osaka" ],
	"ダサ字"				:	[ false,	"ダサ字" ],
	"Arial"					:	[ false,	"Arial" ],
	"Comic Sans MS"			:	[ false,	"Comic Sans MS" ],
	"Courier New"			:	[ false,	"Courier New" ],
	"Times New Roman"		:	[ false,	"Times New Roman" ],
	"Verdana"				:	[ false,	"Verdana" ]
};
SimpleSelector.list_dcs = {
	"d"	:	[ true,		"●黒丸(標準)" ],
	"c"	:	[ false,	"○白丸" ],
	"s"	:	[ false,	"■四角" ]
};
SimpleSelector.list_num = {
	"1"	:	[ true,		"1,2,3, ...数字 (標準)" ],
	"i"	:	[ false,	"i,ii,  ...ローマ数字(小)" ],
	"I"	:	[ false,	"I,II,  ...ローマ数字(大)" ],
	"a"	:	[ false,	"a,b,c, ...英字(小)" ],
	"A"	:	[ false,	"A,B,C, ...英字(大)" ]
};
SimpleSelector.drawFontOptions = function(){
	var data = this.fontsize;
	for (var i in data){
		if(data[i][0]){
			document.write('<option value="'+i+'" class="bb-font-size-options" selected="selected">'+data[i][1]+'</option>');
		}else{
			document.write('<option value="'+i+'" class="bb-font-size-options">'+data[i][1]+'</option>');
		}
	}
}
SimpleSelector.drawFontSizeTable = function(form,tag){
	this.form = form
	this.tag = tag;
	var data = this.fontsize;
	var ret = '<div id="simple-fontsize-table">';
	for (var i in data){
		ret += '<div id="'+i+'" onmousedown="SimpleSelector.callback(\''+i+'\')" title="'+i+'" class="simple-size-cell" onmouseover="this.className=\'simple-size-cell-over\';" onmouseout="this.className=\'simple-size-cell\';" style="font-size:'+data[i][2]+';">'+data[i][1]+'</div>';
	}
	ret += "</div>";
	return ret;
}
SimpleSelector.drawFontNameOptions = function(){
	var data = this.fontname;
	for (var i in data){
		if(data[i][0]){
			document.write('<option value="'+i+'" class="bb-font-name-options" selected="selected">'+data[i][1]+'</option>');
		}else{
			document.write('<option value="'+i+'" class="bb-font-name-options">'+data[i][1]+'</option>');
		}
	}
}
SimpleSelector.drawFontNameTable = function(form,tag){
	this.form = form
	this.tag = tag;
	var data = this.fontname;
	var ret = '<div id="simple-fontname-table">';
	for (var i in data){
		ret += '<div id="'+i+'" onmousedown="SimpleSelector.callback(\''+i+'\')" title="'+i+'" class="simple-font-cell" onmouseover="this.className=\'simple-font-cell-over\';" onmouseout="this.className=\'simple-font-cell\';" style="font-family:'+"'"+i+"'"+';">'+data[i][1]+'</div>';
	}
	ret += "</div>";
	return ret;
}
SimpleSelector.drawMarqueeOptions = function(){
	var data = this.marquee;
	for (var i in data){
		if(data[i][0]){
			document.write('<option value="'+i+'" class="bb-font-size-options" selected="selected">'+data[i][1]+'</option>');
		}else{
			document.write('<option value="'+i+'" class="bb-font-size-options">'+data[i][1]+'</option>');
		}
	}
}
SimpleSelector.drawMarqueeTable = function(form,tag){
	this.form = form
	this.tag = tag;
	var data = this.marquee;
	var ret = '<div id="simple-marquee-table">';
	for (var i in data){
		ret += '<div id="'+i+'" onmousedown="SimpleSelector.callback(\''+i+'\')" title="'+i+'" class="simple-marquee-cell" onmouseover="this.className=\'simple-marquee-cell-over\';" onmouseout="this.className=\'simple-marquee-cell\';">'+data[i][1]+'</div>';
	}
	ret += "</div>";
	return ret;
}
SimpleSelector.init = function(form,tag,def){
	this.form = form;
	this.tag  = tag;
	this.initial = def;
}
SimpleSelector.setXY = function(x,y){
	var wpallet = document.getElementById(this.window_id);
	wpallet.style.left = x + "px";
	wpallet.style.top  = y + "px";
}
SimpleSelector.noWidthHeight = function(){
	var wpallet = document.getElementById(this.window_id);
	wpallet.style.width  = "";
	wpallet.style.height = "";
}
SimpleSelector.openSelector = function(){
	var wpallet = document.getElementById(this.window_id);
	wpallet.style.display = "block";
	wpallet.style.visibility = "visible";
}
SimpleSelector.closeSelector = function(doFocus){
	var wpallet = document.getElementById(this.window_id);
	wpallet.style.display = "none";
	wpallet.style.visibility = "hidden";
	if(!!doFocus==null){
		var Obj = this.getTextareaObject(this.form);
		Obj.focus();
	}
}
SimpleSelector.drawSelector = function(form,tag){
	var wpallet = document.getElementById(this.window_id);
	if(tag=='size'){
		wpallet.innerHTML = this.drawFontSizeTable(form,tag);
	}
	else if(tag=='font'){
		wpallet.innerHTML = this.drawFontNameTable(form,tag);
	}
	else if(tag=='marquee'){
		wpallet.innerHTML = this.drawMarqueeTable(form,tag);
	}
}
SimpleSelector.callback = function(ins){
	if(this.isWindowOpen()){
		this.closeSelector(false);
	}
	insertBBCode(this.form,this.tag,ins);
}
SimpleSelector.isWindowOpen = function(){
	var wpallet = document.getElementById(this.window_id);
	return (wpallet.style.visibility == "visible");
}
SimpleSelector.getTextareaObject = function(formObj){
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

// Copyright (c) 2007-2008 Naoya Shimada
