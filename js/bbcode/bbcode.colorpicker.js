/*
 * Type    : JavaScript
 * Name    : Simple Color Picker
 * Author  : Naoya Shimada
 * Version : 0.3.1
 * Date    : 2008/06/08
 * License : http://www.php.net/license/3_01.txt PHP License 3.01
 * Note    : Designed for OpenPNE 2.8.
 */

/*@cc_on _d=document;eval('var document=_d');@*/

// SimpleColorPicker //
var SimpleColorPicker = {
    window_id : "",
    form  : "",
    tag : "",
    x : 0,
    y : 0,
    duration : 0.5,
    initcolor : "",
    reversal : false,
    colorswitch : false,
    create : function(window,form,tag){
        this.window_id  = window;
        this.form = form;
        this.tag = tag;
    }
}
SimpleColorPicker.safecolor = new Array("00","33","66","99","cc","ff");
SimpleColorPicker.simplesafecolor = new Array(
"ffffff","ffcccc","ffcc99","ffff99","ffffcc","99ff99","99ffff","ccffff","ccccff","ffccff",
"cccccc","ff6666","ff9966","ffff66","ffff33","66ff99","33ffff","66ffff","9999ff","ff99ff",
"c0c0c0","ff0000","ff9900","ffcc66","ffff00","33ff33","66cccc","33ccff","6666cc","cc66cc",
"999999","cc0000","ff6600","ffcc33","ffcc00","33cc00","00cccc","3366ff","6633ff","cc33cc",
"666666","990000","cc6600","cc9933","999900","009900","339999","3333ff","6600cc","993399",
"333333","660000","993300","996633","666600","006600","336666","000099","333399","663366",
"000000","330000","663300","663333","333300","003300","003333","000066","330099","330033");
SimpleColorPicker.simplesafeswitch = { "17" : "00ffff", "25" : "00ff00", "29" : "ff00ff", "47" : "0000ff" }
SimpleColorPicker.pickupsafecolor = new Array("000000","333333","666666","999999","cccccc","ffffff","00ffff","0000ff","00ff00","ffff00","ff00ff","ff0000");
SimpleColorPicker.ordersafecolor  = new Array("000000","003300","006600","009900","00cc00","00ff00","330000","333300","336600","339900","33cc00","33ff00","660000","663300","666600","669900","66cc00","66ff00","000033","003333","006633","009933","00cc33","00ff33","330033","333333","336633","339933","33cc33","33ff33","660033","663333","666633","669933","66cc33","66ff33","000066","003366","006666","009966","00cc66","00ff66","330066","333366","336666","339966","33cc66","33ff66","660066","663366","666666","669966","66cc66","66ff66","000099","003399","006699","009999","00cc99","00ff99","330099","333399","336699","339999","33cc99","33ff99","660099","663399","666699","669999","66cc99","66ff99","0000cc","0033cc","0066cc","0099cc","00cccc","00ffcc","3300cc","3333cc","3366cc","3399cc","33cccc","33ffcc","6600cc","6633cc","6666cc","6699cc","66cccc","66ffcc","0000ff","0033ff","0066ff","0099ff","00ccff","00ffff","3300ff","3333ff","3366ff","3399ff","33ccff","33ffff","6600ff","6633ff","6666ff","6699ff","66ccff","66ffff","990000","993300","996600","999900","99cc00","99ff00","cc0000","cc3300","cc6600","cc9900","cccc00","ccff00","ff0000","ff3300","ff6600","ff9900","ffcc00","ffff00","990033","993333","996633","999933","99cc33","99ff33","cc0033","cc3333","cc6633","cc9933","cccc33","ccff33","ff0033","ff3333","ff6633","ff9933","ffcc33","ffff33","990066","993366","996666","999966","99cc66","99ff66","cc0066","cc3366","cc6666","cc9966","cccc66","ccff66","ff0066","ff3366","ff6666","ff9966","ffcc66","ffff66","990099","993399","996699","999999","99cc99","99ff99","cc0099","cc3399","cc6699","cc9999","cccc99","ccff99","ff0099","ff3399","ff6699","ff9999","ffcc99","ffff99","9900cc","9933cc","9966cc","9999cc","99cccc","99ffcc","cc00cc","cc33cc","cc66cc","cc99cc","cccccc","ccffcc","ff00cc","ff33cc","ff66cc","ff99cc","ffcccc","ffffcc","9900ff","9933ff","9966ff","9999ff","99ccff","99ffff","cc00ff","cc33ff","cc66ff","cc99ff","ccccff","ccffff","ff00ff","ff33ff","ff66ff","ff99ff","ffccff","ffffff");
SimpleColorPicker.namecolor = {
    "686868" : [ "標準色", "#ffffff" ],
    "8b0000" : [ "ダークレッド", "#ffffff" ],
    "ff0000" : [ "レッド", "#ffffff" ],
    "ffa500" : [ "オレンジ", "#ffffff" ],
    "ff00ff" : [ "マゼンダ", "#ffffff" ],
    "8b4513" : [ "ブラウン", "#ffffff" ],
    "f0e68c" : [ "カーキ", "#000000" ],
    "ffff00" : [ "イエロー", "#000000" ],
    "008000" : [ "グリーン", "#ffffff" ],
    "00ff00" : [ "ライム", "#000000" ],
    "6b8e23" : [ "オリーブ", "#ffffff" ],
    "00ffff" : [ "スカイブルー", "#000000" ],
    "0000ff" : [ "ブルー", "#ffffff" ],
    "00008b" : [ "ダークブルー", "#ffffff" ],
    "4b0082" : [ "インディゴ", "#ffffff" ],
    "800080" : [ "パープル", "#ffffff" ],
    "ffffff" : [ "ホワイト", "#000000" ],
    "000000" : [ "ブラック", "#ffffff" ]
}
SimpleColorPicker.drawOptions = function(){
    var data = this.namecolor;
//  document.write('<option style="color:#686868; background-color:#fafafa" value="#686868" class="bb-font-color-options" selected="selected">文字色</option>');
    var cnt=0;
    for (var i in data){
        if(cnt++==0){
            document.write('<option style="color:'+data[i][1]+';background-color:#'+i+';" value="#'+i+'" class="bb-font-color-options" selected="selected">'+data[i][0]+'</option>');
        }else{
            document.write('<option style="color:'+data[i][1]+';background-color:#'+i+';" value="#'+i+'" class="bb-font-color-options">'+data[i][0]+'</option>');
        }
    }
}
SimpleColorPicker.makePalletTop = function(width){
    var style = (width>0)?' style="width:'+width+'px;"':'';
    return '<table id="pallet-simple-table" cellspacing="1" cellpadding="0" border="0"'+style+'><tbody>'+
           '<tr><td id="pallet-simple">Color : <span id="pallet-simple-color">Sample Text</span></td>'+
           '<td align="right" width="20"><a href="javascript:SimpleColorPicker.closePallet()" id="pallet-simple-close-x" alt="CLOSE"></td>'+
           '</tr></tbody></table>'+
           '<table id="pallet-simple-color-table" cellspacing="1" cellpadding="0" border="1"'+style+'><tbody>';
}
// No IMG Version
//         '<td align="right" width="20"><span id="pallet-simple-close-x" title="CLOSE" onmousedown="SimpleColorPicker.closePallet()">X</span></td>'+

