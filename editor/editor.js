function checkVs(pn){
    if (document.layers) {
        if(document.layers[pn].display == 'none') {
            return false;
        } else {
            return true;
        }
    } else if (document.all) {
        if(document.all[pn].style.display == 'none') {
            return false;
        } else {
            return true;
        }
    } else if (document.getElementById) {
        if($(pn).style.display == 'none') {
            return false;
        } else {
            return true;
        }
    }
}

function over(pct) {
    if(pct == 'change') {
        document.getElementById(pct).className="overtext";
    } else {
        document.getElementById(pct).className="over";
    }
};

function out(pct) {
    if(pct == 'change') {
        document.getElementById(pct).className="flattext";
    } else {
        if(flg != pct) {
            document.getElementById(pct).className="flat";
        } else {
            document.getElementById(pct).className="toggle";
        }
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

function changeeditor() {
    if(checkVs('bbcode_insert') && !checkVs('FeslyBBcode')) {
        $('FeslyBBcode').style.display = 'block';
        $('bbcode_insert').style.display = 'none';
        document.cookie = "editor=1; expires=Thu, 1-Jan-2030 00:00:00 GMT";
    } else {
        $('FeslyBBcode').style.display = 'none';
        $('bbcode_insert').style.display = 'block';
        document.cookie = "editor=2; expires=Thu, 1-Jan-2030 00:00:00 GMT";
    }
}

var area;

Event.observe(window.document, 'mousedown', findarea, true);

function findarea(e) {
    var clk = Event.element(e);
    if(clk.type == 'text' || clk.type == 'textarea') {
        area = clk;
    } else {
        if(area == null || area.type != 'text') {
            area = document.getElementsByName('body').item(0);
        }
    }
} 

document.write("<style>.flattext{margin:1px;padding:3px;border:#ffffff 1px solid;background-color:#ffffff;font-size:12px;color:#000000;}.overtext {margin:1px;padding:3px;border:#316AC5 1px solid;background-color:#DFF1FF;font-size:12px;color:#000000;text-decoration:none;}.flat{border:#ffffff 1px solid;background-color:#ffffff;}.over{border:#316AC5 1px solid;background-color:#DFF1FF;}.toggle{border:#316AC5 1px solid;background-color:#C1D2EE;}</style>");
document.write("<div style=\"margin-top:3px;float:left;\"><img src=\"editor/auemoji/btn.gif\" id=\"auemoji\" name=\"btn\" alt=\"au絵文字挿入\" onClick=\"showeditor('auemoji',412,135);\" onmouseout=\"out('auemoji')\" onmouseover=\"over('auemoji')\" class=\"flat\" style=\"margin:0 1px;\"><img src=\"editor/dcmemoji/btn.gif\" id=\"dcmemoji\" name=\"btn\" alt=\"DoCoMo絵文字挿入\" onClick=\"showeditor('dcmemoji',286,188);\" onmouseout=\"out('dcmemoji')\" onmouseover=\"over('dcmemoji')\" class=\"flat\" style=\"margin:0 1px;\"><img src=\"editor/sbemoji/btn.gif\" id=\"sbemoji\" name=\"btn\" alt=\"SoftBank絵文字挿入\" onClick=\"showeditor('sbemoji',417,136);\" onmouseout=\"out('sbemoji')\" onmouseover=\"over('sbemoji')\" class=\"flat\" style=\"margin:0 1px;\"><img src=\"editor/kaomoji/btn.gif\" id=\"kaomoji\" name=\"btn\" alt=\"顔文字挿入\" onClick=\"showeditor('kaomoji');\" onmouseout=\"out('kaomoji')\" onmouseover=\"over('kaomoji')\" class=\"flat\" style=\"margin:0 1px;\"><img src=\"editor/map/btn.gif\" id=\"map\" name=\"btn\" alt=\"マップ挿入\" onClick=\"showeditor('map',400,485);\" onmouseout=\"out('map')\" onmouseover=\"over('map')\" class=\"flat\" style=\"margin:0 1px;\"></div>");

if($('FeslyBBcode') && $('bbcode_insert')) {
    document.write("<div style=\"margin-top:3px;padding:5px;float:right;\"><a href=\"javascript:void(0);\" onClick=\"changeeditor()\" onmouseout=\"out('change')\" onmouseover=\"over('change')\" class=\"flattext\" id=\"change\">BBcodeエディタ切替</a></div><br clear=\"both\">");
    ckary = document.cookie.split("; ");
    ckstr = 1;
    for(i=0; i<ckary.length; i++) {
        cid = ckary[i].split("=");
        if (cid[0] == "editor") {
            ckstr = cid[1];
            break;
        }
    }

    if(ckstr == 1) {
        $('FeslyBBcode').style.display = 'block';
        $('bbcode_insert').style.display = 'none';
    } else {
        $('FeslyBBcode').style.display = 'none';
        $('bbcode_insert').style.display = 'block';
    }
} else {
    document.write("<br clear=\"both\">");
}

document.write('<span id="editor"></span>');


