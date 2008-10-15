//マップ初期位置と倍率（日本全図）設定
var latl = 37.5;
var lngl = 137.8233;
var zml = 5;

//各種グローバル変数定義
var map;
var latr;
var lngr;
var zmr;
var pointData = '';
var pointData2 = '';
var htmlm = new Array();
var htmlm2 = new Array();
var markers = new Array();
var markers2 = new Array();
var doneurl = new Array();
var coneurl = new Array();
var parray = new Array();
var pagekind = 'both';
var exflg = true;
var nicknames = new Array();
var d_title = new Array();
var cm_title = new Array();
var c_title = new Array();
var uri_type;
var uri_id;
var c_mode;

//マックスインフォウィンドウ用設定
var maxdiv2 = document.createElement('div');
if(/*@cc_on!@*/false) {
    maxdiv2.style.width = "96%";
} else {
    maxdiv2.style.width = "100%";
}
maxdiv2.style.height = "100%";
maxdiv2.style.padding = "10px 0";

//イメージウィンドウ用設定
var noimg = new Image();
noimg.src = "./skin/default/img/dummy.gif";
var d_viewpic180 = new Array();
var d_viewnum = 0;
var p_d_viewnum = 0;
var c_viewpic180 = new Array();
var c_viewnum = 0;
var p_c_viewnum = 0;

//ベースアイコン設定
var baseicon = new GIcon();
baseicon.shadow = "./skin/default/img/shadow50.png";
baseicon.iconSize = new GSize(20, 34);
baseicon.shadowSize = new GSize(37, 34);
baseicon.iconAnchor = new GPoint(10, 34);
baseicon.infoWindowAnchor = new GPoint(10, 0);

//ストリートビュー用設定
var maxdiv = document.createElement('div');
maxdiv.style.width = "450px";
maxdiv.style.height = "300px";
var existdv = new Array();
var existcv = new Array();
var svp = null;
var svc = new GStreetviewClient();
var svf = false;
var svm = null;
var svo = null;
var before_drag;
var dummy;
var hlng;
var svicon = new GIcon();
svicon.image = "http://maps.google.co.jp/intl/ja_jp/mapfiles/cb/man_arrow-0.png";
svicon.transparent = "http://maps.google.com/intl/en_us/mapfiles/cb/man-pick.png";
svicon.iconSize = new GSize(49,52);
svicon.iconAnchor = new GPoint(25,35);
svicon.imageMap = [28,4, 28,35, 18,35, 18,4];
svicon.infoWindowAnchor = new GPoint(25, 1);

//マップサイズ変更用ウィンドウリサイズのイベントリスナ追加
Event.observe(window, 'resize', extmap2, false);
function extmap2() {
    if($('zmbtn') && $('zmbtn').src.indexOf('minus',0) != -1 && exflg) {
        if(!document.all && (document.layers || $)) {
            w=window.innerWidth-20;
            if(window.innerWidth-20 < 713) {
                w = 713;
            } else {
                w=window.innerWidth-20;
            }
        } else {
            if($ && (document.compatMode=='CSS1Compat')) {
                if(document.documentElement.clientWidth <713) {
                    w = 713;
                } else {
                    w=document.documentElement.clientWidth;
                }
            } else {
                if(document.all) {
                    if(document.body.clientWidth < 713) {
                        w = 713;
                    } else {
                        w=document.body.clientWidth;
                    }
                }
            }
        }
        $('zmbtn').src = './skin/default/img/mapext_minus.gif';
        $('mapcnt').style.width = w + 'px';
        $('map').style.width = w-165 + 'px';
        map.checkResize();
        map.setCenter(new GLatLng(latl,lngl),zml);
    }
}

//マップ最大化コントロール定義
function zoomMapControl() {}
zoomMapControl.prototype = new GControl();
zoomMapControl.prototype.initialize = function(map) {
    var zoomMap = document.createElement("img");
    zoomMap.setAttribute("src", "./skin/default/img/mapext.gif");
    zoomMap.setAttribute("id", "zmbtn");
    this.setButtonStyle_(zoomMap);
    GEvent.addDomListener(
        zoomMap,
        "click",
        function() {
            extmap();
        }
    );
    map.getContainer().appendChild(zoomMap);
    return zoomMap;
}
zoomMapControl.prototype.getDefaultPosition = function() {
    return new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(0, 265));
}
zoomMapControl.prototype.setButtonStyle_ = function(button) {
    button.style.cursor = "pointer";
    button.style.height = "69px";
}

function extmap() {
    if($('zmbtn').src.indexOf('minus',0) == -1) {
        if(!document.all && (document.layers || $)) {
            w=window.innerWidth-20;
        } else {
            if($ && (document.compatMode=='CSS1Compat')) {
                w=document.documentElement.clientWidth;
            } else {
                if(document.all) {
                    w=document.body.clientWidth;
                }
            }
        }
        $('zmbtn').src = './skin/default/img/mapext_minus.gif';
        $('mapcnt').style.width = w + 'px';
        $('map').style.width = w-165 + 'px';
        map.checkResize();
        map.setCenter(new GLatLng(latl,lngl),zml);
    } else {
        $('zmbtn').src = './skin/default/img/mapext.gif';
        $('mapcnt').style.width = '713px';
        $('map').style.width = '548px';
        map.checkResize();
        map.setCenter(new GLatLng(latl,lngl),zml);
    }
}

//エリアサーチコントロール定義
function areaSearchControl() {}
areaSearchControl.prototype = new GControl();
areaSearchControl.prototype.initialize = function(map) {
    var areaSearch = document.createElement("div");
    this.setButtonStyle_(areaSearch);
    areaSearch.appendChild(document.createTextNode("現在の範囲で絞り込む"));
    GEvent.addDomListener(
        areaSearch,
        "click",
        function() {
            searcharea();
        }
    );
    map.getContainer().appendChild(areaSearch);
    return areaSearch;
}
areaSearchControl.prototype.getDefaultPosition = function() {
    return new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(69, 25));
}
areaSearchControl.prototype.setButtonStyle_ = function(button) {
    button.style.backgroundColor = "white";
    button.style.borderTop = "1px solid";
    button.style.borderLeft = "1px solid";
    button.style.borderRight = "2px ridge";
    button.style.borderBottom = "2px ridge";
    button.style.textAlign = "center";
    button.style.width = "140px";
    button.style.cursor = "pointer";
}

