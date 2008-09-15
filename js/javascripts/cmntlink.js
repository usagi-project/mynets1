Event.observe(window.document, 'click', findarea, false);

function findarea(e) {
    var w = $("wedge");
    var s = Event.findElement(e, 'span').id;
    var b = Event.element(e).id;
    if(w.childNodes.length > 0 && s != 'cmntballoon' && s != 'cmnttext' && s != 'cmnttextcell' || b == 'closebtn') {
        w.removeChild(w.firstChild);
    }
} 

function makeballoon() {
    if(!document.getElementById || !document.getElementsByTagName) {
        return;
    }
    var links = document.getElementsByClassName('cmntbln');
    for(i=0;i<links.length;i++) {
        load(links[i]);
    }
}

function load(e) {
    var title = e.getAttribute("title");
    e.removeAttribute("title");
    var titles = title.split('_');
    e.number = titles[0];
    e.pageid = titles[1];
    e.kind = titles[2];
    
    //バルーン生成
    var balloon = document.createElement("span");
    balloon.className = "cmntballoon";
    balloon.id = "cmntballoon";
    balloon.style.display = "block";
    balloon.style.position = "absolute";
    balloon.style.bottom = "0px";
    
    //トップ部分生成
    var top = document.createElement("b");
    top.className = "cmnttop";
    top.style.display = "block";
    
    //クロースボタンセル生成
    var close = document.createElement("div");
    close.className = "close";
    close.style.display = "block";

    //クロースボタン生成
    var closebtn = document.createElement("img");
    closebtn.src = "./skin/default/img/close.gif";
    closebtn.id = "closebtn";
    closebtn.style.cursor = "pointer";
    
    //クロースボタンセルへクロースボタンを結合
    close.appendChild(closebtn);
    //トップ部分へクロースボタンセルを結合
    top.appendChild(close);
    //バルーンへトップ部分を結合
    balloon.appendChild(top);
    
    //テキストセル生成
    textcell = document.createElement("span");
    textcell.className = "cmnttextcell";
    textcell.id = "cmnttextcell";
    textcell.style.display = "block";
    
    //テキストロード部分作成
    text = document.createElement("span");
    text.className = "cmnttext";
    text.id = "cmnttext";
    text.style.display = "block";
    
    //ローディングイメージ生成
    loadimg = document.createElement("img");
    loadimg.src = "./skin/default/img/loading.gif";
    loadimg.style.padding = "0 0 20px 175px";
    
    //ローディングイメージをテキストロード部分へ結合
    text.appendChild(loadimg);
    //テキストロード部分をテキストセルへ結合
    textcell.appendChild(text);
    //テキストセル部分をバルーンへ結合
    balloon.appendChild(textcell);
    
    //ボトム部分生成
    var btm = document.createElement("b");
    btm.className = "cmntbottom";
    btm.style.display = "block";
    
    //ボトム部分をバルーンへ結合
    balloon.appendChild(btm);
    
    e.balloon = balloon;
    e.onmouseover = showbln;
}

function showbln(e) {
    var w = $("wedge");
    if(w.childNodes.length > 0) {
        w.removeChild(w.firstChild);
    }
    move(e);
    w.appendChild(this.balloon);
    if(this.kind == 'd') {
        var action = './?m=pc&a=page_h_cmnt_diary';
    } else {
        var action = './?m=pc&a=page_h_cmnt_topic';
    }
    var url = action + '&id=' + this.pageid + '&number=' + this.number;
    getcmnt(url);
}

function move(e) {
    var x = 0,y = 0;
    if(e == null) {
        e = window.event;
    }
    x = Event.pointerX(e);
    y = Event.pointerY(e);
    $("wedge").style.top = (y-10)+"px";
    $("wedge").style.left = (x-35)+"px";
    $("wedge").style.zIndex = '100';
}

function getcmnt(url) {
    var myAjax = new Ajax.Updater(
        {success: 'cmnttext'},
        url,
        {
        method: 'get',
        onComplete: ieheight,
        onFailure: reportError
        });
}

function ieheight () {
    var size = Element.getDimensions("cmnttext");
    if(size.height > 200) {
        $("cmnttext").style.height = "200px";
    }
}

function reportError(request) {
    alert('エラーが発生しました');
}

function showinfomap(id) {
    ids = id.split("_");
    if(ids[6] == undefined) {
        ids[6] = 0
    }
    if($("mapbox_"+id).innerHTML=='') {
        $("btn_"+id).src='gmaps/mapoff2.gif';
        $("mapbox_"+id).innerHTML='<br><iframe src="./gmaps/mapcmd.php?lat='+ids[2]+'.'+ids[3]+'&lon='+ids[4]+'.'+ids[5]+'&zoom='+ids[1]+'&type='+ids[6]+'" frameborder="0" width="95%" height="400" scrolling="no" marginwidth="0" marginheight="5"></iframe><br>';
    } else {
        $("btn_"+id).src='gmaps/mapon2.gif';
        $("mapbox_"+id).innerHTML='';
    }    
}
