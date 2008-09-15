/*
 * Type    : JavaScript
 * Name    : BBCode Input Support Controller
 * Author  : Naoya Shimada
 * Version : 0.5.4
 * Date    : 2008/07/15
 * License : http://www.php.net/license/3_01.txt PHP License 3.01
 * Note    : Designed for OpenPNE 2.8.
 */

/*@cc_on _d=document;eval('var document=_d');@*/

// BBCode入力支援用定数
var BBCodeConst = function(navigator) {
	// ブラウザ判定
	this.ua		= navigator.userAgent.toLowerCase();
	this.major	= parseInt(navigator.appVersion);
	this.minor	= parseFloat(navigator.appVersion);
	this.is		= function(t){ return this.ua.indexOf(t) != -1; };
	this.is_win	= (this.is('win')||this.is('16bit'));
	this.is_mac	= this.is('mac');
	this.is_lnx	= (this.is('X11')||this.is('linux'));
	this.is_sun	= this.is('sunos');
	this.is_mie	= this.is('msie');
	this.is_ie	= (this.is('msie')||this.is('opera'));
	this.is_ope	= this.is('opera');
	this.is_nav	= (this.is('mozilla') && !this.is('spoofer') && !this.is('compatible') && !this.is('opera') && !this.is('webtv') && !this.is('hotjava'));
	this.is_moz	= (this.is('gecko/')||this.is('mozilla/'));
	this.is_saf	= (this.is('applewebkit/'));
	this.is_kon = (this.is('konqueror'));
	// 独自タグを使用するか否か
	this.pnetag_mode = false;
	// textarea.onfocusの設定状態
	this.is_set_onfocus_color = false;
	this.is_set_onfocus_select = false;
	this.getBrowser = function() {
		if (this.is_ope) {
			return 'opera';
		} else if (this.is_ie) {
			return 'ie';
		} else if (this.is_moz) {
			return 'mozilla';
		} else if (this.is_nav) {
			return 'navigator';
		} else if (this.is_saf) {
			return 'safari';
		} else {
			return 'other';
		}
	};
};
var BBCode = new BBCodeConst(navigator);

// ポップアップヘルプメッセージ
var bbcode_help_popup_msg = {
	'mod' : "BBCodeのタグが入れ子構造になる場合、タグの修飾が無効となったり、スタイルが崩れる場合があります。",
	'tag' : "タグを閉じ忘れた場合、正常に表示されなくなる場合があります。"
};

// ポップアップヘルプ
function bbcode_help_popup(tag) {
	var help = $('bbcode_help_popup');
	if ( help.style.visibility == "visible" ){
		help.style.visibility = "hidden";
	}else{
		var obj = $('bbcode_help_'+tag);
		var pos = getPosition(obj);
		var moveX = 10;
		var moveY = (tag == "mod") ? -56 : -40;
		help.style.left = pos.x + moveX + "px";
		help.style.top  = pos.y + moveY + "px";
		help.innerHTML = bbcode_help_popup_msg[tag];
		help.style.display="block";
		help.style.visibility = "visible";
	}
}

// ヘルプメッセージ
function helpBBCode(tag) {
	if (typeof(BBCodeTags[tag])!='undefined') {
		$('bbcode_helplines').innerHTML = BBCodeTags[tag].help;
	}
	else {
		$('bbcode_helplines').innerHTML = "Tag ["+tag+"] is not set.";
	}
	return;
}

