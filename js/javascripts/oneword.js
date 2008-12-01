//InPlaceEditorのgetTextをオーバーライド
if(Ajax.InPlaceEditor != null) {
    Ajax.InPlaceEditor.prototype.getText = function() {
        var text = this.element.innerHTML;
        var loc = location.href.split('?');
        var locExp = new RegExp(loc[0], "ig");
        //絵文字イメージタグを絵文字コードへ変換
        text = text.replace(locExp, "").replace(/\salt="[^>]+"/gi, "").replace(/\salt=[^\s]+/gi, "").replace(/\/>/gi, ">");
        text = text.replace(/<img\ssrc="(\.\/)?skin\/default\/img\/emoji\/([ies])\/[ies]([0-9]{1,3})\.gif">/gi, "[$2:$3]");
        //<>＆エンティティを実物へ変換
        text = text.replace(/&lt;/gi, "<").replace(/&gt;/gi, ">").replace(/&amp;/gi, "&");
        return text;
    }
}

function makeoneword() {
    var url = "./?m=pc&a=do_oneword_edit&sessid=" + sid;
    new Ajax.InPlaceEditor("oneword", url, {
        okText : "今日のひとこと",
        cancelText : "キャンセル",
        savingText : "保存中です...",
        clickToEditText : "クリックすると編集できます",
        rows:1,
        cols:30,
        onFailure : function(){
            alert("1文字以上36文字以下にしてください");
        },
        onComplete: function(transport, element) {
            new Effect.Highlight(element, {startcolor: this.options.highlightcolor});
            if(transport) {
                nextall(1);
                nextfri(1);
            }
        }
    });
}

function makeballoon() {
    if(!document.getElementById || !document.getElementsByTagName) {
        return;
    }
    var links=document.getElementsByClassName('oneword_bln');
    for(i=0;i<links.length;i++) {
        load(links[i]);
    }
}

function load(e) {
    //吹き出し本文取得
    var title = e.getAttribute("oneword");
    //吹き出し本文をエスケープ
    title = title.escapeHTML();
    //エスケープされた絵文字イメージタグのみタグへ戻す
    title = title.replace(/&lt;img\ssrc="\.\/skin\/default\/img\/emoji\/([ies])\/([ies][0-9]{1,3})\.gif"\salt="[^\s]+"\s\/(&gt;|>)/gi, '<img src="skin/default/img/emoji/$1/$2.gif">');
    e.titles = title;

    //吹き出し本体作成
    var balloon = document.createElement("span");
    balloon.className = "balloon";
    balloon.style.display = "block";
    balloon.style.position = "absolute";
    balloon.style.bottom = "0px";
    e.balloon = balloon;

    //吹き出し上部を作成
    var text = document.createElement("span");
    text.className = "text";
    text.style.display = "block";
    e.texts = text;

    //吹き出し下部を作成
    var btm = document.createElement("b");
    btm.className = "bottom";
    btm.style.display = "block";
    e.btms = btm;

    //イベントハンドラ設定
    e.onmouseover = showbln;
    e.onmouseout = hidebln;
    e.onmousemove = move;
}

function showbln(e) {
    //吹き出し本体へ上部を追加
    this.balloon.appendChild(this.texts);
    //吹き出し本体へ下部を追加
    this.balloon.appendChild(this.btms);
    //吹き出しアンカーへ吹き出しを追加
    $("wedge").appendChild(this.balloon);
    //上部へ本文を流し込み
    this.texts.innerHTML = this.titles;
}

function hidebln(e) {
    var d = $("wedge");
    if(d.childNodes.length > 0) {
        d.removeChild(d.firstChild);
    }
}

function move(e) {
    var x = 0,y = 0;
    if(e == null) {
        e = window.event;
    }
    x = Event.pointerX(e);
    y = Event.pointerY(e);
    $("wedge").style.top = (y-20)+"px";
    $("wedge").style.left = (x-35)+"px";
    $("wedge").style.zIndex = '100';
}
