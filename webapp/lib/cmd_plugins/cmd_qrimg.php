<?php

function cmd_qrimg_main($param,$body) {
   if(isset($param['url'])) {
   $search = array('&amp;');
   $replace = array('&', );
   $string = str_replace($search, $replace, $param['url']);
   $regexp = '/(https?:\/\/[a-zA-Z0-9\-.]+\/?[\w\-.,:;~^\/?@=+\$%#!()*&]*)/';
   $result= QRcode(OPENPNE_WEBAPP_DIR.'/lib/cmd_plugins/qrurl.php','qrurl',"hide",$string);
   return '<img src="qrimg.php?'.$result.'">';
   } else
     return '';
}
?>
