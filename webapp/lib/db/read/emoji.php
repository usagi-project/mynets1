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
 * @package    emoji model
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
 * @version    MyNETS,v 1.2.1
 * @chengelog  [2008/12/01]
 * ========================================================================
 */

/**
 * 絵文字関連の関数を設置
 *
 */

/**
 * 絵文字の数を数える
 * @param str 文字列
 * @return int 絵文字の数
 * @access public
 */
if (! function_exists('PictLen'))
{
    function PictLen($str)
    {
        $moji_pattern = '/\[([ies]):([0-9]{1,3})\]/i';
        $emoji_count  = preg_match_all($moji_pattern,$str,$emoji);

        $moji_pattern = '/&(?:amp;|)#x([0-9A-F][0-9A-F][0-9A-F][0-9A-F]);/i';
        $count = preg_match_all($moji_pattern,$str,$emoji);
        $moji_pattern = '/\x1b\x24(\C\C)\x0f/';
        $counts       = preg_match_all($moji_pattern,$str,$emojis);
        return (int)$emoji_count + (int)$count + (int)$counts;
    }
}
/**
 * 絵文字を取り除く
 * @param str 文字列
 * @return str 絵文字を取り除いた文字列
 * @access public
 */
if (! function_exists('PictDel'))
{
    function PictDel($str)
    {
        $moji_pattern = '/\[([ies]):([0-9]{1,3})\]/i';
        $str          = preg_replace($moji_pattern,'', $str);
        $moji_pattern = '/&(?:amp;|)#x([0-9A-F][0-9A-F][0-9A-F][0-9A-F]);/i';
        $str          = preg_replace($moji_pattern,'', $str);
        $moji_pattern = '/\x1b\x24(\C\C)\x0f/';
        $str          = preg_replace($moji_pattern, '', $str);
        return $str;
    }
}
/**
 * 旧パターンの絵文字コードを取り除く
 * @param str 文字列
 * @return str 絵文字を取り除いた文字列
 * @access public
 */
if (! function_exists('old_PictDel'))
{
    function old_PictDel($str)
    {
        $moji_pattern = '/&(?:amp;|)#x([0-9A-F][0-9A-F][0-9A-F][0-9A-F]);/i';
        $str          = preg_replace($moji_pattern,'', $str);
        $moji_pattern = '/\x1b\x24(\C\C)\x0f/';
        $str          = preg_replace($moji_pattern, '', $str);
        return $str;
    }
}
?>