// カラーピッカー
SimpleColorPicker.create("bbcode_color_picker","","");
Event.observe(window,'load',setSCPDraggable,false);
function setSCPDraggable(){
	//script.aculo.usでDrag&Drop
	if(typeof(Draggable)!='undefined'){
		var optDraggable = {
			handle:"bbcode_color_picker",
			revert: false,
			reverteffect: function() {},
			starteffect: function() {},
			endeffect: function() {}
		}
		new Draggable("bbcode_color_picker",optDraggable);
	}
}
function color_pallet_popup(formObj,tag,def) {
	if(typeof(SimpleSelector)!='undefined' && SimpleSelector.isWindowOpen() ){
		SimpleSelector.closeSelector(false);
	}
	if( SimpleColorPicker.isWindowOpen() ){
		SimpleColorPicker.closePallet(false);
	}
	var obj = $('bbcode_'+tag);
	var pos = getPosition(obj);
	var moveX = (BBCode.is_ope)?-5:((BBCode.is_ie)?-2: 0);
	var moveY = (BBCode.is_ope)?17:((BBCode.is_ie)?20:19);
	//カラー順序反転なし、セーフカラー色入替えあり
	SimpleColorPicker.init(formObj,tag,def,false,true);
	SimpleColorPicker.setXY(pos.x + moveX,pos.y + moveY);
	// [1] Webセーフカラー216色
	//SimpleColorPicker.drawSafePallet(formObj,tag);
	// [2] Webセーフカラー216色と12色のピックアップ
	//SimpleColorPicker.drawOrderSafePallet(formObj,tag);
	// [3] Webセーフカラー216色から絞った70色
	SimpleColorPicker.drawPallet(formObj,tag);
	//パレットを開く
	SimpleColorPicker.openPallet();
	if(!BBCode.is_set_onfocus_color){
		var txtarea = bbgetbodyobj(formObj);
		Event.observe(txtarea,'focus',closeColorPalletOnFocus,false);
		BBCode.is_set_onfocus_color = true;
	}
}
function closeColorPalletOnFocus(){
	if(SimpleColorPicker.isWindowOpen()){
		SimpleColorPicker.closePallet(false);
	}
}

// セレクタ
SimpleSelector.create("bbcode_size_selector","","");
function size_selector_pulldown(formObj,tag,def) {
	if(typeof(SimpleColorPicker)!='undefined' && SimpleColorPicker.isWindowOpen() ){
		SimpleColorPicker.closePallet(false);
	}
	var obj = $('bbcode_'+tag);
	var pos = getPosition(obj);
	if ( SimpleSelector.isWindowOpen() ){
		SimpleSelector.closeSelector(false);
	}
	var moveX = (BBCode.is_ope)?-5:((BBCode.is_ie)?-2: 0);
	var moveY = (BBCode.is_ope)?17:((BBCode.is_ie)?20:19);
	SimpleSelector.init(formObj,tag,def,false,true);
	SimpleSelector.setXY(pos.x + moveX,pos.y + moveY);
	SimpleSelector.noWidthHeight();
	SimpleSelector.drawSelector(formObj,tag);
	SimpleSelector.openSelector();
	if(!BBCode.is_set_onfocus_select){
		var txtarea = bbgetbodyobj(formObj);
		Event.observe(txtarea,'focus',closeSelectorOnFocus,false);
		BBCode.is_set_onfocus_select = true;
	}
}
function closeSelectorOnFocus(){
	if(SimpleSelector.isWindowOpen()){
		SimpleSelector.closeSelector(false);
	}
}

//テキストエリア取得
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

//テキストエリアを探す
function bbfindtextarea() {
    var e = null;
    var txtarea = document.getElementsByTagName("textarea");
    for (i=0;i<txtarea.length;i++) {
        if (txtarea.item(i).name.match(/^body|info|detail$/i)) {
            e = txtarea.item(i);
            break;
        }
    }
    return e;
}

//タグ挿入
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
	if (BBCode.is_win && BBCode.is_ie && BBCode.major >= 4) {
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
					// [list]の場合だけ特殊
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

	//選択範囲なし
	if(bbt.need_prompt){
		var check = bbt.prompt_options.checker;
		var parse = bbt.parse_value;
		var i_val = ( BBCode.is_ie && !BBCode.is_ope && check(parse(clipboardData.getData("Text"))) ) ? parse(clipboardData.getData("Text")) : bbt.prompt_options.init;
		var ret   = parse(prompt(bbt.prompt_options.text,i_val));
		convert_value  = bbt.prompt_options.convert_value;
		convert_return = bbt.prompt_options.convert_return;
		if(ret!=null&&check(ret)){
			// [list]の場合だけ特殊
			if(bbt.tag=='list'){
				bbinsert(txtarea,bbt,bbt.open_tag(convert_return(ret,true))+convert_value(value),bbt.close_tag(),'');
			}else{
				bbinsert(txtarea,bbt,bbt.open_tag(value,ret),bbt.close_tag(value,ret),convert_return(ret,true));
			}
		}
	}
	else {
		bbinsert(txtarea,bbt,bbt.open_tag(value),bbt.close_tag(),value);
	}
	txtarea.focus();
	return false;
}

