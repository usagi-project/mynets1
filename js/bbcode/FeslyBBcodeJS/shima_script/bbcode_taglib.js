/*
 * Type    : JavaScript
 * Name    : BBCode Tab Library
 * Author  : Naoya Shimada
 * Version : 0.4.1
 * Date    : 2007/12/26
 * License : http://www.php.net/license/3_01.txt PHP License 3.01
 * Note    : Designed for OpenPNE 2.8.
 */

function PromptOptions() {
	this.text = "";
	this.init = "";
}
PromptOptions.prototype.checker = function(v){
	return true;
}
PromptOptions.prototype.convert_value = function(v){
	return v;
}
PromptOptions.prototype.convert_return = function(v,f){
	return v;
}

function BBCodeTag(tag) {
	this.tag = tag;
	this.is_tag_changed = false;
	this.with_attribute = false;
	this.need_attribute = false;
	this.prompt_with_select = false;
	this.need_prompt = false;
	this.prompt_options = new PromptOptions();
}
BBCodeTag.prototype.change_tag = function(v,o){
	this.is_tag_changed = false;
	return this.tag;
}
BBCodeTag.prototype.open_tag = function(v,o){
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
}
BBCodeTag.prototype.close_tag = function(v,o){
	var ctag = this.change_tag(v,o);
	if(!ctag||ctag.length==0){
		return "";
	}else{
		return "[/"+ctag+"]";
	}
}
BBCodeTag.prototype.convert_attribute = function(v){
	return v;
}
BBCodeTag.prototype.parse_value = function(v){
	return v;
}

function BBCodeTagLibrary() {
	this.len = 0;
	this.tags = new Array();
}
BBCodeTagLibrary.prototype.add = function(tag){
	eval("this."+tag+"= new BBCodeTag('"+tag+"');");
	this.tags.push(tag);
	this.len++;
}
BBCodeTagLibrary.prototype.length = function(){
	return this.len;
}
BBCodeTagLibrary.prototype.setValue = function(tag,key,value){
	eval("this."+tag+"."+key+"="+value+";");
}
BBCodeTagLibrary.prototype.setValueAll = function(key,value){
	for(var i=0;i<this.len;i++){
		eval("this."+this.tags[i]+"."+key+"="+value+";");
	}
}

// BBCode Tags Object //
var BBCodeTags = new BBCodeTagLibrary();

///// Displayed BBCode Tags /////
BBCodeTags.add("url");
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
BBCodeTags.url.get_docci = function(v){
	return -1;
}
BBCodeTags.url.get_other_tag = function(v){
	return -1;
}
BBCodeTags.url.get_other_tag_name = function(v){
	return "";
}

// Copyright (c) 2007 Naoya Shimada
