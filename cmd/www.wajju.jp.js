function url2cmd(url) {
    if (!url.match(/^http:\/\/www\.wajju\.jp\/clips\/([0-9]+)\/([a-zA-Z0-9_\-]+)/)) {
        document.write('<font color="red">'+url+'</font>');
        return;
    }
    var id1 = RegExp.$1;
    var id2 = RegExp.$2;
    main(id1,id2);
}

function main(id1,id2) {
    var html ="<embed width='400' height='300' align='middle' flashvars='coreURL=http://www.wajju.jp/static/swf/core.swf&seqURL=http://www.wajju.jp/clips/"
        + id1
        + "/"
        + id2
        + "/playinfo&modPath=http://www.wajju.jp/static/swf/modules/&autoPlay=false' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' allowscriptaccess='sameDomain' name='PlayerCore' bgcolor='#ffffff' menu='false' wmode='transparent' salign='lt' scale='noscale' quality='high' src='http://www.wajju.jp/static/swf/plainSkin_400x300_wajju.swf'/>";
    document.write(html);
}
