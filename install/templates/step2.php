 <form name="login_form" method="post" action="step3.php" target="_parent">
 <input type="hidden" name="task" value="step2" />
 <input type="hidden" name="set_language" value="<?= $set_language ?>" />
 <table cellspacing="2" cellpadding="1" style="margin: 20px;vertical-align:middle;width:480px">
     <tbody>
     <tr>
         <td colspan="2" style="text-align:center;">
         <h1>ConfigfileCheck</h1></td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;">
         <?= $parm_err['config']['msg']; ?>
         </td>
     </tr>
     <?php
     if (!$parm_err['config']['flag']){
     ?>
     <tr>
         <td style="text-align:right;width:120px">
         configファイルの確認:</td>
         <td style="text-align:left;width:360px">
         　コンフィグファイルがみつかりました。削除してから実行してください<br />
         <a href="./"><span class="style2 fsxl">インストール中止</span></a>
         </td>
     </tr>
     <?php
     } else {
     ?>
     <tr>
         <td style="text-align:center" colspan="2">configファイル
         <?= $parm_err['dir']['msg']; ?>
         </td>
     </tr>
     <tr>
         <td style="text-align:left;" colspan="2">
         <div class ="GREEN  fsxl"><br /><br />
         こちらのウィザードを利用してサーバー上で config.php ファイルを作成することができます。
         <br />しかし、この方法はすべての環境での動作を保障することができませんのでご了承ください。
         <br />最も確実な方法は、config.php.sample を参考に手動でファイルを作成することです。 
         <br />Usagi Project 公式ホームページを参考にしてください。<br /><br />
         </td>
     </tr>
     <!--<tr>
         <td style="text-align:right;width:120px;vertical-align:top">
         投稿を許可する画像サイズ</td>
         <td style="text-align:left;width:360px">
         <input type="text" name="image_max_size" value="300">Kバイト<br />
         <span class="style2">※わからない場合はそのままにしておいてください。<br />大きい値を入れるとデータベースの画像データの量が多くなることがありますので、そのままの設定をお勧めします。</span>
         </td>
     </tr>-->
     <tr>
         <td style="text-align:left;" colspan="2"><br />
         <p class="style2 fsxl">手動で設定する場合、またはインストールを中止する場合はブラウザを閉じてください。</p>
         </div>
         </td>
     </tr>
     <?php
     if ($parm_err['dir']['flag'] && $parm_err['config']['flag']){
     ?>
     <tr>
         <td colspan="2" style="text-align:center;padding-top:10px;">
         <input type="button" enabled="false" value="次のステップへ" onclick="javascript:document.login_form.submit();" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
         </td>
     </tr>
     <?php
     }
     
     }
     ?>
     </tbody>
 </table>
 </form>
