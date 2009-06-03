function url2cmd(url) {
    if (!url.match(/^http:\/\/video\.msn\.com\/video.aspx\?vid=([a-zA-Z0-9_-]+)/)) {
        return;
    }
    var id = RegExp.$1;
    main(id);
}

function main(id) {
    if (!id.match(/^[a-zA-Z0-9_-]+$/)) {
        return;
    }
    var html = '<embed src="http://images.video.msn.com/flash/video1_1.swf" quality="high" width="412" height="362" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://macromedia.com/go/getflashplayer" flashvars="c=v&v='+id+'" ></embed>';
    document.write(html);
}
