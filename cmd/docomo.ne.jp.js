function url2cmd(url) {
    while(true) {
      dummy = url.replace("%2b","+").replace("%2B","+");
      if(url==dummy) break;
      url = dummy;
    }
    if (!url.match(/^http:\/\/docomo\.ne\.jp\/cp\/map\.cgi\?(.+)$/)) {
        document.write('<font color="red">'+url+'</font>');
        return;
    }
    var id = RegExp.$1;
    main(id);
}

function main(id) {
    var cmd = id.split("&amp;");
    var param = new Array();
    var Maps = onLoadNumber++;
    for(i=0; i<cmd.length; i++) {
       var work = cmd[i].split("=");
       if( work.length == 2 ) {
         param[work[0]] = work[1];
       }
    }
    lat = convert(param["lat"]);
    lon = convert(param["lon"]);
    if(param['geo'].toLowerCase()=='tokyo') {
      $y = lat;
      $x = lon;
      lat = $y - 0.00010695*$y + 0.000017464*$x + 0.0046017;
      lon = $x - 0.000046038*$y - 0.000083043*$x + 0.010040;
    }
    var zoom=15;

document.write( "<script>"
+"function showmap"+Maps+"() {"
+"  if(document.getElementById('gmap"+Maps+"').innerHTML=='') {"
+"    document.getElementById('bt"+Maps+"').src='gmaps/mapoff.gif';"
+"    document.getElementById('gmap"+Maps+"').innerHTML='<br><iframe src=\"gmaps/mapcmd.php?lat="+lat+"&amp;lon="+lon+"&amp;zoom="+zoom+"&amp;type=0\" frameborder=\"0\" width=\"400\" height=\"400\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"5\"></iframe><br>';"
+"  }else{"
+"    document.getElementById('bt"+Maps+"').src='gmaps/mapon.gif';document.getElementById('gmap"+Maps+"').innerHTML='';"
+"  }"
+"}</script>");

    document.write('<a href="javascript:showmap'+Maps+'();">'
+' <img src="gmaps/mapon.gif" id="bt'+Maps+'" alt="マップ表示" align="absmiddle">'
+'</a>'
+'<span id="gmap'+Maps+'"></span>');

}
function convert(id)
{
    var v = id.split(".");
    var result;
    result = parseFloat(v[2]) + parseFloat(v[3])/1000.0;
    result = parseFloat(v[1]) + result/60.0;
    result = parseFloat(v[0]) + result/60.0;
    return result;
}
