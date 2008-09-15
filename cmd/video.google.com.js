function url2cmd(url) {
    if (!url.match(/^http:\/\/video\.google\.com\/videoplay\?docid=([0-9\-]+).*?$/)) {
        document.write('<font color="red">'+url+'</font>');
        return;
    }

    var clipid = RegExp.$1;
    main(clipid);
}

function main(docid) {
    if (!docid.match(/^[\-0-9]+$/)) {
        return;
    }

    html = '<embed style="width:425px; height:350px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId='
    html += docid;
    html += '&hl=en"> </embed>';
    document.write(html);
}
