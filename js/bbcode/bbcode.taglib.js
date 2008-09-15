/*
 * Type    : JavaScript
 * Name    : BBCode Tab Library
 * Author  : Naoya Shimada
 * Version : 0.5.1
 * Date    : 2008/07/15
 * License : http://www.php.net/license/3_01.txt PHP License 3.01
 * Note    : Designed for OpenPNE 2.8.
 */

var PromptOptions = function() {
	this.text = "";
	this.init = "";
	this.checker = function(v){ return true; };
	this.convert_value = function(v){ return v; };
	this.convert_return = function(v,f){ return v; };
};

var BBCodeTag = function(tag) {
	this.tag = tag;
	this.use_pne_tag = false;
	this.base_url = "";
	this.is_tag_changed = false;
	this.with_attribute = false;
	this.need_attribute = false;
	this.prompt_with_select = false;
	this.need_prompt = false;
	this.help = "";
	this.prompt_options = new PromptOptions();
	this.change_tag = function(v,o){
		this.is_tag_changed = false;
		return this.tag;
	};
	this.open_tag = function(v,o){
		var ctag = this.change_tag(v,o);
		if(this.need_attribute){
			return "["+ctag+"="+((v!=null&&v.length>0)?v:"")+"]";
		}else if(this.with_attribute&&v!=null&&v.length>0){
			return "["+ctag+"="+v+"]";
		}else if(!ctag||ctag.length==0){
			return "";
		}else{
			return "["+ctag+"]";
		}
	};
	this.close_tag = function(v,o){
		var ctag = this.change_tag(v,o);
		if(!ctag||ctag.length==0){
			return "";
		}else{
			return "[/"+ctag+"]";
		}
	};
	this.convert_attribute = function(v){ return v; };
	this.parse_value = function(v){ return v; };
};

var BBCodeTagLibrary = function() {
	this.len = 0;
	this.tags = new Array();
	this.add = function(tag){
		eval("this."+tag+"= new BBCodeTag('"+tag+"');");
		this.tags.push(tag);
		this.len++;
	};
	this.length = function(){
		return this.len;
	};
	this.setValue = function(tag,key,value){
		eval("this."+tag+"."+key+"="+value+";");
	};
	this.setValueAll = function(key,value){
		for(var i=0;i<this.len;i++){
			eval("this."+this.tags[i]+"."+key+"="+value+";");
		}
	};
};

// BBCode Tags Object //
var BBCodeTags = new BBCodeTagLibrary();

///// Displayed BBCode Tags /////

/* [b] */
BBCodeTags.add("b");
BBCodeTags.b.help = "太字にする： [b]text[/b]<br />「強調」する場合は [strong]text[/strong] も使用可能です（見た目は同じ）";

/* [i] */
BBCodeTags.add("i");
BBCodeTags.i.help = "斜体にする： [i]text[/i]<br />「強調」の意味での斜体には [em]text[/em] も使用可能です（見た目は同じ）";

/* [u] */
BBCodeTags.add("u");
BBCodeTags.u.help = "下線を引く： [u]text[/u]";

/* [s] */
BBCodeTags.add("s");
BBCodeTags.s.help = "打消し線を引く： [s]text[/s]。手入力で[del]text[/del]や[strike]text[/strike]<br />[linethrough]text[/linethrough] も使用可能です";

/* [color] */
BBCodeTags.add("color");
BBCodeTags.color.help = "文字の色： [color=#ff0000]text[/color]<br />[color=red]text[/color] (色名指定)も使用可能です";
BBCodeTags.color.with_attribute = true;
BBCodeTags.color.need_attribute = true;

/* [highlight] */
BBCodeTags.add("highlight");
BBCodeTags.highlight.help = "ハイライトにする： [highlight]text[/highlight]<br />[highlight=#ff0000]text[/highlight] (色指定)も使用可能です";
BBCodeTags.highlight.with_attribute = true;