function searcharea() {
    var area = map.getBounds();
    var n = area.getNorthEast().lat();
    var s = area.getSouthWest().lat();
    var e = area.getNorthEast().lng();
    var w = area.getSouthWest().lng();
    url = './?m=pc&a=page_h_gmaps_list_data&area='+n+"_"+s+"_"+e+"_"+w;
    map.clearOverlays();
    uri_type = '';
    uri_id = '';
    uriopen();
    pagekind = 'both';
    loadData(url);
}

//マップリセットコントロール定義
function resetmapControl() {}
resetmapControl.prototype = new GControl();
resetmapControl.prototype.initialize = function(map) {
    var resetmap = document.createElement("div");
    this.setButtonStyle_(resetmap);
    resetmap.appendChild(document.createTextNode("リセット"));
    GEvent.addDomListener(
        resetmap,
        "click",
        function() {
            reset();
        }
    );
    map.getContainer().appendChild(resetmap);
    return resetmap;
}
resetmapControl.prototype.getDefaultPosition = function() {
    return new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(7, 25));
}
resetmapControl.prototype.setButtonStyle_ = function(button) {
    button.style.backgroundColor = "white";
    button.style.borderTop = "1px solid";
    button.style.borderLeft = "1px solid";
    button.style.borderRight = "2px ridge";
    button.style.borderBottom = "2px ridge";
    button.style.textAlign = "center";
    button.style.width = "58px";
    button.style.cursor = "pointer";
}

function reset() {
    map.clearOverlays();
    latl = 37.5;
    lngl = 137.8233;
    zml = 5;
    map.setCenter(new GLatLng(latl,lngl),zml,G_NORMAL_MAP);
    uri_type = '';
    uri_id = '';
    uriopen();
    pagekind = 'both';
    $("svol").checked = false;
    loadData('./?m=pc&a=page_h_gmaps_list_data&');
}

//マップオブジェクトロード
function loadMap() {
    //各種コントロール追加
    map = new GMap2($("map"));
    map.enableDoubleClickZoom();
    map.enableContinuousZoom();
    map.addControl(new GLargeMapControl());
    map.addControl(new GMapTypeControl());
    map.addControl(new GScaleControl());
    map.addControl(new areaSearchControl());
    map.addControl(new resetmapControl());
    map.addControl(new zoomMapControl());

    var mapsearch = new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(10,45));
    mapsearch.apply($("mapsearch"));
    $("mapsearch").style.display = "block";
    map.getContainer().appendChild($("mapsearch"));

    var viewwindow = new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(10,30));
    viewwindow.apply($("viewwindow"));
    $("viewwindow").style.display = "block";
    $("d_viewwindow").style.display = "block";
    $("svcheckbox").style.display = "block";
    map.getContainer().appendChild($("viewwindow"));

    //各種イベントリスナ追加
    GEvent.addListener(
        map,
        'zoomend',
        function(oldZoomLevel,newZoomLevel) {
            zml = newZoomLevel;
        }
    );
    GEvent.addListener(
        map,
        'moveend',
        function() {
            xy = map.getCenter();
            latl = xy.lat();
            lngl = xy.lng();
        }
    );

    GEvent.addListener(
        map,
        "infowindowclose",
        function() {
            $("mapsearch").style.display="block";
            $("viewwindow").style.display="block";
            if(svm != null) {
                //IEでのエラー回避のためダミーエレメントを設置
                if(svp != null) {
                    svp.remove();
                    svp = null;
                }
                makedummy();
            }
        }
    );

    GEvent.addListener(
        map.getInfoWindow(),
        "maximizeend",
        function() {
            $("mapsearch").style.display="none";
            $("viewwindow").style.display="none";
            maxInfoWindow();
        }
    );

    GEvent.addListener(
        map.getInfoWindow(),
        "restoreend",
        function() {
            $("mapsearch").style.display="block";
            $("viewwindow").style.display="block";
        }
    );

    map.setCenter(new GLatLng(latl,lngl),zml,G_NORMAL_MAP);
}

//マーカーに応じて表示範囲を最適化
function initZoom() {
    if(markers != "" || markers2 != "") {
        var list = [];
        var gb;
        var first = 1;
        list = markers.concat(markers2);
        for(i=0;i<list.length;i++) {
            if(list[i]){
                var marker = list[i];
                if(first){
                    gb = new GLatLngBounds(marker.getPoint(),marker.getPoint());
                    first = 0;
                }else{
                    var point = marker.getPoint();
                    gb.extend(point);
                }
            }
        }
        map.setCenter(gb.getCenter(),map.getBoundsZoomLevel(gb));
    }
}

//イメージウィンドウ操作
function d_vrmove() {
    p_d_viewnum = d_viewnum;//1個前のナンバーを記録
    d_viewnum++;
    if(d_viewnum == pointData.length) {
        d_viewnum = 0;
    }
    d_opr(true);
}

function d_vlmove() {
    p_d_viewnum = d_viewnum;//1個前のナンバーを記録
    d_viewnum--;
    if(d_viewnum == -1) {
        d_viewnum = pointData.length-1;
    }
    d_opr(true);
}

