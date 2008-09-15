<?php
/*
 * ------------------------------------------------------------
 * @license    This source file is subject to version 3.01 of the PHP license,
 *             that is available at http://www.php.net/license/3_01.txt
 *             If you did not receive a copy of the PHP license and are unable
 *             to obtain it through the world-wide-web, please send a note to
 *             license@php.net so we can mail you a copy immediately.
 *             And this source is based on as follows
 *               BB Code Plugin - SmartyWiki
 *               http://smarty.incutio.com/?page=BBCodePlugin
 * @category   BBCode Smarty Plugin
 * @project    OpenPNE Extension Module Project 2007
 * @package    BBCode Input Suppot Module
 * @author     Naoya Shimada
 * @copyright  2007 Naoya Shimada
 * @version    0.6.0
 * @since      File available since Release OpenPNE 2.6.8,2.8.1, MyNETS 1.1.0 Nighty
 * @chengelog  [2007/05/13] Improved modifier.bbcode2html for OpenPNE
 *             [2007/07/05] Changed for MyNETS 1.1.0 Nighty
 *             [2007/08/07] Changed for for Special Tags of OpenPNE/MyNETS
 *                          Add Modifier for Cellular Phone
 * ------------------------------------------------------------
 */
function smarty_modifier_bbcode2html($message,$allowWiki=TRUE,$allowUrl=TRUE,$allowImg=TRUE,$imgWidth=120)
{
	//OpenPNE専用タグを有効にするか否か
	if(!defined('BBCODE_USE_PNE_TAG')) {
		define('BBCODE_USE_PNE_TAG',false);
	}

	//OpenPNE専用タグを有効にした場合、smarty_modifier_t_url2pneを優先するか否か
	//携帯からのアクセスでは、常にsmarty_modifier_t_url2pneを優先するが、
	//smarty_modifier_t_url2pneが存在しない場合は独自に処理する。
	if(!defined('BBCODE_USE_T_URL2PNE')) {
		define('BBCODE_USE_T_URL2PNE',false);
	}

	$cdir = dirname(__FILE__);
	if(file_exists($cdir . '/modifier.t_url2pne.php')) {
		require_once $cdir . '/modifier.t_url2pne.php';
	}

	//PCの場合と携帯の場合を分ける
	if (!isKtaiUserAgent()) {
		//PCの場合
		require_once $cdir . '/modifier.bbcode2html4pc.php';
		$message = smarty_modifier_bbcode2html4pc($message,$allowUrl,$allowImg,$imgWidth);
	}else{
		//携帯の場合
		require_once $cdir . '/modifier.bbcode2html4ktai.php';
		$message = smarty_modifier_bbcode2html4ktai($message,$allowUrl,$allowImg,$imgWidth);
	}
	return $message;
}

?>
