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
 * @chengelog  [2007/08/07] Modifier for Cellular Phone
 *             [2007/08/17] Modified Regular Expression [url=] and [url=][img][/img][/url]
 *             [2007/10/17] Add embed tag of Yahoo! blog for PeeVee.TV and [slideshare]
 *             [2007/10/22] Add [URL=][IMG] tag for Photobucket
 *             [2007/11/01] Add item tag of Yahoo! blog for ALPSLAB clip!
 *             [2007/12/24] Fix XSS vulnerability
 * ------------------------------------------------------------
 */

function smarty_modifier_bbcode2html4ktai($message,$allowWiki=TRUE,$allowUrl=TRUE,$allowImg=TRUE,$imgWidth=120)
{
    //空白のHTMLユニコード化と[bbcode][noparse]タグ内の非タグ化
    $preg = array(
        '/\[bbcode\][\r\n]*(.*?)\[\/bbcode\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi' => '"<pre>".preg_replace(array(\'/#/\',\'/^<br\s*\/?>/si\',\'/\[/\',\'/\]/\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("&#35;","","&#91;","&#93;","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br>","&#58;"),"\\1")."</pre>"',
        '/\[noparse\][\r\n]*(.*?)\[\/noparse\]/esi' => 'preg_replace(array(\'/#/\',\'/^<br\s*\/?>/si\',\'/\[/\',\'/\]/\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("&#35;","","&#91;","&#93;","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br>","&#58;"),"\\1")'
    );
    $message = preg_replace(array_keys($preg), array_values($preg), $message);

    //[code][php][phpsrc]タグ内
    $preg = array(
        // [code] & [php] & [phpsrc]
        '/\[code\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/code\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi'        => '"<pre>".preg_replace(array(\'/^<br\s*\/?>/si\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br>","&#58;"),"\\2")."</pre>"',
        '/\[php\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/php\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi'      => '"<pre>".preg_replace(array(\'/^<br\s*\/?>/si\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br>","&#58;"),"\\2")."</pre>"',
        '/\[phpsrc\](<br\s*\/{0,1}>|[\r\n]*)?(.*?)\[\/phpsrc\](<br\s*\/{0,1}>|[\r\n]{0,2})?/esi'    => '"<pre>".preg_replace(array(\'/^<br\s*\/?>/si\',\'/ /\',\'/\t/\',\'/<br&nbsp;\/>/si\',\'/:/\'),array("","&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;","<br>","&#58;"),"\\2")."</pre>"',
    );
    $message = preg_replace(array_keys($preg), array_values($preg), str_replace("'", "&rsquo;", str_replace("$", "_d_", $message)));

    $preg = array(
        '/\[color=(#[a-fA-F0-9]{3,6}|[a-zA-Z ]*)\](.*?)\[\/color\]/si'  => "<font color=\"\\1\">\\2</font>",
//      '/\[size=(.*?)(pt|pc|px|em|ex|mm|cm|in|%)\](.*?)\[\/size\]/si'  => "<span style=\"font-size:\\1\">\\2</span>",
//      '/\[size=(.*?)\](.*?)\[\/size\]/si'     => "<span style=\"font-size:\\1\">\\2</span>",
        '/\[size=(.*?)\](.*?)\[\/size\]/esi'    => '_smarty_modifier_fontsize2size("\\1","\\2")',
        '/\[font=(?:&quot;|"|&#039;|\')?([^(&quot;|&#039)"\'\[\]]*?)(?:&quot;|"|&#039;|\')?\](.*?)\[\/font\]/si'    => "\\2",
        '/\[large\](.*?)\[\/large\]/si'          => "<span style=\"font-size:120%; line-height:100%;\">\\1</span>",
        '/\[small\](.*?)\[\/small\]/si'          => "<span style=\"font-size:80%; line-height:100%;\">\\1</span>",
        '/\[align=(left|right|center|justify)\](.*?)\[\/align\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<div style=\"text-align:\\1\">\\2</div>",
        '/\[b\](.*?)\[\/b\]/si'                 => "<span style=\"font-weight:bold\">\\1</span>",
        '/\[strong\](.*?)\[\/strong\]/si'       => "<strong>\\1</strong>",
        '/\[em\](.*?)\[\/em\]/si'               => "<span style=\"font-style:italic\">\\1</span>",
        '/\[i\](.*?)\[\/i\]/si'                 => "<span style=\"font-style:italic\">\\1</span>",
        '/\[u\](.*?)\[\/u\]/si'                 => "<span style=\"text-decoration:underline\">\\1</span>",
        '/\[center\](.*?)\[\/center\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'  => "<div style=\"text-align:center\">\\1</div>",
        '/\[left\](.*?)\[\/left\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'      => "<div style=\"text-align:left\">\\1</div>",
        '/\[right\](.*?)\[\/right\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<div style=\"text-align:right\">\\1</div>",
        '/\[justify\](.*?)\[\/justify\]/si'      => "<div style=\"text-align:justify;\">\\1</div>",
        '/\[s\](.*?)\[\/s\]/si'                     => "<span style=\"text-decoration:line-through\">\\1</span>",
        '/\[strike\](.*?)\[\/strike\]/si'           => "<span style=\"text-decoration:line-through\">\\1</span>",
        '/\[del\](.*?)\[\/del\]/si'                 => "<span style=\"text-decoration:line-through\">\\1</span>",
        '/\[d\](.*?)\[\/d\]/si'                 => "<span style=\"text-decoration:line-through\">\\1</span>",
        '/\[linethrough\](.*?)\[\/linethrough\]/si' => "<span style=\"text-decoration:line-through\">\\1</span>",
        '/\[sub\](.*?)\[\/sub\]/si'                 => "<sub>\\1</sub>",
        '/\[sup\](.*?)\[\/sup\]/si'                 => "<sup>\\1</sup>",
        '/\[tt\](.*?)\[\/tt\]/si'                   => "\\1",
//      '/\[tt\](.*?)\[\/tt\]/si'                   => "<span style=\"font-family:monospace;\">\\1</span>",
//      '/\[pre\](.*?)\[\/pre\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<pre>\\1</pre>",

        // [email]
        '/\[email\]([a-z0-9\-_\.]+@[a-z0-9\-_\.]+)\[\/email\]/si'       => "<a href=\"mailto:\\1\">\\1</a>",
        '/\[email=([a-z0-9\-_\.]+@[a-z0-9\-_\.]+)\](.*?)\[\/email\]/si' => "<a href=\"mailto:\\1\">\\2</a>",

        // [indent]
        '/\[indent\](.*?)\[\/indent\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'          => "<div style=\"text-indent:1.5em;\">\\1</div>",
        '/\[indent=([0-9]+(?:pt|pc|px|em|ex|mm|cm|in|%))\](.*?)\[\/indent\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<div style=\"text-indent:\\1;\">\\2</div>",

        // [highlight]
        '/\[highlight\](.*?)\[\/highlight\]/si'         => "<span style=\"background-color:#ffff00\">\\1</span>",
        '/\[highlight=(#[a-fA-F0-9]{3,6}|[a-zA-Z ]+)\](.*?)\[\/highlight\]/si'  => "<span style=\"background-color:\\1\">\\2</span>",
        '/\[marker=(.*?)\](.*?)\[\/marker\]/si'  => "<span style=\"background-color:\\1; line-height:100%;\">\\2</span>",

        // [quote]
        '/\[quo\](.*?)\[\/quo\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<blockquote>\\1</blockquote>",
        '/\[quote\](.*?)\[\/quote\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si'    => "<blockquote>\\1</blockquote>",
        '/\[quote=(?:&quot;|"|&#039;|\')?([^(&quot;|&#039)"\'\[\]]*?)(?:&quot;|"|&#039;|\')?\](.*?)\[\/quote\](<br\s*\/{0,1}>|[\r\n]{0,2})?/si' => "<div>\\1<blockquote>\\2</blockquote></div>",

        // [list]
        '/(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\*\](.*?)(?:<br\s*\/?>|[\s\r\n]*|\s*)?(?=(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\*|(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\/?list)/si'   => "<li>\\1</li>",
        '/(?:\s*<br\s*\/?>\s*|[\s\r\n]*)?\[\/list\](?:<br\s*\/?>|[\s\r\n]{0,2})?/si'        => "</ul>",
        '/\[list\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'     => "<ul>",
        '/\[list=1\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'   => "<ul>",
        '/\[list=i\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/s'    => "<ul>",
        '/\[list=I\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/s'    => "<ul>",
        '/\[list=a\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/s'    => "<ul>",
        '/\[list=A\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/s'    => "<ul>",
        '/\[list=d\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'   => "<ul>",
        '/\[list=c\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'   => "<ul>",
        '/\[list=s\](?:<br\s*\/?>|[\s\r\n]*|\s*)?/si'   => "<ul>",

        //[marquee][marq]
        '/\[marquee\](.*?)\[\/marquee\]([^<]*)?(<br\s*\/{0,1}>)?/si'                            => "<marquee loop=\"-1\">\\1</marquee>\\2",
        '/\[marquee=(left|right|up|down)\](.*?)\[\/marquee\]([^<]*)?(<br\s*\/{0,1}>)?/si'       => "<marquee direction=\"\\1\" loop=\"-1\">\\2</marquee>\\3",
        '/\[marquee=(scroll|alternate|slide)\](.*?)\[\/marquee\]([^<]*)?(<br\s*\/{0,1}>)?/si'   => "<marquee behavior=\"\\1\" loop=\"-1\">\\2</marquee>\\3",
        '/\[marq\](.*?)\[\/marq\]([^<]*)?(<br\s*\/{0,1}>)?/si'                          => "<marquee loop=\"-1\">\\1</marquee>\\2",
        '/\[marq=(left|right|up|down)\](.*?)\[\/marq\]([^<]*)?(<br\s*\/{0,1}>)?/si'     => "<marquee direction=\"\\1\" loop=\"-1\">\\2</marquee>\\3",
        '/\[marq=(scroll|alternate|slide)\](.*?)\[\/marq\]([^<]*)?(<br\s*\/{0,1}>)?/si' => "<marquee behavior=\"\\1\" loop=\"-1\">\\2</marquee>\\3",

        //[slideshare id=[0-9]+&doc=[a-zA-Z0-9\-]+&w=[0-9]+]
        '/\[slideshare(?:\s|&nbsp;)id=([0-9]+)(?:&amp;|&)doc=([a-zA-Z0-9\-]+)(?:&amp;|&)w=([0-9]+)\]/si'    => '',

        //[[embed(http://peevee.tv/pluginplayerv4.swf?video_id=[0-9]+/[0-9]+peevee[0-9]+(\.flv|\.mp4),1,425,380)]]
        '/\[\[embed\(http:\/\/peevee\.tv\/pluginplayerv\d\.swf\?video_id=([0-9]+)\/([0-9]+)peevee([0-9]+)(\.flv|\.mp4)[^\]\)]*\)\]\]/si'    => '',

        //Photobucket Movie
        '/\[URL=(http:\/\/[a-zA-Z0-9]+\.photobucket\.com\/[^\.]+\.flv)\]\[IMG\][^\]]+\[\/IMG\]\[\/URL\]/si' => '',

        //ALPSLAB clip! http://www.alpslab.jp/clip_howto.html
        //ALPSLAB base for Yahoo!Blog Tag
        //[[item(http://slide.alpslab.jp/fslide.swf?pos=[FC0-9%\.]+&scale=[0-9]+&link=base,320,240)]]
        '/\[\[item\(http:\/\/slide\.alpslab\.jp\/fslide\.swf\?pos=([FC0-9%\.]+)(?:&amp;|&)scale=([0-9]+)(?:&amp;|&)link=base,[0-9]+,[0-9]+\)\]\]/si'    => 'http://base.alpslab.jp/?s=\\2;p=\\1',
        //ALPSLAB route for Yahoo!Blog Tag
        //[[item(http://route.alpslab.jp/fslide.swf?routeid=[a-z0-9]+,320,240)]]
        '/\[\[item\(http:\/\/route\.alpslab\.jp\/fslide\.swf\?routeid=([a-z0-9]+),[0-9]+,[0-9]+\)\]\]/si'   => 'http://route.alpslab.jp/watch.rb?id=\\1',

        '/\[wiki\](.*?)\[\/wiki\]/si'           => "\\1",
    );

    switch ($allowUrl) {
        case TRUE:
            // [url] for OpenPNE (Cellular)
            $preg['/\[url=(?:&quot;|"|&#039;|\')?(https?)?(:\/\/|\.{0,2}\/)([^\]]+?)(?:&quot;|"|&#039;|\')?\](.*?)\[img\](https?)?(:\/\/|\.{0,2}\/)(.+?)\[\/img\](.*?)\[\/url\]/si'] = OPENPNE_URL . "\\1\\2\\3<br>" . OPENPNE_URL . "\\5\\6\\7";
            $preg['/\[url=(?:&quot;|"|&#039;|\')?(https?)?(:\/\/|\.{0,2}\/)([^\]]+?)(?:&quot;|"|&#039;|\')?\](.*?)\[img=(.*?)x(.*?)\](https?)?(:\/\/|\.{0,2}\/)(.+?)\[\/img\](.*?)\[\/url\]/si'] = OPENPNE_URL . "\\1\\2\\3<br>" . OPENPNE_URL . "\\7\\8\\9";
            $preg['/\[url\](https?)?(:\/\/|\.{0,2}\/)([^\[]+?)\[\/url\]/esi'] = 'preg_replace(array(\'/^\.{0,2}\//si\'),array("' . OPENPNE_URL .'"),"\\1\\2")."\\3"';
            $preg['/\[url=(?:&quot;|"|&#039;|\')?(https?)?(:\/\/|\.{0,2}\/)([^\]]+?)(?:&quot;|"|&#039;|\')?\][^:\[]*https?[^:]*:\/\/(.*?)\[\/url\]/esi'] = 'preg_replace(array(\'/^\.{0,2}\//si\'),array("' . OPENPNE_URL .'"),"\\1\\2")."\\3"';
            $preg['/\[url=(?:&quot;|"|&#039;|\')?(https?)?(:\/\/|\.{0,2}\/)([^\]]+?)(?:&quot;|"|&#039;|\')?\](.*?)\[\/url\]/esi'] = '"\\4<br>".preg_replace(array(\'/^\.{0,2}\//si\'),array("' . OPENPNE_URL .'"),"\\1\\2")."\\3"';
            break;
        case FALSE:
        default:
            break;
    }

    if(function_exists("smarty_modifier_t_url2pne")){
        switch ($allowImg) {
            case TRUE:
                // [img] for OpenPNE (Cellular)
                $preg['/\[img\](\.{0,2}\/)(.+?)\[\/img\]/si'] = OPENPNE_URL . "\\2";
                $preg['/\[img=(.*?)x(.*?)\](\.{0,2}\/)(.+?)\[\/img\]/si'] = OPENPNE_URL . "\\4";
                $preg['/\[img\](https?)(:\/\/)(.+?)\[\/img\]/si'] = "\\1\\2\\3";
                $preg['/\[img=(.*?)x(.*?)\](https?)(:\/\/)(.+?)\[\/img\]/si'] = "\\3\\4\\5";
                break;
            case FALSE:
            default:
                break;
        }
    }else{
        switch ($allowImg) {
            case TRUE:
                // [img] for OpenPNE (Cellular)
                $preg['/\[img\](\.{0,2}\/)(.+?)\[\/img\]/si'] = "<a href=\"". OPENPNE_URL . "\\2\"><img src=\"" . OPENPNE_URL . "\\2\" width=\"".$imgWidth."\"></a>";
                $preg['/\[img=([0-9]+)x([0-9]+)\](\.{0,2}\/)(.+?)\[\/img\]/si'] = "<a href=\"". OPENPNE_URL . "\\4\"><img src=\"" . OPENPNE_URL . "\\4\" width=\"\\1\" height=\"\\2\"></a>";
                $preg['/\[img\](https?)(:\/\/)(.+?)\[\/img\]/si'] = "<a href=\"\\1\\2\\3\"><img src=\"\\1\\2\\3\" width=\"".$imgWidth."\"></a>";
                $preg['/\[img=([0-9]+)x([0-9]+)\](https?)?(:\/\/)(.+?)\[\/img\]/si'] = "<a href=\"\\3\\4\\5\"><img src=\"\\3\\4\\5\" width=\"\\1\" height=\"\\2\"></a>";
                break;
            case FALSE:
            default:
                break;
        }
    }

    $cdir = dirname(__FILE__);
    require_once $cdir . '/modifier.bbcode2html4pne.php';
    $preg = _smarty_modifier_link4pnetags($preg);

    while ( ($message2 = preg_replace(array_keys($preg), array_values($preg), $message)) != $message) {
        $message = $message2;
    }

    return $message;
}

