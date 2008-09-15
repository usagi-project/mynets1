 <form name="login_form" method="post" action="step6.php" target="_parent">
 <input type="hidden" name="task" value="step5" />
 <input type="hidden" name="set_language" value="<?= $set_language ?>" />
 <input type="hidden" name="db_server" value="<?= $db_server ?>" />
 <input type="hidden" name="db_user" value="<?= $db_user ?>" />
 <input type="hidden" name="db_pass" value="<?= $db_pass ?>" />
 <input type="hidden" name="db_name" value="<?= $db_name ?>" />
 <!--<input type="hidden" name="db_version" value="<?= $db_version ?>" />-->
 <input type="hidden" name="image_max_size" value="<?= $image_max_size ?>" />
 <table cellspacing="2" cellpadding="1" style="margin: 20px;vertical-align:middle;width:480px">
     <tbody>
     <tr>
         <td colspan="2" style="text-align:center; height: 37px;">
         <h1>MyNETS Installer</h1></td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;">
         <p class="style2 fsxl">インストールするための各種情報を登録します。</p>
         </td>
     </tr>
     <?php
         if ($dbcheck == true) {
     ?>
     <tr>
         <td colspan="2" style="text-align:center;">
         <p class="GREEN fsxl">サーバー上に指定のDBがみつかりました<br />インストールを続けることが可能です</p>
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         処理の選択:</td>
         <td style="text-align:left;width:360px">
         <input name="update_check" type="radio" value="0"<?php if ($dbcheck) print " checked=\"checked\"" ?> />指定したDB（<?= $db_name ?>）にインストールする<br />
         <!--<input name="update_check" type="radio" value="1"<?php if (!$dbcheck) print " checked=\"checked\"" ?> />新しく作成する
         <input type="text" name="new_db" value="" style="width:200px;" /><br />-->
         <input name="update_check" type="radio" value="9" />インストール作業を中止し最初に戻る

         </td>
     </tr>
      <tr>
         <td colspan="2" style="text-align:center;padding-top:10px;">
         <input type="button" value="次のステップへ" onclick="javascript:document.login_form.submit();" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
         </td>
     </tr>
     <?php
     } else {
     ?>
     <tr>
         <td colspan="2" style="text-align:center;">
         <p class=" style2 fsxl">サーバー上に指定のDBが見つかりません！<br /></p>
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         </td>
         <td style="text-align:left;width:360px">
         最初にDBを作成しないと、インストーラーを動かすことができません。phpMyAdmin等でDBを作成してからインストールしてください。
         </td>
     <?php
     }
     ?>
     </tr>

     </tbody>
 </table>
 </form>
