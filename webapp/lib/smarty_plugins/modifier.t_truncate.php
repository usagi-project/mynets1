<?php
/**
 * @license  GNU Lesser General Public License (LGPL)
 * @see      Smarty/plugins/modifier.truncate.php
 */

/**
 * Smarty t_truncate modifier plugin
 *
 * @param string $string
 * @param int    $length
 * @param string $etc
 * @param bool   $break_words
 * @return string
 */
/*
function smarty_modifier_t_truncate($string, $length = 80, $etc = '...',
                                  $break_words = true)
{
    if ($length == 0)
    {
        return '';
    }

    $from = array('&amp;', '&lt;', '&gt;', '&quot;', '&#039;');
    $to   = array('&', '<', '>', '"', "'");
    $string = str_replace($from, $to, $string);
    //絵文字の判定を取り入れる
    $emoji_count = PictLen($string);
    $emoji_del   = PictDel($string);
    //絵文字の数を数える。
    //指定数でカットした最後の文字が絵文字かどうかを判定する
    //絵文字の数は8バイト
    //絵文字が2文字ある場合、80とらんけーとであれば、
    //78+8*2とする。
    $newlength = ($length - $emoji_count) + ($emoji_count * 8);

    //指定文字数より大きい場合
    if (strlen($string) > $newlength) {
        //絵文字がなければそのまま
        if (! $emoji_count >= 1)
        {
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
            $string = mb_strimwidth($string, 0, $length) . $etc;
        }
        else        //絵文字が含まれている場合
        {

            //最後から＆をチェックする
            $pos = strrpos($string, '&');
            if ($pos >= 8)
            {
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $newlength));
                $string = mb_strimwidth($string, 0, $newlength) . $etc;
            }
            else
            {
                $moji_pattern  = '/&(?:amp;|)#x([0-9A-F][0-9A-F][0-9A-F][0-9A-F]);/i';
                //8文字以下だからちょん切れいている可能性がある
                for ($i = 1;$i <= 7;$i++)
                {
                    if (preg_match($moji_pattern, substr($string, 0, $newlength + $i), $matches))
                    {
                        $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $newlength + $i));
                        $string = mb_strimwidth($string, 0, $newlength + $i) . $etc;
                        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
                    }
                }
                //マッチしないということは絵文字パターンではないということと判断
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $newlength));
                $string = mb_strimwidth($string, 0, $newlength) . $etc;
                return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
            }
        }
    }
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
*/
function smarty_modifier_t_truncate($string, $length = 80, $etc = '...',
                                  $break_words = true)
{
    if ($length == 0)
        return '';
    //絵文字の判定を取り入れる
    $emoji_count = PictLen($string);

    $from = array('&amp;', '&lt;', '&gt;', '&quot;', '&#039;');
    $to   = array('&', '<', '>', '"', "'");
    $string = str_replace($from, $to, $string);

    $length = ($length - $emoji_count) + ($emoji_count * 8);
    if (mb_strlen($string) > $length) {
        //$length -= strlen($etc);
        if (!$break_words)
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));

        $string = mb_strimwidth($string, 0, $length);

        $amppos = mb_strrpos($string,'&');//&が最後に出現する位置を取得（マルチバイト）
        $emojinum = mb_strlen($string) - $amppos;//$stringの文字数から&が最後に出現する位置を引き&以降の文字数を取得（マルチバイト）
        if($emojinum < 8) {//もし$emojinumが7文字以下なら・・・
            $string = mb_substr($string, 0, $amppos) . $etc;//$stringを&が最後に出現する位置で切り詰める
        } else {
            $string .= $etc;
        }
    }
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
