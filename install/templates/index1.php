<form name="login_form" method="post" action="step0.php" target="_parent">
<input type="hidden" name="task" value="index1" />
<table cellspacing="2" cellpadding="1" style="margin: 20px;vertical-align:middle;width:480px">
    <tbody>
    <tr>
        <td colspan="2" style="text-align:center; height: 37px;">
        <h1>MyNETS Installer</h1></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;">
        <p class="style2 fsxl">MyNETS<?= MYNETS_VERSION_NO ?>をインストールします</p></td>
    </tr>
    <tr>
         <td style="text-align:right;width:120px">
         言語:</td>
         <td style="text-align:left;width:360px">
         <select name="set_language">
         <!--
         <option value="en">English</option>
         -->
         <option value="ja" selected="">日本語</option>
         </select>
         </td>
     </tr>
     <tr>
         <td style="text-align:right;whitespace:nowrap;">
         <img src="images/h2_bg.gif" title="usagi" alt="icon"></td>
         <td style="text-align:left;width:360px;">
         <br /><br />以前のバージョンのMyNETSからアップグレードされる方は、<br />
         <!--<a href="upgrade.php"><span class="style2">こちらをクリック</span></a>してください。<br />-->
         別途<a href="../setup/MyNETS_Upgrade.html"><span class="c900">アップグレードガイド</span></a>を参照してアップグレードしてください。<br />
         <span class="GREEN fsxl">※インストーラーは新規サイト構築のためのツールです</span><br />
         </td>
     </tr>
     <tr>
         <td style="text-align:right;whitespace:nowrap;">
         <img src="images/h2_bg.gif" title="usagi" alt="icon"></td>
         <td>
         <br /><br />OpenPNE 2.4系、2.6系からMyNETSをご利用になる場合は専用コンバーターファイルで
         アップグレードします。<br />別途<a href="../setup/MyNETS_Setup.html"><span class="c900">セットアップガイド</span></a>および<a href="../setup/OpenPNE_convert.html"><span class="c900">MyNETS への移行ガイド</span></a>を参照してインストールしてください。<br />
         <p class="GREEN fsxl">※インストーラーは新規サイト構築のためのツールです<br /></p>
         手動で設定を行いたい方は、confフォルダーにconfig.phpを設定の上、index.php?m=setupを実行してください
         </td>
     </tr>
     <tr>
         <td colspan="2" style="text-align:center;padding-top:10px;">
         <input type="button" value="次へ" onclick="javascript:document.login_form.submit();" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
         </td>
     </tr>
     </tbody>
 </table>
 </form>
