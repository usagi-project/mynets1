/*
 * Type     : JavaScript
 * Name     : BBCode CMD Library
 * Author   : Naoya Shimada
 * Version  : 0.2.2
 * Date     : 2008/07/15
 * License  : http://www.php.net/license/3_01.txt PHP License 3.01
 * Note     : Designed for OpenPNE 2.8.
 */

var BBCodeCMD = function(cmd) {
	this.cmd = cmd;
	this.src = cmd;
	this.args = null;
	this.use = false;
	this.name = "";
	this.help = "";
	this.clear = function(){
		this.args = null;
	};
	this.match = function(v){ return false; };
	this.parse = function(v){
		if(!!this.args || (this.match(v) && !!this.args)) {
			var cmd_tag = this.build(this.args);
			this.clear();
			return cmd_tag;
		}
		return v;
	};
	this.build = function(args){
		if(typeof(args)=='object'){
			return '<cmd src="' + this.src + '" args="' + args.join(',') + '">';
		}
		return '<cmd src="' + this.src + '" args="' + args + '">';
	};
};

var BBCodeCMDLibrary = function() {
	this.len = 0;
	this.cmds = new Array();
	this.add = function(cmd){
		eval("this."+cmd+"= new BBCodeCMD('"+cmd+"');");
		eval("var obj = this."+cmd+";");
		this.cmds.push(obj);
		this.len++;
	};
	this.length = function(){
		return this.len;
	};
	this.createCMDTag = function(v){
		for(var i=0;i<this.len;i++){
			var cmd = this.cmds[i];
			if(cmd.use && cmd.match(v)) {
				var ret = cmd.parse(v);
				cmd.clear();
				return ret;
			}
		}
		return v;
	};
};

// BBCode Tags Object //
var BBCodeCMDs = new BBCodeCMDLibrary();


///// CMDタグ変換の設定 /////

/*** OpenPNE/MyNETS同梱CMDタグの小窓 ***/

/* BlogCruiser */
BBCodeCMDs.add("blogcruiser");
BBCodeCMDs.blogcruiser.name = "ブログクルーザー";
BBCodeCMDs.blogcruiser.match = function(v) {
	// 名刺貼り付け用ソースから
	if(v.match(/<img src="http:\/\/blogcruiser\.so-net\.ne\.jp\/blogcruiser\/image\/card\/([0-9]{3})\/([0-9]+)\.png\?card"/i)) {
		this.args = new Array(RegExp.$1,RegExp.$2);
		return true;
	}
	return false;
}

/* Livly Island */
BBCodeCMDs.add("livlyisland");
BBCodeCMDs.livlyisland.name = "リヴリー";
BBCodeCMDs.livlyisland.match = function(v) {
	// Livly Book→others→ブログパーツ設定
	if(v.match(/http:\/\/www\.livly\.com\/[bf]\.php\?uid=([a-zA-Z0-9]+)(?:&amp;|&)s=([0-9]+)/i)) {
		this.args = new Array(RegExp.$1,RegExp.$2);
		return true;
	}
	return false;
}

/* ポストペット */
BBCodeCMDs.add("postpet");
BBCodeCMDs.postpet.name = "ポストペット";
BBCodeCMDs.postpet.match = function(v) {
	// ポストペットウィンドウ
	if(v.match(/src="http:\/\/ppwin\.so-net\.ne\.jp\/webmail\/petwindow\/script\.do\?window_id=([a-z0-9]+)"/i)) {
		this.args = RegExp.$1;
		return true;
	}
	return false;
}

/* So-net Photo */
BBCodeCMDs.add("sonetphoto");
BBCodeCMDs.sonetphoto.name = "So-net Photo";
BBCodeCMDs.sonetphoto.match = function(v) {
	// So-net Photoのブログパーツ作成から
	if(v.match(/sonetphoto_badge_member_name\s+=\s+"([a-zA-Z0-9_\-]+)";/i)) {
		var member_name = RegExp.$1;
		if(v.match(/sonetphoto_badge_type\s+=\s+"(t|s|f|thumbnail|slideshow|full)";/i)) {
			var type = RegExp.$1;
			if(v.match(/sonetphoto_badge_sort\s+=\s+"(r|n|random|new)";/i)) {
				this.args = new Array(member_name,type,RegExp.$1);
				return true;
			} else {
				this.args = new Array(member_name,type);
				return true;
			}
		} else {
			this.args = member_name;
			return true;
		}
	}
	return false;
}

