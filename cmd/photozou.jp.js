function url2cmd(url) {
    if (!url.match(/^http:\/\/photozou\.jp\/(photo|video)\/(list|show)\/([0-9]+)\/([0-9]+)/)) {
        document.write('<font color="red">'+url+'</font>');
        return;
    }
    var media = RegExp.$1;
    var view = RegExp.$2;
    var user = RegExp.$3;
    var contents = RegExp.$4;

    if (view == 'show'){
        document.write('<font color="red">'+url+'<br />動画には未対応です。</font>');
        return;
    }

    main(media,view,user,contents);
}

function main(media,view,user,contents) {
    if (!contents.match(/^[0-9]+$/)) {
        return;
    }
    if (view == 'list'){
        var html = '<object width="425" height="392">'
                 + '<param name="movie" value="http://photozou.jp/player/slideshow.swf?p='
                 + user
                 + '_'
                 + contents
                 + '_ja"></param><embed src="http://photozou.jp/player/slideshow.swf?p='
                 + user
                 + '_'
                 + contents
                 + '_ja" type="application/x-shockwave-flash" width="425" height="392"></embed></object>'
        document.write(html);
    }
}
