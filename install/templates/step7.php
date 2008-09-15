 <form name="login_form" method="post" action="index2.php" target="_parent">
 <input type="hidden" name="task" value="step7" />
 <!--<input type="hidden" name="db_server" value="<?= $db_server ?>" />
 <input type="hidden" name="db_user" value="<?= $db_user ?>" />
 <input type="hidden" name="db_pass" value="<?= $db_pass ?>" />
 <input type="hidden" name="db_name" value="<?= $db_name ?>" />
 <input type="hidden" name="db_version" value="<?= $db_version ?>" />
 <input type="hidden" name="db_prefix" value="<?= $db_prefix ?>" />
 <input type="hidden" name="current_url" value="<?= $current_url ?>" />
 <input type="hidden" name="db_crypt_key" value="<?= $db_crypt_key ?>" />
 <input type="hidden" name="mail_domain" value="<?= $mail_domain ?>" />
 <input type="hidden" name="map_api_key" value="<?= $map_api_key ?>" />
 <input type="hidden" name="image_max_size" value="<?= $image_max_size ?>" />-->
 <table cellspacing="2" cellpadding="1" style="margin: 20px;vertical-align:middle;width:480px">
     <tbody>
     <tr>
         <td colspan="2" style="text-align:center; height: 37px;">
         <h1>MyNETS Installer</h1></td>
     </tr>
     <?php
     if ($install_sql_err !== false || $config_exists_err !== false){
     if ($install_sql_err !== false) {
        
     ?>
     <tr>
         <td colspan="2" style="text-align:center;">
     <span class="style2 fsxl">すでにSQLは作成されていました。phpMyAdmin等でDBを確認してください。<br></span>
     </td>
     </tr>
     <?php
     }
     if ($config_exists_err) {
     ?>
     <tr>
         <td colspan="2" style="text-align:center;">
     <span class="style2 fsxl">すでにconfig.phpは作成されていました。FTP等でconf/config.phpファイルを確認してください。<br></span>
     </td>
     </tr>
     <?php
     }
     } else {
     ?>
     <tr>
         <td colspan="2" style="text-align:center;">
         <p class="GREEN" fsxl>config.php(設定ファイル)が正常に作成されました<br />
         DBにテーブルが作成されました<br /><br /></p>
         <p class="c900 fsxl">管理者がID１でユーザー登録を行うためのアカウントを登録します。<br /></p>
         <p class="c900 fsxl">中止する場合はブラウザを閉じてください。<br />config.php(設定ファイル)とDB内にテーブルが作成されていますので、改めてインストールする場合は削除後行ってください。</p>
         </td>
     </tr>
     <?php
     }
     ?>
     <tr>
         <td style="text-align:right;width:120px">
         </td>
         <td style="text-align:left;">
         <br />
         ID１で登録するメールアドレスとパスワードが必要です。<br />
     </tr>
     
     <tr>
         <td colspan="2" style="text-align:center;padding-top:10px;">
         <input type="button" value="次へ" onclick="javascript:document.login_form.submit();" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
         </td>
     </tr>
     </tbody>
 </table>
 </form>