/* タグふれんず */
BBCodeCMDs.add("tagfriends");
BBCodeCMDs.tagfriends.name = "タグふれんず";
BBCodeCMDs.tagfriends.match = function(v) {
	// タグを貼るための [タグソース]
	if(v.match(/src="http:\/\/tagfriends\.com\/(ID[0-9]+)"/i)) {
		this.args = RegExp.$1;
		return true;
	}
	return false;
}

/*** CMDパッケージ同梱CMDタグの小窓 ***/

/* アバウトミー */
BBCodeCMDs.add("aboutme");
BBCodeCMDs.aboutme.name = "アバウトミー";
BBCodeCMDs.aboutme.match = function(v) {
	// 他のブログの場合のタグ
	if(v.match(/var AbUnum='([a-z0-9]+)';<\/script><[^<]* src="http:\/\/p\.aboutme\.jp\/p\/js\/blogp\.js"/i)) {
		this.args = RegExp.$1;
		return true;
	}
	return false;
}

/* FC2無料チャット */
BBCodeCMDs.add("chatfc2com");
BBCodeCMDs.chatfc2com.name = "FC2無料チャット";
BBCodeCMDs.chatfc2com.match = function(v) {
	// FC2チャットマイページのURL
	if(v.match(/http:\/\/(chat[0-9]+)\.fc2\.com\/admin\.html\?uid=([0-9]+)&?/i)) {
		this.args = new Array(RegExp.$2,RegExp.$1);
		return true;
	}
	return false;
}

