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
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

function emoji_escape($str, $remove = false)
{
    $result = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $emoji = '';
        $c1 = ord($str[$i]);
        if ($GLOBALS['__Framework']['ktai_carrier'] == "softbank") {
            if ($c1 == 0xF7 || $c1 == 0xF9 || $c1 == 0xFB) {
                $bin = substr($str, $i, 2);
                $emoji = emoji_escape_softbank($bin);
            }
        } else {
            if ($c1 == 0xF8 || $c1 == 0xF9) {
                $bin = substr($str, $i, 2);
                $emoji = emoji_escape_i($bin);
            } elseif (0xF3 <= $c1 && $c1 <= 0xF7) {
                $bin = substr($str, $i, 2);
                $emoji = emoji_escape_ez($bin);
            }
        }
        if ($emoji) {
            if (!$remove) {
                $result .= $emoji;
            }
            $i++;
        } else {
            $result .= $str[$i];
            if ((0x81 <= $c1 && $c1 <= 0x9F) || 0xE0 <= $c1) {
                $result .= $str[$i+1];
                $i++;
            }
        }
    }
    return $result;
}

function emoji_escape_i($bin)
{
    $iemoji = '\xF8[\x9F-\xFC]|\xF9[\x40-\xFC]';
    if (preg_match('/'.$iemoji.'/', $bin)) {
        $unicode = mb_convert_encoding($bin, 'UCS2', 'SJIS-win');
        return sprintf('&#x%02X%02X;', ord($unicode[0]), ord($unicode[1]));
    } else {
        return '';
    }
}

function emoji_escape_ez($bin)
{
    $sjis = (ord($bin[0]) << 8) + ord($bin[1]);
    if ($sjis >= 0xF340 && $sjis <= 0xF493) {
        if ($sjis <= 0xF352) {
            $unicode = $sjis - 3443;
        } elseif ($sjis <= 0xF37E) {
            $unicode = $sjis - 2259;
        } elseif ($sjis <= 0xF3CE) {
            $unicode = $sjis - 2260;
        } elseif ($sjis <= 0xF3FC) {
            $unicode = $sjis - 2241;
        } elseif ($sjis <= 0xF47E) {
            $unicode = $sjis - 2308;
        } else {
            $unicode = $sjis - 2309;
        }
    } elseif ($sjis >= 0xF640 && $sjis <= 0xF7FC) {
        if ($sjis <= 0xF67E) {
            $unicode = $sjis - 4568;
        } elseif ($sjis <= 0xF6FC) {
            $unicode = $sjis - 4569;
        } elseif ($sjis <= 0xF77E) {
            $unicode = $sjis - 4636;
        } elseif ($sjis <= 0xF7D1) {
            $unicode = $sjis - 4637;
        } elseif ($sjis <= 0xF7E4) {
            $unicode = $sjis - 3287;
        } else {
            $unicode = $sjis - 4656;
        }
    } else {
        return '';
    }
    return sprintf('&#x%04X;', $unicode);
}

/*
 * ソフトバンクのShift-JISマルチバイト領域の絵文字をウェブコードに変換
 * 参考 SoftBank ウェブコンテンツ開発ガイド HTML編　2.0.0
 * http://developers.softbankmobile.co.jp/dp/tool_dl/list/
 */