//タグ挿入
function bbinsert(txtarea,bbt,bbopen,bbclose,value){
	if (BBCode.is_win && BBCode.is_ie && BBCode.major >= 4 ){
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

// anything from here offsetLeft,offsetTop,offsetWidthそしてoffsetHeight──静的配置要素の絶対位置を確実に取得する方法について
// http://hkom.blog1.fc2.com/blog-entry-503.html
//要素のスタイル属性を取得する関数
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
	var targetEle = that;			//thatは位置を取得したい要素Object
	var pos = new function(){ this.x = 0; this.y = 0; };
	while( targetEle ){
		pos.x += targetEle.offsetLeft; 
		pos.y += targetEle.offsetTop; 
		targetEle = targetEle.offsetParent;
		//IEの補正：上記計算で無視されてしまう各親要素のborder幅を加算
		if ((targetEle) && (BBCode.is_mie)) {
			pos.x += (parseInt(getElementStyle(targetEle,"borderLeftWidth","border-left-width")) || 0);
			pos.y += (parseInt(getElementStyle(targetEle,"borderTopWidth","border-top-width")) || 0);
		}
	}
	//geckoの補正：カウントしないbody部border幅をマイナスしてしまうので２倍して加算
	if (BBCode.is_moz) {
			//以下の部分でbody部を取得し、borderの減算を補正する。
		var bd = document.getElementsByTagName("BODY")[0];		//body部を取得
		pos.x += 2*(parseInt(getElementStyle(bd,"borderLeftWidth","border-left-width")) || 0);
		pos.y += 2*(parseInt(getElementStyle(bd,"borderTopWidth","border-top-width")) || 0);
	}
	return pos;
}

/** プレビュー機能 **/

//テキストエリアサイズ変更
function changeTextareaSize4preview() {
	var txtarea = bbfindtextarea();
	if (typeof(txtarea) != 'undefined' && !!txtarea) {
		var width  = 410;
		var height = 250;
		var body = document.getElementsByTagName('body')[0];
		if (!!body.id && typeof(body.id) != 'undefined') {
			if (body.id.match(/h_review_(add|edit)/i)) {
				width = 350;
			}
		}
		txtarea.style.width  = width  + "px";
		txtarea.style.height = height + "px";
		if (!BBCode.preview.wrap_off) {
			//自動改行しない設定がfalseの場合は抜ける
			return;
		}
		if (BBCode.is_mie) {
			//縦横スクロール可能にし、自動改行させない(IE)
			txtarea.setAttribute("wrap","off");
			txtarea.style.overflowY = "auto";
			txtarea.style.overflowX = "auto";
		}
		else if (BBCode.is_ope) {
			//縦横スクロール可能にし、自動改行させない(Opera)
			txtarea.setAttribute("wrap","off");
			//↑だけでは有効にならないための回避策としてオブジェクト作り直し
			var par = txtarea.parentNode;
			var txtarea_clone = txtarea.cloneNode(true);
			txtarea.style.visibility="hidden";
			par.insertBefore(txtarea_clone,txtarea);
			par.removeChild(txtarea);
		}
		else if (BBCode.is_saf) {
			//縦横スクロール可能にし、自動改行させない(Safari)
			txtarea.setAttribute("wrap","off");
		}
	}
}

//プレビューデータ
BBCode.preview = {
	textarea_object : null,
	textarea_value : '',
	preview_area_id : '',
	preview_body_id : '',
	frame_id : '',
	frame_name : '',
	button_id : '',
	loading_id : '',
	title_id : '',
	mce_preview_id : '',
	wrap_off : false,
	iframe_url : '',
	init : function() {
		var props = new Array();
		for (var i in BBCode.preview) {
			switch(i) {
				case 'init':
					continue;
				default:
					props[props.length]=i;
			}
		}
		for (var i=0;i<props.length;i++) {
			eval("BBCode.preview.set_"+props[i]+"=function(v){BBCode.preview."+props[i]+"=v;};");
			eval("BBCode.preview.get_"+props[i]+"=function(){return BBCode.preview."+props[i]+";};");
			eval("BBCode.preview.is_"+props[i]+"=function(v){return BBCode.preview."+props[i]+"==v;};");
		}
	}
};

function previewBBCodeInit(preview_area_id,button_id,frame_id,frame_name,loading_id,title_id,preview_body_id,mce_preview_id,wrap_off) {
	//BBCode.preview.init();
	BBCode.preview.preview_area_id = preview_area_id;
	BBCode.preview.button_id = button_id;
	BBCode.preview.frame_id = frame_id;
	BBCode.preview.frame_name = frame_name;
	BBCode.preview.loading_id = loading_id;
	BBCode.preview.preview_body_id = preview_body_id;
	BBCode.preview.mce_preview_id = mce_preview_id;
	BBCode.preview.wrap_off = wrap_off;
	BBCode.preview.title_id = title_id;
}

//プレビュー実行
function previewBBCode(formObj,url,page) {
	//文字装飾機能のプレビューが実行中ならBBCodeのプレビューは行わない
	var mceprevobj = $(BBCode.preview.mce_preview_id);
	if (!!mceprevobj && typeof(mceprevobj) != 'undefined') {
		if (mceprevobj.checked) {
			return;
		}
	}
	var preview_window = $(BBCode.preview.preview_area_id);
	var preview_button = $(BBCode.preview.button_id);
	var txtarea = bbgetbodyobj(formObj);
	BBCode.preview.textarea_object = txtarea;
	//プレビュー非表示
	if(preview_window.style.visibility == "visible"){
		previewBBCodeHidden(preview_window,txtarea);
		return;
	}
	//プレビュー表示
	previewBBCodeVisible(preview_window,txtarea);
	//IFrameのdocument
	var fdoc = previewGetIFrameDocument();
	if (!fdoc) {
		//取得できなければ非表示にする
		previewBBCodeHidden(preview_window,txtarea);
		return;
	}
	//内容が同じ場合は送信しない
	if(txtarea.value == BBCode.preview.textarea_value){
		//プレビュータイトルを表示
		previewBBCodeShowTitle();
		return;
	}
	//読み込み中表示
	if (!previewBBCodeShowLoading(fdoc)) {
		//失敗したら非表示にする
		previewBBCodeHidden(preview_window,txtarea);
		return;
	}
	//プレビュー内容を更新
	previewBBCodeUpdate(fdoc,txtarea,page);
	//今回送信した内容を保存
	BBCode.preview.textarea_value = txtarea.value;
}

//IFrameのドキュメント取得
function previewGetIFrameDocument() {
	if (BBCode.is_saf) {
		//Safari用の取得方法
		var frame = eval("window."+BBCode.preview.frame_name);
		return frame.document;
		//他にもバージョンによるだろうが以下のような制約があるらしいので、いろいろ対策してみた。
		//・IFRAMEのidでは指定できないので、nameで呼び出す
		//・display:none;だとIFRAMEのオブジェクトが取得できない(undefinedになる)
		//・IFRAMEのsrcに有効なURLが入ってると、bodyタグのonloadが実行されない
		//  （src=""にして、後からsrcにURLをセットすれば良い）
		//・IFRAMEのsrcのURLをjavascriptで操作するとき、そのURLに変更がない場合リロードされない
		//  （今回はFORMでsubmitさせてるので問題ないが）
	}
	else {
		//FireFoxは前者、IE/Operaは後者
		return $(BBCode.preview.frame_id).contentDocument || document.frames[BBCode.preview.frame_name].document;
	}
}

//読み込み中表示
function previewBBCodeShowLoading(fdoc) {
	//プレビュータイトルを非表示
	previewBBCodeHideTitle();
	//プレビュー本文を非表示
	var body=fdoc.getElementById(BBCode.preview.preview_body_id);
	if (!body || typeof(body)=='undefined') {
		return false;
	}
	body.innerHTML="";
	body.style.visibility="hidden";
	//読み込み中表示
	var load=$(BBCode.preview.loading_id);
	load.style.visibility="visible";
	load.style.display="block";
	load.style.height="auto";
	return true;
}

//読み込み中非表示
function previewBBCodeHideLoading(fdoc,prev_body_id) {
	//読み込み中非表示
	if (!!BBCode.preview.loading_id) {
		var load=$(BBCode.preview.loading_id);
		if (!!load && typeof(load) != 'undefined') {
			load.style.visibility="hidden";
			load.style.display="none";
		}
	}
	//プレビュー本文表示
	if (!!prev_body_id || !!BBCode.preview.preview_body_id) {
		var body = (!!prev_body_id && prev_body_id.length>0) ? fdoc.getElementById(prev_body_id) : fdoc.getElementById(BBCode.preview.preview_body_id);
		if (!!body && typeof(body) != 'undefined') {
			body.style.visibility="visible";
		}
	}
	//プレビュータイトルを表示
	previewBBCodeShowTitle();
}

//プレビュータイトル非表示
function previewBBCodeHideTitle() {
	if (!!BBCode.preview.title_id) {
		var title = $(BBCode.preview.title_id);
		title.style.visibility = "hidden";
	}
}

//プレビュータイトル表示
function previewBBCodeShowTitle() {
	if (!!BBCode.preview.title_id) {
		var title = $(BBCode.preview.title_id);
		title.style.visibility = "visible";
	}
}

//プレビューの内容を更新
function previewBBCodeUpdate(fdoc,txtarea,page) {
	var frame = $(BBCode.preview.frame_id);
	if (BBCode.preview.iframe_url != frame.src) {
		frame.setAttribute("src",BBCode.preview.iframe_url);
	}
	var form = fdoc.forms.item('preview_form');
	form.elements["body"].value = txtarea.value;
	form.elements["id"].value   = document.getElementsByTagName('body')[0].id || '';
	form.elements["page"].value = page || document.getElementsByTagName('body')[0].id;
	form.elements["browser"].value = BBCode.getBrowser();
	form.elements["target_id"].value = (location.href.match(/\?m=(.*)&target_c_([^=])_id=([0-9]+)/) ? RegExp.$3 : '');
	form.submit();
}

//プレビューを非表示
function previewBBCodeHidden(prevobj,txtarea) {
	try {
		//プレビュータイトルを非表示
		previewBBCodeHideTitle();
		//プレビューを非表示
		prevobj = (!prevobj) ? $(BBCode.preview.preview_area_id) : prevobj;
		prevobj.style.visibility = "hidden";
		prevobj.style.height = "0px";
		prevobj.style.zIndex = "1";
		//テキストエリアを全面にしてフォーカス
		txtarea = ((!!txtarea) ? txtarea : BBCode.preview.textarea_object);
		if (!!txtarea) {
			txtarea.style.zIndex = "10000";
			txtarea.focus();
		}
	}catch(e){}
	return false;
}
//プレビューを表示
function previewBBCodeVisible(prevobj,txtarea) {
	//プレビューをテキストエリアの上に重ねる
	prevobj.style.zIndex = "10000";
	txtarea.style.zIndex = "9999";
	var pos = getPosition(txtarea);
	//プレビュー位置・サイズ調整
	var adjust = {pos:{x:0,y:0},width:0,height:0};
	if (BBCode.is_ope) {
		//Opera9.50で環境の差でズレが生じる可能性があるため微調整
		adjust = {pos:{x:-6,y:-6},width:6,height:6};
	}
	else if (BBCode.is_ie) {
		//調整の必要なし?
	}
	else if (BBCode.is_moz) {
		//調整の必要なし?
	}
	//プレビュー位置・サイズを調整して表示
	prevobj.style.margin = "0";
	prevobj.style.padding = "2px";
	prevobj.style.cursor = "auto";
	prevobj.style.top = (pos.y + adjust.pos.y) + 'px';
	prevobj.style.left = (pos.x + adjust.pos.x)+ 'px';
	prevobj.style.width = (parseInt(txtarea.style.width) + adjust.width)+ 'px';
	prevobj.style.height = (parseInt(txtarea.style.height) + adjust.height) + 'px';
	prevobj.style.display = "block";
	prevobj.style.visibility = "visible";
}

// プレビュー画面の初期化
function previewBBCodeIFrameInit(preview_url){
	var frame = $(BBCode.preview.frame_id);
	if (!!preview_url) {
		frame.setAttribute("src",preview_url);
		BBCode.preview.iframe_url = preview_url;
	} else {
		if (BBCode.preview.iframe_url != frame.src) {
			frame.setAttribute("src",BBCode.preview.iframe_url);
		}
	}
	var bbprevobj = $(BBCode.preview.button_id);
	bbprevobj.style.display = "";
	bbprevobj.style.visibility = "visible";
	var mceprevobj = $(BBCode.preview.mce_preview_id);
	if (!!mceprevobj && typeof(mceprevobj) != 'undefined') {
		Event.observe(mceprevobj,'click',function(){previewBBCodeHidden(document.getElementById(BBCode.preview.preview_area_id));});
	}
	changeTextareaSize4preview();
	//script.aculo.usでDrag&Drop
	if(typeof(Draggable)!='undefined'){
		var optDraggable = {
			handle: BBCode.preview.title_id,
			revert: false,
			ghosting: false,
			starteffect: function() {},
			reverteffect: function() {},
			endeffect: function() {}
		}
		new Draggable(BBCode.preview.preview_area_id,optDraggable);
	}
}

// Copyright (c) 2007-2008 Naoya Shimada