function _smarty_modifier_fontsize2size($size = null, $string)
{
    $size = (empty($size) || is_null($size)) ? null : trim($size);
    if(is_null($size) || $size==''){
        return $string;
    }

    // 絶対単位 cm (10mm), mm, in (2.54cm), pt (1/72 inch), pc (12pt)
    // 相対単位 em(font-sizeの値を1とする), ex(小文字のxの高さを1とする), px, %

    // テキスト指定例リスト : 8. 各種フォントサイズとブラウザ互換性
    // http://www.keynavi.net/ja/eg/fb.html

    //IE4.0,IE5.0,IE5.5,IE6.0
    // size 3=small=1[em]=2[ex]=100[%]=1[pc]=12[pt]=0.167[in]=0.423[cm]=4.23[mm]=16[px]=デフォルト
    // size 4=medium

    //Opera6.05,Opera7.0
    // size 3=small=1[em]=2[ex]=1[pc]=12[pt]=0.167[in]=0.423[cm]=4.23[mm]=16[px]=デフォルト
    // 100％がやや小さい(Opera7.0では修正された)。 逆にOpera7.0では0.167[in]が小さい。
    // size 4=medium

    //xx-small  <font size="1">と同じサイズ
    //x-small   <font size="2">と同じサイズ
    //small     <font size="3">と同じサイズ
    //medium    <font size="4">と同じサイズ
    //large     <font size="5">と同じサイズ
    //x-large   <font size="6">と同じサイズ
    //xx-large  <font size="7">と同じサイズ

    // Fonts
    // http://www.w3.org/TR/CSS21/fonts.html
    // font-size
    // http://w3g.jp/css/font/font-size
    // CSS1 の仕様では7段階ある内の1段階大きく表示されるキーワードごとに1.5倍の比率となる
    // 実装が推奨されていましたが、CSS2 の仕様では1段階大きくなるごとに1.2倍の比率となる
    // 実装が推奨されていました。しかし、改訂版の CSS2.1 の仕様では1.5倍や1.2倍といった
    // 固定比率は推奨しないと見直され、UA は下記の h1-h6要素、および font要素との対照表を
    // 参照するように推奨されています。
    // 絶対指定   xx-small x-small small medium large x-large xx-large  -
    // h1～h6要素 h6               h5    h4     h3    h2      h1
    // font要素   1                2     3      4     5       6         7
    // %          60%      75%     88.8% 100%  120%   150%    200%      300%

    if(preg_match("/^(\d)$/si", $size, $matches)!=0){
        return "<font size=\"$matches[1]\">$string</font>";
    }

    $size2 = preg_replace(array('/^xx\-small/si','/^x\-small/si','/^small/si','/^medium/si','/^large/si','/^x\-large/si','/^xx\-large/si'),array("1","2","3","4","5","6","7"),$size);

    if($size2 != $size){
        return "<font size=\"$size2\">$string</font>";
    }

    if(preg_match("/^(\d+)(pt|pc|px|em|ex|mm|cm|in|%)$/si", $size, $matches)!=0){
        $isize = intval($matches[1]);
        $unit  = strtolower($matches[2]);

        //1[em]=2[ex]=100[%]=1[pc]=12[pt]=0.167[in]=0.423[cm]=4.23[mm]=16[px]
        switch($unit){
        case "pt":
            $isize = $isize / 12 * 100;
            break;
        case "pc":
            $isize = $isize * 100;
            break;
        case "px":
            $isize = $isize / 16 * 100;
            break;
        case "em":
            $isize = $isize * 100;
            break;
        case "ex":
            $isize = $isize / 2 * 100;
            break;
        case "mm":
            $isize = $isize / 4.23 * 100;
            break;
        case "cm":
            $isize = $isize / 0.423 * 100;
            break;
        case "in":
            $isize = $isize / 0.167 * 100;
            break;
        default:
        }

        // 以下のように、適当に判断しています
        // 1    2    3     4     5    6    7
        // 60%  75%  88.8% 100%  120% 200% 300%
        if($isize <= 65){
            $isize = 1;
        }
        else if(65 < $isize && $isize <= 80){
            $isize = 2;
        }
        else if(80 < $isize && $isize <= 95){
            $isize = 3;
        }
        else if(95 < $isize && $isize <= 110){
            $isize = 4;
        }
        else if(110 < $isize && $isize <= 160){
            $isize = 5;
        }
        else if(160 < $isize && $isize <= 250){
            $isize = 6;
        }
        else {
            $isize = 7;
        }
    }else{
        $isize = 4;
    }
    $size  = ($isize>7) ? "7" : "$isize";

    return "<font size=\"$size\">$string</font>";
}

?>