function d_opr(flg) {
    if(pointData != "") {
        listSelectedm(d_viewnum);//インフォウィンドウオープン
        d_viewfocus();//カレントウィンドウを日記に設定
        if(pointData[d_viewnum].img == "") {
            $("d_noimg").style.display = "block";
            $("d_viewcell").innerHTML = "<img id='d_viewitem'>";
        } else {
            $("d_noimg").style.display = "none";
            $("d_viewcell").innerHTML = "<a href='./img.php?filename=" + pointData[d_viewnum].img + "' target='_blank'><img id='d_viewitem'></a>";
        }
        $("d_viewitem").src = d_viewpic180[d_viewnum].src;//ビューウィンドウに画像を表示
        $("d_list_" + p_d_viewnum).style.backgroundColor = "";//1個前のマーカーリストのバックグラウンドを初期化
        if($("c_list_" + c_viewnum)) {
            $("c_list_" + c_viewnum).style.backgroundColor = "";//コミュのカレントマーカーリストのバックグラウンドを初期化
        }
        $("d_list_" + d_viewnum).style.backgroundColor = "#FFFF99";//カレントのマーカーリストのバックグラウンドをハイライト
        if(flg) {
            $("d_page").scrollTop = getpos("d_list_" + d_viewnum)-304;//カレントのマーカーリスト位置までスクロール
        }
    }
}

function d_viewfocus() {
    $('c_viewwindow').style.display='none';
    $('d_viewwindow').style.display='block';
}

function c_vrmove() {
    p_c_viewnum = c_viewnum;//1個前のナンバーを記録
    c_viewnum++;
    if(c_viewnum == pointData2.length) {
        c_viewnum = 0;
    }
    c_opr(true);
}

function c_vlmove() {
    p_c_viewnum = c_viewnum;//1個前のナンバーを記録
    c_viewnum--;
    if(c_viewnum == -1) {
        c_viewnum = pointData2.length-1;
    }
    c_opr(true);
}

function c_opr(flg) {
    if(pointData2 != "") {
        listSelected2m(c_viewnum);//インフォウィンドウオープン
        c_viewfocus();//カレントウィンドウをコミュに設定
        if(pointData2[c_viewnum].img == "") {
            $("c_noimg").style.display = "block";
            $("c_viewcell").innerHTML = "<img id='c_viewitem'>";
        } else {
            $("c_noimg").style.display = "none";
            $("c_viewcell").innerHTML = "<a href='./img.php?filename=" + pointData2[c_viewnum].img + "' class='thickbox' target='_blank'><img id='c_viewitem'></a>";
        }
        $("c_viewitem").src = c_viewpic180[c_viewnum].src;//ビューウィンドウに画像を表示
        $("c_list_" + p_c_viewnum).style.backgroundColor = "";//1個前のマーカーリストのバックグラウンドを初期化
        if($("d_list_" + d_viewnum)) {
            $("d_list_" + d_viewnum).style.backgroundColor = "";//日記のカレントマーカーリストのバックグラウンドを初期化
        }
        $("c_list_" + c_viewnum).style.backgroundColor = "#FFFF99";//カレントのマーカーリストのバックグラウンドをハイライト
        if(flg) {
            $("c_page").scrollTop = getpos("c_list_" + c_viewnum)-614;//カレントのマーカーリスト位置までスクロール
        }
    }
}

function c_viewfocus() {
    $('c_viewwindow').style.display='block';
    $('d_viewwindow').style.display='none';
}

function getpos(element) {
    var offsetTrail = $(element);
    var offsetTop = 0;
    while (offsetTrail) {
        offsetTop += offsetTrail.offsetTop;
        offsetTrail = offsetTrail.offsetParent;
    }

    if (navigator.userAgent.indexOf('Mac') != -1 && typeof document.body.leftMargin != "undefined") {
        offsetTop += document.body.topMargin;
    }

    return offsetTop;
}

//マーカー初期化
function initMarker() {
    //var manager = new GMarkerManager(map);
    markers = [];
    markers2 = [];
    if(d_total_num == 'トータル数[0]件') {
        $("d_page").innerHTML = "";
    } else {
        var i;
        var str = '';
        for (i=0;i<pointData.length;i++) {
            if(!isNaN(pointData[i].zoom) && !isNaN(pointData[i].lon) && !isNaN(pointData[i].lat)) {
                var marker = plotById(i);
                map.addOverlay(marker);
                str += makeList(i);
                d_viewpic180[i] = new Image();
                d_viewpic180[i].src = makeimg(pointData[i].img);
                //manager.addMarker(marker,0);
            }
        }
        str = "<div style='text-align:left;padding:5px;'><ol>" + str + "</ol></div>";
        $("d_page").innerHTML = str;
    }

    if(c_total_num == 'トータル数[0]件') {
        $("c_page").innerHTML = "";
    } else {
        var j;
        var str = '';
        for (j=0;j<pointData2.length;j++) {
            if(!isNaN(pointData2[j].zoom) && !isNaN(pointData2[j].lon) && !isNaN(pointData2[j].lat)) {
                var marker = plotById2(j);
                map.addOverlay(marker);
                str += makeList2(j);
                c_viewpic180[j] = new Image();
                c_viewpic180[j].src = makeimg(pointData2[j].img);
                //manager.addMarker(marker,0);
            }
        }
        str = "<div style='text-align:left;padding:5px;'><ol>" + str + "</ol></div>";
        $("c_page").innerHTML = str;
    }
}

//イメージ読み込み
function makeimg(img) {
    if(img) {
        return './img.php?filename='+ img +'&w=180&h=180';
    } else {
        return noimg.src;
    }
}

//マーカー作成
function plotById(id) {
    if(pointData[id].oneid == 'top') {
        doneurl[id] = './?m=pc&a=page_h_gmaps_diary&target_c_diary_id='+pointData[id].inid+'&url='+encodeURIComponent(pointData[id].url);
    } else {
        doneurl[id] = './?m=pc&a=page_h_gmaps_diary_comment&target_c_diary_comment_id='+pointData[id].oneid+'&url='+encodeURIComponent(pointData[id].url);
    }
    htmlm[id] = makeInfom(id);
    var icon = new GIcon(baseicon);
    icon.image = "./gmaps/gmicons/icong" + (id+1) + ".png";
    var marker = new GMarker(new GPoint(pointData[id].lon, pointData[id].lat),{icon:icon,title:(id+1) + ' > ' + pointData[id].info});
    GEvent.addListener(
        marker,
        "click",
        function() {
            p_d_viewnum = d_viewnum;d_viewnum = id;d_opr(true);
        }
    );
    markers[id] = marker;
    return marker;
}

