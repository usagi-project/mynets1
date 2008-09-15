({********初期設定用ファイルインクルード********})
<script type="text/javascript" src="js/javascripts/jquery-1.1.js"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script type="text/javascript" src="js/javascripts/prototype.js"> </script>
<script type="text/javascript" src="js/javascripts/debug.js"> </script>
<link href="js/themes/default.css" rel="stylesheet" type="text/css">
<!-- Add this to have a specific theme-->
<link href="js/themes/default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/javascripts/thickbox.js"></script>
<script type="text/javascript">
<!--

TextFiledClassName_normal = 'text';
TextFiledClassName_focus  = 'text_focus';

Event.observe(window, 'load', setFocusClass, false);

function setFocusClass() {
    var TFs = $A(document.getElementsByClassName(TextFiledClassName_normal));
    TFs.each(function (node){
        node.TFclass = node.className;
        node.TFclass_onfocus = TextFiledClassName_focus;
        node.onfocus = function() { this.className = this.TFclass_onfocus; };
        node.onblur  = function() { this.className = this.TFclass; };
    });
}
/*
Event.observe(window, 'load', setSubmitFunction, false);

function setSubmitFunction() {
    var SFs = $A(document.getElementsByTagName('form'));
    SFs.each(function (node){
        node.onsubmit = function() {
            var obj= $A(node.elements);
            obj.each( function(n){if(n.type== 'submit') n.disabled= true;})
        };
    });
}
*/
//-->
</script>
({********初期設定用ファイルインクルード********})