function emoji_escape_softbank($bin)
{
    $sjis1 = ord($bin[0]);
    $sjis2 = ord($bin[1]);
    $web1 = 0;
    $web2 = 0;
    if ($sjis1 == 0xF9) {
        if ($sjis2 >= 0x41 && $sjis2 <= 0x7E) {
            //#1 第二バイト0x7Eまで
            $web1 = ord('G');
            $web2 = $sjis2 - 0x20;
        } elseif($sjis2 >= 0x80 && $sjis2 <= 0x9B) {
            //#1 第二バイト0x80から
            $web1 = ord('G');
            $web2 = $sjis2 - 0x21;
        } elseif ($sjis2 >= 0xA1 && $sjis2 <= 0xED) {
            //#4
            $web1 = ord('O');
            $web2 = $sjis2 - 0x80;
        }
    } else if ($sjis1 == 0xF7) {
        if ($sjis2 >= 0x41 && $sjis2 <= 0x7E) {
            //#2 第二バイト0x7Eまで
            $web1 = ord('E');
            $web2 = $sjis2 - 0x20;
        } elseif($sjis2 >= 0x80 && $sjis2 <= 0x9B) {
            //#2 第二バイト0x80から
            $web1 = ord('E');
            $web2 = $sjis2 - 0x21;
        } elseif ($sjis2 >= 0xA1 && $sjis2 <= 0xF3) {
            //#3
            $web1 = ord('F');
            $web2 = $sjis2 - 0x80;
        }
    } else if ($sjis1 == 0xFB) {
        if ($sjis2 >= 0x41 && $sjis2 <= 0x7E) {
            //#5 第二バイト0x7Eまで
            $web1 = ord('P');
            $web2 = $sjis2 - 0x20;
        } elseif($sjis2 >= 0x80 && $sjis2 <= 0x8D) {
            //#5 第二バイト0x80から
            $web1 = ord('P');
            $web2 = $sjis2 - 0x21;
        } elseif ($sjis2 >= 0xA1 && $sjis2 <= 0xD7) {
            //#6
            $web1 = ord('Q');
            $web2 = $sjis2 - 0x80;
        }
    }
    if ($web2 == 0)
        return '';
    else
        return pack('c*',0x1b,0x24,$web1,$web2,0x0f);
    
}

function emoji_unescape($str, $amp_escaped = false)
{
    $amp = ($amp_escaped) ? '&amp;' : '&';
    $regexp = "/$amp#x(E[0-9A-F]{3});/";
    return preg_replace_callback($regexp, 'emoji_unescape_callback', $str);
}

function emoji_unescape_callback($matches)
{
    $unicode = hexdec($matches[1]);
    if (0xE63E <= $unicode && $unicode <= 0xE757) {
        return emoji_unescape4i($unicode);
    } elseif ((0xE468 <= $unicode && $unicode <= 0xE5DF) ||
              (0xEA80 <= $unicode && $unicode <= 0xEB88)) {
        return emoji_unescape4ez($unicode);
    } else {
        return $matches[0];
    }
}

function emoji_unescape4i($unicode)
{
    $ubin = pack('H4', dechex($unicode));
    return mb_convert_encoding($ubin, 'SJIS-win', 'UCS2');
}

function emoji_unescape4ez($unicode)
{
    if (0xE468 <= $unicode  && $unicode <= 0xE5DF) {
        if ($unicode <= 0xE4A6) {
            $sjis = $unicode + 4568;
        } elseif ($unicode <= 0xE523) {
            $sjis = $unicode + 4569;
        } elseif ($unicode <= 0xE562) {
            $sjis = $unicode + 4636;
        } elseif ($unicode <= 0xE5B4) {
            $sjis = $unicode + 4637;
        } elseif ($unicode <= 0xE5CC) {
            $sjis = $unicode + 4656;
        } else {
            $sjis = $unicode + 3443;
        }
    } elseif (0xEA80 <= $unicode && $unicode <= 0xEB88) {
        if ($unicode <= 0xEAAB) {
            $sjis = $unicode + 2259;
        } elseif ($unicode <= 0xEAFA) {
            $sjis = $unicode + 2260;
        } elseif ($unicode <= 0xEB0D) {
            $sjis = $unicode + 3287;
        } elseif ($unicode <= 0xEB3B) {
            $sjis = $unicode + 2241;
        } elseif ($unicode <= 0xEB7A) {
            $sjis = $unicode + 2308;
        } else {
            $sjis = $unicode + 2309;
        }
    }
    return pack('H4', dechex($sjis));
}

/*
 * Softbankの絵文字の４バイト目がエンテティになっている場合元に戻す
 */
function emoji_unescape_softbank($str)
{
    $regexp = '/(\x1b\x24)([EFGOPQ])&(amp|quot|#039|gt|lt);(\x0f)/';
    return preg_replace_callback($regexp, 'emoji_unescape_softbank_callback', $str);
}
function emoji_unescape_softbank_callback($matches)
{
    $emoji = $matches[3];
    if ($emoji=='amp') {
        $emoji = '&';
    } elseif ($emoji == 'quot') {
        $emoji = '"';
    } elseif ($emoji == '#039') {
        $emoji = '\'';
    } elseif ($emoji == 'gt') {
        $emoji = '>';
        } elseif ($emoji == 'lt') {
        $emoji = '<';
    } else {
        $emoji = "{$emoji};";
    }
    return $matches[1] . $matches[2] . $emoji . $matches[4]; 
}

?>