function plotById2(id) {
    coneurl[id] = './?m=pc&a=page_h_gmaps_topic&target_c_topic_comment_id='+pointData2[id].oneid+'&url='+encodeURIComponent(pointData2[id].url);
    htmlm2[id] = makeInfo2m(id);
    var icon = new GIcon(baseicon);
    icon.image = "./gmaps/gmicons/iconr" + (id+1) + ".png";
    var marker = new GMarker(new GPoint(pointData2[id].lon, pointData2[id].lat),{icon:icon,title:(id+1) + ' > ' + pointData2[id].info});
    GEvent.addListener(
        marker,
        "click",
        function() {
            p_c_viewnum = c_viewnum;c_viewnum = id;c_opr(true);
        }
    );
    markers2[id] = marker;
    return marker;
}

//インフォウィンドウ内容作成
function makeInfom(i) {
    var nickname = pointData[i].nickname;
    var mid = pointData[i].mid;
    var info = pointData[i].info;
    var note = pointData[i].note;
    var date = pointData[i].date;
    var url = pointData[i].url;
    var inid = pointData[i].inid;
    var id = i;
    if(nicknames[mid] == undefined) {
        nicknames[mid] = nickname;
    }
    if(d_title[inid] == undefined) {
        d_title[inid] = pointData[i].title;
    }
    var npoint = '<span id=\'d' + id + '\'>&nbsp;<img src="./skin/default/img/icon_arrow_1.gif" align="absmiddle"><a href=\'javascript:void(0);\' onclick=\'listSelected('+id+');return false;\'>作成時の倍率で表示</a></span>';
    var rpoint = '<span id=\'rd' + id + '\'>&nbsp;<img src="./skin/default/img/icon_arrow_1.gif" align="absmiddle"><a href=\'javascript:void(0);\' onclick=\'rv('+id+');return false;\'>前に戻る</a></span>';
    var html = "<div style='width:280px;line-height:150%;font-size:9pt;font-family:sans-serif;text-align:left;'><div style='border-bottom:#cccccc 1px solid;'><span style='font-weight:bold;color:#60E060;'>■日記</span>"+rpoint+npoint+"</div>";
    html += "<div style='padding:5px 0;'><span style='font-weight:bold;'>"+(i+1)+"</span><img src='./skin/dummy.gif' style='width:14px;height:14px;' class='icon icon_1'>" + date + "<br>" + nickname + "&nbsp;<img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onclick='mindiv("+mid+");return false;'>メンバーで絞り込む</a></div><div style='font-weight:bold;'><a href='javascript:void(0);' onclick='map.getInfoWindow().maximize();return false;'>" + info + "</a></div><div>" + note + "<br><img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='" + url + "' target='_blank'>コメントをする</a></div>";
    html += "<div style='text-align:right;clear:both;'><div style='margin-top:3px;padding-top:3px;border-top:#cccccc 1px solid;'><img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onclick='indiv(\"d_page\","+inid+");return false;'>この日記で絞り込む</a><div style='padding:3px 0;'><span id='svd" + id + "'><img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onclick='showsv();return false;'>ストリートビュー</a>&nbsp;</span><img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onclick='map.getInfoWindow().maximize();return false;'>全文を見る</a></div></div></div>";
    return html + "</div>";
}

function makeInfo2m(i) {
    var nickname = pointData2[i].nickname;
    var mid = pointData2[i].mid;
    var info = pointData2[i].info;
    var note = pointData2[i].note;
    var date = pointData2[i].date;
    var url = pointData2[i].url;
    var cmid = pointData2[i].cmid;
    var inid = pointData2[i].inid;
    var id = i;
    if(nicknames[mid] == undefined) {
        nicknames[mid] = nickname;
    }
    if(cm_title[cmid] == undefined) {
        cm_title[cmid] = pointData2[i].cmtitle;
    }
    if(c_title[inid] == undefined) {
        c_title[inid] = pointData2[i].title;
    }
    var npoint = '<span id=\'c' + id + '\'>&nbsp;<img src="./skin/default/img/icon_arrow_1.gif" align="absmiddle"><a href=\'javascript:void(0);\' onclick=\'listSelected2('+id+');return false\'>作成時の倍率で表示</a></span>';
    var rpoint = '<span id=\'rc' + id + '\'>&nbsp;<img src="./skin/default/img/icon_arrow_1.gif" align="absmiddle"><a href=\'javascript:void(0);\' onclick=\'rv2('+id+');return false;\'>前に戻る</a></span>';
    if(url.indexOf("event") != -1) {
        cname = "イベント";
    } else {
        cname = "トピック";
    }
    var html = "<div style='width:280px;line-height:150%;font-size:9pt;font-family:sans-serif;text-align:left;'><div style='border-bottom:#cccccc 1px solid;'><span style='font-weight:bold;color:#FD766A;'>■"+cname+"</span>"+rpoint+npoint+"</div>";
    html += "<div style='padding:5px 0;'><span style='font-weight:bold;'>"+(i+1)+"</span><img src='./skin/dummy.gif' style='width:14px;height:14px;' class='icon icon_2'>" + date + "<br>" + nickname + "&nbsp;<img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onclick='mindiv("+mid+");return false;'>メンバーで絞り込む</a></div><div style='font-weight:bold;'><a href='javascript:void(0);' onclick='map.getInfoWindow().maximize();return fasle;'>" + info + "</a></div><div>" + note + "<br><img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='" + url + "' target='_blank'>書き込みをする</a></div>";
    html += "<div style='text-align:right;clear:both;'><div style='margin-top:3px;padding-top:3px;border-top:#cccccc 1px solid;'><img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onclick='indiv(\"c_page\","+inid+");return false;'>この"+cname+"で絞り込む</a>&nbsp;<img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onclick='cmindiv("+cmid+");return false'>コミュで絞り込む</a><div style='padding:3px 0;'><span id='svc" + id + "'><img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onclick='showsv();return false;'>ストリートビュー</a>&nbsp;</span><img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onclick='map.getInfoWindow().maximize();return false;'>全文を見る</a></div></div></div>";
    return html + "</div>";
}

