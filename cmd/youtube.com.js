function url2cmd(url) {
    if (!url.match(/^http:\/\/(?:www\.|)youtube\.com\/watch\?v=([a-zA-Z0-9_\-]+)/)) {
        document.write('<font color="red">'+url+'</font>');
        return;
    }
    var id = RegExp.$1;
    var width = 425;
    var height = 350;
    main(id, width, height);
}

function main(id, width, height) {
    if (!id.match(/^[a-zA-Z0-9_\-]+$/)) {
        return;
    }
    width = !width ? 0 : parseInt(width);
    height = !height ? 0 : parseInt(height);
    if (width <= 0 || width > 425) {
        width = 425;
    }
    if (height <= 0 || height > 350) {
        height = 350;
    }
    var html = '<object width="'
            + width
            + '" height="'
            + height
            + '"><param name="movie" value="http://www.youtube.com/v/'
            + id
            + '"></param><embed src="http://www.youtube.com/v/'
            + id
            + '" type="application/x-shockwave-flash" width="'
            + width
            + '" height="'
            + height
            + '"></embed></object>';
    document.write(html);
}
