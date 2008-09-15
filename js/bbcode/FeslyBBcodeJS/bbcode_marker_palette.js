var onclick_function;
var pos_x2 = 0;
var pos_y2 = 0;
var palette_width = 94;
var adv_x2 = 360;

function openPalette2(event) {
    id = "marker_palette";

    var mouse = getMousePosition(event);
    
    if (document.getElementById) {
        obj = document.getElementById(id).style; 
    } else if (document.all){
        obj = document.all[id].style;
    }   
    
    showPalette2();
    var scroll_x = (window.opera) ? window.pageXOffset : 0;
    var scroll_y = (window.opera) ? window.pageYOffset : 0;
    var mouse    = getMousePosition(event);
    var pos_x2    = mouse + scroll_x;
    var pos_y2    = mouse + scroll_y;
    var limit_x  = adv_x2 - palette_width;

    if (pos_x2 > limit_x) {
        pos_x2 -= (pos_x2 - limit_x);
    }

    var obj = (document.getElementById) ? document.getElementById(id).style :
              (document.all)            ? document.all[id].style            : null; 
    
    obj.display = "block";
    obj.zIndex = 2;
}

function showPalette2() {
    var palette='<table cellpadding="0" cellspacing="2" border="0" align="center">';
    var imgUrl="./skin/dummy.gif";
    var i=0,j=0,current=0;

    var colors = new Array(
        '#ffffff','#cccccc','#999999','#666666','#333333','#000000',
        '#ffcccc','#ff99cc','#ff6699','#ff0000','#cc0000','#990000',
        '#ffff99','#ffff00','#ffcc33','#ff9933','#ff6600','#cc3300',
        '#99ff99','#00ff00','#00cc00','#009900','#006600','#003300',
        '#66ffff','#00ccff','#0066ff','#0000ff','#0000cc','#000066',
        '#ccccff','#9999ff','#9966ff','#9900ff','#660099','#660066',
        '#ffccff','#ff99ff','#ff66ff','#ff00ff','#cc0099','#990066'
    ); 
    
    while(i < 7) {
        palette+="<tr>";
        while(j < 6) {
            palette+=
            "<td style='background:"+colors[current]+"'>"+
            "<a href=\"javascript:change_marker_color(document.editForm.body, '"+colors[current]+"')\""+
            "style=\"background-color: transparent; color:"+colors[current]+"; text-decoration: none;\" onClick=\"closePalette2();\""+
            "onMouseOver=\"document.getElementById('plt2"+current+"').src='./css/bbcode/FeslyBBcodeStyle/img/mouse_over.gif'\" onMouseOut=\"document.getElementById('plt2"+current+"').src='./skin/dummy.gif'\">"+
            "<img src=\""+imgUrl+"\" border=\"0\" width=\"14\" height=\"14\" id=\"plt2"+current+"\"/>"+
            "</a></td>"; 
            current++;
            j++;
        }
        palette+="</tr>";
        j=0;
        i++;
    }
    palette+="</table>";

    document.getElementById("marker_palette").innerHTML = '<div align=\"left\" class=\"palette_title\" onClick=\"closePalette2();\"><div class=\"palette_title_left\">&nbsp;&nbsp;マーカー色&nbsp;&nbsp;</div><div class=\"palette_title_right\"><a href=\"javascript:void(0)\" class=\"image_close\"><img src=\"./css/bbcode/FeslyBBcodeStyle/img/close_rev.gif\" border=\"0\" height=\"11\" width=\"12\" alt=\"close\" class=\"image_close\"></a></div></div><div class=\"palette_body\">'+palette+'</div>';

}

function closePalette2() {
    id = "marker_palette";

    if (document.getElementById) {
        obj = document.getElementById(id).style;
    }
    else if (document.all){
        obj = document.all[id].style;
    }

    obj.display="none";
}

function getMousePosition(evt) {
    var mouse = {x:null, y:null};

    if (window.opera) {     
        mouse.x = evt.clientX;
        mouse.y = evt.clientY;
    } else if (document.all) {
        mouse.x = event.clientX + document.body.scrollLeft;
        mouse.y = event.clientY + document.body.scrollTop;
    } else if (document.getElementById) {
        mouse.x = evt.pageX;
        mouse.y = evt.pageY;
    }
    return mouse;
}
