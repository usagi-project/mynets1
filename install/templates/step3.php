 <form name="login_form" method="post" action="step4.php" target="_parent">
 <input type="hidden" name="task" value="step3" />
 <input type="hidden" name="set_language" value="<?php echo  $set_language; ?>" />
 <input type="hidden" name="image_max_size" value="<?php echo  $image_max_size; ?>" />
 <table cellspacing="2" cellpadding="1" style="margin: 20px;vertical-align:middle;width:480px">
     <tbody>
     <tr>
         <td colspan="2" style="text-align:center; height: 37px;">
         <h1>MyNETS Installer</h1></td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center">
         <p class="style2 fsxl"><?php echo  $image_err; ?></p>
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;">
         <p class="style2 fsxl">データベースの情報が必要になります</p></td>
     </tr>
     <tr>
         <td style="text-align:right;width:120px">
         <img src="images/h2_bg.gif" title="usagi" alt="icon"></td>
         <td style="text-align:left;width:360px">
         <p>データベース（MySQL）についての情報が必要です。<br />
         また、プロセス進行の前にこれらの情報や設定を準備してください。<br />
         </p>
         </td>
     </tr>
     <tr>
         <td style="text-align:center" colspan="2">
         <p class="GREEN fsxl">事前にphpMyAdmin 等を使ってMySQLに <br />MyNETS 専用のデータベースを作成してください。</p></td>
     </tr>
     <tr>
         <td style="text-align:right;whitespace:nowrap;">
         <img src="images/h2_bg.gif" title="usagi" alt="icon"></td>
         <td>データベースの照合順序は「UTF-8」を指定してください。他では動作しません。<br />
         この時点でわからない場合は、<a target="_blank" href="http://usagi.mynets.jp/">Usagi
         Project 公式ホームページ</a>を参考にしてください。 <br />
         ※レンタルサーバの契約内容によりデータベースを作成できない場合は、下記情報をお問い合わせください。<br />
         MyNETSのインストールにはMySQLが必須となっています。</td>
     </tr>
     <tr>
         <td style="text-align:center" colspan="2">
         <p class="style2 fsxl">以下のMySQL設定情報をご用意ください。</p></td>
     </tr>
     <tr>
         <td style="text-align:right;whitespace:nowrap;">
         <img src="images/h2_bg.gif" title="usagi" alt="icon"></td>
         <td><ul>
             <li>データベース名</li>
             <li>ユーザー名</li>
             <li>パスワード</li>
             <li>データベースサーバーのホスト名</li>
         </ul>
         設定情報が不明な場合は、このウィザードを進める前にレンタルサーバ（ホスティング）サービスに問い合わせてください。
         <br />
         </td>
     </tr>
     <tr>
         <td style="text-align:right;whitespace:nowrap;">
         <img src="images/h2_bg.gif" title="usagi" alt="icon"></td>
         <td style="text-align:left;width:360px;">
         <p class="style1 fsxl">何らかの理由でこのウィザードが機能しない場合でも心配いりません。データベースの設定のすべては別ファイルで行うことができます。<br />ローカルにて、config.php.sampleをテキストエディタで開き、必要情報を記載した上で、config.phpとリネームして保存後にサーバーへアップロードしてください。<!--　また、データベースの中身も別ファイルで用意されています。phpMyAdminなどを利用して、Usagiに必要なSQLを実行することができます。 --><br />
         詳しい情報は、<a target="_blank" href="http://usagi-project.org/"><span class="style2">Usagi Project 公式ホームページ</span></a>を参考にしてください。</p>
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
