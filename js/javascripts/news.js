function init(kind,key,source) {

    loadicon = new Image();
    loadicon.src = "./skin/default/img/loading.gif";

    if(kind == '') {
        kind = 'po';
    }

    if(key == undefined) {
        key = '';
    }

    if(source == undefined) {
        source = '';
    }
    
    tabs = $('newstabs').getElementsByTagName('li');
    for(i=0;i<tabs.length;i++){
       Element.removeClassName(tabs[i], "current");
    }
    
    if(kind != 'f') {
        $(kind).className = 'current';
    }
    if(source != '') {
        var url = './?m=pc&a=page_h_sns_news_data&source='+encodeURIComponent(source);
    } else {
        var url = './?m=pc&a=page_h_sns_news_data&type='+kind+'&key='+key;
    }
    var myAjax = new Ajax.Updater(
        {success: 'placeholder'},
        url,
        {
        method: 'get',
        onComplete: addblank,
        onFailure: reportError
        });
}

Ajax.Responders.register({
    onCreate: function() {
        $('placeholder').innerHTML = '<div style="margin:10px;padding:20px;border:#cccccc 1px dotted;background:#ffffff;clear:both;"><img id="loadicon"></div>';
        $('loadicon').src = loadicon.src;
    }
});

function addblank() {
    outlinks = $('news').getElementsByTagName('a');
    for(i=0;i<outlinks.length;i++){
        if(!(outlinks[i].getAttribute("className") == 'exception' || outlinks[i].getAttribute("class") == 'exception')) {
            outlinks[i].setAttribute("target", "_blank");
        }
    }
}

function reportError(request) {
    alert('エラーが発生しました');
}
