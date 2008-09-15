({$inc_ktai_header|smarty:nodefaults})

<center>QRで友人を招待する</center>
<hr>
({if $msg})
<font color=red>({$msg})</font><br>
<br>
({/if})

({if $smarty.const.OPENPNE_REGIST_FROM == $smarty.const.OPENPNE_REGIST_FROM_NONE})
    現在、新規登録を停止しています。
({else})

    ({if $smarty.const.OPENPNE_REGIST_FROM == $smarty.const.OPENPNE_REGIST_FROM_PC})
        ※携帯アドレスには招待を送ることができません。<br>
    ({elseif $smarty.const.OPENPNE_REGIST_FROM == $smarty.const.OPENPNE_REGIST_FROM_KTAI})
        ※PCアドレスには招待を送ることができません。<br>
    ({else})
        <div align="center">
        表示されたバーコードを携帯電話のバーコード認識可能のカメラで撮影してください<br>
        <img src="qr_img.php?d=({$linkurl})&amp;t=J&amp;s=3">
        </div>
    ({/if})
({/if})

<hr>

({$inc_ktai_footer|smarty:nodefaults})