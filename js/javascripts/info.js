function nextinfo(page) {
    $('infolist').innerHTML = '<div style="padding:20px;text-align:center;"><img id="loadicon"></div>';
    $('loadicon').src = loadicon.src;
    url = './?m=pc&a=page_h_admin_info&page=' + page;
    var myAjax = new Ajax.Updater(
        {success: 'infoarea'},
        url,
        {
        method: 'get',
        onComplete: geticon,
        onFailure: reportError
        });
}

function geticon() {
    if($("icon_0")) {
        oicon = new Image();
        cicon = new Image();
        oicon.src = $("icon_0").src.slice(0,-4)+"_minus.gif";
        cicon.src = $("icon_0").src;
    }
    loadicon = new Image();
    loadicon.src = "./skin/default/img/loading.gif";
}

function checkVsinfo(pn){
    if (document.layers) {
        if(document.layers["body_"+pn].display == 'none') {
            return false;
        } else {
            return true;
        }
    } else if (document.all) {
        if(document.all["body_"+pn].style.display == 'none') {
            return false;
        } else {
            return true;
        }
    } else if (document.getElementById) {
        if($("body_"+pn).style.display == 'none') {
            return false;
        } else {
            return true;
        }
    }
}

function infoOnOff(pn,id) {
    if(checkVsinfo(pn)) {
        $("icon_"+pn).src = cicon.src;
        $("sub_"+pn).style.background = "";
        $('body_'+pn).style.display = "none";
    } else {
        $("icon_"+pn).src = oicon.src;
        $("sub_"+pn).style.background = "#ffff99";
        $('body_'+pn).style.display = "block";
        if($('body_'+pn).innerHTML == '') {
            $('body_'+pn).innerHTML = '<div style="padding:20px;text-align:center;"><img id="load_' + pn + '"></div>';
            $('load_'+pn).src = loadicon.src;
            url = './?m=pc&a=page_h_admin_info_body&c_admin_information_id=' + id;
            var myAjax = new Ajax.Updater(
                {success: 'body_'+pn},
                url,
                {
                method: 'get',
                onFailure: reportError
                });
        }
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
        $("btn_"+id).src='gmaps/mapoff.gif';
        $("mapbox_"+id).innerHTML='<br><iframe src="./gmaps/mapcmd.php?lat='+ids[2]+'.'+ids[3]+'&lon='+ids[4]+'.'+ids[5]+'&zoom='+ids[1]+'&type='+ids[6]+'" frameborder="0" width="98%" height="400" scrolling="no" marginwidth="0" marginheight="5"></iframe><br>';
    } else {
        $("btn_"+id).src='gmaps/mapon.gif';
        $("mapbox_"+id).innerHTML='';
    }    
}