<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable 
 *              to obtain it through the world-wide-web, please send a note to 
 *              license@php.net so we can mail you a copy immediately.  
 *
 * @category   Application of MyNETS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @authoe     Kazuo Ide [K&X inc.] UsagiProject
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<script src="../googlemapsapi.php" type="text/javascript"></script>

<script type="text/javascript">

<?php
echo 'var latp = ' . floatval($_GET['lat']) . ';';
echo 'var lngp = ' . floatval($_GET['lon']) . ';';
echo 'var zmp = ' . intval($_GET['zoom']) . ';';
echo 'var tp = ' . intval($_GET['type']) . ';';
?>

var map;
var marker;
var point;

//ストリートビュー設定
var maxdiv = document.createElement('div');
maxdiv.style.width = "300px";
maxdiv.style.height = "200px";
var dummy;
var svp = null;
var svc = new GStreetviewClient();
var svm = null;
var before_drag;
var hlng;
var svicon = new GIcon();
svicon.image = "http://maps.google.co.jp/intl/ja_jp/mapfiles/cb/man_arrow-0.png";
svicon.transparent = "http://maps.google.com/intl/en_us/mapfiles/cb/man-pick.png";
svicon.iconSize = new GSize(49,52);
svicon.iconAnchor = new GPoint(25,35);
svicon.imageMap = [28,4, 28,35, 18,35, 18,4];
svicon.infoWindowAnchor = new GPoint(25, 1);

window.onload = function() {

    map = new GMap2(document.getElementById("gmap"));
    point = new GLatLng(latp,lngp);
    map.setCenter(point, zmp);
    map.setMapType(map.getMapTypes()[tp]);
    map.enableDoubleClickZoom();
    map.enableContinuousZoom();
    map.addControl(new GMapTypeControl());
    var pos = new GControlPosition(G_ANCHOR_TOP_LEFT, new GSize(10, 20));
    map.addControl(new GSmallMapControl(), pos);
    map.addControl(new GScaleControl());
    marker = new GMarker(point);
    map.addOverlay(marker);
    svc.getNearestPanorama(point, svcheckcallback);

}

//ストリートビューがあった場合にオーバーレイ・イベントを追加
function svcheckcallback(d) {
    if(d.code == 200) {
        map.addOverlay(new GStreetviewOverlay());
        GEvent.addListener(
            marker,
            "click",
            function() {
                svc.getNearestPanorama(point, svccallback);
            }
        );
        GEvent.addListener(
            map,
            "infowindowclose",
            function() {
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
        if(svm == null) {
            svm = new GMarker(d.location.latlng,{icon:svicon, draggable:true, dragCrossMove:true});
            addDragEvent();
            map.addOverlay(svm);
        }
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

//投稿位置情報に最も近い地点をインフォウィンドウへ表示・マンマーカーをプロット
function svccallback(d) {
    if(d.code == 200) {
        svm.setPoint(d.location.latlng);
        maxdiv.innerHTML = '<div style="padding:5px;text-align:center"><img src="../skin/default/img/loading.gif"></div>';
        svm.openInfoWindowHtml(maxdiv);
        setTimeout(function(){svp = new GStreetviewPanorama(maxdiv,{latlng:d.location.latlng});addManEvent();checkchild();}, 500);
    } else {
        svm.setPoint(before_drag);
        maxdiv.innerHTML = '<div style="padding:5px;text-align:center"><img src="../skin/default/img/loading.gif"></div>';
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

</script>

<style type="text/css">
body {
    margin: 0px ;
    padding: 0px ;
}
#gmap {
    border:#cccccc 1px solid;
}
</style>
</head>
<body onunload="GUnload()">
<div id="gmap" style="width: 99%; height: 398px"></div>
</body>
</html>
