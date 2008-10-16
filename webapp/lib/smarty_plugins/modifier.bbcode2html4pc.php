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
 * @version    0.2.0
 * @since      File available since Release OpenPNE 2.6.9,2.8.2, MyNETS 1.1.0 Nighty
 * @chengelog  [2007/08/07] Modifier for PC
 *             [2007/08/17] Modified Regular Expression [url=] and [url=][img][/img][/url]
 *             [2007/09/19] Add [slideshare]
 *             [2007/10/17] Add embed tag of Yahoo! blog for PeeVee.TV
 *             [2007/10/22] Add [URL=][IMG] tag for Photobucket
 *             [2007/11/01] Add item tag of Yahoo! blog for ALPSLAB clip!
 *             [2007/12/24] Fix XSS vulnerability
 * ------------------------------------------------------------
 */

function smarty_modifier_bbcode2html4pc($message,$allowWiki=TRUE,$allowUrl=TRUE,$allowImg=TRUE,$imgWidth=120)
{
    //空白のHTMLユニコード化と[bbcode][noparse]タグ内の非タグ化
    $preg = array(
        '/\[bbcode\][\r\n]*(.*?)\[\/bbcode\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi' => '"<div class=\"bb-bbcode\">".preg_replace(array(\'/#/\',\'/^<br\s*\/?>/si\',\'/\[/\',\'/\]/\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("&#35;","","&#91;","&#93;","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br />","&#58;"),"\\1")."</div>"',
        '/\[noparse\][\r\n]*(.*?)\[\/noparse\]/esi' => 'preg_replace(array(\'/#/\',\'/^<br\s*\/?>/si\',\'/\[/\',\'/\]/\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("&#35;","","&#91;","&#93;","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br />","&#58;"),"\\1")'
    );
    $message = preg_replace(array_keys($preg), array_values($preg), $message);

    //[code][php][phpsrc]タグ内
    $preg = array(
        // [code] & [php] & [phpsrc]
        '/\[code\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/code\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi' =>
            '"<div class=\"bb-code\" style=\"font-family:monospace\">".preg_replace(array(\'/^<br\s*\/?>/si\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br />","&#58;"),"\\2")."</div>"',
        '/\[php\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/php\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi'      => '"<div class=\"bb-php\" style=\"font-family:monospace\">".preg_replace(array(\'/^<br\s*\/?>/si\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br />","&#58;"),"\\2")."</div>"',
        '/\[phpsrc\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/phpsrc\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi'    => '"<div class=\"bb-php\" style=\"font-family:monospace\">".preg_replace(array(\'/^<br\s*\/?>/si\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br />","&#58;"),"\\2")."</div>"',
    );
    $message = preg_replace(array_keys($preg), array_values($preg), str_replace("'", "&rsquo;", str_replace("$", "_d_", $message)));

    $preg = array(
        '/\[color=(#[a-fA-F0-9]{3,6}|[a-zA-Z ]*)\](.*?)\[\/color\]/si'  => "<span style=\"color:\\1\">\\2</span>",
        '/\[size=([0-9]+)(pt|pc|px|em|ex|mm|cm|in|%)\](.*?)\[\/size\]/si'   => "<span class=\"bb-height\" style=\"font-size:\\1\\2\">\\3</span>",
        '/\[size=(x{1,2}\-small|small|medium|large|x{1,2}\-large)\](.*?)\[\/size\]/si'      => "<span class=\"bb-size-\\1\">\\2</span>",
        '/\[large\](.*?)\[\/large\]/si'          => "<span style=\"font-size:120%; line-height:100%;\">\\1</span>",
        '/\[small\](.*?)\[\/small\]/si'          => "<span style=\"font-size:80%; line-height:100%;\">\\1</span>",
        '/\[font=(?:&quot;|"|&#039;|\')?([^(&quot;|&#039)"\'\[\]]*?)(?:&quot;|"|&#039;|\')?\](.*?)\[\/font\]/si'    => '<span style="font-family:\'\\1\'">\\2</span>',
        '/\[align=(left|right|center|justify)\](.*?)\[\/align\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<div style=\"text-align:\\1\">\\2</div>",
        '/\[b\](.*?)\[\/b\]/si'                 => "<span class=\"bb-bold\">\\1</span>",
        '/\[strong\](.*?)\[\/strong\]/si'       => "<strong>\\1</strong>",
        '/\[em\](.*?)\[\/em\]/si'               => "<em>\\1</em>",
        '/\[i\](.*?)\[\/i\]/si'                 => "<span class=\"bb-italic\">\\1</span>",
        '/\[u\](.*?)\[\/u\]/si'                 => "<span class=\"bb-underline\">\\1</span>",
        '/\[center\](.*?)\[\/center\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'  => "<div class=\"bb-center\">\\1</div>",
        '/\[left\](.*?)\[\/left\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'      => "<div class=\"bb-left\">\\1</div>",
        '/\[right\](.*?)\[\/right\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<div class=\"bb-right\">\\1</div>",
        '/\[justify\](.*?)\[\/justify\]/si'      => "<div style=\"text-align:justify;\">\\1</div>",
        '/\[s\](.*?)\[\/s\]/si'                     => "<span class=\"bb-through\">\\1</span>",
        '/\[strike\](.*?)\[\/strike\]/si'           => "<span class=\"bb-through\">\\1</span>",
        '/\[del\](.*?)\[\/del\]/si'                 => "<span class=\"bb-through\">\\1</span>",
        '/\[d\](.*?)\[\/d\]/si'                  => "<span style=\"text-decoration:line-through;\">\\1</span>",
        '/\[linethrough\](.*?)\[\/linethrough\]/si' => "<span class=\"bb-through\">\\1</span>",
        '/\[sub\](.*?)\[\/sub\]/si'                 => "<sub>\\1</sub>",
        '/\[sup\](.*?)\[\/sup\]/si'                 => "<sup>\\1</sup>",
//      '/\[tt\](.*?)\[\/tt\]/si'                   => "<tt>\\1</tt>",
        '/\[tt\](.*?)\[\/tt\]/si'                   => "<span class=\"bb-tt\">\\1</span>",
//      '/\[pre\](.*?)\[\/pre\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<pre>\\1</pre>",

        // [email]
        '/\[email\]([a-z0-9\-_\.]+@[a-z0-9\-_\.]+)\[\/email\]/si'       => "<a href=\"mailto:\\1\" class=\"bb-email\">\\1</a>",
        '/\[email=([a-z0-9\-_\.]+@[a-z0-9\-_\.]+)\](.*?)\[\/email\]/si' => "<a href=\"mailto:\\1\" class=\"bb-email\">\\2</a>",

        // [indent]
        '/\[indent\](.*?)\[\/indent\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'          => "<div class=\"bb-indent\">\\1</div>",
        '/\[indent=([0-9]+(?:pt|pc|px|em|ex|mm|cm|in|%))\](.*?)\[\/indent\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<div style=\"text-indent:\\1;\">\\2</div>",

        // [highlight]
        '/\[marker=(.*?)\](.*?)\[\/marker\]/si'  => "<span style=\"background-color:\\1; line-height:100%;\">\\2</span>",
        '/\[highlight\](.*?)\[\/highlight\]/si'         => "<span class=\"bb-highlight\">\\1</span>",
        '/\[highlight=(#[a-fA-F0-9]{3,6}|[a-zA-Z ]+)\](.*?)\[\/highlight\]/si'  => "<span class=\"bb-highlight\" style=\"background-color:\\1\">\\2</span>",

        // [quote]
        '/\[quote\](.*?)\[\/quote\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<div class=\"bb-blockquote\"><div class=\"bb-quote-marks\">Quote:</div><div class=\"bb-quote\">\\1</div><div class=\"bb-float-clear\"></div></div>",
        //'/\[quote=(?:&quot;|"|&#039;|\')?([^(&quot;|&#039)"\'\[\]]*?)(?:&quot;|"|&#039;|\')?\](.*?)\[\/quote\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si' => "<div class=\"bb-blockquote\"><div class=\"bb-quote-marks\">\\1</div><div class=\"bb-quote\">\\2</div><div class=\"bb-float-clear\"></div></div>",
        '/\[quote=Quote\](.*?)\[\/quote\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si' =>  "<div class=\"bb-blockquote\"><div class=\"bb-quote-marks\">Quote:</div><div class=\"bb-quote\">\\1</div><div class=\"bb-float-clear\"></div></div>",
        '/\[quote=(?:&quot;|"|&#039;|\')?(.*?)(?:&quot;|"|&#039;|\')?\](.*?)\[\/quote\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si' => "<div class=\"bb-blockquote\"><div class=\"bb-quote-marks\">\\1</div><div class=\"bb-quote\">\\2</div><div class=\"bb-float-clear\"></div></div>",
        '/\[quo\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/quo\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi' => '"<div class=\"BBcode_Quote\"><blockquote>".preg_replace(array(\'/^<br\s*\/?>/si\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br />","&#58;"),"\\2")."</blockquote></div>"',


        // [list]
        '/(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\*\](.*?)(?:<br\s*\/?>|[\s\r\n]*|\s*)?(?=(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\*|(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\/?list)/si'   => "<li>\\1</li>",
        '/(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\/list\](?:<br\s*\/?>|[\s\r\n]{0,2})?/si'        => "</ul></div>",
        '/\[list\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'     => "<div class=\"bb-list\"><ul class=\"bb-list-unordered\">",
        '/\[list=1\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'   => "<div class=\"bb-list\"><ul class=\"bb-list-ordered bb-list-ordered-dc\">",
        '/\[list=i\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/s'    => "<div class=\"bb-list\"><ul class=\"bb-list-ordered bb-list-ordered-lr\">",
        '/\[list=I\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/s'    => "<div class=\"bb-list\"><ul class=\"bb-list-ordered bb-list-ordered-ur\">",
        '/\[list=a\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/s'    => "<div class=\"bb-list\"><ul class=\"bb-list-ordered bb-list-ordered-la\">",
        '/\[list=A\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/s'    => "<div class=\"bb-list\"><ul class=\"bb-list-ordered bb-list-ordered-ua\">",
        '/\[list=d\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'   => "<div class=\"bb-list\"><ul class=\"bb-list-unordered bb-list-unordered-d\">",
        '/\[list=c\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'   => "<div class=\"bb-list\"><ul class=\"bb-list-unordered bb-list-unordered-c\">",
        '/\[list=s\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'   => "<div class=\"bb-list\"><ul class=\"bb-list-unordered bb-list-unordered-s\">",

        //[marquee][marq]
        '/\[marquee\](.*?)\[\/marquee\]([^<]*)?(<br\s*\/{0,1}>)?/si'                            => "<marquee loop=\"-1\">\\1</marquee>\\2",
        '/\[marquee=(left|right|up|down)\](.*?)\[\/marquee\]([^<]*)?(<br\s*\/{0,1}>)?/si'       => "<marquee direction=\"\\1\" loop=\"-1\">\\2</marquee>\\3",
        '/\[marquee=(scroll|alternate|slide)\](.*?)\[\/marquee\]([^<]*)?(<br\s*\/{0,1}>)?/si'   => "<marquee behavior=\"\\1\" loop=\"-1\">\\2</marquee>\\3",
        '/\[marq\](.*?)\[\/marq\]([^<]*)?(<br\s*\/{0,1}>)?/si'                          => "<marquee loop=\"-1\">\\1</marquee>\\2",
        '/\[marq=(left|right|up|down)\](.*?)\[\/marq\]([^<]*)?(<br\s*\/{0,1}>)?/si'     => "<marquee direction=\"\\1\" loop=\"-1\">\\2</marquee>\\3",
        '/\[marq=(scroll|alternate|slide)\](.*?)\[\/marq\]([^<]*)?(<br\s*\/{0,1}>)?/si' => "<marquee behavior=\"\\1\" loop=\"-1\">\\2</marquee>\\3",

        //[slideshare id=[0-9]+&doc=[a-zA-Z0-9\-]+&w=[0-9]+]
        '/\[slideshare(?:\s|&nbsp;)id=([0-9]+)(?:&amp;|&)doc=([a-zA-Z0-9\-]+)(?:&amp;|&)w=([0-9]+)\]/esi'   => 'smarty_modifier_t_cmd("&lt;cmd src=&quot;slideshare&quot; args=&quot;\\1,\\2&quot;&gt;")',

        //[[embed(http://peevee.tv/pluginplayerv4.swf?video_id=[0-9]+/[0-9]+peevee[0-9]+(\.flv|\.mp4),1,425,380)]]
        '/\[\[embed\(http:\/\/peevee\.tv\/pluginplayerv\d\.swf\?video_id=([0-9]+)\/([0-9]+)peevee([0-9]+)(\.flv|\.mp4)[^\]\)]*\)\]\]/si'    => 'http://peevee.tv/viewvideo.jspx?Movie=\\1/\\2peevee\\3.flv',

        //Photobucket Movie
        '/\[URL=[^\]]+current=([^\]]+)\]\[IMG\]http:\/\/([a-zA-Z]+)([0-9]+)(\.photobucket\.com\/[^\.]+\/video[0-9]+\/)[^\[]+\[\/IMG\]\[\/URL\]/si'  => 'http://photobucket.com/mediadetail/?media=http%3A%2F%2F\\2\\3.photobucket.com%2Fplayer.swf%3Ffile%3Dhttp%3A%2F%2Fvid\\3\\4\\1',

        //ALPSLAB clip! http://www.alpslab.jp/clip_howto.html
        //ALPSLAB base for Yahoo!Blog Tag
        //[[item(http://slide.alpslab.jp/fslide.swf?pos=[FC0-9%\.]+&scale=[0-9]+&link=base,320,240)]]
        '/\[\[item\(http:\/\/slide\.alpslab\.jp\/fslide\.swf\?pos=([FC0-9%\.]+)(?:&amp;|&)scale=([0-9]+)(?:&amp;|&)link=base,[0-9]+,[0-9]+\)\]\]/si'    => 'http://base.alpslab.jp/?s=\\2;p=\\1',
        //ALPSLAB route for Yahoo!Blog Tag
        //[[item(http://route.alpslab.jp/fslide.swf?routeid=[a-z0-9]+,320,240)]]
        '/\[\[item\(http:\/\/route\.alpslab\.jp\/fslide\.swf\?routeid=([a-z0-9]+),[0-9]+,[0-9]+\)\]\]/si'   => 'http://route.alpslab.jp/watch.rb?id=\\1',
    );

    switch ($allowWiki) {
        case TRUE:
            // [Wikipedia]
            $preg['/\[wiki\](.*?)\[\/wiki\]/si'] = "<script type=\"text/javascript\">document.write('<a href=\"http\:\/\/www.wikipedia.org/search-redirect.php?language=ja&go=Go&search=\\1\" target=\"_blank\" title=\"Wikipediaで\\1を照会\">\\1<'+'/a>');</script><noscript>\\1</noscript>";
            break;
        case FALSE:
        default:
            break;
    }

    switch ($allowUrl) {
        case TRUE:
            // [url] for OpenPNE
            $preg['/\[url=(?:&quot;|"|&#039;|\')?(https?)?(:\/\/|\.{0,2}\/)([^\]]+?)(?:&quot;|"|&#039;|\')?\](.*?)\[img\](https?)?(:\/\/|\.{0,2}\/)(.+?)\[\/img\](.*?)\[\/url\]/si'] = "<script type=\"text/javascript\">document.write('<a href=\"\\1'+'\\2\\3\" target=\"_blank\" title=\"\\1'+'\\2\\3\" class=\"bb-url\">\\4<img src=\"\\5'+'\\6\\7\" alt=\"\\5'+'\\6\\7\" class=\"bb-image\" width=\"".$imgWidth."\">\\8<'+'/a>');</script><noscript>\\1\\2\\3</noscript>";
            $preg['/\[url=(?:&quot;|"|&#039;|\')?(https?)?(:\/\/|\.{0,2}\/)([^\]]+?)(?:&quot;|"|&#039;|\')?\](.*?)\[img=(.*?)x(.*?)\](https?)?(:\/\/|\.{0,2}\/)(.+?)\[\/img\](.*?)\[\/url\]/si'] = "<script type=\"text/javascript\">document.write('<a href=\"\\1'+'\\2\\3\" target=\"_blank\" title=\"\\1'+'\\2\\3\" class=\"bb-url\">\\4<img src=\"\\7'+'\\8\\9\" alt=\"\\7'+'\\8\\9\" class=\"bb-image\" width=\"\\5\" height=\"\\6\">\\{10}<'+'/a>');</script><noscript>\\1\\2\\3</noscript>";
            $preg['/\[url\](https?)?(:\/\/|\.{0,2}\/)([^\[]+?)\[\/url\]/si'] = "<script type=\"text/javascript\">document.write('<a href=\"\\1'+'\\2\\3\" target=\"_blank\" title=\"\\1'+'\\2\\3\" class=\"bb-url\">\\1'+'\\2\\3<'+'/a>');</script><noscript>\\1\\2\\3</noscript>";
            $preg['/\[url=(?:&quot;|"|&#039;|\')?(https?)?(:\/\/|\.{0,2}\/)([^\]]+?)(?:&quot;|"|&#039;|\')?\][^:\[]*https?[^:]*:\/\/(.*?)\[\/url\]/si'] = "<script type=\"text/javascript\">document.write('<a href=\"\\1'+'\\2\\3\" target=\"_blank\" title=\"\\1'+'\\2\\3\">\\1'+'\\2\\3<'+'/a>');</script><noscript>\\1\\2\\3</noscript>";
            $preg['/\[url=(?:&quot;|"|&#039;|\')?(https?)?(:\/\/|\.{0,2}\/)([^\]]+?)(?:&quot;|"|&#039;|\')?\](.*?)\[\/url\]/si'] = "<script type=\"text/javascript\">document.write('<a href=\"\\1'+'\\2\\3\" target=\"_blank\" title=\"\\1'+'\\2\\3\">\\4<'+'/a>');</script><noscript>\\1\\2\\3</noscript>";
            break;
        case FALSE:
        default:
            break;
    }

    switch ($allowImg) {
        case TRUE:
            // [img] for OpenPNE
            $preg['/\[img\](https?)?(:\/\/|\.{0,2}\/)(.+?)\[\/img\]/si'] = "<script type=\"text/javascript\">document.write('<a href=\"\\1'+'\\2\\3\" target=\"_blank\" title=\"\\1'+'\\2\\3\"><img src=\"\\1'+'\\2\\3\" alt=\"\\1'+'\\2\\3\" class=\"bb-image\" width=\"".$imgWidth."\"><'+'/a>');</script><noscript>\\1\\2\\3</noscript>";
            $preg['/\[img=([0-9]+)x([0-9]+)\](https?)?(:\/\/|\.{0,2}\/)(.+?)\[\/img\]/si'] = "<script type=\"text/javascript\">document.write('<a href=\"\\3'+'\\4\\5\" target=\"_blank\" title=\"\\3'+'\\4\\5\"><img width=\"\\1\" height=\"\\2\" src=\"\\3'+'\\4\\5\" alt=\"\\3'+'\\4\\5\" class=\"bb-image\"><'+'/a>');</script><noscript>\\3\\4\\5</noscript>";
            break;
        case FALSE:
        default:
            break;
    }

    /*
    $cdir = dirname(__FILE__);
    require_once $cdir . '/modifier.bbcode2html4pne.php';
    $preg = _smarty_modifier_link4pnetags($preg);
    */
    $search = array('\\', '&#039;');
    $replace = array('\\\\', "\'");
    $message = str_replace($search, $replace, $message);

    while ( ($message2 = preg_replace(array_keys($preg), array_values($preg), $message)) != $message) {
        $message = $message2;
    }

    return $message;
}

?>