//マーカーリスト作成
function makeList(i) {
    var pre = "<li style='padding:3px 0;border-bottom:1px solid #cccccc;' id='d_list_" + i + "'><span style='font-weight:bold;'>";
    var pre2 = "</span><img src='./skin/dummy.gif' style='width:14px;height:14px;' class='icon icon_1'>";
    var mid = "<br><a href='javascript:void(0);' onclick='p_d_viewnum = d_viewnum;d_viewnum = " + i + ";d_opr(false);return false;'>";
    var tail = "</a>";
    return pre + (i+1) + pre2 + pointData[i].date + mid + pointData[i].info + tail + "（" + pointData[i].nickname + "）</li>";
}

function makeList2(j) {
    var pre = "<li style='padding:3px 0;border-bottom:1px solid #cccccc;' id='c_list_" + j + "'><span style='font-weight:bold;'>";
    var pre2 = "</span><img src='./skin/dummy.gif' style='width: 14px; height: 14px;' class='icon icon_2'>";
    var mid = "<br><a href='javascript:void(0);' onclick='p_c_viewnum = c_viewnum;c_viewnum = " + j + ";c_opr(false);return false;'>";
    var tail = "</a>";
    return pre + (j+1) + pre2 + pointData2[j].date + mid + pointData2[j].info + tail + "（" + pointData2[j].nickname + "）</li>";
}

//マックスウィンドウへ該当コンテンツをロード
function maxInfoWindow() {
    maxdiv2.innerHTML = '<div style="padding:5px;text-align:center"><img src="./skin/default/img/loading.gif"></div>';
    if(c_mode == 1) {
        GDownloadUrl(doneurl[d_viewnum], function(data) {
            maxdiv2.innerHTML = data;
        });
    } else {
        GDownloadUrl(coneurl[c_viewnum], function(data) {
            maxdiv2.innerHTML = data;
        });
    }
}

function showsv() {
    if(c_mode == 1) {
        svc.getNearestPanorama(new GLatLng(pointData[d_viewnum].lat, pointData[d_viewnum].lon), svccallback);
    } else {
        svc.getNearestPanorama(new GLatLng(pointData2[c_viewnum].lat, pointData2[c_viewnum].lon), svccallback);
    }
}

//投稿位置情報に最も近い地点をインフォウィンドウへ表示・マンマーカーをプロット
function svccallback(d) {
    if(svm == null) {
        svm = new GMarker(d.location.latlng,{icon:svicon, draggable:true, dragCrossMove:true});
        addDragEvent();
        map.addOverlay(svm);
    }
    if(d.code == 200) {
        svm.setPoint(d.location.latlng);
        maxdiv.innerHTML = '<div style="padding:5px;text-align:center"><img src="./skin/default/img/loading.gif"></div>';
        svm.openInfoWindowHtml(maxdiv);
        setTimeout(function(){svp = new GStreetviewPanorama(maxdiv,{latlng:d.location.latlng});addManEvent();checkchild();}, 500);
    } else {
        svm.setPoint(before_drag);
        maxdiv.innerHTML = '<div style="padding:5px;text-align:center"><img src="./skin/default/img/loading.gif"></div>';
        svm.openInfoWindowHtml(maxdiv);
        setTimeout(function(){svp = new GStreetviewPanorama(maxdiv,{latlng:before_drag});addManEvent();checkchild();}, 500);
    }
}

function checkchild() {
    if(maxdiv.childNodes[0].id != "") {
        dummy = maxdiv.childNodes[0].id;
    } else {
        setTimeout(function(){checkchild();}, 10);
    }
}

//ストリートビューの有無を判定
function svtextcallback(d) {
    if(d.code == 200) {
        if(c_mode == 1) {
            existdv[d_viewnum] = 0;
        } else {
            existcv[c_viewnum] = 0;
        }
    } else {
        if(c_mode == 1) {
            existdv[d_viewnum] = 1;
        } else {
            existcv[c_viewnum] = 1;
        }
        hide_sv();
    }
}

//IEでのエラー回避のためダミーエレメントを設置
function makedummy() {
    if(dummy != undefined && document.getElementById(dummy) == null) {
        var panoflash = document.createElement('div');
        panoflash.id = dummy;
        panoflash.style.display = "none";
        document.getElementsByTagName("body").item(0).appendChild(panoflash);
        panoflash.SetReturnValue = function(){};
    }
    removedummy();
}

//ダミーエレメントを削除
function removedummy() {
    if(dummy != undefined) {
        var panonumber = parseInt(dummy.replace("panoflash", "")) - 1;
        var prevdummy = 'panoflash' + panonumber;
        if(document.getElementById(prevdummy) != null) {
            document.getElementsByTagName("body").item(0).removeChild(document.getElementById(prevdummy));
        }
    }
}

//ストリートビューオーバーレイ表示
function cheksvol() {
    if($('svol').checked) {
        if(svo == null) {
            svo = new GStreetviewOverlay();
            map.addOverlay(svo);
        }
    } else {
        if(svo != null) {
            map.removeOverlay(svo);
            svo = null;
        }
    }
}