/* @niftyビデオ共有 */
BBCodeCMDs.add("videonifty");
BBCodeCMDs.videonifty.name = "@niftyビデオ共有";
BBCodeCMDs.videonifty.match = function(v) {
	// ブログに埋め込む
	if(v.match(/<script[^<>]+src="(http:\/\/dl\.video\.nifty\.com\/js\/player\.js\?user_id=([0-9]+)&catalog_id=([0-9]+)&category_id=([0-9]+)[^"'<>]+)"><\/script>/i)) {
		//this.args = new Array(RegExp.$2,RegExp.$3);
		this.args = RegExp.$1;
		return true;
	}
	return false;
}
BBCodeCMDs.videonifty.build = function(args){
	// URL2CMD化
	return args;
}

/* slideshare */
BBCodeCMDs.add("slideshare");
BBCodeCMDs.slideshare.name = "slideshare";
BBCodeCMDs.slideshare.match = function(v) {
	// Embed in your blog
	if(v.match(/\[slideshare id=([0-9]+)&doc=([a-zA-Z0-9\-]+)(&w=[0-9]+)?\]/i)) {
		this.args = new Array(RegExp.$1,RegExp.$2);
		return true;
	}
	return false;
}

/* shinobi enq */
BBCodeCMDs.add("shinobienq");
BBCodeCMDs.shinobienq.src = "shinobi";
BBCodeCMDs.shinobienq.name = "NINJA TOOLSのアンケート";
BBCodeCMDs.shinobienq.match = function(v) {
	// アンケートフォーム設置用HTMLソース
	if(v.match(/<script[^<>]+src=["']?http:\/\/([a-z0-9]+)\.(enq[0-9]+)\.shinobi\.jp\/js\/([0-9]+)["']?/i)) {
		this.args = new Array(RegExp.$1,RegExp.$2,RegExp.$3);
		return true;
	}
	return false;
}

/* stitch */
BBCodeCMDs.add("stitch");
BBCodeCMDs.stitch.name = "stitch";
BBCodeCMDs.stitch.match = function(v) {
	// このTシャツをブログに貼る
	if(v.match(/<script type="text\/javascript">stitchTicker\(([0-9]+)\);<\/script>/i)) {
		this.args = RegExp.$1;
		return true;
	}
	return false;
}

/* Ustream Chat */
BBCodeCMDs.add("ustream");
BBCodeCMDs.ustream.name = "Ustream Chat";
BBCodeCMDs.ustream.match = function(v) {
	// Add to My wordpress.com blog
	if(v.match(/\[ustream ([a-zA-Z0-9\.,]+(\.usc)?)\]/i)) {
		this.args = new Array("My-Show",RegExp.$1);
		return true;
	}
	return false;
}

/* みなくるビデオ */
BBCodeCMDs.add("videominakuru");
BBCodeCMDs.videominakuru.name = "みなくるビデオ";
BBCodeCMDs.videominakuru.match = function(v) {
	// ブログに貼る
	if(v.match(/<script type="text\/javascript">var FO =[^<>]+flashvars:"file=([a-z0-9]+)&showdigits=[^<>]+<\/script>/i)) {
		this.args = RegExp.$1;
		return true;
	}
	return false;
}

/* アメーバビジョン */
BBCodeCMDs.add("visionmovieamebajp");
BBCodeCMDs.visionmovieamebajp.name = "アメーバビジョン";
BBCodeCMDs.visionmovieamebajp.match = function(v) {
	// アメブロ以外に貼付ける場合は上記のコードを使用ください
	if(v.match(/<script[^<>]+src="(http:\/\/visionmovie\.ameba\.jp\/mcj\.php\?id=[a-zA-Z0-9:]+\/?[a-zA-Z0-9:]*)"><\/script>/i)) {
		this.args = RegExp.$1;
		return true;
	}
	return false;
}
BBCodeCMDs.visionmovieamebajp.build = function(args){
	// URL2CMD化
	return args;
}

/* zoome */
BBCodeCMDs.add("zoome");
BBCodeCMDs.zoome.name = "zoome";
BBCodeCMDs.zoome.match = function(v) {
	// 貼り付けHTML
	if(v.match(/<script[^<>]+src=["']?http:\/\/(www|navi|circle)\.zoome\.jp\/([^"'<>\/]+)?\/?(?:swfwrite\?param|swmcmedp\?cod)=([a-z0-9]+)["']?><\/script>/i)) {
		if (!RegExp.$2) {
			this.args = new Array(RegExp.$1,RegExp.$3);
		}else{
			this.args = new Array(RegExp.$1,RegExp.$3,RegExp.$2);
		}
		return true;
	}
	return false;
}

/* Amazon.co.jp */
BBCodeCMDs.add("amazon");
BBCodeCMDs.amazon.name = "Amazon小窓";
BBCodeCMDs.amazon.match = function(v) {
	// URL
	if(v.match(/http:\/\/(?:www\.|)amazon(?:\.co|)\.jp\/(?:.*)\/(?:ASIN|product\-description|product|dp|detail\/\-\/[^\/]+|detail\/\-)\/([a-zA-Z0-9]{10})/)) {
		this.args = 'http://www.amazon.co.jp/dp/'+RegExp.$1;
		return true;
	}
	return false;
}
BBCodeCMDs.amazon.build = function(args){
	// URL2CMD化
	return args;
}

///// CMDタグ変換を使うか否かの設定 /////

/*** OpenPNE/MyNETS同梱CMDタグの小窓 ***/

// ブログクルーザーの小窓
BBCodeCMDs.blogcruiser.use = true;
// Livly Islandの小窓
BBCodeCMDs.livlyisland.use = true;
// ポストペットの小窓
BBCodeCMDs.postpet.use = true;
// So-net Photoの小窓
BBCodeCMDs.sonetphoto.use = true;
// タグふれんずの小窓
BBCodeCMDs.tagfriends.use = true;

/*** CMDパッケージ同梱CMDタグの小窓 ***/

// アバウトミーの小窓
BBCodeCMDs.aboutme.use = true;
// FC2無料チャットの小窓
BBCodeCMDs.chatfc2com.use = true;
// @niftyビデオ共有の小窓
BBCodeCMDs.videonifty.use = true;
// slideshareの小窓
BBCodeCMDs.slideshare.use = true;
// NINJA TOOLSのアンケートの小窓
BBCodeCMDs.shinobienq.use = true;
// stitchの小窓
BBCodeCMDs.stitch.use = true;
// Ustreamチャットの小窓
BBCodeCMDs.ustream.use = true;
// みなくるビデオの小窓
BBCodeCMDs.videominakuru.use = true;
// アメーバビジョンの小窓
BBCodeCMDs.visionmovieamebajp.use = true;
// zoomeの小窓
BBCodeCMDs.zoome.use = true;
// Amazon小窓
BBCodeCMDs.amazon.use = true;

// Copyright (c) 2007-2008 Naoya Shimada
