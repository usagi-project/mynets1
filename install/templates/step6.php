<?php
 if ($act == 'check' && $errmsg == '') {
 ?>
 <form name="login_form" method="post" action="step7.php" target="_parent">
 <input type="hidden" name="task" value="step6" />
 <input type="hidden" name="set_language" value="<?= $set_language ?>" />
 <input type="hidden" name="db_server" value="<?= $db_server ?>" />
 <input type="hidden" name="db_user" value="<?= $db_user ?>" />
 <input type="hidden" name="db_pass" value="<?= $db_pass ?>" />
 <input type="hidden" name="db_name" value="<?= $db_name ?>" />
 <!--<input type="hidden" name="db_version" value="<?= $db_version ?>" />-->
 <input type="hidden" name="db_prefix" value="<?= $db_prefix ?>" />
 <input type="hidden" name="current_url" value="<?= $current_url ?>" />
 <input type="hidden" name="db_crypt_key" value="<?= $db_crypt_key ?>" />
 <input type="hidden" name="mail_domain" value="<?= $mail_domain ?>" />
 <input type="hidden" name="map_api_key" value="<?= $map_api_key ?>" />
 <input type="hidden" name="image_max_size" value="<?= $image_max_size ?>" />
 <?php
 } else {
 ?>
 <form name="login_form" method="post" action="step6.php" target="_parent">
 <input type="hidden" name="act" value="check" />
 <input type="hidden" name="task" value="step6" />
 <input type="hidden" name="set_language" value="<?= $set_language ?>" />
 <input type="hidden" name="db_server" value="<?= $db_server ?>" />
 <input type="hidden" name="db_user" value="<?= $db_user ?>" />
 <input type="hidden" name="db_pass" value="<?= $db_pass ?>" />
 <input type="hidden" name="db_name" value="<?= $db_name ?>" />
 <!--<input type="hidden" name="db_version" value="<?= $db_version ?>" />-->
 <input type="hidden" name="image_max_size" value="<?= $image_max_size ?>" />
 <?php
 }
 ?>
 
 <table cellspacing="2" cellpadding="1" style="margin: 20px;vertical-align:middle;width:480px">
     <tbody>
     <tr>
         <td colspan="2" style="text-align:center; height: 37px;">
         <h1>MyNETS Installer</h1></td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;">
         <p class="c900 fsxl">インストールするための各種情報を登録します。</p>
         </td>
     </tr>
     <?php
     if ($install_flag == false) {
     ?>
     <tr>
         <td colspan="2" style="text-align:center;">
         <p class="c900 fsxl">テーブルが存在しています<br />インストーラを使ってMyNETSをインストールすることができません。<br />テーブルを確認の上、アップグレードを行うか、削除後新規インストールをしてください。<br />
         <?php print $table_list; ?></p></td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         処理の選択:</td>
         <td style="text-align:left;width:360px">
         <p class="c900">すでにそのDBには同じプレフィックスを使ったテーブルが存在しています。プレフィックス名を別名にしてください。</p>
         </td>
     </tr>
     </tbody>
 </table>
 </form>
     <?php
        exit();
     }
         if ($act == 'check' && $errmsg == '') {        //入力後エラーがない場合
         ?>
     <!--<tr>
         <td colspan="2" style="text-align:center;" class="c900">
         言語</td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;">
         <?= $set_language ?>
     </tr>-->
     <tr>
         <td colspan="2" style="text-align:center;" class="c900 fsxl">
         DBプレフィックス</td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class=" fsxl">
         <?= $db_prefix ?>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class="c900 fsxl">
         サイトのURL</td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class=" fsxl">
         <?= $current_url ?>
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class="c900 fsxl">
         DB暗号化キー</td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class=" fsxl">
         <?= $db_crypt_key ?>
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class="c900 fsxl">
         メールサーバドメイン名</td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class=" fsxl">
         <?= $mail_domain ?>
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class="c900 fsxl">
         Google Maps API key</td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class=" fsxl">
         <?= $map_api_key ?>
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class="c900 fsxl">
         投稿画像制限サイズ
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class="fsxl">
         <?= $image_max_size ?>
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;" class="c900 fsxl">
         <br />
         設定ファイルを作成します。<br />ここから先に進むとconfフォルダーにconfig.php(設定ファイル)が作成されます。<br />
         <p class="GREEN">インストールを中止する場合や、改めて最初から行いたい場合は<a href="./">こちらを押して</a>インストール作業を中止してください。<br /></p>
         config.phpファイルと、DBにテーブルを作成します。<br />もし作成後にやり直す場合は、confフォルダー内のconfig.phpを削除し、先ほど設定したDBの中のテーブルを削除してください。
         </td>
     </tr>
     <?php
         } else {
     ?>
     <tr>
         <td colspan="2" style="text-align:center;">
         <p class="c900"><?= $errmsg ?></p>
         </td>
     </tr>

     <tr>
         <td style="text-align:right;width:120px">
         prefix:</td>
         <td style="text-align:left;">
         <input type="text" name="db_prefix" value="<?= $db_prefix ?>" style="width:200px" class="textbox" />
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         </td>
         <td>
         prefixとは、テーブル名の前につける接頭語です。これを使うことで複数のSNSを同じデータベースで管理することができます。<br />
         よくわからない場合は空欄のままにしておいてください<br />
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         サイトのURL:</td>
         <td style="text-align:left;width:360px">
         <input type="text" name="current_url" value="<?= $current_url ?>" style="width:200px" class="textbox" />
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         </td>
         <td>
         運営するSNSのURL。 例：http://sns.usagi.com/ 最後に必ず / をつけてください。
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         DB暗号化キー:</td>
         <td style="text-align:left;width:360px">
         <input type="text" name="db_crypt_key" value="<?= $db_crypt_key ?>" style="width:200px" class="textbox" />
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         </td>
         <td>
         セキュリティのためにデータベース通信を暗号化する技術です。半角英数字56文字以内で入力してください<br />
         例： abcd1234fghijk
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         メールサーバドメイン名:</td>
         <td style="text-align:left;width:360px">
         <input type="text" name="mail_domain" value="<?= $mail_domain ?>" style="width:200px" class="textbox" />
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         </td>
         <td>
         SNSでやりとりを行うメール送信の際のドメイン名です。<br />
         例：mail.usagi.com 
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         Google Maps API key:</td>
         <td style="text-align:left;width:360px">
         <input type="text" name="map_api_key" value="<?= $map_api_key ?>" style="width:320px" class="textbox" />
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         </td>
         <td>
         MyNETSでは、Google Mapsの機能を利用して地図を表示させることができます。<br />
         Google Maps API keyが無い方は<a href="http://www.google.com/apis/maps/signup.html" target="_blank"><span class="c900">⇒こちら</span></a>より必ず取得してください。API Keyはドメインごとに取得する必要があります。
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         </td>
         <td style="text-align:left;width:360px">
         <br />
         入力チェック後、設定ファイルを作成します。
         </td>
     </tr>
     <?php
         }
     ?>
     <tr>
         <td colspan="2" style="text-align:center;padding-top:10px;">
         <input type="button" value="設定ファイル作成" onclick="javascript:document.login_form.submit();" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;padding-top:10px;"><br />
         <a href="./"><p class="style2 fsxl">インストール中止</p></a>
         </td>
     </tr>
     </tbody>
 </table>
 </form>