//マンマーカー移動イベント登録
function addManEvent() {
    GEvent.addListener(
        svp,
        "initialized",
        function(loc) {
            if(svm != null) {
                var xl = Math.pow(2,map.getZoom()-16);
                var xl_lat = 0.0028/xl;
                var xl_lng = 0.001/xl;
                var offset_lat = loc.latlng.lat() + xl_lat;
                var offset_lng = loc.latlng.lng() + xl_lng;
                svm.setPoint(loc.latlng);
                map.panTo(new GLatLng(offset_lat,offset_lng));
                map.getInfoWindow().reposition(loc.latlng, new GSize(0,-35));
            }
        }
    );

    GEvent.addListener(
        svp,
        "yawchanged",
        function(yaw) {
            var dir = Math.round(yaw/22.5);
            svicon.image = "http://maps.google.co.jp/intl/ja_jp/mapfiles/cb/man_arrow-" + dir + ".png";
            if(svm != null) {
                svm.setImage(svicon.image);
            }
        }
    );
}

//ドラッグイベント登録
function addDragEvent() {
    GEvent.addListener(
        svm,
        "dragstart",
        function() {
            map.closeInfoWindow();
            before_drag = svm.getPoint();
            svicon.image = "http://maps.google.co.jp/intl/ja_jp/mapfiles/cb/man-0.png";
            if(svm != null) {
                svm.setImage(svicon.image);
            }
        }
    );
    GEvent.addListener(
        svm,
        "drag",
        function() {
            if (!hlng || hlng < svm.getLatLng().lng()) {
                svicon.image = "http://www.google.co.jp/intl/ja_jp/mapfiles/cb/man_fly_right.png";
                if(svm != null) {
                    svm.setImage(svicon.image);
                 }
            } else if (hlng > svm.getLatLng().lng()) {
                svicon.image = "http://www.google.co.jp/intl/ja_jp/mapfiles/cb/man_fly_left.png";
                if(svm != null) {
                    svm.setImage(svicon.image);
                }
            }
            hlng = svm.getLatLng().lng();
        }
    );
    GEvent.addListener(
        svm,
        "dragend",
        function() {
            svicon.image = "http://maps.google.co.jp/intl/ja_jp/mapfiles/cb/man_arrow-0.png";
            if(svm != null) {
                svm.setImage(svicon.image);
            }
            svc.getNearestPanorama(svm.getPoint(), svccallback);
        }
    );
    GEvent.addListener(
        svm,
        "click",
        function() {
            if(svp == null) {
                svc.getNearestPanorama(svm.getPoint(), svccallback);
            }
        }
    );
}

//ストリートビューリンクが構築されるまでリカーシブに呼び出しストリートビューリンクを消去
function hide_sv() {
    if(c_mode == 1) {
        if($('svd' + d_viewnum)) {
            $('svd' + d_viewnum).style.display = 'none';
        } else {
            window.setTimeout(function() {
                hide_sv();
            }, 10);
        }
    } else {
        if($('svc' + c_viewnum)) {
            $('svc' + c_viewnum).style.display = 'none';
        } else {
            window.setTimeout(function() {
                hide_sv();
            }, 10);
        }
    }
}

//作成時の倍率で表示リンクが構築されるまでリカーシブに呼び出し作成時の倍率で表示リンクを消去
function hide_zm() {
    if(c_mode == 1) {
        if($('d' + d_viewnum)) {
            $('d' + d_viewnum).style.display = 'none';
        } else {
            window.setTimeout(function() {
                hide_zm();
            }, 10);
        }
    } else {
        if($('c' + c_viewnum)) {
            $('c' + c_viewnum).style.display = 'none';
        } else {
            window.setTimeout(function() {
                hide_zm();
            }, 10);
        }
    }
}

//元に戻るリンクが構築されるまでリカーシブに呼び出し元に戻るリンクを消去
function hide_rt() {
    if(c_mode == 1) {
        if($('rd' + d_viewnum)) {
            $('rd' + d_viewnum).style.display = 'none';
        } else {
            window.setTimeout(function() {
                hide_rt();
            }, 10);
        }
    } else {
        if($('rc' + c_viewnum)) {
            $('rc' + c_viewnum).style.display = 'none';
        } else {
            window.setTimeout(function() {
                hide_rt();
            }, 10);
        }
    }
}

//作成時の位置のみでマーカー表示
function listSelectedm(id) {
        markers[id].openInfoWindowHtml(htmlm[id], {maxContent: maxdiv2, maxTitle: '<b>' + pointData[id].info + '</b>'});
        map.panTo(new GLatLng(pointData[id].lat, pointData[id].lon));
        c_mode = 1;
        if(existdv[id] == undefined) {
            svc.getNearestPanorama(new GLatLng(pointData[id].lat, pointData[id].lon), svtextcallback);
        } else if(existdv[id] == 1) {
            hide_sv();
        }
        if(pointData[id].zoom == zml) {
            hide_zm();
        }
        hide_rt();
}

function listSelected2m(id) {
        markers2[id].openInfoWindowHtml(htmlm2[id], {maxContent: maxdiv2, maxTitle: '<b>' + pointData2[id].info + '</b>'});
        map.panTo(new GLatLng(pointData2[id].lat, pointData2[id].lon));
        c_mode = 2;
        if(existcv[id] == undefined) {
            svc.getNearestPanorama(new GLatLng(pointData2[id].lat, pointData2[id].lon), svtextcallback);
        } else if(existcv[id] == 1) {
            hide_sv();
        }
        if(pointData2[id].zoom == zml) {
            hide_zm();
        }
        hide_rt();
}

//作成時の位置・倍率でマーカー表示
function listSelected(id) {
        addllz();
        map.setCenter(new GLatLng(pointData[id].lat, pointData[id].lon), parseInt(pointData[id].zoom));
        markers[id].openInfoWindowHtml(htmlm[id], {maxContent: maxdiv2, maxTitle: '<b>' + pointData[id].info + '</b>'});
        if(existdv[id] == undefined) {
            svc.getNearestPanorama(new GLatLng(pointData[id].lat, pointData[id].lon), svtextcallback);
        } else if(existdv[id] == 1) {
            hide_sv();
        }
        $('d'+id).style.display='none';
}

