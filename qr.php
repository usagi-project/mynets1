<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable 
 *              to obtain it through the world-wide-web, please send a note to 
 *              license@php.net so we can mail you a copy immediately.  
 *
 * @category   Application of MyNETS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.1.0 Nighty
 * @chengelog  [2007/06/09] Ver1.1.0Nighty package
 * ======================================================================== 
 */

/*  OPENPNE_VAR_DIR/tmp/ファイル.qrの書式
 *  TIME=時刻
 *  LIMIT=有効時間(分)
 *  PATH=関数があるパス
 *  FUNC=関数名
 *  PARAM=パラメータ
 *
**/

ob_start();
require_once './config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';
ob_clean();

$url = $_SERVER["QUERY_STRING"];

$filename = OPENPNE_VAR_DIR . '/tmp/' . $url . '.qr';
if(is_readable($filename) && $fp=file($filename)) {
  /* 連想配列にする */
  $args = array();
  foreach($fp as $var) {
    if($line=rtrim($var))
      if(count($line = split('=',$line))==2) {
         $args[$line[0]]=$line[1];
      }
  }
  $dtime = time() - intval($args['TIME']);
  if($dtime < intval($args['LIMIT'])*60) {
    if(is_readable($args['PATH'])) {
      require_once $args['PATH'];
      if(function_exists($args['FUNC'])) {
         @$args['FUNC']($args['PARAM']);
         exit;
      } else
        $error="Unknown function ".$args['FUNC'];
    } else
      $error="Unknown file ".$args['PATH'];
  } else
    $error="Over Time";
//   unlink($filename);
}
echo <<<EOT
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS"/>
<title>NO URL</title>
</head>
<body>
<p>Error="$error</p>
</body>
</html>
EOT;

?>
