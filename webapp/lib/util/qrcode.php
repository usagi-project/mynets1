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

// QRコード生成用モジュールの呼び出します
require_once('QRcode/qr_img.php');


// 文字コードをUTF-8に変換します
//$_POST['data'] = mb_convert_encoding($_POST['data'], 'utf-8', 'auto');

// QRコードを生成します
//qr_code_create($_POST['data'], $_POST['err_level'], $_POST['size'], $_POST['ver'], $path, $image_path);
//qr_code_create($_POST['data'], "M","3" , "0", $path, $image_path);


function QRcode($funcpath,$funcname,$show="show",$param="",$limit=30)
{
// 各バージョンの計算結果のパスを指定します
$path=OPENPNE_LIB_DIR . '/include/QRcode/data';

// QRコードの固定値パターン画像のパスを指定します
$image_path=OPENPNE_LIB_DIR . '/include/QRcode/image';
//  ini_set('display_errors', false);

  $ntime = time();
  $seq = 0;
  while(is_readable($filename = OPENPNE_VAR_DIR.'/tmp/'.$ntime.'-'.$seq.'.qr'))
     $seq++;
  $fp=fopen($filename,"w");
  fwrite($fp,"TIME=$ntime\n");
  fwrite($fp,"LIMIT=$limit\n");
  fwrite($fp,"PATH=$funcpath\n");
  fwrite($fp,"FUNC=$funcname\n");
  fwrite($fp,"PARAM=$param\n");
  fclose($fp);
  if( $show == "show") {
    $data = OPENPNE_URL . 'qr.php?' . $ntime . '-' . $seq;
    $img = qr_code_create($data, "M","3" , "0", $path, $image_path);
    ob_start("ob_gzhandler");
    print($img);
    ob_end_flush();
  }
  return $ntime . '-' . $seq;
}
?>