/* [right] */
BBCodeTags.add("right");
BBCodeTags.right.help = "右寄せにする： [right]text[/right]";

/* [center] */
BBCodeTags.add("center");
BBCodeTags.center.help = "中央寄せにする： [center]text[/center]";

/* [indent] */
BBCodeTags.add("indent");
BBCodeTags.indent.help = "インデント(字下げ)を挿入： [indent]text[/indent] <br />[indent=2em]text[/indent] も使用可能です（1em＝１文字の高さ）";
BBCodeTags.indent.with_attribute = true;
BBCodeTags.indent.prompt_with_select = true;
BBCodeTags.indent.prompt_options.text = "どの程度字下げを行うかを入力してください";
BBCodeTags.indent.prompt_options.init = "2em";
BBCodeTags.indent.prompt_options.checker = function(v){return (v!=null&&v.length>0);}
BBCodeTags.indent.need_prompt = false;

/* [quote] */
BBCodeTags.add("quote");
BBCodeTags.quote.help = "引用を表示： [quote]text[/quote]または[quote=Quote]text[/quote]のように<br />「Quote」の部分に何からの引用かを記述することも使用可能です";
BBCodeTags.quote.with_attribute = true;
BBCodeTags.quote.prompt_with_select = true;
BBCodeTags.quote.prompt_options.text = "引用文字を入力してください";
BBCodeTags.quote.prompt_options.init = "Quote:";
BBCodeTags.quote.prompt_options.convert_return = function(v,f){return ((v!=null&v.length==0)?' ':((v!=null)?v:''));}

/* [code] */
BBCodeTags.add("code");
BBCodeTags.code.help = "コード表示： [code]code[/code]<br />プログラムのコードをできる限りそのまま表示させたい場合に使用してください";

/* [noparse] */
BBCodeTags.add("noparse");
BBCodeTags.noparse.help = "BBCodeをそのまま表示： [noparse]BBCode[/noparse]<br />BBCodeタグを無効化し、そのまま表示させたい場合に使用してください";

/* [list] */
BBCodeTags.add("list");
BBCodeTags.list.help = "番号付き箇条書き作成： [list][*]text1[*]text2[/list]。[*]が箇条書きの行頭<br />[list=1] と番号の種類を指定可能。1=数字、iとI=ローマ数字、aとA=英字";
BBCodeTags.list.with_attribute = true;
BBCodeTags.list.prompt_with_select = true;
BBCodeTags.list.prompt_options.text = "番号の種類を入力してください(1,i,I,a,A)";
BBCodeTags.list.prompt_options.init = "1";
BBCodeTags.list.prompt_options.checker = function(v){return (v!=null&&v.length==1&v.match(/[1iIaA]/)!=null);}
BBCodeTags.list.prompt_options.convert_value = function(v){return ('[*]'+v);}
BBCodeTags.list.need_prompt = true;

/* [listul] */
BBCodeTags.add("listul");
BBCodeTags.listul.tag = "list";
BBCodeTags.listul.help = "番号なし箇条書き作成： [list][*]text1[*]text2[/list]。[*]が箇条書きの行頭<br />[list=d] とマークの種類を指定可能。d=点、c=円、s=四角を表します";
BBCodeTags.listul.with_attribute = true;
BBCodeTags.listul.prompt_with_select = true;
BBCodeTags.listul.prompt_options.text = "マークの種類を入力してください(d,c,s)";
BBCodeTags.listul.prompt_options.init = "d";
BBCodeTags.listul.prompt_options.checker = function(v){return (v!=null&&v.length==1&v.match(/[dcs]/)!=null);}
BBCodeTags.listul.prompt_options.convert_value = function(v){return ("[*]"+v);}
BBCodeTags.listul.need_prompt = true;

