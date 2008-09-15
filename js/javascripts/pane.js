var oimg = new Image();
var cimg = new Image();

function checkVs(pn){
    if (document.layers) {
        if(document.layers["cnt"+pn].display == 'none') {
            return false;
        } else {
            return true;
        }
    } else if (document.all) {
        if(document.all["cnt"+pn].style.display == 'none') {
            return false;
        } else {
            return true;
        }
    } else if (document.getElementById) {
        if($("cnt"+pn).style.display == 'none') {
            return false;
        } else {
            return true;
        }
    }
}

function setCk() {
    poovl="";
    for(i = 1;i <= 14;i++) {
        if($("cnt"+i)) {
            if(checkVs(i)) {
                poovl += i+"_"+"o"+",";
            } else {
                poovl += i+"_"+"c"+",";
            }
        }
    }
    document.cookie = "pane=" +Sortable.sequence('rightpane')+ "*" +poovl+ "*" +settab+ "; expires=Thu, 1-Jan-2030 00:00:00 GMT";
}

function paneOnOff(pn) {
    if(checkVs(pn)) {
        $("cnt"+pn).style.display = "none";
        $("mkcnt"+pn).src = cimg;
    } else {
        $("cnt"+pn).style.display = "block";
        $("mkcnt"+pn).src = oimg;
    }
    setCk();
}

function paneOnOffInit(pn) {
    $("cnt"+pn).style.display = "block";
    $("mkcnt"+pn).src = oimg;
}

function makepane() {

    for(i = 1;i <= 14;i++) {
        if($("mkcnt"+i)) {
            oimg = $("mkcnt"+i).src.slice(0,-4)+"_minus.gif";
            cimg = $("mkcnt"+i).src;
            break;
        }
    }
    ckary = document.cookie.split("; ");
    i = 0;
    var ckstr = '';
    while (ckary[i]) {
        if (ckary[i].substr(0,5) == "pane=") {
            ckstr = ckary[i].substr(5,ckary[i].length);
            if(ckstr.indexOf("12_",0) == -1) {
                ckstr = '';
            }
            break;
        }
        i++;
    }
    if(ckstr == "") {
        ckstr="1,2,3,4,5,6,7,8,9,10,11*1_o,2_o,3_o,4_o,5_o,6_o,7_o,8_o,9_o,10_o,11_o,12_o,13_o,14_o*tab1";
    }
    ckstrcat = ckstr.split("*");
    ckstrary = ckstrcat[0].split(",");
    ckstrary2 = ckstrcat[1].split(",");
    if(ckstrcat[2]) {
        settab = ckstrcat[2];
    } else {
        settab = 'tab1';
    }
    var ckstrary_length = ckstrary.length;
    var panecnt="";
    for(i = 0;i < ckstrary_length;i++) {
        if($("cnt"+ckstrary[i])) {
            if(ckstrary2.indexOf(ckstrary[i]+'_o') != -1) {
                paneOnOffInit(ckstrary[i]);
            }
            panecnt += $("dv"+ckstrary[i]).innerHTML;
        }
    }
    for(i = 1;i <= 11;i++) {
        if($("cnt"+i) && ckstrary.indexOf(i) == -1) {
            paneOnOffInit(i);
            panecnt = $("dv"+i).innerHTML + panecnt;
        }
    }
    if($("cnt12")) {
        if(ckstrary2.indexOf('12_o') != -1 || ckstrary2.indexOf('12_c') == -1) {
            paneOnOffInit(12);
        }
    }
    if($("cnt13")) {
        if(ckstrary2.indexOf('13_o') != -1 || ckstrary2.indexOf('13_c') == -1) {
            paneOnOffInit(13);
        }
    }
    if($("cnt14")) {
        if(ckstrary2.indexOf('14_o') != -1 || ckstrary2.indexOf('14_c') == -1) {
            paneOnOffInit(14);
        }
    }

    $('rightpane').innerHTML = panecnt;
    new Fabtabs('tabs', settab);

    Sortable.create('rightpane',{
        tag:'div',
        dropOnEmpty:true,
        handle:'b_b c_00',
        containment:'rightpane',
        constraint:false,
        onUpdate:function() {
            setCk();
        }
    });
}
