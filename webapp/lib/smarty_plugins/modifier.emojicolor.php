<?php
/*
 * @author Kuniharu Tsujioka UsagiProject
 * @License PHP License 3.01
 * @ copyright KT & UsagiProject
 */

function smarty_modifier_emojicolor($string)
{
    // ユーザエージェントの取得
    $agent = $GLOBALS['__Framework']['ktai_carrier'];
    
    if ($GLOBALS['__Framework']['ktai_carrier'] === 'docomo') {
        //ドコモのみ実行
        // 変換処理
        $string = strtr($string, $emoji_color);
    }
    // 出力内容を返す
    return $string;
}
?>