/* [img] */
BBCodeTags.add("img");
BBCodeTags.img.help = "画像を挿入： [img]http://image_url[/img]<br />[img=200x100]http://image_url[/img] (幅x高さ)も指定可能 (通常は横幅120)";
BBCodeTags.img.prompt_options.text = "挿入する画像のURLを入力してください";
BBCodeTags.img.prompt_options.init = "http://";
BBCodeTags.img.prompt_options.checker = function(v){return (v!=null&&v.length>1&&(v.match(/^https?:\/\/(.+)/i))&&(v.match(/\.(gif|jpg|jpeg|jfif|jp2|bmp|png|tiff?)$/i)));}
BBCodeTags.img.need_prompt = true;

/* [url] */
BBCodeTags.add("url");
BBCodeTags.url.help = "リンクを挿入： [url]http://url[/url] か [url=http://url]text[/url] が使用可能";
BBCodeTags.url.help_pne_tag = "<br>SNS内のURLを貼り付けると簡易リンクに変換されます(一部のURLのみ)";
BBCodeTags.url.with_attribute = true;
BBCodeTags.url.need_prompt = true;
BBCodeTags.url.prompt_with_select = true;
BBCodeTags.url.prompt_options.text = "挿入するリンクのURLを入力してください";
BBCodeTags.url.prompt_options.init = "http://";
BBCodeTags.url.prompt_options.checker = function(v){return (v!=null&&v.length>1&&(v.match(/^https?:\/\/(.+)/i)));}
BBCodeTags.url.prompt_options.convert_return = function(v,f){
	if(BBCodeTags.url.use_pne_tag && typeof(f)!='undefined' && f==true){
		if(v.indexOf(BBCodeTags.url.base_url)==0){
			var n = BBCodeTags.url.get_member(v);
			if(n>0){ return n; }
			n = BBCodeTags.url.get_diary(v);
			if(n>0){ return n; }
			n = BBCodeTags.url.get_topic(v);
			if(n>0){ return n; }
			n = BBCodeTags.url.get_event(v);
			if(n>0){ return n; }
			n = BBCodeTags.url.get_commu(v);
			if(n>0){ return n; }
			n = BBCodeTags.url.get_review(v);
			if(n>0){ return n; }
			n = BBCodeTags.url.get_album(v);
			if(n>0){ return n; }
			n = BBCodeTags.url.get_albumimg(v);
			if(n>0){ return n; }
			n = BBCodeTags.url.get_docci(v);
			if(n>0){ return n; }
			n = BBCodeTags.url.get_other_tag(v);
			if(n>0){ return n; }
		}
	}
	return v;
}
BBCodeTags.url.change_tag = function(v,o){
	if((v==null||v.length==0)&&typeof(o)!='undefined'&&o!=null&&o.length>0){
		var aft = BBCodeTags.url.prompt_options.convert_return(o,true);
		if(aft!=o){
			if(BBCodeTags.url.get_member(o)	>0){	return BBCodeTags.member.tag;	}
			if(BBCodeTags.url.get_diary(o)	>0){	return BBCodeTags.diary.tag;	}
			if(BBCodeTags.url.get_topic(o)	>0){	return BBCodeTags.topic.tag;	}
			if(BBCodeTags.url.get_event(o)	>0){	return BBCodeTags.event.tag;	}
			if(BBCodeTags.url.get_commu(o)	>0){	return BBCodeTags.commu.tag;	}
			if(BBCodeTags.url.get_review(o)	>0){	return BBCodeTags.review.tag;	}
			if(BBCodeTags.url.get_album(o)	>0){	return BBCodeTags.album.tag;	}
			if(BBCodeTags.url.get_albumimg(o)>0){	return BBCodeTags.albumimg.tag;	}
			if(BBCodeTags.url.get_docci(o)	>0){	return BBCodeTags.docci.tag;	}
			if(BBCodeTags.url.get_other_tag(o)	>0){return BBCodeTags[BBCodeTags.url.get_other_tag_name(o)].tag; }
		}
	}
	return this.tag;
}
BBCodeTags.url.get_member = function(v){
	return (v.match(/\?m=(ktai|pc)&a=page_f_home&target_c_member_id=(\d+)/)) ? RegExp.$2 : -1;
}
BBCodeTags.url.get_diary = function(v){
	return (v.match(/\?m=(ktai|pc)&a=page_fh_diary&target_c_diary_id=(\d+)/)) ? RegExp.$2 : -1;
}
BBCodeTags.url.get_topic = function(v){
	return (v.match(/\?m=(ktai&a=page_c_bbs|pc&a=page_c_topic_detail)&target_c_commu_topic_id=(\d+)/)) ? RegExp.$2 : -1;
}
BBCodeTags.url.get_event = function(v){
	return (v.match(/\?m=(ktai&a=page_c_bbs|pc&a=page_c_event_detail)&target_c_commu_topic_id=(\d+)/)) ? RegExp.$2 : -1;
}
BBCodeTags.url.get_commu = function(v){
	return (v.match(/\?m=(ktai|pc)&a=page_c_home&target_c_commu_id=(\d+)/)) ? RegExp.$2 : -1;
}
BBCodeTags.url.get_review = function(v){
	return (v.match(/\?m=pc&a=page_h_review_list_product&c_review_id=(\d+)/)) ? RegExp.$1 : -1;
}
BBCodeTags.url.get_album = function(v){
	if (v.match(/\?m=pc&a=page_fh_album&target_c_album_id=(\d+)/)) {
		return RegExp.$1;
	}
	else if (v.match(/\?m=pc&a=page_h_album_image_insert_dialog&target_c_album_id=(\d+)/)) {
		return RegExp.$1;
	}
	return -1;
}
BBCodeTags.url.get_albumimg = function(v){
	return (v.match(/\?m=pc&a=page_fh_album_image_show&target_c_album_image_id=(\d+)/)) ? RegExp.$1 : -1;
}