SimpleColorPicker.makeColorCell = function(color,cls){
    //MyNETSの場合、崩れる場合があるので処置
    var is_mynets = (typeof(onLoadNumber)!='undefined');
    var ret = '<td id="C'+color+'" onmousedown="SimpleColorPicker.callback(\''+color+'\')"'+
           ' onmouseover="SimpleColorPicker.changeColor(\'pallet-simple-color\',\''+color+'\');'+
           'SimpleColorPicker.changeColorText(\'pallet-onmouse-color\',\''+color+'\');'+
           'SimpleColorPicker.changeColorBackground(\'pallet-onmouse-bgcolor\',\''+color+'\');';
    if(cls=="p-s-c-c" && (!is_mynets || (is_mynets && (!BBCode.is_ie || BBCode.is_ope)))){
        ret += 'this.style.border=\'1px dotted gray\';"'+
               ' onmouseout="this.style.border=\'1px solid #999999\'"';
    }else{
        ret += '"';
    }
    ret += ' title="'+this.colorToName(color)+'" class="'+cls+'"'+
           ' style="background-color:#'+color+';" color="#'+color+'">&nbsp;</td>';
    return ret;
}
SimpleColorPicker.makePalletBottom = function(table_width,onmouse_width){
    var tbl_style = (table_width>0)?' style="width:'+table_width+'px;"':'';
    var oms_style = (onmouse_width>0)?' style="width:'+onmouse_width+'px;"':'';
    var ret = '<table border="0"'+tbl_style+'><tbody>';
    ret += '<tr><td colspan="3"></td></tr>';
    ret += '<tr><td align="left" id="pallet-onmouse-color"'+oms_style+'>&nbsp;</td>';
    if(this.initcolor!=null&&this.initcolor.length>0){
        var color = this.colorWithSharp(this.initcolor);
        ret += '<td align="center"><span id="pallet-simple-close"';
        ret += ' onmousedown="SimpleColorPicker.callback(\''+color+'\')"';
        ret += ' onmouseover="SimpleColorPicker.changeColor(\'pallet-simple-color\',\''+color+'\');';
        ret += 'SimpleColorPicker.changeColorText(\'pallet-onmouse-color\',\''+color+'\');';
        ret += 'SimpleColorPicker.changeColorBackground(\'pallet-onmouse-bgcolor\',\''+color+'\');"';
        ret += ' title="'+this.colorToName(color)+'">Default</span></td>';
    }else{
        ret += '<td align="center"><a href="javascript:SimpleColorPicker.closePallet()" id="pallet-simple-close" alt="CLOSE"></td>';
// No IMG Version
//      ret += '<td align="center"><span id="pallet-simple-close" title="CLOSE" onmousedown="SimpleColorPicker.closePallet()">CLOSE</span></td>';
    }
    ret += '<td align="left" id="pallet-onmouse-bgcolor"'+oms_style+'>&nbsp;</td></tr>';
    ret += '</tbody></table>';
    return ret;
}
SimpleColorPicker.drawColorTable = function(form,tag){
    this.form = form
    this.tag = tag;
    var data = this.simplesafecolor;
    if(this.colorswitch){
        for(var i in this.simplesafeswitch){
            data[i] = this.simplesafeswitch[i];
        }
    }
    if (this.reversal){ data = data.reverse(); }
    var len1 = 7;
    var len2 = data.length/len1;
    var ret = this.makePalletTop(-1);
    var cnt=0;
    for (var i=0;i<len1;i++){
        ret += '<tr>';
        for(var j=0;j<len2;j++){
            ret += this.makeColorCell(data[cnt++],'p-s-c-c');
        }
        ret += '</tr>';
    }
    ret += "</tbody></table>";
    ret += this.makePalletBottom(160,55);
    return ret;
}
SimpleColorPicker.drawSafeColorTable = function(form,tag){
    this.form = form
    this.tag = tag;
    var data = (this.reversal)?this.safecolor.reverse():this.safecolor;
    var len = data.length;
    var ret = this.makePalletTop(-1);
    for (var i=0;i<len;i++){
        for (var j=0;j<len;j++){
            if(j%3==0){ ret += '<tr>'; }
            for (var k=0;k<len;k++){
                ret += this.makeColorCell(this.makeColor(i,j,k),'p-s-c-c-t');
            }
        }
    }
    ret += "</tbody></table>";
    ret += this.makePalletBottom(160,55);
    return ret;
}
SimpleColorPicker.drawOrderSafeColorTable = function(form,tag){
    this.form = form
    this.tag = tag;
    var data1 = this.pickupsafecolor;
    var data2 = (this.reversal)?this.ordersafecolor.reverse():this.ordersafecolor;
    var len1 = data1.length;
    var len2 = data2.length/len1;
    var cnt = 0;
    var ret = this.makePalletTop(180);
    for (var i=0;i<len1;i++){
        ret += '<tr>';
        ret += this.makeColorCell(data1[i],'p-s-c-c-o');
        ret += '<td width="1px"></td>';
        for (var j=0;j<len2;j++){
            ret += this.makeColorCell(data2[cnt++],'p-s-c-c-o');
        }
        ret += '</tr>';
    }
    ret += "</tbody></table>";
    ret += this.makePalletBottom(180,60);
    return ret;
}
SimpleColorPicker.makeColorSharp = function(r,g,b){
    return this.colorWithSharp(this.makeColor(r,g,b));
}
SimpleColorPicker.makeColor = function(r,g,b){
    return this.safecolor[r]+this.safecolor[g]+this.safecolor[b];
}
SimpleColorPicker.colorWithSharp = function(color){
    if(color.length>2&&color.indexOf("#")!=0){
        color = "#"+color;
    }
    return color;
}
SimpleColorPicker.colorWithoutSharp = function(color){
    if(color.length>3&&color.indexOf("#")==0){
        color = color.substring(1,color.length);
    }
    return color;
}
SimpleColorPicker.colorToName = function(color){
    color=this.colorWithoutSharp(color);
    if(typeof(this.namecolor[color])!='undefined'&&typeof(this.namecolor[color][0])!='undefined'){
        return this.namecolor[color][0];
    }else{
        return this.colorWithSharp(color);
    }
}
SimpleColorPicker.changeColor = function(id,color){
    color = this.colorWithSharp(color);
    var field = document.getElementById(id);
    field.style.color = color;
}
SimpleColorPicker.changeColorText = function(id,color){
    color = this.colorWithSharp(color);
    var field = document.getElementById(id);
    field.innerHTML = color;
//  field.style.background = color;
}
SimpleColorPicker.changeColorBackground = function(id,color){
    color = this.colorWithSharp(color);
    var field = document.getElementById(id);
    field.innerHTML = color;
    field.style.background = color;
}
SimpleColorPicker.init = function(form,tag,initcolor,reversal,colorswitch){
    this.form = form;
    this.tag  = tag;
    this.initcolor = initcolor;
    this.reversal = reversal;
    this.colorswitch = colorswitch;
}
SimpleColorPicker.setXY = function(x,y){
    var wpallet = document.getElementById(this.window_id);
    wpallet.style.left = x + "px";
    wpallet.style.top  = y + "px";
}
SimpleColorPicker.openPallet = function(){
    var wpallet = document.getElementById(this.window_id);
    if(typeof(Effect)!='undefined'){
        wpallet.style.display = "none";
        wpallet.style.visibility = "visible";
        new Effect.Appear(this.window_id,{duration:SimpleColorPicker.duration});
    }else{
        wpallet.style.display = "block";
        wpallet.style.visibility = "visible";
    }
}
SimpleColorPicker.closePallet = function(doFocus){
    if(typeof(Effect)!='undefined'){
        new Effect.Fade(this.window_id,{
                duration: SimpleColorPicker.duration,
                afterFinish: function(effect){
                    SimpleColorPicker._closePallet(doFocus);
                }
            });
    }else{
        SimpleColorPicker._closePallet(doFocus);
    }
}
SimpleColorPicker._closePallet = function(doFocus){
    var wpallet = document.getElementById(this.window_id);
    wpallet.style.display = "none";
    wpallet.style.visibility = "hidden";
    if(!!doFocus){
        var Obj = this.getTextareaObject(this.form);
        Obj.focus();
    }
}
SimpleColorPicker.drawSafePallet = function(form,tag){
    var wpallet = document.getElementById(this.window_id);
    wpallet.innerHTML = this.drawSafeColorTable(form,tag);
}
SimpleColorPicker.drawPallet = function(form,tag){
    var wpallet = document.getElementById(this.window_id);
    wpallet.innerHTML = this.drawColorTable(form,tag);
}
SimpleColorPicker.drawOrderSafePallet = function(form,tag){
    var wpallet = document.getElementById(this.window_id);
    wpallet.innerHTML = this.drawOrderSafeColorTable(form,tag);
}
SimpleColorPicker.callback = function(color){
    color = this.colorWithSharp(color);
    if(this.isWindowOpen()){
        this.closePallet(false);
    }
    insertBBCode(this.form,this.tag,color);
}
SimpleColorPicker.isWindowOpen = function(){
    var wpallet = document.getElementById(this.window_id);
    return (wpallet.style.visibility == "visible");
}
SimpleColorPicker.getTextareaObject = function(formObj){
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
