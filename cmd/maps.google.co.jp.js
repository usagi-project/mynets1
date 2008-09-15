function url2cmd(url) {
    if (!url.match(/^http:\/\/maps\.google\.co\.jp\/(?:maps|)\?(.+)$/i)) {
        document.write('<a href="'+url+'" target="_blank">'+url.truncate(64)+'</a>');
        return;
    }
    var id = RegExp.$1;
    main(id);
}
function main(id) {
    var i;
    var cmd = id.split("&amp;");
    var param = new Array();
    var Maps = onLoadNumber++;
    param["z"] = "15";
    param["ll"] = "";
    for(i=0; i<cmd.length; i++) {
       var work = cmd[i].split("=");
       if( work.length == 2 ) {
         param[work[0]] = work[1];
       }
    }
    var t;
    if( param["t"] == "h" )
         t = 2;
//       t = "G_HYBRID_MAP";
    else if( param["t"] == "k" )
//       t = "G_SATELLITE_MAP";
         t = 1;
    else
//       t = "G_NORMAL_MAP";
         t = 0;
    zoom=param["z"];

if( param['ll'] == '' && param['q'].length>0 ) {
  document.writeln('<script src="googleapi.php" type="text/javascript" charset="utf-8"></script>');
  document.write('<script type="text/javascript">\n'
+ '<!--\n'
+ ' onLoadArray.push("onLoadMap_'+Maps+'()");\n'
+ 'function onLoadMap_'+Maps+'() {\n'
+ 'var gls = new GlocalSearch();\n'
+ 'gls.setSearchCompleteCallback(null, OnLocalSearch);\n'
+ 'gls.execute(decodeURIComponent("'+param['q']+'"));\n'
+ 'function OnLocalSearch() {\n'
+ ' if (!gls.results) return;\n'
+ ' var first = gls.results[0];\n'
+ ' lat=parseFloat(first.lat);lon=parseFloat(first.lng);\n'
+ '}'
+ '}'
+ '//-->\n'
+ '</script>\n');

document.write( "<script>"
+"function showmap"+Maps+"() {"
+"  if(document.getElementById('gmap"+Maps+"').innerHTML=='') {"
+"    document.getElementById('bt"+Maps+"').src='gmaps/mapoff.gif';"
+"    document.getElementById('gmap"+Maps+"').innerHTML='<br><iframe src=\"gmaps/mapcmd.php?lat='+lat+'&amp;lon='+lon+'&amp;zoom='+zoom+'&amp;type='+t+'\" frameborder=\"0\" width=\"400\" height=\"400\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"5\"></iframe><br>';"
+"  }else{"
+"    document.getElementById('bt"+Maps+"').src='gmaps/mapon.gif';document.getElementById('gmap"+Maps+"').innerHTML='';"
+"  }"
+"}</script>");

    } else {

    var ll = param["ll"].split(","); lat=ll[0];lon=ll[1];
document.write( "<script>"
+"function showmap"+Maps+"() {"
+"  if(document.getElementById('gmap"+Maps+"').innerHTML=='') {"
+"    document.getElementById('bt"+Maps+"').src='gmaps/mapoff.gif';"
+"    document.getElementById('gmap"+Maps+"').innerHTML='<br><iframe src=\"gmaps/mapcmd.php?lat="+lat+"&amp;lon="+lon+"&amp;zoom="+zoom+"&amp;type="+t+"\" frameborder=\"0\" width=\"400\" height=\"400\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"5\"></iframe><br>';"
+"  }else{"
+"    document.getElementById('bt"+Maps+"').src='gmaps/mapon.gif';document.getElementById('gmap"+Maps+"').innerHTML='';"
+"  }"
+"}</script>");

    }

    document.write('<a href="javascript:showmap'+Maps+'();">'
+' <img src="gmaps/mapon.gif" id="bt'+Maps+'" alt="マップ表示" align="absmiddle">'
+'</a>'
+'<span id="gmap'+Maps+'"></span>');

}