BBCodeTags.url.get_docci = function(v){
	return -1;
}
BBCodeTags.url.get_other_tag = function(v){
	return -1;
}
BBCodeTags.url.get_other_tag_name = function(v){
	return "";
}

/* [size] */
BBCodeTags.add("size");
BBCodeTags.size.help = "文字のサイズ： [size=x-small]small text[/size]<br />[size=36pt]text[/size] [size=18px]text[/size] なども使用可能です";
BBCodeTags.size.with_attribute = true;
BBCodeTags.size.need_attribute = true;

/* [font] */
BBCodeTags.add("font");
BBCodeTags.font.help = "フォントの指定： [font=ＭＳ Ｐ明朝]text[/font]<br />ユーザー環境に指定したフォントがなければ意図通りには表示されません";
BBCodeTags.font.with_attribute = true;
BBCodeTags.font.need_attribute = true;

/* [marquee] */
BBCodeTags.add("marquee");
BBCodeTags.marquee.help = "文字をスクロールさせる： [marquee]text[/marquee] <br />[marquee=alternate]text[/marquee] のように効果を使用可能です";
BBCodeTags.marquee.with_attribute = true;
BBCodeTags.marquee.need_attribute = false;
/*
BBCodeTags.marquee.prompt_with_select = true;
BBCodeTags.marquee.prompt_options.text = "効果を入力してください（left,right,up,down,scroll,alternate）";
BBCodeTags.marquee.prompt_options.init = "alternate";
BBCodeTags.marquee.prompt_options.checker = function(v){return (v!=null&&(v=='left'||v=='right'||v=='up'||v=='down'||v=='scroll'||v=='alternate'));}
BBCodeTags.marquee.need_prompt = false;
*/

/* [sup] */
BBCodeTags.add("sup");
BBCodeTags.sup.help = "上付きにする： [sup]text[/sup]<br />文字を上付きにします";

/* [sub] */
BBCodeTags.add("sub");
BBCodeTags.sub.help = "添え字にする： [sub]text[/sub]<br />文字を下付きの添え字にします";

