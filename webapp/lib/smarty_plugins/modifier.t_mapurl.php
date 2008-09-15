<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *                      that is available at http://www.php.net/license/3_01.txt
 *                      If you did not receive a copy of the PHP license and are unable
 *                      to obtain it through the world-wide-web, please send a note to
 *                      license@php.net so we can mail you a copy immediately.
 *
 * @category   Application of MyNETS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/04/14] Ver1.0.1Nighty package
 * ========================================================================
 */

function smarty_modifier_t_mapurl($string)
{
    if (CHECK_KTAI_UA && !isKtaiUserAgent()) {
        return $string;
    }

    $url_pattern = '/\#\#([^<>]+)\#\#/i';
    $string = preg_replace_callback($url_pattern, 'smarty_modifier_t_geocodekmaps_callback', $string);

    $url_pattern = '/http:\/\/walk\.eznavi\.jp\/map\/\?([^\s]+)/i';
    $string = preg_replace_callback($url_pattern, 'smarty_modifier_t_eznavi_callback', $string);

    $url_pattern = '/http:\/\/docomo\.ne\.jp\/cp\/map\.cgi\?([^\s]+)/i';
    $string = preg_replace_callback($url_pattern, 'smarty_modifier_t_docomo_callback', $string);

    $url_pattern = '/&lt;cmd\s+src="gmaps"\s+args="([\w\-\+%]+(,[\w\-\+%]+)*)"\s*&gt;/i';
    $string = preg_replace_callback($url_pattern, 'smarty_modifier_t_cmd_callback', $string);

    $url_pattern = '/http:\/\/(?:maps|www)\.google\.(?:co\.jp|com)\/(?:map[sph]|)\?([^\s]+)/i';
    return preg_replace_callback($url_pattern, 'smarty_modifier_t_google_callback', $string);
}

function smarty_modifier_t_geocodekmaps_callback($matches)
{
/*
*
* Covert from 住所 to t2
*##東京駅##
*q=35.51738,137.82403&zp=III
*
*
*/
    $src  = $matches[1];
    $res=file_get_contents('http://maps.google.co.jp/maps/geo?q='.urlencode($src).'&key=ABQIAAAAVrdpRBWknsgJGrYOjdmC6xTtqm9F4nxAvb0_1vlXOyOyK6P1AxQPUi2KrKbh_uDQEA3gq--_VQKewg&output=csv');
    $_args = explode(',', $res);
    if($_args[0] == '602') {
        return '##'.$matches[1].'##';
    } else {
        $lat = $_args[2];
        $lon = $_args[3];
        $zoom = 17;
        $gkey = GOOGLE_MAPS_API_KEY;
        return "&nbsp;[<a href='t2.php?lat={$lat}&amp;lon={$lon}&amp;zoom={$zoom}&amp;gkey={$gkey}'>地図を表示</a>]&nbsp;";
    }
}

function smarty_modifier_t_eznavi_callback($matches)
{
/*
*
* Covert from eznavi to t2
*http://walk.eznavi.jp/map/?datum=0&unit=1&lat=%2b35.51738&lon=%2b137.82403&fm=0
*q=35.51738,137.82403&zp=III
*
*
*/
    $param = array();
    $d = split("&amp;",$matches[1]);
    for($i=0;$i<count($d);$i++) {
        $e = explode("=",$d[$i]);
        if(count($e)==2) {
            $param[$e[0]]=$e[1];
        }
    }
    $lat = str_replace("%2b","",$param['lat']);
    $lon = str_replace("%2b","",$param['lon']);
    $zoom = 17;
    $gkey = GOOGLE_MAPS_API_KEY;
    return "&nbsp;[<a href='t2.php?lat={$lat}&amp;lon={$lon}&amp;zoom={$zoom}&amp;gkey={$gkey}'>地図を表示</a>]&nbsp;";
}

function smarty_modifier_t_cmd_callback($matches)
{
/*
*
* Covert from cmd to t2
*<cmd src="gmaps" args="16,35,687168,139,757412">
*q=35.51738,137.82403&zp=III
*
*
*/
    $args = $matches[1];

    $_args = explode(',', $args);

    $lat = $_args[1].'.'.$_args[2];
    $lon = $_args[3].'.'.$_args[4];
    $zoom = $_args[0];
    $gkey = GOOGLE_MAPS_API_KEY;
    return "&nbsp;[<a href='t2.php?lat={$lat}&amp;lon={$lon}&amp;zoom={$zoom}&amp;gkey={$gkey}'>地図を表示</a>]&nbsp;";
}

function smarty_modifier_t_google_callback($matches)
{
/*
*
* Covert from google to t2
*http://maps.google.co.jp/maps?hl=ja&ie=UTF8&q=%E9%A3%AF%E7%94%B0%E5%B8%82&oe=UTF-8&ll=35.485834,137.817993&spn=0.261662,0.63858&z=11&om=1
*q=35.51738,137.82403&zp=III
*
*
*/
    $param = array();
    $d =  explode("&amp;",$matches[1]);
    for($i=0;$i<count($d);$i++) {
        $e = explode("=",$d[$i]);
        if(count($e)==2) {
            $param[$e[0]]=$e[1];
        }
    }

    if(empty($param['ll'])) {
        $res=file_get_contents('http://maps.google.co.jp/maps/geo?q='.urldecode($param['q']).'&key=ABQIAAAAVrdpRBWknsgJGrYOjdmC6xTtqm9F4nxAvb0_1vlXOyOyK6P1AxQPUi2KrKbh_uDQEA3gq--_VQKewg&output=csv');
        $_args = explode(",", $res);
        if($_args[0] == '602') {
            return $matches[0];
        } else {
            $lat = $_args[2];
            $lon = $_args[3];
        }
    } else {
        $v = explode(",",$param['ll']);
        $lat = $v[0];
        $lon = $v[1];
    }

    $zoom = $param['z'];
    $gkey = GOOGLE_MAPS_API_KEY;
    return "&nbsp;[<a href='t2.php?lat={$lat}&amp;lon={$lon}&amp;zoom={$zoom}&amp;gkey={$gkey}'>地図を表示</a>]&nbsp;";
}

function smarty_modifier_t_docomo_callback($matches)
{
/*
*
* Covert from docomo to t2
*http://docomo.ne.jp/cp/map.cgi?&lat=%2B36.05.35.981&lon=%2B140.06.14.969&geo=WGS84&alt=%2B64.000&x-acc=1
*q=35.51738,137.82403&zp=III
*
*
*/
    $param = array();
    $d =  split("&amp;",$matches[1]);
    for($i=0;$i<count($d);$i++) {
        $e = explode("=",$d[$i]);
        if(count($e)==2) {
            $param[$e[0]]=$e[1];
        }
    }

    $lats = explode('.',str_replace("%2B","",$param['lat']));
    $lat = floatval($lats[0]) + (floatval($lats[1])/60) + (floatval($lats[2]+$lats[3]/1000)/3600);
    
    $lons = explode('.',str_replace("%2B","",$param['lon']));
    $lon = floatval($lons[0]) + (floatval($lons[1])/60) + (floatval($lons[2]+$lons[3]/1000)/3600);
    $zoom = 17;
    $gkey = GOOGLE_MAPS_API_KEY;
    return "&nbsp;[<a href='t2.php?lat={$lat}&amp;lon={$lon}&amp;zoom={$zoom}&amp;gkey={$gkey}'>地図を表示</a>]&nbsp;";
}
?>
