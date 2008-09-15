({$inc_header|smarty:nodefaults})

<h2>CSVインポート</h2>
<div class="contents">


({if $requests.msg})
<p class="actionMsg">({$requests.msg})</p>
({/if})

<h3 class="item">メンバー情報をデータベースに一括登録</h3>

<p class="caution">※文字コード、ファイル形式、項目の順序を守ってください。この処理は10分以上かかる場合があります</p>

<form action="./" method="post" enctype="multipart/form-data">
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="do_({$hash_tbl->hash('import_c_member','do')})">
<input type="hidden" name="sessid" value="({$PHPSESSID})">
<p>≪メンバーデータファイル≫
<ul>
<li>文字コード：UTF-8
<li>ファイル形式：csv
<li>項目の順序「ニックネーム」「登録メールアドレス」「パスワード」
<li>※項目名は不必要ですので、ある場合は削除しておいてください。
<li>ニックネームは４０文字以内
<li>一度に処理できる件数は１０００件まで
</ul>

<p><input type="file" name="member_file" /></p>
<p class="textBtn"><input type="submit" class="submit" name="member_file_submit" value="登録" /></p>
</form>

({$inc_footer|smarty:nodefaults})
