var onclick_function;
var pos_x = 0;
var pos_y = 0;
var palette_width = 94;
var adv_x = 350;

function openPalette(event) {
    id = "color_palette";

    var mouse = getMousePosition(event);
    
    if (document.getElementById) {
        obj = document.getElementById(id).style; 
    } else if (document.all){
        obj = document.all[id].style;
    }   
    
    showPalette();
    var scroll_x = (window.opera) ? window.pageXOffset : 0;
    var scroll_y = (window.opera) ? window.pageYOffset : 0;
    var mouse    = getMousePosition(event);
    var pos_x    = mouse + scroll_x;
    var pos_y    = mouse + scroll_y;
    var limit_x  = adv_x - palette_width;

    if (pos_x > limit_x) {
        pos_x -= (pos_x - limit_x);
    }

    var obj = (document.getElementById) ? document.getElementById(id).style :
              (document.all)            ? document.all[id].style            : null; 
    
    obj.display = "block";
    obj.zIndex = 2;
}

function showPalette() {
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
            "<a href=\"javascript:change_font_color(document.editForm.body, '"+colors[current]+"')\""+
            "style=\"background-color: transparent; color:"+colors[current]+"; text-decoration: none;\" onClick=\"closePalette();\""+
            "onMouseOver=\"document.getElementById('plt"+current+"').src='./css/bbcode/FeslyBBcodeStyle/img/mouse_over.gif'\" onMouseOut=\"document.getElementById('plt"+current+"').src='./skin/dummy.gif'\">"+
            "<img src=\""+imgUrl+"\" border=\"0\" width=\"14\" height=\"14\" id=\"plt"+current+"\"/>"+
            "</a></td>"; 
            current++;
            j++;
        }
        palette+="</tr>";
        j=0;
        i++;
    }
    palette+="</table>";

    document.getElementById("color_palette").innerHTML = '<div align=\"left\" class=\"palette_title\" onClick=\"closePalette();\"><div class=\"palette_title_left\">&nbsp;&nbsp;文字色&nbsp;&nbsp;</div><div class=\"palette_title_right\"><a href=\"javascript:void(0)\" class=\"image_close\"><img src=\"./css/bbcode/FeslyBBcodeStyle/img/close_rev.gif\" border=\"0\" height=\"11\" width=\"12\" alt=\"close\" class=\"image_close\"></a></div></div><div class=\"palette_body\">'+palette+'</div>';

}

function closePalette() {
    id = "color_palette";

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
