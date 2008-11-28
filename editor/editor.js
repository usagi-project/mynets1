function over(pct) {
    document.getElementById(pct).className="over";
};

function out(pct) {
    if(flg != pct) {
        document.getElementById(pct).className="flat";
    } else {
        document.getElementById(pct).className="toggle";
    }
};
    
flg = '';

function showeditor(fnc,width,height) {
    if(document.getElementById('editor').innerHTML=='' || flg != fnc) {
        document.getElementById(fnc).className='toggle';
        if(flg != '' && flg != fnc) {
            document.getElementById(flg).className='flat';
        }
        if(width == null && height == null) { 
            document.getElementById('editor').innerHTML='<hr size="1"><iframe src="editor/'+fnc+'/edit.html" frameborder="0" width="420" height="250" scrolling="auto"></iframe>';
        } else {
            document.getElementById('editor').innerHTML='<hr size="1"><iframe src="editor/'+fnc+'/edit.html" frameborder="0" width="'+width+'" height="'+height+'" scrolling="no"></iframe>';
        }
        flg = fnc;
    } else {
        document.getElementById(fnc).className='flat';
        document.getElementById('editor').innerHTML='';
        flg="";
    }
}

var area;

function findarea() {
     var e = null;
    _txtarea = window.parent.document.getElementsByTagName("textarea");
    for (i=0;i<_txtarea.length;i++) {
        if (_txtarea.item(i).name.match(/^body|info|detail$/i)) {
            e = _txtarea.item(i);
            break;
        }
    }
    return e;
}

Event.observe(window, 'load', loadEmojiArea, false);

function loadEmojiArea() {
    area = findarea();
    if (typeof(area) != 'undefined' && !!area) {
        var div = document.createElement('div');
        div.setAttribute('style','margin-top:3px;');
        div.innerHTML = "<img src=\"editor/auemoji/btn.gif\" id=\"auemoji\" name=\"btn\" alt=\"au絵文字挿入\" onClick=\"showeditor('auemoji',420,145);\" onmouseout=\"out('auemoji')\" onmouseover=\"over('auemoji')\" class=\"flat\" style=\"margin:0 1px;\"><img src=\"editor/dcmemoji/btn.gif\" id=\"dcmemoji\" name=\"btn\" alt=\"DoCoMo絵文字挿入\" onClick=\"showeditor('dcmemoji',295,200);\" onmouseout=\"out('dcmemoji')\" onmouseover=\"over('dcmemoji')\" class=\"flat\" style=\"margin:0 1px;\"><img src=\"editor/sbemoji/btn.gif\" id=\"sbemoji\" name=\"btn\" alt=\"SoftBank絵文字挿入\" onClick=\"showeditor('sbemoji',420,140);\" onmouseout=\"out('sbemoji')\" onmouseover=\"over('sbemoji')\" class=\"flat\" style=\"margin:0 1px;\"><img src=\"editor/kaomoji/btn.gif\" id=\"kaomoji\" name=\"btn\" alt=\"顔文字挿入\" onClick=\"showeditor('kaomoji');\" onmouseout=\"out('kaomoji')\" onmouseover=\"over('kaomoji')\" class=\"flat\" style=\"margin:0 1px;\"><img src=\"editor/map/btn.gif\" id=\"map\" name=\"btn\" alt=\"マップ挿入\" onClick=\"showeditor('map',420,485);\" onmouseout=\"out('map')\" onmouseover=\"over('map')\" class=\"flat\" style=\"margin:0 1px;\">";
        var span = document.createElement('span');
        span.setAttribute("id", "editor");
        var pn = area.parentNode;
        pn.appendChild(div);
        pn.appendChild(span);
    }
}

document.write("<style>.flat{border:#ffffff 1px solid;background-color:#ffffff;}.over{border:#316AC5 1px solid;background-color:#DFF1FF;}.toggle{border:#316AC5 1px solid;background-color:#C1D2EE;}</style>");
