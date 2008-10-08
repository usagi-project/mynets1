function MM_preloadImages() {
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_openBrWindow(theURL,winName,features)
{ //v2.0
  window.open(theURL,winName,features);
}

function get_mode() {
    var mode;
    if (window.opera){
        mode = 4;
    }
    else if (navigator.appName == 'Microsoft Internet Explorer') {
        if (navigator.platform == 'MacPPC') {
            mode = 4;
        }
        else {
            mode = 2;
        }
    }
    else if (navigator.userAgent.indexOf('Safari') != -1) {
            mode = 4;
    }
    else if (navigator.appName == 'Netscape') {
        if (navigator.platform == 'MacPPC') {
            mode = 4;
        }
        else {
            mode = 1;
        }
    }
    else if (navigator.userAgent.indexOf('Firefox') != -1) {
        mode = 1;
    }
    else if (navigator.userAgent.indexOf('Netscape') != -1) {
        mode = 1;
    }
    else if (navigator.userAgent.indexOf('Gecko') != -1) {
        mode = 1;
    }
    else {
        mode = 4;
    }
    return mode;
}

function make_tag(str, stag, etag) {
    var mode = get_mode();
    if (mode == 1 || mode == 4) {
        var bl1 = str.value.substring(0, str.selectionStart);
        var bl2 = str.value.substring(str.selectionStart, str.selectionEnd);
        var bl3 = str.value.substring(str.selectionEnd, str.value.length);
        str.value = bl1 + stag + bl2 + etag + bl3;
    }
    else if (mode == 2) {
        str.focus();
        var sel = document.selection.createRange();
        var rang = str.createTextRange();
        rang.moveToPoint(sel.offsetLeft,sel.offsetTop);
        rang.moveEnd("textedit");
        if(rang.text.replace(/\r/g,"").length != 0){
            var las = (str.value.match(/(\r\n)*$/),RegExp.lastMatch.length);
            var Start = str.value.length - (rang.text.length + las);
            var End = Start + sel.text.length;
            var Start2 = str.value.replace(/\r/g,"").length - (rang.text.replace(/\r/g,"").length + las/2);
            var bl1 = str.value.substring(0, Start);
            var bl2 = str.value.substring(Start, End);
            var bl3 = str.value.substring(End, str.value.length);
            str.value = bl1 + stag + bl2 + etag + bl3;
            var End2 = (Start2 + stag.length + bl2.length + etag.length) - str.value.replace(/\r/g,"").length;
            rang.moveStart("character",Start2);
            rang.moveEnd("character",End2);
        }else{
            rang.moveToPoint(sel.offsetLeft,sel.offsetTop);
            rang.text = stag + etag;
            rang.moveStart("character",-(stag.length + etag.length));
        }
        rang.select();
    }
    else if (mode == 3) {
        str.value = stag + str.value + etag;
    }
    else {
        str.value += stag + etag;
    }
    return;
}

function add_link(str) {
    var url = prompt('リンク先URLを記入してください。テキストをドラッグして選択すると、自動的にそのテキストに対してリンクされます。', 'http://');
    if (!url) {
        return;
    }
    else {
        var stag = '[url=' + url + ']';
        var etag = '[/url]';
        make_tag(str, stag, etag);
    }
}

function add_tag(str, tag) {
    var stag = '['  + tag + ']';
    var etag = '[/' + tag + ']';
    make_tag(str, stag, etag);
}

function resize_font(str, size) {
    var stag = '[size=' + size + ']';
    var etag = '[/size]';
    make_tag(str, stag, etag);
}

function change_font_color(str, color) {
    var stag = '[color=' + color + ']';
    var etag = '[/color]';
    make_tag(str, stag, etag);
}

function change_marker_color(str, color) {
    var stag = '[marker=' + color + ']';
    var etag = '[/marker]';
    make_tag(str, stag, etag);
}

function swImg(iName,str)
{
        document.images[iName].src = str;
}

function swFormImg(name, url) {
    document.getElementById(name).src = url;
}

function is_macie() { return (navigator.appName == 'Microsoft Internet Explorer' && navigator.platform == 'MacPPC') ? 1 : 0 }

function setEvent(element, name, func, capture) {
    if (element.addEventListener) { element.addEventListener(name, func, capture);
    } else if (element.attachEvent) { element.attachEvent('on' + name, func); }
}

function addScript(url,charset){
  var script = document.createElement('script');
  script.setAttribute('type', 'text/javascript');
  script.setAttribute('src', url);
  script.setAttribute('charset', charset);
  document.getElementsByTagName('head').item(0).appendChild(script);
}

function addNews(html){
  document.getElementById('member_news_box').innerHTML = html;
}

function setSubmitTrue(element) { window.setTimeout(function() { element.disabled = true; }, 1) }
function setSubmitFalse(element) { window.setTimeout(function() { element.disabled = false; }, 5000) }
function setDisable(elements) {
    for (var i=0; i< elements.length; i++) {
        var element = elements[i];
        if (element.type == 'submit') {
            setSubmitTrue(element);
            setSubmitFalse(element);
        }
    }
}
function disableSubmit(elements) {
    for (var i=0; i<document.forms.length; ++i) {
        if (document.forms[i].onsubmit) continue;
        document.forms[i].onsubmit = function() {
            setDisable(this.elements);
        }
    }
}

setEvent(window,'load', disableSubmit, 0);

