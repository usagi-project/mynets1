<?php
/*
 * ------------------------------------------------------------
 * @license    This source file is subject to version 3.01 of the PHP license,
 *             that is available at http://www.php.net/license/3_01.txt
 *             If you did not receive a copy of the PHP license and are unable
 *             to obtain it through the world-wide-web, please send a note to
 *             license@php.net so we can mail you a copy immediately.
 * @category   BBCode Smarty Plugin
 * @project    OpenPNE Extension Module Project 2007
 * @package    BBCode Input Suppot Module
 * @author     Naoya Shimada
 * @copyright  2007 Naoya Shimada
 * @version    0.6.5
 * @since      File available since Release OpenPNE 2.6.8,2.8.1, MyNETS 1.1.0 Nighty
 * @chengelog  [2007/05/13] This plugin was made based on modifier.bbcode2html for OpenPNE
 *             [2007/07/05] Changed for MyNETS 1.1.0 Nighty
 *             [2007/08/07] Changed for Special Tags of OpenPNE/MyNETS
 *             [2007/08/09] Fixed Compilation failed([list]&[/list])
 *             [2007/08/17] Modified Regular Expression [bbcode][noparse][code][php][phpsrc][url=][list]
 *             [2007/10/17] Add embed tag of Yahoo! blog for PeeVee.TV and [slideshare]
 *             [2007/11/01] Add item tag of Yahoo! blog for ALPSLAB clip!
 * ------------------------------------------------------------
 */
