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

function smarty_modifier_t_truncate($string, $length = 80, $etc = '...')
{
    if ($length == 0)
    {
        return '';
    }

    $from = array('&amp;', '&lt;', '&gt;', '&quot;', '&#039;', "\r\n", "\r", "\n");
    $to   = array('&', '<', '>', '"', "'");
    $string = str_replace($from, $to, $string);

    $string = old_PictDel($string);
    //絵文字の判定を取り入れる

    //20081216 絵文字のコードのバイト数を取得
    $emoji_count = PictCount($string);
    //含まれている絵文字の数
    $emoji_tag   = PictLen($string);
    //絵文字を１文字とした文字のかず
    $str_count = mb_strlen(PictDel($string), 'UTF-8') + $emoji_tag;
    //トータルの文字の数
    $total_str_count = mb_strlen($string, 'UTF-8');
    $tmp_string = $string;

    //文字が多い場合
    if ($str_count > $length)
    {
        $emoji_pattern = '/\[[ies]:[0-9]{1,3}\]/';
        if (preg_match_all($emoji_pattern, $tmp_string, $matches, PREG_SET_ORDER))
        {
            $new_str = preg_replace($emoji_pattern, '_/emoji/_', $tmp_string);
            $str_arr = explode('_/emoji/_', $new_str);
            $str_count = count($str_arr);
            $res_str = '';
            $i = 0;
            //絵文字以外の切り出した文字列の文字をカウントする。
            //文字数の制限をコントロール

            $new_len = $length;
            foreach ($str_arr as $key => $value)
            {
                $res_str .= $value;
                //文字数がオーバーしてる場合
                if (mb_strlen($res_str, 'UTF-8') > $new_len)
                {
                    $res_str = mb_substr($res_str, 0, $new_len, 'UTF-8').$etc;
                    break;
                }

                //絵文字ひとつ足してぴったりの場合
                if (mb_strlen($res_str, 'UTF-8')+1 == $new_len)
                {
                    $res_str = $res_str . $matches[$key][0];
                    break;
                }

                //絵文字を足してもまだ超えない場合。
                //文字に絵文字を足して、次の文字を組み合わせる
                //最初の絵文字のバイト数を上乗せする。
                $new_len = $new_len + PictCount($matches[$key][0])-1;
                //絵文字コードを追加する
                $res_str .= $matches[$key][0];
            }
            return htmlspecialchars($res_str, ENT_QUOTES, 'UTF-8');
        }

        //絵文字が無い場合
        $res_str = mb_substr($string, 0, $length, 'UTF-8').$etc;
        return htmlspecialchars($res_str, ENT_QUOTES, 'UTF-8');
    }
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

