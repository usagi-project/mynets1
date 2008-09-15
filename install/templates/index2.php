<form method="post" action="index2.php">
<div class="main">
  <p>以下のフォームに、Usagi を使う上で必要な情報を入力してください。</p>
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">サイト名：
      <input type="text" name="usagi_site_name" value="">
</div>
      <blockquote><p>SNSサイト名の設定をします</p></blockquote>
    <hr size="1">
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">初期ユーザのメールアドレス：
      <input type="text" name="usagi_user_mail" value="" style="ime-mode:disabled;">
</div>

      <blockquote><p>初期ユーザのログイン情報（メールアドレス）の設定をします</p></blockquote>
      <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">初期ユーザのパスワード：
        <input type="password" name="usagi_user_pass1" value="" style="ime-mode:disabled;">
  </div>
      <blockquote><p>初期ユーザのログイン情報（パスワード）の設定をします</p></blockquote>
      <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">初期ユーザのパスワード（確認）：
        <input type="password" name="usagi_user_pass2" value="" style="ime-mode:disabled;">
  </div>
    <blockquote><p>初期ユーザのログイン情報（パスワード/確認）の設定をします</p></blockquote>
    <hr size="1">
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">管理用アカウントのアカウント名：
        <input name="usagi_admin_mail" type="text" value="" style="ime-mode:disabled;">
  </div>
    <blockquote><p>管理画面へのログイン用アカウント（アカウント名）の設定をします</p></blockquote>
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">管理用アカウントのパスワード：
        <input name="usagi_admin_pass1" type="password" value="" style="ime-mode:disabled;">
  </div>
    <blockquote><p>管理画面へのログイン用アカウント（パスワード）の設定をします</p></blockquote>
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">管理用アカウントのパスワード（確認）：
        <input type="password" name="usagi_admin_pass2" value="" style="ime-mode:disabled;">
  </div>
      <blockquote><p>管理画面へのログイン用アカウント（パスワード/確認）の設定をします</p></blockquote>
      <div class="home">
        <input type=hidden name="mode" value="finish">
        <input type="submit" name="Submit" value="セットアップ開始">
  <a href="#"></a></div>
</div>
</form>