function listSelected2(id) {
        addllz();
        map.setCenter(new GLatLng(pointData2[id].lat, pointData2[id].lon), parseInt(pointData2[id].zoom));
        markers2[id].openInfoWindowHtml(htmlm2[id], {maxContent: maxdiv2, maxTitle: '<b>' + pointData2[id].info + '</b>'});
        if(existcv[id] == undefined) {
            svc.getNearestPanorama(new GLatLng(pointData2[id].lat, pointData2[id].lon), svtextcallback);
        } else if(existcv[id] == 1) {
            hide_sv();
        }
        $('c'+id).style.display='none';
}

//マーカーの位置と倍率を記録
function addllz() {
    latr=map.getCenter().lat();
    lngr=map.getCenter().lng();
    zmr=map.getZoom();
}

//マーカーを前の位置と倍率で表示
function rv(id) {
    map.setCenter(new GLatLng(latr,lngr),zmr);
    markers[id].openInfoWindowHtml(htmlm[id], {maxContent: maxdiv2, maxTitle: '<b>' + pointData[id].info + '</b>'});
    if(existdv[id] == undefined) {
        svc.getNearestPanorama(new GLatLng(pointData[id].lat, pointData[id].lon), svtextcallback);
    } else if(existdv[id] == 1) {
        hide_sv();
    }
    $('rd'+id).style.display='none';
}

function rv2(id) {
    map.setCenter(new GLatLng(latr,lngr),zmr);
    markers2[id].openInfoWindowHtml(htmlm2[id], {maxContent: maxdiv2, maxTitle: '<b>' + pointData2[id].info + '</b>'});
    if(existcv[id] == undefined) {
        svc.getNearestPanorama(new GLatLng(pointData2[id].lat, pointData2[id].lon), svtextcallback);
    } else if(existcv[id] == 1) {
        hide_sv();
    }
    $('rc'+id).style.display='none';
}

//ナビゲーション初期化
function openPoint() {
    ckary = document.cookie.split("; ");
    ckstr = "";
    i = 0;
    for(i=0; i<ckary.length; i++) {
        if (ckary[i].substr(0,7) == "parray=") {
            eval(ckary[i]);
        }
    }
    buildpoint = "";
    if(parray) {
        for (i=0; i<parray.length; i++) {
            buildpoint += '<span id="c'+parray[i].id+'">&nbsp;|&nbsp;<input type="checkbox" class="no_bg" value="c'+parray[i].id+'" id="'+parray[i].id+'">&nbsp;<a href="javaScript:void(0)" onclick="reSize('+parray[i].lat+','+parray[i].lng+','+parray[i].zm+');return false;">'+decodeURIComponent(parray[i].pname)+'</a></span>';
        }
        $('mapnavi').innerHTML += buildpoint;
    }
}

//ナビゲーションの登録地点へ移動
function reSize(relat,relng,rezoom) {
    map.setCenter(new GLatLng(relat,relng),rezoom);
}

//ナビゲーションに新規地点を登録
function addPoint() {
    pointname = $('pname').value;
    if(pointname == '') {
        alert('ブックマーク名を入力してください');
    } else {
        if(parray.length > 9){
            alert('ブックマークは10か所までです');
        } else {
            id = (new Date()).getTime();
            $('mapnavi').innerHTML += '<span id="c'+id+'">&nbsp;|&nbsp;<input type="checkbox" class="no_bg" value="c'+id+'" id="'+id+'">&nbsp;<a href="javaScript:void(0)" onclick="reSize('+latl+','+lngl+','+zml+');return false;">'+pointname+'</a></span>';
            encpname = encodeURIComponent(pointname);
            parray.push({"id":id,"lat":latl,"lng":lngl,"zm":zml,"pname":encpname});
            recPoint();
        }
    }
}

//ナビゲーションから地点を削除
function deletePoint() {
    var flg = false;
    var parray2 = new Array();
    for(i=0; i<parray.length; i++) {
        var chkObj = $(parray[i].id + "");
        if (chkObj.checked) {
            $(chkObj.value).style.display = "none";
            flg = true;
        } else {
            parray2.push(parray[i]);
        }
    }
    if(flg) {
        parray = parray2;
        recPoint();
    } else {
        alert('削除するブックマークをチェックしてください');
    }
    delete parray2;
}

//ナビゲーションの登録地点をクッキーに保存
function recPoint() {
    if(parray.length != 0) {
        var cookiestr = 'parray=['
        for (i=0; i<parray.length; i++) {
            cookiestr += '{"id":"'+parray[i].id+'","lat":"'+parray[i].lat+'","lng":"'+parray[i].lng+'","zm":"'+parray[i].zm+'","pname":"'+parray[i].pname+'"},';
        }
        cookiestr = cookiestr.slice(0,-1);
        cookiestr += '];';
        document.cookie = cookiestr + "; expires=Thu, 1-Jan-2030 00:00:00 GMT";
    } else {
        document.cookie = "parray=; expires=Thu, 1-Jan-1970 00:00:00 GMT";
    }
}

//ページャ初期化
function initPager() {
        $("num1").innerHTML = d_total_num;
        $("pager1").innerHTML = d_page_link;
        $("num2").innerHTML = c_total_num;
        $("pager2").innerHTML = c_page_link;
}

//ページネーション
function pagenetion(keytype,pagetype,page) {
    if(pagetype) {
        pageq = '&' + pagetype + '=' + page;
    } else {
        pageq = '';
    }
    if($(keytype) && $(keytype).value) {
        keyq = '&' + $(keytype).value;
    } else {
        keyq = '';
    }
    url = './?m=pc&a=page_h_gmaps_list_data'+pageq+keyq;
    map.clearOverlays();
    pagekind = pagetype;
    loadData(url);
}