/* [email] */
BBCodeTags.add("email");
BBCodeTags.email.help = "メールアドレスを挿入： [email]mail@address[/email] <br />[email=mail@address]name[/email] も使用可能です";
BBCodeTags.email.with_attribute = true;
BBCodeTags.email.prompt_with_select = true;
BBCodeTags.email.prompt_options.text = "メールアドレスを入力してください";
BBCodeTags.email.prompt_options.init = "mail@address";
BBCodeTags.email.prompt_options.checker = function(v){return (v!=null&&v.match(/^[a-z0-9][a-z0-9_\-\.\+]*@[a-z0-9][a-z0-9\.\-]{0,63}\.(?:com|net|org|biz|info|name|pro|aero|coop|museum|jobs|travel|mail|cat|post|asia|mobi|tel|xxx|int|gov|mil|edu|arpa|[a-z]{2,4})$/i));}
BBCodeTags.email.prompt_options.convert_return = function(v,f){return ((!v)?'':v);}
BBCodeTags.email.need_prompt = true;

/* [cmd] */
BBCodeTags.add("cmd");
BBCodeTags.cmd.help = "文字列を小窓にする： URL2CMDまたはCMDタグに整形します。<br />&lt;cmd src=\"text\" args=\"text\"&gt;形式では小窓化できない場合があります";
BBCodeTags.cmd.with_attribute = false;
BBCodeTags.cmd.need_prompt = true;
BBCodeTags.cmd.prompt_with_select = false;
BBCodeTags.cmd.prompt_options.text = "挿入する小窓に必要な文字列を入力してください";
BBCodeTags.cmd.prompt_options.init = "";
BBCodeTags.cmd.prompt_options.checker = function(v){return (v!=null&&v.length>1&&(v.match(/^https?:\/\/(.+)/i)||v.match(/<cmd src="([^"'<>]+)" args="([^"'<>]+)">/i)));}
BBCodeTags.cmd.parse_value = function(v){
	if(!v||v.length==0){return "";}
	//BBCodeCMDLibraryが存在する場合はCMDタグにすることも可能
	if(typeof(BBCodeCMDs) != 'undefined') {
		if(v.match(/^<cmd src="[^<>"']+" args="[^<>"']+">$/i)) {
			return v;
		}
		var ret = BBCodeCMDs.createCMDTag(v);
		if(ret!=v || ret.match(/^<cmd src="[^<>"']+" args="[^<>"']+">$/i)) {
			return ret;
		}
	}
	// 通常はembedタグ,objectタグの場合のみURL2CMDにする
	if(v.match(/<embed[^>]+src=["']?(https?:\/\/[^"'>\s\r\n]+)["']?/i)) {
		return RegExp.$1;
	}else if(v.match(/<object/i)&&v.match(/<param[^>]+name=["']?movie["']?value=["']?(https?:\/\/[^"'>\s\r\n]+)["']?/i)) {
		return RegExp.$1;
	}else if(v.match(/<iframe[^>]+src=["']?(https?:\/\/[^"'>\s\r\n]+)["']?/i)) {
		return RegExp.$1;
	}else if(v.match(/<a[^>]+href=["']?(https?:\/\/[^"'>\s\r\n]+)["']?/i)) {
		return RegExp.$1;
	}
	return v;
}
BBCodeTags.cmd.change_tag = function(v,o){
	this.is_tag_changed = true;
	return null;
}

///// Not Displayed BBCode Tags /////

/* [left] */
BBCodeTags.add("left");
BBCodeTags.left.help = "左寄せにする： [left]text[/left]";

/* [align] */
BBCodeTags.add("align");
BBCodeTags.align.help = "文字を寄せる： [align]text[/align] または [align=right]text[/align] のように<br />どちらに寄せるのかを指定することも使用可能です";
BBCodeTags.align.with_attribute = true;
BBCodeTags.align.prompt_with_select = true;
BBCodeTags.align.prompt_options.text = "寄せる方向を入力してください(left,center,right)";
BBCodeTags.align.prompt_options.init = "left";
BBCodeTags.align.prompt_options.checker = function(v){return (v!=null&&v.length==1&v.match(/^(left|center|right)$/i)!=null);}

/* [tt] */
BBCodeTags.add("tt");
BBCodeTags.tt.help = "等幅フォントにする： [tt]text[/tt]<br />環境によっては、等幅で表示されない場合があります";

/* [bbcode] */
BBCodeTags.add("bbcode");
BBCodeTags.bbcode.help = "コード表示： [bbcode]bbcode[/bbcode]<br />BBCodeタグを無効化し、そのまま表示させたい場合に使用してください";

/* [php] */
BBCodeTags.add("php");
BBCodeTags.php.help = "コード表示： [php]php[/php]<br />PHPのコードをできる限りそのまま表示させたい場合に使用してください";

/* [phpsrc] */
BBCodeTags.add("phpsrc");
BBCodeTags.phpsrc.help = "コード表示： [phpsrc]php[/phpsrc]<br />PHPのコードをできる限りそのまま表示させたい場合に使用してください";

/* [close] */
BBCodeTags.add("close");
BBCodeTags.close.help = "BBCode の開始タグをすべて閉じる  (alt+x)";

///// OpenPNE Original BBCode Tags /////

/* [member] */
BBCodeTags.add("member");
BBCodeTags.member.help = "メンバーへの簡易リンク： [member]c_member_id[/member]<br />c_member_idはメンバーのID(数字)です";

/* [diary] */
BBCodeTags.add("diary");
BBCodeTags.diary.help = "日記への簡易リンク： [diary]c_diary_id[/diary]<br />c_diary_idは日記のID(数字)です";

/* [topic] */
BBCodeTags.add("topic");
BBCodeTags.topic.help = "トピックへの簡易リンク： [topic]c_topic_id[/topic]<br />c_topic_idはトピックのID(数字)です";

/* [event] */
BBCodeTags.add("event");
BBCodeTags.event.help = "イベントへの簡易リンク： [event]c_topic_id[/event]<br />c_topic_idはイベントのID(数字)です";

/* [commu] */
BBCodeTags.add("commu");
BBCodeTags.commu.help = "コミュニティへの簡易リンク： [commu]c_commu_id[/commu]<br />c_commu_idはコミュニティのID(数字)です";

/* [community] */
BBCodeTags.add("community");
BBCodeTags.community.help = "コミュニティへの簡易リンク： [community]c_commu_id[/community]<br />c_commu_idはコミュニティのID(数字)です";

/* [review] */
BBCodeTags.add("review");
BBCodeTags.review.help = "レビューへの簡易リンク： [review]c_review_id[/review]<br />c_review_idはレビューのID(数字)です";

/* [album] */
BBCodeTags.add("album");
BBCodeTags.album.help = "アルバムへの簡易リンク： [album]id[/album]または[albumimg]id[/albumimg]<br />idはアルバムまはた画像のID(数字)です";

/* [albumimg] */
BBCodeTags.add("albumimg");
BBCodeTags.albumimg.help = "アルバムへの簡易リンク： [albumimg]c_album_image_id[/albumimg]<br />c_album_image_idはアルバム画像のID(数字)です";

/* [docci] */
BBCodeTags.add("docci");
BBCodeTags.docci.help = "ドッチへの簡易リンク： [docci]docci_topic_id[/docci]<br />docci_topic_idはドッチのID(数字)です";

/* [other] */
BBCodeTags.add("other");

/* プレビューボタン（タグとしては未使用でヘルプ用途のみ） */
BBCodeTags.add("preview");
BBCodeTags.preview.help = "記入された文章をプレビュー表示します<br />注意：プレビューと投稿後の文章の見た目は必ずしも同じにはなりません";

/* 小窓ボタン（タグとしては未使用でヘルプ用途のみ） */
BBCodeTags.add("cmd_link");
BBCodeTags.cmd_link.help = "小窓についての説明を表示します";

// Copyright (c) 2007-2008 Naoya Shimada
