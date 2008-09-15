function checkVs(nm){
    if (document.layers) {
        if(document.layers["sub"+nm].display == 'none') {
            return false;
        } else {
            return true;
        }
    } else if (document.all) {
        if(document.all["sub"+nm].style.display == 'none') {
            return false;
        } else {
            return true;
        }
    } else if (document.getElementById) {
        if(document.getElementById("sub"+nm).style.display == 'none') {
            return false;
        } else {
            return true;
        }
    }
}

function SwitchMenu(nm) {
    if(checkVs(nm)) {
        document.getElementById("sub"+nm).style.display = 'none';
    } else {
        document.getElementById("sub"+nm).style.display = 'block';
    }
    recPanel();
}

function openPanel() {
    admenu = '';
    ckary = document.cookie.split("; ");
    ckstr = "";
    i = 0;
    for(i=0; i<ckary.length; i++) {
        if (ckary[i].substr(0,7) == "admenu=") {
            eval(ckary[i]);
        }
    }
    if(document.getElementById("site_navi")) {
        if(admenu) {
            if(admenu.menu1 && document.getElementById("sub1")){
                document.getElementById("sub1").style.display = 'block';
            }
            if(admenu.menu2){
                document.getElementById("sub2").style.display = 'block';
            }
            if(admenu.menu3){
                document.getElementById("sub3").style.display = 'block';
            }
            if(admenu.menu4){
                document.getElementById("sub4").style.display = 'block';
            }
        }
    }
}

function recPanel() {
    if(document.getElementById("sub1")) {
        if(checkVs(1)) {
            menu1 = '"menu1":true,';
        } else {
            menu1 = '"menu1":false,';
        }
    } else {
         menu1 = '"menu1":false,';
    }
    if(checkVs(2)) {
        menu2 = '"menu2":true,';
    } else {
        menu2 = '"menu2":false,';
    }
    if(checkVs(3)) {
        menu3 = '"menu3":true,';
    } else {
        menu3 = '"menu3":false,';
    }
    if(checkVs(4)) {
        menu4 = '"menu4":true';
    } else {
        menu4 = '"menu4":false';
    }
    
    cookiestr = "admenu={" + menu1 + menu2 + menu3 + menu4 + "}";
    document.cookie = cookiestr + "; expires=Thu, 1-Jan-2030 00:00:00 GMT";
}