//マップ検索
function search(keyword) {
    url = './?m=pc&a=page_h_gmaps_list_data&keyword=' + encodeURIComponent(keyword);
    map.clearOverlays();
    uri_type = '';
    uri_id = '';
    uriopen();
    pagekind = 'both';
    loadData(url);
}

//日記・トピック・イベントで絞り込み
function indiv(pagetype,id,flag) {
    exflg = false;
    page = 1;
    pageq = '&' + pagetype + '=' + page;
    idq = '&' + pagetype + '_id=' + id;
    url = './?m=pc&a=page_h_gmaps_list_data'+pageq+idq;
    if(pagetype == 'd_page') {
        pointData2 = '';
        c_total_num = 'トータル数[0]件';
        c_page_link = '';
        uri_type = 'd';
        uri_id = id;
    } else {
        pointData = '';
        d_total_num = 'トータル数[0]件';
        d_page_link = '';
        uri_type = 'c';
        uri_id = id;
    }
    pagekind = 'both';
    if(flag) {
        return url;
    } else {
        map.clearOverlays();
        loadData(url);
    }
}

//日記・トピック・イベントで絞り込み
function cmindiv(cmid,flag) {
    exflg = false;
    pageq = '&c_page=1';
    cmidq = '&cm_page_id=' + cmid;
    url = './?m=pc&a=page_h_gmaps_list_data'+pageq+cmidq;
    pointData = '';
    d_total_num = 'トータル数[0]件';
    d_page_link = '';
    uri_type = 'cm';
    uri_id = cmid;
    pagekind = 'both';
    if(flag) {
        return url;
    } else {
        map.clearOverlays();
        loadData(url);
    }
}

//コミュで絞り込み
function mindiv(mid,flag) {
    exflg = false;
    midq = '&m_page_id=' + mid;
    url = './?m=pc&a=page_h_gmaps_list_data'+midq;
    uri_type = 'm';
    uri_id = mid;
    pagekind = 'both';
    if(flag) {
        return url;
    } else {
        map.clearOverlays();
        loadData(url);
    }
}

//マップ種別情報表示
function uriopen(type,id) {
    if(type && id) {
        if(type == 'm') {
            var uri_title = "<div style='font-weight:bold;'>" + nicknames[id] + "さんのマップ</div>" + domain + '?m=pc&a=page_h_gmaps_list_all&type=m_page&id=' + id;
        }
        if(type == 'cm') {
            var uri_title = "<div style='font-weight:bold;'>「" +cm_title[id] + "」のマップ</div>" + domain + '?m=pc&a=page_h_gmaps_list_all&type=cm_page&id=' + id;
        }
        if(type == 'd') {
            var uri_title = "<div style='font-weight:bold;'>「" +d_title[id] + "」のマップ</div>" + domain + '?m=pc&a=page_h_gmaps_list_all&type=d_page&id=' + id;
        }
        if(type == 'c') {
            var uri_title = "<div style='font-weight:bold;'>「" +c_title[id] + "」のマップ</div>" + domain + '?m=pc&a=page_h_gmaps_list_all&type=c_page&id=' + id;
        }
        $('uri').innerHTML = uri_title;
        $('uribox').style.display = "block";
    } else {
        $('uribox').style.display = "none";
    }
}

//マップデータロード
function loadData(url) {
    d_viewpic180 = [];
    c_viewpic180 = [];
    if(type && id) {
        if(type == 'cm_page') {
            url = cmindiv(id,true);
            uri_type = 'cm';
            uri_id = id;
        } else {
            if(type == 'm_page') {
                url = mindiv(id,true);
                uri_type = 'm';
                uri_id = id;
            } else {
                url = indiv(type,id,true);
                if(type == 'd_page') {
                    uri_type = 'd';
                } else {
                    uri_type = 'c';
                }
                uri_id = id;
            }
        }
        type = "";
        id = "";
        var all = true;
    }
    var options = {
        method : 'get',
        parameters : '',
        onFailure: function() { alert("通信に失敗しました"); },
        onComplete: function(res) {
            eval(res.responseText);
            if(d_total_num == 'トータル数[0]件') {
                pointData = '';
            }
            if(c_total_num == 'トータル数[0]件') {
                pointData2 = '';
            }
            if(url == './?m=pc&a=page_h_gmaps_list_data' || all) {
                loadMap();
                openPoint();
            }
            existdv = [];
            existcv = [];
            svm = null;
            svo = null;
            cheksvol();
            initMarker();
            initPager();
            if(url.indexOf('&area=',0) == -1 && url != './?m=pc&a=page_h_gmaps_list_data' && url != './?m=pc&a=page_h_gmaps_list_data&') {
                initZoom();
            }
            uriopen(uri_type,uri_id);
            if(pointData == "" && pointData2 == "") {
                $("viewwindow").style.display = "none";
            } else {
                $("viewwindow").style.display = "block";
                if(pagekind == 'both') {
                    p_d_viewnum = 0;
                    p_c_viewnum = 0;
                    d_viewnum = 0;
                    c_viewnum = 0;
                    if(pointData != "") {
                        d_opr(true);
                    } else {
                        c_opr(true);
                    }
                } else if(pagekind == 'd_page') {
                    p_d_viewnum = 0;
                    d_viewnum = 0;
                    d_opr(true);
                } else {
                    p_c_viewnum = 0;
                    c_viewnum = 0;
                    c_opr(true);
                }
            }
            exflg = true;
        }
    }
    new Ajax.Request(url, options);
}

Ajax.Responders.register({
    onCreate: function() {
        if(pagekind) {
            if(pagekind == 'both') {
                $('d_page').innerHTML = '<div style="padding:5px;text-align:center"><img src="./skin/default/img/loading.gif"></div>';
                $('c_page').innerHTML = '<div style="padding:5px;text-align:center"><img src="./skin/default/img/loading.gif"></div>';
            } else {
                $(pagekind).innerHTML = '<div style="padding:5px;text-align:center"><img src="./skin/default/img/loading.gif"></div>';
            }
        }
    }
});
