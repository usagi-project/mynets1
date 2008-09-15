<?php


function cmd_anketo_main($param,$body) {
  global $anketo_count;
  $anketo_count = 0;
  $regexp = '/^-(.+)$/m';
  $body = preg_replace_callback($regexp, 'cmd_anketo_callback1', $body);
  $regexp = '/\{([^\}]+)\}/s';

  $result = preg_replace_callback($regexp, 'cmd_anketo_callback2', $body);
  return '<form method="POST" action="" enctype="multipart/form-data">' . $result
. '<br /><input type="submit" value="投稿する"/></form>';

}

/* 項目行の処理 */
function cmd_anketo_callback1($matches) {
  return '<span style="font-weight:bold;font-size:11pt;">' . $matches[1] . '</span>';
}

/* 1項目の処理*/
function cmd_anketo_callback2($matches) {
  global $anketo_count;
  $anketo_count++;
  $tmp=split("[ ,\n]",$matches[1]);
  $result = '';

  foreach($tmp as $value) {
    if( $value == '' ) continue;
    $result .= '<input type="checkbox" name="anketo' . $anketo_count . '" value="' . $value . '" />' . $value . ' ';
  }
  return $result;
  return '<font color="red">' . $matches[1] . '</font>';
}
?>