function smarty_modifier_bbcode2del($message) {
	//空白のHTMLユニコード化と[bbcode][noparse]タグ内の非タグ化
	$preg = array(
		'/\[bbcode\][\r\n]*(.*?)\[\/bbcode\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi' => 'preg_replace(array(\'/\[/\',\'/\]/\'),array("&#91;","&#93;"),"\\1")',
		'/\[noparse\][\r\n]*(.*?)\[\/noparse\]/esi' => 'preg_replace(array(\'/\[/\',\'/\]/\'),array("&#91;","&#93;"),"\\1")'
	);
	$message = preg_replace(array_keys($preg), array_values($preg), $message);

	//[code][php][phpsrc]タグ内
	$preg = array(
		// [code] & [php] & [phpsrc]
		'/\[code\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/code\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'		=> '\\2',
		'/\[php\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/php\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'		=> '\\2',
		'/\[phpsrc\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/phpsrc\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'	=> '\\2',
	);
	$message = preg_replace(array_keys($preg), array_values($preg), $message);

	$preg = array(
		'/\[color=(.*?)\](.*?)\[\/color\]/si'	=> "\\2",
		'/\[color\](.*?)\[\/color\]/si'			=> "\\2",
		'/\[size=(.*?)\](.*?)\[\/size\]/si'		=> "\\2",
		'/\[font=(?:&quot;|"|&#039;|\')?(.*?)(?:&quot;|"|&#039;|\')?\](.*?)\[\/font\]/si'	=> "\\2",
		'/\[large\](.*?)\[\/large\]/si'	 		=> "\\1",
		'/\[small\](.*?)\[\/small\]/si'			=> "\\1",
		'/\[align=(.*?)\](.*?)\[\/align\]/si'	=> "\\2",
		'/\[b\](.*?)\[\/b\]/si'					=> "\\1",
		'/\[strong\](.*?)\[\/strong\]/si'		=> "\\1",
		'/\[em\](.*?)\[\/em\]/si'				=> "\\1",
		'/\[i\](.*?)\[\/i\]/si'					=> "\\1",
		'/\[u\](.*?)\[\/u\]/si'					=> "\\1",
		'/\[center\](.*?)\[\/center\]/si'		=> "\\1",
		'/\[left\](.*?)\[\/left\]/si'			=> "\\1",
		'/\[right\](.*?)\[\/right\]/si'			=> "\\1",
		'/\[justify\](.*?)\[\/justify\]/si'		=> "\\1",
		'/\[s\](.*?)\[\/s\]/si'					=> "\\1",
		'/\[strike\](.*?)\[\/strike\]/si'		=> "\\1",
		'/\[del\](.*?)\[\/del\]/si'				=> "\\1",
		'/\[d\](.*?)\[\/d\]/si'					=> "\\1",
		'/\[linethrough\](.*?)\[\/linethrough\]/si' => "\\1",
		'/\[sub\](.*?)\[\/sub\]/si'				=> "\\1",
		'/\[sup\](.*?)\[\/sup\]/si'				=> "\\1",
		'/\[tt\](.*?)\[\/tt\]/si'				=> "\\1",
//		'/\[pre\](.*?)\[\/pre\]/si'				=> "\\1",
		// [email]
		'/\[email\](.*?)\[\/email\]/si' 		=> "\\1",
		'/\[email=(.*?)\](.*?)\[\/email\]/si'	=> "\\2",
		// [indent]
		'/\[indent\](.*?)\[\/indent\]/si'		=> "\\1",
		'/\[indent=(.*?)\](.*?)\[\/indent\]/si' => "\\2",
		// [highlight]
		'/\[highlight\](.*?)\[\/highlight\]/si'			=> "\\1",
		'/\[highlight=(.*?)\](.*?)\[\/highlight\]/si'	=> "\\2",
		'/\[marker=(.*?)\](.*?)\[\/marker\]/si'	 => "\\2",
		'/\[wiki\](.*?)\[\/wiki\]/si'				=> "\\1",
		// [url]
		'/\[url\](.*?)\[\/url\]/si'				=> "\\1",
		'/\[url=(?:&quot;|"|&#039;|\')?(.*?)?(?:&quot;|"|&#039;|\')?\](.*?)\[\/url\]/si'	=> "\\4\n\\2",
		// [img]
		'/\[img\](.*?)\[\/img\]/si'				=> "\\1",
		'/\[img=(.*?)x(.*?)\](.*?)\[\/img\]/si' => "\\3",
		// [quote]
		'/\[quote\](.*?)\[\/quote\]/si'			=> "\\1",
		'/\[quo\](.*?)\[\/quo\]/si'				=> "\\1",
		'/\[quote=(?:&quot;|"|&#039;|\')?(.*?)(?:&quot;|"|&#039;|\')?\](.*?)\[\/quote\]/si'	=> "\\2",
		// [list]
		'/(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\*\](.*?)(?:<br\s*\/?>|[\s\r\n]*|\s*)?(?=(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\*|(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\/?list)/si'	=> "\n\\1",
		'/(?:<br\s*\/?>|[\s\r\n]*|\s*)?\[\/?list\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'	=> "\n",
		'/(?:<br\s*\/?>|[\s\r\n]*|\s*)?\[list=.\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'	=> "",

		//[marquee][marq]
		'/\[marquee\](.*?)\[\/marquee\]/si'			=> "\\1",
		'/\[marquee=(.*?)\](.*?)\[\/marquee\]/si'	=> "\\2",
		'/\[marq\](.*?)\[\/marq\]/si'				=> "\\1",
		'/\[marq=(.*?)\](.*?)\[\/marq\]/si'			=> "\\2",

		//[slideshare id=[0-9]+&doc=[a-zA-Z0-9\-]+&w=[0-9]+]
		'/\[slideshare(?:\s|&nbsp;)id=([0-9]+)(?:&amp;|&)doc=([a-zA-Z0-9\-]+)(?:&amp;|&)w=([0-9]+)\]/si'	=> '',

		//[[embed(http://peevee.tv/pluginplayerv4.swf?video_id=[0-9]+/[0-9]+peevee[0-9]+(\.flv|\.mp4),1,425,380)]]
		'/\[\[embed\(http:\/\/peevee\.tv\/pluginplayerv\d\.swf\?video_id=([0-9]+)\/([0-9]+)peevee([0-9]+)(\.flv|\.mp4)[^\]\)]*\)\]\]/si'	=> 'http://peevee.tv/viewvideo.jspx?Movie=\\1/\\2peevee\\3.flv',

		//ALPSLAB clip! http://www.alpslab.jp/clip_howto.html
		//ALPSLAB base for Yahoo!Blog Tag
		//[[item(http://slide.alpslab.jp/fslide.swf?pos=[FC0-9%\.]+&scale=[0-9]+&link=base,320,240)]]
		'/\[\[item\(http:\/\/slide\.alpslab\.jp\/fslide\.swf\?pos=([FC0-9%\.]+)(?:&amp;|&)scale=([0-9]+)(?:&amp;|&)link=base,[0-9]+,[0-9]+\)\]\]/si'	=> 'http://base.alpslab.jp/?s=\\2;p=\\1',
		//ALPSLAB route for Yahoo!Blog Tag
		//[[item(http://route.alpslab.jp/fslide.swf?routeid=[a-z0-9]+,320,240)]]
		'/\[\[item\(http:\/\/route\.alpslab\.jp\/fslide\.swf\?routeid=([a-z0-9]+),[0-9]+,[0-9]+\)\]\]/si'	=> 'http://route.alpslab.jp/watch.rb?id=\\1',
	);

	//OpenPNE専用タグを有効にするか否か
	if(!defined('BBCODE_USE_PNE_TAG')) {
		define('BBCODE_USE_PNE_TAG',false);
	}

	$cdir = dirname(__FILE__);
	if(file_exists($cdir . '/modifier.t_url2pne.php')) {
		require_once $cdir . '/modifier.t_url2pne.php';
	}
	require_once $cdir . '/modifier.bbcode2del4pne.php';
	$preg = _smarty_modifier_delete_link4pnetags($preg);

	while ( ($message2 = preg_replace(array_keys($preg), array_values($preg), $message)) != $message) {
		$message = $message2;
	}

	$message = preg_replace(array('/&#91;/','/&#93;/'), array('[',']'), $message);

	return $message;
}
?>
