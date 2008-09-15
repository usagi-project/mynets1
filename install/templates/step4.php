<?php
 if ($act == '' || $errchk == true) {
     print "<form name=\"login_form\" method=\"post\" action=\"step4.php\" target=\"_parent\">";
     print "<input type=\"hidden\" name=\"act\" value=\"check\" />";
 } else {
     print "<form name=\"login_form\" method=\"post\" action=\"step5.php\" target=\"_parent\">";
 }
 ?>
 <input type="hidden" name="task" value="step4" />
 <input type="hidden" name="db_server" value="<?=$db_server?>">
 <!--<input type="hidden" name="db_version" value="<?=$db_version?>">-->
 <input type="hidden" name="db_user" value="<?=$db_user?>">
 <input type="hidden" name="db_pass" value="<?=$db_pass?>">
 <input type="hidden" name="db_name" value="<?=$db_name?>">
 <input type="hidden" name="set_language" value="<?= $set_language ?>" />
 <input type="hidden" name="image_max_size" value="<?= $image_max_size ?>" />
 <table cellspacing="2" cellpadding="1" style="margin: 20px;vertical-align:middle;width:480px">
     <tbody>
     <tr>
         <td colspan="2" style="text-align:center; height: 37px;">
         <h1>MyNETS Installer</h1></td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;">
         <p class="style2 fsxl">データベースの情報を入力してください。<br />情報が分からない場合はインストーラーを一時中止して、情報を準備してから改めて行ってください。</p>
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;">
     <?php
     if ($msg) {
         print "<br /><span class=\"style2 fsxl\">".$msg."</span>" ;
     }
     if ($errchk !==false || $act == '') {
     ?>
     </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         DBサーバー:</td>
         <td style="text-align:left;width:360px">
         <input type="text" name="db_server" value="localhost" style="width:200px" class="textbox" />
         </td>
     </tr>
     <!--<tr>
         <td style="text-align:right;width:120px">
         MySQLのバージョン:</td>
         <td style="text-align:left;width:360px">
         <select name="db_version">
         <option value="40">MySQL4.0x</option>
         <option value="41">MySQL4.1x～</option>
         </select>
         </td>
     </tr>-->
     <tr>
         <td style="text-align:right;width:120px">
         ユーザー名:</td>
         <td style="text-align:left;width:360px">
         <input type="text" name="db_user" value="root" style="width:200px" class="textbox" />
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         パスワード:</td>
         <td style="text-align:left;width:360px">
         <input type="text" name="db_pass" value="" style="width:200px" class="textbox" />
         </td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         MyNETS用DB名:</td>
         <td style="text-align:left;width:360px">
         <input type="text" name="db_name" value="" style="width:200px" class="textbox" />
         </td>
     </tr>
     <?php
         } else {
     ?>
     <tr>
         <td style="text-align:right;whitespace:nowrap;">
         <img src="images/h2_bg.gif" title="usagi" alt="icon"></td>
         <td style="text-align:left;width:360px;">
         <p class="GREEN fsxl">確認してください。<br /></p>
         <ul>
             <li><?= $db_server ?></li>
             <!--<li>MySQL Verion <?= $db_version ?></li>-->
             <li><?= $db_user ?></li>
             <li><?= $db_pass ?></li>
             <li><?= $db_name ?></li>
         </ul>
         <?php
         }
         ?>
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;padding-top:10px;">
         <input type="button" value="次のステップへ" onclick="javascript:document.login_form.submit();" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
         </td>
     </tr>
     </tbody>
 </table>
 </form>
