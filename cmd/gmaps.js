document.write('<script type="text/javascript" src="./gmapkey.php" id="scr"></script>');
var rnd = Math.floor(Math.random()*1000000);
function main(zoom,lat1,lat2,lon1,lon2,type) {
    if(type == null) {
        type = 0;
    }
    if(Number(zoom).toString()!='NaN' && 
       Number(lat1).toString()!='NaN' && 
       Number(lat2).toString()!='NaN' && 
       Number(lon1).toString()!='NaN' && 
       Number(lon2).toString()!='NaN' && 
       Number(type).toString()!='NaN') {
        
        document.write("<script>function showmap"+lat2+lon2+rnd+"(){if($('gmap"+lat2+lon2+rnd+"').childNodes[0].id == 'mapimg"+lat2+lon2+rnd+"'){$('bt"+lat2+lon2+rnd+"').src='gmaps/mapoff.gif';$('gmap"+lat2+lon2+rnd+"').innerHTML='<div id=\"mapframe"+lat2+lon2+rnd+"\"><iframe src=\"gmaps/mapcmd.php?lat="+lat1+"."+lat2+"&amp;lon="+lon1+"."+lon2+"&amp;zoom="+zoom+"&amp;type="+type+"\" frameborder=\"0\" width=\"98%\" height=\"400\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"5\"></iframe></div>';}else{$('bt"+lat2+lon2+rnd+"').src='gmaps/mapon.gif';$('gmap"+lat2+lon2+rnd+"').innerHTML = '<div id=\"mapimg"+lat2+lon2+rnd+"\"><a href=\"javascript:void(0);\" onclick=\"showmap"+lat2+lon2+rnd+"();return false;\"><img src=\"http://maps.google.com/staticmap?center=" +lat1+ "." +lat2+ "," +lon1+ "." +lon2+ "&amp;zoom=" +zoom+ "&amp;size=200x200&amp;markers=" +lat1+ "." +lat2+ "," +lon1+ "." +lon2+ "&amp;key=" +gkey+ "\" style=\"border:#cccccc 1px solid;\"></a></div>'}}</script>");
        document.write("<div style='position:relative;'><a href='javascript:void(0);' onclick='showmap"+lat2+lon2+rnd+"();return false;'><img src='gmaps/mapon.gif' id='bt"+lat2+lon2+rnd+"' alt='マップ表示' align='absmiddle' style='position:absolute;top:2px;left:2px;'></a><div id='gmap"+lat2+lon2+rnd+"'><div id='mapimg"+lat2+lon2+rnd+"'><a href='javascript:void(0);' onclick='showmap"+lat2+lon2+rnd+"();return false;'><img src=\"http://maps.google.com/staticmap?center=" +lat1+ "." +lat2+ "," +lon1+ "." +lon2+ "&amp;zoom=" +zoom+ "&amp;size=200x200&amp;markers=" +lat1+ "." +lat2+ "," +lon1+ "." +lon2+ "&amp;key=" +gkey+ "\" style=\"border:#cccccc 1px solid;\"></a></div></div></div>");
    } else {
        if(type == 0) {
            document.write('&lt;cmd src="gmaps" args="' + zoom + ',' + lat1 + ',' + lat2 + ',' + lon1 + ',' + lon2 + '"&gt;');
        } else {
            document.write('&lt;cmd src="gmaps" args="' + zoom + ',' + lat1 + ',' + lat2 + ',' + lon1 + ',' + lon2 + ',' + type + '"&gt;');
        }
    }
}